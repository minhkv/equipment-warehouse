<nav class="navbar navbar-expand-md navbar-light sticky-top bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/logo.png" alt="logo">
            <!-- <img src="videocam.ico" height=80px alt="logo"> -->
            <!-- <p>QUẢN LÝ KHO</p> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link {{Route::currentRouteName() == 'home' ? 'active' : ''}}" href="{{route('home')}}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'order.index' ? 'active' : ''}}" href="{{route('order.index')}}">Đơn mượn
                        @if($notification > 0)
                        <span class="badge badge-warning">{{ $notification }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'equipment-template.index' ? 'active' : ''}}" href="{{route('equipment-template.index')}}">Thiết bị</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'combo.index' ? 'active' : ''}}" href="{{route('combo.index')}}">Combo</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'supplier.index' ? 'active' : ''}}" href="{{route('supplier.index')}}">Nhà cung cấp</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'borrowing-cart.index' ? 'active' : ''}}" href="{{route('borrowing-cart')}}">Giỏ đồ <i class="fa fa-shopping-cart"></i></a>
                </li> -->
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
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