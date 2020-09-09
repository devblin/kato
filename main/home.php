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
<div class="container-fluid text-center p-0 h-100" style="overflow-y: scroll;">
    <?php
    if ($role == "Seller") {
        require __DIR__ . "/nav_seller.php";

        if ($router == "/") {
            require __DIR__ . "/seller.php";
        } else if ($router == "/Inventory") {
            require __DIR__ . "/inventory.php";
        } else if ($router == "/NewItem") {
            require __DIR__ . "/new_item.php";
        } else if ($router == "/Sales") {
            require __DIR__ . "/sales.php";
        } else if ($router == "/Statistics") {
            require __DIR__ . "/statistics.php";
        }
    } else if ($role == "Buyer") {
        require __DIR__ . "/nav_cust.php";

        if ($router == "/") {
            require __DIR__ . "/customer.php";
        } else if (preg_match("/Item\/[a-zA-Z0-9]/i", $router)) {
            require __DIR__ . "/item.php";
        }
    }
    ?>
    <footer class="bg-dark p-4 text-light">
        <p>&copy; devblin | Deepanshu Dhruw</p>
        <p>&reg; Kato&trade;</p>
        <p><a href="#"><i class="fab fa-linkedin-in m-1"></i></a> <a href="#"><i class="m-1 fab fa-github"></i></a> <a
                href="#"><i class="m-1 fas fa-meteor"></i></a>
        </p>
    </footer>
</div>

<script>
let logoutBtn = $(".logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
</script>