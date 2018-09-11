<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/ico" href="/favicon.ico"  />

    <title>Sample App</title>

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
<!-- <script>
    window.Laravel = {"csrfToken":"ENK9h0dCsQifiUS1npLuX8YB8BZNv8qMN6cb92Uw"};
</script>
 -->
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

@foreach ($photos as $photo)

        <div class="col-xs-3 custom-thumbnail-grid-column column-number-2">
            <div class="image-checkbox">
                <!--<label style="font-size: 1.5em" class="check-label hidden">-->
                <label style="font-size: 1.5em" class="check-label">
                    <input type="checkbox" class="image-check" value="90227" id="check_90227" />
                    <span class="cr span-cr"></span>
                </label>
            </div>

            <!--<div class="image-highdef pull-right" hidden id="pending-90227">-->
            <div class="image-highdef pull-right" id="pending-90227">
                <label style="font-size: 1.0em; margin-right: 4px;">
                    <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                </label>
            </div>

             <a class="thumb-anchor"
                data-fancybox="gallery-15"
                href=""
                data-caption="PICT4437.JPG | 09/07/2018 8:06:40 pm | Scheduled Upload | Standard Medium(2/50/41706) | Points: 3.25"
                data-camera="15"
                data-id="90227"
                data-highres="0"
                data-pending="0">

                <img src="uploads/images/{{$photo->filepath}}"
                class="img-responsive custom-thumb"
                title="{{$photo->filename}}"
                alt="{{$photo->filename}}"
                data-description="{{$photo->filename}}">
            </a>

            <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                <a href="/cameras/download/15/90227"><i class="fa fa-download"></i></a>
                09/07/2018 8:06:40 pm
            </p>
        </div>
@endforeach

</body>
</html>
