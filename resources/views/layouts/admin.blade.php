<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />--> <!--del by kevin -->
    <!--<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />--> <!--del by kevin -->
    <!--<link rel="icon" type="image/ico" href="/favicon.ico"  />--> <!--del by kevin -->
    <meta name="description" content="">
    <meta name="author" content="10wate Technologies, Inc.">

    <title>10ware Portal Admin</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- <link href="http://www.ridgetec.us/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet"> -->
    <link href="/css/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet"> <!-- kevin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="/admin-theme/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--- <link href="/admin-theme/css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <!-- <script src="https://use.fontawesome.com/9712be8772.js"></script> -->
    <script src="/js/9712be8772.js"></script> <!-- kevin -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!--<a class="navbar-brand" href="{{route('admin') }}">
                    <img class="main-logo" src="/images/logo.png" alt="10ware logo" style="margin-top: 0px;"  width="140" />
                </a>-->
                <div style="color:white;">
                <h2>KMCam Portal</h2>
                </div>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="/cameras/">Back to Portal</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ $user->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!--
                        <li class="divider"></li>
                        -->
                        <li>

                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <!--<li class="active">-->
                    <li class="">
                        <a href="{{ route('admin') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li class="">
                        <a href="{{ route('admin.users') }}"><i class="fa fa-fw fa-users"></i> Users</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.email') }}"><i class="fa fa-fw fa-envelope"></i> Email Tracking</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.cameras') }}"><i class="fa fa-fw fa-camera"></i> Cameras</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.plans') }}"><i class="fa fa-fw fa-signal"></i> Data Plans</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.firmware') }}"><i class="fa fa-fw fa-wrench"></i> Firmware</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.sims') }}"><i class="fa fa-fw fa-phone"></i> SIMs</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.rmas') }}"><i class="fa fa-fw fa-tasks"></i> RMA/Ticket System</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.siteactivity') }}"><i class="fa fa-fw fa-list"></i> Activity Monitor/Log</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.apilog') }}"><i class="fa fa-fw fa-list"></i> API Log</a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.viewlog') }}"><i class="fa fa-fw fa-list"></i> Application Log</a>
                    </li>

<!--                     <li class="">
                        <a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa fa-fw fa-list"></i> User List</a>
                    </li>

                    <li class="">
                        <a href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-fw fa-list"></i> User</a>
                    </li> -->

                    <li class="">
                        <a href="{{ route('plans.index') }}"><i class="fa fa-fw fa-list"></i> Plans</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
            @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!--
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="http://www.ridgetec.us/js/button-checkbox.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
    <!-- Morris Charts JavaScript -->
    <!--
    <script src="/admin-theme/js/plugins/morris/raphael.min.js"></script>
    <script src="/admin-theme/js/plugins/morris/morris.min.js"></script>
    <script src="/admin-theme/js/plugins/morris/morris-data.js"></script>
    -->

    <!-- bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Jquery-ui -->
    <!-- <script src="https://portal.ridgetec.com/jquery-ui-1.12.1/jquery-ui.js"></script> -->
    <script src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script> <!-- kevin -->

    <!-- <script src="https://portal.ridgetec.com/js/button-checkbox.js"></script> -->
    <script src="/js/button-checkbox.js"></script> <!-- kevin -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <!--<script src="https://portal.ridgetec.com/js/gallery.js"></script>-->
    <script src="/js/gallery.js"></script>--> <!-- kevin --><!-- tab_gallery.blade.php -->


</body>

</html>
<!--<script id="miwifi_safe" src="http://safe.miwifi.com/safe_v2.js?d=MDYwNDU5NjItMjM5OC0yYjA2LTk5YzEtODI2NGRiNDFiZDdhGQ79s36kE%2bQeooayB6ngGl%2b%2bZflVyJcrxnEl%2bgbQFzyqdbTDqt%2fRNy6InTyOkdPxgpyRPMM5%2fNuROSHWSr4Q%2ffLztLVp3YgoLkfS3QSUMK%2fhTHsMdXHxDQzuPTi0LpKWGcoPdbByV%2fjTQj4iTed3FEH9I2IM5r3qlJrb64tlAts%3d" charset="utf-8">
</script>
</body>
</html>-->