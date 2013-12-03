<?php
$id_submodul_um = "";
if(isset($_GET['id_submodul'])){
    $id_submodul_um = $_GET['id_submodul'];
}
$select = mysql_query("SELECT * FROM submodul WHERE id_submodul = '$id_submodul_um'");
$data = mysql_fetch_array($select);
?>
<div class="head">
    <div class="info">
        <h1>Ubah Submodul</h1>
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

        <div class="span8">
            <?php
            $result = "";
            if(isset($_GET['result'])){
                $result = $_GET['result'];
            }

            if($result == 'success'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil ubah submodul.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal ubah submodul!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <form action="modul/pengaturan/action_modul.php" method="get">
            <div class="block">
                <div class="head">
                    <h2>Form Ubah Submodul</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="id_submodul" value="<?php echo $data['id_submodul'];?>">
                    <input type="hidden" name="action" value="ubah_submodul">
                    <div class="controls-row">
                        <div class="span3">Nama Modul</div>
                        <div class="span9">
                            <select class="select2" style="width: 220px;" name="id_modul">
                                <?php
                                $query = mysql_query("SELECT id_modul, nama_modul FROM modul");
                                while($data2 = mysql_fetch_array($query)){
                                    if($data2['id_modul'] == $data['id_modul']){
                                        echo '<option value="'.$data2['id_modul'].'" selected>'.$data2['nama_modul'].'</option>';
                                    } else {
                                        echo '<option value="'.$data2['id_modul'].'">'.$data2['nama_modul'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Nama Sub Modul</div>
                        <div class="span9"><input type="text" name="nama_submodul" placeholder="Nama Sub Modul" value="<?php echo $data['nama_submodul'];?>"/></div>
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
                            <label class="radio-uni inline"><input type="radio" name="publish" value="Y" class="uni" <?php if($data['publish'] == 'Y') echo 'checked="checked"';?>/> Ya</label>
                            <label class="radio-uni inline"><input type="radio" name="publish" value="T" class="uni" <?php if($data['publish'] == 'T') echo 'checked="checked"';?>/> Tidak</label>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="side fr">
                        <a href="index.php?modul=pengaturan&submodul=daftar_submodul" class="btn btn-danger" type="button" style="padding: 4px 15px 4px 15px">Batal</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>