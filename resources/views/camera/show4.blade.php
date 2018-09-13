@extends('layouts.default')

@section('content')
<div id="app">
@include('layouts._nav')

<div class="fixed-navbar-container">
    <div class="container">
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 pull-right">

        </div>
    </div>

    <div class="row">
                <div id="camera_list" class="col-md-3 " style="padding-right:0px!important;padding-left:0px!important;">
            <div class="panel panel-default custom-settings-panel" >
                <div class="panel-heading" style="padding-top:4px;padding-bottom:4px;">
                    <span class="panel-title">
                        <strong>Cameras</strong>

                        <a class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Close" id="close_cameras"><i class="fa fa-window-close"></i></a>
                        <a id="btn-refresh" class="btn btn-xs btn-primary pull-right">Refresh</a>
                    </span>
                </div>
                <div class="panel-body" style="padding-right:2px!important;padding-left:2px!important;">
                    <table class="table table-condensed table-bordered camera-list-panel" style="font-size: .90em; margin-left: 0px;">
                        <tbody>

                                                        <tr>
                                <td class="col-sm-1">
                                                                    </td>
                                <td class="col-sm-5 ">
                                    <a href="/cameras/getdetail/15">Mountaineer</a><br />
                                    <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
                                    <span style="font-size: .95em">09/11/2018 9:00:18 am</span>
                                </td>
                                <td class="col-sm-6">
                                                                        <a class="btn thumb-select" data-id="15" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;"><img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/91985_thumb.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=30315b4712cab3ec9011f69489f828f35caf761c0949e884b64a2ce6986c7410" class="img-responsive" /></a>
                                                                    </td>
                            </tr>

                                                        <tr>
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
                                                                    </td>
                                <td class="col-sm-5 ">
                                    <a href="/cameras/getdetail/59">New Camera</a><br />
                                    <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
                                    <span style="font-size: .95em">08/20/2018 3:22:34 pm</span>
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
                                                                        <a class="btn thumb-select" data-id="54" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;"><img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" class="img-responsive" /></a>
                                                                    </td>
                            </tr>
                                                                            </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="camera_data" class="col-md-9" style="padding-left:6px!important;">
            <div class="panel panel-default panel-primary custom-settings-panel">

                <div class="panel-body custom-panel-body" style="padding-top:0px;">

                    <div class="gallery-toolbar camera-toolbar" style="margin-top:0px;">
                        <div class="row">
                            <div class="col-sm-12 clearfix">

                                <div class="pull-left" style="padding-top:0px;padding-bottom:0px;margin-top:4px">
                                    <div class="btn-group" role="group">
                                                                                <div class="btn-group" data-toggle="tooltip" title="Open Side Panel">
                                            <strong>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-default hidden"
                                                    id="show_cameras"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    style="padding-top:1px;padding-bottom:1px;padding-left:8px;padding-right:8px;margin-left:4px;margin-right:4px;"
                                                    >

                                                    <i class="fa fa-forward"></i>
                                                    <i class="fa fa-th-list"></i>
                                                </button>
                                            </strong>
                                        </div>

                                        <div class="btn-group hidden" role="group" id="camera_dropdown" data-toggle="tooltip" title="Select Camera">
                                            <button
                                                type="button"
                                                class="btn btn-default dropdown-toggle"
                                                style="padding-top:0px;padding-bottom:0px;padding-right:6px;"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-camera"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                    <li>
                                                        <a href="/cameras/getdetail/15">Mountaineer</a>
                                                    </li>

                                                    <li>
                                                        <a href="/cameras/getdetail/50">New Camera</a>
                                                    </li>

                                                    <li>
                                                        <a href="/cameras/getdetail/59">New Camera</a>
                                                    </li>

                                                    <li>
                                                        <a href="/cameras/getdetail/54">Truphone #1</a>
                                                    </li>

                                            </ul>
                                        </div>

                                        <div class="btn-group" role="group" style="margin-left:8px;font-size: 1.10em;padding-top:3px;">
                                             Truphone #1 |
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="tabs-54" class="tab-container">
                        <ul class="nav nav-tabs" id="cameratabs-54">
                            <li  ><a href="#overview-54" data-toggle="tab" data-tab="overview" data-url="/cameras/overview/54" aria-expanded="true"><span class="glyphicon glyphicon-list-alt"> </span> Overview</a></li>
                            <li  class="active" ><a href="#gallery-54"  data-toggle="tab" data-tab="gallery"  data-url="reload"                                      aria-expanded="true"><span class="glyphicon glyphicon-picture"> </span> Gallery</a></li>
                            <li  ><a href="#settings-54" data-toggle="tab" data-tab="settings"                                                        aria-expanded="false"><span class="glyphicon glyphicon-edit"> </span> Settings</a></li>
                            <li  ><a href="#action-54"   data-toggle="tab" data-tab="commands" data-url="/cameras/actions/54"  aria-expanded="false"><span class="glyphicon glyphicon-tasks"> </span> Actions</a></li>
                            <li  ><a href="#options-54"  data-toggle="tab" data-tab="options"                                                         aria-expanded="false"><span class="glyphicon glyphicon-cog"> </span> Options</a></li>
                        </ul>

                        <div id="myTabContent-54" class="tab-content">
