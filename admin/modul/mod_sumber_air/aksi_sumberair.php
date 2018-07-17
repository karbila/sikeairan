<?php
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "m_sumberair";
$simpanoke = "&mod=sumber&p=su-oke";
$updateoke = "&mod=sumber&p=su-oke-up";
$hapusoke = "&mod=sumber&p=su-oke-rem";
$gagal = "&mod=sumber&p=su-gagal";

if($_GET['proses']=='add_sumberair'){

    $add = "INSERT INTO tbl_sumber (nama_sumber, id_lokasi, lat, lng) VALUES ('$_POST[ns]', '$_POST[desa]', '$_POST[lt]', '$_POST[lg]');";   
    //echo "$add";
    if(mysql_query($add)){
        header("location:../../index.php?halaman=$hal$simpanoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");    
    }        

}elseif($_GET['proses']=='update_sumberair'){

    $upp = "UPDATE  tbl_sumber SET  nama_sumber =  '$_POST[ns]',
            id_lokasi =  '$_POST[desa]',
            lat =  '$_POST[lt]',
            lng =  '$_POST[lg]' WHERE  tbl_sumber.id_sumber ='$_POST[idsumber]'";
    //echo "$upp";
    if(mysql_query($upp)){
        header("location:../../index.php?halaman=$hal$updateoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");    
    }        

}elseif($_GET['proses']=='del_sumberair'){
    $del = "DELETE FROM tbl_sumber WHERE id_sumber='$_GET[id]'";
    
    if(mysql_query($del)){
        header("location:../../index.php?halaman=$hal$hapusoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");    
    }        

}else{
    header("location:../../index.php?halaman=$hal");
}
?>
