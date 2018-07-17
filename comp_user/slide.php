<div id='this-carousel-id' class='carousel slide'>
        <div class='carousel-inner' style='width: 99%;'>
        		<?php  
        		$oke = "SELECT MIN(p.id_peta) as idp, s.nama_sumber, p.nama_foto FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber = '$_GET[idsumb]'";

        		$a = mysql_query($oke);        	        	       				
        		$v =mysql_fetch_array($a);        		
        		
                $lokasi = "admin/foto_peta_offline/$v[nama_sumber]/";
        		
                $xx =mysql_query("SELECT p.id_peta as idp, s.nama_sumber, p.nama_foto FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber = '$_GET[idsumb]'");
        		$jum = mysql_num_rows($xx);
        		if($jum==0){
                    if(!empty($_GET['idkec'])){
                        echo "<div class='alert alert-info'>
                            <a class='close' data-dismiss='alert'>×</a>
                            <strong>Foto Peta Offline tidak terlihat karena Anda menggunakan Filter. Supaya Foto Peta Offline terlihat kembali maka Anda harus terlebih dahulu mengklik Link Sumber Air yang ada pada tabel.</strong>.
                            </div>
                        ";
                        echo "<div class='alert alert-error'>
                            <a class='close' data-dismiss='alert'>×</a>
                            <strong>Maaf Belum Ada Foto Peta Offline pada $v[nama_sumber]</strong>.
                            </div>
                    ";
                    }elseif(empty($_GET['idsumb'])){
                        echo "<div class='alert alert-info'>
                            <a class='close' data-dismiss='alert'>×</a>
                            <strong>Foto Peta Offline belum terlihat dikarenakan Anda belum mengklik Link Sumber Air pada Tabel.</strong>.
                            </div>
                        ";
                    }        			        			
        		}elseif($jum > 0){        			
        			echo "<div class='item active'>
			            <a href='$lokasi$v[nama_foto]' class='grup' rel='grup1'>
			            <img src='$lokasi$v[nama_foto]' alt='' /></a>
			            <div class='carousel-caption'>
			              <p>$v[nama_sumber]</p>
			              <p><a href='#'>#</a></p>
			            </div>
			          </div>
	          		";
        		}

                $idmin = $v['idp'];

                $xx1 =mysql_query("SELECT p.id_peta, s.nama_sumber, p.nama_foto FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber = '$_GET[idsumb]' AND p.id_peta !='$idmin'");                

                while ($data = mysql_fetch_array($xx1)) {
                	$lokasi = "admin/foto_peta_offline/$data[nama_sumber]/";
                	if(mysql_num_rows($xx1)==0){
                		echo "";
                	}elseif(mysql_num_rows($xx1) > 0){
                		echo "<div class='item'>
			            <a href='$lokasi$data[nama_foto]' class='grup' rel='grup1'>
			            <img src='$lokasi$data[nama_foto]' alt='' /></a>
			            <div class='carousel-caption'>
			              <p>$data[nama_sumber]</p>
			              <p><a href='#'>#</a></p>
			            </div>
			          </div>
	          		";
                	}
                }


        		?>	          
        </div>

        	<?php  
        		if(mysql_num_rows($xx1)==0){
        			echo "";
        		}else{
        			echo "<a class='carousel-control left' href='#this-carousel-id' data-slide='prev'>&lsaquo;</a>
          			<a class='carousel-control right' href='#this-carousel-id' data-slide='next'>&rsaquo;</a>";
        		}
        	?>          
</div>
<?php 
	 $xx2 =mysql_query("SELECT p.id_peta, s.nama_sumber, p.nama_foto FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber = '$_GET[idsumb]'");                

                    $row = mysql_num_rows($xx2);                     
                    $cols = 5;                
                    if($row > 0){                        
                        echo "<table align=center><tr>";
                        $cnt = 0;
                        while ($w = mysql_fetch_array($xx2)) {
                          $lokasi = "admin/foto_peta_offline/$w[nama_sumber]/";
                          if ($cnt >= $cols) {
                            echo "</tr><tr>";
                            $cnt = 0;
                          }
                          $cnt++;                                                    
                          echo "<td align=center valign=top>
                            <a href='$lokasi$w[nama_foto]' class='grup' rel='grup1'>
                                <img src='$lokasi$w[nama_foto]' class='oke2'>
                            </a>
                          </td>";
                        }
                        echo "</tr></table><br/>";                        
                    }else{
                        //echo "gak ada";                        
                    }
 ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="componen/js/jquery-1.8.1.min.js"><\/script>')</script>
<script src="componen/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $('.carousel').carousel({
          interval: 4000
        });
      });
    </script>