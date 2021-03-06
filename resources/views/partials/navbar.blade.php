<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a href="/">
                <img class="img-fluid" src="{{ asset('logo rs tabrani.png') }}" alt="Theme-Logo">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="javascript:void(0);" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <strong class="text-bold">
                        {{ date('d F Y') }} @{{ time }}
                    </strong>
                </li>
                @auth
                    <li class="user-profile header-notification" data-toggle="tooltip" data-placement="top" title=""
                        data-original-title="Logout" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class=" feather icon-log-out"></i>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
                @guest

                @endguest
            </ul>
        </div>
    </div>
</nav>
