@extends('frontend.layouts.app')
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
                                <div class="col-lg-3">
                                    @include('frontend.layouts.sidebar')
                                </div>
                                <div class="col-lg-9">
                                    <h5>Quà tặng</h5>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#my-gift">Danh sách quà
                                                của
                                                bạn</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#gift-change">Danh sách quà có
                                                thể
                                                đổi</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane container active" id="my-gift">
                                            <div class="wrapper-gift-page">
                                                <ul>
                                                    <li>
                                                        <div class="row gift-header">
                                                            <div class="col-lg-2">&nbsp;</div>
                                                            <div class="col-lg-2">Giá trị</div>
                                                            <div class="col-lg-2">Loại quà</div>
                                                            <div class="col-lg-6">Quà</div>

                                                        </div>
                                                    </li>
                                                    @foreach($my_gift as $key => $_gift)
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-lg-2 text-center">
                                                                <img src="{{$_gift->image}}" alt="" class=" gift" />
                                                                <span class="gift_name">{{$_gift->gift_name}}</span>
                                                            </div>
                                                            <div class="col-lg-2">{{$_gift->gt}}</div>
                                                            <div class="col-lg-2">{{$_gift->gift_type_name}}</div>

                                                            <div class="col-lg-6 my-gift-image">
                                                                <label>{{$_gift->gift_code}}</label>
                                                                <img src="{{$_gift->gift_code_image}}" alt=""
                                                                    class="gift" />
                                                                <p>
                                                                    <a href="{{$_gift->gift_code_link}}"
                                                                        target="_blank">{{$_gift->gift_code_link}}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane container fade" id="gift-change">

                                            <div class="wrapper-gift-page">
                                                @foreach($gifts as $key => $gift)
                                                <div class="wrapper-client">
                                                    <label>{{$gift['label']}}</label>
                                                    <span>Tổng điểm: {{$points[$key]}}</span>
                                                </div>

                                                <ul>
                                                    <li>
                                                        <div class="row gift-header">
                                                            <div class="col-lg-3">Quà</div>
                                                            <div class="col-lg-3">Giá trị</div>
                                                            <div class="col-lg-2">Loại quà</div>
                                                            <div class="col-lg-2">Số lượng</div>
                                                            <div class="col-lg-22">&nbsp;</div>
                                                        </div>
                                                    </li>
                                                    @foreach($gift['data'] as $key => $_gift_item)
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-lg-3 text-center">
                                                                <img src="{{$_gift_item->image}}" alt="" class="gift" />
                                                                <span
                                                                    class="gift_name">{{$_gift_item->gift_name}}</span>
                                                            </div>
                                                            <div class="col-lg-3">{{$_gift_item->gt}}</div>
                                                            <div class="col-lg-2">{{$_gift_item->gift_type_name}}</div>
                                                            <div class="col-lg-2">

                                                                {{$_gift_item->quantity}}

                                                            </div>
                                                            <div class="col-lg-2">
                                                                @if($_gift_item->quantity > 0)
                                                                <a href="javascript:void(0);" class="btn-change-gift"
                                                                    rel="{{$_gift_item->urbox_id}}">Đổi
                                                                    quà</a>
                                                                @else
                                                                Hết quà
                                                                @endif
                                                                <!-- <a href="javascript:void(0);" class="btn-change-gift"
                                                                    rel="{{$_gift->urbox_id}}">Đổi
                                                                    quà</a> -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                                @endforeach

                                            </div>
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
        console.log(url);
        console.log(data);
        // return;
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(data) {
                result = JSON.parse(data);
                alert(result.message);
            }
        });
    });
});
</script>
@endsection