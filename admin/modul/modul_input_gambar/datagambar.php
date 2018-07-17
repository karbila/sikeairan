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
	 mysql_query("UPDATE tbl_informasi_bangunan SET foto1 = '', foto2 ='', foto3 ='', foto4 ='', blokplan1='',blokplan2=''
                           WHERE  id_info       = '$id'");
}
?>





<?
include '../../conf-global/koneksi.php';

$download=mysql_query("select * from tbl_informasi_bangunan");
$cek=mysql_num_rows($download);

if($cek){
	
	?>
	<div style='width:770px; margin-left:75px'><h3 align='center' valign='top' class='heading'>Data Foto </h3></div>
    <div style="margin-right:300px; margin-left:50px">
	<table class="table table-striped  " bordercolor="#CCCCCC" border="1"  width="447" style="margin-right:100px" >
		<thead><tr>
			<th class="essential persist" style="font-size:12px"><div align="center">No</div></th>
            <th class="essential persist" style="font-size:12px"><div align="center">Nama </br>Bangunan</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Foto </br> Bangunan 1</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Foto </br>Bangunan 2</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Foto </br>Bangunan 3</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Foto </br>Bangunan 4</div></th>
            <th class="essential persist" style="font-size:12px"><div align="center">Foto </br>Blok Plan 2D</div></th>
            <th class="essential persist" style="font-size:12px"><div align="center">Foto </br>Blok Plan 3D</div></th>
			<th class="essential persist" style="font-size:12px"><div align="center">Aksi</div></th>
		</tr></thead>
	<?
	while($row=mysql_fetch_array($download)){
		?>    
		<tr>
			<td style="font-size:12px"><? echo $c=$c+1;?></td>
            <td style="font-size:12px"><?=$row['nama_bangunan'];?></td>
			<td style="font-size:12px"><?=$row['foto1'];?></td>
			<td style="font-size:12px"><?=$row['foto2'];?></td>
			<td style="font-size:12px"><?=$row['foto3'];?></td>
			<td style="font-size:12px"><?=$row['foto4'];?></td>
            <td style="font-size:12px"><?=$row['blokplan1'];?></td>
            <td style="font-size:12px"><?=$row['blokplan2'];?></td>
			<td style="font-size:12px"> <a  href="?halaman=input-gambar&mode=delete&id=<?php echo $row['id_info'];?>" onClick="return confirm('Apakah Anda Yakin Ingin \n Menghapus Data Tersebut ?')">Hapus</a></td>
		</tr>    
		<?
	}
	?>
	</table></div>
	<?
	
}else{
	 echo " <div style='margin-left:-160px' ><font color=red><center><b>Belum Ada Data!!</b><center</font></div>";
}


?>