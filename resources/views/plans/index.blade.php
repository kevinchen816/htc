@extends('layouts.default2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <h4>
                <ol class="breadcrumb">
                    <li><a href="{{ route('plans.index') }}">Plans</a></li>
                </ol>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">
        @if (count($plans) > 0)
        <table class="table">
            <!--<caption>Plans</caption>-->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ICCID</th>
                    <th>User</th>
                    <th>Camera</th>
                    <th>Points</th>
                    <th>Points used</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->iccid }}</td>
                    <td>{{ $plan->user_id }}</td>
                    <td>{{ $plan->camera_id }}</td>
                    <td>{{ $plan->points }}</td>
                    <td>{{ $plan->points_used }}</td>

                    <td>
                    <form action="{{ route('plans.show', $plan->id) }}" method="GET">
                    <button type="submit" class="btn btn-xs btn-primary">Read</button>
                    </form>
                    </td>

                    <td>
                    <form action="{{ route('plans.edit', $plan->id) }}" method="GET">
                    <button type="submit" class="btn btn-xs btn-primary">Edit</button>
                    </form>
                    </td>

                    <td>
                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $plans->render() !!}
        @else
        <h4>No Record</h4>
        @endif

        <form action="{{ route('plans.create') }}" method="GET">
            <button type="submit" class="btn btn-sm btn-primary">Add</button>
        </form>
    </div>
</div>

@stop
