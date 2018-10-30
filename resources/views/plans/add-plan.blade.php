@extends('layouts.default2')

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
                        Add ICCID
                    </h4>
                </div>

                <div class="panel-body">

                        <form method="POST" action="{{ route('add.plan') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-addplan-form">
                            {{ csrf_field() }}
                            <input name="portal" type="hidden" value="{{ $portal }}">
                            <input name="mode" type="hidden" value="new">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="iccid inputSmall">SIM ICCID</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ old('iccid') }}" name="iccid" maxlength="70" id="iccid" class="form-control input-sm" placeholder="Input ICCID">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary  btn-sm" name="submit-new-plan" value="update">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop