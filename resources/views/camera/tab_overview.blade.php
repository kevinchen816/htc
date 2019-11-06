@inject('cc', 'App\Http\Controllers\Api\CamerasController')
<div class="col-md-6 mobile-nopadding-nomargin">

    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">
                {{ trans('htc.Status') }}
                <!-- <span class="pull-right">{{ trans('htc.Plan') }}: -->
                    <!-- <strong><span class="label label-highlight" style="font-size: 1.0em;">Active</strong> -->
                    {!! $cc->html_OverviewTitle($camera) !!}
                <!-- </span> -->
            </h4>
        </div>
        <div class="panel-body">
            {!! $cc->html_OverviewStatus($camera) !!}

            <div class="panel-group">
                <div class="panel panel-default panel-moreinfo">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#identity"><i class="glyphicon glyphicon-expand"></i> {{ trans('htc.More Info') }}</a>
                        </h4>
                    </div>
                    <div id="identity" class="panel-collapse collapse">
                        <div class="panel-body">
                        {!! $cc->html_OverviewStatus2($camera) !!}
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
                <a data-toggle="collapse" href="#live"><i class="glyphicon glyphicon-expand"></i> {{ trans('htc.Live Settings') }}</a>
            </h4>
        </div>

        <div id="live" class="panel-collapse collapse">
            <div class="panel-body">
@if (1)
                {!! $cc->html_OverviewSettings($camera) !!}
@else
                {!! $cc->html_OverviewSettings($user, $camera) !!}
@endif
            </div>
        </div>
    </div>
@endif
</div>

<div class="col-md-6 mobile-nopadding-nomargin">
    <div class="panel panel-default panel-primary custom-settings-panel mobile-nopadding-nomargin">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('htc.Event Data') }}</h4>
        </div>
        <div class="panel-body">
@if (1)
            {!! $cc->html_OverviewEvent($camera) !!}
@else
            {!! $cc->html_OverviewEvent($user, $camera) !!}
@endif
        </div>
    </div>
</div>