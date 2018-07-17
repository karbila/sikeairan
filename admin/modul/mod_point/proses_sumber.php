<?php  
error_reporting(0);
session_start();
include '../../../componen/dbkonek/confdb.php';

$combo_des = mysql_query("SELECT s.id_sumber, s.nama_sumber FROM tbl_sumber s, tbl_lokasi l WHERE l.id_lokasi = s.id_lokasi AND l.id_lokasi = '$_GET[desa]'");
echo "<option value='0'>Sekarang Pilih Sumber</option>";  	

  	if(mysql_num_rows($combo_des)==0){
  		echo "<option>Belum Ada Sumber Air di Desa ini</option> \n";
  	}else{
  		while ($datades = mysql_fetch_array($combo_des)) {
  	    echo "<option value='$datades[id_sumber]'>$datades[nama_sumber]</option> \n";
  		}	
  	}
  
?>