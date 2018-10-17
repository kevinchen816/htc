<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/ico" href="/favicon.ico"  />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '10ware Portal')</title>

    <!-- Styles -->
    <!-- <link href="https://portal.ridgetec.com/css/app.css" rel="stylesheet"> -->
    <link href="/css/app.css" rel="stylesheet"> <!-- kevin -->

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-S7YMK1xjUjSpEnF4P8hPUcgjXYLZKK3fQW1j5ObLSl787II9p8RO9XUGehRmKsxd" crossorigin="anonymous">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" rel="stylesheet"> -->

    <!-- <link href="https://portal.ridgetec.com/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet"> -->
    <link href="/css/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet"> <!-- kevin -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- <link href="https://portal.ridgetec.com/css/styles.css" rel="stylesheet"> -->
    <link href="/css/styles.css" rel="stylesheet">  <!-- kevin -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken":"{{ csrf_token() }}"};
    </script>
    <!-- <script src="https://use.fontawesome.com/9712be8772.js"></script> -->
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
<link rel="stylesheet" href="https://portal.ridgetec.com/css/thumbnail-gallery.css" media="screen">
<link rel="stylesheet" href="https://portal.ridgetec.com/css/gallery.css" media="screen">
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

        <div class="fixed-navbar-container">
            <div class="container">
                @include('shared._messages')
                @yield('header')
            </div>
        </div>

        @yield('welcome')
        @yield('content')

        <div id="help_panel" class="side-panel hidden" style="overflow-y: auto;">
            <div style="position: fixed;">
                <a class="btn btn-sm btn-default btn-info help_close" style="border-radius: 25px 0px 0px 25px;">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div id="help_content">
            </div>
        </div>
    </div>

    @include('layouts._footer')

    <!-- bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Jquery-ui -->
    <!-- <script src="https://portal.ridgetec.com/jquery-ui-1.12.1/jquery-ui.js"></script> -->
    <script src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script> <!-- kevin -->

    <!-- <script src="https://portal.ridgetec.com/js/button-checkbox.js"></script> -->
    <script src="/js/button-checkbox.js"></script> <!-- kevin -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <!--<script src="https://portal.ridgetec.com/js/gallery.js"></script>-->
    <!--<script src="/js/gallery.js"></script>--> <!-- kevin --><!-- tab_gallery.blade.php -->

    <!-- <script src="https://portal.ridgetec.com/js/jquery.slidereveal.min.js"></script> -->
    <script src="/js/jquery.slidereveal.min.js"></script> <!-- kevin -->
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

@yield('javascript')
</body>
</html>
