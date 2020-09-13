<style>
#popupdate {
    height: 100%;
    width: 100%;
    background-color: #000000cc;
    position: absolute;
}
</style>
<div data-toggle='tooltip' title='Double Click to Close' id="popupdate"
    class="d-none flex-column justify-content-center align-items-center">
    <h3 id="uphead" class="logocolor">Update Item:2</h3>
    <hr class="logobgcolor w-100">
    <div class="closepopupdate row d-flex justify-content-center w-100" style="overflow-y: scroll;max-height: 480px;">
        <div class="col-lg-4 col-md-6">
            <img id="upimage" class="w-100 h-100" src="product.png"
                style="object-fit: cover;max-width:350px;max-height:350px"><br>
            <input type="file" class="form-control" id="upchoosefile" style="display: none;">
            <button id="updateimg" class="btn btn-danger m-1 mb-0">Remove</button>
        </div>
        <div class="col-lg-5 col-md-6 text-left">
            <div class="form-group mb-1">
                <label class="text-light">Name</label>
                <input id="upitemname" type="text" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group mb-1">
                <label class="mb-1 text-light">Category</label>
                <select id="upitemcat" class="form-control">
                    <option class="itemcat0" value="" selected disabled>Item Type</option>
                    <option class="itemcat0" value="Books">Books</option>
                    <option class="itemcat0" value="Clothes">Clothes</option>
                    <option class="itemcat0" value="Electronics">Electronics</option>
                    <option class="itemcat0" value="Software">Software</option>
                    <option class="itemcat0" value="Skin Care">Skin Care</option>
                    <option class="itemcat0" value="Watches">Watches</option>
                    <option class="itemcat0" value="Grocery">Grocery</option>
                    <option class="itemcat0" value="Sports">Sports</option>
                    <option class="itemcat0" value="Baggage">Baggage</option>
                </select>
            </div>
            <div class=" form-group mb-1">
                <label class="text-light">Price</label>
                <input id="upitemprice" type="number" min="1" class="form-control" placeholder="Enter Price">
            </div>
            <div class=" form-group mb-1">
                <label class="text-light">Quantity</label>
                <input id="upitemqty" type="number" min="0" class="form-control" placeholder="Enter Quantity">
            </div>
            <div class=" form-group mb-1">
                <label class="text-white">Description</label>
                <textarea id="upitemdesc" class="form-control" rows="3" placeholder="Enter Description"></textarea>
            </div>
            <button id="updateitembtn" class="testbtn w-100 btn btn-warning">Update</button>
        </div>
    </div>
    <!-- <span class='spinner-border logocolor'></span> -->
</div>
<div class="container p-0 mb-3 ml-sm-auto mr-sm-auto ml-1 mr-1 w-auto mt110" style="height: 80vh;">
    <div class="m-0 alert alert-dismissible alert-success fade show" style="z-index:2;">
        <button type="button" class="close">&times;</button>
        <strong class="alert-msg">Your Cart</strong>
    </div>
    <h3 class="logodcolor"><i class="fas fa-warehouse"></i> Inventory</h3>
    <table class="table table-dark table-hover table-responsive-sm mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button class="m-1 btn btn-default" id="inventoryload"></button>
</div>

<script>
$("#popupdate").dblclick(function(e) {
    if (e.target.id == "popupdate" || e.target.classList[0] == "closepopupdate") {
        $("#popupdate").removeClass("d-flex").addClass("d-none");
        console.log("YES");
    }
});

var url = baseUrl + "/main/seller_auth.php";
let tableBody = $("tbody");
let inventLoad = $("#inventoryload");

var alertMsg = new AlertMsg();
alertMsg.hideAlert();
$(document).on("click", ".close", function() {
    alertMsg.hideAlert();
});

function tableRowAppend(id, name, type, price, qty, iClass) {
    var val = "<tr data-toggle='tooltip' title='Double Click to Edit' class=" + iClass + " data-item=" + id + ">" +
        "<td class='p-1'>" + id + "</td>" +
        "<td class='p-1'>" + name + "</td>" +
        "<td class='p-1'>" + type + "</td>" +
        "<td class='sprice p-1'><input value=" + price +
        " type='number' min=0  class='edititemprice  form-control bg-dark border border-0 text-light'></td>" +
        "<td class='sqty p-1'><input value=" + qty +
        " type='number' min=0  class='edititemqty  form-control bg-dark border border-0 text-light'></td>" +
        "<td class='p-1'><button class='btn btn-warning updateitem'>Update</button></td>" +
        "</tr>";
    tableBody.append(val);
}

