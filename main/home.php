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
<div class="container-fluid text-center p-0 h-100 main0" style="overflow-y: scroll;">
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
</div>

<script>
let logoutBtn = $(".logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
$(".main0").click(function(e) {
    if (e.target.classList[0] == "opensidebar" || e.target.classList[0] == "sidepanel" || e.target.tagName ==
        "H3") {
        openNav();
    } else if (e.target.classList[0] == "closebtn" != e.target.classList[0] != "opensidebar") {
        closeNav();
    }
});
</script>