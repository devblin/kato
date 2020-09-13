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
} else if (isset($_POST['iteminfo']) || isset($_POST['getinventid'])) {
    $item = $_POST['itemid'];
    $sql = "SELECT * FROM products WHERE PID=?";
    $data = getArray($sql, "i", array($item));
    $sql0 = "SELECT * FROM users WHERE ID=?";
    $seller = getData($sql0, "i", array($data[0]['PSELLER']), 'NAME');
    $sellerEmail  = getData($sql0, "i", array($data[0]['PSELLER']), 'EMAIL');

    $data[0]['SELLER'] = $seller;
    $data[0]['CONTACT'] = $sellerEmail;
    $data = json_encode($data);
    echo $data;
} else if (isset($_POST['main-getallitems'])) {
    $sql = "SELECT * FROM products WHERE PID!=?";
    $test = -1;
    $data = getArray($sql, "i", array($test));
    $data = json_encode($data);
    echo $data;
} else if (isset($_POST['buyitemid'])) {
    $item = $_POST['buyitemid'];
    $itemqty = intval($_POST['buyitemqty']);
    $sql = "SELECT * FROM products WHERE PID=?";
    $data = getArray($sql, "i", array($item));
    $seller = $data[0]['PSELLER'];
    $buyer = $userId;
    $availQty = intval($data[0]['PQTY'])  - $itemqty;

    if ($data[0]['PQTY'] == 0) {
        echo "over";
    } else if ($availQty >= 0) {
        $sql = "UPDATE products SET PQTY=? WHERE PID=?";
        opData($sql, "ii", array($availQty, $item));

        $sql = "INSERT INTO sales(SITEMID,SBUYER,SSELLER,SQTY) VALUES(?,?,?,?)";
        opData($sql, "iiii", array($item, $buyer, $seller, $itemqty));
        echo "success";
    } else if ($availQty < 0) {
        echo $data[0]['PQTY'];
    }
} else if (isset($_POST['cartitemid'])) {
    $itemid = $_POST['cartitemid'];
    $sql = "SELECT * FROM products WHERE PID=?";
    $data = getArray($sql, "i", array($itemid));
    if ($data[0]['PQTY'] == 0) {
        echo "cantadd";
    } else {
        $arr = array($itemid, $userId);
        $sql = "SELECT * FROM cart WHERE CITEM=? AND CUSTOMER=?";
        $check = checkData($sql, "ii", $arr);
        if ($check == 0) {
            $sql = "INSERT INTO cart(CITEM,CUSTOMER) VALUES(?,?)";
            opData($sql, "ii", $arr);
            echo "added";
        } else {
            $sql = "DELETE FROM cart WHERE CITEM=? AND CUSTOMER=?";
            opData($sql, "ii", $arr);
            echo "removed";
        }
    }
} else if (isset($_POST['checkcartstatus'])) {
    $itemid = $_POST['checkitemid'];
    $sql = "SELECT * FROM cart WHERE CITEM=? AND CUSTOMER=?";
    $check = checkData($sql, "ii", array($itemid, $userId));
    if ($check == 0) {
        echo "notadded";
    } else {
        echo "added";
    }
} else if (isset($_POST['getcartlist'])) {
    $sql = "SELECT * FROM cart WHERE CUSTOMER=?";
    $data = getArray($sql, "i", array($userId));
    if (is_array($data)) {
        for ($i = 0; $i < count($data); $i++) {
            $sql = "SELECT * FROM products WHERE PID=?";
            $data0 = getArray($sql, "i", array($data[$i]['CITEM']));
            $data[$i]['PRICE'] = $data0[0]['PPRICE'];
            $data[$i]['TYPE'] = $data0[0]['PTYPE'];
            $data[$i]['STOCK'] = $data0[0]['PQTY'];
            $data[$i]['NAME']  = $data0[0]['PNAME'];
            $data[$i]['IMAGE'] = $data0[0]['PIMAGE'];
        }
    }
    $data = json_encode($data);
    echo $data;
} else if (isset($_POST['removecart'])) {
    $itemId = $_POST['removecart'];
    $sql = "DELETE FROM cart WHERE CITEM=? AND CUSTOMER=?";
    opData($sql, "ii", array($itemId, $userId));
    echo "removed";
} else if (isset($_POST['getorders'])) {
    $sql = "SELECT * FROM sales WHERE SBUYER=?";
    $data = getArray($sql, "i", array($userId));
    if (is_array($data)) {
        for ($i = 0; $i < count($data); $i++) {
            $getId = $data[$i]['SITEMID'];
            $sql0 = "SELECT * FROM products WHERE PID=?";
            $data0 = getArray($sql0, "i", array($getId));
            $data[$i]['PRICE']  = $data0[0]['PPRICE'];
            $data[$i]['TYPE'] = $data0[0]['PTYPE'];
            $data[$i]['IMAGE'] = $data0[0]['PIMAGE'];
            $data[$i]['NAME'] = $data0[0]['PNAME'];
        }
    }
    $data = json_encode($data);
    echo $data;
} else if (isset($_POST['searchquery'])) {
    $category = $_POST['searchcat'];
    $specific = $_POST['searchspec'];

    if ($category == "All Categories") {
        if ($specific != "") {
            $specific = "%" . $specific . "%";
            $query = "SELECT * FROM products WHERE PNAME LIKE ?";
            $data = getArray($query, "s", array($specific));
        } else {
            $default = -1;
            $query = "SELECT * FROM products WHERE PID!=?";
            $data = getArray($query, "i", array($default));
        }
    } else if ($category != "All Categories" && $specific == "") {
        $query  = "SELECT * FROM products WHERE PTYPE=?";
        $data = getArray($query, "s", array($category));
    } else {
        $query  = "SELECT * FROM products WHERE PNAME LIKE ? AND PTYPE=?";
        $data = getArray($query, "ss", array($specific, $category));
    }
    $data = json_encode($data);
    echo $data;
}