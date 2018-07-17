<?php
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "m_regional";
$simpanoke = "&mod=reg&p=re-oke";
$updateoke = "&mod=reg&p=re-oke-up";
$hapusoke = "&mod=reg&p=re-oke-rem";
$gagal = "&mod=reg&p=re-gagal";


if($_GET['proses']=='add_regional'){

    $add = "INSERT INTO tbl_regional (nama_kecamatan, lat, lng) VALUES ('$_POST[nk]', '$_POST[lt]', '$_POST[lg]')";   
    //echo "$add";
    if(mysql_query($add)){
        header("location:../../index.php?halaman=$hal$simpanoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }
    

}elseif($_GET['proses']=='update_regional'){

    $upp = "UPDATE  tbl_regional SET  nama_kecamatan =  '$_POST[nk]',
            lat =  '$_POST[lt]',
            lng =  '$_POST[lg]' WHERE  tbl_regional.id_regional ='$_POST[idreg]'
            ";
    //echo "$upp";
    if(mysql_query($upp)){
        header("location:../../index.php?halaman=$hal$updateoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }        

}elseif($_GET['proses']=='del_regional'){
    $del = "DELETE FROM tbl_regional WHERE id_regional = '$_GET[id]'";
    if(mysql_query($del)){
        header("location:../../index.php?halaman=$hal$hapusoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }    
    

}else{
    header("location:../../index.php?halaman=$hal");
}
?>
