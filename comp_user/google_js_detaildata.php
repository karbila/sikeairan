<script type="text/javascript">
  var bounds = new google.maps.LatLngBounds();
  
  function peta_awal(){
    var map;
    var locations = [
  <?php                         
      $sql_lokasi="SELECT i.*, l.id_lokasi, l.nama_desa, s.id_sumber, s.nama_sumber, r.id_regional, r.nama_kecamatan 
      FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
      WHERE l.id_lokasi = i.id_lokasi
      AND r.id_regional = l.id_regional
      AND l.id_lokasi = s.id_lokasi
      AND s.id_sumber = i.id_sumber
      AND i.id_info = '$_GET[id_info]'";
      $result=mysql_query($sql_lokasi);
      /*jangan dihapus*/
      $dtjar = mysql_fetch_array($result);
      /*jangan dihapus*/
      while($data=mysql_fetch_object($result)){
  ?>
      ['<b><?=$data->jaringan_pipa;?></b><br>
        <?=$data->nama_sumber;?><br>
        <?=$data->nama_desa;?>',
        '<?=$data->nama_desa;?>',
        <?=$data->lat;?>, <?=$data->lng;?>],
        ];

    var options = {
      zoom: 15,
      center: new google.maps.LatLng(<?=$data->lat;?>, <?=$data->lng;?>),
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    var map = new google.maps.Map(document.getElementById('peta'), options);
        <?
        }
      ?>

    // Tambahkan Marker
        var infowindow = new google.maps.InfoWindow();
        
        var marker = new google.maps.LatLngBounds();
        // menampilkan banyak marker
        for (var i = 0; i < locations.length; i++) {
          marker = new google.maps.Marker
          ({
            position: new google.maps.LatLng(locations[i][2], locations[i][3]), map: map,
          /*
            var marker = new google.maps.LatLngBounds( );
            for ( var i = 0; i < locations.length; i++ ) {
            marker.extend( locations[ i ] );
            map.fitBounds(marker);
          */  
          });
          /*
          var latlngbounds = new google.maps.LatLngBounds();
          latlng.each(function(n){
            latlngbounds.extend(n);
          });
          map.setCenter(latlngbounds.getCenter());
          map.fitBounds(latlngbounds); 
          */
        
          // menambahkan event clik untuk menampikan infowindows dengan isi sesuai dengan marker yang di klik
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0], locations[i][1]);
              infowindow.open(map, marker);
            }
          })(marker, i));
          
          
          google.maps.event.addListener(map,'click',function(event){
            kasihtanda(event.latLng);
          });
          
          
        }
        
        
        var geocoder = new google.maps.Geocoder();
        
        $(function() {
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
        });
      }
        </script>