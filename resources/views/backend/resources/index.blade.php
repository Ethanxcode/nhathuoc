@extends('layouts.app')
@section('title')
    Resources 
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Resources</h1>
            <!-- <div class="section-header-breadcrumb">
                <a href="{{ route('resources.create')}}" class="btn btn-primary form-btn">Resources <i class="fas fa-plus"></i></a>
            </div> -->
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.resources.table')
                    @include('backend.resources.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('resources.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/resources/resources.js')}}"></script>
@endsection
