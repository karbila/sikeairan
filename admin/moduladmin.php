<script type="text/javascript"
        src="http://maps.google.com/maps/api/js?sensor=true&language=id&amp;key=AIzaSyDsGlvjgZxGoDXrWKDA_nB9azrPs7f-F0M">
</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=id"></script>

<script type="text/javascript">
function peta_awal(){
var map;
var locations = [
<?php

  $sql_lokasi="SELECT i.lat, i.lng, l.nama_desa, i.jaringan_pipa, s.nama_sumber
  FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
  WHERE l.id_lokasi = i.id_lokasi
  AND r.id_regional = l.id_regional
  AND l.id_lokasi = s.id_lokasi";
                                $result=mysql_query($sql_lokasi);
                        // ambil nama,lat dan lon dari table lokasi
                                while($data=mysql_fetch_object($result)){
                     ?>['<b><?=$data->jaringan_pipa;?></b><br><?=$data->sumber;?><br><?=$data->nama_desa;?>','<?=$data->nama_desa;?>', <?=$data->lat;?>, <?=$data->lng;?>],
                       <?php
                         }
                        ?>

];
  

    //Parameter Google maps
    var options = {
      zoom: 12,
      panControl:false,
      scaleControl:true,
      streetViewControl:false,
      zoomControl:true,
      zoomControlOptions: {
        style:google.maps.ZoomControlStyle.SMALL
      },
      center: new google.maps.LatLng(-7.9151615,111.9693886),
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    var map = new google.maps.Map(document.getElementById('peta'), options);

    // Tambahkan Marker
    var infowindow = new google.maps.InfoWindow();

    var marker, i;
     // menampilkan banyak marker
    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]), map: map,
      });

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

function kasihtanda(lokasi){
    set_icon(jenis);
    tanda = new google.maps.Marker({
            position: lokasi,
            map: peta,
            icon: gambar_tanda
    });
    $("#x").val(lokasi.lat());
    $("#y").val(lokasi.lng());

}

function set_icon(jenisnya){
    switch(jenisnya){
        case  "sekolah":
            gambar_tanda = '../componen/icon/home.png';
            break;
    }
}

function setjenis(jns){
    jenis = jns;
}


</script>

<?php
$page=$_GET['halaman'];

switch($page){

  /*petugas*/
  
  case "homepetugas" : 
    include "mod_home/homepetugas.php";
  break;

  case "m_draw" : 
    include "modul/mod_draw/draw_jaringan2.php";
  break;

  case "m_lokasi" : 
    include "modul/mod_lokasi/lokasi.php";
  break;

  case "m_regional" :     
    include "modul/mod_regional/regional.php";
  break;

  case "m_sumberair" :     
    include "modul/mod_sumber_air/sumberair.php";
  break;

  case "m_point" : 
    include "modul/mod_point/point.php";
  break;

  case "m_foto":
    include 'modul/mod_foto/foto.php';
  break;

  case "m_peta_off":
    include "modul/mod_peta_off/peta_off.php";
  break;
  
  case "updo" : 
    //include "modul/upload_download/index.php";
    echo "oke upload DWG";
  break;


/*admin*/
 case "homeadmin" : 
    include("modul/modul_home/homeadmin.php");
 break;

 case "user" : 
    include("modul/mod_users/user.php");
 break;
 
 case "history" : include("modul/modul_history/history.php");
 break;

 /*user*/
 case "homeuser" : 
  include "modul/mod_home/homeuser.php";
 break;

 case "tabel_data_bangunan" : 
  include("modul_userpage/tabel_data_bangunan_user.php");
 break;

default :
  //echo "<span style='color:red;'>maaf, modul belum terbentuk... :(";
  header('location:index.php?halaman=homepetugas');
break;
}

?>