class getInventory {
    // PNAME=?,PTYPE=?,PPRICE=?,PQTY=?,PDESC=?,PSELLER=?,PIMAGE=?
    constructor(offset, limit) {
        this.offset = offset;
        this.limit = limit;
        this.updateItemArr = [$("#upitemname"), $("#upitemcat"), $("#upitemprice"), $("#upitemqty"), $(
            "#upitemdesc")];
    }
    url = baseUrl + "/main/seller_auth.php";
    getData = () => {
        var data = {
            getinventory: true,
            offset: this.offset,
            limit: this.limit
        };
        var beforeSend = () => whileAuth("#inventoryload", false, defaultSpinner);
        var success = (data) => {
            var gotData = JSON.parse(data);
            whileAuth("#inventoryload", false, "");
            if (Array.isArray(gotData)) {
                $.each(gotData, (key, value) => {
                    this.id = value.PID;
                    this.name = value.PNAME;
                    this.price = value.PPRICE;
                    this.type = value.PTYPE;
                    this.qty = value.PQTY;
                    if (this.qty == 0) {
                        this.iclass = "bg-danger";
                    } else {
                        this.iclass = "m-1";
                    }
                    tableRowAppend(this.id, this.name, this.type, this.price, this.qty, this.iclass);
                });
            } else {
                inventLoad.html("<h3>Empty Inventory</h3>");
            }
            $('[data-toggle="tooltip"]').tooltip();
        }

        sendAjaxNew(this.url, "POST", data, beforeSend, success);
    }
    getIdData = (id) => {
        var formData = new FormData();
        formData.append("getinventid", true);
        formData.append("itemid", id);
        var getBody = $(".closepopupdate").html();
        var beforeSend = () => whileAuth(".closepopupdate", false, defaultSpinnerLogo);
        var success = (data) => {
            whileAuth(".closepopupdate", false, getBody);
            var newData = JSON.parse(data);
            console.log(newData);
            $("#upitemname").val(newData[0].PNAME);
            $("#upitemdesc").val(newData[0].PDESC);
            $("#upitemprice").val(newData[0].PPRICE);
            $("#upitemqty").val(newData[0].PQTY);
            $("#upitemcat").val(newData[0].PTYPE);
            this.imgUrl = baseUrl + "/products/" + newData[0].PIMAGE + ".jpeg";
            $("#upimage").attr("src", this.imgUrl);
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
    updateAll = (id, arr, img) => {
        var formData = new FormData();
        console.log(img.length);
        if (img.length != 13 || typeof img != "string") {
            var file = $("#upchoosefile")[0].files[0];
            formData.append("file", file);
        } else {
            formData.append("sameimage", img);
        }
        formData.append("updateitemdetails", JSON.stringify(arr));
        formData.append("edititem", id);

        var beforeSend = () => whileAuth(".testbtn", true, smallSpinner);
        var success = (data) => {
            whileAuth(".testbtn", false, "Update");
            alertMsg.showAlert("Item Update Successfull", "success");
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
    updateData = (refer, price, qty, updateid) => {
        var formData = new FormData();
        formData.append("priceqtyupdate", true);
        formData.append("updateitemid", updateid);
        formData.append("priceup", price);
        formData.append("qtyup", qty);
        var beforeSend = () => whileAuth(refer, true, smallSpinner);
        var success = (data) => {
            whileAuth(refer, false, "Update");
            if (data == "success") {
                if (qty == 0) {
                    refer.parentsUntil().filter("tr").removeClass("m-1");
                    refer.parentsUntil().filter("tr").addClass("bg-danger");
                } else {
                    refer.parentsUntil().filter("tr").removeClass("bg-danger");
                }
                alertMsg.showAlert("Item ID: " + updateid + " Updated Successfully!!!", "success");
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }

}

var newGetInvent = new getInventory(2, 3);
newGetInvent.getData();
$(document).on("click", ".updateitem", function() {
    this.id = $(this).parentsUntil().filter("tr").attr("data-item");
    this.price = $(this).parent().siblings(".sprice").children().val();
    this.qty = $(this).parent().siblings(".sqty").children().val()

    if (this.price > 0 && this.qty >= 0) {
        newGetInvent.updateData($(this), this.price, this.qty, this.id);
    } else if (this.price <= 0) {
        alertMsg.showAlert("Price cannot be 0", "warning");
    } else {
        alertMsg.showAlert("Quantity cannot be negative", "warning");
    }
});

$(document).on("click", ".testbtn", function() {
    this.defaultUrl = baseUrl + "/defaultproductimage.jpg";
    this.img = $("#upimage").attr("src");
    this.arr = [$("#upitemname").val(), $("#upitemcat").val(), $("#upitemprice").val(), $("#upitemqty").val(),
        $("#upitemdesc").val()
    ]
    this.id = $(".closepopupdate").attr("data-item");
    if (ifEmpty(this.arr, "", null) && this.img != this.defaultUrl) {
        this.img = this.img.replace(baseUrl + "/products/", "");
        this.img = this.img.replace(".jpeg", "");
        console.log(this.img.length);
        newGetInvent.updateAll(this.id, this.arr, this.img);
    } else if (this.img == this.defaultUrl) {
        alertMsg.showAlert("Choose an image", "warning");
    } else {
        alertMsg.showAlert("Some Field(s) Empty", "danger");
    }
});


$(document).on("click", "#updateimg", function() {
    this.defaultUrl = baseUrl + "/defaultproductimage.jpg";
    if ($("#upimage").attr("src") != this.defaultUrl) {
        $("#upimage").val("");
        $("#upimage").attr("src", this.defaultUrl);
        $(this).removeClass("btn-danger").addClass("btn-primary").html("Choose Image");
    } else {
        $("#upchoosefile").click();
    }
});

$(document).on("change", "#upchoosefile", function() {
    console.log("YES");
    readUrl(this, $("#upimage"), $("#upchoosefile"))
    if (showPreview != false) {
        $("#updateimg").removeClass("btn-primary").addClass("btn-danger").html("Remove");
    }
});

$(document).on("dblclick", "tr", function(e) {
    this.value = $(this).attr("data-item");
    $(".closepopupdate").attr("data-item", this.value);
    this.targ = e.target.classList[0];
    if (this.targ == "p-1") {
        $("#popupdate").addClass("d-flex");
        $("#uphead").html("Update: Item-" + this.value);
        newGetInvent.getIdData(this.value);
    }
});
</script>