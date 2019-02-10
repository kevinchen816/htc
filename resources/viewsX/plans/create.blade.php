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
                        @if ($mode == 'create')
                            Create Plan -
                        @elseif ($mode == 'reactive')
                            Reactive Plan -
                        @else
                            Renew Plan -
                        @endif
                        <strong>{{ $plan->iccid }}</strong>
                    </h4>
                </div>

                <div class="panel-body">

                    <div class="col-md-6">
                        @if ($mode == 'create')
                            <form method="POST" action="{{ route('plans.create') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                        @elseif ($mode == 'reactive')
                            <form method="POST" action="{{ route('plans.reactive') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                        @else
                            <form method="POST" action="{{ route('plans.renew') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                        @endif

                            {{ csrf_field() }}
                            <input name="mode" type="hidden" value="{{ $mode }}">
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
                                    {!! $pc->html_CreatePlan($plan, $mode) !!}

                                    @include('plans._help')
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputSmall">Auto Bill</label>
                                <div class="col-md-8">
                                    <div style="margin-top:10px;">

                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Automatic Billing</button>
                                        <input type="checkbox" class="hidden" name="auto-bill" id="auto-bill" {{ $plan->auto_bill ? 'checked' : '' }} />
                                    </span>

                                    <span class="help-block">
                                        Check this option on your plan to have the system continue billing you automatically.
                                    </span>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <!-- <button type="submit" class="btn btn-primary btn-sm" name="submit-new-plan" value="update"><i class="glyphicon glyphicon-saved"></i> Save Setup</button> -->
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit-new-plan" value="{{ $mode }}">
                                        @if ($mode == 'create')
                                        <i class="glyphicon glyphicon-shopping-cart"></i> Add Cart
                                        @elseif ($mode == 'reactive')
                                        <i class="glyphicon glyphicon-saved"></i> Reactive
                                        @else
                                        <i class="glyphicon glyphicon-refresh"></i> Renew
                                        @endif
                                    </button>
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
