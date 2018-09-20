@extends('layouts.default')
@section('title', $user->name)
@section('content')
<h1>{{ $user->name }}</h1>
{{ $user->email }}

    <form action="{{ route('logout') }}" method="POST">
      {{ csrf_field() }}
      <!--<button class="btn btn-block btn-danger" type="submit" name="button">Logout</button>-->
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@stop
