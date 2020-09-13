<div class="container p-0 row mb-5 ml-auto mr-auto w-auto d-flex flex-column justify-content-center mt110">
    <h3 class="mb-3">Your Orders</h3>
    <hr class="w-100">
    <div id="orderlist" class="list-group d-flex align-items-center">
        <h3 id="orderloader" class='m-5'></h3>
    </div>
</div>
<script>
$(document).on("click", ".viewitem", function() {
    var goTo = $(this).parentsUntil().filter("li").attr("data-item");
    window.location = baseUrl + "/Item/" + goTo;
});

class Orders {
    appendBody = (id, src, name, type, date, price, qty, totalPrice) => {
        var imageSrc = baseUrl + "/products/" + src + ".jpeg";
        return "<li data-item=" + id + " class='p-1 list-group-item list-group-item-action d-flex max500'>" +
            "<div><img class='viewitem m-1 w-100 max150' src=" + imageSrc + "></div>" +
            "<div class='text-left ml-2'>" +
            "<div><b>Product Name: </b><span class='oname text-info'>" + name + "</span></div>" +
            "<div><b>Type: </b><span class='otype text-info'>" + type + "</span></div>" +
            "<div><b>Purchased On: </b><span class='odate text-primary'>" + date + "</span></div>" +
            "<div><b>Price: </b><span class='oprice text-danger'>Rs. " + price + "</span></div>" +
            "<div><b>Qty.: </b><span class='oqty text-danger'>" + qty + "</span></div>" +
            "<hr class='w-100 m-1'>" +
            "<div><b>Total Price: </b><span class='ototal text-success'>Rs. " + totalPrice + "</span></div>" +
            "</div></li>";
    }
    getOrders = () => {
        var url = baseUrl + "/main/cust_auth.php";
        var formData = new FormData();
        formData.append("getorders", true);

        var beforeSend = () => whileAuth("#orderloader", false, defaultSpinner);
        var success = (data) => {
            var newData = JSON.parse(data);
            whileAuth("#orderloader", false, "");
            if (Array.isArray(newData)) {
                console.log(newData);
                $.each(newData, (key, value) => {
                    var date = value.STAMP;
                    date = date.split(" ");
                    var totalPrice = value.SQTY * value.PRICE;
                    var newItem = this.appendBody(value.SITEMID, value.IMAGE, value.NAME, value.TYPE,
                        date[0], value.PRICE, value.SQTY, totalPrice);
                    $("#orderlist").prepend(newItem);
                });
            } else {
                $("#orderloader").html("<span class='text-danger'>No Orders</span>");
            }
        }
        sendAjax(url, "POST", formData, false, false, beforeSend, success);
    }
}

var newOrder = new Orders();
newOrder.getOrders();
</script>