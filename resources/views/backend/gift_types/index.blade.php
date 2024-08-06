@extends('layouts.app')
@section('title')
    Gift Types
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gift Types</h1>
            <div class="section-header-breadcrumb">
                <!--<a href="{{ route('giftTypes.create') }}" class="btn btn-primary form-btn">Gift Type <i
                                                                    class="fas fa-plus"></i></a>-->
                <a href="javascript:void(0);" class="btn btn-primary form-btn import-gift-types">Import Gift Types <i
                        class="fas fa-file-import"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('backend.gift_types.table')
                    @include('backend.gift_types.templates.templates')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let recordsURL = "{{ route('giftTypes.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/gift_types/gift_types.js') }}"></script>

    <script>
        $(document).on('click', '.import-gift-types', function(e) {
            $.ajax({
                url: "{{ route('gifttypes.import') }}",
                method: 'GET',
                data: {},
                success: function(result) {
                    console.log(result);
                }
            });
        });
    </script>
@endsection
