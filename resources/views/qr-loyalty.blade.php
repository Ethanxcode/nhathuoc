@extends('frontend.layouts.app')
@section('content')
<div class="container wrapper-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">&nbsp;</h3>
                            <div class="row">
                                <div class="col-lg-3">
                                    @include('frontend.layouts.sidebar')
                                </div>
                                <div class="col-lg-8">
                                    <h5>Welcome, {{ $user->name}}</h5>
                                    @if($_messages)
                                    <ul>
                                        @foreach($_messages as $_message)
                                        <li>{{ $_message[0]}}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if($_qr_code_message)
                                    <label>Qrcode đã được sử dụng.</label>
                                    @else
                                    @if($_product && $product)
                                    <label>Bạn đã tích điểm thành công:</label>
                                    <ul>
                                        @if($product != "")
                                        <li>Tên sản phẩm: {{ $product['product_name']}}</li>
                                        <li>Số điểm: {{ $product['points']}}</li>
                                        @endif
                                    </ul>
                                    @endif
                                    @endif

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