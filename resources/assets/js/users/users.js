"use strict";

let tableName = "#usersTable";
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
      targets: 0,
      className: "text-center",
      width: "5%",
    },
    {
      targets: 7,
      className: "text-center",
      width: "10%",
    },
    {
      targets: 5,
      className: "text-center",
      width: "10%",
    },
    {
      targets: [7],
      orderable: false,
      className: "text-center",
      width: "15%",
    },
  ],
  columns: [
    {
      data: "id",
      name: "id",
    },
    {
      data: "name",
      name: "name",
    },
    {
      data: "email",
      name: "email",
    },
    {
      data: "phone",
      name: "phone",
    },
    {
      data: "address",
      name: "address",
    },
    {
      data: "avatar",
      name: "avatar",
    },
    {
      data: "active",
      name: "active",
      render: function(id, display, row) {
        console.log(row.active);
        return row.active == 1 ? "Hoạt động" : "Không hoạt động";
      },
    },
    {
      data: function(row) {
        let url = recordsURL + row.id;
        let data = [
          {
            id: row.id,
            url: url + "/edit",
            url_view: url,
          },
        ];

        return prepareTemplateRender("#usersTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Users");
});
