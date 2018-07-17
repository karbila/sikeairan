<?php  


$aksi = "modul/mod_lokasi/aksi_lokasi.php";
$target = "Lokasi";

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
		<th class='essential persist'>Nama Desa</th>
		<th class='essential persist'>Nama Kecamatan</th>
		<th class='essential persist'>Latitude</th>
		<th class='essential persist'>Longitude</th>
		<th class='essential persist'>Aksi</th>		
        </tr>
        </thead><tbody>";

        $tampil = mysql_query("SELECT l.id_lokasi, l.nama_desa, l.lat, l.lng, r.nama_kecamatan
					FROM tbl_lokasi l, tbl_regional r
					WHERE r.id_regional = l.id_regional
					ORDER BY l.id_lokasi DESC ");
        $no = 1;

        while ($data = mysql_fetch_array($tampil)) {
        	echo "
        	<tr>	
        		<td>$no</td>
        		<td>$data[nama_desa]</td>
        		<td>$data[nama_kecamatan]</td>
        		<td>$data[lat]</td>
        		<td>$data[lng]</td>
        		<td>
        			<div align='center'>
                        <a title = 'Edit' href=?halaman=m_lokasi&aksi=update_lokasi&id=$r[id_lokasi]><i class='icon-edit'></i></a>
                        <a title = 'Hapus' href=$aksi?halaman=m_lokasi&proses=del_lokasi&id=$r[id_lokasi]><i class='icon-remove'></i></a>
                    </div>
        		</td>
        	</tr>	
        	";
        $no++;
        }

        echo '</tbody></table></div>';  
        echo "</div>";     
		break;

	

	case 'add_lokasi':
		echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Tambah Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Tambah $target</h4>";

		echo "
        <div class='box-form2'>
        	<form method='POST' action='$aksi?proses=add_lokasi'>
	        <table> 
	        	<thead>
	        		<th width=27%></th>
	        		<th width=60%></th>          
	        	</thead>           
	            <tbody>
	            	<tr><td>Nama Desa </td><td><input type='text' name='nama_desa' style=' height:25px'></td></tr>";
	            echo "<tr><td>Kecamatan</td><td>";
	            echo "<select name='kecamatan'>
	            	<option value='0'>Pilih Kecamatan</option>";
	            	            
	            	$combo_kec = mysql_query("SELECT id_regional, nama_kecamatan FROM tbl_regional");
	            	while ($datakec = mysql_fetch_array($combo_kec)) {
	            		echo "<option value='$datakec[id_regional]'>$datakec[nama_kecamatan]</option>";
	            	}
	            echo "</select>";
	            echo "</td></tr>";
	            echo "<tr><td>Latitude </td><td><input name='lat' type=text id=x size=30 style=' height:25px'></td></tr>
	            <tr><td>Longitude </td><td><input name='lng' type=text id=y size=30 style=' height:25px'></td></tr>	
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



		case 'update_lokasi':
		echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Edit Data $target</h3></div>
        <div class='nm-input'>Pencarian Peta :</div> <input type='text' class='searchbox' />
        <div id='peta'></div>
        <div class='isi-form'>
        <h4 class='box-judulform'>Form Edit $target</h4>";

    	echo "
        <div class='box-form2'>
        	<form method='POST' action='$aksi?proses=update_lokasi'>
        	<input type='hidden' name='idlok' value='$_GET[id]'>
	        <table> 
	        	<thead>
	        		<th width=27%></th>
	        		<th width=60%></th>          
	        	</thead>           
	            <tbody>";
	            	$update = mysql_query("SELECT l.id_lokasi, l.nama_desa, l.lat, l.lng, r.nama_kecamatan, r.id_regional FROM tbl_lokasi l, tbl_regional r WHERE r.id_regional = l.id_regional AND l.id_lokasi = '$_GET[id]'");
	            	$d = mysql_fetch_array($update);
	            echo "<tr><td>Nama Desa </td><td><input type='text' name='nama_desa' value='$d[nama_desa]' style=' height:25px'></td></tr>";
	            echo "<tr><td>Kecamatan</td><td>";
	            echo "<select name='kecamatan'>
	            	<option value='0'>Pilih Kecamatan</option>";
	            	            
	            	$combo_kec = mysql_query("SELECT id_regional, nama_kecamatan FROM tbl_regional");
	            	while ($datakec = mysql_fetch_array($combo_kec)) {
	            		if($datakec['id_regional']==$d['id_regional']){
	            			echo "<option value='$datakec[id_regional]' selected='selected'>$datakec[nama_kecamatan]</option>";	
	            		}else{
	            			echo "<option value='$datakec[id_regional]'>$datakec[nama_kecamatan]</option>";	
	            		}
	            		
	            	}
	            echo "</select>";
	            echo "</td></tr>";
	            echo "<tr><td>Latitude </td><td><input name='lat' type=text value='$d[lat]' id=x size=30 style=' height:25px'></td></tr>
	            <tr><td>Longitude </td><td><input name='lng' type=text value='$d[lng]' id=y size=30 style=' height:25px'></td></tr>	            
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