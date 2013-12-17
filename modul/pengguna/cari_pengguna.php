<?php
include("../../lib_php/connection.php");

$cari = "";
if(isset($_POST['cari'])){
    $cari = $_POST['cari'];
}

$select = mysql_query("SELECT * FROM user WHERE id_user LIKE '%$cari%' OR nama LIKE '%$cari%' OR hak_akses LIKE '%$cari%'");
$i = 1;
while($data = mysql_fetch_array($select)){
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$data[0].'</td>';
    echo '<td>'.$data[1].'</td>';
    echo '<td>'.$data[2].'</td>';
    echo '<td>
                                <a style="cursor: pointer" href="index.php?modul=pengguna&submodul=ubah_pengguna&id_user='.$data[0].'"><img src="img/icons/highlighter-color.png">Ubah</a>
                                <a style="cursor: pointer" onclick=hapusPengguna("'.$data[0].'","'.str_replace(' ','_',$data[1]).'")><img src="img/icons/cross-script.png">Hapus</a>
					        </td>';
    echo '</tr>';
    $i++;
}
?>