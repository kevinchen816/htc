@extends('layouts.default2')
@section('title', $user->name)

@section('content')
<div class="container">
    <h1>{{ $user->name }}</h1>
    {{ $user->email }}
    <br/>

    {{ $cameras }}
    <br/>
    <hr>

    @if (count($cameras) > 0)
        @foreach ($cameras as $camera)
            {{ $camera->description }}
            <br/>
        @endforeach
    @endif

    <hr>

    <form action="{{ route('logout') }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <!--<button class="btn btn-block btn-danger" type="submit" name="button">Logout</button>-->
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@stop
