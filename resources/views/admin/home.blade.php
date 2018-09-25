@extends('layouts.default-admin')
@section('content')
<h1>{{ Auth::user()->name }}</h1>
<h4>{{ Auth::user()->email }}</h4>
@stop