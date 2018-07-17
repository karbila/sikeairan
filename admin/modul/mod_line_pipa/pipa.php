<?php  

$aksi = "modul/mod_line_pipa/aksi_pipa.php";
$target = "Line Pipa";

switch ($_GET['aksi']) {
    default:
        //tabel lokasi
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>
        <div id='peta'></div>
        <div class='isi-form'>";

        echo "
        <h4 class='box-judulform'>Tabel $target</h4>
        
        <div class='box-tb-r'>
        <input style='margin-left:0px' type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_linepipa&aksi=add_pipa';\" class='btn btn-inverse'>
        </div>      
        

        <div class='box-tabel'>    
        <table class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead>
        <tr>
        <th class='essential persist'>No</th>
        <th class='essential persist'>Sumber</th>
        <th class='essential persist'>Kecamatan</th>
        <th class='essential persist'>X1</th>
        <th class='essential persist'>Y1</th>
        <th class='essential persist'>X2</th>
        <th class='essential persist'>Y2</th>
        <th class='essential persist'>X3</th>
        <th class='essential persist'>Y3</th>
        <th class='essential persist'><div align='center'>Aksi</div></th> 
        </tr>
        </thead><tbody>";
        $tampil = mysql_query("SELECT p . * , l.*, s.*, r.*
                    FROM tbl_line_pipa p, tbl_lokasi l, tbl_regional r, tbl_sumber s
                    WHERE l.id_lokasi = s.id_lokasi AND r.id_regional = l.id_regional 
                    AND s.id_sumber = p.id_sumber
                    ORDER BY p.id_line_pipa DESC;
                    ");
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$r[nama_sumber]</td>
                <td>$r[nama_kecamatan]</td>
                <td>$r[x1]</td>
                <td>$r[y1]</td>                
                <td>$r[x2]</td>
                <td>$r[y2]</td>
                <td>$r[x3]</td>
                <td>$r[y3]</td>
                <td>
                    <div align='center'>
                        <a title = 'Edit' href=?halaman=m_linepipa&aksi=update_pipa&id=$r[id_line_pipa]><i class='icon-edit'></i></a>
                        <a title = 'Hapus' href=$aksi?halaman=m_linepipa&proses=del_pipa&id=$r[id_line_pipa]><i class='icon-remove'></i></a>
                    </div>
                </td>
            </tr>
            
            ";
            $no++;
        }

        echo '</tbody></table></div>'; 

        echo '</div>';
        break;

    

    case 'add_pipa':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>";

        echo "<div class='box-form2'>
            <form method='POST' action='$aksi?proses=add_pipa'>
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                echo "<tr><td>Sumber</td><td>";
                echo "<select name='sumber'>
                    <option value='0'>Pilih Sumber</option>";
                                
                    $combo = mysql_query("SELECT id_sumber, nama_sumber FROM tbl_sumber");
                    while ($data = mysql_fetch_array($combo)) {
                        echo "<option value='$data[id_sumber]'>$data[nama_sumber]</option>";
                    }
                echo "</select>";
                echo "</td></tr>";
                echo "
                <tr><td>X1 </td><td><input name='x1' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y1 </td><td><input name='y1' type=text id=y size=30 style=' height:25px'></td></tr>
                <tr><td>X2 </td><td><input name='x2' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y2 </td><td><input name='y2' type=text id=y size=30 style=' height:25px'></td></tr>
                <tr><td>X3 </td><td><input name='x3' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y3 </td><td><input name='y3' type=text id=y size=30 style=' height:25px'></td></tr>
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





        case 'update_pipa':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";

       echo "         
        <div class='box-form2'>
            <form method='POST' action='$aksi?proses=update_pipa'>
            <input type=\"hidden\" name=\"idpipa\" value=\"$_GET[id]\">
            <table> 
                <thead>
                    <th width=27%></th>
                    <th width=60%></th>          
                </thead>           
                <tbody>";
                $upp = mysql_fetch_array(mysql_query("SELECT p . * , s.id_sumber, s.nama_sumber
                    FROM tbl_line_pipa p, tbl_sumber s
                    WHERE  s.id_sumber = p.id_sumber AND p.id_line_pipa = '$_GET[id]'"));
                echo "<tr><td>Sumber</td><td>";
                echo "<select name='sumber'>
                    <option value='0'>Pilih Sumber</option>";                                
                    $combo_des = mysql_query("SELECT id_sumber, nama_sumber FROM tbl_sumber");
                    while ($datades = mysql_fetch_array($combo_des)) {
                        if($upp['id_sumber']==$datades['id_sumber']){
                            echo "<option value='$datades[id_sumber]' selected='selected'>$datades[nama_sumber]</option>";
                        }else{
                            echo "<option value='$datades[id_sumber]'>$datades[nama_sumber]</option>";    
                        }
                        
                    }
                echo "</select>";
                echo "</td></tr>";
                echo "
                <tr><td>X1 </td><td><input name='x1' value='$upp[x1]' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y1 </td><td><input name='y1' value='$upp[y1]' type=text id=y size=30 style=' height:25px'></td></tr>
                <tr><td>X2 </td><td><input name='x2' value='$upp[x2]' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y2 </td><td><input name='y2' value='$upp[y2]' type=text id=y size=30 style=' height:25px'></td></tr>
                <tr><td>X3 </td><td><input name='x3' value='$upp[x3]' type=text id=x size=30 style=' height:25px'></td></tr>
                <tr><td>Y3 </td><td><input name='y3' value='$upp[y3]' type=text id=y size=30 style=' height:25px'></td></tr>                
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