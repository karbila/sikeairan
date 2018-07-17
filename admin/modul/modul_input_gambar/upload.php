<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<div style="margin-left:100px">


<?php
$id_info=$_POST['id_info'];
$namafolder="gambar/$id_info/"; //tempat menyimpan file
include '../../conf-global/koneksi.php';

	$jenis_gambar1=$_FILES['nama_file1']['type'];
	$jenis_gambar2=$_FILES['nama_file2']['type'];
	$jenis_gambar3=$_FILES['nama_file3']['type'];
	$jenis_gambar4=$_FILES['nama_file4']['type'];
	$jenis_gambar4=$_FILES['blokplan1']['type'];
	$jenis_gambar4=$_FILES['blokplan']['type'];
	

	if($jenis_gambar1=="image/jpeg" || $jenis_gambar1=="image/jpg" || $jenis_gambar1=="image/gif" || $jenis_gambar1=="image/x-png")
	{			
		$gambar1 = $namafolder . basename($_FILES['nama_file1']['name']);		
		if (move_uploaded_file($_FILES['nama_file1']['tmp_name'], $gambar1)) {
			$sql="UPDATE tbl_informasi_bangunan SET foto1  = '$gambar1'
                           WHERE  id_info       = '$id_info'";
		
		$res=mysql_query($sql) or die (mysql_error());
		
		
		?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
		
		} 
		$gambar2 = $namafolder . basename($_FILES['nama_file2']['name']);		
		if (move_uploaded_file($_FILES['nama_file2']['tmp_name'], $gambar2)) {
			$sql="UPDATE tbl_informasi_bangunan SET foto2  = '$gambar2'
                           WHERE  id_info       = '$id_info'";
			$res=mysql_query($sql) or die (mysql_error());
		
		?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
		
		}
		$gambar3 = $namafolder . basename($_FILES['nama_file3']['name']);		
		if (move_uploaded_file($_FILES['nama_file3']['tmp_name'], $gambar3)) {
			$sql="UPDATE tbl_informasi_bangunan SET foto3  = '$gambar3'
                           WHERE  id_info       = '$id_info'";
			$res=mysql_query($sql) or die (mysql_error());
		
		?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
		
		
		}
		$gambar4 = $namafolder . basename($_FILES['nama_file4']['name']);		
		if (move_uploaded_file($_FILES['nama_file4']['tmp_name'], $gambar4)) {
			$sql="UPDATE tbl_informasi_bangunan SET foto4  = '$gambar4'
                           WHERE  id_info       = '$id_info'";
			$res=mysql_query($sql) or die (mysql_error());
		
		?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
		
		}
		$gambar5 = $namafolder . basename($_FILES['blokplan1']['name']);		
		if (move_uploaded_file($_FILES['blokplan1']['tmp_name'], $gambar5)) {
			$sql="UPDATE tbl_informasi_bangunan SET blokplan1  = '$gambar5'
                           WHERE  id_info       = '$id_info'";
			$res=mysql_query($sql) or die (mysql_error());
			
			?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
			
			
		
		}
		$gambar6 = $namafolder . basename($_FILES['blokplan2']['name']);		
		if (move_uploaded_file($_FILES['blokplan2']['tmp_name'], $gambar6)) {
			$sql="UPDATE tbl_informasi_bangunan SET blokplan2 = '$gambar6'
                           WHERE  id_info       = '$id_info'";
			$res=mysql_query($sql) or die (mysql_error());
			?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? 
		}
		
			
		else {

	?><script language="JavaScript">alert('Foto Telah Tersimpan');
	document.location="../index.php?halaman=input-gambar"</script>
	<? }
   } 


?>



<div>
</body>
</html>