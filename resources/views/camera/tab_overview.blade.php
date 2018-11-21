@inject('cc', 'App\Http\Controllers\Api\CamerasController')
<div class="col-md-6 mobile-nopadding-nomargin">

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">
                Status
                <span class="pull-right">Plan:
                    <strong><span class="label label-highlight" style="font-size: 1.0em;">Active</strong>
                </span>
            </h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewStatus($camera) !!}

            <div class="panel-group">
                <div class="panel panel-default panel-moreinfo">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#identity"><i class="glyphicon glyphicon-expand"></i> More Info</a>
                        </h4>
                    </div>
                    <div id="identity" class="panel-collapse collapse">
                        <div class="panel-body">
                        {!! $cc->OverviewStatus2($camera) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#live"><i class="glyphicon glyphicon-expand"></i> Live Settings (currently on camera)</a>
            </h4>
        </div>

        <div id="live" class="panel-collapse collapse">
            <div class="panel-body">
                {!! $cc->OverviewSettings($camera) !!}
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