<script type="text/javascript">
      var script = '<script type="text/javascript" src="http://google-maps-' +
          'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
</script>

<script type="text/javascript">
  
  function peta_awal(){

            var infoBubble;

            var map;

            infoBubble = new InfoBubble({
              maxWidth: 600
            });

            var locations = [
                   <?php

              					   include 'comp_user/script_sql_peta.php';


                           if(!empty($_GET['idkec']) && empty($_GET['iddes']) && empty($_GET['idsumb'])){
                                $info .= " AND r.id_regional = $_GET[idkec] $x";
                                //echo "1";
                            }elseif(!empty($_GET['iddes']) && !empty($_GET['idkec']) && empty($_GET['idsumb'])){
                                $info .= " AND l.id_lokasi = $_GET[iddes] $x";
                                //echo "2";
                            }elseif(!empty($_GET['idsumb']) && !empty($_GET['iddes']) && !empty($_GET['idkec'])){
                                $info .= " AND s.id_sumber = $_GET[idsumb] $x";
                                //echo "3";
                            }else{
                                $info = $info." ".$x;
                                //echo "4";
                            }

                                $result=mysql_query($info);
                                while($data=mysql_fetch_object($result)){
                                $l = "admin/foto_sumber/$data->nama_sumber/$data->jaringan_pipa/";	
                     ?>
                             ['<table><td><img src="<?php echo $l.$data->foto1; ?>" height="155" width="155"/></td><td><div align="left"><b>Jaringan Pipa: </b><?=$data->jaringan_pipa;?><br><b>Sumber: </b><?=$data->nama_sumber;?><br><b>Kondisi Pipa: </b><?=$data->kondisi_pipa;?><br><b>Kondisi Bangunan: </b><?=$data->kondisi_bangunan;?><br><b>Keterangan :</b><br><?=$data->keterangan;?><br><a href="media.php?page=detail_data&id_info=<? echo $data->id_info;?>" target="_blank" style="text-decoration:none;">Lihat Detail Data</a></div></table></td>','<?=$data->nama_desa;?>', <?=$data->lat;?>, <?=$data->lng;?>],
                       <?
                         }
                        ?>

    ];

    //var lines untuk mengambil koordinat yang ada di tabel jalur pipa
    var lines =[
<?php
      $query = "SELECT l. *, s.nama_sumber, k.nama_desa, r.nama_kecamatan
                FROM tbl_line_pipa l, tbl_sumber s, tbl_lokasi k, tbl_regional r
                WHERE s.id_sumber = l.id_sumber
                AND s.id_lokasi = k.id_lokasi
                AND k.id_regional = r.id_regional";

                if(!empty($_GET['idkec']) && empty($_GET['iddes']) && empty($_GET['idsumb'])){
                      $info .= " AND r.id_regional = $_GET[idkec]";
                }elseif(!empty($_GET['iddes']) && !empty($_GET['idkec']) && empty($_GET['idsumb'])){
                    $query .=" AND k.id_lokasi = '$_GET[iddes]'";                                            
                    // $a = mysql_num_rows(mysql_query($query));
                }elseif(!empty($_GET['idsumb']) && !empty($_GET['iddes']) && !empty($_GET['idkec'])){
                    $query .=" AND s.id_sumber = '$_GET[idsumb]'";                         
                    // $a = mysql_num_rows(mysql_query($query));
                }else{
                    $query = $query;
                    // $a = mysql_num_rows(mysql_query($query));
                }                          
                // AND l.id_sumber = '$_GET[idsumber]'";                         
      
      $hasil = mysql_query($query);    

      // ambil nama,lat dan lon dari table lokasi
      while($data=mysql_fetch_object($hasil)){
?>

         [<?=$data->lat;?>,<?=$data->lng;?>,'<?=$data->id_sumber;?>',<?=$data->id_koordinat;?>],
<?
      }
?>
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
      center: new google.maps.LatLng(<?=$_GET['lat']?>,<?=$_GET['lng']?>),
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    var map = new google.maps.Map(document.getElementById('peta'), options);

    // Tambahkan Marker
    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    var garis = [];

    //untuk membagi koordinat yang ada berdasarkan sumbernya masing"
    var indeks = 0;
    var grupLine = [];
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

    //alert(lines.length);

     // menampilkan banyak marker
    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]), map: map,
      });

      garis[i] = new google.maps.LatLng(locations[i][2], locations[i][3]);

     // menambahkan event clik untuk menampikan infowindows dengan isi sesuai dengan marker yang di klik
    
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function(){
            
              infoBubble.setContent(locations[i][0], locations[i][1]);
              infoBubble.open(map, marker);
          }
      })(marker, i));

     google.maps.event.addListener(map,'click',function(event){
        kasihtanda(event.latLng);
    });
    }

    // memunculkan polyline di peta berdasarkan tiap" sumber
        var koord = [];
        koord = lines;
        // alert(koord.length);

        var temp = [];
        var indek = -1;
        var aturTemp = [];

        //warnaya masih kurang, tambahin lagi...
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
                // alert(koord[a][3]);
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

            jalurpipa.setVisible(true);
            jalurpipa.setMap(map);
        }

   //  var JalurPipa = new google.maps.Polyline({
   //    path: garis,
   //    strokeColor: "#0000FF",
   //    strokeOpacity: 0.5,
   //    strokeWeight: 5
   //  });

   // JalurPipa.setMap(map);

   // lines = [];

      var geocoder = new google.maps.Geocoder();

/*        $(function() {
            $("#searchbox").autocomplete({

                source: function(request, response) {

                    if (geocoder == null){
                        geocoder = new google.maps.Geocoder();
                    }
                    geocoder.geocode( {'address': request.term }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            var searchLoc = results[0].geometry.location;
                            var lat = results[0].geometry.location.lat();
                            var lng = results[0].geometry.location.lng();
                            var latlng = new google.maps.LatLng(lat, lng);
                            var bounds = results[0].geometry.bounds;

                            geocoder.geocode({'latLng': latlng}, function(results1, status1) {
                                if (status1 == google.maps.GeocoderStatus.OK) {
                                    if (results1[1]) {
                                        response($.map(results1, function(loc) {
                                            return {
                                                label  : loc.formatted_address,
                                                value  : loc.formatted_address,
                                                bounds   : loc.geometry.bounds
                                            }
                                        }));
                                    }
                                }
                            });
                        }
                    });
                },
                select: function(event,ui){
                    var pos = ui.item.position;
                    var lct = ui.item.locType;
                    var bounds = ui.item.bounds;
					
                    if (bounds){
                        map.fitBounds(bounds);
                    }
                }
            });
        }); */	
}			
</script>  