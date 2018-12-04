<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(AddCartRequest $request) {
        $user   = $request->user();
        $skuId  = $request->input('sku_id');
        $quantity = $request->input('quantity');

        // 从数据库中查询该商品是否已经在购物车中
        if ($cart = $user->cartItems()->where('plan_product_sku_id', $skuId)->first()) {

            // 如果存在则直接叠加商品数量
            $cart->update([
                'quantity' => $cart->quantity + $quantity,
            ]);
        } else {

            // 否则创建一个新的购物车记录
            $cart = new CartItem(['quantity' => $quantity]);
            $cart->user()->associate($user);
            $cart->planProductSku()->associate($skuId);
            $cart->save();
        }

        return [];
    }
}
