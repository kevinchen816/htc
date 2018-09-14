@extends('layouts.default')
@section('gallery')
  @foreach ($photos as $photo)
    @include('photos.photo')
  @endforeach
@stop
@section('content')
<div id="app">
    @include('layouts._nav')

    <div class="fixed-navbar-container">
        <div class="container">

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pull-right">
            </div>
        </div>

        <div class="row">
            <!-- @include('camera._list') -->
            @include('camera._data')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pull-right">
        </div>
    </div>
</div>

<div id="help_panel" class="side-panel hidden" style="overflow-y: auto;">
    <div style="position: fixed;">
        <a class="btn btn-sm btn-default btn-info help_close" style="border-radius: 25px 0px 0px 25px;">
            <i class="fa fa-times"></i>
        </a>
    </div>
    <div id="help_content">
    </div>
</div>
<!-- </div> --><!-- kevin del ?? -->
@stop
