@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">Email Tracking</li>
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

                <form method="POST" action="{{ route('admin.email-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="emails-search-form">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Email" name="email" value="">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-3">
                    <a href="{{ route('admin.clear-search.emails') }}" class="btn btn-sm btn-primary">Clear Search</a>
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
                @if (count($emails) > 0)
                    {!! $emails->render() !!}
                @endif
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Email</th>
                            <th>Account<br />Owner</th>
                            <th>Confirmed</th>
                            <th>Confirmed On</th>
                            <th>Bounces</th>
                            <th>Blocked</th>
                            <th>Blocked Date</th>
                            <th>Opt-out</th>
                            <th>Opt-out Date</th>
                            <th>Banned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emails as $email)
                        <tr>
                            <td></td>
                            <td><a href="/admin/emails/detail/115">4033183426@msg.telus.com</a></td>
                            <td> </td>
                            <td>Yes</td>
                            <td>04/30/2018 4:54:40 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                @if (count($emails) > 0)
                    {!! $emails->render() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
