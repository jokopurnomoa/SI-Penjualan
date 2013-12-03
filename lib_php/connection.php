<?php
/* Starting Session */
session_start();

$host = "localhost";
$user = "root";
$pass = "root";
$db = "db_tokosunda";

$connect = mysql_connect($host,$user,$pass);
if($connect){
    mysql_select_db($db);
}
?>