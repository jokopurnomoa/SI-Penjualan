<?php
function show_modul($modul, $submodul){
    if(file_exists("modul/".$modul."/".$submodul.".php")){
        include("modul/".$modul."/".$submodul.".php");
    } else {
        echo "<br><b style='color: #dd1144;margin-left: 10px'> Modul Tidak Ditemukan!</b>";
    }
}
?>