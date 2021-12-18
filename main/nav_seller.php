<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h3 class="text-light sidebarintro">Welcome, <?php echo $_SESSION['NAME']; ?></h3>
    <a href=<?php echo $baseUrl; ?>><i class="fas fa-home"></i> Home</a>
    <a href=<?php echo $baseUrl . "/Account"; ?>><i class="fas fa-user account"></i> Account</a>
    <a href=<?php echo $baseUrl . "/Sales"; ?>><i class="fas fa-scroll"></i> Sales</a>
    <a href=<?php echo $baseUrl . "/Inventory"; ?>><i class="fas fa-warehouse"></i> Inventory</a>
    <a href=<?php echo $baseUrl . "/Statistics"; ?>><i class="fas fa-chart-bar"></i> Sales Statistics</a>
    <a href="#" class="text-danger logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<nav class="navbar navbar-expand-sm bg-dark p-1 row m-0 fixed-top">
    <div class="col-sm-3 col-12" style="display: contents;">
        <button class="opensidebar btn border border-light ml-1 mr-1">
            <i class="opensidebar fas fa-sliders-h logocolor"></i>
        </button>
        <a class="navbar-brand text-center" href=<?php echo $homeUrl; ?>>
            <h2 class="logocolor pl-2"><i class="fas fa-shopping-cart" id="logoi"></i> Kato</h2>
        </a>
        <button class="logout btn ml-1 mr-1 f20 text-light d-sm-none d-block" data-toggle="tooltip" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
    <div class="col-sm-9 col-12 d-flex clearfix" style="position: absolute;width: auto; right:0;">
        <button class="btn ml-2 mr-1 f20 text-light d-sm-block d-none account" data-toggle="tooltip" title="Account">
            <span class="d-flex align-items-center"><i class="fas fa-user"></i><span
                    class="f15 ml-2"><?php echo $_SESSION['NAME']; ?></span></span>
        </button>
        <button id="gotosale" class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip"
            title="Sales">
            <i class="fas fa-scroll"></i>
        </button>
        <button id="inventgo" class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip"
            title="Inventory">
            <i class="fas fa-warehouse"></i>
        </button>
        <button id="gotostats" class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip"
            title="Sales Statistics">
            <i class="fas fa-chart-bar"></i>
        </button>
        <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none logout" data-toggle="tooltip" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
</nav>
<script>
$("#inventgo").click(function() {
    window.location = baseUrl + "/Inventory";
});
$("#gotostats").click(function() {
    window.location = baseUrl + "/Statistics";
});
$("#gotosale").click(function() {
    window.location = baseUrl + "/Sales";
});
</script>