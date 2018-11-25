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
                    <h5>Login</h5>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                      <div class="checkbox-XX">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                      </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    <hr>

<!--                     <p>
                        Need to Register for a new account? <br/>

                            <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
                    </p> -->

                    <p>
                        Don't you have an account yet ?
                        <a href="{{ route('register') }}"> Create New Account</a>
                    </p>
                    <p>
                        Did you <a href="{{ route('password.request') }}">Forget Your Password ?</a>
                    </p>

                    <p>
                        You already have an account and need to
                        <a href="{{ route('confirm.send') }}">Resend Confirmation Email.</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@stop