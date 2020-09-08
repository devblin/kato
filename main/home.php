<?php
echo "<title>Home | Kato</title>";
$homeUrl = $baseUrl;
$role = $_SESSION['ROLE'];
?>
<style>
#logo {
    display: none;
}

html {
    overflow-y: hidden;
}
</style>
<div class="container-fluid text-center p-0">
    <?php
    switch ($role) {
        case "Seller":
            require __DIR__ . "/nav_seller.php";
            break;
        default:
            require __DIR__ . "/nav_cust.php";
            break;
    }
    ?>
    <!-- <div class="container p-0 row m-auto w-auto" style="height: 84vh;overflow-y:auto">
        <div class="col-md-4 bg-light col-sm-6 col-12 p-0">
            <div class="bg-dark m-2 p-2 text-light">
                Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. In
                officia
                nesciunt
                ducimus
                illum
                impedit, nisi
                ab distinctio veniam dicta dolore alias culpa quisquam aliquam, voluptates non sed error, laudantium
                nihil!
            </div>
        </div>
    </div> -->
</div>
<script>
let logoutBtn = $(".logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
</script>