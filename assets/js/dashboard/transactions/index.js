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
      "/transaction?daterange=" +
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
    desc: $("[name=Description]").val(),
    status: $("[name=Status]").find(":selected").val(),
    statuspayment: $("[name=StatusPayment]").find(":selected").val(),
    customer: $("[name=Customer]").find(":selected").val(),
    item: $("[name=Item]").find(":selected").val(),
  };

  return data;
}

var modal_view = $("#modal_view");
function viewTransaction(id) {
  $.ajax({
    type: "GET",
    url: baseURL + "dashboard/findpaymenttransaction/" + id,
    success: function (response) {
      var parseResponse = JSON.parse(response);
      console.log("[FindTransaction] Response: ", parseResponse);
      if (parseResponse) {
        if (parseResponse.success) {
          var model = parseResponse.entity;
          console.log("[FindTransaction] Model: ", model);
          $("#modal-view-date").text(model.date);
          $("#modal-view-code").text(model.TransactionCode);
          $("#modal-view-customer").text(model.CustomerName);
          $("#modal-view-nik").text(model.TransactionNIK);
          $("#modal-view-address").text(model.TransactionAddress);
          $("#modal-view-phone").text(model.TransactionPhone);
          $("#modal-view-item-name").text(model.ItemName);
          $("#modal-view-item-code").text(model.ItemCode);
          $("#modal-view-price").text(
            "Rp. " + parseFloat(model.price).toLocaleString()
          );
          $("#modal-view-grand").text(
            "Rp. " + parseFloat(model.angsuran).toLocaleString()
          );
          $("#modal-view-pay").text(model.pay + " month(s)");
          $("#modal-view-status").html(
            model.TransactionStatus == 1
              ? '<span class="badge bg-secondary">Incompleted</span>'
              : model.TransactionStatus == 2
              ? '<span class="badge bg-success">Completed</span>'
              : '<span class="badge bg-danger">Cancelled</span>'
          );

          $("#modal-view-desc").text(model.description);
          if (model.TransactionStatus != 3) {
            $("#print-transaction").removeClass("visually-hidden");
            $("#print-transaction").data("id", model.TransactionId);
          }

          var strHtml = "";
          var amount = parseFloat(model.angsuran / model.pay);
          var momentToday = moment();
          var dueDate = moment(model.date).add(30, "days");
          var penaltyCount = 0;
          var payments = model.payments;
          var table_view_invoices = $("#table-view-invoices > tbody");
          table_view_invoices.empty();
          for (var idx = 1; idx <= model.pay; idx++) {
            var isPaid = idx <= payments.length;
            var isOverlap = dueDate <= momentToday;
            var diff = momentToday.diff(dueDate, "days");
            if (diff > 0) penaltyCount += diff;
            strHtml +=
              '<tr class="' +
              (isPaid ? "table-success" : isOverlap ? "table-warning" : "") +
              '"><td>' +
              idx +
              "</td><td>" +
              dueDate.format("D MMMM YYYY") +
              "</td><td>Rp. " +
              amount.toLocaleString() +
              "</td><td>" +
              (isPaid
                ? "<span class='badge bg-success'><i class='ph-check'></i></span>"
                : isOverlap
                ? "<span class='badge bg-warning'><i class='ph-warning'></i></span>"
                : "<span class='badge bg-danger'><i class='ph-x'></i></span>") +
              "</td></tr>";

            dueDate = dueDate.add(30, "days");
          }
          strHtml +=
            '<tr class="table-danger row-charge"><td colspan="2">Charge</td><td class="col-value" colspan="2" data-original="' +
            penaltyCount * 5000 +
            '">Rp. ' +
            parseFloat(penaltyCount * 5000).toLocaleString() +
            "</td></tr>";
          table_view_invoices.append(strHtml);

          modal_view.modal("show");
        } else {
          alert(parseResponse.message);
        }
      }
    },
  });
}

modal_view.on("hidden.bs.modal", function () {
  $("#print-transaction").addClass("visually-hidden");
});

