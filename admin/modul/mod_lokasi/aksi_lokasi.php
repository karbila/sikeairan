<?php  
error_reporting(0);
include '../../../componen/dbkonek/confdb.php';

$hal = "m_lokasi";
$simpanoke = "&mod=lokasi&p=lo-oke";
$updateoke = "&mod=lokasi&p=lo-oke-up";
$hapusoke = "&mod=lokasi&p=lo-oke-rem";
$gagal = "&mod=lokasi&p=lo-gagal";


if($_GET['proses']=='add_lokasi'){

	$add = "INSERT INTO tbl_lokasi (id_regional, nama_desa, lat, lng) VALUES ('$_POST[kecamatan]', '$_POST[nama_desa]', '$_POST[lat]', '$_POST[lng]')";

	if(mysql_query($add)){
		header("location:../../index.php?halaman=$hal$simpanoke");
	}else{
		header("location:../../index.php?halaman=$hal$gagal");
	}
	

}elseif($_GET['proses']=='update_lokasi'){
	$upp = "UPDATE  tbl_lokasi SET  id_regional =  '$_POST[kecamatan]',
			nama_desa =  '$_POST[nama_desa]',
			lat =  '$_POST[lat]',
			lng =  '$_POST[lng]' WHERE  tbl_lokasi.id_lokasi ='$_POST[idlok]'";
	
	if(mysql_query($upp)){
		header("location:../../index.php?halaman=$hal$updateoke");
	}else{
		header("location:../../index.php?halaman=$hal$gagal");
	}	
	

}elseif($_GET['proses']=='del_lokasi'){
	$del = "DELETE FROM tbl_lokasi WHERE id_lokasi = '$_GET[id]'";
		
	if(mysql_query($del)){
		header("location:../../index.php?halaman=$hal$hapusoke");
	}else{
		header("location:../../index.php?halaman=$hal$gagal");
	}		
	

}else{
	header("location:../../index.php?halaman=$hal");
}

?>


