@extends('layouts.admin')

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
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Edit</h5>
                </div>
                <div class="panel-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ route('plans.update', $plan->id )}}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="iccid">ICCID</label>
                          <input type="text" name="iccid" class="form-control" value="{{ $plan->iccid }}" disabled>
                        </div>

                        <div class="form-group">
                          <label for="points">Points</label>
                          <input type="text" name="points" class="form-control" value="{{ $plan->points }}">
                        </div>

                        <div class="form-group">
                          <label for="points_used">Points Used</label>
                          <input type="text" name="points_used" class="form-control" value="{{ $plan->points_used }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
