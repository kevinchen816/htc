@extends('layouts.default2')
@section('title', 'Cameras')

@section('gallery')
    @foreach ($photos as $photo)
        @include('photos.photo')
    @endforeach
@stop

@section('content')
<div class="fixed-navbar-container">
    <div class="container">
    </div>
</div>

<div class="container-fluid">
    <!-- kevin test-->
<!--     <div class="row">
        <div class="col-md-12">
            <form action="{{ route('logout') }}" method="POST">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger pull-right">Logout</button>
            </form>
        </div>
    </div>
 -->
    <div class="row">
        @include('camera._list')
        @include('camera._data')
    </div>
</div>

<!--     <div class="row">
        <div class="col-md-12 pull-right">
        </div>
    </div> -->
@stop
