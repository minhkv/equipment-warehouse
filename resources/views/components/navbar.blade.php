<nav class="navbar navbar-expand-md navbar-light sticky-top bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/logo.png" alt="logo">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Đơn
                    @if($notification > 0)
                    <span class="badge badge-warning">{{ $notification }}</span>
                    @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('order.index') }}">
                            Danh sách đơn mượn
                        </a>
                        <a class="dropdown-item" href="{{ route('order.create') }}">
                            Tạo đơn mượn
                        </a>
                        <a class="dropdown-item" href="{{ route('input-order.index') }}">
                            Danh sách đơn nhập
                        </a>
                        <a class="dropdown-item" href="{{ route('input-order.create') }}">
                            Tạo đơn nhập
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Thiết bị</a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('category.index') }}">
                            Loại thiết bị
                        </a>
                        <a class="dropdown-item" href="{{ route('equipment-template.index') }}">
                            Danh sách thiết bị
                        </a>
                        <a class="dropdown-item" href="{{ route('equipment-template.create') }}">
                            Thêm thiết bị
                        </a>
                        <a class="dropdown-item" href="{{ route('equipment-template.lost') }}">
                            Thiết bị thất lạc
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'supplier.index' ? 'active' : ''}}" href="{{route('supplier.index')}}">Nhà cung cấp</a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
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
                
            </ul>
            
        </div>
    </div>
</nav>