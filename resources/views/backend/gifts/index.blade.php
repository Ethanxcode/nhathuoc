@extends('layouts.app')
@section('title')
    Gifts
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gifts</h1>
            <div class="section-header-breadcrumb">
                <a href="javascript:void(0);" class="btn btn-primary form-btn import-gift">Import Gifts <i
                        class="fas fa-file-import"></i></a>
                <!-- <a href="{{ route('gifts.create') }}" class="btn btn-primary form-btn">Gift <i class="fas fa-plus"></i></a> -->
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.gifts.table')
                    @include('backend.gifts.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('gifts.index') }}/";
        let gift_types = {!! json_encode($gift_types) !!};
        let clients = {!! json_encode($clients) !!};
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/gifts/gifts.js') }}"></script>

    <script>
        $(document).on('click', '.import-gift', function(e) {
            $.ajax({
                url: "{{ route('gifts.import') }}",
                method: 'GET',
                data: {},
                success: function(result) {
                    console.log(result);
                }
            });
        });
    </script>

@endsection
