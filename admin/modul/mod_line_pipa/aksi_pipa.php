<?php
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "m_linepipa";
$simpanoke = "&mod=line&p=li-oke";
$updateoke = "&mod=line&p=li-oke-up";
$hapusoke = "&mod=line&p=li-oke-rem";
$gagal = "&mod=line&p=li-gagal";


if($_GET['proses']=='add_pipa'){

    $add = "INSERT INTO tbl_line_pipa (id_sumber, x1, y1, x2, y2, x3, y3) VALUES ('$_POST[sumber]', '$_POST[x1]', '$_POST[y1]', '$_POST[x2]', '$_POST[y2]', '$_POST[x3]', '$_POST[y3]');";    

    if(mysql_query($add)){
        header("location:../../index.php?halaman=$hal$simpanoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }
    


}elseif($_GET['proses']=='update_pipa'){

    $upp = "UPDATE  tbl_line_pipa SET  id_sumber ='$_POST[sumber]',  x1 =  '$_POST[x1]',
            y1 =  '$_POST[y1]',
            x2 =  '$_POST[x2]',
            y2 =  '$_POST[y2]',
            x3 =  '$_POST[x3]',
            y3 =  '$_POST[y3]' WHERE  tbl_line_pipa.id_line_pipa ='$_POST[idpipa]'";
    
    if(mysql_query($upp)){
        header("location:../../index.php?halaman=$hal$updateoke");    
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }
    

}elseif($_GET['proses']=='del_pipa'){
    $del = "DELETE FROM tbl_line_pipa WHERE id_line_pipa = '$_GET[id]'";
    if(mysql_query($del)){
        header("location:../../index.php?halaman=$hal$hapusoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }
    
}else{
    header("location:../../index.php?halaman=$hal");
}
?>
