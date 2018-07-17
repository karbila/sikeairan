<?php  

$aksi = "modul/mod_peta_off/aksi_peta_off.php";
$target = "Foto Peta Offline";

switch ($_GET['aksi']) {
    default:        
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>        
        <div class='isi-form'>";

        echo "
        <h4 class='box-judulform'>Tabel $target</h4>
        <div class='box-tb-r'>
        <input style='margin-left:0px' type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_peta_off&aksi=tambahpeta';\" class='btn btn-inverse'>      
        </div>

        <div class='box-tabel'>       
        <table class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead>
        <tr>
        <th class='essential persist' width=10%>No</th>        
        <th class='essential persist'>Nama Sumber</th>        
        <th class='essential persist' width=15%><div align='center'>Aksi</div></th> 
        </tr>
        </thead><tbody>";
        $tampil = mysql_query("SELECT nama_sumber, id_sumber FROM tbl_sumber ORDER BY id_sumber ASC");
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {
            $g = mysql_query("SELECT p . * , s.nama_sumber
                FROM tbl_peta_off p, tbl_sumber s
                WHERE s.id_sumber = p.id_sumber
                AND s.id_sumber =  '$r[id_sumber]'");            
            $jums = mysql_num_rows($g);
            echo "
            <tr id=''>
                <td>$no</td>                
                <td>$r[nama_sumber] - <strong style=\"color: rgb(255, 3, 3);\">$jums</strong> Foto</td>
                <td><div align='center'>
                    <a title = 'Lihat Foto Peta Offline pada $r[nama_sumber]' 
                    href=?halaman=m_peta_off&aksi=view_detail&id=$r[id_sumber]><i class='icon-eye-open'></i></a>
                    &nbsp;&nbsp;<a title = 'Edit Foto Peta Offline pada $r[nama_sumber]' 
                    href=?halaman=m_peta_off&aksi=edit_peta&id=$r[id_sumber]><i class='icon-edit'></i></a>
                    &nbsp;&nbsp;
                    <button><a title = 'Hapus Semua Foto Peta Offline pada $r[nama_sumber]' 
                    href=$aksi?proses=del_foto&id=$r[id_sumber] onclick=hapus();><i class='icon-remove'></i></a></button>
                    </div>
                </td>                
            </tr>
            ";
            $no++;
        }
        echo '</tbody></table></div>'; 
        echo "</div>";
        ?>

        <script type='text/javascript'>
            function hapus(){
                a = confirm('apakah anda ingin menghapusnya?');
                if(a == 1){
                    alert('hapus');
                }else{
                    //alert('gagal hapus');
                    document.location.href='index.php?halaman=m_peta_off';
                }
            }
        </script>

        <?php
        break;

        case "view_detail":       
        $a = mysql_query("SELECT nama_sumber, id_sumber FROM tbl_sumber WHERE id_sumber = '$_GET[id]'");
        $m = mysql_fetch_array($a);                
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Peta Offline $m[nama_sumber]</h3></div>        
        <div class='isi-form'>";
            echo "
            <h4 class='box-judulform'>Peta Offline $m[nama_sumber]</h4>        
            <div class='box-tabel'>";
                     $a = mysql_query("SELECT p.* FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber='$_GET[id]'");
                     $row = mysql_num_rows($a);                     
                    $cols = 3;                
                    if($row > 0){                        
                        echo "<table><tr>";
                        $cnt = 0;
                        while ($w = mysql_fetch_array($a)) {
                          $lokasi = "foto_peta_offline/$m[nama_sumber]/";
                          if ($cnt >= $cols) {
                            echo "</tr><tr>";
                            $cnt = 0;
                          }
                          $cnt++;                                                    
                          echo "<td align=center valign=top>
                            <a href='$lokasi$w[nama_foto]' rel='grup1' class='grup'>
                                <img src='$lokasi$w[nama_foto]' class='oke'>
                            </a>
                          </td>";
                        }
                        echo "</tr></table><br/>";
                        echo "<div class='alert alert-info'>
                            <a class='close' data-dismiss='alert'>×</a>
                            <strong>Terdapat <span class='font-weigth:bold; color:red;'>$row</span> Peta Offline pada Jaringan $m[nama_sumber]</strong>.
                            </div>
                       ";
                    }else{
                        //echo "gak ada";
                        echo "<div class='alert alert-error'>
                            <a class='close' data-dismiss='alert' href='?halaman=m_peta_off'>×</a>
                            <strong>Maaf Belum Ada Foto Peta Offline pada Sumber ini.<br>Anda dapat mengupload Foto Peta Offline melalui Link ini <a href=\"?halaman=m_peta_off&aksi=tambahpeta\">Upload Foto Peta Offline</a></strong>.
                            </div>
                       ";
                    }
                    echo "</tr></tbody>
                </table>";
            
            echo "</div>

        </div>";
        break;

        case "edit_peta":        
         $a = mysql_query("SELECT p.* FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber='$_GET[id]'");
        $jum = mysql_num_rows($a);                     

        if($jum==0){
            //echo "gak ada";            
            //header("location:?halaman=m_peta_off");
        }elseif($jum>0){
            //echo "ada";
            $t = mysql_fetch_array(mysql_query("SELECT nama_sumber FROM tbl_sumber WHERE id_sumber = '$_GET[id]'"));
            $ns = "Edit Peta Offline $t[nama_sumber]";            

            echo "
            <div id='box-judul'>
                <h3 class='heading'><i class='icon-kanan icon-white'></i>  $ns</h3>
            </div>        
            <div class='isi-form'>
            <h4 class='box-judulform'>Form $ns</h4>";

            echo "<div class='isi-form'>";
                echo "
                    <h4 class='box-judulform'>Peta Offline $t[nama_sumber]</h4>        
                    <div class='box-tabel'>";
                             $a = mysql_query("SELECT p.* FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber='$_GET[id]'");
                             $row = mysql_num_rows($a);                     
                            $cols = 3;                
                            if($row > 0){                        
                                echo "
                                <form method='POST' action='$aksi?proses=edit_foto'  enctype = 'multipart/form-data'>
                                <input type=\"hidden\" name='idsum' value='$_GET[id]'>
                                <table>                                
                                <tr>";
                                $cnt = 0;
                                while ($w = mysql_fetch_array($a)){
                                  $lokasi = "foto_peta_offline/$t[nama_sumber]/";
                                  if ($cnt >= $cols) {
                                    echo "</tr><tr>";
                                    $cnt = 0;
                                  }
                                  $cnt++;                                                    
                                  echo "<td valign=top>
                                    <a href='$lokasi$w[nama_foto]' rel='grup1' class='grup'>
                                        <img src='$lokasi$w[nama_foto]' class='oke3'>
                                        <input type='hidden' name='gambar[]' value='$w[nama_foto]'>
                                    </a>
                                    <input type='file' name='ftupload[]'>
                                  </td>";
                                }
                                echo "</tr></table><br/>";
                                echo "<h4 class='box-judulform-tombol'>                                           
                                <input type='submit' name='submit' value='Simpan' class='btn btn-inverse'>
                               <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
                               </h4>
                               </form>
                               ";
                            }

            echo "</div>";
            echo "</div>";
        }


        
        break;


        case "tambahpeta":
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
                    <th width=30%></th>                    
                </thead>           
                <tbody id=\"tabel\">";
                echo " 
                    <tr><td class='essential persist'><div>Sumber Air</div></td><td><select name='sum' id='sum'><option value=0>Pilih Sumber</option>";
                        $f = mysql_query("SELECT id_sumber, nama_sumber FROM tbl_sumber");
                        while ($d = mysql_fetch_array($f)) {
                            echo "<option value='$d[id_sumber]'>$d[nama_sumber]</option>";
                        }
                    echo "</select></td></tr>";
                                        
                    ?>

                    <script type='text/javascript'>
                        var nomor=0;
                        function tambahInput(){
                            var tabel   =document.getElementById('tabel');
                            var tr      =document.createElement('tr');                            
                            var td1     =document.createElement('td');
                            var td2     =document.createElement('td');
                            

                            var button  =document.createElement('input');
                            var file    =document.createElement('input');
                            var sbmt    =document.getElementById('submit');                            
                            var post    =document.createElement('input');
                            
                            button.setAttribute("type","button");
                            button.setAttribute("value","hapus");
                            button.setAttribute("class", "btn btn-inverse");
                            file.setAttribute("name","photo[]");
                            file.setAttribute("type","file");
                            post.setAttribute("type","submit");
                            post.setAttribute("value","Upload Foto");
                            post.setAttribute("name","upload");
                            post.setAttribute("class", "btn btn-inverse");
                                                        
                            td1.setAttribute("class", "essential persist");
                            td2.setAttribute("class", "essential persist");
                            
                            file.onchange=function(){
                                tambahInput();
                            }
                            
                            button.onclick=function(){
                                hapusInput(tr);
                            }
                            
                            if(nomor==1){
                                sbmt.appendChild(post);
                            }
                            
                            tabel.appendChild(tr);                                                        
                            tr.appendChild(td1);
                            tr.appendChild(td2);                            
                            td1.appendChild(file);
                            td2.appendChild(button);
                            
                            nomor++;
                        }

                        function hapusInput(tr){
                            tr.parentNode.removeChild(tr);
                        }
                    </script>

                    <tr><td class='essential persist'><div style='margin-bottom:10px;margin-top:10px;'><a href="javascript:tambahInput();"><input type='button' value='Tambah Input (Browse)' class='btn btn-inverse'></a></div></td></tr>


                    <?php                    
                echo "</tbody>
            </table>
            <h4 class='box-judulform-tombol'>            
                    <div id=\"submit\">
                    <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
                    </div> 
                    
                </h4>
            </form>
        </div>
        ";
        echo "</div>";

        break;
}


?>

<script type="text/javascript">
//     $(document).ready(function() {
        
//         $('#sum').change(function(){
//             var sumb= $('#sum').val();            
//             //alert(sumb);
//             $.ajax({
//                 url: "modul/mod_foto/proses_info.php",
//                 data: "sum= "+sumb,
//                 success: function(data){
//                     $('#po').html(data);                    
//                 }
//             });
//         });

        
//     });
</script>