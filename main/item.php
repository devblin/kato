<?php
$arr  = explode("/", $router);
$imageUrl = $baseUrl . "/product.png";
?>

<input type="hidden" class="itemid" value=<?php echo $arr[2]; ?>>

<div id="iteminfo" class="container p-0 row mb-5 ml-auto mr-auto w-auto d-flex justify-content-center mt110">
    <div class="alert alert-dismissible fade show" style="position:absolute; z-index:2;">
        <button type="button" class="close">&times;</button>
        <strong class="alert-msg"></strong>
    </div>
    <div class="itemid col-md-5 p-3"
        style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
        <img id="citemimg" class="m-2 w-100 max300" src=<?php echo $imageUrl; ?> alt="Product Image">
        <br>
        <div>
            <button id="citembuy" class="btn btn-success m-1 w-auto"><i class="fas fa-shopping-bag"></i> Buy</button>
            <button id="citemcart" class="btn m-1 auto">+ Cart</button>
            <input id="citemqty" type="number" class="form-control m-1 border border-danger" placeholder="Quantity"
                min="1">
        </div>
    </div>
    <div class="itemid col-md-6 p-3">
        <h2 id="citemname" class="m-2"></h2>
        <hr class="w-100">
        <div class="d-flex flex-column align-items-baseline">
            <b class="f18 mb-2"><i class="fas fa-server"></i> Product Category: <span id="citemcat"
                    class="text-info">Software</span></b>
            <b class="f18 mb-1"><i class="fas fa-hand-holding-usd"></i> Sold By: <span id="citemseller"
                    class="text-primary"></span></b>
            <b class="f18 mb-1"><i class="fas fa-address-card"></i> Seller Contact: <span id="citemcontact"
                    class="text-primary"></span></b>
            <hr class="w-100">
            <b class="text-primary f20 mb-1"><i class='fas fa-tag'></i> <span id="citemprice"></span></b>
            <b id="citemstock" class="f20"></b>
            <hr class="w-100">
            <h4><i class="fas fa-info-circle"></i> Product Description</h4>
            <p id="citemdesc" class="text-left maxh300" style="overflow-y: auto;"></p>
        </div>
    </div>
</div>
<script>
var alertMsg = new AlertMsg();
alertMsg.hideAlert();

$(document).on("click", ".close", function() {
    alertMsg.hideAlert();
});

class Item {
    url = baseUrl + "/main/cust_auth.php";
    constructor(id) {
        this.itemid = id;
        this.loader = defaultSpinner + "<h3 class='ml-2'>Please Wait...</h3>";
        this.mainContent = $("#iteminfo").html();
    }
    checkCartStatus = () => {
        var url = baseUrl + "/main/cust_auth.php";
        var formData = new FormData();
        formData.append("checkcartstatus", true);
        formData.append("checkitemid", this.itemid);

        var beforeSend = () => whileAuth("citemcart", true, smallSpinner);
        var success = (data) => {
            whileAuth("citemcart", false, "+ Cart");
            console.log(data);
            if (data == "added") {
                $("#citemcart").removeClass("btn-warning").addClass("btn-danger").html("- Cart");
            } else {
                $("#citemcart").addClass("btn-warning").removeClass("btn-danger").html("+ Cart");
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
    getItem = () => {
        var data = {
            iteminfo: true,
            itemid: this.itemid
        };
        var beforeSend = () => {
            whileAuth("iteminfo", false, this.loader);
        }
        var success = (data) => {
            var newData = JSON.parse(data);
            ///////////////////////////
            whileAuth("iteminfo", false, this.mainContent);
            var imgUrl = baseUrl + "/products/" + newData[0].PIMAGE + ".jpeg";
            $("#citemimg").attr("src", imgUrl);
            $("#citemname").html(newData[0].PNAME);
            $("#citemdesc").html(newData[0].PDESC);
            $("#citemprice").html("Rs. " + newData[0].PPRICE);
            $("#citemcat").html(newData[0].PTYPE);
            $("#citemseller").html(newData[0].SELLER);
            $("#citemcontact").html(newData[0].CONTACT);
            if (newData[0].PQTY == 0) {
                $("#citemstock").html("<i class='fab fa-stack-overflow'></i> Out of Stock").addClass(
                    "text-danger");
            } else {
                $("#citemstock").html("<i class='fas fa-layer-group'></i> In Stock : " + newData[0].PQTY)
                    .addClass("text-success");
            }
            /////////////////////////////
        }
        sendAjaxNew(this.url, "POST", data, beforeSend, success);
    }
    buyItem = (qty) => {
        var newData = new FormData();
        newData.append("buyitemid", this.itemid);
        newData.append("buyitemqty", qty);
        var beforeSend = () => whileAuth("citembuy", true, smallSpinner);
        var success = (data) => {
            whileAuth("citembuy", false, "Buy");
            if (data == "success") {
                alertMsg.showAlert("Item purchased (Check Orders for details)", "success");
            } else if (data == "over") {
                alertMsg.showAlert("No Stock Available", "danger");
            } else {
                alertMsg.showAlert("You can buy MAXIMUM " + data + " quantity!!!", "warning");
            }
        }
        sendAjax(this.url, "POST", newData, false, false, beforeSend, success);
    }
    addToCart = (item) => {
        var newData = new FormData();
        newData.append("cartitemid", this.itemid);
        var beforeSend = () => whileAuth("citemcart", true, smallSpinner);
        var success = (data) => {
            whileAuth("citemcart", false, "+ Cart");
            if (data == "added") {
                $("#citemcart").removeClass("btn-warning").addClass("btn-danger").html("- Cart");
                alertMsg.showAlert("Added to Cart", "success");
            } else if (data == "removed") {
                $("#citemcart").removeClass("btn-danger").addClass("btn-warning").html("+ Cart")
                alertMsg.showAlert("Removed from Cart", "success");
            } else if (data == "cantadd") {
                alertMsg.showAlert("Item Out-Of-Stock: Can't Add to Cart", "danger");
            }
        }
        sendAjax(this.url, "POST", newData, false, false, beforeSend, success);
    }
}
var newItem = new Item($(".itemid").val());
newItem.getItem();
newItem.checkCartStatus();

$(document).on("click", "#citemcart", function() {
    newItem.addToCart();
});

$(document).on("click", "#citembuy", function() {
    var itemQty = $("#citemqty").val();
    if (itemQty > 0) {
        newItem.buyItem(itemQty);
    } else {
        alertMsg.showAlert("Please Enter Qty More Than 0 !!!", "danger");
    }
});
</script>