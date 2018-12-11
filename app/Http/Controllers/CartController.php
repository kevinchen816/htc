<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;

use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\Order;

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
            $product_id = $sku->plan_product_id;
            $product = PlanProduct::find($product_id);
            $title = $product->title;
            $points = $product->points;

            $subtotal = $quantity * $price;
            $total += $subtotal;

                // $product = $cart->planProductSku()->get()->product()->get(); // NG
                // $product = $cart->planProductSku()->get()->product(); // NG
                // $product = $cart->planProductSku()->product(); // NG
                // echo dd($product);
                // $title = $product->title();

            // $title = 'Points Reserve';
            // $title = $product->title.' ('.$points.' Points per Month) - for '.$month.' month(s)';
            $title = $product->title;
            $title2 = $points.' Points per Month - for '.$month.' month(s)';

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
            // $txt .=         'Product ID: '.$product_id.'<br/>';
            // $txt .=         $product->title.'<br/>';
            // $txt .=         $points.'<br/>';
            /* for test e */

            $txt .=     '</td>';
            $txt .=     '<td class="col-sm-1">';
            // $txt .=         <!--<input type="text" name="qty[]" value="1" maxlength="03" class="form-control input-sm">-->
            $txt .=         $quantity;
            $txt .=     '</td>';
            $txt .=     '<td  class="col-sm-2" style="text-align:right">'.$price.'</td>';
            $txt .=     '<td class="col-sm-1"></td>';
            $txt .=     '<td class="col-sm-1" style="text-align:right">'.$price*$quantity.'</td>';
            $txt .=     '<td class="col-sm-1">';
            $txt .=         '<a href="/shop/cart-remove/'.$cart_id.'" class="btn btn-xs btn-warning remove-item" title="Remove Item">';
            $txt .=             '<i class="fa fa-times" ></i>';
            $txt .=         '</a>';
            $txt .=     '</td>';
            $txt .= '</tr>';


        }
        $txt .= '<tr>';
        $txt .=     '<td></td>';
        $txt .=     '<td></td>';
        $txt .=     '<td></td>';
        $txt .=     '<td class="col-sm-1" style="text-align:right"><strong>Total:</strong></td>';
        $txt .=     '<td class="col-sm-1" style="text-align:right"><strong>'.$total.'</strong></td>';
        $txt .=     '<td></td>';
        $txt .= '</tr>';
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    public function getShopEditCard() {
        $user = Auth::user();
        // $data['sel_menu'] = 'cart';
        // $user->update($data);
        return view('shop.editcard', compact('user'));
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
// return $request;
 // return dd($request);
 // return dd($request->user());
 // return $request->user()->email;

        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $currency = $user->currency;

        /* Create Order */
        $order   = new Order([
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

        $total = 0;
        $rows = $request->rowId;
        foreach ($rows as $row_id) {
            $cart_id = $row_id;

            $cart = CartItem::find($cart_id);
            $iccid = $cart->iccid;
            $quantity = $cart->quantity;

            /* Plan Product SKU */
            // $sku_id = $cart->plan_product_sku_id;
            $sku = $cart->planProductSku()->get()[0];
            $month = $sku->month;
            $price = $sku->price;
            $sub_id = $sku->sub_id; // 'au_5000_1m'

            /* Plan Product */
            $product_id = $sku->plan_product_id;
            $product = PlanProduct::find($product_id);
            $title = $product->title;
            $points = $product->points;

            $subtotal = $quantity * $price;
            $total += $subtotal;

            /* Create Order Item */
            $item = $order->items()->make([
                'quantity' => $quantity,
                'price'  => $price,
            ]);
            // $item->product()->associate($sku->plan_product_id); // NG
            // $item->productSku()->associate($sku); // NG
            $item->planProduct()->associate($sku->plan_product_id); // function name must be planProduct
            $item->planProductSku()->associate($sku); // function name must be planProductSku
            $item->save();

            /* Stripe - subscribe plan */
            $subscription_name = $iccid; //'89860117851014783481'
            $plan_id = 'au_5000_1m'; // for test ($sub_id)
            // $ret = $user->newSubscription($subscription_name, $plan_id)->create();
            $ret = $user->newSubscription($subscription_name, $plan_id)->create()->cancel();

            // if (!$request['auto-bill']) {
            //    $user->newSubscription($subscription_name, $plan_id)->create()->cancel();
            // } else {
            //    $user->newSubscription($subscription_name, $plan_id)->create();
            // }
            // // $user->subscription($subscription_name)->cancel();

            // // $user->newSubscription('main', 'monthly')->create($stripeToken, [
            // //     'email' => $email,
            // // ]);

        }

        $order->update(['total_amount' => $total]);
// return 'OK';
return dd($ret);

        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        // $charge = \Stripe\Charge::create([
        //     'amount' => $total*100, //10000,
        //     'currency' => $currency, //'usd',
        //     'description' => 'Example charge',
        //     'customer' => $stripe_id, //'cus_DvGvznoT2EBbyn',
        // ]);

        // Cashier::useCurrency('eur', '€');
        Cashier::useCurrency($currency);

        // // ch_1De8vuG8UgnSL68UVaYHBGl7
        // // $charge = $user->charge($total*100);
        // $charge = $user->charge($total*100, [
        //     // 'name' => 'Kevin Chen', //$user->card_name, // NG
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
// return dd($charge);


// in_1De8vxG8UgnSL68Ubd5vOvh1
        // Payment for invoice ED0214E-0001 – ch_1De8vyG8UgnSL68UhmxYH7h2
        // $invoice = $user->invoiceFor('One Time Fee', $total*100);
        // $user->invoiceFor('One Time Fee', 500, [
        //     'custom-option' => $value,
        // ]);
// return dd($invoice);

        echo $charge->id.'<br/>';
        echo $charge->amount.'<br/>';
        echo $charge->status.'<br/>';
        return; // $charge->id;

        // // $user->subscription('main')->swap('provider-plan-id');
        // $subscription_name = $iccid;
        // $new_plan = 'au_5000_1m';
        // $user->subscription($subscription_name)->swap($new_plan);

        // session()->flash('success', 'Charge Success');
        // return redirect()->back();

// $user->trial_ends_at = Carbon::now()->addDays(14);
// $user->save();

// $user->subscription('monthly')->resume($creditCardToken);
// if ($user->onTrial()) {}

    }

    // https://docs.golaravel.com/docs/5.0/billing/#invoices
    public function getShopTest() {
        $user = Auth::user();
        // $ret = $user->onTrial(); // 确认用户是否还在试用期间：
        // $ret = $user->cancelled(); // 确认用户是否曾经订购但是已经取消了服务 // NG
        // $ret = $user->onGracePeriod(); // 确认用户是否已经取消订单，但是服务还没有到期 // NG
        // $ret = $user->everSubscribed(); // 确认用户是否订购过应用程序里的方案 // NG
        $ret = $user->onPlan('monthly'); // 用方案 ID 来确认用户是否订购某方案 // OK
        // $ret = $user->onTrial();
return dd($ret);
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