@include('camera._overview')
@include('camera._gallery')
@include('camera._settings')
@include('camera._actions')
@include('camera._options')

<!-- OPTIONS TAB -->
<div class="tab-pane fade  " id="options-54">
                                <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Camera Options</h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">

                        <div class="panel panel-default panel-primary custom-settings-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-times-circle" style="color:red"></i> Delete this Camera
                                    <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="delete-camera"><i class="fa fa-question"></i></a>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="http://www.ridgetec.us/cameras/delete" id="delete-camera-form-54">
                                    <input type="hidden" name="_token" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">

                                    <input name="id" type="hidden" value="54">

                                    <div class="form-group">
                                        <label for="password inputSmall" class="col-md-5 control-label">Account Password</label>

                                        <div class="col-md-6">
                                            <input id="54_password_delete" type="password" class="form-control input-sm" name="password" required>

                                                                                        <button type="submit" class="btn btn-sm btn-primary">Delete Camera</button>
                                        </div>

                                    </div>
                                    <div class="alert alert-sm alert-info">
                                        <p><i class="fa fa-info-circle"></i> <strong>Note:</strong> You must input your account password, then click the delete camera button.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default panel-primary custom-settings-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Other Options
                                </h4>
                            </div>
                            <div class="panel-body">
                                <a href="/cameras/apilog/54" class="btn btn-sm btn-primary">View Camera Activity Log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete-camera" class="hidden">
    <div class="alert alert-sm alert-info help-container">
                <h4><strong>
        Before you delete this camera, you should realize that all media currently linked to the camera will be permanently removed.</strong>
</h4>

<p>
    <i class="fa fa-arrow-circle-right"></i> Because a camera will automatically link to your account when it is linked to an active data plan also on your account,
    you could cancel the data plan first to stop this from happening.
</p>

<p>
    <i class="fa fa-arrow-circle-right"></i> If this camera is tied to an active data plan, and you are moving your SIM with active plan to a new camera, move the SIM card
    first, get your new camera operating, then delete this camera.
</p>
<hr>

<h4><strong>Selling/Giving this camera to someone</strong></h4>
<p>
    <i class="fa fa-arrow-circle-right"></i> If you are selling/giving this camera to someone, you should likely provide it with its original SIM card, unless that SIM is tied
    to an active data plan on your account.  However, if you have purchased a new Ridgetec camera, you could keep your original SIM and active
    plans intact by placing your active SIM with plan into your new camera, and provide the new SIM from the retail package with your old camera.
    In this case, once you have your new camera operating on the portal with your old SIM, then you can delete the camera and someone else
    will be able to activate their own data plan using the brand new SIM and the camera will add to their account.
<hr>

<p><i class="fa fa-arrow-circle-right"></i> If you decide to cancel your data plan prior to deleting a camera, you have several options:</p>
    <ul>
        <li>Cancelling your active Pay as you go plan, will only mark it to cancel at the end of the current monthly billing cycle, giving you
            time to use the remaining Image Points</li>
        <li>Cancelling your active Pay as you go plan immediately, will deactivate the SIM card and you will lose any remaining Image Points</li>
        <li>Cancelling a Prepaid plan is not an option.
        <li>Assign the Data Plan to another account:  The Ridgetec Support team is able to migrate active Data Plans to another users Account.
            This means you should provide the SIM card linked to that data plan to that user (likely with a camera).  By assigning a data plan
            to another user, the remaining Image Points can be used by that user.  <strong>Keep in mind that if the Data Plan is a Pay as you go plan,
                the system will charge the new owner's credit card on the next billing cycle, not yours.</strong>
        </li>
    </ul>
</p>
    </div>
</div>
</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12 pull-right">

        </div>
    </div>

</div>



        <div id="help_panel" class="side-panel hidden" style="overflow-y: auto;">

                <div style="position: fixed;"><a class="btn btn-sm btn-default btn-info help_close" style="border-radius: 25px 0px 0px 25px;"><i class="fa fa-times"></i></a></div>
                <div id="help_content">
                </div>

        </div>

    </div>


    <!-- bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- Jquery-ui -->
    <script src="http://www.ridgetec.us/jquery-ui-1.12.1/jquery-ui.js"></script>

    <script src="http://www.ridgetec.us/js/button-checkbox.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <!--<script src="http://www.ridgetec.us/js/gallery.js"></script>-->
    <script src="http://www.ridgetec.us/js/jquery.slidereveal.min.js"></script>
    <script>
    $(document).ready(function(){

        $( ".ToggleHelp" ).click(function() {
            //alert('Toggle');
            var id = $(this).attr('help-id');

            $(".side-panel").removeClass('hidden');

            $("#help_content").html($('#' + id).html());
            $("#help_panel").slideReveal("toggle");
        });


        $( ".help_close" ).click(function() {
            //alert('help close');
            $("#help_panel").slideReveal("hide");
        });

        $(function() {
            var ww = $( window ).width();
            if (ww < 481) {
                p = '85%';
            }
            else {
                p = '50%';
            }
            var params = {
              push: false,
              overlay: true,
              width: p,
              position: "right",
              //top: 60,
              speed: 500
            };

            $("#help_panel").slideReveal(
                    params
                    );
        });

    });
    </script>
    <!--<script src="http://www.ridgetec.us/js/gallery.js"></script>-->
