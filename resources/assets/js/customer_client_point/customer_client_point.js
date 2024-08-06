"use strict";

let tableName = "#customerClientPointsTable";
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
      data: "client_id",
      name: "client_id",
      render: function(name, display, row) {
        if (!row.client_id) return "";
        return clients[row.client_id] ? clients[row.client_id] : "";
      },
    },
    {
      data: "total_points",
      name: "total_points",
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

        return prepareTemplateRender("#customerClientPointsTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Customer Client Point");
});
