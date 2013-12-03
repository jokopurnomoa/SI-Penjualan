<div class="head">
    <div class="info">
        <h1>Tambah Pengguna</h1>
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

            if($result == 'success_h'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil tambah pengguna.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_h'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal tambah pengguna!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <form action="modul/pengguna/action_pengguna.php" method="get">
                <div class="block">
                    <div class="head">
                        <h2>Form Tambah Pengguna</h2>
                    </div>
                    <div class="content np">
                        <input type="hidden" name="action" value="tambah_user">
                        <div class="controls-row">
                            <div class="span3">ID Pengguna</div>
                            <div class="span9"><input type="text" name="id_user" placeholder="ID Pengguna"/></div>
                        </div>
                        <div class="controls-row">
                            <div class="span3">Nama Pengguna</div>
                            <div class="span9">
                                <input type="text" name="nama_user" placeholder="Nama Pengguna"/>
                            </div>
                        </div>
                        <div class="controls-row">
                            <div class="span3">Password</div>
                            <div class="span9">
                                <input type="password" name="password" placeholder="Password"/>
                            </div>
                        </div>
                        <div class="controls-row">
                            <div class="span3">Hak Akses</div>
                            <div class="span9">
                                <label class="radio-uni inline"><input type="radio" name="hak_akses" value="super" class="uni" checked="checked"/> Super Admin</label>
                                <label class="radio-uni inline"><input type="radio" name="hak_akses" value="admin" class="uni"/> Admin</label>
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