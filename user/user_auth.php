<?php
require __DIR__ . "/../setup/connection.php";
require __DIR__ . "/../functions/mysql_func.php";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pwd = $_POST['userpwd'];
    $sql = "SELECT * FROM users WHERE USERNAME=?";
    $data = getArray($sql, "s", array($user));
    if (is_array($data)) {
        if (password_verify($pwd, $data[0]['PASSWORD'])) {
            session_start();
            $_SESSION['ID']  = $data[0]['ID'];
            $_SESSION['USER'] = $data[0]['USERNAME'];
            $_SESSION['NAME'] = $data[0]['NAME'];
            $_SESSION['EMAIL'] = $data[0]['EMAIL'];
            $_SESSION['ROLE'] = $data[0]['ROLE'];
            echo 1;
        } else {
            echo 2;
        }
    } else {
        echo 0;
    }
} else if (isset($_POST['register'])) {
    $fullname = strtolower($_POST['newfname']) . " " . strtolower($_POST['newlname']);
    $fullname = ucwords($fullname);
    $email = $_POST['newemail'];
    $username = $_POST['newuname'];
    $password = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
    $role = $_POST['newrole'];
    $sql = "SELECT * FROM users WHERE USERNAME=? AND EMAIL=?";
    $check = checkData($sql, "ss", array($username, $email));
    if ($check == 0) {
        $sql = "INSERT INTO users(NAME,USERNAME,ROLE,EMAIL,PASSWORD) VALUES(?,?,?,?,?)";
        opData($sql, "sssss", array($fullname, $username, $role, $email, $password));
        echo 1;
    } else {
        echo 0;
    }
} else if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $valid = $_POST['valid'];
    $sql = "SELECT * FROM users WHERE $type=?";
    $check  = checkData($sql, "s", array($valid));
    echo $check;
}