@extends('layouts.default2')
@section('header')
<div class="container">
    <div class="row">
        <h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('cameras') }}">My Cameras</a></li>
            <li class="active">Activity Log for {{ $camera->description }}</li>
        </ol>
        </h4>
    </div>
</div>
@stop

@section('content')
<div class="container">

    @if (count($log_apis) > 0)
        {!! $log_apis->render() !!}
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-list"></i> Results
                    </span>
                    <span class="pull-right"><a class="btn btn-xs btn-primary" id="refreshlog">Refresh</a>
                    </span>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><br />ID</th>
                                <th>Camera<br />Operation</th>
                                <th><br />Result</th>
                                <th>From<br/>Camera</th>
                                <th>Server<br />Response</th>
                                <th><br />Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                            {!! $cc->LogApi_List($log_apis) !!}

                            <tr>
                                <td>104515</td>
                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>
                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  8944503540145562672
               Module ID:  861107030190590
                FileName:  PICT0006.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  50.00%
              Card Space:  7384MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                </td>
                                <td>
                                </td>
                                <td>10/09/2018 5:49:44 pm</td>
                            </tr>

                            <tr>
                                <td>104562</td>

                                <td>Download Settings</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                        <a class="btn btn-xs btn-primary view-response" data-response="             Camera Mode:  Photo
        Photo Resolution:  4MP 16:9
        Video Resolution:  Standard Low
              Frame Rate:  4fps
           Quality Level:  500
            Video Length:  5s
             Video Sound:  On
             Photo Burst:  Off
             Burst Delay:  500ms
       Upload Resolution:  Standard Low
          Upload Quality:  Standard
              Time Stamp:  On
             Date Format:  Ymd
             Time Format:  24 Hour
             Temperature:  Celsius
              Quiet Time:  0s
              Time Lapse:  On
    Timelapse Start Time:  00:00
     Timelapse Stop Time:  23:59
      Timelapse Interval:  5m
           Wireless Mode:  Instant
       Schedule Interval:  Every Hour
     Schedule File Limit:  20 Files
      Heartbeat Interval:  Every Hour
Action Process Time Limit:  2m
       Cellular Password:
          Remote Control:  Disabled
            Block Mode 1:  Off
            Block Mode 2:  Off
            Block Mode 3:  Off
            Block Mode 4:  Off
            Block Mode 5:  Off
            Block Mode 7:  Off
            Block Mode 8:  Off
            Block Mode 9:  Off
           Block Mode 10:  Off
           Block Mode 11:  Off
">View</a>
                                                                    </td>
                                <td>10/09/2018 6:58:42 pm</td>
                            </tr>

                        </tbody>
                    </table>
                </div>




            </div>
        </div>
    </div>

    @if (count($log_apis) > 0)
        {!! $log_apis->render() !!}
    @endif
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default panel-default">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> Details
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
            var data = $(this).attr('data-request');
            $("#view_details").html(data);
            $('#myModal').modal('show');
        });

        $(".view-response").click(function () {
            var data = $(this).attr('data-response');
            $("#view_details").html(data);
            $('#myModal').modal('show');
        });

    });
</script>
@stop
