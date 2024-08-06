'use strict';

let tableName = '#resourcesTable';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: recordsURL,
    },
    columnDefs: [
        {
            "targets": 0,
            "className": "text-center",
            "width": "5%"
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center',
            'width': '15%',
        },
    ],
    columns: [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'user_id',
            name: 'user_id'
        },{
            data: 'file_name',
            name: 'file_name'
        },{
            data: 'content_type',
            name: 'content_type'
        },{
            data: 'title',
            name: 'title'
        },
        {
            data: function (row) {
                let url = recordsURL + row.id;
                let data = [
                {
                    'id': row.id,
                    'url': url + '/edit',
                    'url_view': url
                }];
                                
                return prepareTemplateRender('#resourcesTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'Resources');
});
