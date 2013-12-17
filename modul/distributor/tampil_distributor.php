<?php

$hak_akses = "super_admin";
if(isset($_SESSION['hak_akses'])){
    
    $hak_akses = $_SESSION['hak_akses'];
}
?>

<div class="head">
    <div class="info">
        <h1>Tampil Distributor</h1>
    </div>
    <form method="POST" action="#">
        <div class="search">
            <input type="text" name="cari" id="search"/>
            <select class="select2" style="width: 220px;" name="kategori" placeholder="Urutkan Berdasarkan">
                <option value="kosong"></option>
                <option value="nama">Nama</option>
                <option value="id_pemasok">Id</option>
                <option value="no_telepon">Kontak</option>
            </select>
            <input type="submit" class="btn btn-primary" value="Cari">
        </div>
    </form>
</div>
<div class="content">
    <div class="row-fluid">
        <!-- Code Here -->
        <div class="span12">
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'success'){
            ?>
            <div class="alert alert-success">
                <strong>Berhasil Mengubah Distributor.</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'failed'){
            ?>
            <div class="alert alert-error">
                <strong>Gagal Mengubah Distributor</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            }
            else if($result == 'failed_h'){
            ?>
            <div class="alert alert-error">
                <strong>Gagal Menghapus Distributor</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'succes_h'){
            ?>
            <div class="alert alert-success">
                <strong>Berhasil Menghapus Distributor</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            }
            ?>
        </div>
            <div class="block">
                <div class="head">
                    <h2>Tabel Daftar Modul</h2>
                    <ul class="buttons">
                        <li><a class="block_loading"><span class="i-cycle" id="refresh" ></span></a></li>
                        <li><a class="block_toggle"><span class="i-arrow-down-3"></span></a></li>
                    </ul>
                </div>
                <div class="content np table-sorting">

                    <table cellpadding="0" cellspacing="0" width="100%" class="simple_sort">
                        <thead>
                        <tr>
                            <th width="6%">No</th>
                            <th width="10%">ID Distributor</th>
                            <th width="20%">Nama Distributor</th>
                            <th width="20%">Kontak Distributor</th>
                            <?php
                            if($hak_akses == "super"){
                                echo '<th width="20%">Aksi</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody id="target">
                        <?php
                            $i = 1;
                            if(isset($_POST['cari'])){
                                $cari = $_POST['cari'];
                                $query = mysql_query("SELECT * FROM pemasok WHERE nama LIKE '%$cari%' ");
                                if(isset($_POST['kategori'])){
                                    $kategori = $_POST['kategori'];
                                    if($kategori == "kosong" ){
                                        $query = mysql_query("SELECT * FROM pemasok WHERE nama LIKE '%$cari%' ");
                                    }
                                    else{
                                        $query = mysql_query("SELECT * FROM pemasok where $kategori LIKE '%$cari%'");
                                    }

                                }
                                while($data = mysql_fetch_array($query)){
                                    echo '<tr>';
                                    echo '<td>'.$i.'</td>';
                                    echo '<td>'.$data[0].'</td>';
                                    echo '<td>'.$data[1].'</td>';
                                    echo '<td>'.$data[2].'</td>';
                                    if($hak_akses == "super"){
                                        echo '<td>
                                        <a style="cursor: pointer" class="Ubah2"><img src="img/icons/highlighter-color.png">Ubah</a>
                                        <a style="cursor: pointer " onclick=hapus("'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                        </td>';
                                    }
                                    echo '</tr>';
                                    $i++;
                                }
                            }
                            else{
                                $select = mysql_query("SELECT * FROM pemasok");
                                while($data = mysql_fetch_array($select)){
                                    echo '<tr>';
                                    echo '<td>'.$i.'</td>';
                                    echo '<td>'.$data[0].'</td>';
                                    echo '<td>'.$data[1].'</td>';
                                    echo '<td>'.$data[2].'</td>';
                                    if($hak_akses == "super"){
                                        echo '<td>
                                        <a style="cursor : pointer" class="Ubah2" ><img src="img/icons/highlighter-color.png">Ubah</a>
                                        <a style="cursor : pointer" onclick=hapus("'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                        </td>';
                                    }
                                    echo '</tr>';
                                    $i++;
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content" id="change" >
    <div class="row-fluid" >
        <!-- Code Here -->
        <form action="modul/distributor/action_distributor.php" method="post" name="fUbah" onsubmit="return ubah_validator()" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Form Ubah Distributor</h2>
                    <ul class="buttons">
                        <li><a class="block_toggle"><span class="i-arrow-down-3"></span></a></li>
                    </ul>
                </div>
                <div class="content np">
                    <input type="hidden" name="action" value="ubah_distributor">
                    <div class="controls-row">
                        <div class="span3">Kode distributor</div>
                        <div class="span9"><input type="text"  id="kode" name="kode_distributor" readonly/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Nama distributor</div>
                        <div class="span9"><input type="text" id="nama" name="nama_distributor"/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Kontak</div>
                        <div class="span9">
                            <input type="text" id="kontak" name="kontak_distributor"/>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="side fr">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </div>
            </form>
    </div>
</div>
