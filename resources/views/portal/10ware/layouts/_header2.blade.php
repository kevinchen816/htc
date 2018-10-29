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

                <h2>10ware Portal</h2>
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
                    <li class={{ ($user->sel_menu == 'plan') ? "active" : "" }}>
                        <a href="{{ route('add.plan') }}"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'my_plans') ? "active" : "" }}>
                        <a href="{{ route('my.plans') }}"><i class="fa fa-gear"></i> My Plans</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'camera') ? "active" : "" }}>
                        <a href="{{ route('cameras') }}"><i class="fa fa-camera"></i> My Cameras</a>
                    </li>
@else
@endif

@if (Auth::check())
                    <li class="{{ ($user->sel_menu == 'user') ? 'dropdown active' : 'dropdown' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->name }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
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
