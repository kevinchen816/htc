
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/ico" href="/favicon.ico"  />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">

    <title>private</title>

    <!-- Styles -->
    <link href="http://www.ridgetec.us/css/app.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-S7YMK1xjUjSpEnF4P8hPUcgjXYLZKK3fQW1j5ObLSl787II9p8RO9XUGehRmKsxd" crossorigin="anonymous">

    <link href="http://www.ridgetec.us/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link href="http://www.ridgetec.us/css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken":"ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl"};
    </script>
    <script src="https://use.fontawesome.com/9712be8772.js"></script>

    <style>
        @media (max-width: 1100px) {
            .navbar-header {
                float: none;
            }
            .navbar-left,.navbar-right {
                float: none !important;
            }
            .navbar-toggle {
                display: block;
            }
            .navbar-collapse {
                border-top: 1px solid transparent;
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            }
            .navbar-fixed-top {
                        top: 0;
                        border-width: 0 0 1px;
                }
            .navbar-collapse.collapse {
                display: none!important;
            }
            .navbar-nav {
                float: none!important;
                        margin-top: 7.5px;
                }
                .navbar-nav>li {
                float: none;
            }
            .navbar-nav>li>a {
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .collapse.in{
                        display:block !important;
                }
        }

    </style>
    <link rel="stylesheet" href="http://www.ridgetec.us/css/thumbnail-gallery.css" media="screen">
<link rel="stylesheet" href="http://www.ridgetec.us/css/gallery.css" media="screen">
<style>
    .custom-time-toggle-td {
        padding-right: 2px;
        padding-bottom: 6px;
    }
    .tab-set {
        background-color: #888;
    }
    .tab-headers {
        background-color: #aaa;
    }
    .custom-duty-col {
        margin-right: 0px;
        margin-left: 0px;
    }
    .duty-time-button {
        margin-right: 6px;
        margin-bottom: 4px;
    }


    .custom-image {
        width: 98%;
    }

    table.collapse.in {
       display: table;
    }

    .panel > .camera-data-heading {
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        color: #fff;
        background-color: #9d0b0e;
    }

    .camera-list-panel {
        background-color: #222;
    }
    .camera-list-panel a {
        color: #fff!important;
    }

    .navbar-camera {
        background-color: #9d0b0e;
        //min-height: 20px!important;
        padding-left: 0px;
        padding-bottom: 0px;
    }

    .camera-toolbar {
        background-color: #9d0b0e;
        padding-bottom: 0px;
        padding-top: 0px;
        margin-bottom:6px;
    }
</style>

</head>
<body>
    <div id="app">

    </div>

<!-- GALLERY TAB -->
<div class="tab-pane fade  active in" id="gallery-54">
    <style type="text/css">
            .panel-body{
                overflow-x: hidden;
            }
            @media (max-width: 500px){
                .panel-body{
                    overflow-x: visible;
                }
            }
        .cancel-modal,
        .confirm-modal{
            margin: 10px;
        }

        .image-checkbox {
            position: absolute;
            z-index: 5;
        }

        .check-label input {
            display: none
        }

        .check-label {
            position: relative;
            cursor: pointer;
        }

        .check-label .span-cr {
            display: inline-block;
            position: absolute;
            left: -10px;
            top: -25px;
            background-color:rgba(0, 0, 0, 0.3);
        }

        .check-label input:checked + .span-cr {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .check-label:hover .span-cr{
            background-color: rgba(0, 0, 0, 0.4);
        }

        .check-label input:checked + .span-cr:after{
            background-repeat: no-repeat;
            background-image: url(http://www.ridgetec.us/images/Check-Mark2.png);
            background-size: 100% 100%;
            position: absolute;
            top: 5%;
            left: 0%;
            height: 95%;
            width: 100%;
            content: ' ';
        }

        .thumbnail-timestamp {
            position: absolute;
            width: 100%;
            //height:95%;
            bottom: 3px;
            background-color:rgba(0, 0, 0, 0.35);
            padding-bottom: 2px;
            padding-right:10px;
        }

        .custom-thumbnail-grid-column {
            padding-left: 3px!important;
            padding-right: 0px;
            margin-top: 0px!important;
            margin-bottom: 0px!important;
            padding-bottom: 4px!important;
        }

        .row.no-gutters {
          margin-right: 0;
          margin-left: 0;
        }

        .row.no-gutters > [class^="col-"],
        .row.no-gutters > [class*=" col-"] {
          padding-right: 0;
          padding-left: 0;
        }

        .popup-video {
            position: absolute;
            top: 20%;
            left: 32%;
            height: 60%;
            width: 36%;
            background-repeat: no-repeat;
            background-image: url(http://www.ridgetec.us/images/icon-play-video-white.png);
            background-size: 100% 100%;
            cursor: pointer;
        }

        .custom-video-close {
            position: absolute;

            /* don't need to go crazy with z-index here, just sits over .modal-guts */
            z-index: 1100!important;

            top: -4px;
            right: -4px;
            width: 30px;
            height: 30px;
            border: 0;
            background-image: url(http://www.ridgetec.us/images/close-icon.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            //background-color:rgba(0, 0, 0, 1.00)!important;
            //background-color: black;
            color: white;
            padding: 0px 0px 0px 0px!important;
            //font-size: 4.0rem;
            opacity: 1.0;
        }

        .modal-video-content {
            padding-top:0px;
            padding-right:0px;
            padding-bottom:0px;
            padding-left:0px;
            background-color: transparent;
                margin-top:8px;
                border-style: solid;
            border-color: #9d0b0e;
            border-width: 3px;
        }

        .modal-dialog-player {
           //width: 77%;
           margin: 0 auto;
        }

        /*
        @media  screen and (orientation : portrait) {
            .modal-dialog-player {
               width: 100%;
               margin: 0 auto;
            }
        }
        */

        @media  screen and (max-width: 480px) {
            .thumbnail-timestamp {
                display: none !important;
            }

        }
    </style>

    <div class="panel panel-default panel-primary custom-settings-panel">

        <div class="panel-heading" style="padding-top:6px;">
            <h4 class="panel-title">
                <span style="font-size: .70em; margin-top: 6px; margin-left: 1px;">
                    <i class="fa fa-camera" style="color:lime;"></i> HighRes | <i class="fa fa-hourglass" style="color:#ffd352;"></i> Pending Request
                </span>

                <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="gallery"><i class="fa fa-question"></i></a>

                <span class="pull-right" style="font-size: .70em; margin-top: 6px;">
                    <strong>(3 thumbs this page) | Page 1 of 1</strong>
                </span>
            </h4>
        </div>

        <div class="panel-body" style="padding-top:2px;">
            <!-- ====GALLERY CODE== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="col-count-4 gallery-manager" data-col="4" data-row="6">

                        <!-- gallery-toolbar -->
                        <form method="POST" action="http://www.ridgetec.us/cameras/gallery" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-54"><input name="_token" type="hidden" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">
                            <input name="id" type="hidden" value="54">
                                <div class="thumbnail-gallery" data-token="">
                                    <div id="info"></div>
                                    <!-- Begin Row -->
                                    <div class="row no-gutters">


@foreach ($photos as $photo)
                                        <!-- PICT -->
                                        <div class="col-xs-3 custom-thumbnail-grid-column column-number-1">
                                            <div class="image-checkbox">
                                                <label style="font-size: 1.5em" class="check-label hidden">
                                                    <input type="checkbox" class="image-check" value="90815" id="check_90815" />
                                                    <span class="cr span-cr"></span>
                                                </label>
                                            </div>
                                            <div class="image-highdef pull-right" hidden id="pending-90815">
                                                <label style="font-size: 1.0em; margin-right: 4px;">
                                                    <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                                                </label>
                                            </div>
                                            <a class="thumb-anchor" data-fancybox="gallery-54"
                                                href="uploads/images/{{$photo->filepath}}"
                                                data-caption="PICT0019.JPG | 09/08/2018 9:20:42 pm | Scheduled Upload | Standard Low(1/20/16136) | Points: 1.00"
                                                data-camera="54"
                                                data-id="90815"
                                                data-highres="0"
                                                data-pending="0">

                                               <img src="uploads/images/{{$photo->filepath}}"
                                                class="img-responsive custom-thumb"
                                                title="{{$photo->filename}}"
                                                alt="{{$photo->filename}}"
                                                data-description="{{$photo->filename}}">
                                            </a>
                                            <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                                                <a href="/cameras/download/54/90815"><i class="fa fa-download"></i></a>
                                                09/08/2018 9:20:42 pm
                                            </p>
                                        </div>
@endforeach

                                        <!-- PICT -->
                                        <div class="col-xs-3 custom-thumbnail-grid-column column-number-1">
                                            <div class="image-checkbox">
                                                <label style="font-size: 1.5em" class="check-label hidden">
                                                    <input type="checkbox" class="image-check" value="90815" id="check_90815" />
                                                    <span class="cr span-cr"></span>
                                                </label>
                                            </div>
                                            <div class="image-highdef pull-right" hidden id="pending-90815">
                                                <label style="font-size: 1.0em; margin-right: 4px;">
                                                    <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                                                </label>
                                            </div>
                                            <a class="thumb-anchor" data-fancybox="gallery-54"
                                                href="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" data-caption="PICT0019.JPG | 09/08/2018 9:20:42 pm | Scheduled Upload | Standard Low(1/20/16136) | Points: 1.00" data-camera="54" data-id="90815" data-highres="0" data-pending="0">
                                                <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" class="img-responsive custom-thumb" title="PICT0019.JPG (90815)" alt="PICT0019.JPG" data-description="PICT0019.JPG">
                                            </a>
                                            <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                                                <a href="/cameras/download/54/90815"><i class="fa fa-download"></i></a>
                                                09/08/2018 9:20:42 pm
                                            </p>
                                        </div>
                                    <!-- End Row -->
                                </div>
                                <!-- thumbnail-gallery -->
                        </form>
                    </div>
                    <!-- gallery-manager -->
                </div>
                <!-- col-md-12 -->
            </div>
            <!-- row -->
        </div>
        <!-- panel-body -->

        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm" style="padding-left:2px;margin-left:2px;">
                </div>
            </div>
        </div>
    </div>
    <!-- panel -->

    <script src="js_001.js"></script>

    <script src="http://www.ridgetec.us/js/gallery.js"></script>
</div>

<!-- SETTINGS TAB -->

</form>

</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
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

</body>
</html>