$(function () {});

$(".btn-filter").on(
  "click", //method
  function () {
    var data = getFilters();
    console.log(data);
    location.href = baseURL + "/reportcustomer?customer=" + data.customer;
  }
);

function getFilters() {
  var data = {
    customer: $("[name=Customer]").find(":selected").val(),
  };

  return data;
}

$("#btn-print").on("click", function () {
  var params = getFilters();

  var url = baseURL + "printreportcustomer?customer=" + params.customer;
  window.open(url);
});
