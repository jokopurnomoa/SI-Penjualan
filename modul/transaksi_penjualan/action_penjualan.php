<?php
include("../../lib_php/connection.php");

$id_am = "";
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

#/////////////////////TAMBAH TRANSAKSI JUAL/////////////////////////
function tambah_transaksi_jual($kode_barang,$jumlah){
    $check = mysql_query("SELECT jumlah FROM barang WHERE kode_barang = '$kode_barang'");
    $data_check = mysql_fetch_array($check);
    if ($data_check[0] < $jumlah) {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed_j");
    }
    else
    {
        $insert = mysql_query("INSERT INTO temp_transaksi_jual VALUES(null,'$kode_barang',$jumlah,(SELECT harga_jual from barang where kode_barang = '$kode_barang'),0)");
        $update = mysql_query("UPDATE barang SET jumlah = jumlah - $jumlah where kode_barang = '$kode_barang'");
        if($insert && $update){
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
        } else {
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
        }
    }
}

function simpan_transaksi_jual($id_admin){
    $insert_transaksi = mysql_query("INSERT INTO transaksi_jual VALUES (null,date(now()),0,0,0,'$id_admin')");
    $insert_detail = mysql_query("INSERT INTO detail_transaksi_jual (kode_barang,jumlah_beli,harga,diskon,no_transaksi) SELECT kode_barang,jumlah_beli,harga,diskon,(SELECT MAX(no_transaksi) FROM transaksi_jual) FROM temp_transaksi_jual");
    $delete = mysql_query("DELETE FROM temp_transaksi_jual");
    #total_kotor
    $total_kotor = mysql_query("SELECT SUM(harga * jumlah_beli) FROM detail_transaksi_jual where no_transaksi = (SELECT MAX(no_transaksi) FROM transaksi_jual)");
    $data_total_kotor=mysql_fetch_array($total_kotor);
    #diskon_total
    $diskon_total = mysql_query("SELECT SUM(jumlah_beli * (harga * diskon)) FROM detail_transaksi_jual where no_transaksi = (SELECT MAX(no_transaksi) FROM transaksi_jual)");
    $data_diskon_total = mysql_fetch_array($diskon_total);
    #total
    $total = mysql_query("SELECT (SUM(harga * jumlah_beli) + SUM(jumlah_beli * (harga * diskon))) FROM detail_transaksi_jual WHERE no_transaksi = (SELECT MAX(no_transaksi) FROM transaksi_jual)");
    $data_total = mysql_fetch_array($total);
    $max = mysql_query("SELECT MAX(no_transaksi) FROM transaksi_jual");
    $data_max = mysql_fetch_array($max);
    $update = mysql_query("UPDATE transaksi_jual SET total_kotor = $data_total_kotor[0],diskon_total = $data_diskon_total[0], total = $data_total[0] where no_transaksi = $data_max[0]");
    if($insert_transaksi && $insert_detail && $delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=success");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed");
    }
}

function hapus_tambah_transaksi($id, $jumlah, $kode_barang, $submodul){
    $delete = mysql_query("DELETE FROM temp_transaksi_jual WHERE id = '$id'");
    $update = mysql_query("UPDATE barang SET jumlah = jumlah + $jumlah where kode_barang = '$kode_barang'");
    if($delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi");
    }
}
#/////////////////////AKHIR TAMBAH TRANSAKSI JUAL/////////////////////////

#/////////////////////DETAIL TRANSAKSI JUAL/////////////////////////
function hapus_detail_transaksi_jual($id,$no_transaksi){
    $delete = mysql_query("DELETE FROM detail_transaksi_jual WHERE id = '$id'");
    $update = mysql_query("UPDATE transaksi_jual SET total_kotor = 
    (SELECT SUM(jumlah_beli * harga) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi),  
    diskon_total = 
    (SELECT SUM(jumlah_beli * (harga * diskon)) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi),
    total = total_kotor - diskon_total WHERE no_transaksi = $no_transaksi");
    if($delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=success_h");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=failed_h");
    }
}

