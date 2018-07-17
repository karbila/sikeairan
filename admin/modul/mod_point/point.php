<?php  


$aksi = "modul/mod_point/aksi_point.php";
$target = "Point";
$style = "style='height:28px; width:220px'";

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
                <input type=button value='Tambah $target' onclick=\"window.location.href='?halaman=m_point&aksi=add_point';\" class='btn btn-inverse'>
            </div>";
                           
       echo "
            <div id='box-filter'>
            <span>Filter :</span>            
            <select name='a' id='a' onChange=\"MM_jumpMenu('parent',this,0)\">
                <option value='?halaman=m_point'>Pilih Kecamatan</option>";

                $combo_kec = mysql_query("SELECT * FROM tbl_regional");
                while ($datakec = mysql_fetch_array($combo_kec)) {
                    if($_GET['idkec']==$datakec['id_regional']){
                        echo "<option value='?halaman=m_point&idkec=$datakec[id_regional]&lat=$datakec[lat]&lng=$datakec[lng]' selected='selected'>$datakec[nama_kecamatan]</option>";    
                    }else{
                        echo "<option value='?halaman=m_point&idkec=$datakec[id_regional]&lat=$datakec[lat]&lng=$datakec[lng]'>$datakec[nama_kecamatan]</option>";    
                    }
                                    
                }
            echo "</select>
            
            <select name='b' id='b' onChange=\"MM_jumpMenu('parent', this, 0)\">
                <option value='?halaman=m_point'>Pilih Desa</option>";
                if(empty($_GET['idkec'])){
                    echo "<option value='?halaman=m_point'>Pilih Dulu Kecamatan...</option>";
                }else{
                    $desi = mysql_query("SELECT l.*, r.id_regional FROM tbl_lokasi l, tbl_regional r WHERE r.id_regional = l.id_regional AND r.id_regional = '$_GET[idkec]'");                    
                    if(mysql_num_rows($desi)==0){

                        $d = mysql_fetch_array(mysql_query("SELECT nama_kecamatan FROM tbl_regional WHERE id_regional = '$_GET[idkec]'"));
                        echo "<option value='?halaman=m_point'>Desa Tidak Ditemukan di Kecamatan $d[nama_kecamatan]</option>";
                    }else{
                        while ($dtd = mysql_fetch_array($desi)) {
                            if($_GET['iddes']==$dtd['id_lokasi']){
                                echo "<option value='?halaman=m_point&idkec=$dtd[id_regional]&iddes=$dtd[id_lokasi]&lat=$dtd[lat]&lng=$dtd[lng]' selected='selected'>$dtd[nama_desa]</option>";
                            }else{
                                echo "<option value='?halaman=m_point&idkec=$dtd[id_regional]&iddes=$dtd[id_lokasi]&lat=$dtd[lat]&lng=$dtd[lng]'>$dtd[nama_desa]</option>";
                            }                            
                        }    
                    }
                    
                }

            //perintah onChange=\"MM_jumpMenu('parent', this, 0)\" harus diapit doublecode ("")
            echo "</select>
            
            <select name='c' id='c' onChange=\"MM_jumpMenu('parent', this, 0)\">
                <option value='?halaman=m_point'>Pilih Sumber</option>";

                if(empty($_GET['iddes'])){
                    echo "<option value='?halaman=m_point'>Pilih Dulu Desa...</option>";
                }else{
                    $sumbi = mysql_query("SELECT s . * , l.id_lokasi, r.id_regional
                                FROM tbl_sumber s, tbl_lokasi l, tbl_regional r
                                WHERE l.id_lokasi = s.id_lokasi
                                AND l.id_lokasi =  '$_GET[iddes]'");
                    if(mysql_num_rows($sumbi)==0){
                        $e = mysql_fetch_array(mysql_query("SELECT nama_desa FROM tbl_lokasi WHERE id_lokasi = '$_GET[iddes]' "));
                        echo "<option value='?halaman=m_point>Tidak Ada sumber di Desa $e[nama_desa]</option>";
                    }else{
                        while ($f=mysql_fetch_array($sumbi)) {
                            if($_GET['idsumb']==$f['id_sumber']){
                                echo "<option value='?halaman=m_point&idkec=$f[id_regional]&iddes=$f[id_lokasi]&idsumb=$f[id_sumber]&lat=$f[lat]&lng=$f[lng]' selected='selected'>$f[nama_sumber]</option>";  
                            }else{
                                echo "<option value='?halaman=m_point&idkec=$f[id_regional]&iddes=$f[id_lokasi]&idsumb=$f[id_sumber]&lat=$f[lat]&lng=$f[lng]'>$f[nama_sumber]</option>";
                            }
                            
                        }
                    }
                }
            
            echo "</select>
        </div>";


        $point = "SELECT p.*, l.nama_desa, s.nama_sumber, r.nama_kecamatan 
                  FROM tbl_lokasi l, tbl_regional r, tbl_sumber s, tbl_informasi_point2 p 
                  WHERE l.id_lokasi = p.id_lokasi 
                  AND s.id_sumber = p.id_sumber 
                  AND r.id_regional = l.id_regional
                  AND l.id_lokasi = s.id_lokasi" ;

        $x = "ORDER BY p.id_info DESC";

        if(!empty($_GET['idkec']) && empty($_GET['iddes']) && empty($_GET['idsumb'])){
            $point .= " AND r.id_regional = $_GET[idkec] $x";
            //echo "1";
        }elseif(!empty($_GET['iddes']) && !empty($_GET['idkec']) && empty($_GET['idsumb'])){
            $point .= " AND l.id_lokasi = $_GET[iddes] $x";
            //echo "2";
        }elseif(!empty($_GET['idsumb']) && !empty($_GET['iddes']) && !empty($_GET['idkec'])){
            $point .= " AND s.id_sumber = $_GET[idsumb] $x";
            //echo "3";
        }else{
            $point = $point." ".$x;
            //echo "4";
            
        }

        $tampil = mysql_query($point);

        //echo "<br>$point";
        echo "<div class='box-tabel'>
        <table  class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead align='center'>
        <tr>
        <th class='essential persist'>No</th>
        <th class='essential persist'>Nama Desa</th>        
        <th class='essential persist'>Sumber</th>
        <th class='essential persist'>Jaringan Pipa</th>
        <th class='essential persist'>Diameter Pipa</th>
        <th class='essential persist'>Jenis Pipa</th>
        <th class='essential persist'>Panjang Pipa</th>
        <th class='essential persist'>Debit Air/ Detik</th>
        <th class='essential persist'>Koordinat</th>
        <th class='essential persist'>Tahun</th>
        <th class='essential persist'>Kondisi</th>
        <th class='essential persist' width='46px'>Aksi</th>
        </tr>
        </thead><tbody>";        
        $no = 1;
        if(mysql_num_rows($tampil)==0){                  
            if(!empty($_GET['idkec'])){
                $d = mysql_fetch_array(mysql_query("SELECT nama_kecamatan FROM tbl_regional WHERE id_regional = '$_GET[idkec]'"));
                echo "<tr><td colspan=5 style='text-align:center;'>Tidak Ada Data di <strong>$d[nama_kecamatan]</strong></td></tr>";    
            }elseif(!empty($_GET['iddes'])){
                $d = mysql_fetch_array(mysql_query("SELECT nama_desa FROM tbl_lokasi WHERE id_lokasi = '$_GET[iddes]'"));
                echo "<tr><td colspan=5 style='text-align:center;'>Tidak Ada Data di <strong>$d[nama_desa]</strong></td></tr>";
            }elseif(!empty($_GET['idsumb'])){
                $d = mysql_fetch_array(mysql_query("SELECT nama_sumber FROM tbl_sumber WHERE id_sumber = '$_GET[idsumb]'"));
                echo "<tr><td colspan=5 style='text-align:center;'>Tidak Ada Data di <strong>$d[nama_sumber]</strong></td></tr>";
            }
                
        }else{
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$r[nama_desa]</td>
                <td>$r[nama_sumber]</td>
                <td>$r[jaringan_pipa]</td>
                <td>$r[diameter_pipa]</td>
                <td>$r[jenis_pipa]</td>
                <td>$r[panjang_pipa]</td>
                <td>$r[debit_air]</td>
                <td>Lat: <span class='ket'>$r[lat]</span><br>Long: <span class='ket'>$r[lng]</span></td>
                <td>$r[thn_pemasangan]</td>
                <td>$r[kondisi_pipa]</td>
                <td>
                    <div align='center'>
                        <a title = 'Edit' href=?halaman=m_point&aksi=update_point&id=$r[id_info]>
                        <i class='icon-edit'></i></a> 
                        <a title = 'Hapus' href=$aksi?halaman=m_point&proses=del_point&id=$r[id_info]>
                        <i class='icon-remove'></i></a>
                    </div>
                </td>
            </tr>";
            $no++;
            }
        }        

        echo "</tbody></table></div>";         


        echo "</div>";       
        break;

    

    case 'add_point':
       echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah Point</h4>
        ";

        echo "<div class='box-form2'>
            <form method='POST' action='$aksi?proses=add_point'>
            <table> 
                <thead>                    
                    <th width=15%></th>
                    <th width=20%></th>
                    <th width=5%></th>                              
                    <th width=15%></th>
                    <th width=20%></th>
                </thead>           
                <tbody>";

                echo "<tr><td>Nama Kecamatan</td><td>
                <select name='kec' id='kec'>
                    <option value='0'>Pilih Kecamatan</option>";

                    $combo_kec = mysql_query("SELECT id_regional, nama_kecamatan FROM tbl_regional");
                    while ($datakec = mysql_fetch_array($combo_kec)) {
                        echo "<option value='$datakec[id_regional]'>$datakec[nama_kecamatan]</option>";
                    }
                    
                echo "</select>
                </td>
                <td><a href='?halaman=m_regional&aksi=add_regional' class='icon-plus-sign' style='margin-left:7px; margin-bottom:8px;'></a></td><td>Debit Air</td><td><input type=\"text\" name=\"da\" $style></td></tr>";                
                echo "<tr><td>Nama Desa</td><td>";
                echo "<select name='desa' id='des'>
                    <option value='0'>Pilih Desa</option><option value='01'>Pilih Kecamatan Dulu ...</option>";
                echo "</select>";
                
                echo "</td><td><a href='?halaman=m_lokasi&aksi=add_lokasi' class='icon-plus-sign' style='margin-left:7px; margin-bottom:8px;'></td><td>Latitude</td><td><input type=\"text\" name=\"lt\" $style></td></tr>";
                echo "<tr><td>Nama Sumber</td>";
                echo "<td><select name='sum' id='sum'>
                    <option value='0'>Pilih Sumber</option><option value='01'>Pilih Desa dulu...</option>";

                    
                echo "</select></td><td><a href='?halaman=m_sumberair&aksi=add_sumberair' class='icon-plus-sign' style='margin-left:7px; margin-bottom:8px;'></td>";
                echo "<td>Longitude</td><td><input type=\"text\" name=\"lg\" $style></td></tr>";
               
                echo "<tr><td>Jaringan Pipa</td><td><input type=\"text\" id='x' name=\"jp\" $style></td><td>&nbsp;</td><td>Tahun Pemasangan</td><td>";

                echo "<select name='tp'>";
                    $t = date('Y');
                    $batas = $t - 50; 
                    echo "<option value='0'>Pilih Tahun ($t - $batas)</option>";                    
                    for ($i=$t; $i > $batas ; $i--) { 
                        echo "<option value='$i'>$i</option>";
                    }
                echo "</select>";



                echo "</td></tr>";
                echo "<tr><td>Diameter Pipa</td><td><input type=\"text\" id='y' name=\"dp\" $style></td><td>&nbsp;</td><td>Kondisi Pipa</td>";
                echo "<td>
                <select name='kp'>
                    <option value='-'>Pilih Kondisi</option>
                    <option value='Baik'>Baik</option> 
                    <option value='Kurang Baik'>Kurang Baik</option> 
                    <option value='Rusak'>Rusak</option>                    
                </select>
                </td>";
                echo "</tr>";
                echo "<tr><td>Jenis Pipa</td><td>
                <input type=\"text\" name=\"jp2\" $style>
                </td><td>&nbsp;</td><td>Kondisi Bangungan</td>
				        <td>
					     <select name='kb'>
                    <option value='-'>Pilih Kondisi</option>
                    <option value='Baik'>Baik</option> 
                    <option value='Kurang Baik'>Kurang Baik</option> 
                    <option value='Rusak'>Rusak</option>                    
                    </select>
				      </td></tr>";
                echo "<tr><td>Panjang Pipa</td><td><input type='text' name='pp' $style></td><td>&nbsp;</td>
                <td>Elevasi</td><td><input type=\"text\" name=\"el\" $style></td></tr>";

                echo "<tr><td colspan='5' style='padding-top:10px;'>Keterangan</td></tr>";
                echo "<tr><td colspan='5'><textarea name='ket'  style='width:845px; height:62px; '></textarea>
                </td></tr>";
						
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



    case 'update_point':
        echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Edit Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";   
        echo "
         <div class='box-form2'>
            <form method='POST' action='$aksi?proses=update_point'>
            <input type='hidden' name='idpoint' value='$_GET[id]'>         
            <table> 
                <thead>                    
                    <th width=15%></th>
                    <th width=20%></th>
                    <th width=5%></th>                              
                    <th width=15%></th>
                    <th width=20%></th>
                </thead>           
                <tbody>";

                $k= mysql_fetch_array(mysql_query("SELECT p.*, r.id_regional, r.nama_kecamatan FROM tbl_lokasi l, tbl_informasi_point2 p, tbl_regional r WHERE l.id_lokasi = p.id_lokasi AND r.id_regional = l.id_regional AND p.id_info = '$_GET[id]'")); 

                echo "<tr><td>Nama Kecamatan</td><td>
                <select name='kec' id='kec'>
                    <option value='0'>Pilih Kecamatan</option>";

                    $combo_kec = mysql_query("SELECT id_regional, nama_kecamatan FROM tbl_regional");
                    while ($datakec = mysql_fetch_array($combo_kec)) {
                        if($k['id_regional']==$datakec['id_regional']){
                            echo "<option value='$datakec[id_regional]' selected='selected'>$datakec[nama_kecamatan]</option>";
                        }else{
                            echo "<option value='$datakec[id_regional]'>$datakec[nama_kecamatan]</option>";
                        }
                    }
                    
                echo "</select>
                </td><td>&nbsp;</td><td>Debit Air</td><td><input type=\"text\" name=\"da\" $style value='$k[debit_air]'></td></tr>";                
                echo "<tr><td>Nama Desa</td><td>";
                echo "<select name='desa' id='des'>
                    <option value='0'>Pilih Desa</option><option value='01'>Pilih Kecamatan Dulu ...</option>";
                echo "</select>";
                
                echo "</td><td>&nbsp;</td><td>Latitude</td><td><input type=\"text\" name=\"lt\" $style value='$k[lat]'></td></tr>";
                echo "<tr><td>Nama Sumber</td>";
                echo "<td><select name='sum' id='sum'>
                    <option value='0'>Pilih Sumber</option><option value='01'>Pilih Desa dulu...</option>";

                    
                echo "</select></td><td>&nbsp;</td>";
                echo "<td>Longitude</td><td><input type=\"text\" name=\"lg\" $style value='$k[lng]'></td></tr>";
               
                echo "<tr><td>Jaringan Pipa</td><td><input type=\"text\" id='x' name=\"jp\" $style value='$k[jaringan_pipa]'></td><td>&nbsp;</td><td>Tahun Pemasangan</td><td>";

                echo "<select name='tp'>";
                    $t = date('Y');
                    $batas = $t - 50; 
                    echo "<option value='0'>Pilih Tahun ($t - $batas)</option>";                    
                    for ($i=$t; $i > $batas ; $i--) { 
                        echo "<option value='$i'>$i</option>";
                    }
                echo "</select>";

                echo "</td></tr>";
                echo "<tr><td>Diameter Pipa</td><td><input type=\"text\" id='y' name=\"dp\" $style value='$k[diameter_pipa]'></td><td>&nbsp;</td><td>Kondisi Pipa</td>";
                echo "<td>
                <select name='kp'>
                    <option value='-'>Pilih Kondisi</option>
                    <option value='Baik'>Baik</option> 
                    <option value='Kurang Baik'>Kurang Baik</option> 
                    <option value='Rusak'>Rusak</option>                    
                </select>
                </td>";

                echo "</tr>";
                echo "<tr><td>Jenis Pipa</td><td>
                <input type=\"text\" name=\"jp2\" $style value='$k[jenis_pipa]'>
                </td><td>&nbsp;</td><td>Kondisi Bangungan</td>
                <td>
                    <select name='kb'>
                    <option value='-'>Pilih Kondisi</option>
                    <option value='Baik'>Baik</option> 
                    <option value='Kurang Baik'>Kurang Baik</option> 
                    <option value='Rusak'>Rusak</option>                    
                    </select>
                </td></tr>";
                echo "<tr><td>Panjang Pipa</td><td><input type='text' name='pp' $style value='$k[panjang_pipa]'></td><td>&nbsp;</td>
                <td>Elevasi</td><td><input type=\"text\" name=\"el\" $style value='$k[elevasi]'></td>
                </tr>";

                echo "<tr><td colspan='5' style='padding-top:10px;'>Keterangan</td></tr>";
                echo "<tr><td colspan='5'><textarea name='ket'  style='width:845px; height:62px; '>$k[keterangan]</textarea>
                </td>                
                </tr>";
                        
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

<script type="text/javascript">
    $(document).ready(function() {
        //kecamatan ->desa
        $('#kec').change(function(){
            var keca = $('#kec').val();            
            //alert(keca);
            $.ajax({
                url: "modul/mod_point/proses_desa.php",
                data: "keca= "+keca,
                success: function(data){
                    $('#des').html(data);
                }
            });
        });

        //desa ->sumber

        $('#des').change(function(){
            var desa = $('#des').val();            
            $.ajax({
                url: "modul/mod_point/proses_sumber.php",
                data: "desa= "+desa,
                success: function(data){
                    $('#sum').html(data);
                }
            });
        });

    });
    //fungsi untuk chage dan efek di url-> 3 objek langsung
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
        eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
        if (restore) selObj.selectedIndex=0;
    }
    
</script>