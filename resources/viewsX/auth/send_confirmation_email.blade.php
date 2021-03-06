@extends('layouts.default')

@section('welcome')
<br>
@stop

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-offset-2 col-md-8">

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>{{ trans('htc.send_confirmation_email') }}</h5>
            </div>

            <div class="panel-body">
                <form method="POST" action="{{ route('confirm.send') }}">
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

                    <button type="submit" class="btn btn-primary">{{ trans('htc.send') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop