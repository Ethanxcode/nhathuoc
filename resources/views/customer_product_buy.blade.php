@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Thông tin khách hàng</h3>
                            <div class="row">
                                <div class="col-lg-3">
                                    @include('frontend.layouts.sidebar')
                                </div>
                                <div class="col-lg-8">
                                    Customer Product Buy
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