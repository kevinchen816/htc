@extends('layouts.default2')

@section('header')
<br/>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-primary custom-settings-panel">

                <div class="panel-heading">
                    <h4 class="panel-title">
@if ($mode = 'setup')
                        Setup Plan
@else
                        Configure Plan Renewal (Auto-Bill)
@endif
                        <strong>{{ $plan->iccid }}</strong>
                    </h4>
                </div>

                <div class="panel-body">

                    <div class="col-md-6">
                        <form method="POST" action="{{ route('plan.setup') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                            {{ csrf_field() }}
                            <input name="mode" type="hidden" value="setup">
                            <input name="planid" type="hidden" value="{{ $plan->id }}">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Select a Rate Tier below
                                    @if ($plan->region == 'ca')
                                        <img src="/images/cad.png" width="40" style="margin-bottom:10px;"/>
                                    @elseif ($plan->region == 'us')
                                        <img src="/images/usd.png" width="40" style="margin-bottom:10px;"/>
                                    @elseif ($plan->region == 'au')
                                        <img src="/images/aud.png" width="40" style="margin-bottom:10px;"/>
                                    @else ($plan->region == 'eu')
                                        <img src="/images/eur.png" width="40" style="margin-bottom:10px;"/>
                                    @endif
                                    </h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    @inject('pc', 'App\Http\Controllers\PlansController')
                                    {!! $pc->html_SetupPlan($plan) !!}

                                    @include('plans._help')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <!-- <button type="submit" class="btn btn-primary btn-sm" name="submit-new-plan" value="update"><i class="glyphicon glyphicon-saved"></i> Save Setup</button> -->
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit-new-plan" value="update"><i class="glyphicon glyphicon-shopping-cart"></i> Add Cart</button>
                                    <a href="/plans/cancel" class="btn btn-sm btn-warning">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="col-md-6">
                        @include('help.points')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
