@extends('layouts.default')
@section('gallery')
  @foreach ($photos as $photo)
    @include('photos.photo')
  @endforeach
@stop
@section('content')
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pull-right">
            </div>
        </div>

        <div class="row">
            @include('camera._data')
        </div>
    </div>
</div>
@stop
