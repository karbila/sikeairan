<?php  

$aksi = "modul/mod_foto/aksi_foto.php";
$target = "Foto Jaringan Pipa";

switch ($_GET['aksi']) {
    default:        
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>        
        <div class='isi-form'>";

        echo "
        <h4 class='box-judulform'>Tabel $target</h4>
        <div class='box-tb-r'>
        <input style='margin-left:0px' type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_foto&aksi=tambahfoto';\" class='btn btn-inverse'>      
        </div>

        <div class='box-tabel'>       
        <table class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead>
        <tr>
        <th class='essential persist'>No</th>        
        <th class='essential persist'>Nama Sumber</th>
        <th class='essential persist'>Nama Desa</th>
        <th class='essential persist'>Jaringan</th>
        <th class='essential persist'><div align='center'>Aksi</div></th> 
        </tr>
        </thead><tbody>";
        $tampil = mysql_query("SELECT s.nama_sumber, l.nama_desa, i.jaringan_pipa, i.id_info, i.foto1, i.foto2, i.foto3, i.foto4
                FROM tbl_sumber s, tbl_lokasi l, tbl_informasi_point2 i, tbl_regional r
                WHERE s.id_sumber = i.id_sumber
                AND l.id_lokasi = i.id_lokasi
                AND l.id_lokasi = s.id_lokasi
                ORDER BY i.id_info DESC ");
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {    

            $def = "foto_sumber/foto-default/no-photo.png";
            $nama = "Belum Ada Foto";

            echo "
            <tr>
                <td class='essential persist'>$no</td>                
                <td class='essential persist'>$r[nama_sumber]</td>
                <td class='essential persist'>$r[nama_desa]</td>
                <td class='essential persist'>$r[jaringan_pipa]</td>";
                               
                echo "<td class='essential persist'>
                    <div align='center'>
                        <a title = 'Lihat Foto Jaringan $r[jaringan_pipa]' href=?halaman=m_foto&aksi=view_foto&id=$r[id_info]>
                        <i class='icon-eye-open'></i></a>&nbsp;&nbsp;
                        <a title = 'Edit Foto Jaringan $r[jaringan_pipa]' href=?halaman=m_foto&aksi=update_foto&id=$r[id_info]>
                        <i class='icon-edit'></i></a>&nbsp;&nbsp;
                        <a title = 'Hapus Foto Jaringan $r[jaringan_pipa]' href=$aksi?halaman=m_foto&proses=del_foto&id=$r[id_info] disabled='disabled'>
                        <i class='icon-remove'></i></a>
                    </div>
                </td>
            </tr>
            
            ";
            $no++;
        }

        echo '</tbody></table></div>'; 
        echo "</div>";
        break;

        case "view_foto":
            $m = mysql_fetch_array(mysql_query("SELECT i.jaringan_pipa, i.foto1, i.foto2, i.foto3, i.foto4, s.nama_sumber FROM tbl_informasi_point2 i, tbl_sumber s WHERE s.id_sumber=i.id_sumber AND id_info = '$_GET[id]'"));
            $oke = "$m[jaringan_pipa]";
            
            echo "
            <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> View Foto $oke</h3></div>        
            <div class='isi-form'>
            <h4 class='box-judulform'>Form View $oke</h4>";

            echo "<div class='box-form2'>";
                echo "<table>
                    <thead>                        
                            <th width=25%></th>
                            <th width=25%></th>
                            <th width=25%></th>
                            <th width=25%></th>
                    </thead>
                    <tbody>";
                        $lokasi = "foto_sumber/$m[nama_sumber]/$m[jaringan_pipa]/";
                        $lokasi2 = "<a href='foto_sumber/foto-default/no-photo.png' class='grup' rel='grup1'><img src='foto_sumber/foto-default/no-photo.png' alt='Belum Ada Foto'/></a>";                        
                        echo "<tr>
                            <td>"; 
                            if($m[foto1]=='-'){
                                echo "$lokasi2";
                            }else{                                
                                echo "<a href='$lokasi$m[foto1]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto1]' alt='$m[foto1]'/></a>";
                            }
                            echo"</td>
                            <td>";
                            if($m[foto2]=='-'){
                                echo "$lokasi2";
                            }else{
                                echo "<a href='$lokasi$m[foto2]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto2]' alt='$m[foto2]'/></a>";
                            }
                            echo "</td>
                            <td>"; 
                            if($m[foto3]=='-'){
                                echo "$lokasi2";
                            }else{
                                echo "<a href='$lokasi$m[foto3]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto3]' alt='$m[foto3]'/></a>";
                            }
                            echo"</td>
                            <td>"; 
                            if($m[foto4]=='-'){
                                echo "$lokasi2";
                            }else{
                                echo "<a href='$lokasi$m[foto4]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto4]' alt='$m[foto4]'/></a>";
                            }
                            echo"</td>
                        </tr>";
                    echo "</tbody>
                </table>";
            echo "</div>";
            echo "</div></div>";

        break;


        case "tambahfoto":

        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah $target</h3></div>        
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>";
        echo "
            <div class='box-form2'>            
            <form method='POST' action='$aksi?proses=upload_foto'  enctype = 'multipart/form-data'>
            <table border=0> 
                <thead>
                    <th width=27%></th>
                    <th width=40%></th>                    
                </thead>           
                <tbody>";
                echo " 
                    <tr><td class='essential persist'><div>Sumber Air</div></td><td><select name='sum' id='sum'><option value=0>Pilih Sumber</option>";
                        $f = mysql_query("SELECT id_sumber, nama_sumber FROM tbl_sumber");
                        while ($d = mysql_fetch_array($f)) {
                            echo "<option value='$d[id_sumber]'>$d[nama_sumber]</option>";
                        }
                    echo "</select></td></tr>";
                    
                    echo "<tr><td class='essential persist'><div>Point</div></td><td><select name='po' id='po'><option value=0>Pilih Jaringan</option>";
                    echo "<option>Pilih Dulu Sumber...</option>";
                    echo "</select name='po' id='po'></td></tr>";


                    echo "
                    <tr><td class='essential persist'>Foto 1</td><td><input type=\"file\" name=\"foto1\"></td></tr>
                    <tr><td class='essential persist'>Foto 2</td><td><input type=\"file\" name=\"foto2\"></td></tr>
                    <tr><td class='essential persist'>Foto 3</td><td><input type=\"file\" name=\"foto3\"></td></tr>
                    <tr><td class='essential persist'>Foto 4</td><td><input type=\"file\" name=\"foto4\"></td></tr>                    
                ";
                echo "</tbody>
            </table>
            <h4 class='box-judulform-tombol'>
                    <input type='submit' name='simpan' value='Simpan' class='btn btn-inverse'> 
                <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
                </h4>
            </form>
        </div>
        ";
        echo "</div>";

        break;


        case "update_foto":
            $m = mysql_fetch_array(mysql_query("SELECT i.id_info, i.jaringan_pipa, i.foto1, i.foto2, i.foto3, i.foto4, s.nama_sumber FROM tbl_informasi_point2 i, tbl_sumber s WHERE s.id_sumber=i.id_sumber AND id_info = '$_GET[id]'"));
            $oke = "$m[jaringan_pipa]";
            
            echo "
            <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Edit Foto $oke</h3></div>        
            <div class='isi-form'>
            <h4 class='box-judulform'>Form Edit $oke</h4>";

            echo "<div class='box-form2'>";
                echo "<form method='POST' action='$aksi?proses=edit_foto'  enctype = 'multipart/form-data'>";
                echo "<input type=\"hidden\" name=\"idinfo\" value=\"$m[id_info]\">";
                echo "<table align=center>
                    <thead>                        
                            <th width=25%></th>
                            <th width=25%></th>                            
                    </thead>
                    <tbody>";
                        $ukuran = "style='width: 348px;height: 204px;'";
                        $lokasi = "foto_sumber/$m[nama_sumber]/$m[jaringan_pipa]/";
                        $lokasi2 = "<a href='foto_sumber/foto-default/no-photo.png' class='grup' rel='grup1'><img src='foto_sumber/foto-default/no-photo.png' alt='Belum Ada Foto' $ukuran/></a>
                            <input type='hidden' name='gambar[]' value='-'>
                            ";
                        $file = "<input type=\"file\" name=\"ftupload[]\" style='margin:10px 0px 20px 10px; border: 1px solid #CCC; border-radius: 4px;'>";
                        
                        echo "<tr>
                            <td>"; 
                            if($m[foto1]=='-'){
                                echo "$lokasi2";
                                echo "$file";
                            }else{                                
                                echo "<a href='$lokasi$m[foto1]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto1]' alt='$m[foto1]' $ukuran/></a>
                                <input type='hidden' name='gambar[]' value='$m[foto1]'>";
                                echo "$file";
                            }
                            echo"</td>
                            <td>";
                            if($m[foto2]=='-'){
                                echo "$lokasi2";
                                echo "$file";
                            }else{
                                echo "<a href='$lokasi$m[foto2]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto2]' alt='$m[foto2]' $ukuran/></a>
                                <input type='hidden' name='gambar[]' value='$m[foto2]'>";
                                echo "$file";
                            }
                            echo "</td>";                            
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>"; 
                            if($m[foto3]=='-'){
                                echo "$lokasi2";
                                echo "$file";
                            }else{
                                echo "<a href='$lokasi$m[foto3]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto3]' alt='$m[foto3]' $ukuran/></a>
                                <input type='hidden' name='gambar[]' value='$m[foto3]'>";
                                echo "$file";
                            }
                            echo"</td>
                            <td>"; 
                            if($m[foto4]=='-'){
                                echo "$lokasi2";
                                echo "$file";
                            }else{
                                echo "<a href='$lokasi$m[foto4]' class='grup' rel='grup1'>
                                <img src='$lokasi$m[foto4]' alt='$m[foto4]' $ukuran/></a>
                                <input type='hidden' name='gambar[]' value='$m[foto4]'>";
                                echo "$file";
                            }
                            echo"</td>";
                        echo "</tr>";
                    echo "</tbody>
                </table>
                <h4 class='box-judulform-tombol'>
                    <input type='submit' name='simpan' value='Simpan' class='btn btn-inverse'> 
                <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
                </h4>
            </form>";            
            echo "</div></div>";
        break;
}


?>

<script type="text/javascript">
    $(document).ready(function() {
        
        $('#sum').change(function(){
            var sumb= $('#sum').val();            
            //alert(sumb);
            $.ajax({
                url: "modul/mod_foto/proses_info.php",
                data: "sum= "+sumb,
                success: function(data){
                    $('#po').html(data);                    
                }
            });
        });

        
    });



</script>