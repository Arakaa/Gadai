function timeSince(date, extraString) {
  extraString = extraString ?? "";
  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + " years " + extraString;
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + " months " + extraString;
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + " days " + extraString;
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + " hours " + extraString;
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + " minutes " + extraString;
  }
  return Math.floor(seconds) + " seconds " + extraString;
}

function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));

  if (days > 0) {
    return {
      result: days,
      label: "days",
    };
  }
  if (hours > 0) {
    return {
      result: hours,
      label: "hours",
    };
  }
  if (minutes > 0) {
    return {
      result: minutes,
      label: "minutes",
    };
  }
  return {
    result: seconds,
    label: "seconds",
  };
}

$(function () {
  $.each($(".text-ago"), function (idx, el) {
    var time = $(el).data("created");
    var stamp = timeSince(new Date(time), "ago");
    $(el).text(stamp);
  });
  $.each($(".text-due-transaction"), function (idx, el) {
    var pay = $(el).data("pay");
    var date = $(el).data("date");

    var startDate = moment().startOf("day").add(1, "days");
    var endDate = moment().startOf("day").add(7, "days");
    var due = moment();
    for (var idx = 0; idx <= pay; idx++) {
      var dueDate = moment(date).add(idx * 30, "days");
      if (dueDate >= startDate && dueDate <= endDate) {
        due = dueDate;
        break;
      }
    }
    var stamp = getTimeRemaining(due.format("MMMM D YYYY"));
    var strHtml =
      '<h6 class="mb-0">' +
      stamp.result +
      '</h6><div class="fs-sm text-muted lh-1">' +
      stamp.label +
      "</div>";
    $(el).append(strHtml);
    $(el)
      .closest("tr")
      .find("span.text-period-due")
      .text(due.format("MMMM YYYY"));
  });
});
