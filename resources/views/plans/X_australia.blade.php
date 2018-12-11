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
                        Configure Plan Renewal (Auto-Bill)
                        <strong>8944503540145562672</strong>
                    </h4>
                </div>

                <div class="panel-body">

                    <div class="col-md-6">
                        <form method="POST" action="{{ route('plan.setup') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                            {{ csrf_field() }}
                            <input name="mode" type="hidden" value="setup">
                            <input name="planid" type="hidden" value="6">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Select a Rate Tier below
                                    <img src="/images/aud.png" width="40" style="margin-bottom:10px;"/>
                                    </h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">

                                    <div class="alert alert-default alert-ratetier">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="label-tier">SILVER</div>
                                                <p class="tier-desc">5000 Points per Month</p>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  checked value="20" ><span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  value="22" ><span style="color:white;">36.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00246]</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-default alert-ratetier">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="label-tier">GOLD</div>
                                                <p class="tier-desc">10000 Points per Month</p>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  value="24" ><span style="color:white;">19.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00200]</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  value="26" ><span style="color:white;">57.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00193]</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-default alert-ratetier">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="label-tier">PLATINUM PRO</div>
                                                <p class="tier-desc">20000 Points per Month</p>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  value="28" ><span style="color:white;">26.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00135]</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="tier"  value="30" ><span style="color:white;">77.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00130]</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @include('plans._help')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit-new-plan" value="update"><i class="glyphicon glyphicon-saved"></i> Save Setup</button>
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
