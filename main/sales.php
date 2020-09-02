<div class="container p-0 ml-auto mr-auto mb-5 w-auto mt110">
    <h3><i class="fas fa-dollar-sign"></i> Sales</h3>
    <hr class="w-100">
    <ul id="salesdetails" class="d-flex align-items-center list-group">
    </ul>
</div>
<script>
var defSpinner = "<span class='spinner-border' style='margin-top:20%;'></span>";

class Sales {
    constructor() {
        this.url = baseUrl + "/main/seller_auth.php";
        this.noSales = "<h3 style='margin-top:20%' class='text-danger'><i class='fas fa-exclamation-triangle'></i>No Sales</h3>";
    }
    rowAppend = (src, name, email, qty, price, date) => {
        var imgSrc = baseUrl + "/products/" + src + ".jpeg";
        var val = "<li class='d-flex list-group-item list-group-item-action p-1 max500'>" +
            " <div><img src=" + imgSrc + " style='max-width: 100px;object-fit:cover;'><br>" +
            "<b>Item Bought</b> </div>" +
            "<ul class='ml-2 w-100 list-group text-right'>" +
            "<li class='list-group-item p-1'>" +
            " <span><b class='text-dark'>Name : </b><b class='text-primary'>" + name + "</b></span></li>" +
            " <li class='list-group-item p-1'>" +
            "<span><b class='text-dark'>E-Mail : </b><b class='text-primary'>" + email + "</b></span></li>" +
            " <li class='list-group-item p-1'>" +
            "<span><b class='text-dark'>Date-Time : </b><b class='text-primary'>" + date + "</b></span></li>" +
            "<li class='list-group-item p-1'>" +
            " <span><b class='text-dark'>Qty : </b><b class='text-danger'>" + qty + "</b></span></li>" +
            "<li class='list-group-item p-1'>" +
            "<span><b class='text-dark'>Amount : </b><b class='text-success'>" + price + "</b></span>" +
            "</li></ul></li>";
        $("#salesdetails").append(val);
    }
    getSalesData = () => {
        var formData = new FormData();
        formData.append("getsales", true);
        var beforeSend = () => whileAuth("#salesdetails", false, defSpinner);
        var success = (data) => {
            var newData = JSON.parse(data);
            whileAuth("#salesdetails", false, "");
            if (Array.isArray(newData)) {
                $.each(newData, (key, value) => {
                    var total = value.PRICE * value.SQTY;
                    this.rowAppend(value.IMAGE, value.NAME, value.EMAIL, value.SQTY, total, value
                        .STAMP);
                });
            } else {
                $("#salesdetails").append(this.noSales);
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var newSales = new Sales();
newSales.getSalesData();
</script>