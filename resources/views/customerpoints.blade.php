@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">&nbsp;</h3>
                            <div class="row">
                                <div class="col-lg-3">
                                    @include('frontend.layouts.sidebar')
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="mb-30">Xem điểm tích luỹ</h5>
                                    <table class="table table-bordered data-table" id="customer_points">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Sản phẩm</th>
                                                <th>Điểm</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('scripts')
<script>
let recordsURL = "{{ route('points') }}/";
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
<script>
"use strict";

let tableName = "#customer_points";
$(tableName).DataTable({
    scrollX: true,
    searching: true,
    deferRender: true,
    scroller: true,
    processing: true,
    order: [
        [0, "asc"]
    ],
    ajax: {
        url: recordsURL,
    },
    columnDefs: [{
        targets: [3],
        orderable: false,
        className: "text-center",
        width: "8%",
    }, ],
    columns: [{
            data: "id",
            name: "id",
            width: "16%",
        },
        {
            data: "product_name",
            name: "product_name",
            searchable: true
        },
        {
            data: "points",
            name: "points",
        },
        {
            data: function(row) {
                let url = recordsURL + row.id;
                /*let data = [{
                    id: row.id,
                    url: url + "/view",
                }, ];
                 */
                return `&nbsp;`;
            },
            name: "id"
        },
    ],
});
</script>
@endsection