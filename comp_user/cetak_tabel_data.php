<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
this.print(false);
</script>
</head>

<body>
<table width="750" border="0" align="center" bgcolor="#FFFFCC">
  <tr>
    <td bgcolor="#CCCCCC"><div align="center"><strong><img src="../componen/img/mix/a.png" width="75" height="90" align="left">PEMERINTAH KABUPATEN KEDIRI</strong><br>
SISTEM INFORMASI DATABASE JARINGAN PIPA AIR BERSIH<br>
KABUPATEN KEDIRI</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><strong>DATA DAN INFORMASI JARINGAN PIPA AIR BERSIH</strong></div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="244">&nbsp;</td>
        </tr>
      <tr>
        <td><table width="100%"  border="2" cellpadding="0" cellspacing="0">
          <tr bgcolor="#CCCCCC">
            <td><div align="center"><strong>No.</strong></div></td>
            <td><div align="center"><strong>Nama Desa</strong></div></td>
            <td><div align="center"><strong>Sumber Air</strong></div></td>
            <td><div align="center"><strong>Jaringan Pipa</strong></div></td>
            <td><div align="center"><strong>Diameter Pipa</strong></div></td>
            <td><div align="center"><strong>Jenis Pipa</strong></div></td>
            <td><div align="center"><strong>Panjang Pipa</strong></div></td>
            <td><div align="center"><strong>Debit Air</strong></div></td>
            <td><div align="center"><strong>Koordinat</strong></div></td>
            <td><div align="center"><strong>Tahun Pemasangan</strong></div></td>
            <td><div align="center"><strong>Kondisi Pipa</strong></div></td>
            <td><div align="center"><strong>Kondisi Bangunan</strong></div></td>
            <td><div align="center"><strong>Keterangan</strong></div></td>
            </tr>
          <?php
include "../componen/dbkonek/confdb.php";

$data = mysql_query("SELECT i.*, l.nama_desa, s.nama_sumber, r.nama_kecamatan 
                                FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
                                WHERE l.id_lokasi = i.id_lokasi
                                AND r.id_regional = l.id_regional
                                AND l.id_lokasi = s.id_lokasi
                                AND s.id_sumber = i.id_sumber");
 while($row=mysql_fetch_array($data)){
?>
          <tr>
            <td><div align="center"><?php echo $row['id_info'];?></div></td>
            <td><div align="center"><? echo $row ['nama_desa']?>
            </div></td>
            <td><div align="center"><? echo $row ['nama_sumber']?>
            </div></td>
            <td><div align="center"><? echo $row ['jaringan_pipa']?>
            </div></td>
            <td><div align="center"><strong>&empty; </strong><?php echo $row['diameter_pipa'];?><strong>&quot;</strong>
            </div></td>
            <td>
              <div align="center"><? echo $row ['jenis_pipa']?>
            </div></td>
            <td><div align="center"><? echo $row ['panjang_pipa']?>
            <strong>M&prime;</strong></div></td>
            <td><div align="center"><?php echo $row['debit_air'];?> <strong>l/dtk</strong>
            </div></td>
            <td><div align="center">Latitude: <?php echo $row['lat'];?> /<br>
            Longitude: <?php echo $row['lng'];?></div></td>
            <td><div align="center"><? echo $row ['thn_pemasangan']?>
            </div></td>
            <td><div align="center"><?php echo $row['kondisi_pipa'];?></div></td>
            <td><div align="center">
              <?= $row['kondisi_bangunan']?>
            </div></td>
            <td><div align="center"><? echo $row ['keterangan']?>
            </div></td>
            </tr>
          <?
		  }
		  ?>
          </table>
          
        
    </table></td>
  </tr>
  <tr>
    <td><div align="right">
  Dinas Pekerjaan Umum Kab.Kediri, <? echo $sekarang; ?></div></td>
  </tr>
</table>
</body>
</html>
