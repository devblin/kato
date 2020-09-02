<div class="container p-0 mb-3 w-auto " style="margin-top: 82px;">
    <h3 class="logodcolor itemname0">New Item</h3>
    <hr class="w-100">
    <div class="row d-flex justify-content-center w-auto m-0">
        <div class="alert alert-dismissible fade show" style="position: absolute;z-index:5;">
            <button type="button" class="close">&times;</button>
            <strong class="alert-msg"></strong>
        </div>
        <div class="col-sm-6 col-lg-4">
            <img id="previewimage" class="w-100 max250 maxh250" style="object-fit:cover;height:100%"
                alt="Default Image"><br>
            <input type="file" class="form-control" id="choosefile" style="display: none;">
            <button id="chooseimage" class="btn btn-primary m-1">Choose Image</button>
            <button id="cancelimage" class="btn btn-danger m-1">Remove</button>
        </div>
        <div class="col-sm-6 col-lg-6 text-left">
            <div class="form-group mb-2">
                <label class="mb-1"> Item Name</label>
                <input id="itemname" type="text" class="form-control" placeholder="Enter Item Name" required>
            </div>
            <div class="form-group mb-2">
                <label class="mb-1">Category</label>
                <select id="itemcat" class="form-control">
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
                    <option class="itemcat0" value="Baggage">Baggage</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <div>
                    <label class="mb-1">Price (in Rs.)</label>
                    <input id="itemprice" type="number" class="form-control" placeholder="Enter Price (in Rs.)"
                        required>
                </div>
            </div>
            <div class="form-group mb-2">
                <label class="mb-1">Quantity</label>
                <input id="itemqty" type="number" class="form-control" placeholder="Enter Quantity" required>
            </div>
            <div class="form-group mb-2">
                <label class="mb-1">Description</label>
                <textarea id="itemdesc" class="form-control" placeholder="Enter Description" rows="3"></textarea>
            </div>
            <button id="confirmadd" class="btn btn-success w-100 mt-2 p-3">Confirm Add</button>
        </div>

    </div>
</div>

<script>
var alertMsg = new AlertMsg();
alertMsg.hideAlert();
$(".close").on("click", function() {
    alertMsg.hideAlert();
});

var url = baseUrl + "/main/seller_auth.php";
let defaultImageUrl = baseUrl + "/static/images/defaultproductimage.jpg";
let chooseImage = $("#choosefile");
let previewImage = $("#previewimage");
let imageUrl = previewImage.attr("src", defaultImageUrl);
let chooseImageBtn = $("#chooseimage");
let cancelImageBtn = $("#cancelimage");
let confirmAddBtn = $("#confirmadd");

chooseImageBtn.click(function() {
    chooseImage.click();
});

class imageButton {
    cancelBtn = () => {
        previewImage.attr("src", defaultImageUrl);
        previewImage.val("");
        this.hideBtn();
    }
    showBtn = () => {
        chooseImageBtn.hide();
        cancelImageBtn.show();
    }
    hideBtn = () => {
        chooseImageBtn.show();
        cancelImageBtn.hide();
    }
}

//CLASS FOR ADDING NEW ITEMS INCLUDING UPLOADING
class addNewItem {
    itemarr = [$("#itemname").val(), $("#itemcat").val(), $("#itemprice").val(), $("#itemqty").val(), $("#itemdesc")
        .val()
    ];
    clearAll = function() {
        $(".form-control").each(function() {
            $(this).val("");
        });
    }
    upload = () => {
        var formDatapost = new FormData();
        var file = $("#choosefile")[0].files[0];
        formDatapost.append("file", file);
        formDatapost.append("itemdetails", JSON.stringify(this.itemarr));

        var beforeSend = () => whileAuth("#confirmadd", true, defaultSpinner);

        var success = (data) => {
            whileAuth("#confirmadd", false, "Confirm Add");
            console.log(data);
            if (data == 1) {
                alertMsg.showAlert("Item Added Successfully", "success");
                console.log("%c SUCCESSFULLY ADDED ITEMS", successConsole);
                var newImageBtn = new imageButton();
                $(".itemname0").html("Item Name");
                newImageBtn.cancelBtn();
                this.clearAll();
            } else {
                console.log("%c ERROR", errorConsole);
            }
        }
        sendAjax(url, "POST", formDatapost, false, false, beforeSend, success);
    }
}

let imageRelatedBtn = new imageButton();
imageRelatedBtn.hideBtn();

chooseImage.change(function() {
    readUrl(this, previewImage, chooseImage);
    if (showPreview) {
        imageRelatedBtn.showBtn();
    }
});

cancelImageBtn.click(function() {
    imageRelatedBtn.cancelBtn();
});

$("#itemname").on("input", function(e) {
    if ($(this).val() != "") {
        $(".itemname0").html($(this).val());
    } else {
        $(".itemname0").html("Item Name");
    }
});

confirmAddBtn.click(function(e) {
    var newItem = new addNewItem();

    if (ifEmpty(newItem.itemarr, "", null) && $("#itemqty").val() > 0) {
        if (previewImage.attr("src") != defaultImageUrl) {
            newItem.upload();
        } else {
            alertMsg.showAlert("Kindly, provide an item image", "danger");
        }
    } else if ($("#itemqty").val() <= 0 || $("#itemprice").val() <= 0) {
        alertMsg.showAlert("Price/Qty should be more than 0", "warning");
    } else {
        alertMsg.showAlert("Fill the details, Please !!!", "danger");
    }
});
</script>