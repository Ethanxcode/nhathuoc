@extends('frontend2.layouts.app')
@section('content')
<div class="container">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">&nbsp;</h3>
                            <div class="row">

                                <div class="col-lg-12">
                                    <h5 class="mb-30 account-page-title">
                                        <span>Điểm tích luỹ</span>
                                        <span style="float:right; margin-right: 50px;">{{$customer->name}}</span>
                                    </h5>

                                    <div class="tab-pane container" id="gift-change">

                                        <div class="wrapper-gift-page">
                                            @foreach($gifts as $key => $gift)
                                            <div class="wrapper-client">
                                                <label>{{$gift['label']}}</label>
                                                <div class="point-custom">
                                                    <span class="point-label">Tổng điểm đã tích lũy:</span>&nbsp;<span
                                                    class="point-value">
                                                    @php 
                                                    $total_points = $points[$key]['total_points_used'] + $points[$key]['total_point']
                                                    @endphp
                                                    {{$total_points}}
                                                </div>
                                                <div class="point-custom">
                                                <span class="point-label">Điểm đã đổi:</span>&nbsp;<span
                                                    class="point-value">
                                                    {{$points[$key]['total_points_used'] ? $points[$key]['total_points_used'] : 0}}</span>
                                                </div>
                                                <div class="point-custom">
                                                <span class="point-label">Điểm còn lại:</span>&nbsp;<span
                                                    class="point-value">
                                                    {{$total_points - $points[$key]['total_points_used']}}</span> 
                                                </div>   
                                            </div>

                                            <ul>
                                                <li>
                                                    <div class="row gift-header">
                                                        <div class="col-lg-3">Quà</div>
                                                        <div class="col-lg-2">Point</div>
                                                        <div class="col-lg-2">Loại quà</div>
                                                        <div class="col-lg-2">Số lượng</div>
                                                        <div class="col-lg-3">&nbsp;</div>
                                                    </div>
                                                </li>
                                                @foreach($gift['data'] as $key => $_gift_item)
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3 text-center">
                                                            <img src="{{$_gift_item->image}}" alt="" class="gift" />
                                                            <span class="gift_name"><span
                                                                    class="show_mobile text-bold">Tên
                                                                    quà:</span>&nbsp;{{$_gift_item->gift_name}}</span>
                                                        </div>
                                                        <div class="col-lg-2 mt-70"><span
                                                                class="show_mobile text-bold">Điểm:</span>&nbsp;{{$_gift_item->gt / 1000}}
                                                        </div>
                                                        <div class="col-lg-2 mt-70"><span
                                                                class="show_mobile text-bold">Loại
                                                                quà:</span>&nbsp;{{$_gift_item->gift_type_name}}
                                                        </div>
                                                        <div class="col-lg-2 mt-70">
                                                            <span class="show_mobile text-bold">Số
                                                                lượng:</span>&nbsp;{{$_gift_item->quantity}}
                                                        </div>
                                                        <div class="col-lg-3 mt-30">
                                                            <a href="{{route('points.detail',['id'=>$_gift_item->urbox_id])}}" class="btn-change-detail"
                                                                rel="{{$_gift_item->urbox_id}}">Xem chi tiết</a>
                                                            @if($_gift_item->quantity > 0)
                                                            <a href="javascript:void(0);" class="btn-change-gift"
                                                                rel="{{$_gift_item->urbox_id}}">Đổi
                                                                quà</a>
                                                            @else
                                                            <span class="btn-change-detail btn-out-of-gift">Hết quà</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach

                                            </ul>

                                            @endforeach
                                            {!! $_gift->links() !!}
                                        </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.btn-change-gift', function(e) {

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