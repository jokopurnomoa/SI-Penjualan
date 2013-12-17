<?php
include("../../lib_php/connection.php");

$nama_distributor = "";
$kontak_distributor = "";
$kode_distributor = "";
$action = "";

if(isset($_POST["kode_distributor"])){
	$kode_distributor = $_POST['kode_distributor'];
}

if(isset($_POST["nama_distributor"])){
	$nama_distributor = $_POST["nama_distributor"];
}

if(isset($_POST["kontak_distributor"])){
	$kontak_distributor = $_POST["kontak_distributor"];	
}

if(isset($_POST["action"])){
	$action = $_POST["action"];	
}

function hapus_distributor($kode_distributor){

	$hapus = mysql_query("DELETE FROM pemasok WHERE id_pemasok = '$kode_distributor'");

	if($hapus){
		print("berhasil");
	}
	else{
		print("gagal");
	}
}

function ubah_distributor($kode_distributor,$nama_distributor,$kontak_distributor,$id_pemasok)
{
    $query=false;  
    $query=mysql_query("UPDATE pemasok SET nama = '$nama_distributor', no_telepon = '$kontak_distributor' WHERE id_pemasok = '$kode_distributor' ");
    if($query){
        header("location:../../index.php?modul=distributor&submodul=tampil_distributor&result=success");
	} 
	else{
        header("location:../../index.php?modul=distributor&submodul=tampil_distributor&result=failed"); 
    } 
}

function tambah_distributor($kode_distributor,$nama_distributor,$kontak_distributor)
{
	$quer = false;
	if($kontak_distributor != "" && $nama_distributor != "" && $kode_distributor != ""){
		$query = mysql_query("INSERT INTO pemasok VALUES ('$kode_distributor','$nama_distributor','$kontak_distributor')");
	}
	if($query){
		header("location:../../index.php?modul=distributor&submodul=tambah_distributor&result=succes");
	}
	else{
		header("location:../../index.php?modul=distributor&submodul=tambah_distributor&result=failed");
	}
}

if($action == "tambah_distributor")
{
	tambah_distributor($kode_distributor,$nama_distributor,$kontak_distributor);
}
else if($action == "ubah_distributor"){
	ubah_distributor($kode_distributor,$nama_distributor,$kontak_distributor);
}
else if($action == "hapus_distributor"){
	hapus_distributor($kode_distributor);
}
?>