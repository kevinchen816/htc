@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">Cameras</li>
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
                <form method="POST" action="{{ route('admin.camera-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="users-search-form">
                    {{ csrf_field() }}

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Module ID" name="moduleid" value="{{ $module_id }}">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by ICCID" name="iccid" value="{{ $iccid }}">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="col-md-3">
                    <a href="{{ route('admin.clear-search.cameras') }}" class="btn btn-sm btn-primary">Clear Search</a>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="http://www.ridgetec.us/admin/cameras/operation" accept-charset="UTF-8" class="form-horizontal" role="form" id="cameras-operation-form">
    {{ csrf_field() }}

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gear"></i> Operations on selected cameras</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Settings Download</button>
                                <input type="checkbox" class="hidden" name="settings" value="settings" />
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Firmware Update</button>
                                <input type="checkbox" class="hidden" name="firmware" value="firmware" />
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Delete Camera</button>
                                <input type="checkbox" class="hidden" name="delete" value="delete" />
                            </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                                <button class="btn btn-sm btn-primary" type="submit">Execute</button>
                    </div>
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
                @if (count($cameras) > 0)
                    {!! $cameras->render() !!}
                @endif
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Module ID</th>
                            <th>ICCID</th>
                            <th>Model</th>
                            <th>MCU</th>
                            <th>Firmware</th>
                            <th>Description</th>
                            <th>Demo</th>
                            <th>Account Owner</th>
                            <th>Last Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cameras as $camera)
                        <tr>
                            <td>
                                <span class="button-checkbox">
                                    <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                                    <input type="checkbox" class="hidden camera-select" name="select[]" value="{{ $camera->id }}" />
                                </span>
                            </td>
                            <td>
                                <a href="/admin/cameras/detail/{{ $camera->id }}">{{ $camera->module_id }}</a>
                            </td>
                            <td>{{ $camera->iccid }}</td>
                            <td>{{ $camera->model_id }}</td>
                            <td>{{ $camera->mcu_version }}</td>
                            <td>{{ $camera->dsp_version }}</td>
                            <td>{{ $camera->description }}</td>
                            <td> </td>
                            <td>
                                <a href="/admin/users/detail/{{ $camera->user_id }}">Kevin</a> (kevin@10ware.com)
                            </td>
                            <td>{{ $camera->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                @if (count($cameras) > 0)
                    {!! $cameras->render() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@stop
