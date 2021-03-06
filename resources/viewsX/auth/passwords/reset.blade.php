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
                <h5>{{ trans('htc.reset_password') }}</h5>
            </div>
            <div class="panel-body">

                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">{{ trans('htc.email_address') }}</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('htc.password') }}</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('htc.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('htc.reset_password') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop