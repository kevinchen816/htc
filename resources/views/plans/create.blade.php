@extends('layouts.default2')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Create</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('plans.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="iccid">ICCID</label>
                        <input type="text" name="iccid" class="form-control" value="{{ old('iccid') }}">
                    </div>

                    <div class="form-group">
                        <label for="points">Points</label>
                        <input type="text" name="points" class="form-control" value="{{ old('points') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
