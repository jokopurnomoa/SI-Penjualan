<div class="head">
    <div class="info">
        <h1>Tampil Pengguna</h1>
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
                    <strong>Berhasil hapus pengguna.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_h'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal hapus pengguna!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            else if($result == 'success_u'){
                ?>
                <div class="alert alert-success">
                    <strong>Berhasil ubah pengguna.</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            } else if($result == 'failed_u'){
                ?>
                <div class="alert alert-error">
                    <strong>Gagal ubah pengguna!</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php
            }
            ?>

            <div class="block">
                <div class="head">
                    <h2>Tabel Daftar Pengguna</h2>
                    <ul class="buttons">
                        <li><input type="text" name="cari" placeholder="Cari" id="cari_pengguna" onkeyup="cariPengguna()" style="margin-top: 4px;margin-right: 5px"/></li>
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
                            <th width="10%">ID Pengguna</th>
                            <th width="20%">Nama Pengguna</th>
                            <th width="12%">Hak Akses</th>
                            <th width="20%">Aksi</th>
                        </tr>

                        </thead>
                        <tbody id="tb-daftar-pengguna">
                        <?php
                        $select = mysql_query("SELECT * FROM user");
                        $i = 1;
                        while($data = mysql_fetch_array($select)){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$data[0].'</td>';
                            echo '<td>'.$data[1].'</td>';
                            echo '<td>'.$data[2].'</td>';
                            echo '<td>
                                <a style="cursor: pointer" href="index.php?modul=pengguna&submodul=ubah_pengguna&id_user='.$data[0].'"><img src="img/icons/highlighter-color.png">Ubah</a>
                                <a style="cursor: pointer" onclick=hapusPengguna("'.$data[0].'","'.str_replace(' ','_',$data[1]).'")><img src="img/icons/cross-script.png">Hapus</a>
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