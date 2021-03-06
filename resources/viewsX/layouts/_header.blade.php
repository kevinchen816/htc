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

                <h2>KMCam Pro</h2>
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

@if (Auth::check() && isset($user))
                    <li class={{ ($user->sel_menu == 'plan') ? "active" : "" }}>
                        <a href="{{ route('plans.add') }}"><span class="glyphicon glyphicon-signal"> </span> Add Plan</a>
                    </li>

                    @if (count($user->cartItems()->get()) > 0)
                    <li class={{ ($user->sel_menu == 'cart') ? "active" : "" }}>
                        <a href="{{ route('shop.cart') }}">
                            <span class="glyphicon glyphicon-shopping-cart"> </span>
                            <div class="badge">{{ count($user->cartItems()->get()) }}</div>
                        </a>
                    </li>
                    @endif

                    <li class={{ ($user->sel_menu == 'camera') ? "active" : "" }}>
                        <a href="{{ route('cameras') }}"><i class="fa fa-camera"></i> My Cameras</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'account') ? "active" : "" }}>
                        <a href="{{ route('account.profile') }}"><i class="fa fa-gear"></i> My Account</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'help') ? "active" : "" }}>
                        <a href="{{ route('help.plans') }}">PLAN INFO</a>
                    </li>
@else
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

@if (Auth::check() && isset($user))
                    <li class="{{ ($user->sel_menu == 'user') ? 'dropdown active' : 'dropdown' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->name }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ trans('htc.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
@else
                    <li class=""><a href="{{ route('login') }}">{{ trans('htc.login') }}</a></li>
@endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             {{ trans('htc.language') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('language.en') }}">English</a></li>
                            <li><a href="{{ route('language.cn') }}">简体中文</a></li>
                            <li><a href="{{ route('language.tw') }}">繁體中文</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>