<?php

include("../../lib_php/connection.php");

if(isset($_POST['cari'])){
	$cari = $_POST['cari'];
}

$query = mysql_query("SELECT * FROM pemasok WHERE id_pemasok LIKE '%$cari%' OR nama LIKE '%$cari%' OR no_telepon LIKE '%$cari%'");
$result = NULL;


while($hasil = mysql_fetch_array($query)){
	$result[] = $hasil;
}

$res = json_encode($result);
echo $res;

?>