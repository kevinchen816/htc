@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">RMAs</li>
            </ol>
        </h4>
    </div>
    </div>
</div>

<div class="row">

    <div class="col-md-8">

        <div class="panel panel-default panel-info">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> RMA List
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>RMA Nbr</th>
                            <th>Status</th>
                            <th>User Info</th>
                        </tr>
                    </thead>

                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="panel panel-default panel-yellow">
            <div class="panel-heading">
                <h4 class="panel-title">RMA Help</h4>
            </div>
            <div class="panel-body">
                <h3>Managing System Tasks</h3>
            </div>
        </div>
    </div>

</div>
@stop
