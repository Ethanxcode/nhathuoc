"use strict";

let tableName = "#customerPointsTable";
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
      targets: [4],
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
      data: "user_id",
      name: "user_id",
      render: function(name, display, row) {
        if (!row.user_id) return "";
        return customers[row.user_id] ? customers[row.user_id] : "";
      },
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
      data: "points",
      name: "points",
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

        return prepareTemplateRender("#customerPointsTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Customer Point");
});
