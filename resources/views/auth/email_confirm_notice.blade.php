@extends('layouts.app')
@section('title', 'Hint')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Hint</div>
    <div class="panel-body text-center">
        <h1>Please verify the email address first.</h1>
        <!--<a class="btn btn-primary" href="{{ route('home') }}">Home</a>-->
        <a class="btn btn-primary" href="{{ route('email_confirm.send') }}">重新发送验证邮件</a>
    </div>
</div>
@endsection
