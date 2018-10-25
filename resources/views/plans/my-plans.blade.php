@extends('layouts.default2')
@section('header')
<br>
@stop

@section('content')
<div class="container">
    <div class="row">
        <!--<div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <h4>
                        My Camera Data Plans
                    </h4>
                </div>
            </div>
        </div>-->

        @inject('ac', 'App\Http\Controllers\PlansController')
        {!! $ac->MyPlans() !!}
    </div>
</div>
@stop