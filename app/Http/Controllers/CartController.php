<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;

use App\Models\Plan;
use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\PlanHistory;
use App\Models\Order;
use App\Models\OrderItem;

use Carbon\Carbon;
use Laravel\Cashier\Cashier;
use Auth;
use Debugbar;

class CartController extends Controller
{
    // public function postAddCardX(AddCartRequest $request) {
    //     $user   = $request->user();
    //     $skuId  = $request->input('sku_id');
    //     $quantity = $request->input('quantity');

    //     // 从数据库中查询该商品是否已经在购物车中
    //     if ($cart = $user->cartItems()->where('plan_product_sku_id', $skuId)->first()) {

    //         // 如果存在则直接叠加商品数量
    //         $cart->update([
    //             'quantity' => $cart->quantity + $quantity,
    //         ]);
    //     } else {

    //         // 否则创建一个新的购物车记录
    //         $cart = new CartItem(['quantity' => $quantity]);
    //         $cart->user()->associate($user);
    //         $cart->planProductSku()->associate($skuId);
    //         $cart->save();
    //     }

    //     return [];
    // }

    /*----------------------------------------------------------------------------------*/
    public function getShopCart() {
        $user = Auth::user();
        $data['sel_menu'] = 'cart';
        $user->update($data);
        return view('shop.cart', compact('user'));
    }

