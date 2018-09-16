<div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
    <div class="panel-heading">
        <h4 class="panel-title">Camera Identity and Status</h4>
    </div>
    <div class="panel-body">
        @inject('cc', 'App\Http\Controllers\Api\CamerasController')
        {!! $cc->OverviewStatus($camera) !!}
    </div>
</div>