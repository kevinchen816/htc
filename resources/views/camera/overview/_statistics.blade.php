<div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
    <div class="panel-heading">
        <h4 class="panel-title">Statistical Data</h4>
    </div>
    <div class="panel-body">
        @inject('cc', 'App\Http\Controllers\Api\CamerasController')
        {!! $cc->OverviewStatisics($camera) !!}

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Time Lapse Last Hour</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>0</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <hr>
                <span><strong>Activity Suppression:</strong></span>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Quiet Time Override</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>INACTIVE</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Motions Last 15 Mins</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>0</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Motions Last Hour</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>0</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <span class="pull-right">Motions 5 Min Average</span>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">
                <strong>0.00  (Target = 0.00)</strong>
            </div>
        </div>
    </div>
</div>