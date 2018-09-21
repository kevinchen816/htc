@extends('layouts.default2')
@section('content')
<div id="app">
    @include('layouts._header2')

    <div class="fixed-navbar-container">
        <div class="container">
            @include('shared._messages')

            <div class="row">
                <h4>
                    <ol class="breadcrumb">
                        <li class="active">Add Camera Data Plan</li>
                    </ol>
                </h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-primary custom-settings-panel">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Add <strong>PREPAID</strong> or <strong>PAY AS YOU GO</strong> Camera Plans
                            <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="find-iccid">
                                <i class="fa fa-question"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="panel-body">

                        <div class="col-md-6">
                            <form method="POST" action="{{ route('add.plan') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                                {{ csrf_field() }}
                                <input name="mode" type="hidden" value="new">

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="iccid inputSmall">SIM ICCID</label>
                                    <div class="col-md-8">
                                        <input type="text" value="" name="iccid" maxlength="70" id="iccid" class="form-control input-sm" placeholder="Input ICCID">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-7">
                                        <span class="button-checkbox">
                                            <button type="button" class="btn btn-default btn-xs" data-color="default">I Agree to the Terms and Conditions</button>
                                            <input type="checkbox" class="hidden" name="agree-terms" id="agree-terms"  />
                                        </span>
                                        <div>
                                            <i class="glyphicon glyphicon-warning-sign"></i>
                                            <a href="/help/terms" target="_blank">TERMS AND CONDITIONS</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-warning btn-sm" name="submit-new-plan" value="update">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            Create New Plan
                                        </button>
                                        <a href="/plans/cancel" class="btn btn-sm btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <a class="btn btn-info btn-sm ToggleHelp" style="margin-left: 14px;" help-id="find-iccid"> Help me find my ICCID!</a>
                            <div class="alert alert-default">
                                <h4>How to activate and add a camera to your account</h4>
                                <ul>
                                    <li>Step 1: Input SIM ICCID and click Create New Plan.</li>
                                    <li>Step 2: If you are adding a <strong>Pay as you Go plan</strong>, complete the checkout first.</li>
                                    <li>Step 3: Turn Camera ON.</li>
                                    <li>Step 4: Camera will automatically display in My Cameras (refresh the page periodically - may take 5-10m)</li>
                                </ul>
                            </div>

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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                             <h4 class="modal-title" id="myModalLabel">Notification</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="find-iccid" class="hidden">
            <div class="alert alert-sm alert-info help-container">
                <h4>
                    <strong>How to locate the ICCID using the camera menu options</strong>
                </h4>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://player.vimeo.com/video/267440721" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>

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