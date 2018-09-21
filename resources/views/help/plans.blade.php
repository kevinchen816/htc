@extends('layouts.default2')
@section('content')
<div id="app">
    @include('layouts._header2')

        <div class="fixed-navbar-container">
            <div class="container">
                                <div class="container">
    <div class="row">
        <h4>
                    <ol class="breadcrumb">

									<li><a href="https://portal.ridgetec.com">Home</a></li>
												<li class="active">Data Plan Information</li>
					                	</ol>

                </h4>
    </div>
</div>
            </div>
        </div>
        <div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-primary default-help-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Getting Started with a Camera Data Plan</h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-5">
                        <p>Ridgetec Cellular cameras require an activated SIM card or camera data plan in order to integrate with the Portal and Mobile Apps.
                            All SIM cards and data plans must be obtained through Ridgetec.  Your camera
                            will ship with a SIM card in the package.</p>

                        <p>The portal and cameras support two types of Camera Data Plans:</p>

                        <ul>
                            <li>Prepaid</li>
                            <li>Pay as you go</li>
                        </ul>
                        <hr>

                        <h4>Click this button to add your camera data plan now: <a href="/plans/add-plan" class="btn btn-xs btn-success">Add Camera Data Plan</a></h4>
                        <hr>

                        <h4><strong>Prepaid Plans</strong></h4>
                        <p>
                            The Prepaid SIM cards are for the SUMMIT-4-CC3 cameras.  The SIM cards will
                            automatically activate on first use.  The Prepaid Summit-4 plans have a duration of <strong>6 months</strong>, or support for
                            the use of <strong>20,000 image points</strong>.  The Prepaid Plan will automatically terminate either at the end of the 6 month period or when
                            all 20,000 image points are consumed, whichever occurs first.
                        </p>
                        <hr>

                        <h4><strong>Pay as you go Plans</strong></h4>
                        <p>
                            Our pay as you go plans are purchased directly from this portal.  </p>
                        <p><span style="color:lime"><strong>**The 2019 Lookout 4G LTE ships with 1 free month data service.**</strong></span></p>
                        <p>
                            The site will require a credit card for purchasing a Points Reserve and
                            for recurring billing or Plan renewals on a periodic basis should you elect to use these options.
                        </p>
                        <p>
                            Renewals and continued services are options that you will select as best mets your needs under the My Account | Data Plans page.
                        </p>
                        <hr>

                        <h4><strong>Pay as you go Plan Pricing for 2019 Lookout LTE</strong></h4>
                        <div class="alert alert-info">
                            <strong>USA</strong>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tier</th>
                                        <th>AT&T Price</th>
                                        <!--<th>Verizon Price</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Standard Monthly<br />5000 points</td>
                                        <td>12.95 USD</td>
                                        <!--<td>TBD</td>-->
                                    </tr>
                                    <tr>
                                        <td>Economy 3 Months<br />15,000 points</td>
                                        <td>37.25 USD</td>
                                        <!--<td>TBD</td>-->
                                    </tr>
                                    <tr>
                                        <td>Cost Saver 6 Months<br />30,000 points</td>
                                        <td>73.50 USD</td>
                                        <!--<td>TBD</td>-->
                                    </tr>
                                    <tr>
                                        <td>Cost Saver Annual<br />60,000 points</td>
                                        <td>141.00 USD</td>
                                        <!--<td>TBD</td>-->
                                    </tr>
                                </tbody>
                            </table>
                            <span style="color:lime">1 point = 1 standard res photo upload.</span>
                        </div>
                        <div class="alert alert-info">
                            <strong>CANADA</strong>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tier</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Standard Monthly<br />5000 points</td>
                                        <td>14.95 CAD</td>
                                    </tr>
                                    <tr>
                                        <td>Economy 3 Months<br />15,000 points</td>
                                        <td>42.95 CAD</td>
                                    </tr>
                                    <tr>
                                        <td>Cost Saver 6 Months<br />30,000 points</td>
                                        <td>84.95 CAD</td>
                                    </tr>
                                    <tr>
                                        <td>Cost Saver Annual<br />60,000 points</td>
                                        <td>162.95 CAD</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span style="color:lime">1 point = 1 standard res photo upload.</span>
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
                            <li>Data plans will incur a .10 USD charge for each SMS command sent to your camera.  These are deducted from your Points Reserve value.</li>
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
                    <div class="col-md-7">
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
<div class="col-md-10">
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
</div>

        <div id="help_panel" class="side-panel hidden" style="overflow-y: auto;">

                <div style="position: fixed;"><a class="btn btn-sm btn-default btn-info help_close" style="border-radius: 25px 0px 0px 25px;"><i class="fa fa-times"></i></a></div>
                <div id="help_content">
                </div>

        </div>

    </div>
@stop