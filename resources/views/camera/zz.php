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
    <meta name="csrf-token" content="IwJbipYGTDbGzmycyY0EWdoznxyz2pdqejNUm6pm">

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
        window.Laravel = {"csrfToken":"IwJbipYGTDbGzmycyY0EWdoznxyz2pdqejNUm6pm"};
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


</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid navbar-container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="http://www.ridgetecoutdoors.com" target="_blank" title="RidgeTec Home">
                                                Private Site
                                            </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!--<ul class="nav navbar-nav">

                    </ul>-->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                                                    <li class=""><a href="http://www.ridgetec.us/plans/add-plan"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a></li>


                            <li class=""><a href="http://www.ridgetec.us/cameras"><i class="fa fa-camera"></i> My Cameras</a></li>

                            <li class=""><a href="http://www.ridgetec.us/account/profile"><i class="fa fa-gear"></i> My Account</a></li>
                            <li class=""><a href="http://www.ridgetec.us/help/plans">PLAN INFO</a></li>

                            <li class="dropdown ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     Support <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="http://www.ridgetec.us/help/quick-start">Camera Quick Start Guide</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Kevin <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                                                                    <a href="http://www.ridgetec.us/admin"><i class="fa fa-btn fa-unlock"> </i> Admin Panel</a>
                                                                                <a href="http://www.ridgetec.us/logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="http://www.ridgetec.us/logout" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="IwJbipYGTDbGzmycyY0EWdoznxyz2pdqejNUm6pm">
                                        </form>
                                    </li>
                                </ul>
                            </li>
                                            </ul>
                </div>
            </div>
        </nav>


        <div class="fixed-navbar-container">
            <div class="container">
                                <div class="container">
    <div class="row">
        <h4>
            <ol class="breadcrumb">

									<li><a href="http://www.ridgetec.us/cameras">My Cameras</a></li>
												<li class="active">Activity Log for 861107030190590 (lookout)</li>
					                	</ol>

        </h4>
    </div>
