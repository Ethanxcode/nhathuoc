@extends('layouts.app')
@section('title')
    Customer Points
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Customer Points</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('customerPoints.create') }}" class="btn btn-primary form-btn">Customer Point <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.customer_points.table')
                    @include('backend.customer_points.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('customerPoints.index') }}/";
        let customers = {!! json_encode($customers) !!};
        let products = {!! json_encode($products) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/customer_points/customer_points.js') }}"></script>
@endsection
