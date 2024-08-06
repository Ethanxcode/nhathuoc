@extends('layouts.app')
@section('title')
    Customer Client Points
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Customer Client Points</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('customerClientPoints.create') }}" class="btn btn-primary form-btn">Customer Client Point
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.customer_client_points.table')
                    @include('backend.customer_client_points.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('customerClientPoints.index') }}/";
        let clients = {!! json_encode($clients) !!};
        let customers = {!! json_encode($customers) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/customer_client_point/customer_client_point.js') }}"></script>
@endsection
