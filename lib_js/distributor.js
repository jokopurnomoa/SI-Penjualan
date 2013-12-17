$(document).ready(function(){
    $("#change").hide();

    valid = false;
    $(".Ubah2").click(function(){
        $("#change").fadeIn("slow");
        $("#kode").val($(this).parent().prev().prev().prev().text());
        $("#nama").val($(this).parent().prev().prev().text());
        $("#kontak").val($(this).parent().prev().text());
    });
});

function form_validator(){
    kode = document.forms["fTambah"]["kode_distributor"].value;
    nama = document.forms["fTambah"]["nama_distributor"].value;
    kontak = document.forms["fTambah"]["kontak_distributor"].value;

    if (kode == "" || nama == "" || kontak == "") {
        alert("Tolong Lengkapi Formulir Penambahan Distributor");
        return false;  
    }else if (isNaN(kontak)){
        alert("Isi Kontak Dengan Angka");
        return false;
    }
    else if(valid){
        alert("Kode Sudah Pernah Dipakai");
        return false;
    }
}

function ubah_validator(){
    kode = document.forms["fUbah"]["kode"].value;
    nama = document.forms["fUbah"]["nama"].value;
    kontak = document.forms["fUbah"]["kontak"].value;

    if (kode == "" || nama == "" || kontak == "") {
        alert("Tolong Lengkapi Formulir Pengubahan Distributor");
        return false;  
    }else if (isNaN(kontak)){
        alert("Isi Kontak Dengan Angka");
        return false;
    }
}

function hapus(kode){
    kode = kode.replace(/_/g," ");
    if(confirm("Apakah Anda Yakin Ingin Menghapus Distributor ini ?")){
        $(function(){
            $.post("modul/distributor/action_distributor.php",{"action" : "hapus_distributor", "kode_distributor" : kode})
            .done(function(data){
                if(data == "berhasil"){
                    document.location.href = "index.php?modul=distributor&submodul=tampil_distributor&result=succes_h";
                }else {
                    document.location.href = "index.php?modul=distributor&submodul=tampil_distributor&result=failed_h";
                }
            });
        });
    }
}

function cekKode(){
    kode = $("#kode_distributor").val();
    value = "";
    $(function(){
        $.post("modul/distributor/getKode.php",{"kode" : kode})
        .done(function(data){
            if(data == "ada" ){
                $("#warning").html("<img src=img/icons/cross-script.png>");
                valid = true;
            }else{
            $("#warning").html("Berhasil");
            valid = false;
            }
        });

    });
}

function cari(){
    cari = $("#search").val();
    value = "";
    $(function(){
        $.post("modul/distributor/getCari.php",{"cari" : cari})
        .done(function(data){
            if (data != "0") {
                res = $.parseJSON(data);
                $("#target").html("");
                for(i=0;i<res.length;i++){
                    value += "<tr>"+
                    "<td>"+(i+1)+"</td>"+
                    "<td>"+res[i][0]+"</td>"+
                    "<td>"+res[i][1]+"</td>"+
                    "<td>"+res[i][2]+"</td>"+
                    "<td>"+"asdasdasdasdasdsa"
                    //"<a style='cursor: pointer' onclick=ubah("res[i][0],res[i][1],res[i][2]")"+
                    "</td>"+
                    "</tr>";
                }
                $("#target").html(value);
            }
            else{
                $("#target").html("<tr><td colspan=5> <center>DATA KOSONG </center></td></tr>")
            }
            return;
        });
    });
}