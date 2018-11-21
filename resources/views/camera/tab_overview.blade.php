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

@if ($camera->last_settings)
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
@endif
</div>

<div class="col-md-6 mobile-nopadding-nomargin">
    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">Event Data</h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewEvent($camera) !!}
        </div>
    </div>
</div>
