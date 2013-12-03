function hapusModul(id,nama,isdel){
    if(confirm("Apakah Modul \""+nama.replace('_',' ')+"\" Akan Dihapus?"))
        document.location.href="modul/pengaturan/action_modul.php?action=hapus_modul&id_modul="+id;
}

function hapusSubmodul(id,nama,isdel){
    if(confirm("Apakah Submodul \""+nama.replace('_',' ')+"\" Akan Dihapus?"))
        document.location.href="modul/pengaturan/action_modul.php?action=hapus_submodul&id_submodul="+id;
}

function message(){

}