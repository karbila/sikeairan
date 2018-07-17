<? 
//Panggil
error_reporting(0);
 if (empty($_GET['id_info']))
 { 
 }else{
 $id_info=$_GET['id_info'];}
?>

      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=id"></script>
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?sensor=true&language=id&amp;key=AIzaSyDsGlvjgZxGoDXrWKDA_nB9azrPs7f-F0M">
        </script>

        <script type="text/javascript">
      var bounds = new google.maps.LatLngBounds();
            function peta_awal(){
                var map;
                var locations = [
  <?php
                         //konfgurasi koneksi database
include "conf-global/koneksi.php";

                                $sql_lokasi="SELECT i.*, l.id_lokasi, l.nama_desa, s.id_sumber, s.nama_sumber, r.id_regional, r.nama_kecamatan 
                                FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
                                WHERE l.id_lokasi = i.id_lokasi
                                AND r.id_regional = l.id_regional
                                AND l.id_lokasi = s.id_lokasi
                                AND s.id_sumber = i.id_sumber
                                AND i.id_info = '$id_info'";
                                $result=mysql_query($sql_lokasi);
                        // ambil nama,lat dan lon dari table lokasi
                                while($data=mysql_fetch_object($result)){
                     ?>
                             ['<b><?=$data->jaringan_pipa;?></b><br><?=$data->nama_sumber;?><br><?=$data->nama_desa;?>','<?=$data->nama_desa;?>', <?=$data->lat;?>, <?=$data->lng;?>],


        ];

  
        //Parameter Google maps
    var options = {
      zoom: 15,
      panControl:false,
      scaleControl:true,
      streetViewControl:false,
      zoomControl:true,
      zoomControlOptions: {
        style:google.maps.ZoomControlStyle.SMALL
      },
      center: new google.maps.LatLng(<?=$data->lat;?>, <?=$data->lng;?>),
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    var map = new google.maps.Map(document.getElementById('peta'), options);
        <?
        }
      ?>

    // Tambahkan Marker        
        var marker, i;
     // menampilkan banyak marker
    	for (i = 0; i < locations.length; i++) {
      	marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]), 
		map: map,icon: 'http://powerhut.co.uk/googlemaps/dynamic/1361668504XHXWAT/image.png', shadow: 'http://powerhut.co.uk/googlemaps/dynamic/1361668504XHXWAT/shadow.png'
      });
		
        }

      }
        </script>


<?php
//include "comp_user/google_js_detaildata.php";
$judul = "Detail Data Jaringan $dtjar[jaringan_pipa]";
include "comp_user/script_sql_peta.php";
$info .=" AND i.id_info = '$_GET[id_info]'";
$data = mysql_fetch_array(mysql_query($info));
?>

  <div id="box-judul">
      <h3 class="heading"><i class="icon-kanan icon-white"></i> <?=$judul ?></h3>
    </div>   
    <div class='box-tabel' style='border-top: none; padding-top:5px;'>
      
      <!-- <h4 class="box-judulform2">Foto Jaringan dan Peta <strong><?php echo "$dtjar[jaringan_pipa]"; ?></strong></h4> -->
      <?php
        
        $b = 'style="width:348px; height:204px;"';
        $k = 'style="width:102px; height:78px;"';
        $p = 'style="height: 198px; width: 367px;margin: 10px;float: left;width: 367px;"';

        $l = "admin/foto_sumber/$data[nama_sumber]/$data[jaringan_pipa]/"; 
        
        $def = "<a href='admin/foto_sumber/foto-default/no-photo.png' rel='grup1' class='grup'><img src='admin/foto_sumber/foto-default/no-photo.png' alt='no-photo.png' $k></a>";

        $def_big = "<a href='admin/foto_sumber/foto-default/no-photo.png' rel='grup1' class='grup'><img src='admin/foto_sumber/foto-default/no-photo.png' alt='no-photo.png' $b></a>";
        echo "
        <div id='kolom-kanan'>
            <div id='ft-besar'>";
                if($data['foto1']=='-'){
                  echo "$def_big";
                }else{
                  echo "<a href='$l$data[foto1]' class='grup' rel='grup1'>
                  <img src='$l$data[foto1]' alt='$data[foto1]' $b>
                  </a>";                  
                }
              echo "
            </div>
            <div id='ft-kecil'>
              <div class='a'>";
              if($data['foto2']=='-'){
                echo "$def";
              }else{
                echo "<a href='$l$data[foto2]' class='grup' rel='grup1'>
                <img src='$l$data[foto2]' alt='$data[foto2]' $k>
                </a>";                
              }
                
              echo "</div>            
              <div class='a'>";
               if($data['foto3']=='-'){
                echo "$def";
              }else{
                echo "<a href='$l$data[foto3]' class='grup' rel='grup1'>
                <img src='$l$data[foto3]' alt='$data[foto3]' $k>
                </a>";                
              }                 
              echo "</div>
              <div class='a'>";
              if($data['foto4']=='-'){
                echo "$def";
              }else{
                echo "<a href='$l$data[foto4]' class='grup' rel='grup1'>
                <img src='$l$data[foto4]' alt='$data[foto4]' $k>
                </a>";                
              }                
              echo "</div>
          </div>
          <div id='ft-bawah'>";
              if($data['foto4']=='-'){
                  echo "$def_big";
                }else{
                  echo "<a href='$l$data[foto4]' class='grup' rel='grup1'>
                  <img src='$l$data[foto4]' alt='$data[foto4]' $b>
                </a>";                  
                }
          echo "</div>

