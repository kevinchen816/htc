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
// return new Response('Webhook Handled', 200);

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
                    // echo $data['id'].'</br>'; // for debug
                    // echo $data['lines']['data'][0]['plan']['id'].'</br>'; // for debug

                    $sku = PlanProductSku::where('sub_plan', $plan->renew_plan)->first();
                    $product = PlanProduct::find($sku->plan_product_id);
                    // echo $product->points.'</br>'; // for debug

                    /* Plan History */
                    $ph = new PlanHistory();
                    $ph->iccid = $plan->iccid;
                    $ph->user_id = $plan->user_id;

                    $ph->event = 'renew';
                    $ph->points = $product->points;
                    // $ph->points_reserve = 0;

                    $ph->sub_plan = $plan->renew_plan; // au_5000_1m
                    $ph->sub_id = $plan->sub_id; // sub_EAh5xs7HT6ObHB
                    $ph->pay_invoice = $plan->renew_invoice;
                    $ph->save();
                }
            }
        }
        // return http_response_code(200); // PHP 5.4 or greater
        return new Response('Webhook Handled', 200);
    }

    // public function handleInvoicePaymentSucceeded($payload) {
    //     // return http_response_code(200); // PHP 5.4 or greater
    //     return new Response('Webhook Handled', 200);
    // }

    /*----------------------------------------------------------------------------------*/
    public function handleChargeSucceeded($payload) {
// return new Response('Webhook Handled', 200);

        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $data = $payload['data']['object'];

            $plan = Plan::where('renew_invoice', $data['invoice'])->first();
            if ($plan) {
                $renew_plan = $plan->renew_plan;
                $sku = PlanProductSku::where('sub_plan', $renew_plan)->first();
                $product = PlanProduct::find($sku->plan_product_id);

                $subscription = \Stripe\Subscription::retrieve($plan->sub_id);
                $subscription = \Stripe\Subscription::update($subscription->id , [
                    'trial_end' => $subscription->current_period_end,
                ]);
                // echo $subscription; // for debug

                $plan->status = 'active';
                $plan->sub_plan = $renew_plan;
                $plan->points = $product->points * $sku->month;
                $plan->points_used = 0;
                // $plan->sub_id = $subscription->id;
                $plan->sub_start = date('Y-m-d H:i:s', $subscription->current_period_start);
                $plan->sub_end = date('Y-m-d H:i:s', $subscription->current_period_end);
                // $plan->renew_plan = $sub_plan;
                $plan->update();
            }

            $dt = date_create();
            date_timestamp_set($dt, $data['created']);

            $ph = PlanHistory::where('inv_id', $data['invoice'])->first();
            $ph->pay_method = $data['source']['brand'];
            $ph->pay_no = $data['id']; // ch_1Dhj6kG8UgnSL68UWvvUcJIU
            $ph->pay_info = json_encode($data['source']);
            $ph->pay_at = $dt;
            $ph->update();

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
