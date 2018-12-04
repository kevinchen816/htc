@extends('layouts.default')

@section('header')
<br/>
@stop

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                <!--<div class="panel panel-default panel-primary default-help-panel">-->
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
                                            <img src="/images/usd.png" width="40" style="margin-bottom:10px;"/>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="alert alert-default alert-ratetier">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="label-tier">BRONZE</div>
                                                        <p class="tier-desc">2500 Points per Month</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="radio">
                                                            <label><input type="radio" name="tier" checked value="15" ><span style="color:white;">8.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00179]</span><br />Initial Month  @ 5000 Points</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="alert alert-default alert-ratetier">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="label-tier">SILVER</div>
                                                        <p class="tier-desc">5000 Points per Month</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="radio">
                                                            <label><input type="radio" name="tier"  value="20" >
                                                                <span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span>
                                                            </label>
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

                                            <span class="help-block"> Each tier indicates the <span style="color:white">cost</span> and the <span style="color:white">duration</span> in months.  The price is for the entire period.<br /><br />
                                            <span style="color:white"><strong>Example: If you select a 3 Month tier under SILVER, you are paying for all 3 months. The total points awarded upfront will be 15,000.  You camera can utilize these points at any rate during the 63month period.</strong></span><br/> <br />
                                            To the right of each tier pricing is a <span style="color:white">Cost Per Point</span> amount.  The cpp tells you what it costs you per point as your camera uploads media
                                            files to the portal.  Of course, the lower the cpp then the cheaper it is to operate your camera at that tier. Please make a note of the points cost per upload on this page
                                            to better understand your points requirements.<br /><br />
                                            <strong>Unused Points are not carried over into future periods.</strong>
                                            </span>
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
