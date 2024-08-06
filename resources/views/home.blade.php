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
                                    <h5>Xin chào, {{ $user->name}}</h5>
                                    <label>Thông tin của bạn:</label>
                                    <ul>

                                        <li>{{$user->phone}}</li>
                                        <li>{{$user->address}}</li>
                                        <li>{{$user->email}}</li>
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