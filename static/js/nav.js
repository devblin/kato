function openNav() {
	document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
	document.getElementById("mySidepanel").style.width = "0";
}

$(document).on("click", ".account", function () {
	window.location = baseUrl + "/Account";
});
//CUSTOMER
$(document).on("click", ".cart", function () {
	window.location = baseUrl + "/Cart";
});
$(document).on("click", ".orders", function () {
	window.location = baseUrl + "/Orders";
});
//SELLER
$(document).on("click", ".newitem", function () {
	window.location = baseUrl + "/NewItem";
});
$(document).on("click", ".inventory", function () {
	window.location = baseUrl + "/Inventory";
});
$(document).on("click", ".sales", function () {
	window.location = baseUrl + "/Sales";
});
$(document).on("click", ".stats", function () {
	window.location = baseUrl + "/Statistics";
});
