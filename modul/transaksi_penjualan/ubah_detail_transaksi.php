<div class="head">
    <div class="info">
        <h1>Tambah Transaksi</h1>
    </div>

    <div class="search">
        
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
                    <input type="hidden" name="action" value="ubah_detail_transaksi_jual">
                    <?php
                    $no_transaksi_am = "";
                    $id_am = "";
                    $kode_barang = "";
                    if (isset($_GET['no_transaksi']))
                    {
                        $no_transaksi_am = $_GET['no_transaksi'];
                    }

                    if (isset($_GET['id']))
                    {
                        $id_am =  $_GET['id'];
                    }

                    if (isset($_GET['kode_barang']))
                    {
                        $kode_barang =  $_GET['kode_barang'];
                    } 
                    ?>

                    <input type="hidden" name="no_transaksi" value=<?php echo $no_transaksi_am; ?>>
                    <input type="hidden" name="id" value=<?php echo $id_am; ?>>
                    <input type="hidden" name="kode_barang_bekas" value=<?php echo $kode_barang; ?>>
                    <div class="controls-row">
                        <div class="span3">Barang</div>
                        <div class="span9">
                            <select class="select2" style="width: 220px;" name="kode_barang">
                                <?php

                                    $query = mysql_query("SELECT kode_barang,nama_barang FROM barang");
                                    while($data = mysql_fetch_array($query)){
                                        if ($kode_barang == $data['kode_barang']) {
                                            echo '<option value="'.$data['kode_barang'].'" selected>'.$data['nama_barang'].'</option>';
                                        }
                                        else{
                                        echo '<option value="'.$data['kode_barang'].'">'.$data['nama_barang'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Jumlah</div>
                        <?php
                        $query = mysql_query("SELECT jumlah_beli FROM detail_transaksi_jual WHERE kode_barang = '$kode_barang' AND no_transaksi = $no_transaksi_am");
                        $data = mysql_fetch_array($query);
                        ?>
                        <div class="span9"><input type="text" name="jumlah" placeholder=<?php echo $data[0]; ?>></div>
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
</div>