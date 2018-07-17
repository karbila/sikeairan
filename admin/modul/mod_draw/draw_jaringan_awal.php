<?php  
error_reporting(0);
session_start();
include '../../conf-global/koneksi.php';

$target = "Jaringan Pipa";

$valid = $_POST['id'];

switch ($_GET['aksi']) {
    default:
?>
    <script type="text/javascript">
      var script = '<script type="text/javascript" src="http://google-maps-' +
          'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>

    <!-- <script type="text/javascript" src="http://geocodezip.com/scripts/v3_epoly.js"></script> -->

    <script type="text/javascript">
        var polyLine;

        // var info_window = new google.maps.InfoWindow();

        var map;

        var koorline = [];

        var pipa = [];
            
        var grupLine = [];

        var index = 0;

        var path=[];

        var textArea = document.getElementById("koordinat"); // assuming there is a textarea with id = mytextarea
        var textToAppend = '';

        var infoBubble;
             
        infoBubble = new InfoBubble({
            maxWidth: 500
        });
      

        var mapOptions = {
            center: new google.maps.LatLng(

                     <?=$_GET['lat'] ?>, <?=$_GET['lng'] ?>                

            ),
            zoom: 15,
            panControl:false,
            scaleControl:true,
            streetViewControl:false,
            zoomControl:true,
            zoomControlOptions: {
                style:google.maps.ZoomControlStyle.SMALL
            },
            mapTypeId: google.maps.MapTypeId.TERRAIN
        };
        
        window.onload = function() {
             


            //set initial map location
            map = new google.maps.Map(
                document.getElementById("map"), mapOptions);

            //visitPoints.push(new google.maps.LatLng(0,0));
            //set up polyline capability
            var polyOptions = new google.maps.Polyline({
                //path: visitPoints,
                map: map
            });

            polyLine = new google.maps.Polyline(polyOptions);
            polyLine.setMap(map);
            
            var locations = [
<?php
                $info="SELECT i.*, s.nama_sumber, l.nama_desa
                       FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
                       WHERE l.id_lokasi = i.id_lokasi
                       AND r.id_regional = l.id_regional
                       AND l.id_lokasi = s.id_lokasi
                       AND s.id_sumber = i.id_sumber";
                
                if(!empty($_GET['iddesa']) && empty($_GET['idsumber'])){
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


                
            // ambil nama,lat dan lon dari table lokasi
                while($data=mysql_fetch_object($result)){
                    $l = "foto_sumber/$data->nama_sumber/$data->jaringan_pipa/";
?>
                    ['<table><td><img src="<?php echo $l.$data->foto1; ?>" height="115" width="115"/></td><td><div align="left"><b>Jaringan Pipa: </b><?=$data->jaringan_pipa;?><br><b>Sumber: </b><?=$data->nama_sumber;?><br><b>Kondisi Pipa: </b><?=$data->kondisi_pipa;?><br><b>Kondisi Bangunan: </b><?=$data->kondisi_bangunan;?><br><b>Keterangan :</b><br><?=$data->keterangan;?><br><a href="../media.php?page=detail_data&id_info=<? echo $data->id_info;?>" target="_blank" style="text-decoration:none;">Lihat Detail Data</a></div></table></td>','<?=$data->nama_desa;?>', <?=$data->lat;?>, <?=$data->lng;?>,'<?=$data->jaringan_pipa;?>'],
<?
                }
             // echo "$info";
?>

            ];

            var lines =[
<?php
                $query = "SELECT l. *, s.nama_sumber, k.nama_desa
                          FROM tbl_line_pipa l, tbl_sumber s, tbl_lokasi k
                          WHERE s.id_sumber = l.id_sumber
                          AND s.id_lokasi = k.id_lokasi";
                          // AND k.id_lokasi =  '1'";

                          if(!empty($_GET['iddesa']) && empty($_GET['idsumber'])){
                              $query .=" AND k.id_lokasi = '$_GET[iddesa]'";                                            
                              // $a = mysql_num_rows(mysql_query($query));
                          }elseif(!empty($_GET['idsumber']) && !empty($_GET['iddesa'])){
                              $query .=" AND l.id_sumber = '$_GET[idsumber]'";                         
                              // $a = mysql_num_rows(mysql_query($query));
                          }else{
                              $query = $query;
                              // $a = mysql_num_rows(mysql_query($query));
                          }                          
                          
                
                $hasil = mysql_query($query);    

                // ambil nama,lat dan lon dari table lokasi
                while($data=mysql_fetch_object($hasil)){
?>
                    [<?=$data->lat;?>,<?=$data->lng;?>,'<?=$data->id_sumber;?>',<?=$data->id_koordinat;?>, <?=$data->keterangan;?>],
<?
                }            
?>
             ];                 

             // Menciptakan grup line
            var indeks = 0;

            for(var i=0; i<lines.length; i++){                        
                // pipa[i] = new google.maps.LatLng(koord[i][0], koord[i][1]);
                if(i==0){
                    grupLine[0]="sumber_"+lines[i][2];
                }else if(i > 0){
                    if(lines[i][2] != lines[i-1][2]){
            
                        // grupLine[0] = koord[i][0]+", "+koord[i][1];                                
                        indeks += 1;
                        grupLine[indeks]="sumber_"+lines[i][2];
                    }
                    // alert(coba[0]);
                }
            }

            //Array warna

            
            // alert(lines.length);
            // alert(locations[0][0]);
            // alert(lines[0][0]);

            makeMarkers(locations);

            createLines(lines);

            lineGroup(lines);

            // alert(grupLine);

            var awal = "", akhir = "";
           
            function makeMarkers(response) {
                
                // alert(response.length);
                for (var i = 0; i < response.length; i++) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(response[i][2], response[i][3]),
                        map: map,
                        title:  response[i][4]
                    });

                    //anonymous function wrapper to create distinct markers
                    (function(marker) {
                        
                        google.maps.event.addListener(marker, 'click', function() {

                            path = polyLine.getPath();
                            path.push(marker.getPosition());                            
                            
                            index+=1;

                            koorline[index] = [marker.getPosition().lat(), marker.getPosition().lng()];

                            appendText("\n"+koorline[index]+",1" );
                                                                       
                            // alert(koorline);
                            // textToAppend = document.createTextNode(koorline[index]);

                        });

                        google.maps.event.addListener(marker, 'rightclick', (function(marker, i) {
                            return function(){
                            
                                infoBubble.setContent(locations[i][0], locations[i][1]);
                                infoBubble.open(map, marker);
                            
                            }
                      
                        })(marker, i));

                    })(marker);
                }
            }

            function createLines(koord){
                
                // alert(koord.length);

                var temp = [];
                var indek = -1;
                var aturTemp = [];

                var warna = ["#171814","#1C57FA","#E53D37","#FBC548","#3C852B","#3A5898","#3242BD"];


                for(var j=0; j<grupLine.length; j++){

                    var banding = grupLine[j].split("_");
                    // alert(banding[1]);
                    
                    for(var l = 0; l<koord.length; l++){
                        for (var k = l+1; k<koord.length; k++){
                            if (koord[l][3] > koord[k][3] && koord[l][2]==koord[k][2]){
                                aturTemp = koord [l];
                                koord [l] = koord [k];
                                koord [k] = aturTemp;
                            }
                        }
                    }
                    
                    // alert(koord[j][3]);
                    
                    for(var a=0; a<koord.length; a++){
                        if(koord[a][2] == banding[1]){
                            indek += 1;
                            temp[indek]=  new google.maps.LatLng(koord[a][0],koord[a][1]);
                        }    
                        alert(koord[a][3]);
                    }
                        
                    grupLine[j] = temp;
                    temp = [];
                    indek=-1;

                    // alert(grupLine.length);

                    var jalurpipa = new google.maps.Polyline({
                        path: grupLine[j],
                        strokeColor: warna[j],
                        strokeOpacity: 0.5,
                        strokeWeight: 5,
                    });

                    // google.maps.event.addListener(jalurpipa, 'rightclick', (function(jalurpipa, j) { 
                    //     return function(){
                    //         // infowindow.content = alert("cobaaaaaaaa");
                    //         // infowindow.position = event.latLng;
                    //         alert(grupLine[j][4]);
                    //         alert(jalurpipa.getPath().getArray().toString());
                    //         // info_window.setContent("cobaaaaa");
                    //         // info_window.position = event.latLng;
                    //         // infowindow.open(map);
                    //     }                        
                    // })(jalurpipa, j));

                    jalurpipa.setVisible(true);
                    jalurpipa.setMap(map);
                    // grupLine=[];
                }
            }

            //listener for poline click
            google.maps.event.addListener(map, 'click', updatePolyline)

        } //end onload function
        
        function updatePolyline(event) {
            var path = polyLine.getPath();        
            path.push(event.latLng);

            index= index+1;

            var lLat = event.latLng.lat().toFixed(6);
            var lLng = event.latLng.lng().toFixed(6);

            koorline[index] = [lLat, lLng];

            
            appendText("\n"+koorline[index]+",0");

            
            // alert(koorline);
        } //end updatePolyline

        function appendText(data) {
            var obj=document.getElementById("koordinat")
            var txt=document.createTextNode(data)
                obj.appendChild(txt)
        }        

        function lineGroup (garis) {
            var temp = [];
            var hit = 0;
            for(var i=0; i<garis.length; i++){
                if(i>0 && garis[i][4] == 1){
                    
                }
            }
            alert(temp);
        }

    </script>

