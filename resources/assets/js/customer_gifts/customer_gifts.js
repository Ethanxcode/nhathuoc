"use strict";

let tableName = "#customerGiftsTable";
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
      targets: [3],
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
      data: "gift_id",
      name: "gift_id",
      render: function(name, display, row) {
        if (!row.gift_id) return "";
        return gifts[row.gift_id] ? gifts[row.gift_id] : "";
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

        return prepareTemplateRender("#customerGiftsTemplate", data);
      },
      name: "id",
    },
  ],
});

$(document).on("click", ".delete-btn", function(event) {
  let recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Customer Gift");
});
