@extends('layouts.app')
@section('title')
    Customer Gifts
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Customer Gifts</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('customerGifts.create') }}" class="btn btn-primary form-btn">Customer Gift <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.customer_gifts.table')
                    @include('backend.customer_gifts.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('customerGifts.index') }}/";
        let customers = {!! json_encode($customers) !!};
        let gifts = {!! json_encode($gifts) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/customer_gifts/customer_gifts.js') }}"></script>
@endsection
