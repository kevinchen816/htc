@extends('layouts.default2')

@section('welcome')
@stop

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <h4>
                <ol class="breadcrumb">
                    <li><a href="{{ route('plans.index') }}">Plans</a></li>
                    <li class="active">{{ $plan->iccid }}</li>
                </ol>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table h4">
            <!--<caption>Plan</caption>-->
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>ICCID</td>
                   <td>{{ $plan->iccid }}</td>
                </tr>
                <tr>
                   <td>Points</td>
                   <td>{{ $plan->points }}</td>
                </tr>
                <tr>
                   <td>Points Used</td>
                   <td>{{ $plan->points_used }}</td>
                </tr>
                <tr>
                   <td>Created</td>
                   <td>{{ $plan->created_at }}</td>
                </tr>
                <tr>
                   <td>Updated</td>
                   <td>{{ $plan->updated_at }}</td>
                </tr>
           </tbody>
        </table>
    </div>
</div>
@stop