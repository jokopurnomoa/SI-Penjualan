<?php
$id_modul_um = "";
if(isset($_GET['id_modul'])){
    $id_modul_um = $_GET['id_modul'];
}
$select = mysql_query("SELECT * FROM modul WHERE id_modul = '$id_modul_um'");
$data = mysql_fetch_array($select);
?>
<div class="head">
    <div class="info">
        <h1>Ubah Modul</h1>
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

        <div class="span6">
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'success'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil ubah modul.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal ubah modul!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <form action="modul/pengaturan/action_modul.php" method="get" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Form Ubah Modul</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="id_modul" value="<?php echo $id_modul_um;?>">
                    <input type="hidden" name="action" value="ubah_modul">
                    <div class="controls-row">
                        <div class="span3">Nama Modul</div>
                        <div class="span9"><input type="text" name="nama_modul" placeholder="Nama Modul" value="<?php echo $data['nama_modul'];?>"/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Link Icon</div>
                        <div class="span9">
                            <input type="text" name="icon" placeholder="Link Icon" value="<?php echo $data['icon'];?>"/>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Hak Akses</div>
                        <div class="span9">
                            <label class="radio-uni inline"><input type="radio" name="hak_akses" value="super" class="uni" <?php if($data['hak_akses'] == 'super') echo 'checked="checked"';?>/> Super Admin</label>
                            <label class="radio-uni inline"><input type="radio" name="hak_akses" value="admin" class="uni" <?php if($data['hak_akses'] == 'admin') echo 'checked="checked"';?>/> Admin</label>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Publish</div>
                        <div class="span9">
                            <label class="radio-uni inline"><input type="radio" name="publish" value="Y" class="uni" <?php if($data['publish'] == 'Y') echo 'checked="checked"'; ?>/> Ya</label>
                            <label class="radio-uni inline"><input type="radio" name="publish" value="T" class="uni" <?php if($data['publish'] == 'T' || $data['publish'] == '') echo 'checked="checked"'; ?>/> Tidak</label>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="side fr">
                        <a href="index.php?modul=pengaturan&submodul=daftar_modul" class="btn btn-danger" type="button" style="padding: 2px 15px 2px 15px">Batal</a>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>