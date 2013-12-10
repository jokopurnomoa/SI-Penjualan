<?php
include("connection.php");

/**
 * Created by JetBrains PhpStorm.
 * User: JOKO PURNOMO A
 * Date: 12/9/13
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */

$username = "";
$password = "";
if(isset($_POST['username'])){
    $username = $_POST['username'];
}

if(isset($_POST['password'])){
    $password = md5($_POST['password']);
}

$iskeeplogin = false;
if(isset($_POST['keeplogin'])){
    $keep = $_POST['keeplogin'];
    if($keep=="on"){
        $iskeeplogin = true;
    }
}

if($username == "" || $password == ""){
    header("location: ../login.php?res=failed");
} else {
    $query = mysql_query("SELECT * FROM user WHERE id_user = '$username' AND password = '$password'");
    $data = mysql_fetch_array($query);
    print_r($data);
    if(strtolower($data['id_user']) == strtolower($username) && $data['password'] == $password){
        $_SESSION['hak_akses'] = $data['hak_akses'];
        $_SESSION['id_user'] = $data['id_user'];
        if($iskeeplogin){
            $_COOKIE['hak_akses'] = $data['hak_akses'];
            $_COOKIE['id_user'] = $data['id_user'];
        }
        header("location: ../");
    } else {
        header("location: ../login.php?res=failed");
    }
}
?>