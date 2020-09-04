let loginBtn = $("#login");

loginBtn.click(e => {
  e.preventDefault();
  var userName = $("#username");
  var userPwd = $("#userpwd");
  var url = baseUrl + "/user/user_auth.php";
  if (userName.val() != "" && userPwd.val() != "") {
    var data = {
      login: true,
      username: userName.val(),
      userpwd: userPwd.val()
    };

    var beforeSend = function () {
      whileAuth("login", true, smallSpinner);
    };

    var success = function (data) {
      if (data == 1) {
        window.location = baseUrl;
      } else if (data == 0) {
        showInfo("Username doesn't exist");
      } else {
        showInfo("Invalid Credentials");
      }
      whileAuth("login", false, "Login");
    };

    sendAjax(url, "POST", data, beforeSend, success);
  } else {
    showInfo("Username/Password field empty!");
    console.log("EMPTY");
  }
});
