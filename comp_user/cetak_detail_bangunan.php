<? 
//Panggil
 if (empty($_GET['id_info']))
 { 
 }else{
 $id_info=$_GET['id_info'];}
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script>
this.print(false);
</script>

</head>
<?php
include "conf-global/koneksi.php";

$detil = mysql_query("select * from tbl_informasi_bangunan where id_info='$id_info' ");
 while($data=mysql_fetch_array($detil)){
?>

<body>

<div align="center" style="height: 850px; width: 750px;">
<table width="750px" id="cetak" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="741" bgcolor="#FFFFCC"><div align="center"><strong><img src="icon/logo-kab-kediri.png" width="75" height="90" align="left"><br> 
    PEMERINTAH KABUPATEN KEDIRI</strong><br>
    SISTEM INFORMASI DATABASE<br>
    GEDUNG DAN KANTOR NEGARA KABUPATEN KEDIRI</div></td>
  </tr>
  <tr style="border-top-style:groove">
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><strong>DATA DAN INFORMASI BANGUNAN</strong></div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="baru">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td width="224"><strong>Komplek Bangunan</strong></td>
        <td width="10"><strong>:</strong></td>
        <td width="768"> <?= $data['nama_komplek']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Nama Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['nama_bangunan']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Jenis Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['jenis_bangunan']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Fungsi Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['fungsi_bangunan']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Alamat</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['alamat']?></td>
        </tr>
      <tr>
        <td><strong>&raquo;Telp</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['telp']?></td>
      </tr>
      <tr>
        <td><strong>&raquo; Fax</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['fax']?></td>
        </tr>
      <tr>
        <td><strong>&raquo; Email</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['email']?></td>
        </tr>
      <tr>
        <td><strong>&raquo; Website</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['website']?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>Koordinat</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong> &raquo; Latitude</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['lat']?></td>
        </tr>
      <tr>
        <td><strong>&raquo; Longitude</strong></td>
        <td>:</td>
        <td> <?= $data['lng']?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Luas Tanah / Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td>  <?= $data['luas_tanah']?>
          - <strong>m<sup>2 </strong>/
  <?= $data['luas_bangunan']?>
          - <strong>m<sup>2</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>No. IMB</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['no_imb']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Sertifikat</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>&raquo; Nomor</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['no_sertif']?></td>
        </tr>
      <tr>
        <td><strong>&raquo; Pemilik</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['pemilik']?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>Pembangunan</strong></td>
        <td><strong>:</strong></td>
        <td><strong>Tahun :</strong>
          <?= $data['bangunan_thn']?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>Rehabilitasi Terakhir</strong></td>
        <td><strong>:</strong></td>
        <td><strong>Tahun :</strong> <?= $data['rehabilitasi_akhir_thn']?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>Nilai Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['nilai_bangunan']?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><strong>Kondisi Bangunan</strong></td>
        <td><strong>:</strong></td>
        <td> <?= $data['kondisi_bangunan']?> <strong>%</strong></td>
        </tr>
    </table></td>
  </tr>
  <? 
 }
 ?>
</table>
<div width="750px" align="right">Kediri, <? echo $sekarang; ?></div>
</div>
</body>
</html>
