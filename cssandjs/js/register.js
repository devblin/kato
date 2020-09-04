let registerBtn = $("#register");
registerBtn.click(e => {
  e.preventDefault();
  var url = baseUrl + "/user/user_auth.php";
  var data = {
    register: true,
    newfname: $("#newfname").val(),
    newlname: $("#newlname").val(),
    newemail: $("#newemail").val(),
    newuname: $("#newuname").val(),
    newrole: $("#newrole").val(),
    newpwd: $("#newpwd").val()
  };
  var beforeSend = function () {
    whileAuth("register", true, smallSpinner);
  };
  var success = function (data) {
    if (data == 1) {
      showInfo("Registration Successfull!", false);
    } else {
      console.log(data);
      showInfo("ERROR! Please Check Log for details", true);
    }
  };
  function ifEmpty() {
    var res = true;
    $.each(data, (key, value) => {
      if (value == "" || value == null) {
        res = false;
      }
    });
    return res;
  }
  if (ifEmpty()) {
    sendAjax(url, "POST", data, beforeSend, success);
  } else {
    showInfo("Empty Field(s)", true);
  }
});
