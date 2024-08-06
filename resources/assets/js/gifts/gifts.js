"use strict";

let tableName = "#giftsTable";
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
      targets: [10],
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
      data: "title",
      name: "title",
      width: "15%",
    },
    {
      data: "image",
      name: "image",
      render: function(name, display, row) {
        if (!row.image) return "";
        return "<img src='" + row.image + "' style='width:150px;'/>";
      },
    },
    {
      data: "price",
      name: "price",
    },
    {
      data: "quantity",
      name: "quantity",
    },
    {
      data: "urbox_type_id",
      name: "urbox_type_id",
      render: function(name, display, row) {
        if (!row.urbox_type_id) return "";
        return gift_types[row.urbox_type_id]
          ? gift_types[row.urbox_type_id]
          : "";
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
      data: "expired_time",
      name: "expired_time",
    },
    {
      data: "urbox_id",
      name: "urbox_id",
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

        return prepareTemplateRender("#giftsTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Gift");
});
