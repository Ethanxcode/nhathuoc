"use strict";

let tableName = "#productsTable";
$(tableName).DataTable({
  scrollX: true,
  deferRender: true,
  scroller: true,
  processing: true,
  serverSide: true,
  order: [[0, "asc"]],
  ajax: {
    url: recordsURL,
  },
  columnDefs: [
    {
      targets: [7],
      orderable: false,
      className: "text-center",
      width: "8%",
    },
  ],
  columns: [
    {
      data: "id",
      name: "id",
    },
    {
      data: "product_name",
      name: "product_name",
    },
    {
      data: "description",
      name: "description",
    },
    {
      data: "price",
      name: "price",
    },
    {
      data: "qrcode_qty",
      name: "qrcode_qty",
    },
    {
      data: "points",
      name: "points",
    },
    {
      data: "client_id",
      name: "client_id",
      render: function(name, display, row) {
        if (!row.client_id) return "";
        return clients[row.client_id] ? clients[row.client_id] : "";
      },
    },
    {
      data: function(row) {
        let url = recordsURL + row.id;
        let data = [
          {
            id: row.id,
            url: url + "/edit",
          },
        ];

        return prepareTemplateRender("#productsTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Product");
});
