<style>
#weekgraph {
    border-left: 3px solid red;
    border-bottom: 3px solid blue;
    min-height: 100px;
}

.progress {
    background-color: transparent !important;
    border-radius: 0px !important;
}

.progress-bar {
    border-radius: none;
}
</style>
<div class="container p-0 ml-auto mr-auto mb-5 w-auto mt110">
    <h3><i class="fas fa-chart-line"></i> Statistics</h3>
    <h6 class="d-flex m-0" style="width:fit-content">
        <input id="weekselect" type="date" class="form-control p-1 m-1">
        <button id="getgraph" class="btn btn-warning m-1">Graph</button>
    </h6>
    <hr class="w-100 logobgcolor">
    <div id="weekgraph" class="m-2">
    </div>
    <h6><b>Weekly Sales <span id="weekmonth"></span></b></h6>
    <h6 style="width: fit-content;" class="text-left m-2">
        <label>Y:Weeks <span class="f20 font-weight-bolder" style="color: red;">------</span></label><br>

        <label>X:Total <span class="f20 font-weight-bolder" style="color: blue;">------</span></label>
    </h6>
</div>
<script>
class Stats {
    months = ['Januray', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'
    ];
    noData = " <h5 class='text-danger'>No Data</h5>";
    noFuture = " <h5 class='text-warning'>Choose date on/before today's date</h5>";
    url = baseUrl + "/main/seller_auth.php";
    weekGraph = (week, sale, price, qty, profit, per) => {
        var width = 'width:' + sale + "%;";
        var val = "<div class='progress m-1' style='height:30px'>" +
            "<div data-html='true' data-toggle='tooltip' title='" + "<u>Week-" + week + "</u> <br> Qty Sold: " +
            qty + " <br> Amount: " +
            profit +
            " <br> Percentage: " + per + "%" +
            "' class='bg-info text-light progress-bar' style=" + width + ">Week - " + week + "</div></div>";
        $("#weekgraph").append(val);
    }
    getStats = (week, weekdate) => {
        var formData = new FormData();
        var dateSplit = weekdate.split("-");
        var weekMonth = this.months[parseInt(dateSplit[1] - 1)];
        formData.append("weekdate", weekdate);
        formData.append("getweeksales", true);
        console.log(weekMonth);
        var beforeSend = () => whileAuth("#weekgraph", false, defaultSpinner);
        var success = (data) => {

            whileAuth("#week", false, "");
            $("#weekmonth").html(weekMonth);
            $("#weekgraph").html("");

            if (isJsonString(data)) {
                var newData = JSON.parse(data);
                console.log(newData);
            }
            console.log(newData);
            if (data == "future") {
                $("#weekgraph").html(this.noFuture);
            } else if (allZero(newData)) {
                $("#weekgraph").html(this.noData);
            } else {
                var totalPrice = 0;
                var totalSale = 0;
                for (let i = 0; i < newData.length; i++) {
                    totalPrice += newData[i][1];
                    totalSale += newData[i][0];
                }
                for (let j = 0; j < newData.length; j++) {
                    this.per = ((newData[j][1] * 100) / totalPrice).toFixed(2);
                    this.weekGraph(j + 1, this.per, "true", newData[j][0], newData[j]
                        [1], this.per);
                }
            }
            $('[data-toggle="tooltip"]').tooltip();
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var sales = new Stats();
$("#getgraph").click(function() {
    this.weekdate = $("#weekselect").val();
    console.log(this.weekdate);
    if (this.weekdate != "") {
        sales.getStats(1, this.weekdate);
        console.log(this.weekdate);
    } else {
        $("#weekgraph").html("<h5 class='text-danger'>Select a date</h5>");
    }
});
</script>