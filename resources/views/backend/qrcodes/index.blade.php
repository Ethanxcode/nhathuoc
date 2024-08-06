@extends('layouts.app')
@section('title')
    Qrcodes
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Qrcodes</h1>
            <!-- <div class="section-header-breadcrumb">
                <a href="{{ route('qrcodes.create') }}" class="btn btn-primary form-btn">Qrcode <i
                        class="fas fa-plus"></i></a>
            </div> -->
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.qrcodes.table')
                    @include('backend.qrcodes.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('qrcodes.index') }}/";
        let products = {!! json_encode($products) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/qrcodes/qrcodes.js') }}"></script>
@endsection
