<?php
$arr = explode("/", $router);
print_r($arr);
$category = "";
$specific = "";
if (count($arr) > 2) {
    $category = $arr[2];
    $specific = $arr[3];
}
?>
<style>
@media only screen and (max-width:519px) {
    .mc200 {
        max-width: 200px;
    }
}
</style>
<input id="catvalue" type="hidden" value=<?php echo $category; ?>>
<input id="specvalue" type="hidden" value=<?php echo $specific; ?>>
<div id="itemlists" class="container p-0 row ml-auto mr-auto mb-5 w-auto d-flex justify-content-center mt110">
    <h3 id="main-itemloader"></h3>
</div>
<script>
class MainContent {
    url = baseUrl + "/main/cust_auth.php";
    appendEmpty = () => {
        return "<h2 class='m-5'><br><i class='fas fa-exclamation-triangle text-warning f70'></i><br><br>No Products to display</h2>";
    }
    appendBody = (id, src, name, price, qty) => {
        var imageSrc = baseUrl + "/products/" + src + ".jpeg";
        var stock = "In Stock : " + qty;
        var stockClass = "badge-success";
        if (qty == 0) {
            stock = "Out of Stock";
            stockClass = "badge-danger";
        }
        return "<div class='bg-light col-auto  p-0 max250 mc200'>" +
            "<div data-item=" + id + " class='bg-dark m-2 p-2 text-light'>" +
            " <img class='itemimg' src=" + imageSrc + " alt='Product'>" +
            " <span class='itemname' class='f20'>" + name + "</span>" +
            " <div>" +
            " <span class='itemprice badge badge-warning f15 m-1'>Rs " + price + "</span>" +
            "<span class='itemstock badge " + stockClass + " f15 m-1'>" + stock + "</span>" +
            " </div>" +
            " </div>" +
            "</div>";
    }
    getData = (category, specific) => {
        var formData = new FormData();
        if (category != "" || specific != "") {
            formData.append("searchquery", true);
            formData.append("searchcat", category);
            formData.append("searchspec", specific);
        } else {
            formData.append("main-getallitems", true);
        }
        var beforeSend = () => whileAuth("main-itemloader", false, defaultSpinner + " Please Wait...");
        var success = (data) => {
            ////////////////////////
            console.log(data);
            var newData = JSON.parse(data);
            console.log(newData == null);
            whileAuth("main-itemloader", false, "");

            $.each(newData, (key, value) => {
                this.id = value.PID;
                this.name = value.PNAME;
                this.price = value.PPRICE;
                this.stock = value.PQTY;
                this.src = value.PIMAGE;
                var toPrepend = this.appendBody(this.id, this.src, this.name, this.price, this.stock);
                $("#itemlists").prepend(toPrepend);
            });
            //////////////////////////////
            if ((category != "" || specific != "") && newData != null) {
                $("#itemlists").prepend("<h5 class='col-12'>Search results for " + category + ", " + specific +
                    "</h5>");
            } else if ((category == "" && specific == "") && newData != null) {
                $("#itemlists").prepend("");
            } else {
                $("#itemlists").prepend("<h5 class='col-12'>No results for " + category + ", " + specific +
                    "</h5>");
            }
            /////////////////////////////////
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var newItemList = new MainContent();

$(document).ready(function() {
    var catVal = $("#catvalue").val();
    catVal = catVal.replace("%20", " ");
    var specVal = $("#specvalue").val();
    specVal = specVal.replace("%20", " ");

    newItemList.getData(catVal, specVal);

    console.log(catVal);
    console.log(specVal);
});

$(document).on("click", ".itemimg", function() {
    let val = $(this).parent().attr("data-item");
    window.location.href = baseUrl + "/Item/" + val;
});
</script>