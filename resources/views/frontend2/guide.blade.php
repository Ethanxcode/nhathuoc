@extends('frontend2.layouts.app')
@section('content')
<div class="container">
    <section class="section ">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card guide-page-background">
                        <div class="card-body guide-page">
                            @if($page)

                            <div class="guide-page-title">
                                <span class="account-page-title">Hướng dẫn</span>
                                <hr class="account-page-line" />
                            </div>

                            <div class="content guide-line">
                                <!-- <p class="guide-line">
                                    Chương trình "Quét mã QR - Tích điểm đổi quà" đã được khởi động
                                    với những phần quà
                                    giá
                                    trị. Đây là chương trình mà người dùng sẽ quét mã QR để tích điểm trúng thưởng.
                                </p>
                                <p class="guide-line">
                                    Để tham gia chương trình "Quét mã QR - Tích điểm đổi quà" , mua sản phẩm và quét mã
                                    Qr code tích điểm để đổi quà.
                                </p>
                                <p class="guide-line">
                                    Chương trình "Quét mã QR - Tích điểm đổi quà" sẽ diễn
                                    ra hàng ngày xuyên suốt từ 2/12 đến 8/12, với mỗi mã QR trúng thưởng có hiệu lực quy
                                    đổi từ 10h00 đến 22h00 mỗi ngày. Bên dưới đây sẽ là hướng dẫn cụ thể hơn.
                                </p>

                                <span class="guide-line-title">Hướng dẫn quét mã QR</span>
                                <ul>
                                    <li>
                                        <label>Bước 1:</label> Để tham gia chương trình "Quét mã QR - Tích điểm đổi
                                        quà", Bán 1 sản phẩm từ bất kì cửa hàng thuốc nào có mã QR của chương trình
                                    </li>
                                    <li>
                                        <label>Bước 1:</label> Tìm mã QR để quét trang web www.vn
                                    </li>
                                </ul>
                                <p><strong>Lưu ý:</strong> Mỗi người chơi trúng thưởng cần hoàn thành điền đầy đủ
                                    thông tin để đối
                                    chiếu nhận thưởng</p> -->

                                {!! $page->content !!}
                            </div>

                            @else

                            <div class="row content">
                                Chưa có dữ liệu
                            </div>


                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection