<div id="camera_list" class="col-md-3" style="padding-right:0px!important;padding-left:0px!important;">

    <!-- CAMERA LIST -->
    <div class="panel panel-default custom-settings-panel" >

        <div class="panel-heading" style="padding-top:4px;padding-bottom:4px;">
            <span class="panel-title">
                <strong>Cameras</strong>
                <a class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Close" id="close_cameras">
                    <i class="fa fa-window-close"></i>
                </a>
                <a id="btn-refresh" class="btn btn-xs btn-primary pull-right">Refresh</a>
            </span>
        </div>

        <div class="panel-body" style="padding-right:2px!important;padding-left:2px!important;">
            <table class="table table-condensed table-bordered camera-list-panel" style="font-size: .90em; margin-left: 0px;">

                <!--<thead>
                    <tr>
                      <th>A</th>
                      <th>B</th>
                      <th>C</th>
                    </tr>
                </thead>-->

                <tbody>
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_List($camera->id) !!}

<!--                     <tr>
                        <td class="col-sm-1">
                        </td>
                        <td class="col-sm-5 ">
                            <a href="/cameras/getdetail/50">New Camera</a><br />
                            <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
                            <span style="font-size: .95em">07/12/2018 5:49:00 am</span>
                        </td>
                        <td class="col-sm-6">
                        </td>
                    </tr>

                    <tr>
                        <td class="col-sm-1">
                            <i class="fa fa-camera"> </i>
                        </td>
                        <td class="col-sm-5 active">
                            <a href="/cameras/getdetail/54">Truphone #1</a><br />
                            <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
                            <span style="font-size: .95em">09/10/2018 3:00:16 pm</span>
                        </td>
                        <td class="col-sm-6">
                        </td>
                    </tr>
 -->
                </tbody>
            </table>
        </div>
    </div>
</div>
