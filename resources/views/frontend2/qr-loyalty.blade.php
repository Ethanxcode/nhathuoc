@extends('frontend2.layouts.app')
@section('content')
<div class="container wrapper-content wrapper-content-qrloyalty">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card guide-page-background">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="wrapper-content-loyalty">

                                        @if($_message || $_messages)
                                        <h5>Qrcode không hợp lệ:</h5>
                                        @if($_message)
                                        <p>{{$_message}}</p>
                                        @endif
                                        @if($_messages)
                                        <ul id="qrcode_show_list_error" style="display:none;">
                                        @foreach($_messages as $_message)
                                        <li>{{ $_message[0]}}</li>
                                        @endforeach
                                        </ul>
                                        <a href="javascript:void(0);" id="show_list_error">Chi tiết</a>
                                        @endif
                                        @endif
                                        @if($_qr_code_message)
                                        <h5>Xin chào, {{ $user->name}} </h5>
                                        <label>{{$_qr_code_message}}</label>
                                        @else
                                        @if($_product && $product)
                                        <h5>Chúc mừng, {{ $user->name}}</h5>
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
        </div>
    </section>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#show_list_error').click(function(){
                $('#qrcode_show_list_error').toggle();
            });
        });
    </script>
@endsection