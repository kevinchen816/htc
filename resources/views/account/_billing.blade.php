<!--<div class="tab-pane fade" id="billing">-->
    <div class="col-md-9">
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

        <div class="alert alert-defaulto" style="background-color: #555;">
            <h4>Input and Update Credit Card Information</h4>
            <p>This is the <strong>default credit card</strong> charged for each active <strong>Pay-as-you-go</strong> data plan.
                Please fill in all values before clicking <strong>Update Card Info</strong>.
            </p>
        </div>

        <div id="form-errors" class="alert alert-danger hidden">
        </div>

        <form method="POST" action="{{ route('account.profile-billing') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="payment-form">
            {{ csrf_field() }}
            <input name="portal" type="hidden" value="{{ $portal }}">

            <div class="form-group">
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
            </div>

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

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-primary btn-sm" name="src" value="update" id="btn-update">Update Card Info</button>
                </div>
            </div>
        </form>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $(document).ready(function(){

                // Create a Stripe client
                var stripe = Stripe('pk_test_3eKxfF6P2wzBFYaowK8CVxBV');

                // Create an instance of Elements
                var elements = stripe.elements();

                // Try to match bootstrap 4 styling
                var style = {};
                /*
                var style = {
                    base: {
                        'fontSize': '1.11px',
                        'color': '#495057',
                        'fontFamily': 'apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif'
                    }
                };
                */

                // Card number
                var card = elements.create('cardNumber', {
                    'placeholder': '',
                    'style': style
                });
                card.mount('#card-number');

                // CVC
                var cvc = elements.create('cardCvc', {
                    'placeholder': '###',
                    'style': style
                });
                cvc.mount('#card-cvc');

                // Card expiry
                var exp = elements.create('cardExpiry', {
                    'placeholder': 'MM/YY',
                    'style': style
                });
                exp.mount('#card-exp');

                // Submit
                $('#btn-update').on('click', function(e){
                    e.preventDefault();
                    console.log('update button');
                    pmtform =  $('#payment-form');

                    $('#form-errors').hide();
                    if (!$('#cardholder-name').val()) {
                        $('#form-errors').removeClass('hidden');
                        $('#form-errors').text('Cardholder Name is required.');
                        $('#form-errors').show();
                        return false;
                    }

                    if (!$('#cardholder-phone').val()) {
                        $('#form-errors').removeClass('hidden');
                        $('#form-errors').text('Cardholder Phone is required.');
                        $('#form-errors').show();
                        return false;
                    }

                    // Disable the submit button to prevent repeated clicks
                    pmtform.find('btn-update').prop('disabled', true);
                    $('#form-errors').addClass('hidden');

                    var cardData = {
                        'name': $('#name').val()
                    };
                    stripe.createToken(card, cardData).then(function(result) {
                        console.log(result);
                        if (result.error && result.error.message) {
                            alert(result.error.message);
                            $('#form-errors').text(result.error.message);
                            $('#form-errors').removeClass('hidden');
                            $('#form-errors').show();
                            pmtform.find('btn-update').prop('disabled', false);
                        }
                        else {
                            alert(result.token.id);
                            pmtform.append('<input type="hidden" name="stripeToken" id="stripe-token" value="" />');
                            $('#stripe-token').val(result.token.id);
                            $("#payment-form").submit();
                        }
                    });
                });

            });
        </script>
    </div>
<!--</div>-->
