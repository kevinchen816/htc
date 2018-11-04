@extends('layouts.default')

@section('header')
<div class="container">
<div class="row">
    <h4>
        <ol class="breadcrumb">
            <li class="active">My Account ({{ $user->email }})</li>
        </ol>
    </h4>
</div>
</div>
@stop

@section('content')
<div id="app">

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

                        <li class={{ ($user->sel_account_tab == 'plans') ? "active" : "" }}>
                            <a href="#data-plans" data-toggle="tab" data-tab="plans" aria-expanded="true"><span class="glyphicon glyphicon-signal"> </span> My Plans</a>
                        </li>

                        <li class={{ ($user->sel_account_tab == 'billing') ? "active" : "" }}>
                            <a href="#billing" data-toggle="tab" data-tab="billing" aria-expanded="false"><span class="glyphicon glyphicon-credit-card"> </span> Billing</a>
                        </li>

                        <li class={{ ($user->sel_account_tab == 'remote') ? "active" : "" }}>
                            <a href="#remote" data-toggle="tab" data-tab="remote" aria-expanded="true"><span class="glyphicon glyphicon-link"> </span> Devices</a>
                        </li>

                        <li class={{ ($user->sel_account_tab == 'security') ? "active" : "" }}>
                            <a href="#security" data-toggle="tab" data-tab="security" aria-expanded="false"><span class="glyphicon glyphicon-paperclip"> </span> Options</a>
                        </li>

                        <li class={{ ($user->sel_account_tab == 'email') ? "active" : "" }}>
                            <a href="#email-setup" data-toggle="tab" data-tab="email" aria-expanded="true"><span class="glyphicon glyphicon-list-alt"> </span> Email Setup</a>
                        </li>

                        <!--<li !! $tabs['addplan'] ? 'class="active"' : ' ' !!><a href="#add-prepaid-plan" data-toggle="tab" data-tab="addplan" aria-expanded="true"><span class="glyphicon glyphicon-plus-sign"> </span> Add Prepaid Plans</a></li>-->
                    </ul>

                    <div id="ProfilebContent" class="tab-content "  style="margin-bottom:30px;">
                        <!-- TAB - My Plans  -->
                        <div class="tab-pane fade {{ ($user->sel_account_tab == 'plans') ? 'active in' : '' }}" id="data-plans">
                        @include('account._plans')
                        </div>

                        <!-- TAB - Billing  -->
                        <div class="tab-pane fade {{ ($user->sel_account_tab == 'billing') ? 'active in' : '' }}" id="billing">
                        @include('account._billing')
                        </div>

                        <!-- TAB - Devices  -->
                        <div class="tab-pane fade {{ ($user->sel_account_tab == 'remote') ? 'active in' : '' }}" id="remote">
                        @include('account._devices')
                        </div>

                        <!-- TAB - Options  -->
                        <div class="tab-pane fade {{ ($user->sel_account_tab == 'security') ? 'active in' : '' }}" id="security">
                        @include('account._options')
                        </div>

                        <!-- TAB - Email Setup  -->
                        <div class="tab-pane fade {{ ($user->sel_account_tab == 'email') ? 'active in' : '' }}" id="email-setup">
                        @include('account._emails')
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
                _token: '{{ csrf_token() }}',
                tab: tabname,
                portal: {{ $portal }},
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

</div>
@stop