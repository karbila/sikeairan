<?php  

$aksi = "modul/mod_sumber_air/aksi_sumberair.php";
$target = "Sumber Air";

switch ($_GET['aksi']) {
    default:
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>
        <div id='peta'></div>
        <div class='isi-form'>";

        echo "
        <h4 class='box-judulform'>Tabel $target</h4>
        <div class='box-tb-r'>
        <input style='margin-left:0px' type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_sumberair&aksi=add_sumberair';\" class='btn btn-inverse'>      
        </div>

        <div class='box-tabel'>       
        <table class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead>
        <tr>
        <th class='essential persist'>No</th>        
        <th class='essential persist'>Nama Sumber</th>
        <th class='essential persist'>Nama Desa</th>
        <th class='essential persist'>Latitude</th>
        <th class='essential persist'>Longitude</th>        
        <th class='essential persist'><div align='center'>Aksi</div></th> 
        </tr>
        </thead><tbody>";
        $tampil = mysql_query("SELECT s.*, l.nama_desa FROM tbl_sumber s, tbl_lokasi l WHERE l.id_lokasi=s.id_lokasi ORDER BY s.id_sumber DESC");
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>                
                <td>$r[nama_sumber]</td>
                <td>$r[nama_desa]</td>
                <td>$r[lat]</td>
                <td>$r[lng]</td>                
                <td>
                    <div align='center'>
                        <a title = 'Edit' href=?halaman=m_sumberair&aksi=update_sumberair&id=$r[id_sumber]><i class='icon-edit'></i></a>
                        <a title = 'Hapus' href=$aksi?halaman=m_sumberair&proses=del_sumberair&id=$r[id_sumber]><i class='icon-remove'></i></a>
                    </div>
                </td>
            </tr>
            
            ";
            $no++;
        }

        echo '</tbody></table></div>'; 
        echo "</div>";       
        break;

    

    case 'add_sumberair':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>";

        echo "
        <div class='box-form2'>
            <form method='POST' action='$aksi?proses=add_sumberair'>
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                echo "<tr><td>Nama Sumber</td><td><input type=\"text\" name=\"ns\" style='height:25px'></td></tr>";
                echo "<tr><td>Nama Desa</td><td><select name='desa'>
                    <option value='0'>Pilih Desa</option>                    
                ";
                $combo = mysql_query("SELECT id_lokasi, nama_desa FROM tbl_lokasi ORDER BY nama_desa ASC");
                while ($data=mysql_fetch_array($combo)) {
                    echo "<option value='$data[id_lokasi]'>$data[nama_desa]</option>";
                }
                echo "</select></td></tr>";
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



        case 'update_sumberair':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";

        echo "<div class='box-form2'>
            <form method='POST' action='$aksi?proses=update_sumberair'>
            <input type=\"hidden\" name=\"idsumber\" value=\"$_GET[id]\">
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                $upp = mysql_fetch_array(mysql_query("SELECT s.*, l.id_lokasi, l.nama_desa FROM tbl_sumber s, tbl_lokasi l WHERE l.id_lokasi=s.id_lokasi AND s.id_sumber = '$_GET[id]'"));
                echo "<tr><td>Nama Sumber</td><td><input type=\"text\" name=\"ns\" value='$upp[nama_sumber]' style='height:25px'></td></tr>";
                echo "<tr><td>Nama Desa</td><td><select name='desa'>
                    <option value='0'>Pilih Desa</option>                    
                ";
                $combo = mysql_query("SELECT id_lokasi, nama_desa FROM tbl_lokasi ORDER BY nama_desa ASC");
                while ($data=mysql_fetch_array($combo)) {
                    if($upp['id_lokasi']==$data['id_lokasi']){
                        echo "<option value='$data[id_lokasi]' selected='selected'>$data[nama_desa]</option>";
                    }else{  
                        echo "<option value='$data[id_lokasi]'>$data[nama_desa]</option>";    
                    }
                    
                }
                echo "</select></td></tr>";
                echo "                
                <tr><td>Latitude</td><td><input name='lt' type=text id=x value='$upp[lat]' size=30 style='height:25px'></td></tr>
                <tr><td>Longitude</td><td><input name='lg' type=text id=y value='$upp[lng]' size=30 style='height:25px'></td></tr>               
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