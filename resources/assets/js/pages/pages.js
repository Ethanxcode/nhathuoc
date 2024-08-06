"use strict";

let tableName = "#pagesTable";
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
      data: "title",
      name: "title",
    },
    {
      data: "description",
      name: "description",
    },
    {
      data: "content",
      name: "content",
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

        return prepareTemplateRender("#pagesTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Page");
});
