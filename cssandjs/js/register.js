let registerBtn = $("#register");
registerBtn.click(e => {
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
});
