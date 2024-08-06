@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('css')
<link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>

    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                This is Dashboard Content
                @include('backend.dashboard.templates.templates')
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
let recordsURL = "{{ route('dashboard.index') }}/";
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection