<?php
$no_transaksi_am = "";
if(isset($_GET['no_transaksi'])){
$no_transaksi_am = $_GET['no_transaksi'];
}
?>
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
                    <input type="hidden" name="action" value="tambah_detail_transaksi">
                    <div class="controls-row">
                        <div class="span3">No. Transaksi</div>
                        <div class="span9"><?php echo $no_transaksi_am ?></div>
                    </div>
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
                                        <h2>Daftar Pembelian</h2>
                                        <ul class="buttons">
                                            <li><a href="#" class="block_loading"><span class="i-cycle"></span></a></li>
                                            <li><a href="#" class="block_toggle"><span class="i-arrow-down-3"></span></a></li>
                                            <li><a href="#" class="block_remove"><span class="i-cancel-2"></span></a></li>
                                        </ul>                                        
                                    </div>
                                    <input type="hidden" name="action" value="simpan_detail_transaksi">
                                    <div class="content np">
                                        
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Barang</th>
                                                    <th width="10%">Jumlah</th>
                                                    <th width="10%">Harga</th>
                                                    <th width="10%">Diskon</th>
                                                    <th width="10%">Aksi</th>                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select = mysql_query("SELECT barang.`nama_barang`, temp_transaksi_jual.`jumlah_beli`, 
                                                temp_transaksi_jual.`harga`, temp_transaksi_jual.`diskon`, temp_transaksi_jual.`id`, barang.`kode_barang`
                                                FROM temp_transaksi_jual 
                                                JOIN barang USING (kode_barang)");
                                                $i = 1;
                                                while($data = mysql_fetch_array($select)){
                                                    echo '<tr>';
                                                    echo '<td>'.$i.'</td>';
                                                    echo '<td>'.$data[0].'</td>';
                                                    echo '<td>'.$data[1].'</td>';
                                                    echo '<td>Rp. '.$data[2].'</td>';
                                                    echo '<td>'.$data[3].'</td>';
                                                    echo '<td>
                                                        <a style="cursor: pointer" onclick=hapusTambahTransaksi("'.$data[4].'","'.$data[1].'","'.$data[5].'","'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                                    </td>';
                                                    echo '</tr>';
                                                    $i++;
                                                }
                                                ?>
                                                          
                                            </tbody>
                                        </table>                                        
                                        <div class="footer">
                                            <div class="side fr">
                                            <input type="submit" class="btn btn-primary" value="Simpan">
                                            </div>
                                        </div>
                                    </div>
                            </div>
            </form>
        </div>

    </div>
</div>