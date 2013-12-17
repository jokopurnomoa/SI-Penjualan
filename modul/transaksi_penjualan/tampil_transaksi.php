<div class="head">
    <div class="info">
        <h1>Tampil Transaksi</h1>
    </div>
        <form method="POST" action="#">
        <div class="search">
            <input type="text" name="cari" id="search" placeholder="Cari"/>
            <input type="text" name="tanggal" class="datepicker" placeholder="Tanggal"/>
            <select class="select2" style="width: 220px;" name="kategori" placeholder="Urutkan Berdasarkan"/>
                <option value="kosong"></option>
                <option value="no_transaksi">No. Transaksi</option>
                <option value="id_user">User</option>
                <option value="tanggal_transaksi">Tanggal</option>
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

            if($result == 'success_h'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil hapus transaksi jual.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_h'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal hapus transaksi jual!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            else if($result == 'success_u'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil ubah transaksi jual.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_u'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal ubah transaksi jual!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <div class="block">
                <div class="head">
                    <h2>Tabel Transaksi Penjualan</h2>
                    <ul class="buttons">
                        <li><a href="#" class="block_loading"><span class="i-cycle"></span></a></li>
                        <li><a href="#" class="block_toggle"><span class="i-arrow-down-3"></span></a></li>
                        <li><a href="#" class="block_remove"><span class="i-cancel-2"></span></a></li>
                    </ul>
                </div>
                <div class="content np table-sorting">

                    <table cellpadding="0" cellspacing="0" width="100%" class="simple_sort">
                        <thead>
                        <tr>
                            <th width="6%">No</th>
                            <th width="10%">No Transaksi</th>
                            <th width="10%">Total</th>
                            <th width="10%">Tanggal Transaksi</th>
                            <th width="15%">ID User</th>
                            <th width="20%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        if(isset($_POST['cari']) && isset($_POST['tanggal'])){
                                $cari = $_POST['cari'];
                                $tanggal = $_POST['tanggal'];
                                $select = mysql_query("SELECT * FROM transaksi_jual WHERE no_transaksi LIKE '%$cari%' ");
                                if(isset($_POST['kategori'])){
                                    $kategori = $_POST['kategori'];
                                    if($kategori == "kosong" ){
                                        $select = mysql_query("SELECT * FROM transaksi_jual WHERE no_transaksi LIKE '%$cari%' ");
                                    }else if($kategori == "tanggal_transaksi" ){
                                        $select = mysql_query("SELECT * FROM transaksi_jual WHERE DATE_FORMAT(`tanggal_transaksi`, '%m/%d/%Y') LIKE '%$tanggal%'");
                                    }
                                    else{
                                        $select = mysql_query("SELECT * FROM transaksi_jual where $kategori LIKE '%$cari%'");
                                    }

                                }
                                while($data = mysql_fetch_array($select)){
                                    echo '<tr>';
                                    echo '<td>'.$i.'</td>';
                                    echo '<td>'.$data[0].'</td>';
                                    echo '<td>Rp. '.$data[2].'</td>';
                                    echo '<td>'.$data[1].'</td>';
                                    echo '<td>'.$data[3].'</td>';
                                    echo '<td>
                                        <a style="cursor: pointer" onclick=hapusTransaksiJual("'.$data[0].'","'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                        <a style="cursor: pointer" href="index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi='.$data[0].'"><img src="img/filetree/application.png">Detail</a>
                                    </td>';
                                    echo '</tr>';
                                    $i++;
                                }
                            }
                            else{

                        $select = mysql_query("SELECT * FROM transaksi_jual");
                        while($data = mysql_fetch_array($select)){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$data[0].'</td>';
                            echo '<td>Rp. '.$data[2].'</td>';
                            echo '<td>'.$data[1].'</td>';
                            echo '<td>'.$data[3].'</td>';
                            echo '<td>
                                <a style="cursor: pointer" onclick=hapusTransaksiJual("'.$data[0].'","'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                <a style="cursor: pointer" href="index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi='.$data[0].'"><img src="img/filetree/application.png">Detail</a>
                            </td>';
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