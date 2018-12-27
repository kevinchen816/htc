<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Plan;
use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\PlanHistory;

use App\Models\LogStripe;

class WebhookController extends CashierController
{
    /**
     * Handle a Stripe webhook.
     *
     * @param  array  $payload
     * @return Response
     */
    public function handleInvoiceCreated($payload) {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];
            if ($data['billing_reason'] == 'subscription_cycle') {
                $plan = Plan::where('sub_id', $data['subscription'])->first();
                if ($plan) {
                    $plan->renew_plan = $data['lines']['data'][0]['plan']['id']; // au_5000_1m
                    $plan->renew_invoice = $data['id']; // in_1DhiAVG8UgnSL68UZhx96Hwk
                    $plan->update();
                    // echo $data['subscription'].'</br>'; // for debug
                    // echo $data['lines']['data'][0]['plan']['id'].'</br>'; // for debug
                    // echo $data['id'].'</br>'; // for debug

                    /* create Plan History */
                    // $sku = PlanProductSku::where('sub_plan', $plan->renew_plan)->first();
                    // $product = PlanProduct::find($sku->plan_product_id);
                    $ph = new PlanHistory();
                    $ph->iccid = $plan->iccid;
                    $ph->user_id = $plan->user_id;
                    $ph->event = 'renew';
                    // $ph->points = $product->points;
                    // $ph->points_reserve = 0;
                    $ph->sub_id = $plan->sub_id; // sub_EAh5xs7HT6ObHB
                    $ph->sub_plan = $plan->renew_plan; // au_5000_1m
                    $ph->pay_invoice = $plan->renew_invoice;
                    $ph->save();
                }
            }
        }
        // return http_response_code(200); // PHP 5.4 or greater
        return new Response('Webhook Handled', 200);
    }

    /*----------------------------------------------------------------------------------*/
    // public function handleInvoicePaymentSucceeded($payload) {
    //     // return http_response_code(200); // PHP 5.4 or greater
    //     return new Response('Webhook Handled', 200);
    // }

    public function handleInvoicePaymentFailed($payload) {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];

            /* update Plan History */
            if ($data['id']) { // in_00000000000000
                $ph = PlanHistory::where('pay_invoice', $data['id'])->first();
                if ($ph) {
                    $ph->status = 'invoice.payment_failed';
                    $ph->update();
                }
            }
        }
        return new Response('Webhook Handled', 200);
    }

    /*----------------------------------------------------------------------------------*/
    public function handleChargeSucceeded($payload) {
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];

            $plan = Plan::where('renew_invoice', $data['invoice'])->first();
            if ($plan) {
                $sku = PlanProductSku::where('sub_plan', $plan->renew_plan)->first();
                $product = PlanProduct::find($sku->plan_product_id);

                $subscription = \Stripe\Subscription::retrieve($plan->sub_id);
                if ($subscription) {
// TODO
//                    $subscription = \Stripe\Subscription::update($subscription->id , [
//                        'trial_end' => $subscription->current_period_end,
//                        'prorate' => false,
//                    ]);
//+
                    // echo $subscription; // for debug

                    $plan->status = 'active';
                    $plan->sub_plan = $plan->renew_plan;
                    $plan->points = $product->points * $sku->month;
                    $plan->points_used = 0;
                    $plan->sub_start = date('Y-m-d H:i:s', $subscription->current_period_start);
                    $plan->sub_end = date('Y-m-d H:i:s', $subscription->current_period_end);
                    $plan->update();

                    /* update Plan History */
                    $pay_at = date_create();
                    date_timestamp_set($pay_at, $data['created']);

                    $ph = PlanHistory::where('pay_invoice', $data['invoice'])->first();
                    $ph->status = 'success';
                    $ph->points = $plan->points;
                    $ph->sub_start = $plan->sub_start;
                    $ph->sub_end = $plan->sub_end;
                    $ph->pay_method = $data['source']['brand'];
                    $ph->pay_no = $data['id']; // ch_1Dhj6kG8UgnSL68UWvvUcJIU
                    $ph->pay_info = json_encode($data['source']);
                    $ph->pay_at = $pay_at;
                    $ph->update();
                }
            }
            // echo $data['id'].'</br>';
            // echo $data['invoice'].'</br>';
            // echo $renew_plan.'</br>';
        }
        return new Response('Webhook Handled', 200);
    }

    public function handleChargeFailed($payload) {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];

            /* update Plan History */
            if ($data['invoice']) {
                $ph = PlanHistory::where('pay_invoice', $data['invoice'])->first();
                if ($ph) {
                    $ph->status = 'charge.failed';
                    $ph->update();
                }
            }
        }
        return new Response('Webhook Handled', 200);
    }

    /*----------------------------------------------------------------------------------*/
    //customer.subscription.created
//     public function handleCustomerSubscriptionCreated($payload) {
// // if($_SERVER['HTTP_HOST'] == 'example.com') {
// //     Stripe::setApiKey("sk_live_my_key");
// // } else {
// //     Stripe::setApiKey("sk_test_my_key");
// // }
// // return $_SERVER['HTTP_HOST']; //sample.test
// // return print_r($payload);

//         return new Response('Webhook Handled', 200);
//     }

    public function handleCustomerSubscriptionDeleted(array $payload)
    {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];

            // $iccid = $data['metadata']['iccid'];
            $plan = Plan::where('sub_id', $data['id'])->first();
            if ($plan) {
                /* create Plan History */
                $ph = new PlanHistory();
                $ph->iccid = $plan->iccid;
                $ph->user_id = $plan->user_id;
                $ph->event = 'delete';
                $ph->status = 'customer.subscription.deleted';
                $ph->points = $plan->points_used;
                // $ph->points_reserve = 0;
                $ph->sub_id = $plan->sub_id; // sub_EAh5xs7HT6ObHB
                $ph->sub_plan = $plan->sub_plan;
                $ph->sub_start = $plan->sub_start;
                $ph->sub_end = $plan->sub_end;
                $ph->save();

                $plan->status = 'suspend';
                $plan->points = 0;
                $plan->points_used = 0;
                // $plan->renew_plan = $plan->sub_plan;
                $plan->renew_invoice = '';
                $plan->update();
            }
        }
        return new Response('Webhook Handled', 200);
    }

    /*----------------------------------------------------------------------------------*/
    public function log_add($payload) {
        $log = new LogStripe;
        $log->type = $payload['type'];
        $log->payload = json_encode($payload);
        $log->save();
        return;

        // $type = $payload['type'];
        // if ($type == 'customer.created') {
        //     $log = new LogStripe;
        //     $log->type = $payload['type'];
        //     $log->user_id = $payload['user_id'];
        //     $log->cus_id = $payload['data']['object']['customer'];
        //     $log->sub_id = $payload['sub_id'];
        //     $log->payload = $payload;
        //     $log->save();

        // } else {
        //     $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        //     if ($user) {
        //         $data = $payload['data']['object'];

        //         $log = new LogStripe;
        //         $log->type = $payload['type'];
        //         $log->user_id = $payload['user_id'];
        //         $log->cus_id = $payload['data']['object']['customer'];
        //         $log->sub_id = $payload['sub_id'];
        //         $log->payload = $payload;
        //         $log->save();
        //     }

        // }
    }
}
