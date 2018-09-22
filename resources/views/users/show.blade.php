@extends('layouts.default2')
@section('content')
<h4>{{ $user->name }}</h4>
{{ $user->email }}
@stop