<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<div style="margin-left:200px">
<form action="modul_input_gambar/upload.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  
  <p> <div style="margin-left:100px">Inputkan Foto Bangunan</div></p>
  <p>&nbsp;</p>
  <p> <div style="margin-left:20px">Nama Bangunan :
   <select name="id_info" id="id_info">
<option value="0">--Pilih Nama Bangunan--</option>
<?php 
$query=mysql_query("select * from tbl_informasi_bangunan order by id_info asc");

while($row=mysql_fetch_array($query))
{
	?><option value="<?php  echo $row['id_info']; ?>"><?php  echo $row['nama_bangunan']; ?></option><?php 
}
?>
</select></div>
  </p>
  <p>
    <div style="margin-left:15px">Foto Bangunan 1
     : 
      <input name="nama_file1" type="file" id="nama_file" size="30" /></div>
</p>
 <p>
    <div style="margin-left:15px">Foto Bangunan 2
    : 
    <input name="nama_file2" type="file" id="nama_file2" size="30" /></div>
</p>
 <p>
   <div style="margin-left:15px"> Foto Bangunan 3
    : 
    <input name="nama_file3" type="file" id="nama_file3" size="30" /></div>
</p>
<p>
   <div style="margin-left:15px"> Foto Bangunan 4
    : 
    <input name="nama_file4" type="file" id="nama_file4" size="30" /></div>
</p>
<p>
    Foto Blok Plan (2D)
    : 
    <input name="blokplan1" type="file" id="nama_file5" size="30" />
</p>
 <p>
    Foto Blok Plan (3D)
    : 
    <input name="blokplan2" type="file" id="nama_file6" size="30" />
</p>
  <p>
  <div style="margin-left:180px">   <input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" />
  </div></p>
  
  <div style="margin-left:-250px; margin-right:200px; width:447px">
  <? include "datagambar.php";?>
</div>
</form>
</div>

</body>
</html>
