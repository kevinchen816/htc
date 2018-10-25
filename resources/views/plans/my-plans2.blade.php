@extends('layouts.default2')

@section('header')
<br>
@stop

@section('content')
<div class="container">

    @if (count($plans) > 0)
        {!! $plans->render() !!}
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
                                <th>ICCID</th>
                                <th>Plan Points</th>
                                <th>Points Used</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @inject('pc', 'App\Http\Controllers\PlansController')
                            {!! $pc->MyPlans2($plans) !!}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @if (count($plans) > 0)
        {!! $plans->render() !!}
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
