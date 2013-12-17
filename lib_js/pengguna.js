function hapusPengguna(id,nama,isdel){
    if(confirm("Apakah Pengguna Dengan Nama \""+nama.replace('_',' ')+"\" Akan Dihapus?"))
        document.location.href="modul/pengguna/action_pengguna.php?action=hapus_user&id_user="+id;
}

function cariPengguna(){
    cari = $("#cari_pengguna").val();
    $.post("modul/pengguna/cari_pengguna.php",{"cari" : cari}).done(function(data){
        $("#tb-daftar-pengguna").html(data);
        $("#DataTables_Table_0_paginate").html("");
    });
}