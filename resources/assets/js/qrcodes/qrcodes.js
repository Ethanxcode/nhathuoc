"use strict";

let tableName = "#qrcodesTable";
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
      targets: [5],
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
      data: "qr_code",
      name: "qr_code",
    },
    {
      data: "image",
      name: "image",
    },
    {
      data: "product_id",
      name: "product_id",
      render: function(name, display, row) {
        if (!row.product_id) return "";
        return products[row.product_id] ? products[row.product_id] : "";
      },
    },
    {
      data: "status",
      name: "status",
      render: function(name, display, row) {
        if (!row.status) return "";
        return row.status == 1 ? "Hoạt động" : "Không hoạt động";
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

        return prepareTemplateRender("#qrcodesTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Qrcode");
});
