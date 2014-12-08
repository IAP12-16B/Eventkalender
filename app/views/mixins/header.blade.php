<header class="header">
    <div class="main-header">
        <h1 class="brand">
            <span>Eventcalendar</span>
        </h1>

        <nav class="main-nav">
            @if(Auth::check())
                {{ Menu::get('Admin')->asUl() }}
            @else
                {{ Menu::get('Main')->asUl() }}
            @endif
        </nav>

        @if(Auth::check())
            <span class="logout">
                <a href="{{ URL::route('logout') }}" class="btn logout btn-red">
                <span><i class="fa fa-fw fa-lg fa-sign-out"></i> Logout</span>
                </a>
            </span>
        @else
            <span class="logout">
                <a href="{{ URL::route('login') }}" class="btn logout btn-blue">
                <span><i class="fa fa-fw fa-lg fa-sign-in"></i> Login</span>
                </a>
            </span>
        @endif
    </div>
    @yield('header.after')
</header>