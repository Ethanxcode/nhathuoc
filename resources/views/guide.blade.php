@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body guide-page">
                            @if($page)
                            <h5 class="text-center">{{$page->title}}</h5>
                            <div class="container">
                                <div class="row content">
                                    {{$page->content}}
                                </div>
                            </div>
                            @else
                            <h5>Chưa có dữ liệu</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection