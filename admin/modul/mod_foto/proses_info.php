<?php  
error_reporting(0);
session_start();
include '../../../componen/dbkonek/confdb.php';

$combo_des = mysql_query(" SELECT i.id_info, i.jaringan_pipa
				FROM tbl_informasi_point2 i, tbl_sumber s
				WHERE s.id_sumber = i.id_sumber
				AND s.id_sumber =  '$_GET[sum]' ");
echo "<option value='0'>Sekarang Pilih Jaringan</option>";  	

  	if(mysql_num_rows($combo_des)==0){
  		echo "<option>Belum Ada Jaringan di Sumber ini</option> \n";
  	}else{
  		while ($datades = mysql_fetch_array($combo_des)) {
  	    echo "<option value='$datades[id_info]'>$datades[jaringan_pipa]</option> \n";
  		}	
  	}
  
?>