<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;

class WebhookController extends CashierController
{
    /**
     * Handle a Stripe webhook.
     *
     * @param  array  $payload
     * @return Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        // 处理事件
        return var_dump($payload);
    }


    //charge.succeeded
    public function handleChargeSucceeded($payload)
    {
        // return var_dump($payload);
        //return view('test');
        return http_response_code(200); // PHP 5.4 or greater
    }
}