</div>
            </div>
        </div>
        <div class="container">

    <div class="row">
        <div class="col-md-12 pull-right">
            <ul class="pagination pagination">

                    <li class="disabled"><span>&laquo;</span></li>

                                                                        <li class="active"><span>1</span></li>
                                                                                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=2">2</a></li>
                                                                                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=3">3</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li><span>...</span></li>
                            <li class="hidden-xs"><a href="http://www.ridgetec.us/cameras/apilog/54?page=165">165</a></li>


                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=2" rel="next">&raquo;</a></li>
            </ul>

        </div>
    </div>

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
                            <tr>
                                <td>104631</td>
                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                    <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0045.JPG
       Upload Resolution:  Standard Medium
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  71.88%
              Card Space:  7358MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                </td>
                                <td>
                                </td>
                                <td>10/11/2018 8:02:13 pm</td>
                            </tr>


                            <tr>
                                <td>104629</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0044.JPG
       Upload Resolution:  Standard Medium
                  Source:  Motion
                 Battery:   100%
                  Signal:  71.88%
              Card Space:  7359MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:58:13 pm</td>
                            </tr>


                            <tr>
                                <td>104628</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0043.JPG
       Upload Resolution:  Standard Medium
                  Source:  Motion
                 Battery:   100%
                  Signal:  71.88%
              Card Space:  7360MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:57:12 pm</td>
                            </tr>


                            <tr>
                                <td>104627</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0042.JPG
       Upload Resolution:  Standard Medium
                  Source:  Motion
                 Battery:   100%
                  Signal:  96.88%
              Card Space:  7361MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:52:54 pm</td>
                            </tr>


                            <tr>
                                <td>104626</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0041.JPG
       Upload Resolution:  Standard Medium
                  Source:  Motion
                 Battery:   100%
                  Signal:  71.88%
              Card Space:  7362MB
               Card Size:  7576MB
             Temperature:  28C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:52:24 pm</td>
                            </tr>


                            <tr>
                                <td>104625</td>

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
       Upload Resolution:  Standard Medium
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
                                <td>10/11/2018 7:51:48 pm</td>
                            </tr>


                            <tr>
                                <td>104624</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0040.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  309.38%
              Card Space:  7362MB
               Card Size:  7576MB
             Temperature:  82F
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:51:46 pm</td>
                            </tr>


                            <tr>
                                <td>104623</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0039.JPG
       Upload Resolution:  Standard Low
                  Source:  Menu
                 Battery:   100%
                  Signal:  43.75%
              Card Space:  7363MB
               Card Size:  7576MB
             Temperature:  77F
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/11/2018 7:46:43 pm</td>
                            </tr>


                            <tr>
                                <td>104563</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0038.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  59.38%
              Card Space:  7365MB
               Card Size:  7576MB
             Temperature:  32C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:59:21 pm</td>
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


                            <tr>
                                <td>104561</td>

                                <td>Status</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:58:41 pm</td>
                            </tr>


                            <tr>
                                <td>104560</td>

                                <td>Firmware Update</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:58:18 pm</td>
                            </tr>


                            <tr>
                                <td>104558</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0037.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  68.75%
              Card Space:  7358MB
               Card Size:  7576MB
             Temperature:  31C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:56:56 pm</td>
                            </tr>


                            <tr>
                                <td>104557</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0036.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  62.50%
              Card Space:  7359MB
               Card Size:  7576MB
             Temperature:  33C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:54:35 pm</td>
                            </tr>


                            <tr>
                                <td>104556</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0035.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  65.63%
              Card Space:  7360MB
               Card Size:  7576MB
             Temperature:  33C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:54:16 pm</td>
                            </tr>


                            <tr>
                                <td>104555</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0034.JPG
       Upload Resolution:  Standard Low
                  Source:  Snap
                 Battery:   100%
                  Signal:  93.75%
              Card Space:  7361MB
               Card Size:  7576MB
             Temperature:  33C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:53:53 pm</td>
                            </tr>


                            <tr>
                                <td>104554</td>

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
                                <td>10/09/2018 6:53:46 pm</td>
                            </tr>


                            <tr>
                                <td>104553</td>

                                <td>Status</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:53:45 pm</td>
                            </tr>


                            <tr>
                                <td>104552</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0033.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7369MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:38:40 pm</td>
                            </tr>


                            <tr>
                                <td>104551</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0032.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  50.00%
              Card Space:  7370MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:38:19 pm</td>
                            </tr>


                            <tr>
                                <td>104550</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0031.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7371MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:37:58 pm</td>
                            </tr>


                            <tr>
                                <td>104549</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0030.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  50.00%
              Card Space:  7372MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:37:37 pm</td>
                            </tr>


                            <tr>
                                <td>104548</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0029.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7372MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:37:16 pm</td>
                            </tr>


                            <tr>
                                <td>104547</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0028.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7373MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:36:54 pm</td>
                            </tr>


                            <tr>
                                <td>104546</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0027.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7374MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:36:35 pm</td>
                            </tr>


                            <tr>
                                <td>104545</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0026.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7375MB
               Card Size:  7576MB
             Temperature:  28C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:36:12 pm</td>
                            </tr>


                            <tr>
                                <td>104544</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0025.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7376MB
               Card Size:  7576MB
             Temperature:  28C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:34:18 pm</td>
                            </tr>


                            <tr>
                                <td>104543</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0024.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7377MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:33:58 pm</td>
                            </tr>


                            <tr>
                                <td>104542</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0023.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  46.88%
              Card Space:  7377MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:33:37 pm</td>
                            </tr>


                            <tr>
                                <td>104541</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0022.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7378MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:33:16 pm</td>
                            </tr>


                            <tr>
                                <td>104540</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0021.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  96.88%
              Card Space:  7379MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:32:55 pm</td>
                            </tr>


                            <tr>
                                <td>104539</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0020.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7380MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:32:27 pm</td>
                            </tr>


                            <tr>
                                <td>104538</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0019.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7381MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:28:42 pm</td>
                            </tr>


                            <tr>
                                <td>104537</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0018.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7382MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:23:42 pm</td>
                            </tr>


                            <tr>
                                <td>104536</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0017.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7383MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:18:42 pm</td>
                            </tr>


                            <tr>
                                <td>104535</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0016.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  65.63%
              Card Space:  7383MB
               Card Size:  7576MB
             Temperature:  26C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:13:41 pm</td>
                            </tr>


                            <tr>
                                <td>104534</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0015.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7384MB
               Card Size:  7576MB
             Temperature:  27C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:08:41 pm</td>
                            </tr>


                            <tr>
                                <td>104533</td>

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
                                <td>10/09/2018 6:03:21 pm</td>
                            </tr>


                            <tr>
                                <td>104532</td>

                                <td>Status</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:03:19 pm</td>
                            </tr>


                            <tr>
                                <td>104531</td>

                                <td>Firmware Update</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:02:55 pm</td>
                            </tr>


                            <tr>
                                <td>104529</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0014.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7378MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:01:08 pm</td>
                            </tr>


                            <tr>
                                <td>104528</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0013.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  309.38%
              Card Space:  7378MB
               Card Size:  7576MB
             Temperature:  30C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:00:34 pm</td>
                            </tr>


                            <tr>
                                <td>104526</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  89860117851014783507
               Module ID:  861107030190590
                FileName:  PICT0012.JPG
       Upload Resolution:  Standard Low
                  Source:  Snap
                 Battery:   100%
                  Signal:  93.75%
              Card Space:  7379MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 6:00:05 pm</td>
                            </tr>


                            <tr>
                                <td>104525</td>

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
                                <td>10/09/2018 5:59:59 pm</td>
                            </tr>


                            <tr>
                                <td>104524</td>

                                <td>Status</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 5:59:56 pm</td>
                            </tr>


                            <tr>
                                <td>104521</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  8944503540145562672
               Module ID:  861107030190590
                FileName:  PICT0010.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  56.25%
              Card Space:  7381MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 5:56:34 pm</td>
                            </tr>


                            <tr>
                                <td>104520</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  8944503540145562672
               Module ID:  861107030190590
                FileName:  PICT0009.JPG
       Upload Resolution:  Standard Low
                  Source:  Time Lapse
                 Battery:   100%
                  Signal:  62.50%
              Card Space:  7382MB
               Card Size:  7576MB
             Temperature:  29C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 5:55:47 pm</td>
                            </tr>


                            <tr>
                                <td>104517</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  8944503540145562672
               Module ID:  861107030190590
                FileName:  PICT0008.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7383MB
               Card Size:  7576MB
             Temperature:  28C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 5:51:55 pm</td>
                            </tr>


                            <tr>
                                <td>104516</td>

                                <td>Upload Photo</td>
                                <td>
                                    Success
                                </td>

                                <td>
                                                                        <a class="btn btn-xs btn-primary view-request" data-request="                   IccId:  8944503540145562672
               Module ID:  861107030190590
                FileName:  PICT0007.JPG
       Upload Resolution:  Standard Low
                  Source:  Motion
                 Battery:   100%
                  Signal:  53.13%
              Card Space:  7384MB
               Card Size:  7576MB
             Temperature:  28C
">View</a>
                                                                    </td>
                                <td>
                                                                    </td>
                                <td>10/09/2018 5:51:08 pm</td>
                            </tr>


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

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 pull-right">
            <ul class="pagination pagination">

                    <li class="disabled"><span>&laquo;</span></li>

                                                                        <li class="active"><span>1</span></li>
                                                                                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=2">2</a></li>
                                                                                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=3">3</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li><span>...</span></li>
                            <li class="hidden-xs"><a href="http://www.ridgetec.us/cameras/apilog/54?page=165">165</a></li>


                    <li><a href="http://www.ridgetec.us/cameras/apilog/54?page=2" rel="next">&raquo;</a></li>
            </ul>

        </div>
    </div>
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
</body>
</html>
