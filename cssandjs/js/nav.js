function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
$(document).on("click", ".account", function () {
  window.location = baseUrl + "/Account";
});
$(document).on("click", ".cart", function () {
  window.location = baseUrl + "/Cart";
});
$(document).on("click", ".orders", function () {
  window.location = baseUrl + "/Orders";
});