    public function html_ShopCart($user) {
        $region = array(
            'us' => 'USA',
            'ca' => 'Canada',
            'eu' => 'Europe',
            'au' => 'Australia',
        );

        $img_region = array(
            'us' => '/images/usd.png',
            'ca' => '/images/cad.png',
            'eu' => '/images/eur.png',
            'au' => '/images/aud.png',
        );

        $currency_symbol_region = array(
            'us' => '$',
            'ca' => '$',
            'eu' => '€',
            'au' => '$',
            // 'gb' => '£', // gbp
        );

        $txt = '';
        $total = 0;
        // return $user->cartItems()->count();

        // $cart = $user->cartItems()->first();
        // $sku = $cart->planProductSku()->get();
        // return dd($sku);
        // return $sku[0]->price;

        // $product = $user->cartItems()->first()->planProductSku()->product(); // NG

        $carts = $user->cartItems()->get();
        foreach ($carts as $cart) {
            // $cart_id = 'db9eb667c48190b1dcccad1fec678ed40'; // TODO
            $cart_id = $cart->id;
            $iccid = $cart->iccid;
            $quantity = $cart->quantity;

            /* Plan Product SKU */
            $sku_id = $cart->plan_product_sku_id;
            // $price = $cart->planProductSku()->price; // NG
            $sku = $cart->planProductSku()->get()[0];
            $month = $sku->month;
            $price = $sku->price;

            /* Plan Product */
            // $product_id = $sku->plan_product_id;
            $product = PlanProduct::find($sku->plan_product_id);
            $txt_region = $img_region[$product->region];
            $txt_currency = $currency_symbol_region[$product->region];

            $subtotal = $quantity * $price;
            $total += $subtotal;

            // SILVER - 5000 Points per Month
            // 12.95 per Month
            // $title = $region[$product->region].' '.$product->title;
            $title = $product->title.' - '.$product->points.' Points per Month';
            $title .= ' <img src="'.$txt_region.'" width="30" style="margin-bottom:10px;"/>';
            if ($month == 1) {
                $title2 = $price.' per Month';
            } else {
                $title2 = $price.' for '.$month.' Months';
            }
            $title2 = $txt_currency.$title2;

            $txt .= '<input name="rowId[]" type="hidden" value="'.$cart_id.'">';
            $txt .= '<tr>';
            $txt .=     '<td class="col-sm-4" >';
            $txt .=         $title.'<br/>';
            $txt .=         $title2.'<br/>';
            $txt .=         'ICCID: '.$iccid;
            $txt .=         '<br/>';

            /* for test b */
            // $txt .=         'SKU ID: '.$sku_id.'<br/>';
            // $txt .=         $month.' month<br/>';
            // $txt .=         $price.'<br/>';
            // $txt .=         'Product ID: '.$sku->plan_product_id.'<br/>';
            // $txt .=         $product->title.'<br/>';
            // $txt .=         $points.'<br/>';
            /* for test e */

            $txt .=     '</td>';
            $txt .=     '<td class="col-sm-1">';
            // $txt .=         <!--<input type="text" name="qty[]" value="1" maxlength="03" class="form-control input-sm">-->
            $txt .=         $quantity;
            $txt .=     '</td>';
            $txt .=     '<td  class="col-sm-2" style="text-align:right">'.$txt_currency.$price.'</td>';
            $txt .=     '<td class="col-sm-1"></td>';
            $txt .=     '<td class="col-sm-1" style="text-align:right">'.$txt_currency.$price*$quantity.'</td>';
            $txt .=     '<td class="col-sm-1">';
            $txt .=         '<a href="/shop/cart-remove/'.$cart_id.'" class="btn btn-xs btn-warning remove-item" title="Remove Item">';
            $txt .=             '<i class="fa fa-times" ></i>';
            $txt .=         '</a>';
            $txt .=     '</td>';
            $txt .= '</tr>';
        }
        if ($carts->count() > 0) {
            $txt .= '<tr>';
            $txt .=     '<td></td>';
            $txt .=     '<td></td>';
            $txt .=     '<td></td>';
            $txt .=     '<td class="col-sm-1" style="text-align:right"><strong>Total:</strong></td>';
            $txt .=     '<td class="col-sm-1" style="text-align:right"><strong>'.$txt_currency.$total.'</strong></td>';
            $txt .=     '<td></td>';
            $txt .= '</tr>';
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    public function getShopEditCard() {
        $user = Auth::user();
        // $data['sel_menu'] = 'cart';
        // $user->update($data);
        $next = 'cart';
        return view('shop.editcard', compact('user', 'next'));
    }

    public function getShopCartRemove($cart_id) {
        // $db = CartItem::find($cart_id);
        // $bool = $db->delete();
        $num = CartItem::destroy($cart_id);
        return redirect()->back();
    }

    public function getShopCartClear() {
        $user = Auth::user();
        $num = CartItem::where('user_id', $user->id)->delete();
        return redirect()->back();
    }

    /*----------------------------------------------------------------------------------*/
    public function getCurrencyUS() {
        Auth::user()->update(['currency' => 'usd']);
        return redirect()->back();
    }

    public function getCurrencyCA() {
        Auth::user()->update(['currency' => 'cad']);
        return redirect()->back();
    }

    public function getCurrencyAU() {
        Auth::user()->update(['currency' => 'aud']);
        return redirect()->back();
    }

    public function getCurrencyEU() {
        Auth::user()->update(['currency' => 'eur']);
        return redirect()->back();
    }

    /*----------------------------------------------------------------------------------*/
    public function _paySubscriptionX() {
        // $plan = Plan::where('iccid', $iccid)->first();

        /* Stripe - subscribe plan */
        // // if ($plan->auto_bill) {
        // //     $ret = $user->newSubscription($iccid, $sub_plan)->create();
        // // } else {
        // //     $ret = $user->newSubscription($iccid, $sub_plan)->create()->cancel();
        // // }
        // // // $ret = $user->newSubscription($iccid, $sub_plan)
        // // //             ->trialDays(10)
        // // //             ->withMetadata(['order_id' => 5678])
        // // //             ->create();

        // $subscription = \Stripe\Subscription::create([
        //     'customer' => $user->stripe_id,
        //     'items' => [
        //         [
        //             'plan' => $sub_plan,
        //         ],
        //     ],
        //     'metadata' => [
        //         'order_sn' => $order->no,
        //         'iccid' => $iccid,
        //     ],
        //     'prorate' => false,
        //     'cancel_at_period_end' => ($plan->auto_bill) ? false : true,
        //     // 'billing_cycle_anchor' => 1546272000, // 2019-01-01 00:00:00
        // ]);

        // if ($subscription->status == 'active') {
        //     $plan->status = 'active';
        //     $plan->points = $points * $month;
        //     $plan->points_used = 0;
        //     $plan->sub_id = $subscription->id;
        //     $plan->sub_start = date('Y-m-d H:i:s', $subscription->current_period_start);
        //     $plan->sub_end = date('Y-m-d H:i:s', $subscription->current_period_end);
        //     $plan->renew_plan = $sub_plan;
        //     $plan->update();
        //     $cart->delete();
        // }
    }

    public function savePlanHistory($event, $plan, $order) {
        $ph = new PlanHistory();
        $ph->iccid = $plan->iccid;
        $ph->user_id = $plan->user_id;

        $ph->event = $event; //'create';
        $ph->status = 'success';
        $ph->points = $plan->points;
        // $ph->points_reserve = 0;

        $ph->sub_plan = $plan->sub_plan; // au_5000_1m
        $ph->sub_id = $plan->sub_id; // sub_EAh5xs7HT6ObHB
        $ph->sub_start = $plan->sub_start; // sub_EAh5xs7HT6ObHB
        $ph->sub_end = $plan->sub_end; // sub_EAh5xs7HT6ObHB

        $ph->pay_invoice = $order->pay_invoice;
        $ph->pay_method = $order->pay_method;
        $ph->pay_no = $order->pay_no; // ch_1Dhj6kG8UgnSL68UWvvUcJIU
        $ph->pay_info = $order->pay_info; //json_encode($data['source']);
        $ph->pay_at = $order->pay_at;
        $ph->save();
    }

    public function updateOrder($order, $charge_id) {
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        /* status = succeeded, pending, or failed */
        $charge = \Stripe\Charge::retrieve($charge_id);
        if ($charge && ($charge->status == 'succeeded')) {
            $pay_at = date_create();
            date_timestamp_set($pay_at, $charge->created);

            $order->pay_invoice = $charge->invoice;
            $order->pay_method = $charge->source['brand']; // Visa
            $order->pay_no = $charge->id;
            $order->pay_info = json_encode($charge->source); // JSON
            // $order->pay_currency = $charge->currency;
            // $order->pay_amount = $charge->amount;
            // $order->card_id = $charge->source['id'];
            // $order->name = $charge->source['name'];
            // $order->card = $charge->source['brand'];
            // $order->last4 = $charge->source['last4'];
            // $order->exp_month = $charge->source['exp_month'];
            // $order->exp_year = $charge->source['exp_year'];
            // $order->country = $charge->source['country'];
            $order->pay_at = $pay_at;
            $order->closed = true;
            $order->save();
            return 'success';
        }
        return $charge ? $charge->status : 'fail';
    }

    // public function createSubscription($item) {
    // public function createSubscription($iccid, $plan_product_sku_id) {
    // public function createSubscription($iccid, $sub_plan, $points, $month) {
    public function createSubscription($order, $order_item) {
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $iccid = $order_item['iccid'];
        $sub_plan = $order_item['sub_plan'];
        $month = $order_item['month'];
        $points = $order_item['points'];

        $user = Auth::user();
        $plan = Plan::where('iccid', $iccid)->first();

        /* Plan Product SKU */
        // $sku = PlanProductSku::find($plan_product_sku_id);
        // $sub_plan = $sku->sub_plan; // 'au_5000_1m'
        // $month = $sku->month;

        /* Plan Product */
        // $product = PlanProduct::find($sku->plan_product_id);
        // $points = $product->points;

        // $trial_end = Carbon::now()->addMonth($month)->timestamp;
        $pay_at = new Carbon($order->pay_at);
        if ($sub_plan == 'au_5000_1d') {
            $trial_end = $pay_at->addDay(1)->timestamp; // for test
        } else {
            $trial_end = $pay_at->addMonth($month)->timestamp;
        }

        $subscription = \Stripe\Subscription::create([
            'customer' => $user->stripe_id,
            'items' => [
                ['plan' => $sub_plan]
            ],
            'metadata' => [
                'iccid' => $iccid,
            ],
            'prorate' => false,
            'cancel_at_period_end' => $plan->auto_bill ? false : true,
            'trial_end' => $trial_end, //1548780000
            // 'billing_cycle_anchor' => $trial_end,
        ]);

        /* status = trialing, active, past_due, canceled, or unpaid */
        // if ($subscription && ($subscription->status == 'active')) {
        if ($subscription && ($subscription->status == 'trialing')) {
            // // $subscription = \Stripe\Subscription::retrieve($subscription->id);
            // $subscription = \Stripe\Subscription::update($subscription->id , [
            //     'trial_end' => $subscription->current_period_end,
            // ]);
            $plan->status = 'active';
            $plan->points = $points * $month;
            $plan->points_used = 0;
            $plan->sub_id = $subscription->id;
            $plan->sub_start = date('Y-m-d H:i:s', $subscription->current_period_start);
            $plan->sub_end = date('Y-m-d H:i:s', $subscription->current_period_end);
            $plan->renew_plan = $sub_plan;
            $plan->update();

            /* Plan History */
            $this->savePlanHistory('create', $plan, $order);
        }
        return $subscription;
    }

    /*
        {
            "_token":"xxxx",
            "rowId":[
                "db9eb667c48190b1dcccad1fec678ed40",
                "db9eb667c48190b1dcccad1fec678ed40",
                "db9eb667c48190b1dcccad1fec678ed40",
                "b9eb667c48190b1dcccad1fec678ed40",
                "aca3ae0c296c8ce863a7d51d0dbb221c"
            ]
        }
    */
    /*
        Your Credit card was charged successfully.
        Date: 2018/12/05 20:26:35
        Invoice: 00026
        Charge ID: ch_1De6x4HMprYyJrNboyBNyQkm
        Card: Visa, 4242, 1/2019
        Total: 8.50

        (1) Points Reserve: For IccID: 8944503540145562672 8.50
    */
    public function postShopPay(Request $request) {
        // {"_token":"xxxx","rowId":["5","6"]}
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $currency = $user->currency;

        // Cashier::useCurrency('eur', '€');
        Cashier::useCurrency($currency);

        /* Create Order */
        $order = new Order([
            // 'address'      => [ // 将地址信息放入订单中
            //     'address'       => $address->full_address,
            //     'zip'           => $address->zip,
            //     'contact_name'  => $address->contact_name,
            //     'contact_phone' => $address->contact_phone,
            // ],
            // 'remark'       => $request->input('remark'),
            'total_amount' => 0,
        ]);
        $order->user()->associate($user); // 订单关联到当前用户
        $order->save();

        $total_amount = 0;
        $rows = $request->rowId;
        foreach ($rows as $row_id) {
            // $cart_id = $row_id;
            $cart = CartItem::find($row_id);
            if ($cart) {
                $iccid = $cart->iccid;
                $quantity = $cart->quantity;

                /* Plan Product SKU */
                // $sku = $cart->planProductSku()->get()[0];
                $sku = PlanProductSku::find($cart->plan_product_sku_id);
                $month = $sku->month;
                $price = $sku->price;
                $sub_plan = $sku->sub_plan; // 'au_5000_1m'

                /* Plan Product */
                $product = PlanProduct::find($sku->plan_product_id);
                $points = $product->points;

                /* Create Order Item */
                $item = $order->items()->make([
                    'quantity' => $quantity,
                    'price'  => $price,
                    'iccid' => $iccid,
                    'sub_plan' => $sub_plan,
                    'points' => $points,
                    'month' => $month,
                ]);
                $item->planProduct()->associate($sku->plan_product_id); // function name must be planProduct
                $item->planProductSku()->associate($sku); // function name must be planProductSku
                $item->save();

                /* create Invoice Item */
                // SILVER 5000 Points per Month - for 1 Month
                // SILVER 5000 for 1 Month
                $txt_month = ($month > 1) ? 'Months' : 'Month';
                $description = $product->title.' '.$points.' Points per Month - for '.$month.' '.$txt_month;
                $amount = $quantity * $price;
                $total_amount += $amount;
                \Stripe\InvoiceItem::create([
                    "customer" => $stripe_id,
                    "amount" => $amount*100,
                    "currency" => $product->currency, //$currency,
                    "description" => $description, //"SILVER 5000 Points per Month - for 1 Month",
                    'metadata' => [
                        'order_no' => $order->no,
                        'iccid' => $iccid,
                        'plan' => $sub_plan,
                    ],
                ]);

                /* delete Cart Item */
                $cart->delete();

                /* Plan */
                // $this->_paySubscriptionX();
            }
        }

        $order->update(['total_amount' => $total_amount]);

        /* create Invoice & Pay */
        $invoice = \Stripe\Invoice::create([
            "customer" => $stripe_id,
            "auto_advance" => false, /* true: auto-finalize this draft after ~1 hour */
            'metadata' => [
                'order_no' => $order->no,
            ],
        ]);
        if ($invoice) {
            $ret = $invoice->pay();
            // echo $ret->charge.'<br/>';      // ch_1Di2cYG8UgnSL68U1YxHtDxP
            // echo $ret->paid.'<br/>';        // true
            // echo $ret->status.'<br/>';      // paid (draft, open, paid, uncollectible, or void)
            if ($ret->status == 'paid') {
                $result = $this->updateOrder($order, $ret->charge);
                // if ($result == 'success') {
                    $order = Order::where('no', $order->no)->first();
                    $order_items = OrderItem::where('order_id', $order->id)->get();
                    foreach ($order_items as $order_item) {
                        $subscription = $this->createSubscription($order, $order_item);
                        // if (!$subscription) { send email }
                    }
                // }
            } else { // ($ret->status == 'paid')
                session()->flash('danger', 'Invoice Pay Fail');
            }
        } else {
            session()->flash('danger', 'Invoice Create Fail');
        }
return redirect()->route('account.profile');

        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        // $charge = \Stripe\Charge::create([
        //     'amount' => $total*100, //10000,
        //     'currency' => $currency, //'usd',
        //     'description' => 'Example charge',
        //     'customer' => $stripe_id, //'cus_DvGvznoT2EBbyn',
        // ]);

        // // ch_1De8vuG8UgnSL68UVaYHBGl7
        // // $charge = $user->charge($total*100);
        // $charge = $user->charge($total*100, [
        //     // 'source' => $token,
        //     'receipt_email' => $user->email,
        //     // 'custom_option' => $value,
        // ]);

        // // if (!$charge) {
        // // }
        // // try {
        // //     $response = $user->charge(100);
        // // } catch (Exception $e) {
        // //     //
        // // }
// echo $charge->id.'<br/>';
// echo $charge->amount.'<br/>';
// echo $charge->status.'<br/>';
// return dd($charge);

// in_1De8vxG8UgnSL68Ubd5vOvh1
        // Payment for invoice ED0214E-0001 – ch_1De8vyG8UgnSL68UhmxYH7h2
        // $invoice = $user->invoiceFor('One Time Fee', $total*100);
        // $user->invoiceFor('One Time Fee', 500, [
        //     'custom-option' => $value,
        // ]);
// return dd($invoice);

// $user->subscription($iccid)->swap('au_5000_1m');
// $user->subscription('monthly')->resume($creditCardToken);
// if ($user->onTrial()) {}

// $user->trial_ends_at = Carbon::now()->addDays(14);
// $user->save();

        // session()->flash('success', 'Charge Success');
        // return redirect()->back();
    }

    /*----------------------------------------------------------------------------------*/
    /* for test */ /* https://laravelacademy.org/post/1432.html */
    public function getInvoice() {
        $user = Auth::user();
        $invoices = $user->invoices();
        // $invoices = $user->invoicesIncludingPending(); // Include pending invoices in the results...
        // return dd($invoices);
// return count($invoices);

        /*
            <table>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                        <td>{{ $invoice->total() }}</td>
                        <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $invoice->id }}
            {{ $invoice->dateString() }}
            {{ $invoice->dollars() }}
        */
        $txt = '';
        $txt .= '<table>';
        foreach ($invoices as $invoice) {
            $txt .= '<tr>';
                $txt .= '<td>'.$invoice->date()->toFormattedDateString().'</td>';
                $txt .= '<td>'.$invoice->total().'</td>';
                $txt .= '<td><a href="/invoice/'.$invoice->id.'">Download</a></td>';
                $txt .= '<td>'.$invoice->id.'</td>';
                // $txt .= '<td>'.$invoice->dateString().'</td>'; // NG
                // $txt .= '<td>'.$invoice->dollars().'</td>';
            $txt .= '</tr>';
        }
        $txt .= '</table>';
return $txt;


        // if ($user->subscribed()) {
        if ($user->subscribed()) {
            return 'Subscribed';
        } else {
            return 'No Subscribed';
        }
    }

    public function getInvoiceDownload($invoiceId) {
        // Gold Member_12_2018.pdf
        return Auth::user()->downloadInvoice($invoiceId, [
            'vendor'  => 'KMCam Pro',
            'product' => 'Gold Member',
        ]);
    }

    public function getInvoiceTest() {
        // Gold Member_12_2018.pdf
        $invoiceId = 'in_1De8LCG8UgnSL68UgRJeFTZw';
        return Auth::user()->downloadInvoice($invoiceId, [
            'vendor'  => 'KMCam Pro',
            'product' => 'Gold Member',
        ]);
    }

}
