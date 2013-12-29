<?php
include("../../lib_php/connection.php");

$id_am = "";
$kode_barang_bekas_am = "";
$no_transaksi_jual_am = "";
$kode_barang_am = "";
$jumlah_am = "";
$action_am = "";
$submodul_am = "";
$id_admin_am = "admin";

if(isset($_GET['kode_barang'])){
   $kode_barang_am = $_GET['kode_barang'];
}

if(isset($_GET['submodul'])){
   $submodul_am = $_GET['submodul'];
}

if(isset($_GET['jumlah'])){
   $jumlah_am = $_GET['jumlah'];
}

if(isset($_GET['no_transaksi'])){
   $no_transaksi_jual_am = $_GET['no_transaksi'];
}

if(isset($_GET['id'])){
   $id_am = $_GET['id'];
}

if(isset($_GET['action'])){
    $action_am = $_GET['action'];
}

if(isset($_GET['kode_barang_bekas'])){
    $kode_barang_bekas_am = $_GET['kode_barang_bekas'];
}

#/////////////////////TAMBAH TRANSAKSI JUAL/////////////////////////
function tambah_transaksi_jual($kode_barang,$jumlah,$id_admin){
    $check = mysql_query("SELECT jumlah FROM barang WHERE kode_barang = '$kode_barang'");
    $data_check = mysql_fetch_array($check);
    if ($data_check[0] < $jumlah) {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed_j");
    }
    else
    {
        $create = mysql_query("CREATE TABLE IF NOT EXISTS $id_admin (
                id INT AUTO_INCREMENT,
                kode_barang VARCHAR(8),
                jumlah_beli INT,
                harga INT,
                PRIMARY KEY (id))
                ENGINE = INNODB");
        $insert = mysql_query("INSERT INTO $id_admin VALUES(null,'$kode_barang',$jumlah,(SELECT harga_jual from barang where kode_barang = '$kode_barang'))");
        $update = mysql_query("UPDATE barang SET jumlah = jumlah - $jumlah where kode_barang = '$kode_barang'");
        if($insert && $update){
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
        } else {
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
        }
    }
}

function simpan_transaksi_jual($id_admin){
    $insert_transaksi = mysql_query("INSERT INTO transaksi_jual VALUES (null,date(now()),0,'$id_admin')");
    $insert_detail = mysql_query("INSERT INTO detail_transaksi_jual (kode_barang,jumlah_beli,harga,no_transaksi) SELECT kode_barang,jumlah_beli,harga,(SELECT MAX(no_transaksi) FROM transaksi_jual) FROM $id_admin");
    $delete = mysql_query("DROP TABLE $id_admin");
    #total
    $total = mysql_query("SELECT SUM(harga * jumlah_beli) FROM detail_transaksi_jual WHERE no_transaksi = (SELECT MAX(no_transaksi) FROM transaksi_jual)");
    $data_total = mysql_fetch_array($total);
    $max = mysql_query("SELECT MAX(no_transaksi) FROM transaksi_jual");
    $data_max = mysql_fetch_array($max);
    $update = mysql_query("UPDATE transaksi_jual SET total = $data_total[0] where no_transaksi = $data_max[0]");
    if($insert_transaksi && $insert_detail && $delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=success");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed");
    }
}

function hapus_tambah_transaksi($id, $jumlah, $kode_barang, $id_admin){
    $delete = mysql_query("DELETE FROM $id_admin WHERE id = '$id'");
    if (mysql_num_rows(mysql_query("SELECT id FROM $id_admin")) == 0) {
        mysql_query("DROP TABLE $id_admin");
    }
    $update = mysql_query("UPDATE barang SET jumlah = jumlah + $jumlah where kode_barang = '$kode_barang'");
    if($delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
    }
}
#/////////////////////AKHIR TAMBAH TRANSAKSI JUAL/////////////////////////

#/////////////////////DETAIL TRANSAKSI JUAL/////////////////////////
function hapus_detail_transaksi_jual($id,$no_transaksi,$jumlah,$kode_barang){
    $delete = mysql_query("DELETE FROM detail_transaksi_jual WHERE id = '$id'");
    $check = mysql_query("SELECT * FROM detail_transaksi_jual where no_transaksi = $no_transaksi");
    $data_check = mysql_fetch_array($check);
    if($data_check == null)
    {
        $update = mysql_query("UPDATE transaksi_jual total = 0 WHERE no_transaksi = $no_transaksi");
    }
    else
    {
        $update = mysql_query("UPDATE transaksi_jual SET
        total = (SELECT SUM(jumlah_beli * harga) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi) WHERE no_transaksi = $no_transaksi");
    }
    $update_barang = mysql_query("UPDATE barang SET jumlah = jumlah + $jumlah where kode_barang = '$kode_barang'");
    if($delete && $update && $update_barang){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=success_h");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=failed_h");
    }
}

