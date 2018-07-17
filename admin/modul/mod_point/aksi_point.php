<?php
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "m_point";
$simpanoke = "&mod=point&p=po-oke";
$updateoke = "&mod=point&p=po-oke-up";
$hapusoke = "&mod=point&p=po-oke-rem";
$gagal = "&mod=point&p=po-gagal";


if($_GET['proses']=='add_point'){

    $add = "INSERT INTO tbl_informasi_point2 (id_lokasi, id_sumber, jaringan_pipa, diameter_pipa, jenis_pipa, panjang_pipa, debit_air, lat, lng, thn_pemasangan, kondisi_pipa,  kondisi_bangunan, elevasi, keterangan, foto1, foto2, foto3, foto4) VALUES ('$_POST[desa]', '$_POST[sum]', '$_POST[jp]', '$_POST[dp]', '$_POST[jp2]', '$_POST[pp]', '$_POST[da]', '$_POST[lt]', '$_POST[lg]', '$_POST[tp]', '$_POST[kp]', '$_POST[kb]', '$_POST[el]', '$_POST[ket]', '-', '-', '-', '-');";    
    //echo "$add";
    if(mysql_query($add)){
        header("location:../../index.php?halaman=$hal$simpanoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }


}elseif($_GET['proses']=='update_point'){

    $upp = "UPDATE tbl_informasi_point2 SET id_lokasi = '$_POST[desa]', id_sumber = '$_POST[sum]', jaringan_pipa = '$_POST[jp]', diameter_pipa = '$_POST[dp]', jenis_pipa = '$_POST[jp2]', panjang_pipa = '$_POST[pp]', debit_air = '$_POST[da]', lat = '$_POST[lt]', lng = '$_POST[lg]', thn_pemasangan = '$_POST[tp]', kondisi_pipa = '$_POST[kp]', kondisi_bangunan = '$_POST[kb]', elevasi = '$_POST[el]', keterangan = '$_POST[ket]' WHERE tbl_informasi_point2.id_info = '$_POST[idpoint]';";
    //echo "$upp";
    if(mysql_query($upp)){
        header("location:../../index.php?halaman=$hal$updateoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }    
    

}elseif($_GET['proses']=='del_point'){
    $del = "DELETE FROM tbl_informasi_point2 WHERE id_info = '$_GET[id]'";
    
    if(mysql_query($del)){
        header("location:../../index.php?halaman=$hal$hapusoke");
    }else{  
        header("location:../../index.php?halaman=$hal$gagal");
    }       
    

}else{
    header("location:../../index.php?halaman=$hal");
}
?>
