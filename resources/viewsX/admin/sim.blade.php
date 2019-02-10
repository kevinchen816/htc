@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">SIMs</li>
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

               <form method="POST" action="{{ route('admin.user-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="sims-search-form">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by ICCID" name="iccid" value="">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-3">
                    <a href="{{ route('admin.clear-search.sims') }}" class="btn btn-sm btn-primary">Clear Search</a>
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
                @if (count($sims) > 0)
                    {!! $sims->render() !!}
                @endif
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ICCID</th>
                            <th>Style</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sims as $sim)
                        <tr>
                            <td></td>
                            <td>{{ $sim->iccid }}</td>
                            <td>{{ $sim->style }}</td>
                            <td>{{ $sim->status }}</td>
                            <td>{{ $sim->note }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                @if (count($sims) > 0)
                    {!! $sims->render() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
