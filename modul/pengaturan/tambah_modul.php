<div class="head">
    <div class="info">
        <h1>Tambah Modul</h1>
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
                <strong>Berhasil tambah modul.</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            } else if($result == 'failed'){
            ?>
            <div class="alert alert-error">
                <strong>Gagal tambah modul!</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
            }
            ?>

            <form action="modul/pengaturan/action_modul.php" method="get" enctype="multipart/form-data">
            <div class="block">
                <div class="head">
                    <h2>Form Tambah Modul</h2>
                </div>
                <div class="content np">
                    <input type="hidden" name="action" value="simpan_modul">
                    <div class="controls-row">
                        <div class="span3">Nama Modul</div>
                        <div class="span9"><input type="text" name="nama_modul" placeholder="Nama Modul"/></div>
                    </div>
                    <div class="controls-row">
                        <div class="span3">Link Icon</div>
                        <div class="span9">
                            <input type="text" name="icon" placeholder="Link Icon"/>
                        </div>
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
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>