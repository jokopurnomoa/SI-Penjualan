<div class="head" >
    <div class="info">
        <h1>Tambah Distributor</h1>
    </div>
</div>

<div class="content">
    <div class="row-fluid" >
        <!-- Code Here -->
        <div class="span8">
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'succes'){
            ?>
            <div class="alert alert-success">
                <strong>Berhasil menambah distributor.</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'failed'){
            ?>
            <div class="alert alert-error">
                <strong>Gagal menambah distributor!</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            }
            ?>
        <form name="fTambah" action="modul/distributor/action_distributor.php" method="post" onsubmit="return form_validator()" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Form Tambah Modul</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="action" value="tambah_distributor">
                    <div class="controls-row">
                        <div class="span3">Kode distributor</div>
                        <div class="span9"><input type="text" id="kode_distributor" name="kode_distributor" onchange="cekKode()" placeholder="Kode distributor" /><span id="warning"></span></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Nama distributor</div>
                        <div class="span9"><input type="text" id="nama_distributor" name="nama_distributor" placeholder="Nama distributor"/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Kontak</div>
                        <div class="span9">
                            <input type="text" id="kontak_distributor" name="kontak_distributor" placeholder="Kontak distributor"/>
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