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

                <!-- <h2>KMCam Pro</h2> -->
                <!-- <h2>{{ env('APP_NAME') }}</h2> -->

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}" target="_blank" title="{{ env('APP_NAME') }} Home">
                <!-- <a class="navbar-brand" href="http://portal.vigilmax.de" target="_blank" title="VigilMax Home"> -->
                    <!-- <img class="main-logo" width="224" height="47" src="{{ route('home') }}/images/logo.png" alt="VigilMax logo" /> -->

@if (env('APP_REGION') == 'de')
                    <img class="main-logo" src="{{ route('home') }}/images/logo.png" alt="logo" />
@elseif (env('APP_REGION') == 'au')
                    <h2>{{ env('APP_NAME') }}</h2>
@elseif (env('APP_REGION') == 'tw')
                    <!-- <img class="main-logo" src="{{ route('home') }}/images/logoA.png" alt="logo" /> -->
                    <h2>{{ env('APP_NAME') }}</h2>
@elseif (env('APP_REGION') == 'cn')
                    <h2>{{ env('APP_NAME') }}</h2>
@else
                    <h2>{{ env('APP_NAME') }}</h2>
@endif
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

@if (Auth::check() && isset($user))
                    <li class={{ ($user->sel_menu == 'plan') ? "active" : "" }}>
                        <a href="{{ route('plans.add') }}"><span class="glyphicon glyphicon-signal"> </span> {{ trans('htc.Add Plan') }}</a>
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
                        <a href="{{ route('cameras') }}"><i class="fa fa-camera"></i> {{ trans('htc.My Cameras') }}</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'account') ? "active" : "" }}>
                        <a href="{{ route('account.profile') }}"><i class="fa fa-gear"></i> {{ trans('htc.My Account') }}</a>
                    </li>

                    <li class={{ ($user->sel_menu == 'help') ? "active" : "" }}>
                        <a href="{{ route('help.plans') }}">{{ trans('htc.PLAN INFO') }}</a>
                    </li>
@else
                    <li class=""><a href="{{ route('help.plans') }}">{{ trans('htc.PLAN INFO') }}</a></li>
@endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             {{ trans('htc.Support') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('help.quick-start') }}">{{ trans('htc.Camera Quick Start Guide') }}</a>
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
                                    {{ trans('htc.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
@else
                    <li class=""><a href="{{ route('login') }}">{{ trans('htc.Login') }}</a></li>
@endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             {{ trans('htc.Language') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('language.en') }}">English</a></li>
                            <li><a href="{{ route('language.de') }}">German</a></li>
@if (env('APP_REGION') == 'tw')
                            <li><a href="{{ route('language.tw') }}">繁體中文</a></li>
@elseif (env('APP_REGION') == 'cn')
                            <li><a href="{{ route('language.cn') }}">简体中文</a></li>
@endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>