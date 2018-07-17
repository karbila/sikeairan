<?php  
error_reporting(0);
session_start();
include '../../../componen/dbkonek/confdb.php';

$combo_des = mysql_query("SELECT l.id_lokasi, l.nama_desa FROM tbl_lokasi l, tbl_regional r  WHERE r.id_regional = l.id_regional AND r.id_regional = '$_GET[keca]'");
echo "<option value='0'>Sekarang Pilih Desa</option>";  	

  	if(mysql_num_rows($combo_des)==0){
  		echo "<option>Belum Ada Desa di Kecamatan ini</option> \n";
  	}else{
  		while ($datades = mysql_fetch_array($combo_des)) {
  	    echo "<option value='$datades[id_lokasi]'>$datades[nama_desa]</option> \n";
  		}	
  	}
  
?>