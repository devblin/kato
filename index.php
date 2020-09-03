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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="shortcut icon" href="katologo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="cssandjs/css/index.css">

</head>

<body>
    <h2 class="logocolor">Kato</h2>
    <input id="baseurl" type="hidden" value=<?php echo $baseUrl; ?>>
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
    }
    ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
let baseUrl = $("#baseurl").val();
</script>

</html>