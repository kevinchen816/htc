@extends('layouts.default')

@section('header')
<br>
@stop

@section('content')
<div class="container">
        <style>
            /* Padding for Stripe Element containers */
            .stripe-element-container {
                padding-top: 1.0rem;
                padding-bottom: .50rem;
            }
            .help-block {
                color: lime!important;
            }
        </style>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default panel-primary custom-settings-panel">

                <div class="panel-heading">
                    <h4 class="panel-title">
                        Add Plan
                    </h4>
                </div>

                <div class="panel-body">

                        <div id="form-errors" class="alert alert-danger hidden">
                        </div>

                        <form method="POST" action="{{ route('add.plan') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="addplan-form">
                            {{ csrf_field() }}
                            <input name="portal" type="hidden" value="{{ $portal }}">
                            <input name="mode" type="hidden" value="new">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="iccid inputSmall">SIM ICCID</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ old('iccid') }}" name="iccid" maxlength="70" id="iccid" class="form-control input-sm" placeholder="Input ICCID">
                                </div>
                            </div>

@if (1)
                            <div class="form-group">
                                <label class="col-md-3 control-label">Data Plan</label>
                                <div class="col-md-8">
                                    <!--<select  class="bs-select form-control input-sm">-->
                                    <select  class="bs-select form-control input-sm">
                                        <!--<option value="p" selected="selected">Photo</option>-->
                                        <option value="plan_5000_1m">5000 Points per Month</option>
                                        <option value="plan_10000_1m">10000 Points per Month</option>
                                        <option value="plan_20000_1m">20000 Points per Month</option>
                                        <option value="plan_15000_3m">15000 Points for 3 Months</option>
                                        <option value="plan_30000_3m">30000 Points for 3 Months</option>
                                        <option value="plan_60000_3m">60000 Points for 3 Months</option>
                                    </select>
                                </div>
                            </div>
@endif

                            <!--<div class="form-group">
                                <label class="col-md-3 control-label">Cardholder Name</label>
                                <div class="col-md-6">
                                  <input name="cardholder-name" id="cardholder-name" class="field form-control input-sm" placeholder="Name on Card" value="" />
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-3 control-label">Cardholder Phone</label>
                                <div class="col-md-6">
                                  <input name="cardholder-phone" id="cardholder-phone" class="field form-control input-sm" type="tel" placeholder="(123) 456-7890"  value="" />
                                </div>
                            </div>-->

@if (1)
                             <div class="form-group">
                                <label class="col-md-3 control-label">Card Number</label>
                                <div class="col-md-6">
                                    <span id="card-number" class="form-control input-sm stripe-element-container">
                                        <!-- Stripe Card Element -->
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Card Expiry</label>
                                <div class="col-md-6">
                                    <span id="card-exp" class="form-control input-sm stripe-element-container">
                                        <!-- Stripe Card Element -->
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Card CVC</label>
                                <div class="col-md-6">
                                    <span id="card-cvc" class="form-control input-sm stripe-element-container">
                                        <!-- Stripe Card Element -->
                                    </span>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-primary btn-sm" name="src" value="update" id="btn-update">Update Card Info</button>
                                </div>
                            </div>-->
@endif

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary  btn-sm" name="submit-new-plan" value="update" id="btn-update">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function(){

        // Create a Stripe client
        var stripe = Stripe('pk_test_3eKxfF6P2wzBFYaowK8CVxBV');

        // Create an instance of Elements
        var elements = stripe.elements();

        // Try to match bootstrap 4 styling
        var style = {};

        // Card number
        var card = elements.create('cardNumber', {
            'placeholder': '',
            'style': style
        });
        card.mount('#card-number');

        // Card expiry
        var exp = elements.create('cardExpiry', {
            'placeholder': 'MM/YY',
            'style': style
        });
        exp.mount('#card-exp');

        // CVC
        var cvc = elements.create('cardCvc', {
            'placeholder': '###',
            'style': style
        });
        cvc.mount('#card-cvc');

        // Submit
        $('#btn-update').on('click', function(e){
            e.preventDefault();
            console.log('update button');
            pmtform =  $('#addplan-form');

            $('#form-errors').hide();

            //if (!$('#cardholder-name').val()) {
            //    $('#form-errors').removeClass('hidden');
            //    $('#form-errors').text('Cardholder Name is required.');
            //    $('#form-errors').show();
            //    return false;
            //}

            //if (!$('#cardholder-phone').val()) {
            //    $('#form-errors').removeClass('hidden');
            //    $('#form-errors').text('Cardholder Phone is required.');
            //    $('#form-errors').show();
            //    return false;
            //}

            // Disable the submit button to prevent repeated clicks
            pmtform.find('btn-update').prop('disabled', true);
            $('#form-errors').addClass('hidden');

//alert($('#name').val());

            var cardData = {
                'name': $('#name').val()
            };
//return;
            stripe.createToken(card, cardData).then(function(result) {
                //console.log(result);
                if (result.error && result.error.message) {
                    //alert(result.error.message);
                    $('#form-errors').text(result.error.message);
                    $('#form-errors').removeClass('hidden');
                    $('#form-errors').show();
                    pmtform.find('btn-update').prop('disabled', false);
                }
                else {
                    alert(result.token.id);
                    pmtform.append('<input type="hidden" name="stripeToken" id="stripe-token" value="" />');
                    $('#stripe-token').val(result.token.id);
                    $("#addplan-form").submit();
                }
            });
        });

    });
</script>
@stop