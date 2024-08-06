@extends('frontend2.layouts.app')
@section('content')
<div class="container wrapper-content wapper-content-account wrapper-content-home">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">&nbsp;</h3>
                            <label class="account-page-title">Thông tin của bạn:</label>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                    <img src="{{URL::asset('web/images/account.png')}}" class="icon-account" />
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <ul>                                        
                                        <li>{{$user->ten_nha_thuoc}}</li>                                        
                                        <li>Họ tên: {{$user->name}}</li>
                                        <li>Điện thọai: {{$user->phone}}</li>
                                        <li>Địa chỉ: {{$user->address}}</li>
                                        <li>Email: {{$user->email}}</li>
                                    </ul>
                                    <a href="{{ URL::route('info')}}">Cập nhật thông tin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection