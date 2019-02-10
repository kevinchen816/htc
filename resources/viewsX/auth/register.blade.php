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
                <h5>{{ trans('htc.register') }}</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">{{ trans('htc.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('htc.email_address') }}</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('htc.password') }}</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('htc.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('htc.register') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop