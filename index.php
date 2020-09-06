<?php
session_start();
require_once __DIR__ . "/setup/connection.php";
require_once __DIR__ . "/setup/autoload.php";
$dir = env("FOLDER");
$baseUrl = env("BASE_URL");
$router = $_SERVER['REQUEST_URI'];
$router = str_replace($dir, "", $router);
// echo $router;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/70ccd1e73b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="katologo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="cssandjs/css/index.css">
    <link rel="stylesheet" href="cssandjs/css/nav.css">
</head>
<style>
/* #d1294e */
#logoi {
    background: linear-gradient(45deg, rgba(209, 41, 78, 0.5) 20%, rgb(209 41 78) 40%, rgb(209 41 78) 60%, rgba(209, 41, 78, 0.5) 80%);
    background-size: 200% auto;
    color: #000;
    background-clip: text;
    text-fill-color: transparent;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shine 1s linear infinite;
}

@keyframes shine {
    to {
        background-position: 200% center;
    }
}
</style>

<body>
    <h2 id="logo" class="logocolor p-1"><i class="fas fa-shopping-cart" id="logoi"></i> Kato</h2>
    <input id="baseurl" type="hidden" value=<?php echo $baseUrl; ?>>
    <script src="cssandjs/js/index.js"></script>
    <?php
    if (!isset($_SESSION['USER'])) {
        switch ($router) {
            case "/":
                include(__DIR__ . "/user/login.php");
                break;
            case "/Register":
                include(__DIR__ . "/user/register.php");
                break;
            case "/ResetPassword":
                include(__DIR__ . "/user/forgot_password.php");
                break;
            default:
                include(__DIR__ . "/error/404.php");
                break;
        }
    } else {
        switch ($router) {
            case "/":
                include(__DIR__ . "/main/home.php");
                break;

            default:
                include(__DIR__ . "/error/505.php");
                break;
        }
    }
    ?>
</body>

</html>