@extends('layouts.default')
@section('content')

@if (count($users) > 0)
    @foreach ($users as $user)
        {{ $user->email }}
        <br/>
    @endforeach
@endif

{!! $users->render() !!}

@stop