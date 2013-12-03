<?php
$modul = "dashboard";
$submodul = "dashboard";
if(isset($_GET['modul'])){
    $modul = $_GET['modul'];
}
if(isset($_GET['submodul'])){
    $submodul = $_GET['submodul'];
}
?>
<div id="sidebar">

    <div class="user">
        <div class="pic">
            <img src="img/examples/users/dmitry_m.jpg"/>
        </div>
        <div class="info">
            <div class="name">
                <a href="#">Admin</a>
            </div>
        </div>
    </div>

    <ul class="navigation">
        <li class="<?php if($modul=="dashboard") echo "active"?>">
            <a href="index.php"><img src="img/icons/computer-imac.png"> Dashboard</a>
        </li>
        <?php
        $query = mysql_query("SELECT id_modul,nama_modul,icon FROM modul WHERE publish = 'Y'");
        while($data = mysql_fetch_array($query)){
            $active = "";
            $nama_modul = strtolower(str_replace(" ","_",$data['nama_modul']));
            if($nama_modul == $modul){
                $active = "active open";
            }
            echo '
            <li class="openable '.$active.'">
                <a href=""><img src="'.$data['icon'].'" alt=""> '.$data['nama_modul'].'</a>';
            $val = mysql_query("SELECT nama_submodul,link,nama_modul FROM submodul JOIN modul USING(id_modul) WHERE id_modul = '$data[id_modul]' AND submodul.publish = 'Y' ORDER BY nama_submodul ASC");
                echo '<ul>';
                while($data_inner = mysql_fetch_array($val)){
                    echo '<li><a href="?modul='.$nama_modul.'&'.$data_inner['link'].'">'.$data_inner['nama_submodul'].'</a></li>';
                }
                echo '</ul>';
            echo '</li>';
        }
        ?>
    </ul>

</div>