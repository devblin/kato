let registerBtn = $("#register");
let urlReg = baseUrl + "/user/user_auth.php";
let validType = { USERNAME: false, EMAIL: false, PWDMATCH: false };

class Validation {
  constructor(patternmsg, msgsuccess, msgerror, input, regex, type) {
    this.input = input;
    this.msgsuccess = msgsuccess;
    this.msgerror = msgerror;
    this.patternmsg = patternmsg;
    this.regex = regex;
    this.type = type;
  }
  validate() {
    if (this.input != "") {
      console.log(this.regex.test(this.input));
      if (this.regex.test(this.input)) {
        var data = { type: this.type, valid: this.input };
        var beforeSend = () => {
          console.log("SENDING");
        };
        var success = data => {
          if (data == 0) {
            showInfo(this.msgsuccess, false);
            validType[this.type] = true;
          } else {
            showInfo(this.msgerror, true);
            validType[this.type] = false;
          }
        };
        sendAjaxNew(urlReg, "POST", data, beforeSend, success);
      } else {
        showInfo(this.patternmsg, true);
      }
    } else {
      showInfo("", true);
    }
  }
}

$("#newuname").on("input", function() {
  var val = $(this).val();
  var newUname = new Validation(
    "Username must have minimum 3 and no special characters",
    "Username Available",
    "Username Already Taken",
    val,
    /^[A-Za-z0-9]{3,}$/,
    "USERNAME"
  );
  newUname.validate();
});

$("#newemail").on("input", function() {
  var val = $(this).val();
  var newEmail = new Validation(
    "Email format invalid",
    "Email Available",
    "Email Already in Use",
    val,
    /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/,
    "EMAIL"
  );
  newEmail.validate();
});

$("#showpwd").click(function() {
  if ($(".pwds").attr("type") == "text") {
    $(".pwds").attr("type", "password");
    $(this).removeClass("fa-eye-slash");
    $(this).addClass("fa-eye");
  } else {
    $(".pwds").attr("type", "text");
    $(this).removeClass("fa-eye");
    $(this).addClass("fa-eye-slash");
  }
});

$(document).on("input", ".pwds", function() {
  var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$/;
  var newPwd = $("#newpwd").val();
  var newCpwd = $("#newcpwd").val();
  if (newPwd != "") {
    if (regex.test(newPwd)) {
      if (newPwd == newCpwd) {
        validType["PWDMATCH"] = true;
        showInfo("Passwords Match", false);
      } else {
        validType["PWDMATCH"] = false;
        showInfo("Passwords Do Not Match", true);
      }
    } else {
      validType["PWDMATCH"] = false;
      showInfo(
        "Password must be minimum 4 and at least one lowercase, UPPERCASE and a number",
        true
      );
    }
  }
});

registerBtn.click(e => {
  e.preventDefault();
  var data = {
    register: true,
    newfname: $("#newfname").val(),
    newlname: $("#newlname").val(),
    newemail: $("#newemail").val(),
    newuname: $("#newuname").val(),
    newrole: $("#newrole").val(),
    newpwd: $("#newpwd").val()
  };
  var beforeSend = () => {
    whileAuth("#register", true, smallSpinner);
  };
  var success = data => {
    if (data == 1) {
      showInfo("Registration Successfull!", false);
    } else {
      console.log(data);
      showInfo("ERROR! Please Check Log for details", true);
    }
    whileAuth("#register", false, "Register");
  };

  if (ifEmpty(data, "", null) && ifEmpty(validType, false, false)) {
    sendAjaxNew(urlReg, "POST", data, beforeSend, success);
  } else if (ifEmpty(validType, true, true)) {
    showInfo("Check Username/Password/E-Mail", true);
  } else {
    showInfo("Empty Field(s)", true);
  }
});
