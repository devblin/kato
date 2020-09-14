<div class="container p-0 ml-auto mr-auto mb-5 w-auto mt110">
    <h3><i class="fas fa-chart-line"></i> Statistics</h3>
    <hr class="w-100 logobgcolor">

    <div id="weekgraph" class="mb-2">
    </div>
    <h5><b>Weekly Sales (September)</b></h5>
    <hr class="w-100 logobgcolor">
</div>
<script>
class Stats {
    url = baseUrl + "/main/seller_auth.php";
    weekGraph = (week, sale, price, qty, profit, per) => {
        var width = 'width:' + sale + "%;";
        var val = "<div class='progress m-1' style='height:30px'>" +
            "<div data-toggle='tooltip' title='" + "Qty Sold: " + qty + " | " + "Amount: " + profit +
            " | Percentage: " + per + "%" +
            "' class='progress-bar' style=" + width + ">Week - " + week + "</div></div>";
        $("#weekgraph").append(val);
    }
    getStats = (week) => {
        var formData = new FormData();
        formData.append("weekdata", week);
        formData.append("getweeksales", true);

        var beforeSend = () => whileAuth("#week", false, defaultSpinner);
        var success = (data) => {
            whileAuth("#week", false, "");
            console.log(data);
            var newData = JSON.parse(data);
            console.log(newData);
            if (Array.isArray(newData)) {
                var totalPrice = 0;
                var totalSale = 0;
                for (let i = 0; i < newData.length; i++) {
                    totalPrice += newData[i][1];
                    totalSale += newData[i][0];
                }
                for (let i = 0; i < newData.length; i++) {
                    this.per = ((newData[i][0] * 100) / totalSale).toFixed(2);
                    this.weekGraph(i + 1, this.per, "true", newData[i][0], newData[i]
                        [1], this.per);
                }
            }
            $('[data-toggle="tooltip"]').tooltip();
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var sales = new Stats();
sales.getStats(1);
</script>