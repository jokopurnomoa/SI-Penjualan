<?php
include("../../lib_php/connection.php");

$nama_modul_am = "";
$id_modul_am = "";
$id_submodul_am = "";
$nama_submodul_am = "";
$hak_akses_am = "";
$publish_am = "";
$action_am = "";
$link_am = "";
$icon_am = "";
$id_admin_am = "admin";

if(isset($_GET['nama_modul'])){
   $nama_modul_am = $_GET['nama_modul'];
}

if(isset($_GET['id_modul'])){
    $id_modul_am = $_GET['id_modul'];
}

if(isset($_GET['id_submodul'])){
    $id_submodul_am = $_GET['id_submodul'];
}

if(isset($_GET['nama_submodul'])){
    $nama_submodul_am = $_GET['nama_submodul'];
    $link_am = 'submodul='.strtolower(str_replace(" ","_",$nama_submodul_am));
}

if(isset($_GET['hak_akses'])){
   $hak_akses_am = $_GET['hak_akses'];
}

if(isset($_GET['publish'])){
   $publish_am = $_GET['publish'];
}

if(isset($_GET['action'])){
    $action_am = $_GET['action'];
}

if(isset($_GET['icon'])){
    $icon_am = $_GET['icon'];
}

function simpan_modul($nama_modul,$hak_akses,$publish,$id_admin,$icon_am){
    $insert = mysql_query("INSERT INTO modul VALUES(null,'$nama_modul','$hak_akses','$publish','$id_admin','$icon_am')");

    if($insert){
        mkdir("../".strtolower(str_replace(" ","_",$nama_modul)));
        header("location:../../index.php?modul=pengaturan&submodul=tambah_modul&result=success");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=tambah_modul&result=failed");
    }
}

function simpan_submodul($nama_submodul,$link,$hak_akses,$publish,$id_admin,$id_modul){
    $insert = false;
    if($nama_submodul != "")
        $insert = mysql_query("INSERT INTO submodul VALUES(null,'$nama_submodul','$link','$hak_akses','$publish','$id_modul','$id_admin')");
    if($insert){
        $file = fopen("modul_starter.php","r");
        $data = fread($file,100000);
        fclose($file);
        $nama_modul = mysql_fetch_row(mysql_query("SELECT nama_modul FROM modul WHERE id_modul = '$id_modul'"));
        if(!file_exists("../".$nama_modul[0]."/".strtolower(str_replace(' ','_',$nama_submodul)).".php")){
            $file = fopen("../".$nama_modul[0]."/".strtolower(str_replace(' ','_',$nama_submodul)).".php","w");
            fwrite($file,str_replace('(SUBMODUL)',$nama_submodul,$data));
            fclose($file);
        }

        header("location:../../index.php?modul=pengaturan&submodul=tambah_submodul&result=success");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=tambah_submodul&result=failed");
    }
}

function ubah_modul($nama_modul,$hak_akses,$publish,$id_admin,$icon,$id_modul){
    $update = false;
    if($nama_modul != "")
        $update = mysql_query("UPDATE modul SET nama_modul = '$nama_modul', hak_akses = '$hak_akses', publish = '$publish', icon = '$icon' WHERE id_modul = '$id_modul'");
    if($update){
        header("location:../../index.php?modul=pengaturan&submodul=daftar_modul&result=success_u");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=ubah_modul&id_modul=$id_modul&result=failed");
    }
}

function ubah_submodul($nama_submodul,$id_submodul,$hak_akses,$publish,$id_admin){
    $update = false;
    if($nama_submodul != "")
        $update = mysql_query("UPDATE submodul SET nama_submodul = '$nama_submodul', hak_akses = '$hak_akses', publish = '$publish' WHERE id_submodul = '$id_submodul'");
    if($update){
        header("location:../../index.php?modul=pengaturan&submodul=daftar_submodul&result=success_u");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=ubah_submodul&id_submodul=$id_submodul&result=failed");
    }
}

function hapus_modul($id){
    $delete = mysql_query("DELETE FROM modul WHERE id_modul = '$id'");
    if($delete){
        header("location:../../index.php?modul=pengaturan&submodul=daftar_modul&result=success_h");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=daftar_modul&result=failed_h");
    }
}

function hapus_submodul($id){
    $delete = mysql_query("DELETE FROM submodul WHERE id_submodul = '$id'");
    if($delete){
        header("location:../../index.php?modul=pengaturan&submodul=daftar_submodul&result=success_h");
    } else {
        header("location:../../index.php?modul=pengaturan&submodul=daftar_submodul&result=failed_h");
    }
}

if($action_am == "simpan_modul"){
    simpan_modul($nama_modul_am,$hak_akses_am,$publish_am,$id_admin_am,$icon_am);
} else if($action_am == "simpan_submodul"){
    simpan_submodul($nama_submodul_am,$link_am,$hak_akses_am,$publish_am,$id_admin_am,$id_modul_am);
} else if($action_am == "ubah_modul"){
    ubah_modul($nama_modul_am,$hak_akses_am,$publish_am,$id_admin_am,$icon_am,$id_modul_am);
} else if($action_am == "hapus_modul"){
    hapus_modul($id_modul_am);
} else if($action_am == "ubah_submodul"){
    ubah_submodul($nama_submodul_am,$id_submodul_am,$hak_akses_am,$publish_am,$id_admin_am);
} else if($action_am == "hapus_submodul"){
    hapus_submodul($id_submodul_am);
}
?>