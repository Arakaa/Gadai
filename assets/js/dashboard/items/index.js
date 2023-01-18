$(".btn-filter").on(
  "click", //method
  function () {
    var data = getFilters();
    console.log(data);
    location.href =
      baseURL +
      "dashboard/item?name=" +
      data.name +
      "&code=" +
      data.code +
      "&status=" +
      data.status;
  }
);

function getFilters() {
  var data = {
    name: $("[name=Name]").val(),
    code: $("[name=Code]").val(),
    status: $("[name=Status]").find(":selected").val(),
  };

  return data;
}

var modal_view = $("#modal_view");
function viewItem(id) {
  $.ajax({
    type: "GET",
    url: baseURL + "dashboard/finditem/" + id,
    success: function (response) {
      var parseResponse = JSON.parse(response);
      console.log("[FindItem] Response: ", parseResponse);
      if (parseResponse) {
        if (parseResponse.success) {
          var model = parseResponse.entity;
          console.log("[FindItem] Model: ", model);
          $("#modal-view-name").text(model.name);
          $("#modal-view-code").text(model.code);

          $("#modal-view-status").html(
            model.status == 0
              ? '<span class="badge bg-danger">Inactive</span>'
              : '<span class="badge bg-success">Active</span>'
          );

          modal_view.modal("show");
        } else {
          alert(parseResponse.message);
        }
      }
    },
  });
}
