<?php

include("../../lib_php/connection.php");

$cek = "kosong";
if(isset($_POST['kode'])){
	$kode = $_POST['kode'];
}

$query = mysql_query("SELECT * FROM pemasok WHERE id_pemasok = '$kode' ");

while($hasil = mysql_fetch_array($query)){
	$cek = "ada";
}

echo $cek;

?>