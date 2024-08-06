@extends('frontend2.layouts.app')
@section('content')
<div class="container wrapper-content wapper-content-account wrapper-content-home">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @if($msg != '')
                                <label class="account-page-title text-center gift-detail-title">{{$msg}}</label>
                                @else
                                <label class="account-page-title text-center gift-detail-title">Chi tiết quà
                                    tặng</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <img src="{{$gift->image}}" class="gift-image" />
                                    <ul class="gift-detail-content">
                                        <li>
                                            <span class="text-bold gift-detail-title">Điểm tích luỹ của bạn là:</span>
                                            <div class="detail-total-point gift-detail-content">{{$total_point}}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Tên quà:</span>
                                            <div class="gift-detail-content">{{$gift->title}}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Nội dung:</span>
                                            <div class="gift-detail-content">{!! $gift->note !!}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Địa chỉ áp dụng:</span>
                                            <div class="gift-detail-content">
                                                @if($gift->office)
                                                @php
                                                $address = json_decode($gift->office, true);
                                                if($address['address']){
                                                echo '<ul class="list-address-apply-gift">';
                                                    foreach($address['address'] as $_add):

                                                    echo '
                                                    <li>'.$_add.'</li>';

                                                    endforeach;
                                                    echo '
                                                </ul>';
                                                }
                                                @endphp
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Giá:</span>
                                            <div class="gift-detail-content">{{$gift->price}}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Số lượng:</span>
                                            <div class="gift-detail-content">{{$gift->quantity}}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">Hạn sử dụng:</span>
                                            <div class="gift-detail-content">{{$gift->expired_time}}</div>
                                        </li>
                                        <li>
                                            <span class="text-bold gift-detail-title">&nbsp;</span>
                                            <div class="gift-detail-content">
                                                @if($gift->quantity > 0)
                                                <a href="javascript:void(0);" class="text-center btn-change-gift-detail"
                                                    rel="{{$gift->urbox_id}}">
                                                    Đổi quà tặng
                                                </a>
                                                @else
                                                Hết quà
                                                @endif
                                            </div>
                                            <a href="{{URL::route('points')}}">Trở về</a>
                                        </li>
                                    </ul>
                                </div>

                                @endif

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.btn-change-gift-detail', function(e) {

        let gift_id = $(this).attr('rel');

        let _token = $('._token');
        let data = {
            gift_id: gift_id,
            _token: "{{ csrf_token() }}"
        }
        let url = "{{ route('gift.change') }}";

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(data) {
                //result = JSON.parse(data);
                //alert(result.message);
                result = JSON.parse(data);
                
                if(result.gt == 1){
                    let url_redirect = "{{ route('gifts') }}";
                    alert(result.message);
                    window.location.href= url_redirect;
                }else{
                    alert(result.message);
                }
            }
        });
    });
});
</script>
@endsection