<?php 
    echo "        
    <div id='box-judul'><h3 class='heading'><i class='icon-kanan icon-white'></i> Draw $target</h3></div>
    <center>
        <div id='map' style='width:100%; height:600px; border:1px solid #CCC;'></div>
    </center>
    <div class='isi-form'>";
    //echo "$info<br>Jumlah Data = $a";
    echo "
    <form method='POST' action='modul/mod_draw/aksi_draw.php'>
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
    
        <textarea style = 'width:860px' rows='7' name='koordinat' wrap='physical' id='koordinat' >$_GET[idsumber]</textarea>     

        <h4 class='box-judulform-tombol'>
            <input type='submit' name='simpan' id='simpan' value='Simpan' class='btn btn-inverse'>
            <input type='button' value=Batal onclick=self.history.back() class='btn btn-inverse'>
        </h4>
    </form>
    "; 
    echo "</div>";
    
    break;
    echo "

        </body>
    </html>
    ";
        /*<input type='button' name='simpan' value='Simpan' onclick=SimpanDraw() class='btn btn-inverse'> */
}


?>

<script type="text/javascript">    
    //fungsi untuk chage dan efek di url-> 3 objek langsung
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
        eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
        if (restore) selObj.selectedIndex=0;
    }

    function SimpanDraw(){
        window.location.href='modul/mod_draw/aksi_draw.php';        
    }

    // $(document).ready(function() {
        
    //     $('#simpan').change(function(){
            
    //         $.ajax({
            
    //             url: "modul/mod_draw/aksi_draw.php",
    //             data: {koordinat : koordinat}
            
    //         });
        
    //     });

        
    // });

</script>