@extends('layouts.default')

@section('header')
<br>
@stop

@section('content')
@inject('cart', 'App\Http\Controllers\CartController')
<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="well">
            <a href="{{ route('currency.us') }}" class="change-currency"><img src="/images/usd.png" width="50" style="margin-right:30px;"/></a>
            <a href="{{ route('currency.ca') }}" class="change-currency"><img src="/images/cad.png" width="50" style="margin-right:30px;"/></a>
            <a href="{{ route('currency.au') }}" class="change-currency"><img src="/images/aud.png" width="50" style="margin-right:30px;"/></a>
            <a href="{{ route('currency.eu') }}" class="change-currency"><img src="/images/eur.png" width="50" style="margin-right:30px;"/></a>
        </div>
    </div>

    <div class="row" style="bottom-margin: 8px;">
        <div class="col-sm-12">
            <h2 class="bold text-uppercase"><strong>Cart</strong>

                @if ($user->currency == 'usd')
                    <img src="/images/usd.png" width="40" style="margin-bottom:10px;"/>
                @elseif ($user->currency == 'cad')
                    <img src="/images/cad.png" width="40" style="margin-bottom:10px;"/>
                @elseif ($user->currency == 'aud')
                    <img src="/images/aud.png" width="40" style="margin-bottom:10px;"/>
                @elseif ($user->currency == 'eur')
                    <img src="/images/eur.png" width="40" style="margin-bottom:10px;"/>
                @endif

@if (count($user->cartItems()->get()) > 0)
                <a href="{{ route('shop.cart-clear') }}" class="btn btn-xs btn-info pull-right" id="clear-cart"><i class="fa fa-trash"></i> Clear Cart</a>
@endif
            </h2>
        </div>
    </div>

    <form method="POST" action="{{ route('shop.pay') }}" accept-charset="UTF-8" class="form-horizontal form-bordered" id="cart-form">
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
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- <a href="/plans/add-plan" class="btn btn-xs btn-primary" id="add-plan"> -->
                <a href="{{ route('plans.add') }}" class="btn btn-xs btn-primary" id="add-plan">
                    <span class="glyphicon glyphicon-signal"></span>
                    Add another Plan
                </a>
                <a href="{{ route('shop.editcard') }}" class="btn btn-xs btn-info" id="edit-card">
                    <i class="fa fa-credit-card"> </i>
                    Input Credit Card Details
                </a>
@if (($user->stripe_id) && (count($user->cartItems()->get()) > 0))
                <a class="btn btn-xs btn-success pull-right" id="btn-paynow">
                    <!-- <i class="fa fa-bolt"></i> Pay Now [Visa ****4242,  Expiry 1/2019] -->
                    <i class="fa fa-bolt"></i> Pay Now [{{ $user->card_brand }} ****{{ $user->card_last_four }}]
                </a>
@endif
            </div>
        </div>
    </form>
    <hr>
</div>
@stop

@section('javascript')
<script>
    $('#btn-paynow').on('click', function() {
        //$("#overlay-back").hide();
        $(this).attr('disabled', 'disabled');
        $("#clear-cart").attr('disabled', 'disabled');
        $("#add-plan").attr('disabled', 'disabled');
        $("#edit-card").attr('disabled', 'disabled');
        $(".remove-item").attr('disabled', 'disabled');
        $(".change-currency").attr('disabled', 'disabled');
        $("#overlay-back").hide();
        $("#overlay-back").removeClass('hidden');
        $('.overlay-back-class').show();
        $("#cart-form").submit();
    });
</script>
@stop
