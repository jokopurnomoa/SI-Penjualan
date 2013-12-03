<?php
include("../../lib_php/connection.php");
/**
 * Created by JetBrains PhpStorm.
 * User: JOKO PURNOMO A
 * Date: 12/3/13
 * Time: 4:08 PM
 * To change this template use File | Settings | File Templates.
 */
$action = "";
$id_user = "";
$nama_user = "";
$password = "";
$hak_akses = "";

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if(isset($_GET['id_user'])){
    $id_user = $_GET['id_user'];
}

if(isset($_GET['nama_user'])){
    $nama_user = $_GET['nama_user'];
}

if(isset($_GET['password'])){
    $password = $_GET['password'];
}

if(isset($_GET['hak_akses'])){
    $hak_akses = $_GET['hak_akses'];
}

function tambah_user($id_user, $nama_user, $password, $hak_akses){
    if($id_user == "" || $nama_user == "" || $password == "" || $hak_akses == ""){
        header("location:../../index.php?modul=pengguna&submodul=tambah_pengguna&result=failed_h");
        return;
    }
    $insert = mysql_query("INSERT INTO user VALUES('$id_user','$nama_user','$hak_akses',md5('$password'))");
    if($insert){
        header("location:../../index.php?modul=pengguna&submodul=tambah_pengguna&result=success_h");
    } else {
        header("location:../../index.php?modul=pengguna&submodul=tambah_pengguna&result=failed_h");
    }
}

function hapus_user($id_user){
    $delete = mysql_query("DELETE FROM user WHERE id_user = '$id_user'");
    if($delete){
        header("location:../../index.php?modul=pengguna&submodul=tampil_pengguna&result=success_h");
    } else {
        header("location:../../index.php?modul=pengguna&submodul=tampil_pengguna&result=failed_h");
    }
}

if($action == "tambah_user"){
    tambah_user($id_user,$nama_user,$password,$hak_akses);
} else if($action == "hapus_user"){
    hapus_user($id_user);
}
?>