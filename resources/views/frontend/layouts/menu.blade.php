<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="logo"><img src="{{ asset('web/images/logo.png') }}"></div>
        </div>
        <div class="col-sm-8">
            <div class="menu_main">
                <ul class="account-menu">
                    <li><a href="{{ url('/huong-dan-tich-doi-diem') }}">Hướng dẫn tích đổi điểm</a></li>
                    @guest
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="#">|</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-user"></i> Account</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>