<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\LogStripe;

class WebhookController extends CashierController
{
    /**
     * Handle a Stripe webhook.
     *
     * @param  array  $payload
     * @return Response
     */
    public function handleInvoicePaymentSucceeded($payload) {
        // 处理事件
        // return var_dump($payload);
        return http_response_code(200); // PHP 5.4 or greater
    }

    //charge.succeeded
    public function handleChargeSucceeded($payload) {
        // return var_dump($payload);
        //return view('test');
        return http_response_code(200); // PHP 5.4 or greater
    }

    /*-----------------------------------------------------------*/
    //customer.subscription.created
    public function handleCustomerSubscriptionCreated($payload) {
// if($_SERVER['HTTP_HOST'] == 'example.com') {
//     Stripe::setApiKey("sk_live_my_key");
// } else {
//     Stripe::setApiKey("sk_test_my_key");
// }
// return $_SERVER['HTTP_HOST']; //sample.test
// return print_r($payload);

return new Response('Webhook Handled', 200);
        $user = User::first();
        $user->comfirmed = 'created';
        $user->sace();
        return http_response_code(200); // PHP 5.4 or greater
    }

    /*-----------------------------------------------------------*/
    public function handleSubscriptionScheduleCanceled($payload) {
        return http_response_code(200); // PHP 5.4 or greater
    }

    public function handleSubscriptionScheduleCompleted($payload) {
        /*
        $user = $this->getUserByStripeId($payload['data']['object']['id']);

        if ($user) {
            $user->subscriptions->each(function (Subscription $subscription) {
                $subscription->skipTrial()->markAsCancelled();
            });

            $user->forceFill([
                'stripe_id' => null,
                'trial_ends_at' => null,
                'card_brand' => null,
                'card_last_four' => null,
            ])->save();
        }

        return new Response('Webhook Handled', 200);
        */

        return http_response_code(200); // PHP 5.4 or greater
    }

    public function handleSubscriptionScheduleReleased($payload) {
        return http_response_code(200); // PHP 5.4 or greater
    }

    public function handleSubscriptionScheduleUpdated($payload) {
        return http_response_code(200); // PHP 5.4 or greater
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
