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
                        <p>Ridgetec Cellular cameras require an activated SIM card or camera data plan in order to integrate with the Portal and Mobile Apps.
                            All SIM cards and data plans must be obtained through Ridgetec.  Your camera
                            will ship with a SIM card in the package.</p>

                        <h4><strong>Pay as you go Plans</strong></h4>
                        <p>
                            Our pay as you go plans are purchased directly from this portal.  </p>
                        <p><span style="color:lime"><strong>**The 2019 Lookout 4G LTE ships with 1 free month data service.**</strong></span></p>
                        <p>
                            The site will require a credit card for purchasing a Points Reserve and
                            for recurring billing or Plan renewals on a periodic basis should you elect to use these options.
                        </p>
                        <p>
                            Renewals and continued services are options that you will select as best meets your needs under the My Account | Data Plans page.
                        </p>
                        <hr>

                        <!--<h4><strong>Pay as you go Plan Pricing</strong></h4>-->
                        <div class="well well-sm">
                            <h4><strong>Pay as you Go/USA (AT&T)</strong>
                                <img src="/images/usd.png" width="40" style="margin-bottom:10px;"/>
                            </h4>
                            <div class="alert alert-default alert-ratetier">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="label-tier">BRONZE</div>
                                        <p class="tier-desc">2500 Points per Month</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p><span style="color:white;">8.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00358]</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">SILVER</div><p class="tier-desc">5000 Points per Month</p></div><div class="col-md-7">
                                <p><span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span></p>


                                <p><span style="color:white;">36.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00246]</span></p>

                                                    </div></div></div><div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">GOLD</div><p class="tier-desc">10000 Points per Month</p></div><div class="col-md-7">
                                <p><span style="color:white;">19.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00200]</span></p>


                                <p><span style="color:white;">57.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00193]</span></p>

                                                    </div></div></div><div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">PLATINUM PRO</div><p class="tier-desc">20000 Points per Month</p></div><div class="col-md-7">
                                <p><span style="color:white;">26.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00135]</span></p>


                                <p><span style="color:white;">77.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00130]</span></p>


                        </div></div></div>                        </div>
                                                                            <div class="well well-sm">
                            <h4><strong>Pay as you Go/Canada</strong>
                                <img src="/images/cad.png" width="40" style="margin-bottom:10px;"/>
                            </h4>
                            <div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">SILVER</div><p class="tier-desc">5000 Points per Month</p></div><div class="col-md-7">
                                                            <p><span style="color:white;">14.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00299]</span></p>


                                                            <p><span style="color:white;">42.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00286]</span></p>

                                                                                </div></div></div><div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">GOLD</div><p class="tier-desc">10000 Points per Month</p></div><div class="col-md-7">
                                                            <p><span style="color:white;">22.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00230]</span></p>


                                                            <p><span style="color:white;">64.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00216]</span></p>

                                                                                </div></div></div><div class="alert alert-default alert-ratetier"><div class="row"><div class="col-md-5"><div class="label-tier">PLATINUM PRO</div><p class="tier-desc">20000 Points per Month</p></div><div class="col-md-7">
                                                            <p><span style="color:white;">31.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00160]</span></p>


                                                            <p><span style="color:white;">89.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00150]</span></p>


                        </div></div></div>                        </div>
                                                <div class="well well-sm">
                            <span class="help-block"> Each tier indicates the <span style="color:white">cost</span> and the <span style="color:white">duration</span> in months.  The price is for the entire period.<br /><br />

                                <span style="color:white"><strong>Example: If you select a 3 Month tier under SILVER, you are paying for all 3 months. The total points awarded upfront will be 15,000.  You camera can utilize these points at any rate during the 3 month period.</strong></span><br/> <br />

                                To the right of each tier pricing is a <span style="color:white">Cost Per Point</span> amount.  The cpp tells you what it costs you per point as your camera uploads media
                                files to the portal.  Of course, the lower the cpp then the cheaper it is to operate your camera at that tier. Please make a note of the points cost per upload on this page
                                to better understand your points requirements.<br /><br />
                                <strong>Unused Points are not carried over into future periods.</strong>
                            </span>
                        </div>


                        <p><strong>Pay as you go plans:</strong></p>
                        <ul>
                            <li>Do not require a contract</li>
                            <li>Are good for at least one month at a time</li>
                            <li>Cancellable at any time by not Auto-Renewing</li>
                            <li>Provide at least 5000 Image Points in a given month</li>
                            <li>Are flat rate</li>
                            <li>Incur no premium charges</li>
                            <li>Incur no overages</li>
                            <li>Are automatically renewable by checking theAuto-Bill option for that plan.  If this option is not checked, then the data
                                plan will suspend (suspending service for your camera) at the end of the period or when all points and Points Reserve are exhausted.</li>
                            <!--<li>Data plans will incur a .10 USD charge for each SMS command sent to your camera.  These are deducted from your Points Reserve value.</li>-->
                            <li>Offer a <strong>Points Reserve</strong> option, disclosed during checkout, to cover additional points used during the
                                duration of your plan. If you go over your points in any period, the additional points are deducted from the Points Reserve at the same
                                rate as standard plan points (without generating a charge to your credit card).  When all plan points are consumed and all
                                of your Points Reserve is consumed in a given period, the system will charge your card another Points Reserve amount rather than suspend service (if you elect the Auto-Reserve option).
                                There is no penalty to using more points in a given period than your plan provides, because you pay for additional
                                points at the same rate, only these are deducted from your Points Reserve.  This primarily avoids
                                the need to charge your credit card frequently and avoids loss of service. Our goal is to make it
                                simple and straight forward to operate your camera.  Selecting the <strong>Auto-Reserve</strong> option: If your plan points are depleted as well as the Points Reserve,
                                a new Points Reserve will be charged in real time as needed to keep your camera online.
                            </li>
                            <li>
                                Will use Consolidated Billing.  All your active plans will generate a charge on the same date (based on duration)
                                as once again the goal is to avoid frequently charging your credit card and make billing simpler to
                                understand.  This means that on the first automated renewal for a plan, there will likely be a discount assesed due to proration
                                in order to consolidate all plans to the same day for renewal billing. The discount means that your first renewal will cost less
                                because you prepaid an entire period during checkout and the renewal occurs before the initial end service date.
                            </li>
                        </ul>
                        <hr>

                    </div>
                    <div class="col-md-6">
                        <h4><strong>What are Image Points?</strong></h4>