function ubah_detail_transaksi_jual($id,$no_transaksi,$kode_barang,$jumlah,$kode_barang_bekas)
{
    $check = mysql_query("SELECT jumlah FROM barang WHERE kode_barang = '$kode_barang'");
    $data_check = mysql_fetch_array($check);
    if ($data_check[0] < $jumlah) {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=ubah_detail_transaksi&result=failed_j&no_transaksi=$no_transaksi&id=$id");
    }
    else
    {
    $update_barang = mysql_query("UPDATE barang SET jumlah= (jumlah + (SELECT jumlah_beli FROM detail_transaksi_jual where id=$id AND no_transaksi=$no_transaksi)) WHERE kode_barang = '$kode_barang_bekas'");
    $update_detail = mysql_query("UPDATE detail_transaksi_jual SET kode_barang = '$kode_barang', jumlah_beli = $jumlah, harga = (SELECT harga_jual FROM barang WHERE kode_barang = '$kode_barang') WHERE id = $id AND no_transaksi = $no_transaksi");
    $update_barang_lagi = mysql_query("UPDATE barang SET jumlah = (jumlah - $jumlah) WHERE kode_barang = '$kode_barang'");
    $update = mysql_query("UPDATE transaksi_jual SET total = (SELECT SUM(jumlah_beli * harga) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi) WHERE no_transaksi = $no_transaksi");
        if($update_barang && $update_detail && $update_barang_lagi && $update){
            header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=success_t");
        } else {
            header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=failed_t");
        }
    }
}

function tambah_detail_transaksi($kode_barang,$jumlah,$no_transaksi, $id_admin){
    $check = mysql_query("SELECT jumlah FROM barang WHERE kode_barang = '$kode_barang'");
    $data_check = mysql_fetch_array($check);
    if ($data_check[0] < $jumlah) {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&result=failed_j&no_transaksi=$no_transaksi");
    }
    else
    {
        $create = mysql_query("CREATE TABLE IF NOT EXISTS $id_admin (
                id INT AUTO_INCREMENT,
                kode_barang VARCHAR(8),
                jumlah_beli INT,
                harga INT,
                PRIMARY KEY (id))
                ENGINE = INNODB");
        $insert = mysql_query("INSERT INTO $id_admin VALUES(null,'$kode_barang',$jumlah,(SELECT harga_jual from barang where kode_barang = '$kode_barang'))");
        $update = mysql_query("UPDATE barang SET jumlah = jumlah - $jumlah where kode_barang = '$kode_barang'");
        if($insert && $update){
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
        } else {
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
        }
    }
}

function simpan_tambah_detail_transaksi($id_admin, $no_transaksi){
    $insert_detail = mysql_query("INSERT INTO detail_transaksi_jual (kode_barang,jumlah_beli,harga,no_transaksi) SELECT kode_barang,jumlah_beli,harga,$no_transaksi FROM $id_admin");
    $delete = mysql_query("DROP TABLE $id_admin");
    #total
    $total = mysql_query("SELECT SUM(harga * jumlah_beli) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi");
    $data_total = mysql_fetch_array($total);
    $update = mysql_query("UPDATE transaksi_jual SET total = $data_total[0] where no_transaksi = $no_transaksi");
    if($insert_detail && $delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&result=success_t&no_transaksi=$no_transaksi");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&result=failed_t&no_transaksi=$no_transaksi");
    }
}

function hapus_tambah_detail_transaksi($id, $jumlah, $kode_barang, $no_transaksi, $id_admin){
    $delete = mysql_query("DELETE FROM $id_admin WHERE id = '$id'");
    if (mysql_num_rows(mysql_query("SELECT id FROM $id_admin")) == 0) {
        mysql_query("DROP TABLE $id_admin");
    }
    $update = mysql_query("UPDATE barang SET jumlah = jumlah + $jumlah where kode_barang = '$kode_barang'");
    if($delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
    }
}
#/////////////////////AKHIR DETAIL TRANSAKSI JUAL/////////////////////////

#/////////////////////HAPUS TAMPIL TRANSAKSI JUAL/////////////////////////
function hapus_transaksi($id){
    $delete = mysql_query("DELETE FROM transaksi_jual WHERE no_transaksi = '$id'");
    if($delete){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tampil_transaksi&result=success_h");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tampil_transaksi&result=failed_h");
    }
}
#/////////////////////AKHIR HAPUS TAMPIL TRANSAKSI JUAL/////////////////////////

if($action_am == "tambah_transaksi_jual"){
    tambah_transaksi_jual($kode_barang_am,$jumlah_am,$id_admin_am);
}else if($action_am == "simpan_transaksi_jual"){
    simpan_transaksi_jual($id_admin_am);
}else if($action_am == "hapus_transaksi"){
    hapus_transaksi($no_transaksi_jual_am);
}else if($action_am == "hapus_detail_transaksi_jual"){
    hapus_detail_transaksi_jual($id_am,$no_transaksi_jual_am,$jumlah_am,$kode_barang_am);
}else if ($action_am == "hapus_tambah_transaksi") {
    hapus_tambah_transaksi($id_am, $jumlah_am, $kode_barang_am, $id_admin_am);
}else if ($action_am == "tambah_detail_transaksi") {
    tambah_detail_transaksi($kode_barang_am,$jumlah_am,$no_transaksi_jual_am,$id_admin_am);
}else if ($action_am == "hapus_tambah_detail_transaksi") {
    hapus_tambah_detail_transaksi($id_am, $jumlah_am, $kode_barang_am, $no_transaksi_jual_am, $id_admin_am);
}else if($action_am == "simpan_tambah_detail_transaksi"){
    simpan_tambah_detail_transaksi($id_admin_am,$no_transaksi_jual_am);
}else if ($action_am == "ubah_detail_transaksi_jual") {
    ubah_detail_transaksi_jual($id_am,$no_transaksi_jual_am,$kode_barang_am,$jumlah_am,$kode_barang_bekas_am);
}
?>