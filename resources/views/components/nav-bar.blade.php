<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/logo.png" width=200px alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{Route::currentRouteName() == 'home' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('home')}}">Trang chủ</a>
                </li>
                <li class="nav-item {{Route::currentRouteName() == 'equipment-template.index' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('equipment-template.index')}}">Thiết bị</a>
                </li>
                <!-- <li class="nav-item {{Route::currentRouteName() == 'combo.index' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('combo.index')}}">Combo</a>
                </li> -->
                <li class="nav-item {{Route::currentRouteName() == 'supplier.index' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('supplier.index')}}">Nhà cung cấp</a>
                </li>
                <li class="nav-item {{Route::currentRouteName() == 'order.index' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('order.index')}}">Đơn hàng</a>
                </li>
                <!-- <li class="nav-item {{Route::currentRouteName() == 'borrowing-cart.index' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('borrowing-cart')}}">Giỏ đồ <i class="fa fa-shopping-cart"></i></a>
                </li> -->
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0 px-2">
                    <div class="input-group">
                        <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                    </div>
                </form>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>