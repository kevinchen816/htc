@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">Firmware</li>
            </ol>
        </h4>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> System Supported Models
                </span>
            </div>
            <div class="panel-body">
                <div class="pull-right">

                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Model ID</th>
                            <th>Description</th>
                            <th>Latest Firmware</th>
                            <th>Carrier</th>
                            <th>File Extension</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($firmwares as $firmware)
                        <tr>
                            <td></td>
                            <td>lookout-na</td>
                            <td><a href="/admin/firmware/detail/lookout-na">{{ $firmware->model }</a></td>
                            <td>{{ $firmware->version }</td>
                            <td>truphone</td>
                            <td>{{ $firmware->type }</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td>lookout-na</td>
                            <td><a href="/admin/firmware/detail/lookout-na">Lookout North America</a></td>
                            <td>20181003</td>
                            <td>truphone</td>
                            <td>ZIP</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>mountaineer-na</td>
                            <td><a href="/admin/firmware/detail/mountaineer-na">Mountaineer NA</a></td>
                            <td>20180720</td>
                            <td>truphone</td>
                            <td>ZIP</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>summit</td>
                            <td><a href="/admin/firmware/detail/summit">Summit 4</a></td>
                            <td>20180620</td>
                            <td>truphone</td>
                            <td>BIN</td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right">

                </div>
            </div>
        </div>
    </div>
</div>


@stop
