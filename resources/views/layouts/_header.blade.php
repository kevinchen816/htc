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
            <a class="navbar-brand" href="http://www.10ware.com" target="_blank" title="RidgeTec Home">
                <img class="main-logo" src="https://portal.ridgetec.com/images/logo.png" alt="RidgeTec logo" />
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            <!--<ul class="nav navbar-nav">

            </ul>-->

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="https://portal.ridgetec.com/tour/start">DEMO</a></li>
                <li class=""><a href="https://portal.ridgetec.com/help/plans">PLAN INFO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                         Support <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="https://portal.ridgetec.com/support/emailpolicy">Email Policy</a>
                            <!--<a href="https://portal.ridgetec.com/email/optin">Email Opt-in</a>
                            <a href="https://portal.ridgetec.com/email/optout">Email Opt-out</a>-->
                            <a href="https://portal.ridgetec.com/email/verification">Account Verification</a>
                            <a href="https://portal.ridgetec.com/support/contact">Contact Us</a>
                        </li>
                    </ul>
                </li>
                <li class=""><a href="{{ route('login') }}">Log in</a></li>
            </ul>
        </div>
    </div>
</nav>