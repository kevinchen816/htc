@extends('layouts.default2')
@section('gallery')
    @if ($photos)
    @foreach ($photos as $photo)
        @include('photos.photo')
    @endforeach
    @endif
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('camera._list')
        @include('camera._data')
    </div>
</div>
@stop
