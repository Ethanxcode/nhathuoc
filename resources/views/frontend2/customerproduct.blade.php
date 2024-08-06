@extends('frontend2.layouts.app')
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
                                <div class="col-lg-12">
                                    <h5 class="mb-30">Sản phẩm đã quét và tích điểm</h5>
                                    <ul>
                                    @php
                                    foreach($points as $point):
                                    @endphp    
                                    <li>Tổng điểm bạn đã tích luỹ của {{$clients[$point['client_id']]}} là {{$point['total_points']}}
                                    </li>    
                                    @php
                                    endforeach;    
                                    @endphp
                                    </ul>
                                    <table class="table table-bordered data-table" id="customer_product">
                                        
                                        
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lần quét</th>
                                                <th>Nhà sản xuất</th>
                                                <th>Tổng điểm tích lũy theo loại sản</th>
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
let recordsURL = "{{ route('productbuy') }}/";
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
<script>
"use strict";

let tableName = "#customer_product";
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
        targets: [5],
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
            searchable: true,

        },
        {
            data: "sl",
            name: "sl",
            searchable: true
        },
        {
            data: "client_name",
            name: "client_name",
        },
        {
            data: "point_of_product",
            name: "point_of_product",
        },
        {
            data: function(row) {
                console.log(row);
                let url = recordsURL + row.id;
                return `&nbsp;`;
            },
            name: "id"
        },
    ],
});
</script>
@endsection