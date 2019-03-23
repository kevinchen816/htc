@extends('layouts.default')

@section('welcome')
<br>
@stop

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>{{ trans('htc.Login') }}</h5>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('mobile.login') }}">
                        {{ csrf_field() }}
                        <input name="device_id" type="hidden" value="{{ $device_id }}">

                        <div class="form-group">
                            <label for="email">{{ trans('htc.E-Mail Address') }}</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ trans('htc.Password') }}</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- <div class="checkbox"> -->
                        <div class="checkbox-XX">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('htc.Remember Me') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ trans('htc.Login') }}</button>
                    </form>
                </div>
            </div>
@if (0)
            {{ $device_id }}
@endif
        </div>
    </div>
</div>
@stop