<body onload=' peta_awal()'>
          <div id='peta' $p ></div>
</body>
          
      </div>  
        ";
        /*<div id='ft-bawah'></div>
          <div id='ft-peta'></div>*/
      ?>
      
       
      <div id='kolom-kiri'>
        <!-- <h4 class="box-judulform2">Informasi Detail <strong><?php echo "$dtjar[jaringan_pipa]"; ?></strong></h4> -->
       
          <?php
          //echo "$info";
          $a = "style='border-left:1px solid #dddddd; font-weight:bold;'";
          $b = "style='border-left: none;'";
          $c = "style='padding:0;background-color:none;'";

          echo "
          <div id='box-tabel-detail'>
             <table class='table table-striped table-bordered'>
            <thead>              
                <th width='23%' $c></th>
                <th width='50%' $c></th>
            </thead>
            <tbody>
              <tr><td $a>Nama Desa</td>         <td $b>: $data[nama_desa]</td></tr>
              <tr><td $a>Sumber Air</td>        <td $b>: $data[nama_sumber]</td></tr>
              <tr><td $a>Jaringan Pipa</td>     <td $b>: $data[jaringan_pipa]</td></tr>
              <tr><td $a>Diameter Pipa</td>     <td $b>: <strong> &empty; </strong> $data[diameter_pipa] <strong>&quot;</strong></td></tr>
              <tr><td $a>Jenis Pipa</td>        <td $b>: $data[jenis_pipa]</td></tr>
              <tr><td $a>Panjang Pipa</td>      <td $b>: $data[panjang_pipa] <strong>M&prime;</strong></td></tr>
              <tr><td $a>Debit Air</td>         <td $b>: $data[debit_air] <strong>liter/detik</strong></td></tr>
              <tr><td $a>Latitude</td>          <td $b>: $data[lat]</td></tr>
              <tr><td $a>Longitude</td>         <td $b>: $data[lng]</td></tr>
              <tr><td $a>Tahun Pemasangan</td>  <td $b>: $data[thn_pemasangan]</td></tr>
              <tr><td $a>Kondisi Pipa</td>      <td $b>: $data[kondisi_pipa]</td></tr>
              <tr><td $a>Elevasi</td>           <td $b>: $data[elevasi]</td></tr>
              <tr><td $a>Keterangan</td>        <td $b>: $data[keterangan]</td></tr>            
            </tbody>
          </table>
          </div>
         ";
          ?>                    
      </div>

    </div>