@extends('layouts.app')
@section('title', '操作成功')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Success</div> -->
                <!-- <div class="panel-heading"></div> -->
                <div class="panel-body text-center">
                    <h1>{{ $msg }}</h1>
                    <a class="btn btn-primary" href="{{ route('home') }}">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
