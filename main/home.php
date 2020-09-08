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
    if ($role == "Seller") {
        require __DIR__ . "/nav_seller.php";
    } else if ($role == "Buyer") {
        require __DIR__ . "/nav_cust.php";
        if ($router == "/") {
            require __DIR__ . "/customer.php";
        } else if (preg_match("/Item\/[a-zA-Z0-9]/i", $router)) {
            require __DIR__ . "/item.php";
        }
    }
    ?>

</div>
<script>
let logoutBtn = $(".logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
</script>