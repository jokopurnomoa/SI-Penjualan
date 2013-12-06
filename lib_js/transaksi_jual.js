function hapusTransaksiJual(id,isdel){
    if(confirm("Apakah transaksi No. \""+id.replace('_',' ')+"\" akan dihapus?"))
        document.location.href="modul/transaksi_penjualan/action_penjualan.php?action=hapus_transaksi&no_transaksi="+id;
}

function hapusDetailTransaksiJual(id,no_transaksi,nama_barang,isdel){
	if(confirm("Apakah pembelian \""+nama_barang.replace('_',' ')+"\" akan dihapus?"))
        document.location.href="modul/transaksi_penjualan/action_penjualan.php?action=hapus_detail_transaksi_jual&id="+id+"&no_transaksi="+no_transaksi;
}

function message(){

}