<p>
    Our cellular cameras currently support 5 upload sizes in <strong>Photo Mode</strong> and 4 upload sizes in <strong>Video Mode</strong>.  Under your camera settings tab, this is referred to as <strong>Upload Resolution</strong>.
</p>
<p>
    The values for Upload Resolution are:
</p>

<ul>
    <li>Standard Low</li>
    <li>Standard Medium</li>
    <li>Standard High</li>
    <li>High Def</li>
    <li><span style="color:lightgreen;">*High Res MAX (per request)</span></li>
</ul>
<p><span style="color:lightgreen;">*High Res MAX applies only to on demand requests in Photo mode, not Video mode.</span></p>

<p>
    The following chart details the plan Image Points, used at each <strong>Upload Resolution</strong>:
</p>
<div class="alert alert-default">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Upload Resolution</th>
                <th>Quality (Std)</th>
                <th>Quality (Med)</th>
                <th>Quality (High)</th>
                <th>Video</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Standard Low</td>
                <td>1.0</td>
                <td>1.5</td>
                <td>2.0</td>
                <td>1.0</td>
            </tr>
            <tr>
                <td>Standard Medium</td>
                <td>2.5</td>
                <td>3.25</td>
                <td>4.25</td>
                <td>2.0</td>
            </tr>
            <tr>
                <td>Standard High</td>
                <td>4.0</td>
                <td>6.75</td>
                <td>8.25</td>
                <td>3.0</td>
            </tr>
            <tr>
                <td>High Def</td>
                <td>7.0</td>
                <td>10.0</td>
                <td>14.5</td>
                <td>6.0</td>
            </tr>
            <tr>
                <td>High Res MAX</td>
                <td>13</td>
                <td>15.5</td>
                <td>19.5</td>
                <td></td>
            </tr>
        </tbody>
    </table>

</div>

<p>
<h4><strong>For PIR and Time Lapse events...</strong></h4>
<p>In Photo or Video mode, your camera wakes, captures and uploads a photo to the portal. it will consume
    points at a rate based on its <strong>Camera Mode</strong>, <strong>Upload Resolution</strong> and <strong>Photo Quality</strong> settings.
    Use the chart above to understand how your plan's Image Points are used.
</p>
<p>

<h4><strong>For Video and Original Image upload requests...</strong></h4>
<p>Your camera processes these as it connects to the portal. The Image Points used are based
    on the size of the file captured to the camera's SD Card.  The size will vary based on Photo Resolution or Video Resolution, Quality, and Duration settings.
    These files will be much larger than the uploaded photos per event, However, you are in control of the file sizes to some extent by the options you choose under camera
    settings.
</p>

<h4><strong>Remote Control and SMS commands</strong></h4>
<p>Your camera can operate with Remote Control turned on (see Camera Settings).  In remote control mode the camera remains in a standby state where an SMS
    command can wake the camera up so it can snap a photo and/or talk to the server.  There are two buttons in the portal when Remote Control is enabled, these are SNAP and WAKE.
    SNAP will send a real time command to the camera, waking it up to capture either photo or video based on Camera Mode then upload the photo to the portal.
    The WAKE button will cause the camera to report in to the server immediately as if the HeartBeat event had just fired.  As the camera contacts the portal,
    it will process any queued actions, such as Download Settings, Reguest High Res MAX, Request Video, etc.
</p>
<p>There will be a .10 USD charge to your account per each SMS command delivered to the camera.  The cost of each SMS command will be deducted from your plan's Points Reserve value (if present).</p>
<p>Note: Not all camera models and networks will support Remote Control and SMS features.</p>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@stop
