var isEdit = $("[name=Id]").val();
var interest = 0;

$(".btn-submit").on("click", function () {
  if (Validation()) $("#myform").submit();
});

function Validation() {
  if (!isEdit) {
    if (!$("[name=Date]").val()) {
      alert("Date is required!");
      return false;
    }
    if (!$("[name=Code]").val()) {
      alert("Code is required!");
      return false;
    }
    if (!$("[name=Customer]").val()) {
      alert("Customer is required!");
      return false;
    }
    if (!$("[name=ItemName]").val()) {
      alert("Item Name is required!");
      return false;
    }
    if (!$("[name=ItemCode]").val()) {
      alert("ItemCode is required!");
      return false;
    }
    if (!$("[name=Price]").val()) {
      alert("Price is required!");
      return false;
    }
    if (!$("[name=Pay]").val()) {
      alert("Pay is required!");
      return false;
    }
  }

  if (!$("[name=NIK]").val()) {
    alert("NIK is required!");
    return false;
  }
  if (!$("[name=Address]").val()) {
    alert("Address is required!");
    return false;
  }
  if (!$("[name=Phone]").val()) {
    alert("Phone Number is required!");
    return false;
  }

  return true;
}

function SetInterest(pay) {
  var res = "";
  switch (pay) {
    case 3:
      res = "2.5% of Price";
      interest = 2.5;
      break;
    case 6:
      res = "5% of Price";
      interest = 5;
      break;
    case 12:
      res = "10% of Price";
      interest = 10;
      break;
  }

  $("#text-interest").text(res);
}

$("[name=Price]").on("keyup", function () {
  GenerateTableResultTransaction(
    $("[name=Pay]").val(),
    parseFloat($(this).val())
  );
});

$("[name=Date]").on("focusout", function () {
  GenerateTableResultTransaction(
    $("[name=Pay]").val(),
    parseFloat($("[name=Price]").val())
  );
});

$("[name=Pay]").on("change", function () {
  var $val = parseInt($(this).val());
  SetInterest($val);
  GenerateTableResultTransaction($val, parseFloat($("[name=Price]").val()));
});

function GenerateTableResultTransaction(month, price) {
  var $table = $("#table-result");

  var due = moment($("[name=Date]").val()).add(30, "days");
  var totalPrice = interest > 0 ? price + price * (interest / 100) : price;
  var pricePerMonth = month > 0 ? totalPrice / month : 0;

  $table.find("tbody").empty();
  for (var idx = 1; idx <= month; idx++) {
    var $template = $("#template-body-table-result").html();
    var html = $($template);
    html.find("#template-body-month").text(idx);
    html.find("#template-body-due").text(due.format("MMMM D, YYYY"));
    html
      .find("#template-body-price")
      .text(!isNaN(pricePerMonth) ? pricePerMonth.toLocaleString() : 0);
    $table.find("tbody").append(html);
    due = due.add(30, "days");
  }
}

$("[name=Customer]").on("change", function () {
  var id = $(this).val();
  $.ajax({
    type: "GET",
    url: baseURL + "/findcustomer/" + id,
    success: function (response) {
      var parseResponse = JSON.parse(response);
      console.log("[FindCustomer] Response: ", parseResponse);
      if (parseResponse) {
        if (parseResponse.success) {
          var model = parseResponse.entity;
          console.log("[FindCustomer] Model: ", model);
          $("[name=NIK]").val(model.nik);
          $("[name=Phone]").val(model.phone_number);
          $("[name=Address]").val(model.address);
        } else {
          alert(parseResponse.message);
        }
      }
    },
  });
});

$(function () {
  if (isEdit) {
    SetInterest(parseInt($("[name=Pay]").val()));
    GenerateTableResultTransaction(
      $("[name=Pay]").val(),
      parseFloat($("[name=Price]").val())
    );
  }
});
