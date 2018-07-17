<?php
$page=$_GET['page'];

switch($page){
 case "home" : 
 	include ("comp_user/home.php");
 break;
 
 case "data" : 
 	include ("comp_user/tabel_data.php");
 break;
 
 case "peta" : 
 	include ("comp_user/peta.php");
 break;

 case "petaoffline" : 
 	include ("comp_user/petaoff.php");
 break;

 case "detail_data" : 
 	include("comp_user/detail_data.php");
 break;
 
 case "panduan" : 
 	include ("comp_user/pdf.php");
 break;
  
default :
	//echo "modul belum dibuat";
	header("location:media.php?page=home");
break;
}

?>