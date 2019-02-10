@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="active">API Log</li>
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
                <form method="POST" action="{{ route('admin.api-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="api-search-form">
                    {{ csrf_field() }}

                    <div class="col-md-3">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" placeholder="Search by Module ID" name="moduleid" value="861107033618282"> -->
                            <input type="text" class="form-control" placeholder="Search by Module ID" name="moduleid" value="{{ $imei }}">
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
                    <a href="{{ route('admin.clear-search.apilog') }}" class="btn btn-sm btn-primary">Clear Search</a>
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
                @if (count($log_apis) > 0)
                    {!! $log_apis->render() !!}
                @endif
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Camera</th>
                            <th>Plan</th>

                            <th>Route</th>
                            <th>Result</th>

                            <th>Request</th>
                            <th>Response</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log_apis as $log_api)
                        <tr>
                            <td></td>

                            <td>
                                <a href="/admin/users/detail/{{ $log_api->user_id }}">{{ $user->name }} ( {{$user->email}} )</a>
                            </td>
                            <td>
                                <a href="/admin/cameras/detail/{{ $log_api->camera_id }}">{{ $log_api->imei }}</a>
                                 / {{ $log_api->iccid }}
                            </td>
                            <td>Pay as you go</td>
                            <td>api.{{ $log_api->api }}</td>
                            <td>0</td>
                            <td>
                                <!-- <a class="btn btn-xs btn-primary view-request" data-request="{&quot;iccid&quot;:&quot;89860117851014783481&quot;,&quot;module_id&quot;:&quot;861107032685597&quot;,&quot;model_id&quot;:&quot;lookout-na&quot;,&quot;cellular&quot;:&quot;4G LTE&quot;,&quot;DataList&quot;:{&quot;Battery&quot;:&quot;f&quot;,&quot;SignalValue&quot;:&quot;23&quot;,&quot;Cardspace&quot;:&quot;29475MB&quot;,&quot;Cardsize&quot;:&quot;30432MB&quot;,&quot;Temperature&quot;:&quot;24C&quot;,&quot;mcu&quot;:&quot;4.36&quot;,&quot;FirmwareVersion&quot;:&quot;20181001&quot;,&quot;cellular&quot;:&quot;4G LTE&quot;}}">View</a> -->
                                <a class="btn btn-xs btn-primary view-request" data-request="{{ $log_api->request }}">View</a>
                            </td>
                            <td>
                                <!-- <a class="btn btn-xs btn-primary view-response" data-response="{&quot;ResultCode&quot;:0,&quot;DateTimeStamp&quot;:&quot;2018-10-17 12:00:17&quot;}">View</a> -->
                                <a class="btn btn-xs btn-primary view-response" data-response="{{ $log_api->response}}">View</a>
                            </td>
                            <td>{{ $log_api->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                @if (count($log_apis) > 0)
                    {!! $log_apis->render() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default panel-default">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> Request/Response
                </span>
                <button type="button" class="pull-right close" data-dismiss="modal">&times;</button>
            </div>
            <div class="panel-body">
                <pre id="view_details">
                </pre>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#refreshlog").click(function () {
            location.reload();
        });

        $(".view-request").click(function () {
            var json = $(this).attr('data-request');
            //alert('json: ' + json);
            var jsonObj = JSON.parse(json);
            var jsonPretty = JSON.stringify(jsonObj, null, '\t');
            $("#view_details").html(jsonPretty);
            $('#myModal').modal('show');
        });

        $(".view-response").click(function () {
            var json = $(this).attr('data-response');
            //alert('json: ' + json);
            var jsonObj = JSON.parse(json);
            var jsonPretty = JSON.stringify(jsonObj, null, '\t');
            $("#view_details").html(jsonPretty);
            $('#myModal').modal('show');
        });

    });
</script>
@stop
