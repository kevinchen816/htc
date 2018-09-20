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
            <a class="navbar-brand" href="http://www.10ware.com" target="_blank" title="10ware Home">
                <img class="main-logo" src="https://portal.ridgetec.com/images/logo.png" alt="RidgeTec logo" />
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            <!--<ul class="nav navbar-nav">

            </ul>-->

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
<!--                 <li class=""><a href="http://www.ridgetec.us/plans/add-plan"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a></li>
                <li class="active"><a href="http://www.ridgetec.us/cameras"><i class="fa fa-camera"></i> My Cameras</a></li>
                <li class=""><a href="http://www.ridgetec.us/account/profile"><i class="fa fa-gear"></i> My Account</a></li>
                <li class=""><a href="http://www.ridgetec.us/help/plans">PLAN INFO</a></li>
 -->
                <li class=""><a href="{{ route('add.plan') }}"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a></li>
                <li class="active"><a href="{{ route('cameras', $camera->id) }}"><i class="fa fa-camera"></i> My Cameras</a></li>
                <li class=""><a href="{{ route('account.profile') }}"><i class="fa fa-gear"></i> My Account</a></li>
                <li class=""><a href="{{ route('help.plans') }}">PLAN INFO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                         Support <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                        <a href="{{ route('support.emailpolicy') }}">Email Policy</a>
                        <!--<a href="{{ route('email.optin') }}">Email Opt-in</a>
                        <a href="{{ route('email.optout') }}">Email Opt-out</a>-->
                        <a href="{{ route('support.contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ $user->name }}  <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('admin') }}"><i class="fa fa-btn fa-unlock"> </i> Admin Panel</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
