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
                    @include('shared._errors')

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input name="portal" type="hidden" value="{{ $portal }}">

                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>

                      <div class="checkbox-XX">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                      </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    <hr>

                    <p>
                        Need to Register for a new account? <br/>
                        @if (isset($portal) && $portal == 10)
                            <a class="btn btn-primary" href="{{ route('signup.10ware') }}" role="button">Register</a>
                        @elseif (isset($portal) && $portal == 11)
                            <a class="btn btn-primary" href="{{ route('signup.de') }}" role="button">Register</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('signup') }}" role="button">Register</a>
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@stop