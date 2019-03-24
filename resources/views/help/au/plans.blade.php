@extends('layouts.default')

@section('header')
<div class="container">
<div class="row">
    <h4>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Data Plan Information</li>
    </ol>
    </h4>
</div>
</div>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-primary default-help-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Getting Started with a Camera Data Plan</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!--<p>Ridgetec Cellular cameras require an activated SIM card or camera data plan in order to integrate with the Portal and Mobile Apps.
                                All SIM cards and data plans must be obtained through Ridgetec.  Your camera
                                will ship with a SIM card in the package.</p>-->

                            <h4><strong>We offer the following, no contract, Pay as you go data plans:</strong></h4>
                            <!--<p>
                                <strong>Please Note:</strong>  </p>-->
                            <p><span style="color:lime"><strong>**Our cameras ship with a FREE first month's service (5000 points).**</strong></span></p>
                            <!--
                            <p>
                                The site will require a credit card for purchasing a Points Reserve and
                                for recurring billing or Plan renewals on a periodic basis should you elect to use these options.
                            </p>
                            <p>
                                Renewals and continued services are options that you will select as best meets your needs under the My Account | Data Plans page.
                            </p>
                            <hr>
                            -->

                            <!--<h4><strong>Pay as you go Plan Pricing</strong></h4>-->

                            @include('help.au.plans-australia')

@if (1)
                            @include('help.plans_tier-info')
@endif
@if (1)
                            @include('help.plans_features')
@endif
                            <hr>
                        </div>

                        <div class="col-md-6">
@if (1)
                            @include('help.points')
@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop