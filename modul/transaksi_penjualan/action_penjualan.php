<?php
include("../../lib_php/connection.php");

$id_am = "";
$no_transaksi_jual_am = "";
$kode_barang_am = "";
$jumlah_am = "";
$harga_am = "";
$diskon_am = 0;
$diskon_total_am= 0;
$action_am = "";
$id_admin_am = "admin";

if(isset($_GET['kode_barang'])){
   $kode_barang_am = $_GET['kode_barang'];
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

$select = mysql_query("SELECT harga_jual FROM barang WHERE kode_barang = '$kode_barang_am'");
$data = mysql_fetch_array($select);
$harga_am = $data['harga_jual'];


$total_kotor_am = $harga_am * $jumlah_am;
$total_am = $total_kotor_am - $diskon_total_am;

function simpan_transaksi_jual($total_kotor,$diskon_total,$total,$id_admin,$kode_barang,$jumlah,$harga,$diskon){
    $insert = mysql_query("INSERT INTO transaksi_jual VALUES(null,date(now()),$total_kotor,$diskon_total,$total,'$id_admin')");
    $insert_detail = mysql_query("INSERT INTO detail_transaksi_jual VALUES(null,'1','$kode_barang',$jumlah,$harga,$diskon_total)");
    if($insert && $insert_detail){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=success");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&result=failed");
    }
}

function hapus_detail_transaksi_jual($id,$no_transaksi){
    $delete = mysql_query("DELETE FROM detail_transaksi_jual WHERE id = '$id'");
    $update = mysql_query("UPDATE transaksi_jual SET total_kotor = 
    (SELECT SUM(jumlah_beli * harga) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi),  
    diskon_total = 
    (SELECT SUM(jumlah_beli * (harga * diskon)) FROM detail_transaksi_jual WHERE no_transaksi = $no_transaksi),
    total = total_kotor - diskon_total");
    if($delete && $update){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=success_h");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi=$no_transaksi&result=failed_h");
    }
}

function hapus_transaksi($id){
    $delete = mysql_query("DELETE FROM transaksi_jual WHERE no_transaksi = '$id'");
    if($delete){
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tampil_transaksi&result=success_h");
    } else {
        header("location:../../index.php?modul=transaksi_penjualan&submodul=tampil_transaksi&result=failed_h");
    }
}

function ubah_transaksi_jual(){

}

if($action_am == "simpan_transaksi_jual"){
    simpan_transaksi_jual($total_kotor_am,$diskon_total_am,$total_am,$id_admin_am,$kode_barang_am,$jumlah_am,$harga_am,$diskon_am);
}else if($action_am == "hapus_transaksi"){
    hapus_transaksi($no_transaksi_jual_am);
}else if ($action_am == "ubah_transaksi_jual") {
    ubah_transaksi_jual();
}else if($action_am == "hapus_detail_transaksi_jual"){
    hapus_detail_transaksi_jual($id_am,$no_transaksi_jual_am);
}else if ($action_am == "ubah_detail_transaksi_jual") {
    ubah_detail_transaksi_jual();
}
?>