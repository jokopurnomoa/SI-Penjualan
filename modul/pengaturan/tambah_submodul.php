<div class="head">
    <div class="info">
        <h1>Tambah Submodul</h1>
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
                    <strong>Berhasil tambah submodul.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal tambah submodul!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <form action="modul/pengaturan/action_modul.php" method="get">
            <div class="block">
                <div class="head">
                    <h2>Form Tambah Submodul</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="action" value="simpan_submodul">
                    <div class="controls-row">
                        <div class="span3">Nama Modul</div>
                        <div class="span9">
                            <select class="select2" style="width: 220px;" name="id_modul">
                                <?php
                                $query = mysql_query("SELECT id_modul, nama_modul FROM modul");
                                while($data = mysql_fetch_array($query)){
                                    echo '<option value="'.$data['id_modul'].'">'.$data['nama_modul'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Nama Submodul</div>
                        <div class="span9"><input type="text" name="nama_submodul" placeholder="Nama Sub Modul"/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Hak Akses</div>
                        <div class="span9">
                            <label class="radio-uni inline"><input type="radio" name="hak_akses" value="super" class="uni" checked="checked"/> Super Admin</label>
                            <label class="radio-uni inline"><input type="radio" name="hak_akses" value="admin" class="uni"/> Admin</label>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Publish</div>
                        <div class="span9">
                            <label class="radio-uni inline"><input type="radio" name="publish" value="Y" class="uni" checked="checked"/> Ya</label>
                            <label class="radio-uni inline"><input type="radio" name="publish" value="T" class="uni"/> Tidak</label>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="side fr">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>