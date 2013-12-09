<div class="head">
    <div class="info">
        <h1>Tambah Transaksi</h1>
    </div>

    <div class="search">
        <form action="#" method="post">
            <input type="text" placeholder="search..."/>
            <button type="submit"><span class="i-calendar"></span></button>
            <button type="submit"><span class="i-magnifier"></span></button>
        </form>
    </div>
</div>
<div class="content">
    <div class="row-fluid">
        <!-- Code Here -->
<div class="span8">
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'success'){
            ?>
            <div class="alert alert-success">
                <strong>Berhasil tambah transaksi penjualan.</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'failed'){
            ?>
            <div class="alert alert-error">
                <strong>Gagal tambah transaksi penjualan !</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'failed_j'){
            ?>
            <div class="alert alert-error">
                <strong>Barang tidak cukup !</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            }
            ?>

            <form action="modul/transaksi_penjualan/action_penjualan.php" method="get" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Form Tambah Transaksi Penjualan</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="action" value="tambah_transaksi_jual">
                    
                    <div class="controls-row">
                        <div class="span3">Barang</div>
                        <div class="span9">
                            <select class="select2" style="width: 220px;" name="kode_barang">
                                <?php
                                $query = mysql_query("SELECT kode_barang,nama_barang FROM barang");
                                while($data = mysql_fetch_array($query)){
                                    echo '<option value="'.$data['kode_barang'].'">'.$data['nama_barang'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Jumlah</div>
                        <div class="span9"><input type="text" name="jumlah" placeholder="Jumlah Beli"/></div>
                    </div>
                </div>
                <div class="footer">
                    <div class="side fr">
                        <input type="submit" class="btn btn-primary" value="Tambah">
                    </div>
                </div>
            </div>
            </form>
            <form action="modul/transaksi_penjualan/action_penjualan.php" method="get" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Tabel Detail Transaksi Penjualan</h2>
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
                            <th width="15%">Barang</th>
                            <th width="10%">Tanggal Transaksi</th>
                            <th width="10%">Jumlah</th>
                            <th width="10%">Harga</th>
                            <th width="10%">Diskon</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no_transaksi_am = "";
                        if(isset($_GET['no_transaksi'])){
                            $no_transaksi_am = $_GET['no_transaksi'];
                        }

                        $select = mysql_query("SELECT transaksi_jual.`no_transaksi`,barang.`nama_barang`, transaksi_jual.`tanggal_transaksi`, 
                        detail_transaksi_jual.`jumlah_beli`, detail_transaksi_jual.`harga`, 
                        detail_transaksi_jual.`diskon`, detail_transaksi_jual.`id`
                        FROM transaksi_jual 
                        JOIN detail_transaksi_jual USING(no_transaksi)
                        JOIN barang USING(kode_barang)
                        WHERE no_transaksi = '$no_transaksi_am'");

                        while($data = mysql_fetch_array($select)){
                            echo '<tr>';
                            echo '<td>'.$data[1].'</td>';
                            echo '<td>'.$data[2].'</td>';
                            echo '<td>'.$data[3].'</td>';
                            echo '<td>Rp. '.$data[4].'</td>';
                            echo '<td>'.$data[5].'</td>';
                            echo '<td>
                                <a style="cursor: pointer" href="index.php?modul=transaksi_penjualan&submodul=tambah_transaksi&no_transaksi='.$data[6].'"><img src="img/icons/highlighter-color.png">Ubah</a>
                                <a style="cursor: pointer" onclick=hapusDetailTransaksiJual("'.$data[6].'","'.$data[0].'","'.str_replace(' ','_',$data[1]).'")><img src="img/icons/cross-script.png">Hapus</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>

                </div>

            </div>
            </form>
        </div>

    </div>
</div>