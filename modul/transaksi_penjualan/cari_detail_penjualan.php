<div class="head">
    <div class="info">
        <h1>Detail Transaksi Penjualan</h1>
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

        <div class="span12">
            
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'success_h'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil hapus detail transaksi jual.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_h'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal hapus detail transaksi jual!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            else if($result == 'success_t'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil ubah detail transaksi jual.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_t'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal ubah detail transaksi jual!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

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
                            <th width="10%">No. Transaksi</th>
                            <th width="15%">Nama Barang</th>
                            <th width="7%">Jumlah</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Diskon</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no_transaksi_am = "";
                        if(isset($_GET['cari'])){
                            $no_transaksi_am = $_GET['cari'];
                        }

                        $select = mysql_query("SELECT transaksi_jual.`no_transaksi`,barang.`nama_barang`, transaksi_jual.`tanggal_transaksi`, 
                        detail_transaksi_jual.`jumlah_beli`, detail_transaksi_jual.`harga`, 
                        detail_transaksi_jual.`diskon`, detail_transaksi_jual.`id`, barang.`kode_barang`
                        FROM transaksi_jual 
                        JOIN detail_transaksi_jual USING(no_transaksi)
                        JOIN barang USING(kode_barang)
                        WHERE no_transaksi LIKE '%$no_transaksi_am%'");

                        while($data = mysql_fetch_array($select)){
                            echo '<tr>';
                            echo '<td>'.$data[0].'</td>';
                            echo '<td>'.$data[1].'</td>';
                            echo '<td>'.$data[3].'</td>';
                            echo '<td>Rp. '.$data[4].'</td>';
                            echo '<td>'.$data[5].'</td>';
                            echo '<td>
                                <a style="cursor: pointer" onclick=hapusDetailTransaksiJual("'.$data[6].'","'.$data[0].'","'.$data[3].'","'.$data[7].'","'.str_replace(' ','_',$data[1]).'")><img src="img/icons/cross-script.png">Hapus</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="footer">
                    <div class="side fr">
                        <a href="index.php?modul=transaksi_penjualan&submodul=tambah_detail_transaksi&no_transaksi=<?php echo $no_transaksi_am ?>" class="btn btn-primary" type="button" style="padding: 4px 15px 4px 15px">Tambah</a>
                    </div>
                </div>
                </div>

            </div>

        </div>
    </div>
</div>