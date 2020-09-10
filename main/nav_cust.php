<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h3 class="text-light">Welcome, <?php echo $_SESSION['NAME']; ?></h3>
    <a href="/Kato/Account"><i class="fas fa-user"></i> Account</a>
    <a href="/Kato/Cart"><i class="fas fa-cart-arrow-down"></i> Cart</a>
    <a href="/Kato/Orders"><i class="fas fa-shopping-bag"></i> Orders</a>
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
    <div class="col-sm-9 col-12" style="display: contents;">
        <div class="input-group mr-1 ml-1 mb-1 m-sm-auto">
            <div class="input-group-prepend">
                <select id="category" class="btn btn-outline-secondary text-light bg-dark" data-toggle="tooltip"
                    title="Category">
                    <option value="All Categories" selected>All Categories</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Books">Books</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Software">Software</option>
                    <option value="Grocery">Grocery</option>
                </select>
            </div>
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn  logobgcolor text-light" data-toggle="tooltip" title="Search"><i
                        class="fas fa-search"></i></button>
            </div>
        </div>
        <button class="account btn ml-2 mr-1 f20 text-light d-md-block d-none" data-toggle="tooltip" title="Account">
            <span class="d-flex align-items-center"><i class="fas fa-user"></i><span
                    class="f15 ml-2"><?php echo $_SESSION['NAME']; ?></span></span>
        </button>
        <button class="cart btn ml-1 mr-1 f20 text-light d-md-block d-none" data-toggle="tooltip" title="Your Cart">
            <i class="fas fa-cart-arrow-down"></i>
        </button>
        <button class="orders btn ml-1 mr-1 f20 text-light d-md-block d-none" data-toggle="tooltip" title="Your Orders">
            <i class="fas fa-shopping-bag"></i>
        </button>
        <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none logout" data-toggle="tooltip" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
</nav>