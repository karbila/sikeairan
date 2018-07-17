<?php  
error_reporting(0);
session_start();
include '../../conf-global/koneksi.php';

$aksi = "modul/mod_draw/aksi_draw.php";
$target = "Jaringan Pipa";

switch ($_GET['aksi']) {
    default:        
        echo "
        <html>
        <head>
            
            <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
            ";

?>
        <script type="text/javascript">
           
            var map;
            var polyline;

            window.onload =function() {

                var options = {
                  zoom: 15,
                  center: new google.maps.LatLng(<?=$_GET['lat']?>,<?=$_GET['lng']?>),
                  mapTypeId: google.maps.MapTypeId.TERRAIN
                };
               
                map = new google.maps.Map(document.getElementById('peta'), options);

                
                var locations = [
<?php
                    


                    $info="SELECT i.id_info, i.id_sumber, i.lat, i.lng, i.kondisi_pipa, i.kondisi_bangunan, i.keterangan, i. foto1, l.nama_desa, i.jaringan_pipa, s.nama_sumber
                    FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
                    WHERE l.id_lokasi = i.id_lokasi
                    AND r.id_regional = l.id_regional
                    AND l.id_lokasi = s.id_lokasi
                    AND s.id_sumber = i.id_sumber";
                    
                    if(!empty($_GET['iddesa']) && empty($_GET['iddesa'])){
                        $info .=" AND l.id_lokasi = '$_GET[iddesa]'";                                            
                        $a = mysql_num_rows(mysql_query($info));
                    }elseif(!empty($_GET['idsumber']) && !empty($_GET['iddesa'])){
                        $info .=" AND s.id_sumber = '$_GET[idsumber]'";                         
                        $a = mysql_num_rows(mysql_query($info));
                    }else{
                        $info = $info;
                        $a = mysql_num_rows(mysql_query($info));
                    }
                    


                    $result=mysql_query($info);
                      //  $l = "admin/foto_sumber/$info[nama_sumber]/$info[jaringan_pipa]/";
                // ambil nama,lat dan lon dari table lokasi
                    while($data=mysql_fetch_object($result)){
                    $l = "../admin/foto_sumber/$data->nama_sumber/$data->jaringan_pipa/";  
?>
                    [<?=$data->lat;?>, <?=$data->lng;?>],
<?
                    }
                 // echo "$info";
?>

                ];

                //Parameter Google maps
                var polyOptions = new google.maps.Polyline({
                    //path: visitPoints,
                    map: map
                });

                polyLine = new google.maps.Polyline(polyOptions);

                polyLine.setMap(map);

                // Tambahkan Marker

                var marker, i;
                var lines = [];

                makeMarkers(locations);
                 // menampilkan banyak marker
                function makeMarkers(response) {
                    console.log("Response Length: " + response.length)
                    for (var i = 0; i < response.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(response[i][0], response[i][1]),
                            map: map,
                            title: response[i].fileName
                        });

                        //anonymous function wrapper to create distinct markers
                        (function(marker) {

                            google.maps.event.addListener(marker, 'click', function() {
    
                                //tourList.push(marker); //add marker to tour list
                                //CHANGED
                                path = polyLine.getPath();
                                path.push(marker.getPosition());

                                //visitPoints.push(marker.getPosition()); //add location to polyline array
                                console.log("Tour List length- # stops: " + tourList.length);

                            });
                        })(marker,i);
                    }
                }

                //listener for poline click
                google.maps.event.addListener(map, 'click', updatePolyline)
            }

            function updatePolyline(event) {
                    var path = polyLine.getPath();

                    //CHANGED WATCH CAPITALIZATION
                    path.push(event.LatLng);
                } //end updatePolyline
           
        </script>



<?
        echo "
        </head>
        <body>
        
        <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Draw $target</h3></div>
        <center>
            <div id='peta' style='width:100%; height:600px'></div>
        </center>
        <div class='isi-form'>";

        echo "$info<br>Jumlah Data = $a";

        echo "

        

        <script type='text/javascript'>

        var peta;
        
        var jenis = '';
        
       
        var map;

        </script>

        ";

        echo " 
           <table border=0> 
                <thead>
                    <th width=27%></th>
                    <th width=40%></th>                    
                </thead>           
                <tbody>";
                echo " 
                    <tr><td class='essential persist'><div>Desa</div></td><td><select name='sum' id='sum' onChange=\"MM_jumpMenu('parent', this, 0)\"><option value=0>Pilih Sumber</option>";

                        $a = mysql_fetch_array(mysql_query("SELECT id_lokasi FROM tbl_lokasi l, tbl_sumber s WHERE l.id_lokasi = s.id_lokasi AND l.id_lokasi = '$_GET[iddesa]'")); 

                        $f = mysql_query("SELECT id_lokasi, nama_desa, lat, lng FROM tbl_lokasi");  

                        while ($d = mysql_fetch_array($f)) {                            
                            if(empty($_GET['iddesa'])){
                                echo "<option value='?halaman=m_draw&iddesa=$d[id_lokasi]&lat=$d[lat]&lng=$d[lng]'>$d[nama_desa]</option>";
                            }elseif($_GET['iddesa']==$d['id_lokasi']){
                                echo "<option value='?halaman=m_draw&iddesa=$d[id_lokasi]&lat=$d[lat]&lng=$d[lng]' selected='selected'>$d[nama_desa]</option>";    
                            }else{
                                echo "<option value='?halaman=m_draw&iddesa=$d[id_lokasi]&lat=$d[lat]&lng=$d[lng]'>$d[nama_desa]</option>";
                            }
                        }                        
                        
                    echo "</select></td>";
                    
                    echo "<td class='essential persist'><div>Sumber Air</div></td><td><select name='po' id='po' onChange=\"MM_jumpMenu('parent', this, 0)\"><option value=0>Pilih Sumber</option>";                    
                    $query = mysql_query("SELECT s. *, l.id_lokasi  
                             FROM tbl_sumber s, tbl_lokasi l
                             WHERE l.id_lokasi = s.id_lokasi
                             AND l.id_lokasi =  '$_GET[iddesa]'");
                    //$query = mysql_fetch_array(); 

                    while ($data = mysql_fetch_array($query)) {
                         if(empty($_GET['iddesa'])){
                            echo "<option>Pilih Desa Dulu...</option>";
                        }elseif($_GET['idsumber']==$data['id_sumber']){
                            echo "<option value='?halaman=m_draw&iddesa=$data[id_lokasi]&idsumber=$data[id_sumber]&lat=$data[lat]&lng=$data[lng]' selected='selected'>$data[nama_sumber]</option>";
                        }else{
                            echo "<option value='?halaman=m_draw&iddesa=$data[id_lokasi]&idsumber=$data[id_sumber]&lat=$data[lat]&lng=$data[lng]'>$data[nama_sumber]</option>";
                        }
                    } 




                    echo "</select></td></tr>";

                echo "</tbody>
            </table>

        <h4 class='box-judulform-tombol'>
                    <input type='submit' name='simpan' value='Simpan' class='btn btn-inverse'> 
                <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
        </h4>

        "; 
        echo "</div>";
        break;
        echo "

            </body>
        </html>
        ";
}


?>

<script type="text/javascript">    
    //fungsi untuk chage dan efek di url-> 3 objek langsung
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
        eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
        if (restore) selObj.selectedIndex=0;
    }



</script>