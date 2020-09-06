<?php
echo "<title>Home | Kato</title>";
$homeUrl = $baseUrl;
?>
<style>
#logo {
    display: none;
}
</style>
<div class="container-fluid text-center p-0">
    <!-- <button class="btn btn-danger" id="logout">Logout</button> -->
    <nav class="navbar navbar-expand-sm bg-dark p-1 row m-0">
        <div class="col-sm-3 col-12" style="display: contents;">
            <button class="btn border border-light ml-1 mr-1" data-toggle="tooltip" title="More">
                <i class="fas fa-sliders-h logocolor"></i>
            </button>
            <a class="navbar-brand text-center" href=<?php echo $homeUrl; ?>>
                <h2 class="logocolor pl-2"><i class="fas fa-shopping-cart" id="logoi"></i> Kato</h2>
            </a>
            <button class="btn ml-1 mr-1 f20 text-light d-sm-none d-block" data-toggle="tooltip" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
        <div class="col-sm-9 col-12" style="display: contents;">
            <div class="input-group mr-1 ml-1 mb-1 m-sm-auto">
                <div class="input-group-prepend">
                    <select id="category" class="btn btn-outline-secondary text-light bg-dark" data-toggle="tooltip"
                        title="Category">
                        <option value="All" selected>All</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Mobiles">Mobiles</option>
                        <option value="Laptops">Laptops</option>
                        <option value="Grocery">Grocery</option>
                    </select>
                </div>
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn  logobgcolor text-light" data-toggle="tooltip" title="Search"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
            <button class="btn ml-2 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip" title="Account">
                <i class="fas fa-user"></i>
            </button>
            <button class="btn ml-1 mr-1 f20 text-light d-sm-block d-none" data-toggle="tooltip" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </nav>
</div>
<script>
let logoutBtn = $("#logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
</script>