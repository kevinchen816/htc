<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;

use App\Models\PlanProduct;
use App\Models\PlanProductSku;

use Auth;

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
        // return $user->cartItems()->count();

        // $cart = $user->cartItems()->first();
        // $sku = $cart->planProductSku()->get();
        // return dd($sku);
        // return $sku[0]->price;

        // $product = $user->cartItems()->first()->planProductSku()->product(); // NG

        $carts = $user->cartItems()->get();
        foreach ($carts as $cart) {
            $cart_id = 'db9eb667c48190b1dcccad1fec678ed40'; // TODO

            $iccid = $cart->iccid;
            $quantity = $cart->quantity;

            /* Plan Product SKU*/
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
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    public function getShopEditCard() {
// return 'getShopEditCard';
        $user = Auth::user();
        // $data['sel_menu'] = 'cart';
        // $user->update($data);
        return view('shop.editcard', compact('user'));
    }

    public function getShopCartRemove() {
return 'getShopCartRemove';
    }

    public function getShopCartClear() {
return 'getShopCartClear';
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
    public function postShopPay(Request $request) {

return $request;
    }
}