function tambah_detail_transaksi($kode_barang,$jumlah,$no_transaksi){
    $check = mysql_query("SELECT jumlah FROM barang WHERE kode_barang = '$kode_barang'");
    $data_check = mysql_fetch_array($check);
    if ($data_check[0] < $jumlah) {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed_j");
    }
    else
    {
        $insert = mysql_query("INSERT INTO temp_transaksi_jual VALUES(null,'$kode_barang',$jumlah,(SELECT harga_jual from barang where kode_barang = '$kode_barang'),0)");
        $update = mysql_query("UPDATE barang SET jumlah = jumlah - $jumlah where kode_barang = '$kode_barang'");
        if($insert && $update){
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
        } else {
            header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=$no_transaksi");
        }
    }
}

function simpan_tambah_detail_transaksi($id_admin, $no_transaksi){
    $insert_detail = mysql_query("INSERT INTO detail_transaksi_jual (kode_barang,jumlah_beli,harga,diskon,no_transaksi) SELECT kode_barang,jumlah_beli,harga,diskon,$no_transaksi FROM temp_transaksi_jual");
    $delete = mysql_query("DELETE FROM temp_transaksi_jual");
    #total_kotor
    $total_kotor = mysql_query("SELECT SUM(harga * jumlah_beli) FROM detail_transaksi_jual where no_transaksi = $no_transaksi");
    $data_total_kotor=mysql_fetch_array($total_kotor);
    #diskon_total
    $diskon_total = mysql_query("SELECT SUM(jumlah_beli * (harga * diskon)) FROM detail_transaksi_jual where no_transaksi = $no_transaksi");
    $data_diskon_total = mysql_fetch_array($diskon_total);
    #total
    $total = mysql_query("SELECT (SUM(harga * jumlah_beli) + SUM(jumlah_beli * (harga * diskon))) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi");
    $data_total = mysql_fetch_array($total);
    $update = mysql_query("UPDATE transaksi_jual SET total_kotor = $data_total_kotor[0],diskon_total = $data_diskon_total[0], total = $data_total[0] where no_transaksi = $no_transaksi");
    if($insert_detail && $delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&result=success_t&no_transaksi=$no_transaksi");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&result=failed_t&no_transaksi=$no_transaksi");
    }
}

function hapus_tambah_detail_transaksi($id, $jumlah, $kode_barang, $no_transaksi){
    $delete = mysql_query("DELETE FROM temp_transaksi_jual WHERE id = '$id'");
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
    tambah_transaksi_jual($kode_barang_am,$jumlah_am);
}else if($action_am == "simpan_transaksi_jual"){
    simpan_transaksi_jual($id_admin_am);
}else if($action_am == "hapus_transaksi"){
    hapus_transaksi($no_transaksi_jual_am);
}else if($action_am == "hapus_detail_transaksi_jual"){
    hapus_detail_transaksi_jual($id_am,$no_transaksi_jual_am);
}else if ($action_am == "ubah_detail_transaksi_jual") {
    ubah_detail_transaksi_jual();
}else if ($action_am == "hapus_tambah_transaksi") {
    hapus_tambah_transaksi($id_am, $jumlah_am, $kode_barang_am);
}else if ($action_am == "tambah_detail_transaksi") {
    tambah_detail_transaksi($kode_barang_am,$jumlah_am,$no_transaksi_jual_am);
}else if ($action_am == "hapus_tambah_detail_transaksi") {
    hapus_tambah_detail_transaksi($id_am, $jumlah_am, $kode_barang_am, $no_transaksi_jual_am);
}else if($action_am == "simpan_tambah_detail_transaksi"){
    simpan_tambah_detail_transaksi($id_admin_am,$no_transaksi_jual_am);
}
?>