@inject('cc', 'App\Http\Controllers\Api\CamerasController')
<div class="col-md-6 mobile-nopadding-nomargin">

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">Camera Identity and Status</h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewStatus($camera) !!}
        </div>
    </div>

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">Live Settings</h4>
        </div>
        <div class="panel-body">
            {!! $cc->OverviewSettings($camera) !!}
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
        </div>
    </div>

</div>