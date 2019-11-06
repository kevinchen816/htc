@extends('layouts.default')

@section('header')
<br>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default panel-primary custom-settings-panel">

                <div class="panel-heading">
                    <h4 class="panel-title">
@if (env('APP_USE_IMEI_ADD_CAMERA'))
                        {{ trans('htc.Add Camera') }}
@else
                        {{ trans('htc.Add Plan') }}
@endif
                    </h4>
                </div>

                <div class="panel-body">

                    <!--<div class="col-md-6">-->
@if (env('APP_USE_IMEI_ADD_CAMERA'))
                        <form method="POST" action="{{ route('camera.add') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
@else
                        <form method="POST" action="{{ route('plans.add') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
@endif
                            {{ csrf_field() }}
                            <input name="mode" type="hidden" value="new">

                            <div class="form-group">
@if (env('APP_USE_IMEI_ADD_CAMERA'))
                                <label class="col-md-3 control-label" for="imei inputSmall">IMEI</label>
@else
                                <label class="col-md-3 control-label" for="iccid inputSmall">SIM ICCID</label>
@endif

                                <div class="col-md-8">
@if (env('APP_USE_IMEI_ADD_CAMERA'))
                                    <input type="text" value="{{ old('imei') }}" name="imei" maxlength="70" id="imei" class="form-control input-sm" placeholder="{{ trans('htc.Input IMEI') }}">
@else
                                    <input type="text" value="{{ old('iccid') }}" name="iccid" maxlength="70" id="iccid" class="form-control input-sm" placeholder="{{ trans('htc.Input ICCID') }}">
@endif
                                </div>
                            </div>

@if (env('APP_CHECK_TERMS'))
                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="default">{{ trans('htc.agree_Terms') }}</button>
                                        <input type="checkbox" class="hidden" name="agree-terms" id="agree-terms"  />
                                    </span>
                                    <div>
                                        <i class="glyphicon glyphicon-warning-sign"></i>
                                        <a href="{{ route('help.terms') }}" target="_blank">{{ trans('htc.TERMS AND CONDITIONS') }}</a>
                                    </div>
                                </div>
                            </div>
@endif
                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary  btn-sm" name="submit-new-plan" value="update">
                                        <i class="glyphicon glyphicon-plus"></i>
@if (env('APP_USE_IMEI_ADD_CAMERA'))
                                        {{ trans('htc.Add New Camera') }}
@else
                                        {{ trans('htc.Create New Plan') }}
@endif
                                    </button>
                                    <a href="{{ route('plans.cancel') }}" class="btn btn-sm btn-warning">{{ trans('htc.Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    <!--</div>-->

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

<!--
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
-->
</div>
@stop