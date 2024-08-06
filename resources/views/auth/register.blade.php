@extends('frontend2.layouts.app')
@section('title')
Register
@endsection
@section('content')
<div class="container">
    <div class="account-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Đăng ký</h4>
            </div>

            <div class="card-body pt-1">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">Họ tên:</label><span class="text-danger">*</span>
                                <input id="firstName" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    tabindex="1" placeholder="Nhập họ tên" value="{{ old('name') }}" autofocus required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email:</label><span class="text-danger">*</span>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="Nhập địa chỉ email" name="email" tabindex="1"
                                    value="{{ old('email') }}" required autofocus>
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="control-label">Mật khẩu
                                    :</label><span class="text-danger">*</span>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                    placeholder="Mật khẩu" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label">Xác nhận mật khẩu:</label><span
                                    class="text-danger">*</span>
                                <input id="password_confirmation" type="password" placeholder="Xác nhận mật khẩu"
                                    class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                    name="password_confirmation" tabindex="2">
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone" class="control-label">Điện thoại:</label><span
                                    class="text-danger">*</span>
                                <input id="phone" type="text" placeholder="Điện thoại"
                                    class="form-control{{ $errors->has('phone') ? ' is-invalid': '' }}" name="phone"
                                    tabindex="2">
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address" class="control-label">Địa chỉ:</label><span
                                    class="text-danger"></span>
                                <input id="address" type="text" placeholder="Địa chỉ" class="form-control"
                                    name="address" tabindex="2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address" class="control-label">Tên nhà thuốc:</label><span
                                    class="text-danger"></span>
                                <input id="ten_nha_thuoc" type="text" placeholder="Tên nhà thuốc" class="form-control"
                                    name="ten_nha_thuoc" tabindex="2">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address" class="control-label">Chọn nhà thuốc:</label><span
                                    class="text-danger"></span>
                                <select id="nha_thuoc_id" class="form-control">
                                    @php
                                        foreach($nhathuoc as $key => $_item_nt):
                                            echo '<option value="'.$key.'">'.$_item_nt.'</option>';
                                        endforeach;
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Đăng ký ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 text-muted text-center">
            Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</div>

@endsection