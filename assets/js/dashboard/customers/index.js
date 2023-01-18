$(".btn-filter").on(
  "click", //method
  function () {
    var data = getFilters();
    console.log(data);
    location.href =
      baseURL +
      "dashboard/customer?name=" +
      data.name +
      "&nik=" +
      data.nik +
      "&email=" +
      data.email +
      "&status=" +
      data.status;
  }
);

function getFilters() {
  var data = {
    name: $("[name=Name]").val(),
    nik: $("[name=NIK]").val(),
    email: $("[name=Email]").val(),
    status: $("[name=Status]").find(":selected").val(),
  };

  return data;
}

var modal_view = $("#modal_view");
function viewCustomer(id) {
  $.ajax({
    type: "GET",
    url: baseURL + "dashboard/findcustomer/" + id,
    success: function (response) {
      var parseResponse = JSON.parse(response);
      console.log("[FindCustomer] Response: ", parseResponse);
      if (parseResponse) {
        if (parseResponse.success) {
          var model = parseResponse.entity;
          console.log("[FindCustomer] Model: ", model);
          $("#modal-view-name").text(model.name);
          $("#modal-view-nik").text(model.nik);
          $("#modal-view-phone").text(model.phone_number);
          $("#modal-view-gender").text(model.gender);
          $("#modal-view-address").text(model.address);

          $("#modal-view-email").html(
            '<span class="badge bg-dark">' + model.email + "</span>"
          );
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

function editCustomer(id) {
  location.href = baseURL + "editcustomer/" + id;
}

function deleteCustomer(id) {
  if (confirm("Are you sure want to delete this Customer?")) {
    location.href = baseURL + "deletecustomer/" + id;
  }
}
