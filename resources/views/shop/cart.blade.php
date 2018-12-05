@extends('layouts.default')

@section('header')
<br>
@stop

@section('content')
@inject('cart', 'App\Http\Controllers\CartController')
<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="well">
            <a href="/currency/usd" class="change-currency"><img src="/images/usd.png" width="50" style="margin-right:30px;"/></a>
            <a href="/currency/cad" class="change-currency"><img src="/images/cad.png" width="50" style="margin-right:30px;"/></a>
            <a href="/currency/aud" class="change-currency"><img src="/images/aud.png" width="50" style="margin-right:30px;"/></a>
            <a href="/currency/eur" class="change-currency"><img src="/images/eur.png" width="50" style="margin-right:30px;"/></a>
        </div>
    </div>

    <div class="row" style="bottom-margin: 8px;">
        <div class="col-sm-12">
            <h2 class="bold text-uppercase"><strong>Cart</strong>
                <img src="/images/usd.png" width="40" style="margin-bottom:10px;"/>
                <a href="/shop/clearcart" class="btn btn-xs btn-info pull-right" id="clear-cart"><i class="fa fa-trash"></i> Clear Cart</a>
            </h2>
        </div>
    </div>

    <form method="POST" action="http://www.ridgetec.us/shop/collectpayment" accept-charset="UTF-8" class="form-horizontal form-bordered" id="cart-form">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-12">

                <table class="table table-striped table-condensed table-borderless">
                    <thead>
                        <tr>
                            <th class="col-sm-7">Product</th>
                            <th class="col-sm-1">
                                Quantity
                            </th>
                            <th class="col-sm-2" style="text-align:right">Price</th>
                            <th class="col-sm-1"  style="text-align:right"></th>
                            <th class="col-sm-1" style="text-align:right">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {!! $cart->html_ShopCart($user) !!}

                        <input name="rowId[]" type="hidden" value="b9eb667c48190b1dcccad1fec678ed40">
                        <tr>
                            <td class="col-sm-4" >
                                Points Reserve<br />IccID: 8944503540145562672
                            </td>
                            <td class="col-sm-1">
                                <!--<input type="text" name="qty[]" value="1" maxlength="03" class="form-control input-sm">-->
                                1
                            </td>
                            <td  class="col-sm-2" style="text-align:right">$10.00</td>
                            <td class="col-sm-1"></td>
                            <td class="col-sm-1" style="text-align:right">$10.00</td>
                            <td class="col-sm-1">
                                <a href="/shop/cart-remove/b9eb667c48190b1dcccad1fec678ed40" class="btn btn-xs btn-warning remove-item" title="Remove Item">
                                    <i class="fa fa-times" ></i>
                                </a>
                            </td>
                        </tr>

                        <input name="rowId[]" type="hidden" value="aca3ae0c296c8ce863a7d51d0dbb221c">
                        <tr>
                            <td class="col-sm-4" >
                                Points Reserve<br />IccID: 89860117851014783481                        </td>
                            <td class="col-sm-1">
                                <!--<input type="text" name="qty[]" value="1" maxlength="03" class="form-control input-sm">-->
                                1
                            </td>
                            <td  class="col-sm-2" style="text-align:right">$10.00</td>
                            <td class="col-sm-1"></td>
                            <td class="col-sm-1" style="text-align:right">$10.00</td>
                            <td class="col-sm-1">
                                <a href="/shop/cart-remove/aca3ae0c296c8ce863a7d51d0dbb221c" class="btn btn-xs btn-warning remove-item" title="Remove Item"><i class="fa fa-times" ></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="col-sm-1" style="text-align:right"><strong>Total:</strong></td>
                            <td class="col-sm-1" style="text-align:right"><strong>$20.00</strong></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- <a href="/plans/add-plan" class="btn btn-xs btn-primary" id="add-plan"> -->
                <a href="/plans/add" class="btn btn-xs btn-primary" id="add-plan">
                    <span class="glyphicon glyphicon-signal"></span>
                    Add another Plan
                </a>
                <a href="/shop/editcard" class="btn btn-xs btn-info" id="edit-card">
                    <i class="fa fa-credit-card"> </i>
                    Input Credit Card Details
                </a>
            </div>
        </div>
    </form>

    <hr>

</div>
@stop