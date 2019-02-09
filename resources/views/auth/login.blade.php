@extends('layouts.default')

@section('welcome')
<br>
@stop

@section('content')
<div class="container">

@if (0)
<a href="{{ url('/en') }}">EN</a>
<a href="{{ url('/cn') }}">CN</a>
<a href="{{ url('/tw') }}">TW</a>
</br>
{{ App::getLocale() }}
@endif

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>{{ trans('htc.login') }}</h5>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

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

                        <!-- <div class="checkbox"> -->
                        <div class="checkbox-XX">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('htc.remember_me') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ trans('htc.login') }}</button>
                    </form>

                    @inject('hc', 'App\Http\Controllers\HtmlController')
                    {!! $hc->html_LoginExt() !!}

@if (0)
                    <hr>

<!--                     <p>
                        Need to Register for a new account? <br/>

                            <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
                    </p> -->

                    <p>
                        {{ trans('htc.dont_you_have_an_account') }}
                        <a href="{{ route('register') }}"> {{ trans('htc.create_new_account') }}</a>
                    </p>
                    <p>
                        {{ trans('htc.did_you') }} <a href="{{ route('password.request') }}">{{ trans('htc.forget_your_password') }}</a>
                    </p>

                    <p>
                        {{ trans('htc.you_already_have_an_account_an_need_to') }}
                        <a href="{{ route('confirm.send') }}">{{ trans('htc.resend_confirmation_email') }}</a>
                    </p>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop