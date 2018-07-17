<?php  


$aksi = "modul/mod_regional/aksi_regional.php";
$target = "Regional (Kecamatan)";

switch ($_GET['aksi']) {
    default:
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>
        <div id='peta'></div>
        <div class='isi-form'>";

        echo "
        <h4 class='box-judulform'>Tabel $target</h4>
        <div class='box-tb-r'>
        <input style='margin-left:0px' type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_regional&aksi=add_regional';\" class='btn btn-inverse'>      
        </div>

        <div class='box-tabel'>
        <table class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead>
        <tr>
        <th class='essential persist'>No</th>        
        <th class='essential persist'>Kecamatan</th>
        <th class='essential persist'>Latitude</th>
        <th class='essential persist'>Longitude</th>        
        <th class='essential persist'>Aksi</th> 
        </tr>
        </thead><tbody>";
        $tampil = mysql_query("SELECT * FROM tbl_regional ORDER BY id_regional DESC");
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>                
                <td>$r[nama_kecamatan]</td>
                <td>$r[lat]</div></td>
                <td>$r[lng]</div></td>                
                <td> 
                <div align='center'>                   
                        <a title = 'Edit' href=?halaman=m_regional&aksi=update_regional&id=$r[id_regional]><i class='icon-edit'></i></a>
                        <a title = 'Hapus' href=$aksi?halaman=m_regional&proses=del_regional&id=$r[id_regional]><i class='icon-remove'></i></a>                    
                </div>
                </td>
            </tr>            
            ";
            $no++;
        }

        echo '</tbody></table></div>';  
        echo "</div>";      
        break;

    

    case 'add_regional':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>";
        
        echo "
        <div class='box-form2'>
            <form method='POST' action='$aksi?proses=add_regional'>
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                echo "<tr><td>Nama Kecamatan</td><td><input type=\"text\" name=\"nk\" style='height:25px'></td></tr>";
                echo "</td></tr>";
                echo "                
                <tr><td>Latitude</td><td><input name='lt' type=text id=x size=30 style='height:25px'></td></tr>
                <tr><td>Longitude</td><td><input name='lg' type=text id=y size=30 style='height:25px'></td></tr>
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



        case 'update_regional':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Edit Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";

       echo "<div class='box-form2'>
            <form method='POST' action='$aksi?proses=update_regional'>
            <input type=\"hidden\" name=\"idreg\" value=\"$_GET[id]\">
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                $upp = mysql_fetch_array(mysql_query("SELECT * FROM tbl_regional WHERE id_regional = '$_GET[id]'"));
                echo "<tr><td>Nama Kecamatan</td><td><input type=\"text\" name=\"nk\" value=\"$upp[nama_kecamatan]\" style=' height:25px'></td></tr>";                                
                echo "                
                <tr><td>Latitude </td><td><input name='lt' value='$upp[lat]' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Longitude </td><td><input name='lg' value='$upp[lng]' type=text id=y size=30 style=' height:25px'></td></tr>                
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