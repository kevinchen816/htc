@extends('layouts.default2')
@section('content')
<div id="app">
    @include('layouts._header2')

    <div class="fixed-navbar-container">
        <div class="container">
            <div class="row">
                <h4>
                    <ol class="breadcrumb">
                        <li class="active">My Account (kevin@10ware.com)</li>
                    </ol>
                </h4>
            </div>
        </div>
    </div>

    <style>
        .table.plan-table tr {
           height: 22px!important;
        }
        .table.plan-table td {
           padding: 4px!important;
        }

        #invoiceModal .modal-content
        {
          height:80vh;
          overflow:auto;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="tabs-account"  >
                    <ul class="nav nav-tabs" id="account-tabs">
                    <li><a href="#security" data-toggle="tab" data-tab="security" aria-expanded="false"><span class="glyphicon glyphicon-paperclip"> </span> Options</a></li>
                        <li  ><a href="#billing" data-toggle="tab" data-tab="billing" aria-expanded="false"><span class="glyphicon glyphicon-credit-card"> </span> Billing</a></li>
                        <li  ><a href="#email-setup" data-toggle="tab" data-tab="email" aria-expanded="true"><span class="glyphicon glyphicon-list-alt"> </span> Email Setup</a></li>
                        <li  ><a href="#data-plans" data-toggle="tab" data-tab="plans" aria-expanded="true"><span class="glyphicon glyphicon-signal"> </span> My Plans</a></li>
                        <!--<li !! $tabs['addplan'] ? 'class="active"' : ' ' !!><a href="#add-prepaid-plan" data-toggle="tab" data-tab="addplan" aria-expanded="true"><span class="glyphicon glyphicon-plus-sign"> </span> Add Prepaid Plans</a></li>-->
                        <li ><a href="#remote" data-toggle="tab" data-tab="remote" aria-expanded="true"><span class="glyphicon glyphicon-link"> </span> Devices</a></li>
                    </ul>

                    <div id="ProfilebContent" class="tab-content "  style="margin-bottom:30px;">

                        <!-- TAB - Options  -->
                        <div class="tab-pane fade active in " id="security">
                            <div class="col-md-6">
                                <div class="panel panel-default panel-primary custom-settings-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Account Options</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="https://portal.ridgetec.com/account/options" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
                                            {{ csrf_field() }}
                                            <label class="col-md-4 control-label" for="inputSmall">Date Format</label>
                                            <div class="col-md-8">
                                                <select date_format class="bs-select form-control input-sm"   name="date_format"><option value="m%2Fd%2FY+g%3Ai%3As+a" selected="selected">MM/DD/YYYY HH:MM:SS AM/PM (12 hours)</option><option value="m%2Fd%2FY+H%3Ai%3As">MM/DD/YYYY HH:MM:SS (24 hours)</option><option value="Y%2Fm%2Fd+g%3Ai%3As+a">YYYY/MM/DD HH:MM:SS AM/PM (12 hours)</option><option value="Y%2Fm%2Fd+H%3Ai%3As">YYYY/MM/DD HH:MM:SS (24 hours)</option><option value="d%2Fm%2FY+g%3Ai%3As+a">DD/MM/YYYY HH:MM:SS AM/PM (12 hours)</option><option value="d%2Fm%2FY+H%3Ai%3As">DD/MM/YYYY HH:MM:SS (24 hours)</option></select>
                                            </div>

                                            <label class="col-md-4 control-label" for="inputSmall">High-Res Gallery Thumbs</label>
                                            <div class="col-md-8" style="padding-top:16px;">
                                                <span class="button-checkbox">
                                                    <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                                                    <input type="checkbox" class="hidden" name="gallery_highres" id="gallery_highres"   />
                                                </span>
                                                <div class="help-block">
                                                    <p>Note: Selecting High-Res will cause your thumbnail gallery to load slower, but the thumbs will look better with fewer columns.
                                                    If you want the gallery to load faster (or use less of your data on a mobile device) do not check this option.</p>
                                                    <p><strong>The Default reccomended is Unchecked.</strong></p>
                                                </div>
                                            </div>
                                            <div class="pull-right"><button type="submit" class="btn btn-success btn-xs">Save</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default panel-primary custom-settings-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Security Options
                                            <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="security-options"><i class="fa fa-question"></i></a>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label pull-right" for="inputSmall">Password Reset</label>
                                            </div>
                                            <div class="col-md-7">
                                                <a href="/account/sendreset" class="btn btn-xs btn-success">Send Password Reset Email</a>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <p> </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <form method="POST" action="https://portal.ridgetec.com/account/email-change" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
                                                {{ csrf_field() }}
                                                <input name="current-email" type="hidden" value="kevin@10ware.com">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="email inputSmall">Change Email</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="email" maxlength="70" id="email" class="form-control input-sm" placeholder="Input New Email">
                                                        <button type="submit" class="btn btn-success btn-xs" name="email-change" value="update">Send Email Change request</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB - My Plans  -->
                        <div class="tab-pane fade  " id="data-plans">
                            <!--<div class="panel panel-default panel-primary custom-settings-panel">-->
                            <form method="POST" action="https://portal.ridgetec.com/account/data-plans" accept-charset="UTF-8" class="form-horizontal" role="form" id="data-plans-form">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well well-sm">
                                            <h4>
                                                My Camera Data Plans
                                                <span class="pull-right">
                                                    <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <!-- [1] -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <i class="fa fa-dot-circle"></i>
                                                    <span class="label label-info" style="font-size: 1.00em;">Prepaid 6 Months</span>
                                                    <span class="label label-success" style="font-size:0.9em;">Active</span>
                                                    <p>
                                                    </p>
                                                </div>

                                                <div class="col-md-5">
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table plan-table">
                                            <tbody>
                                                <tr>
                                                    <td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>
                                                    <td><strong>89886920042020212150</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>
                                                    <td>
                                                        <strong>(No Camera)</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">Plan Points:</td>
                                                    <td><strong>20000</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">Points Used:</td>
                                                    <td><strong>539.00</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">SMS Sent:</td>
                                                    <td><strong>0</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- [2] -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <i class="fa fa-dot-circle"></i>
                                                    <span class="label label-info" style="font-size: 1.00em;">Prepaid 6 Months</span>
                                                    <span class="label label-success" style="font-size:0.9em;">Active</span>
                                                    <p>
                                                    </p>
                                                </div>

                                                <div class="col-md-5">
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table plan-table">
                                            <tbody>
                                                <tr>
                                                    <td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>
                                                    <td><strong>8944503540145562672</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>
                                                    <td>
                                                        <strong>New Camera</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">Plan Points:</td>
                                                    <td><strong>20000</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">Points Used:</td>
                                                    <td><strong>511.50</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pull-right">SMS Sent:</td>
                                                    <td><strong>0</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>

                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="alert alert-info" style="margin-left: 20px; margin-right: 20px; background-color: #444">
                                        <strong><h4>Configuration Help</h4></strong>

                                        <h4>Auto-Bill</h4>
                                        <p>Select this option to have the system automatically renew your camera data plan at the selected Renewal Tier cost on its anniversary renewal date.
                                            Your credit card on file will be charged the data plan period cost.
                                            If you want your camera data plan to expire, then uncheck Auto-Bill and your camera will run out of Reserve Points (if any) and Suspend.
                                            You can then Renew the camera data plan at any time in the future.</p><hr>

                                        <h4>Auto-Reserve</h4>
                                        <p>Select this option to have the system automatically refill your Points Reserve any time they are running out.
                                            Your credit card on file will be charged a $10 fee automatically.
                                            This will ensure that you have continued service otherwise if your data plan runs out of points as well as your Points Reserve,
                                            your camera data plan will suspend.  You can then Renew the camera data plan at any time in the future.</p>
                                        <div class="alert alert-success">Note:  The points you purchase for the Reserve have no expiration and remain on your plan until used.</div>
                                    </div>
                                 </div>
                            </div>

                        </div> <!-- end tab -->

                        <!-- TAB - Billing  -->
                        <div class="tab-pane fade  " id="billing">
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

                                <form method="POST" action="https://portal.ridgetec.com/account/profile-billing" accept-charset="UTF-8" class="form-horizontal" role="form" id="payment-form">
                                    {{ csrf_field() }}

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
                                        var stripe = Stripe('pk_live_QPN3uXwIOGzb9gA2NDp1ZhVC');

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
                                                    //alert(result.error.message);
                                                    $('#form-errors').text(result.error.message);
                                                    $('#form-errors').removeClass('hidden');
                                                    $('#form-errors').show();
                                                    pmtform.find('btn-update').prop('disabled', false);
                                                }
                                                else {
                                                    //alert(result.token.id);
                                                    pmtform.append('<input type="hidden" name="stripeToken" id="stripe-token" value="" />');
                                                    $('#stripe-token').val(result.token.id);
                                                    $("#payment-form").submit();
                                                }
                                            });
                                        });

                                    });
                                </script>
                            </div>
                        </div>

                        <!-- TAB - Email Setup  -->
                        <div class="tab-pane fade  " id="email-setup" style="padding-top: 10px;">
                            <form method="POST" action="https://portal.ridgetec.com/account/profile-emails" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emails-form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-sm btn-primary">Save All Changes</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!--
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email 1</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="g1_email1" maxlength="70" value="test@gmail.com" id="g1_email1" class="form-control" placeholder="Input Email 1">
                                                    </div>
                                                </div>
                                                -->

                                                <div class="input-group" style="margin-bottom:8px;">
                                                    <input type="text" name="g1_email1" maxlength="70" value="test@gmail.com" id="g1_email1" class="form-control" placeholder="Input Email 1">
                                                    <div class="input-group-btn">
                                                        <button class="trash-email btn btn-default" style="background-color: #aaa;padding-top:12px!important;padding-bottom:12px!important;border: none;" input-id="g1_email1" title="Clear Email">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <!--
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email 10</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="g2_email5" maxlength="70" value="" id="g2_email5" class="form-control" placeholder="Input Email 10">
                                                    </div>
                                                </div>
                                                -->

                                                <div class="input-group" style="margin-bottom:8px;">
                                                    <input type="text" name="g2_email5" maxlength="70" value="" id="g2_email5" class="form-control" placeholder="Input Email 10">
                                                    <div class="input-group-btn">
                                                        <button class="trash-email btn btn-default" style="background-color: #aaa;padding-top:12px!important;padding-bottom:12px!important;border: none;" input-id="g2_email5" title="Clear Email"><i class="glyphicon glyphicon-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <!--
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email 11</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="g3_email1" maxlength="70" value="" id="g3_email1" class="form-control" placeholder="Input Email 11">
                                                    </div>
                                                </div>
                                                -->

                                                <div class="input-group" style="margin-bottom:8px;">
                                                    <input type="text" name="g3_email1" maxlength="70" value="" id="g3_email1" class="form-control" placeholder="Input Email 11">
                                                    <div class="input-group-btn">
                                                        <button class="trash-email btn btn-default" style="background-color: #aaa;padding-top:12px!important;padding-bottom:12px!important;border: none;" input-id="g3_email1" title="Clear Email"><i class="glyphicon glyphicon-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB - Devices  -->
                        <div class="tab-pane fade  " id="remote">
                            <form method="POST" action="https://portal.ridgetec.com/account/remote" accept-charset="UTF-8" class="form-horizontal" role="form" id="mobile-apps-form">
                            {{ csrf_field() }}
                                <div class="panel panel-default panel-primary custom-settings-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Mobile Devices
                                            <span class="pull-right"><button class="btn btn-xs btn-primary" type="submit">Save Changes</button></span>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Device Info</th>
                                                        <th>Confirmed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan=3>
                                                            <i class="fa fa-dot-circle" style="color:lime;"> </i>Android 7.1.2 Xiaomi MI 5X -77/1.1.4<br />
                                                            <span style="color:yellowgreen;">Last Active: 09/04/2018 6:48:03 pm</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="button-checkbox">
                                                                <button type="button" class="btn btn-default btn-xs" data-color="info">Notifications</button>
                                                                <input type="checkbox" class="hidden camera-select" name="sendnotify[]" value="77"  checked  />
                                                            </span>
                                                            <span class="button-checkbox">
                                                                <button type="button" class="btn btn-default btn-xs" data-color="info">Heartbeat Only</button>
                                                                <input type="checkbox" class="hidden camera-select" name="notifyonreport[]" value="77"   />
                                                            </span>
                                                        </td>

                                                        <td>
                                                            Yes
                                                            <a href="/account/mobilerevoke/77" class="btn btn-xs btn-warning"><i class="fa fa-times-circle"> </i> Block now</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="security-options" class="hidden">
        <div class="alert alert-sm alert-info help-container">
            <h4><strong>Security Options</strong>
            </h4>
            <p>
                The security options enable you to two things:
            </p>
            <ul>
                <li>Reset or Change your current password</li>
                <li>Change the email address associated with your account</li>
            </ul>

            <h5><strong>Password Reset</strong></h5>
            <p>
            To initiate a password change, simply click the <label class="label label-success">Send Password Reset Email</label> button.
            An email will be sent from the portal to your account email.  Click the link in the email to get to a password reset form. Once
            your input your new password correctly in the form and submit, your new password is in effect.  You will need to login again.<br />
            <br />
            The reason a reset is done this way is for security reasons.  Sending the email request is more secure and requires control over your email.
            </p>
            <hr>

            <h5><strong>Change Email</strong></h5>
            <p>
            In order to change the email address associated with your account, you will need to carefully input the new ewmail address,
            then click the <label class="label label-success">Send Email Change request</label> button.
            An email will be sent from the portal to your <strong>New</strong> account email.  Click the link in the email to finalize the change.
            You will need to login again.  Unless you actually click the Email Change link in the email, nothing will actually happen.
            Once again this is a more secure way of doing things and ensures that the email used is a valid email and that emails sent to
            that address from the portal actually make it to your inbox.
            <br />
            <br />
            <strong>If an email doesn't come in, check your spam folder.  You may be required to contact your IT department or ISP and have the portal domain white listed or "allowed".</strong>
        </p>

        </div>
    </div>

    <div id="invoiceModal" class="modal fade" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="panel panel-default panel-default">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="fa fa-shopping-cart"></i> Invoice Details
                        </span>
                        <button type="button" class="pull-right close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="panel-body">
                        <div id="view_details">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(function ($) {

            $('#password-reset').on('click', function (e) {
                        var url = "/account/sendreset";
                        $.get(url, function (data) {
                    //$( ".result" ).html( data );
                    //alert("Load was performed." + data);
                });

                $('#reset-password-notify').html('<br />Email sent to kevin@10ware.com');
            });

        });

        $('#tabs-account').on('click', '.tablink,#account-tabs a', function (e) {
            e.preventDefault();
            var tabname = $(this).attr("data-tab");

                var url = "/account/activetab";

            //alert('put tab ' + tabname);
            $.post(url,
            {
                tab: tabname,
            },
            function (data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
            });

        });

        $(".trash-email").on('click', function (e) {
            //alert('click');
            e.preventDefault();
            var id = $(this).attr("input-id");
            $('#' + id).val('');
        });

        $(".view-invoice").click(function () {
            var data = $(this).attr('data-invoice');
            $("#view_details").html(data);
            $('#invoiceModal').modal('show');
        });
    </script>

    <div id="help_panel" class="side-panel hidden" style="overflow-y: auto;">
        <div style="position: fixed;">
            <a class="btn btn-sm btn-default btn-info help_close" style="border-radius: 25px 0px 0px 25px;">
                <i class="fa fa-times"></i>
            </a>
        </div>
        <div id="help_content">
        </div>
    </div>
</div>
@stop