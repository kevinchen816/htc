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
    <!-- <meta name="csrf-token" content="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '10ware Portal')</title>

    <!-- Styles -->
    <!--<link href="http://www.ridgetec.us/css/app.css" rel="stylesheet">-->
    <link href="/css/app.css" rel="stylesheet"> <!-- kevin -->

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-S7YMK1xjUjSpEnF4P8hPUcgjXYLZKK3fQW1j5ObLSl787II9p8RO9XUGehRmKsxd" crossorigin="anonymous">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/slate/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cyborg/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css" rel="stylesheet"> -->

    <!--<link href="http://www.ridgetec.us/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">-->
    <link href="/css/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet"> <!-- kevin -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!--<link href="http://www.ridgetec.us/css/styles.css" rel="stylesheet">-->
    <link href="/css/styles.css" rel="stylesheet">  <!-- kevin -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script>
        // window.Laravel = {"csrfToken":"ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl"};
        window.Laravel = {"csrfToken":"{{ csrf_token() }}"};
    </script>
    <!--<script src="https://use.fontawesome.com/9712be8772.js"></script>-->
    <script src="/js/9712be8772.js"></script> <!-- kevin -->

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
    <!--<link rel="stylesheet" href="http://www.ridgetec.us/css/thumbnail-gallery.css" media="screen">-->
    <!--<link rel="stylesheet" href="http://www.ridgetec.us/css/gallery.css" media="screen">-->
    <link rel="stylesheet" href="/css/thumbnail-gallery.css" media="screen"> <!-- kevin -->
    <link rel="stylesheet" href="/css/gallery.css" media="screen"> <!-- kevin -->

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
        @include('layouts._header2')
        @include('shared._messages')
        @yield('content')
    </div>

    <!-- bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Jquery-ui -->
    <!--<script src="http://www.ridgetec.us/jquery-ui-1.12.1/jquery-ui.js"></script>-->
    <script src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script> <!-- kevin -->

    <!--<script src="http://www.ridgetec.us/js/button-checkbox.js"></script>-->
    <script src="/js/button-checkbox.js"></script> <!-- kevin -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <!--<script src="http://www.ridgetec.us/js/gallery.js"></script>-->
    <!--<script src="/js/gallery.js"></script>--> <!-- kevin --><!-- _gallery.blade.php -->

    <!--<script src="http://www.ridgetec.us/js/jquery.slidereveal.min.js"></script>-->
    <script src="/js/jquery.slidereveal.min.js"></script> <!-- kevin -->
    <script>
    $(document).ready(function(){
        console.log('>> ready #1.................[default.blade.php]');
        $( ".ToggleHelp" ).click(function() {
            alert('Toggle'); // kk-debug
            var id = $(this).attr('help-id');
            console.log('help-id='+id); // kevin

            $(".side-panel").removeClass('hidden');

            $("#help_content").html($('#' + id).html());
            $("#help_panel").slideReveal("toggle");
        });

        $( ".help_close" ).click(function() {
            alert('help close'); // kk-debug
            $("#help_panel").slideReveal("hide");
        });

        $(function() {
            var ww = $( window ).width();
            console.log('ww='+ww);
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

            $("#help_panel").slideReveal(params);
        });
        console.log('<< ready #1.................[default.blade.php]');
    });
    </script>

    <!--<script src="http://www.ridgetec.us/js/gallery.js"></script>-->
    <script>
        console.log('cameras page just loaded: {{ $camera->id }}'); // kk-debug
        function isPortrait() {
            return window.innerHeight > window.innerWidth;
        }

        function isLandscape() {
            return (window.orientation === 90 || window.orientation === -90);
        }

        var cameraId = {{ $camera->id }}; //'54';
        var lastCamera = JSON.parse(sessionStorage.getItem('currentCam')) || null;

        console.log('cameraId ' + cameraId); // kk-debug
        console.log('lastCamera ' + lastCamera); // kk-debug

        if(cameraId !== lastCamera){
            console.log('current camera <> lastcamera'); // kk-debug
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

        $(document).ready(function() {
            console.log('>> ready #2 .................[default.blade.php]');
            console.log('document ready just fired');
            var height = $('.custom-thumbnail-grid-column').height();
            var width = $('.custom-thumbnail-grid-column').width();

            $('#show_cameras').click(function() {
                //alert('after open'); // kk-debug
                alert('click -> #show_cameras'); // kk-debug
                $.get('/account/showcameralist/open');

                $("#camera_data").removeClass('col-md-12');
                $("#camera_data").addClass('col-md-9');
                $("#show_cameras").addClass('hidden');
                $("#camera_dropdown").addClass('hidden');

                $("#camera_list").removeClass('hidden');
                $("#camera_list").hide();
                $("#camera_list").show(500);

                height = $('.custom-thumbnail-grid-column').height();
                width = $('.custom-thumbnail-grid-column').width();
                $('.check-label .span-cr').height(height);
                $('.check-label .span-cr').width(width);
            });

            $('#close_cameras').click(function() {
                alert('click -> #close_cameras'); // kk-debug
                //$("#show_cameras").show(); // kevin del
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
                alert('notify_photo'); // kk-debug
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
                console.log('==> .thumb-select'); // kevin
                id = $(this).attr('data-id');
console.log('id='+id); // kevin

                url = '/cameras/getdetail/' + id;
                //alert('thumb-select' + url);
                $.post("/cameras/activetab",
                {
                  _token: '{{csrf_token()}}',  // kevin add ?
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

            // $('#tabs-54').on('click','.tablink,#cameratabs-54 a',function (e) {
            $('#tabs-{{ $camera->id }}').on('click','.tablink,#cameratabs-{{ $camera->id }} a',function (e) {
alert('>> #tabs-{{ $camera->id }} ...click');

                //alert('tab change');
                e.preventDefault();
                var url = $(this).attr("data-url");
                var tabname = $(this).attr("data-tab");
                var data = '';

console.log('tabname = ' + tabname); // overview
console.log('url = ' + url); // http://sample.test/cameras/overview/1
                //alert('tabname = ' + tabname);
                //alert('url = ' + url);
                $.post("/cameras/activetab",
                {
                    _token: '{{csrf_token()}}',  // kevin add ?
                    tab: tabname,
                },
                function(data, status){
console.log('data = ' + data); // overview
console.log('status = ' + status);
                     //alert("Data: " + data + "\nStatus: " + status);
                });

                //alert('hold on');
                if (typeof url !== "undefined") {
                    var pane = $(this), href = this.hash;
console.log('pane = ' + pane);
console.log('href = ' + href); // #overview-1

                    setTimeout(function(){
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

                } else {
                    $(this).tab('show');
                }
            });
            console.log('<< ready #2 .................[default.blade.php]');
        });
    </script>
</body>
</html>
