<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo"><img src="{{ asset('web/images/logo_banner1.png') }}"></div>
        </div>
        <div class="col-sm-9">
            <div class="menu_main">
                <ul class="account-menu">

                    @guest
                    <li>
                        <a href="{{ url('/huong-dan-tich-doi-diem') }}"><i class="fa fa-fw fa-book"></i>Hướng dẫn</a>
                    </li>
                    <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                    <li><a href="#">|</a></li>
                    <li><a href="{{ url('/uregister') }}">Đăng ký</a></li>
                    @else
                    <li class="user-logged-in">
                        <a href="{{ url('/huong-dan-tich-doi-diem') }}"><i class="fa fa-fw fa-book"></i>Hướng dẫn</a>
                    </li>
                    <li class="user-logged-in"><a href="{{ url('/points') }}"><i class="fa fa-fw fa-btc"></i>Điểm tích
                            luỹ</a></li>
                    <li class="user-logged-in"><a href="{{ url('/productbuy') }}"><i
                                class="fa fa-fw fa-bitbucket"></i>Sản phẩm đã bán</a>
                    </li>
                    <li class="user-logged-in"><a href="{{ url('/gifts') }}"><i class="fa fa-fw fa-gift"></i>Quà
                            tặng</a></li>
                    <li class="user-logged-in"><a href="{{ url('/info') }}"><i class="fa fa-fw fa-user"></i>Cập nhật
                            thông tin</a></li>
                    <li class="user-logged-in"><a href="{{ url('/logout') }}"><i
                                class="fa fa-fw fa-sign-out"></i>Thoát</a></li>
                    @endguest
                </ul>
                <hr class="menu-line" />
            </div>
        </div>
    </div>
</div>