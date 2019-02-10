@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">Data Plans</li>
            </ol>
        </h4>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search"></i> Search Options</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('admin.user-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="users-search-form">
                    {{ csrf_field() }}

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Email" name="email" value="">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Name" name="username" value="">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-3">
                    <a href="{{ route('admin.clear-search.users') }}" class="btn btn-sm btn-primary">Clear Search</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> Results
                </span>
            </div>
            <div class="panel-body">
                <div class="pull-right">

                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ICCID</th>
                            <th>Style</th>
                            <th>Status</th>
                            <th>Account Owner</th>
                            <th>Status Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                        <tr>
                            <td><a href="/admin/plans/remove/{{ $plan->id }}" class="btn btn-primary btn-xs"> Remove </a></td>
                            <td>89011702272013899924</td>
                            <td>Prepaid</td>
                            <td>Active</td>
                            <td>
                                <a href="/admin/users/detail/{{ $plan->user_id }}">Andrew Drach</a> (andrew@callentis.io)
                            </td>
                            <td>
                                {{ $user->created_at }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">

                </div>
            </div>
        </div>
    </div>
</div>


@stop
