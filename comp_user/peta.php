
<?php 
$judul = "Peta dan Tabel Data Informasi Pipa";
?>
	<div id="box-judul">
    	<h3 class="heading"><i class="icon-kanan icon-white"></i> <?=$judul ?></h3>
    </div>

    <!-- combobox filter -->
    <?php 
    	echo "
			<div id='box-filter'>
            <span>Filter :</span>            
            <select name='a' id='a' onChange=\"MM_jumpMenu('parent',this,0)\">
                <option value='?page=peta'>Pilih Kecamatan</option>";

                $combo_kec = mysql_query("SELECT * FROM tbl_regional");
                while ($datakec = mysql_fetch_array($combo_kec)) {
                    if($_GET['idkec']==$datakec['id_regional']){
                        echo "<option value='?page=peta&idkec=$datakec[id_regional]&lat=$datakec[lat]&lng=$datakec[lng]' selected='selected'>$datakec[nama_kecamatan]</option>";    
                    }else{
                        echo "<option value='?page=peta&idkec=$datakec[id_regional]&lat=$datakec[lat]&lng=$datakec[lng]'>$datakec[nama_kecamatan]</option>";    
                    }
                                    
                }
            echo "</select>
            
            <select name='b' id='b' onChange=\"MM_jumpMenu('parent', this, 0)\">
                <option value='?page=peta'>Pilih Desa</option>";
                if(empty($_GET['idkec'])){
                    echo "<option value='?page=peta'>Pilih Dulu Kecamatan...</option>";
                }else{
                    $desi = mysql_query("SELECT l.*, r.id_regional FROM tbl_lokasi l, tbl_regional r WHERE r.id_regional = l.id_regional AND r.id_regional = '$_GET[idkec]'");                    
                    if(mysql_num_rows($desi)==0){

                        $d = mysql_fetch_array(mysql_query("SELECT nama_kecamatan FROM tbl_regional WHERE id_regional = '$_GET[idkec]'"));
                        echo "<option value='?page=peta'>Desa Tidak Ditemukan di Kecamatan $d[nama_kecamatan]</option>";
                    }else{
                        while ($dtd = mysql_fetch_array($desi)) {
                            if($_GET['iddes']==$dtd['id_lokasi']){
								echo "<option value='?page=peta&idkec=$dtd[id_regional]&iddes=$dtd[id_lokasi]&lat=$dtd[lat]&lng=$dtd[lng]' selected='selected'>$dtd[nama_desa]</option>";
                            }else{
                            	echo "<option value='?page=peta&idkec=$dtd[id_regional]&iddes=$dtd[id_lokasi]&lat=$dtd[lat]&lng=$dtd[lng]'>$dtd[nama_desa]</option>";
                            }                            
                        }    
                    }
                    
                }

            //perintah onChange=\"MM_jumpMenu('parent', this, 0)\" harus diapit doublecode ("")
            echo "</select>
            
            <select name='c' id='c' onChange=\"MM_jumpMenu('parent', this, 0)\">
                <option value='?page=peta'>Pilih Sumber</option>";

                if(empty($_GET['iddes'])){
                    echo "<option value='?page=peta'>Pilih Dulu Desa...</option>";
                }else{
                    $sumbi = mysql_query("SELECT s . * , l.id_lokasi, r.id_regional
								FROM tbl_sumber s, tbl_lokasi l, tbl_regional r
								WHERE l.id_lokasi = s.id_lokasi
								AND l.id_lokasi =  '$_GET[iddes]'");
                    $g = mysql_num_rows($sumbi);
                    if($g==0){
                        $e = mysql_fetch_array(mysql_query("SELECT nama_desa FROM tbl_lokasi WHERE id_lokasi = '$_GET[iddes]' "));
                        echo "<option value='?page=peta'>Tidak Ada sumber di Desa $e[nama_desa]</option>";
                    }else{
                        while ($f=mysql_fetch_array($sumbi)) {
                            if($_GET['idsumb']==$f['id_sumber']){
                            	echo "<option value='?page=peta&idkec=$f[id_regional]&iddes=$f[id_lokasi]&idsumb=$f[id_sumber]&lat=$f[lat]&lng=$f[lng]' selected='selected'>$f[nama_sumber]</option>";	
                            }else{
                            	echo "<option value='?page=peta&idkec=$f[id_regional]&iddes=$f[id_lokasi]&idsumb=$f[id_sumber]&lat=$f[lat]&lng=$f[lng]'>$f[nama_sumber]</option>";
                            }
                            
                        }
                    }
                }
            
            echo "</select>
        </div>";
     ?>

    <!-- comobox filter -->

    <!-- include google_js harus diatas karena dia menginclude script_sql_peta.php >> jangan dirubah tempatnya-->
    <?php include "google_js.php"; ?>

    <div id='peta'></div>

    <div class="box-tb-r">
        <input style="margin-left:0px" type="button" value="Cetak Data Informasi Pipa" onclick="cetak()" class="btn btn-inverse">      
    </div>    
    <div class='box-tabel'>
    	    <?php     	   
    	    include 'comp_user/tabel_pipa.php'; ?>
    </div>
