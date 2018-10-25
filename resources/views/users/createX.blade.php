@extends('layouts.default2')

@section('welcome')
@include('layouts._welcome')
@stop

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Register</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <div class="col-md-6">
                    <form method="POST" action="{{ route('users.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>

                <div class="col-md-6">
                @include('users._register_help')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
