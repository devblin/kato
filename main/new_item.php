<div class="container p-0 mb-5 w-auto mt110">
    <h2 class="logodcolor">New Item</h2>
    <hr class="w-100">
    <div class="row d-flex justify-content-center w-auto m-0">
        <div class="col-sm-7 col-md-5">
            <img id="previewimage" class="w-100 max250 maxh250" style="object-fit: cover;" alt="Default Image"><br>
            <input type="file" id="choosefile" style="display: none;">
            <button id="chooseimage" class="btn btn-primary m-1">Choose Image</button>
            <button id="uploadimage" class="btn btn-warning m-1">Upload</button>
            <button id="cancelimage" class="btn btn-danger m-1">Cancel</button>
        </div>
        <div class="col-sm-5 col-md-7 text-left">
            <form action="">
                <div class="form-group mb-2">
                    <label class="mb-1">Item Name</label>
                    <input id="itemname" type="text" class="form-control" placeholder="Enter Item Name" required>
                </div>
                <div class="form-group mb-2">
                    <label class="mb-1">Category</label>
                    <select id="itemcat" class="form-control">
                        <option value="" selected disabled>Item Type</option>
                        <option value="Books">Books</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Software">Software</option>
                        <option value="Skin Care">Skin Care</option>
                        <option value="Watches">Watches</option>
                        <option value="Grocery">Grocery</option>
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
                    <input id="itemdesc" type="text" class="form-control" placeholder="Enter Description" required>
                </div>
                <button class="btn btn-success w-100 mt-2">Confirm Add</button>
            </form>
        </div>
    </div>
</div>
<script>
let defaultImageUrl = baseUrl + "/defaultproductimage.jpg";
let chooseImage = $("#choosefile");
let previewImage = $("#previewimage");
let imageUrl = previewImage.attr("src", defaultImageUrl);
let chooseImageBtn = $("#chooseimage");
let uploadImageBtn = $("#uploadimage");
let cancelImageBtn = $("#cancelimage");

chooseImageBtn.click(function() {
    chooseImage.click();
});

class imageButton {
    cancelBtn = () => {
        previewImage.attr("src", defaultImageUrl);
        this.hideBtn();
    }
    showBtn = () => {
        chooseImageBtn.hide();
        uploadImageBtn.show();
        cancelImageBtn.show();
    }
    hideBtn = () => {
        chooseImageBtn.show();
        uploadImageBtn.hide();
        cancelImageBtn.hide();
    }
}

let imageRelatedBtn = new imageButton();
imageRelatedBtn.hideBtn();

let showPreview = false;
let validImageTypes = [
    "image/png",
    "image/jpeg",
    "image/jpg",
    "image/jfif",
    "image/gif"
];

function readUrl(input) {
    let newFile = input.files[0];
    let imageType = newFile["type"];
    if ($.inArray(imageType, validImageTypes) >= 0) {
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImage.attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        showPreview = true;
    } else {
        showPreview = false;
        alert("Invalid Image Type");
    }
}

chooseImage.change(function() {
    readUrl(this);
    if (showPreview) {
        imageRelatedBtn.showBtn();
    }
});

cancelImageBtn.click(function() {
    imageRelatedBtn.cancelBtn();
});


uploadImageBtn.click
</script>