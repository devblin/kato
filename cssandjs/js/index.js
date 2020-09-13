let baseUrl = $("#baseurl").val();
let defaultSpinner = "<span class='spinner-border'></span>";
let defaultSpinnerLogo = "<span class='spinner-border logocolor'></span>";
let smallSpinner =
  "<span class='spinner-border' style='height:1.4rem;width:1.4rem;'></span>";

let errorConsole = "font-size:18px;color:red;background-color:black;";
let successConsole = "font-size:18px;color:green;background-color:black;";

$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

function showInfo(msg, error) {
  if (error == true) {
    $("#info").css("color", "red");
  } else {
    $("#info").css("color", "green");
  }
  $("#info").html(msg);
  $(".info").on("click", function() {
    $("#info").html("");
  });
}

function ifEmpty(data, ...condition) {
  var res = true;
  $.each(data, (key, value) => {
    if (value == condition[0] || value == condition[1]) {
      res = false;
    }
  });
  return res;
}

function whileAuth(id, bool, msg) {
  $(id).prop("disabled", bool);
  $(id).html(msg);
}

function sendAjax(
  url0,
  type0,
  data0,
  contentType0,
  processData0,
  beforeSend0 = "",
  success0
) {
  $.ajax({
    url: url0,
    type: type0,
    data: data0,
    contentType: contentType0,
    processData: processData0,
    beforeSend: beforeSend0,
    success: success0
  });
}
function sendAjaxNew(url0, type0, data0, beforeSend0 = "", success0) {
  $.ajax({
    url: url0,
    type: type0,
    data: data0,
    beforeSend: beforeSend0,
    success: success0
  });
}

class AlertMsg {
  showAlert = (msg, type) => {
    this.msg = msg;
    this.type = type;
    $(".alert").removeClass("alert-success");
    $(".alert").removeClass("alert-danger");
    $(".alert").removeClass("alert-warning");
    $(".alert").addClass("alert-" + this.type);
    $(".alert-msg").html(msg);
    $(".alert").show();
  };
  hideAlert = () => {
    $(".alert").removeClass("alert-" + this.type);
    $(".alert").hide();
  };
}

let showPreview = false;
let validImageTypes = [
  "image/png",
  "image/jpeg",
  "image/jpg",
  "image/jfif",
  "image/gif"
];

function readUrl(input, preview, choose) {
  let newFile = input.files[0];
  let imageType = newFile["type"];
  if ($.inArray(imageType, validImageTypes) >= 0) {
    var reader = new FileReader();
    reader.onload = function(e) {
      preview.attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
    showPreview = true;
  } else {
    showPreview = false;
    console.log("error");
    choose.val("");
    alertMsg.showAlert("Invalid Image Type", "danger");
  }
}