var modal_pay = $("#modal_pay");
function viewPayment(id) {
  $.ajax({
    type: "GET",
    url: baseURL + "/findpaymenttransaction/" + id,
    success: function (response) {
      var parseResponse = JSON.parse(response);
      console.log("[FindPaymentTransaction] Response: ", parseResponse);
      if (parseResponse) {
        if (parseResponse.success) {
          var model = parseResponse.entity;
          console.log("[FindPaymentTransaction] Model: ", model);

          $("#modal-payment-transaction-id").val(model.TransactionId);
          var payments = model.payments;
          var amount = parseFloat(model.angsuran / model.pay);
          var table_view_payment = $("#table-view-payment > tbody");
          table_view_payment.empty();
          var strHtml = "";
          var momentToday = moment();
          var dueDate = moment(model.date).add(30, "days");
          var penaltyCount = 0;
          for (var idx = 1; idx <= model.pay; idx++) {
            var isPaid = idx <= payments.length;
            var isOverlap = dueDate <= momentToday;
            var diff = momentToday.diff(dueDate, "days");
            if (diff > 0) penaltyCount += diff;
            strHtml +=
              '<tr class="' +
              (isPaid ? "table-success" : isOverlap ? "table-warning" : "") +
              '"><td>' +
              idx +
              "</td><td>" +
              dueDate.format("D MMMM YYYY") +
              "</td><td>Rp. " +
              amount.toLocaleString() +
              "</td><td>" +
              (isPaid
                ? "<span class='badge bg-success'><i class='ph-check'></i></span>"
                : isOverlap
                ? "<span class='badge bg-warning'><i class='ph-warning'></i></span>"
                : "<span class='badge bg-danger'><i class='ph-x'></i></span>") +
              "</td></tr>";

            dueDate = dueDate.add(30, "days");
          }
          strHtml +=
            '<tr class="table-danger row-charge"><td colspan="2">Charge</td><td class="col-value" colspan="2" data-original="' +
            penaltyCount * 5000 +
            '">Rp. ' +
            parseFloat(penaltyCount * 5000).toLocaleString() +
            "</td></tr>";
          table_view_payment.append(strHtml);

          $("#modal-payment-grand")
            .text("Rp. " + parseFloat(model.angsuran).toLocaleString())
            .data("original", parseFloat(amount));

          console.log("[FindPaymentTransaction] Model Payments: ", payments);
          strHtml = "<option selected hidden></option>";
          $("[name=Pay]").empty();
          for (var idx = 1; idx <= model.pay - payments.length; idx++) {
            strHtml +=
              "<option value='" + idx + "'>" + idx + " month(s)</option>";
          }
          $("[name=Pay]").append(strHtml);

          modal_pay.modal("show");
        } else {
          alert(parseResponse.message);
        }
      }
    },
  });
}

modal_pay.on("hidden.bs.modal", function () {
  $("[name=Method]").prop("selectedIndex", -1).change();
  $("#modal-payment-amount").text("").data("original", 0);
  $("[name=isCharge]").prop("checked", false);
});

function editTransaction(id) {
  location.href = baseURL + "edittransaction/" + id;
}

$("body").on("change", "[name=Pay]", function () {
  // if select the last option
  var charge = 0;
  var num = $(this).find("option").length;
  if ($(this).prop("selectedIndex") == num - 1) {
    $("[name=isCharge]").prop("checked", true);
    charge = $(".row-charge").find("td.col-value").data("original");
  } else {
    $("[name=isCharge]").prop("checked", false);
  }

  // set Amount Paid label
  var grandTotal = $("#modal-payment-grand").data("original");
  var amount = parseFloat(grandTotal * parseInt($(this).val()));
  $("#modal-payment-amount")
    .text("Rp. " + parseFloat(amount + charge).toLocaleString())
    .data("original", amount);
});

$("#submit-payment").on("click", function () {
  var data = GetParameterPayments();

  if (!data.payFor) {
    alert("Pay for is required!");
    return false;
  }
  if (!data.paymentMethod) {
    alert("Payment Method is required!");
    return false;
  }

  location.href =
    baseURL +
    "/setpayment?idTransaction=" +
    data.idTransaction +
    "&payFor=" +
    data.payFor +
    "&includeCharge=" +
    data.includeCharge +
    "&charge=" +
    data.charge +
    "&amount=" +
    data.amount +
    "&paymentMethod=" +
    data.paymentMethod;
});

function GetParameterPayments() {
  var payFor = $("[name=Pay]").find(":selected").val();
  var includeCharge = $("[name=isCharge]").is(":checked");
  var charge = $(".row-charge").find("td.col-value").data("original");
  var amount = $("#modal-payment-amount").data("original");
  var paymentMethod = $("[name=Method]").find(":selected").val();

  var data = {
    idTransaction: $("#modal-payment-transaction-id").val(),
    payFor: payFor,
    includeCharge: includeCharge,
    charge: charge,
    amount: amount,
    paymentMethod: paymentMethod,
  };

  return data;
}

$("#print-transaction").on("click", function () {
  var id = $(this).data("id");

  var url = baseURL + "/printtransaction/" + id;
  window.open(url);
});
