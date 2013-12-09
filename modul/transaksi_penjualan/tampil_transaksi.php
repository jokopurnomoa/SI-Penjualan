<div class="head">
    <div class="info">
        <h1>Tampil Transaksi</h1>
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
                            <th width="10%">Total Kotor</th>
                            <th width="7%">Diskon</th>
                            <th width="10%">Total</th>
                            <th width="10%">Tanggal Transaksi</th>
                            <th width="15%">ID User</th>
                            <th width="20%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $select = mysql_query("SELECT * FROM transaksi_jual");
                        $i = 1;
                        while($data = mysql_fetch_array($select)){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$data[0].'</td>';
                            echo '<td>Rp. '.$data[2].'</td>';
                            echo '<td>Rp. '.$data[3].'</td>';
                            echo '<td>Rp. '.$data[4].'</td>';
                            echo '<td>'.$data[1].'</td>';
                            echo '<td>'.$data[5].'</td>';
                            echo '<td>
                                <a style="cursor: pointer" onclick=hapusTransaksiJual("'.$data[0].'","'.str_replace(' ','_',$data[0]).'")><img src="img/icons/cross-script.png">Hapus</a>
                                <a style="cursor: pointer" href="index.php?modul=transaksi_penjualan&submodul=detail_penjualan&no_transaksi='.$data[0].'"><img src="img/filetree/application.png">Detail</a>
                            </td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>
</div>