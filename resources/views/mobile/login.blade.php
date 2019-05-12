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

@if (env('APP_REMEMBER_ME'))
                        <!-- <div class="checkbox"> -->
                        <div class="checkbox-XX">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('htc.Remember Me') }}
                            </label>
                        </div>
@endif
                        <button type="submit" class="btn btn-primary">{{ trans('htc.Login') }}</button>
                    </form>

@if (env('APP_MOBILE_EX'))
<hr>

<!-- <p>
    Need to Register for a new account? <br/>

        <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
</p> -->

<p>
    {{ trans('htc.dont_you_have_an_account') }}
    <a href="{{ route('register') }}"> {{ trans('htc.Create New Account') }}</a>
</p>

<p>
    {{ trans('htc.did_you') }} <a href="{{ route('password.request') }}">{{ trans('htc.Forget Your Password') }}</a>
</p>

<p>
    {{ trans('htc.you_already_have_an_account_an_need_to') }}
    <a href="{{ route('confirm.send') }}">{{ trans('htc.Resend Confirmation Email') }}</a>
</p>
@endif

                </div>
            </div>
@if (0)
            {{ $device_id }}
@endif
        </div>
    </div>
</div>
@stop