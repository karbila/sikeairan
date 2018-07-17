<?php  

error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "history";
$okedel = "&mod=logs&p=log-oke";
$gagal = "&mod=logs&p=log-gagal";

$hapussemua = mysql_query("DELETE FROM logs");
if($hapussemua==1){
	header("location:../../index.php?halaman=$hal$okedel");
}else{
	header("location:../../index.php?halaman=$hal$gagal");
}


?>