<?php  
$target = "History Log Sistem";
$style = "style='height:28px; width:220px'";

	
			
        echo "<script type='text/javascript'>
            function hapusall(){
                konfirmasi = confirm('Apakah Anda ingin benar-benar menghapus Semua Log History?');
                if(konfirmasi==1){  
                    window.location.href='modul/modul_history/aksi_history.php';
                }else{
                    window.location.href='?halaman=history';
                }
            }
        </script>";
		
		
		echo "
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Data $target</h3></div>        
        <div class='isi-form'>";

        echo "
            <h4 class='box-judulform'>Tabel $target</h4>

            <div class='box-tb-r'>
                <input type=button value='Hapus Semua Data $target' onclick=\"hapusall()\" class='btn btn-inverse'>
            </div>";
                           
        echo "<div class='box-tabel'>
        <table  class=\"table table-striped table-bordered dTableR\" id=\"dt_a\">
        <thead align='center'>
        <tr>
        <th class='essential persist'>No</th>
        <th class='essential persist'>Nama Lengkap</th>                
        <th class='essential persist'>Username</th>
        <th class='essential persist'>Level Akses</th>        
        <th class='essential persist'>Waktu</th>        
        </tr>
        </thead><tbody>";
         

        $u = "SELECT * FROM logs ORDER BY id_log ASC";        
        $tampil = mysql_query($u);
        
        $no = 1;        
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$r[namalengkaplog]</td>
                <td>$r[usernamelog]</td>
                <td>$r[levellog]</td>
                <td style='text-align:center;'>$r[waktulog]</td>";                        
                echo "</tr>";
            $no++;
            }
               
        echo "</tbody></table></div>";         


        echo "</div>";  
		
?>