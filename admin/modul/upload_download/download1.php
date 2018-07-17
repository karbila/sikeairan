<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<?php
if(isset($_POST['submit'])){

	$id=$_POST['id'];
	$fungsi_bangunan=ucwords($_POST['nama_komplek']);
	
	$query=mysql_query("insert into tbl_komplek_bangunan values('$id_komplek','$nama_komplek')");
	
	if($query){
		?><script language="javascript">alert('Berhasil Input Data')</script><?php
		?><script language="javascript">document.location.href="?halaman=data-komplekbangunan"</script><?php
	}else{
		echo mysql_error();
	}
	
}else{
	unset($_POST['submit']);
}

if(isset($_GET['mode'])=='delete'){
	 $id=$_GET['id'];
	 mysql_query("delete from tabel_data where id='$id'");
}
?>
<?
include "../../conf-global/koneksi.php";

$download=mysql_query("select * from tabel_data");
$cek=mysql_num_rows($download);

if($cek){
	
	?>
	<div style='width:770px; margin-left:0px'><h3 align='center' valign='top' class='heading'>Download File </h3></div>
    <div style="margin-right:200px; margin-left:50px">
	<table class="table table-striped table-bordered " align="center" width="447">
		<thead><tr>
			<th class="essential persist" style="font-size:12px"><div align="center">No</div></th>
            <th class="essential persist" style="font-size:12px"><div align="center">Nama Komplek</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Nama File</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Ukuran (byte)</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Tgl Upload</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Keterangan</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Aksi</div></th>
		</tr></thead>
	<?
	while($row=mysql_fetch_array($download)){
		?>    <tbody>
		<tr>
			<td style="font-size:12px"><? echo $c=$c+1;?></td>
            <td style="font-size:12px"><?=$row['nama_komplek'];?></td>
			<td style="font-size:12px"><?=$row['nama_file'];?></td>
			<td style="font-size:12px"><?=$row['ukuran'];?></td>
			<td style="font-size:12px"><?=$row['tgl_upload'];?></td>
			<td style="font-size:12px"><?=$row['keterangan'];?></td>
			<td style="font-size:12px"><div align="center"><a href="upload_download/download.php?filename=<?=$row['url'];?>">Download</a>  <a  href="?halaman=updo&mode=delete&id=<?php echo $row['id'];?>" onClick="return confirm('Apakah Anda Yakin Ingin \n Menghapus Data Tersebut ?')">Hapus</a></div></td>
		</tr>    </tbody>
		<?
	}
	?>
	</table></div>
	<?
	
}else{
	 echo " <div style='margin-left:-160px' ><font color=red><center><b>Belum Ada Data!!</b><center</font></div>";
}


?>