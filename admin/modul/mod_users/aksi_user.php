<?php
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "user";
$simpanoke = "&mod=user&p=us-oke";
$updateoke = "&mod=user&p=us-oke-up";
$gagal = "&mod=user&p=us-gagal";

if($_GET['proses']=='add_user'){

    $add = "INSERT INTO  users (username , password , nama_lengkap , level , status)
            VALUES ('$_POST[us]',  '$_POST[ps]',  '$_POST[nl]',  '$_POST[level]',  '$_POST[st]')";    
    //echo "$add";
    if(mysql_query($add)){
        header("location:../../index.php?halaman=$hal$simpanoke");
    }else{
        header("location:../../index.php?halaman=$hal$gagal");
    }


}elseif($_GET['proses']=='update_user'){

    if(empty($_POST['ps'])){
        $upp = "UPDATE users SET username='$_POST[us]', nama_lengkap= '$_POST[nl]', level='$_POST[level]',status='$_POST[st]' WHERE id_user = '$_POST[iduser]'";
        //echo "$upp";
        if(mysql_query($upp)){
            header("location:../../index.php?halaman=$hal$updateoke");
        }else{
            header("location:../../index.php?halaman=$hal$gagal");    
        }       
        
    }else{
        $upp = "UPDATE users SET username='$_POST[us]', password='$_POST[ps]', nama_lengkap= '$_POST[nl]', level='$_POST[level]',status='$_POST[st]' WHERE id_user = '$_POST[iduser]'";    
        //echo "$upp";
        if(mysql_query($upp)){
            header("location:../../index.php?halaman=$hal$updateoke");
        }else{
            header("location:../../index.php?halaman=$hal$gagal");    
        }       
        
    }

}elseif($_GET['aksi']=='ubahstatus'){
    $id = $_GET['id'];
    //echo "$id";
    $sq = mysql_fetch_array(mysql_query("SELECT status FROM users WHERE id_user = '$id'"));

    if($sq['status']=='Y'){
        //echo "y";
        $st = "UPDATE users SET status = 'N' WHERE id_user = '$id'";
    
        if(mysql_query($st)){
            header("location:../../index.php?halaman=$hal$updateoke");
        }else{
            header("location:../../index.php?halaman=$hal$gagal");    
        }
        
    }elseif($sq['status']=='N'){
        //echo "n";
        $st2 = "UPDATE users SET status = 'Y' WHERE id_user = '$id'";
        
        if(mysql_query($st2)){
            header("location:../../index.php?halaman=$hal$updateoke");
        }else{
            header("location:../../index.php?halaman=$hal$gagal");    
        }        
    }
    
}else{
    header("location:../../index.php?halaman=$hal");
}
?>
