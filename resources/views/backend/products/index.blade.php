@extends('layouts.app')
@section('title')
    Products
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('products.create') }}" class="btn btn-primary form-btn">Product <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.products.table')
                    @include('backend.products.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('products.index') }}/";
        let clients = {!! json_encode($clients) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/products/products.js') }}"></script>
@endsection
