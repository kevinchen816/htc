@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">Users</li>
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
                            <input type="text" class="form-control" placeholder="Search by Email" name="email" value="{{ $email }}">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Name" name="username" value="{{ $name }}">
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
                @if (count($users) > 0)
                    {!! $users->render() !!}
                @endif
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered On</th>
                            <th>Confirmed</th>
                            <th>Cameras</th>
                            <th>Data Plans</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td></td>
                            <td><a href="/admin/users/detail/{{ $user->id }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                Yes
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                3
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                @if (count($users) > 0)
                    {!! $users->render() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


@stop
