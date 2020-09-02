<div class="container p-0 row mb-5 ml-auto mr-auto w-auto d-flex flex-column justify-content-center mt110">
    <div class="alert alert-dismissible alert-success fade show" style="z-index:2;">
        <button type="button" class="close">&times;</button>
        <strong class="alert-msg">Your Cart</strong>
    </div>
    <h3 class="mb-3">Your Cart</h3>
    <hr class="w-100">
    <div id="cartlist" class="list-group d-flex align-items-center">
        <h3 id="cartloader" class='m-5'></h3>
    </div>

</div>
<script>
//GOTO THE ITEM
$(document).on("click", ".viewitem,.buycart", function() {
    var goTo = $(this).parentsUntil().filter("li").attr("data-item");
    window.location = baseUrl + "/Item/" + goTo;
});

var alertMsg = new AlertMsg();
alertMsg.hideAlert();

class Cart {
    url = baseUrl + "/main/cust_auth.php";
    emptyList = () => {
        return "<i class='fas fa-cart-arrow-down text-warning'></i> Empty Cart";
    }
    appendList = (id, src, stockStatus, itemName, itemType, itemPrice) => {
        var imageSrc = baseUrl + "/products/" + src + ".jpeg";
        var stockClass = "text-success";
        var stockStatus = "In Stock";
        if (stockStatus == 0) {
            stockClass = "text-danger";
            stockStatus = "Out of Stock";
        }
        return "<li data-item=" + id + " class='p-1 list-group-item list-group-item-action d-flex max500'>" +
            "<div>" +
            "<img class='viewitem m-1 w-100 max122' src=" + imageSrc + "><br>" +
            "<b class='cartstock " + stockClass + "'>" + stockStatus + "</b>" +
            "</div>" +
            "<div class='text-left ml-2'>" +
            "<div><b>Product Name: </b> <span class='cartname text-info'>" + itemName + "</span></div>" +
            "<div><b>Type: </b> <span class='carttype text-info'>" + itemType + "</span></div>" +
            "<div class='mb-1'><b>Price:</b> <span class='cartprice text-danger'>Rs. " + itemPrice +
            "</span></div>" +
            "<button class='removecart m-1 btn btn-danger'>- Cart</button>" +
            "<button class='buycart m-1 btn btn-warning'>Buy</button>" +
            "</div>" +
            "</li>";
    }
    removeCart = (itemRef) => {
        var formData = new FormData();
        var itemId = itemRef.parentsUntil().filter("li").attr("data-item");
        formData.append("removecart", itemId);

        var beforeSend = () => whileAuth(itemRef, false, smallSpinner);
        var success = (data) => {
            if (data == "removed") {
                itemRef.parentsUntil().filter("li").remove();
            }
            if ($("#cartlist").children().length == 1) {
                $("#cartloader").html(this.emptyList);
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }

    getCart = () => {
        var formData = new FormData();
        formData.append("getcartlist", true);

        var beforeSend = () => whileAuth("#cartloader", false, defaultSpinner);
        var success = (data) => {
            whileAuth("#cartloader", false, "");
            var newData = JSON.parse(data);
            if (Array.isArray(newData)) {
                console.log(newData);
                $.each(newData, (key, value) => {
                    var toAppend = this.appendList(value.CITEM, value.IMAGE, value.STOCK, value.NAME,
                        value
                        .TYPE, value.PRICE);
                    $("#cartlist").prepend(toAppend);
                });
            } else {
                $("#cartloader").append(this.emptyList);
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var newCart = new Cart();
newCart.getCart();

$(document).on("click", ".removecart", function() {
    newCart.removeCart($(this));
});
</script>