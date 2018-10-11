@extends('layouts.default2')

@section('content')
<h1>Read</h1>
<h4>{{ $plan->iccid }}</h4>
{{ $plan }}
@stop