<script>
    //console.log('cameras page just loaded: 54');
    function isPortrait() {
        return window.innerHeight > window.innerWidth;
    }

    function isLandscape() {
        return (window.orientation === 90 || window.orientation === -90);
    }

    var cameraId = '54';
    var lastCamera = JSON.parse(sessionStorage.getItem('currentCam')) || null;

    //console.log('cameraId ' + cameraId);
    //console.log('lastCamera ' + lastCamera);

    if(cameraId !== lastCamera){
        //console.log('current camera <> lastcamera');
        sessionStorage.removeItem('manageOn');
        sessionStorage.removeItem('items');
        sessionStorage.setItem('currentCam', JSON.stringify(cameraId));
        var el = document.getElementById("itemAmount");
        if (el) {
           document.getElementById('itemAmount').innerHTML = getbadge(0);
        }

    }

    var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
    if (!manageSelected) {
        sessionStorage.setItem('manageOn', JSON.stringify(false));
    }

    var windowload = false;
    var documentready = false;
    var is_landscape = isLandscape();

$(document).ready(function(){
    console.log('document ready just fired');
    var height = $('.custom-thumbnail-grid-column').height();
    var width = $('.custom-thumbnail-grid-column').width();
    $('#show_cameras').click(function() {
        //alert('after open');
        $.get('/account/showcameralist/open');
        $("#camera_data").removeClass('col-md-12');
        $("#camera_data").addClass('col-md-9');
        $("#camera_list").removeClass('hidden');
        $("#show_cameras").addClass('hidden');
        $("#camera_dropdown").addClass('hidden');

        $("#camera_list").hide();
        $("#camera_list").show(500);
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        $('.check-label .span-cr').height(height);
        $('.check-label .span-cr').width(width);
    });

    $('#close_cameras').click(function() {

        $("#show_cameras").show();
        $("#show_cameras").removeClass('hidden');
        $("#camera_dropdown").removeClass('hidden');
        $("#camera_list").hide();
        $("#camera_data").addClass('col-md-12');
        $("#camera_data").removeClass('col-md-9');
        $("#show_cameras").show();
        $.get('/account/showcameralist/close');
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        $('.check-label .span-cr').height(height);
        $('.check-label .span-cr').width(width);
    });

    $("#btn-refresh").click(function () {
        window.location.reload(false);
    });

    $("#notify_photo").click(function () {
        //alert('notify_photo');
        var cam = $(this).attr('data-cam');
        var url = '/cameras/testnotify/photo/' + cam + '/62830';
        $('#notify-photo-msg').load(url);
    });

    $("#notify_video").click(function () {
        var cam = $(this).attr('data-cam');
        var url = '/cameras/testnotify/video/' + cam + '/62852';
        $('#notify-video-msg').load(url);
    });


    $(".thumb-select").click(function () {
        id = $(this).attr('data-id');
        url = '/cameras/getdetail/' + id;
        //alert('thumb-select' + url);
        $.post("/cameras/activetab",
        {
          tab: 'gallery'
        },
        function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            window.location.href = url;
        });

    });

    //the reason for the odd-looking selector is to listen for the click event
    // on links that don't even exist yet - i.e. are loaded from the server.
    // respond to tab change
    $('#tabs-54').on('click','.tablink,#cameratabs-54 a',function (e) {
        //alert('tab change');
        e.preventDefault();
        var url = $(this).attr("data-url");
        var tabname = $(this).attr("data-tab");
        var data = '';

        //alert('tabname = ' + tabname);
        //alert('url = ' + url);
        $.post("/cameras/activetab",
        {
          tab: tabname,
        },
        function(data, status){
             //alert("Data: " + data + "\nStatus: " + status);
        });

    //alert('hold on');

        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;

            setTimeout(
              function()
              {

                if (url == "reload") {
                    //alert('reload');
                    location.reload();
                }
                else {

                //alert('ajax');
                // ajax load from data-url
                $(href).load(url,data,function(result){
                    //alert(result);
                    n = result.search("Unauthenticated");
                    //alert('n = ' + n);
                    if (n == -1) {
                        pane.tab('show');
                    }
                    else {
                        //alert('reload');
                        location.reload();
                    }

                });

               }

              }, 500);


            //alert('url = ' + url);
            $(this).tab('show');
        } else {
            $(this).tab('show');
        }
    });


});


</script>
@stop
