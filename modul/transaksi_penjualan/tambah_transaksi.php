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
                <strong>Gagal tambah transaksi penjualan!</strong>
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
                    <input type="hidden" name="action" value="simpan_transaksi_jual">
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
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>