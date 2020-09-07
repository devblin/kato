<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h3 class="text-light">Welcome, <?php echo $_SESSION['NAME']; ?></h3>
    <a href="#"><i class="fas fa-user"></i> Account</a>
    <a href="#"><i class="fas fa-warehouse"></i> Inventory</a>
    <a href="#"><i class="fas fa-chart-bar"></i> Sales Statistics</a>
    <a href="#" class="text-danger logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<nav class="navbar navbar-expand-sm bg-dark p-1 row m-0">
    <div class="col-sm-3 col-12" style="display: contents;">
        <button onclick="openNav()" class="btn border border-light ml-1 mr-1">
            <i class="fas fa-sliders-h logocolor"></i>
        </button>
        <a class="navbar-brand text-center" href=<?php echo $homeUrl; ?>>
            <h2 class="logocolor pl-2"><i class="fas fa-shopping-cart" id="logoi"></i> Kato</h2>
        </a>
        <button class="logout btn ml-1 mr-1 f20 text-light d-sm-none d-block" data-toggle="tooltip" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
    <div class="col-sm-9 col-12" style="display: contents;">
        <button class="btn ml-2 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip" title="Account">
            <span class="d-flex align-items-center"><i class="fas fa-user"></i><span
                    class="f15 ml-2"><?php echo $_SESSION['NAME']; ?></span></span>
        </button>
        <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip" title="Inventory">
            <i class="fas fa-warehouse"></i>
        </button>
        <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip" title="Sales Statistics">
            <i class="fas fa-chart-bar"></i>
        </button>
        <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none logout" data-toggle="tooltip" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
</nav>