
<head>
<title>tonkpo</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
<div style="margin-left:-200px">
  <div style='width:770px; margin-left:200px'><h3 align='center' valign='top' class='heading'>Upload File </h3></div>
<form enctype="multipart/form-data" action="upload_download/upload.php" method="post">
<table class="datatable" align="center" width="447">
  <tr>
    <td align="center" valign="middle"><span style="color:#858585; font-size:14px">Komplek : </span></td>
    <td>
    <select name="nama_komplek" id="nama_komplek">
<option value="0">--Pilih Nama Komplek--</option>
<?php 
$query=mysql_query("select * from tbl_komplek_bangunan order by id_komplek asc");

while($row=mysql_fetch_array($query))
{
	?><option value="<?php  echo $row['nama_komplek']; ?>"><?php  echo $row['nama_komplek']; ?></option><?php 
}
?>
</select>
    
    </td>
  </tr>
  <tr>
    <td width="36%" align="center" valign="middle"><span style="color:#858585; font-size:14px">File : </span></td>
    <td><input type="file" name="datafile" size="30" id="gambar" /></td>
  </tr>
  
  <tr>
    <td width="36%" align="center" valign="middle"><span style="color:#858585; font-size:14px">Keterangan : </span></td>
    <td><textarea name="keterangan" cols="30" rows="3"></textarea></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td width="71%"><input name="submit" type="submit" value="Upload" />&nbsp;</td>
  </tr>
</table>
</form>
</div>
<? include "download1.php";?>
</body>

