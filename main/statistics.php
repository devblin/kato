<div class="container p-0 ml-auto mr-auto mb-5 w-auto mt110">
    <h3><i class="fas fa-chart-line"></i> Statistics</h3>
    <hr class="w-100 logobgcolor">
    <?php
    date_default_timezone_set("Asia/Kolkata");
    function weekOfMonth($strDate)
    {
        $dateArray = explode("-", $strDate);
        $date = new DateTime();
        $date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
        return floor((date_format($date, 'j') - 1) / 7) + 1;
    }
    // $d = date("Y-m-d");
    // echo date("W", strtotime("2020-09-11 21:53:06"));
    // echo weekOfMonth("2020-09-08");
    // echo weekOfMonth("2020-09-13");
    ?>
    <div id="week" class="mb-2">

    </div>
    <div id="weekgraph" class="mb-2">

        <div class="progress m-1" style="height:30px">
            <div class="progress-bar" style="width:50%;">Current Week</div>
        </div>
    </div>
    <h5><b>Daily Sales</b></h5>
    <hr class="w-100 logobgcolor">
</div>
<script>
class Stats {
    url = baseUrl + "/main/seller_auth.php";
    weekGraph = () => {
        var val = "<div class='progress m-1' style='height:30px'>" +
            "<div class='progress-bar' style='width:10%;'>70%</div></div>";

    }
    getStats = (week) => {
        var formData = new FormData();
        formData.append("weekdata", week);
        formData.append("getweeksales", true);

        var beforeSend = () => whileAuth("#week", false, defaultSpinner);
        var success = (data) => {
            console.log(data);
            // var newData = JSON.parse(data);
            // console.log(newData);
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}

var sales = new Stats();
sales.getStats(1);
</script>