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
                                        <label class="account-page-title">Danh sách quà tặng đã đổi điểm</label>

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
                                                        @foreach ($my_gift as $key => $_gift)
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-lg-2 text-center">
                                                                        <img src="{{ $_gift->image }}" alt=""
                                                                            class=" gift" />
                                                                        <span
                                                                            class="gift_name">{{ $_gift->gift_name }}</span>
                                                                    </div>
                                                                    <div class="col-lg-2 mt-70"><span
                                                                            class="show_mobile text-bold">Điểm:</span>&nbsp;{{ $_gift->gt }}
                                                                    </div>
                                                                    <div class="col-lg-2 mt-70">
                                                                        <span class="show_mobile text-bold">Loại
                                                                            quà:</span>&nbsp;{{ $_gift->gift_type_name }}
                                                                    </div>

                                                                    <div class="col-lg-6 my-gift-image">
                                                                        <label><span
                                                                                class="show_mobile text-bold">Mã:</span>&nbsp;{{ $_gift->gift_code }}</label>
                                                                        <img src="{{ $_gift->gift_code_image }}" alt=""
                                                                            class="gift" />
                                                                        <p>
                                                                            <a href="{{ $_gift->gift_code_link }}"
                                                                                target="_blank">{{ $_gift->gift_code_link }}</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    {!! $my_gift->links() !!}
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
