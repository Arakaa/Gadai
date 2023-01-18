$(function () {
  setFilterDaterange();
});

$(".daterange-listing").daterangepicker(
  {
    startDate: $("[name=Daterange]").val()
      ? moment($("[name=Daterange]").val().split(" - ")[0])
      : moment().subtract(29, "days"),
    endDate: $("[name=Daterange]").val()
      ? moment($("[name=Daterange]").val().split(" - ")[1])
      : moment(),
    opens: "left",
    parentEl: ".content-inner",
  },
  function (start, end) {
    $(".daterange-listing").html(
      start.format("MMMM D, YYYY") +
        " &nbsp; - &nbsp; " +
        end.format("MMMM D, YYYY")
    );
  }
);

// Display date format
$(".daterange-listing span").html(
  ($("[name=Daterange]").val()
    ? moment($("[name=Daterange]").val().split(" - ")[0]).format("MMMM D, YYYY")
    : moment().subtract(29, "days").format("MMMM D, YYYY")) +
    " &nbsp; - &nbsp; " +
    ($("[name=Daterange]").val()
      ? moment($("[name=Daterange]").val().split(" - ")[1]).format(
          "MMMM D, YYYY"
        )
      : moment().format("MMMM D, YYYY"))
);

$("body").on(
  "click", //method
  ".daterangepicker > .drp-buttons > .applyBtn", //selector
  function () {
    setFilterDaterange();
  }
);

function setFilterDaterange() {
  var dateRanges = $("button.daterange-listing").text().split("-");
  if (dateRanges) {
    var startDate = dateRanges[0].trim();
    var endDate = dateRanges[1].trim();
    $("[name=Daterange]").val(startDate + " - " + endDate);
  }
}

$(".btn-filter").on(
  "click", //method
  function () {
    var data = getFilters();
    console.log(data);
    location.href =
      baseURL +
      "/reporttransaction?daterange=" +
      data.daterange +
      "&code=" +
      data.code +
      "&desc=" +
      data.desc +
      "&status=" +
      data.status +
      "&statuspayment=" +
      data.statuspayment +
      "&customer=" +
      data.customer +
      "&item=" +
      data.item;
  }
);

function getFilters() {
  var data = {
    daterange: $("[name=Daterange]").val(),
    code: $("[name=Code]").val(),
    status: $("[name=Status]").find(":selected").val(),
    customer: $("[name=Customer]").find(":selected").val(),
    item: $("[name=Item]").find(":selected").val(),
  };

  return data;
}

$("#btn-print").on("click", function () {
  var params = getFilters();

  var url =
    baseURL +
    "printreporttransaction?daterange=" +
    params.daterange +
    "&code=" +
    params.code +
    "&status=" +
    params.status +
    "&customer=" +
    params.customer +
    "&item=" +
    params.item;
  window.open(url);
});

//  href = "<?php echo base_url() ?>dashboard/printreporttransaction";
