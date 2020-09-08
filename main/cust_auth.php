<?php
session_start();
require __DIR__ . "/../functions/mysql_func.php";
$userId = $_SESSION['ID'];
if (isset($_POST["itemadd"])) {
    $item  = $_POST['itemid'];
    $sql = "INSERT INTO cart(CITEM,CUSTOMER) VALUES(?,?)";
    opData($sql, "ii", array($item, $userId));
    echo 1;
} else if (isset($_POST['itembuy'])) {
    $item  = $_POST['itemid'];
    $sql = "SELECT * FROM products WHERE PID=?";
    $productData = getArray($sql, "i", array($item));
    $itemQty = $productData[0]["PQTY"];
    if ($itemQty > 0) {
    } else {
        echo 0;
    }
}