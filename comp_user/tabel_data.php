<?php  
$judul = "Tabel Data Informasi Pipa";
?>
    <div id="box-judul">
    	<h3 class="heading"><i class="icon-kanan icon-white"></i> <?=$judul ?></h3>
    </div>

    <div class="box-tb-r">
        <input style="margin-left:0px" type="button" value="Cetak Data Informasi Pipa" onclick="cetak()" class="btn btn-inverse">      
    </div>

    <div class='box-tabel'>
    	    <?php 
    	    include 'comp_user/script_sql_peta.php';
    	    include 'comp_user/tabel_pipa.php'; ?>
    </div>

