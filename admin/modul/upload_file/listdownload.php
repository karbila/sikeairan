<?
include "../../conf-global/koneksi.php";
$download_path = 'uploads/';
$namafile = $_GET['namafile'];
if (!empty($namafile))
{
$result = mysql_query('SELECT namafile FROM tbdownload');
while ($row = mysql_fetch_array($result))
{
if ($row["namafile"] == $namafile)
{
$result = mysql_query("UPDATE tbdownload SET klik=klik+1 WHERE namafile='" . $namafile . "'");
header('Location: ' . $download_path . $namafile);
}
}
}
?>
 
<?
$proses=mysql_query("select * from tbdownload order by iddownload asc");
echo"
<TABLE cellspacing=0 cellpadding=5 border=1>
<TR height=30  bgcolor=#669900  align=center>
<TD>Deskripsi File</TD><TD>Download</TD><TD>KLIK</TD>
</TR>
";
while ($data=mysql_fetch_array($proses))
{ echo"<tr>
<td>$data[deskripsi]</td>
<td><a href='listdownload.php?namafile=$data[namafile]'>[ Download ]</a></td>
<td>$data[klik]</td>
</tr>
";
}
echo"</TABLE>";
?>