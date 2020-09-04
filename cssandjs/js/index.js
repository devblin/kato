let baseUrl = $("#baseurl").val();
let defaultSpinner = "<span class='spinner-border'></span>";
let smallSpinner =
  "<span class='spinner-border' style='height:1.4rem;width:1.4rem;'></span>";

function showInfo(msg, error) {
  if (error == true) {
    $("#info").addClass("text-danger");
  } else {
    $("#info").addClass("text-success");
  }
  $("#info").html(msg);
  $(".info").focusin(function () {
    $("#info").removeClass("text-danger");
    $("#info").removeClass("text-success");
    $("#info").html("");
  });
}

function whileAuth(id, bool, msg) {
  $("#" + id).prop("disabled", bool);
  $("#" + id).html(msg);
}

function sendAjax(url0, type0, data0, beforeSend0 = "", success0) {
  $.ajax({
    url: url0,
    type: type0,
    data: data0,
    beforeSend: beforeSend0,
    success: success0
  });
}
