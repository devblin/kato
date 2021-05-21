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

    var beforeSend = function() {
      whileAuth("#login", true, smallSpinner);
    };

    var success = function(data) {
      console.log(data);
      if (data == 1) {
        window.location = baseUrl;
      } else if (data == 0) {
        showInfo("Username doesn't exist", true);
      } else {
        showInfo("Invalid Credentials", true);
      }
      whileAuth("#login", false, "Login");
    };
    console.log(url);
    sendAjaxNew(url, "POST", data, beforeSend, success);
  } else {
    showInfo("Username/Password field empty!", true);
    console.log("EMPTY");
  }
});
