<?php
  
$aksi = "modul/mod_users/aksi_user.php";
$target = "User";
$style = "style='height:28px; width:220px'";


switch ($_GET['aksi']) {
    default:
        //tabel lokasi        
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>        
        <div class='isi-form'>";

        echo "
            <h4 class='box-judulform'>Tabel $target</h4>

            <div class='box-tb-r'>
                <input type=button value='Tambah $target' onclick=\"window.location.href='?halaman=user&aksi=add_user';\" class='btn btn-inverse'>
            </div>";
                           
        echo "<div class='box-tabel'>
        <table  class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead align='center'>
        <tr>
        <th class='essential persist'>No</th>
        <th class='essential persist'>Nama Lengkap</th>                
        <th class='essential persist'>Username</th>
        <th class='essential persist'>Level Akses</th>        
        <th class='essential persist'>Status</th>
        <th class='essential persist' width='46px'>Aksi</th>
        </tr>
        </thead><tbody>";
         

        $u = "SELECT * FROM users ORDER BY id_user DESC";        
        $tampil = mysql_query($u);
        
        $no = 1;        
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$r[nama_lengkap]</td>
                <td>$r[username]</td>
                <td>$r[level]</td>";        
                if($r['status']=='Y'){
                    echo "<td style='text-align:center;'><a href='$aksi?aksi=ubahstatus&id=$r[id_user]'><i class='icon-ok-sign' title='Klik Untuk Menonaktifklan User $r[nama_lengkap]'></i></a></td>";
                }else{
                    echo "<td style='text-align:center;'><a href='$aksi?aksi=ubahstatus&id=$r[id_user]'><i class='icon-remove-sign' title='Klik Untuk Mengaktifklan User $r[nama_lengkap]'></i></a></td>";
                }
                echo "<td>
                    <div align='center'>
                        <a title = 'Edit' href=?halaman=user&aksi=update_user&id=$r[id_user]>
                        <i class='icon-edit'></i></a>                         
                    </div>
                </td>
            </tr>";
            $no++;
            }
               

        echo "</tbody></table></div>";         


        echo "</div>";       
        break;

    

    case 'add_user':
       echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>
        ";

        echo "<div class='box-form2'>
            <form method='POST' action='$aksi?proses=add_user'>
            <table> 
                <thead>                    
                    <th width=27%></th>
                    <th width=20%></th>
                    <th width=20%></th>                              
                    <th width=27%></th>                    
                </thead>           
                <tbody>";

                echo "
                    <tr><td>Nama Lengkap</td><td><input type=\"text\" name=\"nl\"></td></tr>
                    <tr><td>Username</td><td><input type=\"text\" name=\"us\"></td></tr>
                    <tr><td>Password</td><td><input type=\"text\" name=\"ps\"></td></tr>
                    <tr><td>Level</td><td>
                        <select name=\"level\">
                            <option value=\"0\">Pilih Level</option>
                            <option value=\"admin\">Administrator</option>
                            <option value=\"petugas\">Petugas</option>
                            <option value=\"user\">User</option>                            
                        </select>
                    </td></tr> 

                    <tr><td>Status</td><td>
                        <select name=\"st\">
                            <option value=\"0\">Pilih Status</option>
                            <option value=\"Y\">Aktif</option>
                            <option value=\"N\">Tidak Aktif</option>
                        </select>
                    </td></tr>
                ";
						
                echo " 
                </tbody>
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



    case 'update_user':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Edit Data $target</h3></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";   
        echo "
         <div class='box-form2'>
            <form method='POST' action='$aksi?proses=update_user'>
            <input type='hidden' name='iduser' value='$_GET[id]'>         
            <table> 
                <thead>                    
                    <th width=27%></th>
                    <th width=20%></th>
                    <th width=20%></th>                              
                    <th width=27%></th> 
                </thead>           
                <tbody>";

                $k= mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id_user = '$_GET[id]'")); 
                $w = "style='width:272px;'";
                echo "                    
                    <tr><td>Nama Lengkap</td><td><input type=\"text\" name=\"nl\" value='$k[nama_lengkap]' $w></td></tr>
                    <tr><td>Username</td><td><input type=\"text\" name=\"us\" value='$k[username]' $w></td></tr>
                    <tr><td>Password</td><td><input type=\"text\" name=\"ps\" placeholder='Kosongi bila tidak ingin merubah password'  $w></td></tr>
                    <tr><td>Level</td><td>
                        <select name=\"level\" $w>
                            <option value=\"0\">Pilih Level</option>
                            <option value=\"admin\">Administrator</option>
                            <option value=\"petugas\">Petugas</option>
                            <option value=\"user\">User</option>                            
                        </select>
                    </td></tr>    

                    <tr><td>Status</td><td>
                        <select name=\"st\" $w>
                            <option value=\"0\">Pilih Status</option>
                            <option value=\"Y\">Aktif</option>
                            <option value=\"N\">Tidak Aktif</option>
                        </select>
                    </td></tr>
                ";
                
                echo "                                
                </tbody>
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
}


?>
