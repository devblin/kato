<?php
session_start();
require __DIR__ . "/../functions/mysql_func.php";

if ($_COOKIE['katouser'] == $_SESSION['USER']) {
    setcookie("katouser",  "", time() - 3600, "/");
    setcookie("katopassword", "", time() - 3600, "/");
}

$baseurl = env("BASE_URL");
session_unset();
session_destroy();
header("Location: " . $baseurl);