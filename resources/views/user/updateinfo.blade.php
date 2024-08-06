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
                                    <h5>Cập nhật thông tin khách hàng</h5>
                                    <div class="content">
                                        @include('stisla-templates::common.errors')
                                        <div class="section-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            {!! Form::model($user, ['route' => ['info.update',
                                                            $user->id], 'method' => 'patch']) !!}
                                                            <div class="row">
                                                                @include('user.fields')
                                                            </div>

                                                            {!! Form::close() !!}
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection