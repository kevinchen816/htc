@extends('layouts.app')
@section('title', 'Hint')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hint</div>

                <div class="panel-body text-center">
                    <h1>Please verify the email address first.</h1>
                    <!-- <a class="btn btn-primary" href="{{ route('home') }}">Home</a> -->
                    <a class="btn btn-primary" href="{{ route('confirm.send') }}">Resend Confirmation Email</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


