<div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
    <div class="panel-heading">
        <h4 class="panel-title">Live Settings</h4>
    </div>
    <div class="panel-body">
        @inject('cc', 'App\Http\Controllers\Api\CamerasController')
        {!! $cc->OverviewSettings($camera) !!}
    </div>
</div>