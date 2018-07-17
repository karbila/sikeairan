<?
include "../../conf-global/koneksi.php";
$deskripsi = $_POST['deskripsi'];
$uploadedfile=$_FILES['uploadedfile']['name'];
$target_path="uploads/";
$target_path=$target_path . basename( $_FILES['uploadedfile']['name'] );
$namafile = $_FILES['uploadedfile']['name'];
if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$target_path))
{
$simpan = mysql_query("INSERT INTO tbDOWNLOAD(deskripsi, namafile) VALUES('$deskripsi','$namafile')");
echo "File " . basename($_FILES['uploadedfile']['name']) . " Berhasil TerUpload";
echo "<br>Klik <A HREF=upload.php>Kembali</A> Untuk Upload Lagi";
}
else
{
echo("File Tidak Dapat Di Uploading, Silahkan Coba Lagi!");
echo "<br>Klik <A HREF=upload.php>Kembali</A> Untuk Upload Lagi";
}
?>