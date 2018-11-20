@inject('cc', 'App\Http\Controllers\Api\CamerasController')
<div class="col-md-6 mobile-nopadding-nomargin">

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">Camera Identity and Status</h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewStatus($camera) !!}

<hr>
            <!----- ---->
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Description</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>Kevin #1</strong>
            </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">Location</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <strong></strong>
        </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">Plan Points</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <div class="progress progress-points"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4%"aria-valuemin="0" aria-valuemax="100" style="width:4%; min-height: 22px; line-height: 18px;"></div><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="96%"aria-valuemin="0" aria-valuemax="100" style="width:96%; min-height: 22px; line-height: 18px;">96% avail</div></div>
        </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">Signal</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <strong>71.88%</strong>
        </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">Battery</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <strong><i class="fa fa-battery-full" style="color: lime;"> </i> 100%</strong>
        </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">SD Card</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <strong>97% available</strong>
        </div>
        </div>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <span class="pull-right">Temperature</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
        <strong>22C</strong>
        </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Points Reserve</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong><i class="fa fa-dollar-sign"></i>30.00 (20000.00 points)</strong><br /><a href="/plans/buy-reserve/7" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Buy Reserve (<i class="fa fa-dollar-sign"></i>10)</a>
            </div>
        </div>

            <!---- ----->


            <!-- -->
            <div class="panel-group">
                <div class="panel panel-default panel-moreinfo">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#identity"><i class="glyphicon glyphicon-expand"></i> More Info</a>
                        </h4>
                    </div>
                    <div id="identity" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Module ID</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>861107032685597</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">SIM ICCID</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>89860117851014783481</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Model</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>Lookout North America</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Card Size/Free</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>29.72GB/28.78GB</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Firmware</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>20181001</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">MCU</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>4.36</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Carrier</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>TRUPHONE</strong>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <span class="pull-right">Last Connection</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                            <strong>4G LTE</strong>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                                    <span class="pull-right">Plan Points</span>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                                    <strong>50000</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                                    <span class="pull-right">Points Used</span>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                                    <strong>1834.00 (4%)</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -->

        </div>
    </div>

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <!--<h4 class="panel-title">Live Settings</h4>-->
            <a data-toggle="collapse" href="#live"><i class="glyphicon glyphicon-expand"></i> Live Settings (currently on camera)</a>
        </div>

        <div id="live" class="panel-collapse collapse">
            <div class="panel-body">
                {!! $cc->OverviewSettings($camera) !!}

<hr>

<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Downloaded</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/16 08:00:06</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">

</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<br />
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Camera Mode</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Photo</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Photo Resolution</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>4MP 16:9</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Photo Burst</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Off</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Burst Delay</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>500ms</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Upload Resolution</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Standard Low</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Upload Quality</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Medium</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<br />
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">

</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Time Stamp</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>On</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Date Format</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Ymd</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Time Format</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>24 Hour</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Temperature</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Celsius</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<br />
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">

</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Quiet Time</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>0s</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<br />
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">

</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Time Lapse</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>On</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Timelapse Start Time</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>00:00</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Timelapse Stop Time</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>23:59</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Timelapse Interval</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>6h</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<br />
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">

</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Wireless Mode</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Instant</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Heartbeat Interval</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Every 4 Hours</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Action Process Time Limit</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2m</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Remote Control</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>Disabled</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Cellular Password</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong></strong>
</div>
</div>


            </div>
        </div>
    </div>

</div>

<div class="col-md-6 mobile-nopadding-nomargin">

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">Event Data</h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewEvent($camera) !!}

<hr>

<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Contact</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/18 04:00:17</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Armed</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/09/17 12:42:49</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Uploads since armed</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>1155</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Points since armed</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>1790</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Heartbeat</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/18 04:00:17</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Photo</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/18 03:06:32</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Video</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/15 10:43:58</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Scheduled Upload</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/06 03:03:12 | success</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Last Settings</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>2018/10/16 08:00:06</strong>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<span class="pull-right">Expected Contact</span>
</div>
<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
<strong>[Unknown]</strong>
</div>
</div>

        </div>
    </div>

</div>