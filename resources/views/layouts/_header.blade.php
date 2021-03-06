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
                <a class="navbar-brand" href="{{ route('home') }}" target="_blank" title="{{ env('APP_NAME') }} Home">
@if (env('APP_REGION') == 'eu')
                    <img class="main-logo" style="padding-top: 8px;" src="{{ route('home') }}/images/logo-vigilmax.png" alt="logo" />
@elseif (env('APP_REGION') == 'au')
                    <!-- <h2>{{ env('APP_NAME') }}</h2> -->
                    <h2><span style="color: #E65A06;">RT</span><span style="color: #636161;">BaseControl</span></h2>
@elseif (env('APP_REGION') == 'tw')
                    <img class="main-logo" style="padding-top: 8px;" width="300" src="{{ route('home') }}/images/logo-eztoview.png" alt="logo" />
@elseif (env('APP_REGION') == 'cn')
                    <!-- <h2>{{ env('APP_NAME') }}</h2> -->
                    <!-- <img class="main-logo" style="padding-top: 8px;" width="200" src="{{ route('home') }}/images/logo-eztoview_en.png" alt="logo" /> -->
                    <!-- <img class="main-logo" style="padding-top: 0px;" src="{{ route('home') }}/images/logo-vigilmax.png" alt="logo" /> -->
                    <img class="main-logo" style="padding-top: 8px;" width="200" src="{{ route('home') }}/images/logo-eztoview_en.png" alt="logo" />
@endif
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!--<ul class="nav navbar-nav">

                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

@if (Auth::check() && isset($user))
    @if (!Browser::isMobile())
                    <li class={{ ($user->sel_menu == 'plan') ? "active" : "" }}>
                        @if (env('APP_USE_IMEI_ADD_CAMERA'))
                        <a href="{{ route('plans.add') }}"><span class="glyphicon glyphicon-signal"> </span> {{ trans('htc.Add Camera') }}</a>
                        @else
                        <a href="{{ route('plans.add') }}"><span class="glyphicon glyphicon-signal"> </span> {{ trans('htc.Add Plan') }}</a>
                        @endif
                    </li>

                    @if (count($user->cartItems()->get()) > 0)
                    <li class={{ ($user->sel_menu == 'cart') ? "active" : "" }}>
                        <a href="{{ route('shop.cart') }}">
                            <span class="glyphicon glyphicon-shopping-cart"> </span>
                            <div class="badge">{{ count($user->cartItems()->get()) }}</div>
                        </a>
                    </li>
                    @endif
    @endif

                    <li class={{ ($user->sel_menu == 'camera') ? "active" : "" }}>
                        <a href="{{ route('cameras') }}"><i class="fa fa-camera"></i> {{ trans('htc.My Cameras') }}</a>
                    </li>

    @if (!Browser::isMobile())
                    <li class={{ ($user->sel_menu == 'account') ? "active" : "" }}>
                        <a href="{{ route('account.profile') }}"><i class="fa fa-gear"></i> {{ trans('htc.My Account') }}</a>
                    </li>
    @endif

    @if (env('APP_PLAN_INFO') && (!Browser::isMobile()))
                    <li class={{ ($user->sel_menu == 'help') ? "active" : "" }}>
                        <a href="{{ route('help.plans') }}">{{ trans('htc.PLAN INFO') }}</a>
                    </li>
    @endif
@else
    @if (env('APP_PLAN_INFO') && (!Browser::isMobile()))
                    <li class=""><a href="{{ route('help.plans') }}">{{ trans('htc.PLAN INFO') }}</a></li>
    @endif
@endif

{{--TODO--}}
@if (0)
@if (!Browser::isMobile())
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
@endif
@endif

@if (Auth::check() && isset($user))
                    <li class="{{ ($user->sel_menu == 'user') ? 'dropdown active' : 'dropdown' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->name }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                @if (!Browser::isMobile())
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ trans('htc.Logout') }}
                                </a>
                                @else
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit(); api.closeFrame()">
                                    {{ trans('htc.Logout') }}
                                </a>
                                @endif

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
@else
                    <li class=""><a href="{{ route('login') }}">{{ trans('htc.Login') }}</a></li>
@endif

@if (env('APP_REGION') == 'au')

@else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             {{ trans('htc.Language') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('language.en') }}">English</a></li>
                            @if (env('APP_REGION') == 'eu')
                            <li><a href="{{ route('language.de') }}">German</a></li>
                            @elseif (env('APP_REGION') == 'tw')
                            <li><a href="{{ route('language.tw') }}">繁體中文</a></li>
                            @elseif (env('APP_REGION') == 'cn')
                            <li><a href="{{ route('language.cn') }}">简体中文</a></li>
                            @endif
@endif
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>