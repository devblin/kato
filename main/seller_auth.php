<?php
session_start();
require __DIR__ . "/../functions/mysql_func.php";
require __DIR__ . "/../functions/image_func.php";
date_default_timezone_set("Asia/Kolkata");
$currentUsername  = $_SESSION['USER'];
$currentUserId = $_SESSION['ID'];
if (isset($_SESSION['ID'])) {
    if (isset($_POST['getinventory'])) {
        $sql = "SELECT  * FROM products WHERE PSELLER=? ORDER BY PID";
        $data = getArray($sql, "i", array($currentUserId));
        $data = json_encode($data);
        echo $data;
    } else if (isset($_POST['getitemdetails']) || isset($_POST['getinventid'])) {
        $itemId = $_POST['itemid'];
        $sql = "SELECT * FROM products WHERE PID=?";
        $data = getArray($sql, "i", array($itemId));
        $data = json_encode($data);
        echo $data;
    } else if (isset($_POST['priceqtyupdate'])) {
        $price = $_POST['priceup'];
        $qty = $_POST['qtyup'];
        $itemid = $_POST['updateitemid'];
        $sql = "UPDATE products SET PPRICE=?,PQTY=? WHERE PID=?";
        opData($sql, "iii", array($price, $qty, $itemid));
        echo "success";
    } else if (isset($_POST['itemdetails'])) {

        $itemDetails = $_POST['itemdetails'];
        $itemDetails  = json_decode($itemDetails);

        //DETAILES OF IMAGE (SIZE, DIMENSIONS)
        $newImageName = insertImage($_FILES['file']['tmp_name']);

        array_push($itemDetails, $currentUserId, $newImageName);
        //INSERTING NEW ITEM INTO DATABASE

        $sql  = "INSERT INTO products(PNAME,PTYPE,PPRICE,PQTY,PDESC,PSELLER,PIMAGE)
        VALUES(?,?,?,?,?,?,?)";
        opData($sql, "ssiisis", $itemDetails);

        echo is_array($itemDetails);
    } else if (isset($_POST['updateitemdetails'])) {
        $upDetails = $_POST['updateitemdetails'];
        $upDetails  = json_decode($upDetails);
        $itemId = $_POST['edititem'];

        if (isset($_FILES['file']['tmp_name'])) {
            $upImage =  insertImage($_FILES['file']['tmp_name']);
            array_push($upDetails, $upImage, $itemId);
            $sql = "UPDATE products SET PNAME=?,PTYPE=?,PPRICE=?,PQTY=?,PDESC=?,PIMAGE=? WHERE PID=?";
            opData($sql, "ssiissi", $upDetails);
        } else if (isset($_POST['sameimage'])) {
            array_push($upDetails, $itemId);
            $sql = "UPDATE products SET PNAME=?,PTYPE=?,PPRICE=?,PQTY=?,PDESC=? WHERE PID=?";
            opData($sql, "ssiisi", $upDetails);
        }
        echo 1;
    } else if (isset($_POST['getsales'])) {
        $sql = "SELECT * FROM sales WHERE SSELLER=?";
        $data = getArray($sql, "i", array($currentUserId));
        if (is_array($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $sql0 = "SELECT * FROM products WHERE PID=?";
                $data0 = getArray($sql0, "i", array($data[$i]['SITEMID']));
                $sql1 = "SELECT * FROM users WHERE ID=?";
                $data1 = getArray($sql1, "i", array($data[$i]['SBUYER']));
                $data[$i]['NAME'] = $data1[0]['NAME'];
                $data[$i]['EMAIL'] = $data1[0]['EMAIL'];
                $data[$i]['IMAGE'] =  $data0[0]['PIMAGE'];
                $data[$i]['PRICE'] = $data0[0]['PPRICE'];
            }
        }
        $data = json_encode($data);
        echo $data;
    } else if (isset($_POST['getweeksales'])) {
        $sql  = "SELECT * FROM sales WHERE SSELLER=?";
        $data = getArray($sql, "i", array($currentUserId));
        if (is_array($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $dateArr = explode(" ", $data[$i]['STAMP']);
                $date = $dateArr[0];
                $date  = weekOfMonth($date);
                $cDate = date("Y-m-d");
                $cDate = weekOfMonth($cDate);

                $newQty = $data[$i]['SQTY'];
                $sql0 = "SELECT * FROM products WHERE PID=?";
                $newPrice = getData($sql0, "i", array($data[$i]['SITEMID']), "PPRICE");

                $week = $cDate - $date;
                if ($i == 0) {
                    $sendData[$week][0]  = $data[$i]['SQTY'];
                    $sendData[$week][1] = intval($newPrice) * intval($newQty);
                } else {
                    $sendData[$week][0] += $data[$i]['SQTY'];
                    $sendData[$week][1] += intval($newPrice) * intval($newQty);
                }
            }
            $sendData = json_encode($sendData);
            echo $sendData;
        }
    }
}
function weekOfMonth($strDate)
{
    $dateArray = explode("-", $strDate);
    $date = new DateTime();
    $date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
    return floor((date_format($date, 'j') - 1) / 7) + 1;
}