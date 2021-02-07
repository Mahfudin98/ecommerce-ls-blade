<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
            <a class="navbar-brand logo_h" href="/"><img src="{{asset('img/logo-index.png')}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                    @if (auth()->guard('customer')->check())
                    <li class="nav-item  {{ (request()->is('member/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('customer.dashboard') }}" class="nav-link">
                            Dashboard
                        </a>
                    </li>
					@else

					@endif
                    <li class="nav-item  {{ (request()->is('/')) ? 'active' : '' }}">
                        <a href="{{ route('guest.index') }}" class="nav-link">
                            Home
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('shop*')) ? 'active' : '' }}">
                        <a href="{{ route('guest.shop') }}" class="nav-link">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}">
                        <a href="{{ route('guest.contact') }}" class="nav-link">
                            Contact
                        </a>
                    </li>
                </ul>
                <ul class="nav-shop">
                    <li class="nav-item"><button><a href="{{ route('guest.list_cart') }}"><i class="ti-shopping-cart"></i></a><span class="nav-shop__circle"></span></button></li>
                    <li class="nav-item"><button><a href="{{ route('guest.order') }}"><i class="ti-bag"></i></a><span class="nav-shop__circle">3</span></button></li>
                    @if (auth()->guard('customer')->check())
                        <li class="nav-item"><button><a href="{{ route('customer.settingForm') }}"><i class="ti-user"></i></a><span class="nav-shop__circle"></span></button></li>
                        <li class="nav-item"><a href="{{ route('customer.logout') }}" class="nav-link"><i class="ti-power-off"></i> Logout</a></li>
					@else
                        <li class="nav-item"><a href="{{ route('customer.login') }}" class="nav-link"><i class="ti-user"></i> Login</a></li>
					@endif
                </ul>
            </div>
            </div>
        </nav>
    </div>
</header>
