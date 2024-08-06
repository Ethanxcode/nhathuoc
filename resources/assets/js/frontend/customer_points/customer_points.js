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
      targets: [2],
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
  ],
});
