@extends('frontend2.layouts.app')
@section('title')
Customer Login
@endsection
@section('content')
<div class="container">
    <div class="account-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Đăng nhập</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                     <!-- @if ($errors->any())
                   <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif -->
                    <div class="form-group">
                        <label for="email">Email hoặc Phone</label>
                        <input aria-describedby="emailHelpBlock" id="email" type="text"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            placeholder="Nhập Email hoặc Phone Number" tabindex="1"
                            value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                            autofocus required>
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Mật khẩu</label>
                            <div class="float-right">
                                <a href="{{ route('password.request') }}" class="text-small">
                                    Quên mật khẩu?
                                </a>
                            </div>
                        </div>
                        <input aria-describedby="passwordHelpBlock" id="password" type="password"
                            value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                            placeholder="Mật khẩu"
                            class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                            tabindex="2" required>
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                id="remember" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection