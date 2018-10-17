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
                <a class="navbar-brand" href="{{ route('home') }}" target="_blank" title="10ware Home">
                    <img class="main-logo" src="https://portal.ridgetec.com/images/logo.png" alt="RidgeTec logo" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!--<ul class="nav navbar-nav">

                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!--<li class=""><a href="https://portal.ridgetec.com/plans/add-plan"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a></li>
                    <li class=""><a href="https://portal.ridgetec.com/cameras"><i class="fa fa-camera"></i> My Cameras</a></li>
                    <li class=""><a href="https://portal.ridgetec.com/account/profile"><i class="fa fa-gear"></i> My Account</a></li>
                    <li class=""><a href="https://portal.ridgetec.com/help/plans">PLAN INFO</a></li>-->

@if (Auth::check())
                    <li class=""><a href="{{ route('add.plan') }}"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a></li>
                    <li class="active"><a href="{{ route('cameras') }}"><i class="fa fa-camera"></i> My Cameras</a></li>
                    <li class=""><a href="{{ route('account.profile') }}"><i class="fa fa-gear"></i> My Account</a></li>
                    <li class=""><a href="{{ route('help.plans') }}">PLAN INFO</a></li>
@else
                    <li class=""><a href="https://portal.ridgetec.com/tour/start">DEMO</a></li>
                    <li class=""><a href="{{ route('help.plans') }}">PLAN INFO</a></li>
@endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             Support <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('help.quick-start') }}">Camera Quick Start Guide</a>
                            </li>
                        </ul>
                    </li>
                    <!--<li class=""><a href="{{ route('users.index') }}">Users</a></li>-->

@if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->name }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.show', Auth::user()->id) }}">User Show</a></li>
                            <li><a href="{{ route('users.edit', Auth::user()->id) }}">User Edit</a></li>
                            <li><a href="{{ route('plans.index') }}">Plans</a></li>
                            <li>
                                <a href="{{ route('admin') }}"><i class="fa fa-btn fa-unlock"> </i> Admin Panel</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </li>
                        </ul>
                    </li>
@else
                    <li class=""><a href="{{ route('login') }}">Log in</a></li>
@endif
                </ul>
            </div>
        </div>
    </nav>
