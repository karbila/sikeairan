<?php
error_reporting(0);
session_start();
include "../componen/dbkonek/confdb.php";


if(empty($_SESSION['level'])){
    header('location:index.php');
}

else{
?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sistem Informasi Keairan</title>
        <link rel="shortcut icon" href="../webicons.ico" type="image/x-icon" />
        <link rel="stylesheet" href="../componen/css/style-admin.css" / type="text/css">
        <link rel="stylesheet" href="../componen/css/bootstrap.css" /> 

        <link rel="stylesheet" href="../componen/css/eastern_blue.css" id="link_theme" />       
        <link rel="stylesheet" href="../componen/css/splashy.css" />
        <link rel="stylesheet" href="../componen/css/style-gebo.css" />

        <link href='../componen/usman/jquery.noty.css' rel='stylesheet'>
        <link href='../componen/usman/noty_theme_default.css' rel='stylesheet'>


        <script type="text/javascript" src="../componen/js/jquery-1.8.1.min.js"></script>

        <!-- fancy -->
        <script type="text/javascript" src="../componen/fancy/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript" src="../componen/fancy/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="../componen/fancy/jquery.mousewheel-3.0.4.pack.js"></script> 
        <link rel="stylesheet"  href="../componen/fancy/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>

        <!-- harus diletakkan diatas 
        <script src="../componen/js/jquery-1.7.2.js"></script> -->


        <script type="text/javascript">
            var peta;
            var pertama = 0;
            var jenis = "";
            var gambar_tanda;
                function peta_awal(){
                //    var sby = new google.maps.LatLng(-7.289166, 112.734398);
                //    var petaoption = {
                //        zoom: 13,
                //        center: sby,
                //        mapTypeId: google.maps.MapTypeId.ROADMAP
                   };
            var peta;
            var pertama = 0;
            var jenis = "";
            var gambar_tanda;           
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
                                             <?
                                               }
                                              ?>

                                            ];

                //Parameter Google maps
                var options = {
                  zoom: 12,
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
		

    </head>
    
    <body class="sidebar_hidden gebo-fixed" <?php echo "onload='peta_awal()'"; ?>>
		<div id="loading_layer" style="display:none"><img src="../componen/img/mix/ajax_loader.gif" alt="" /></div>
		<!-- headernya... -->		 
		<div id="maincontainer">	
			<?php include '../comp_user/header.php'; ?>            
                 <div class="navbar">                
                    <div class="navbar-inner">
                        <div class="container-fluid">                            
                            <ul class="nav user_menu pull-right">
                                <li class="dropdown">
                                    <a href="../index.php"><i class="icon-keluar icon-white"></i> Keluar</a>                                    
                                </li>
                            </ul>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                    <?php
         							if($_SESSION['level']=='admin'){          							
                                            if($_GET['halaman']=='homeadmin'){
                                               echo "<li class=\"dropdown aktif\"><a href=\"?halaman=homeadmin\"><i class=\"icon-home\"></i> Home</a></li>"; 
                                            }else{
                                                echo "<li class=\"dropdown\"><a href=\"?halaman=homeadmin\"><i class=\"icon-home icon-white\"></i> Home</a></li>"; 
                                            }

                                            if($_GET['halaman']=='user'){
                                                echo "<li class=\"dropdown aktif\"><a href=\"?halaman=user\"><i class=\"icon-user\"></i> Managemen Data User</a></li>";        
                                            }else{
                                                echo "<li class=\"dropdown\"><a href=\"?halaman=user\"><i class=\"icon-user icon-white\"></i> Managemen Data User</a></li>";
                                            }

                                            if($_GET['halaman']=='history'){
                                                echo "<li class='dropdown aktif'><a href='?halaman=history'><i class='icon-list-alt'></i> History Login</a></li>";
                                            }else{
                                                echo "<li class='dropdown'><a href='?halaman=history'><i class='icon-list-alt icon-white'></i> History Login</a></li>";
                                            }

                                    /*----------------*/
                                    }elseif($_SESSION['level']=='petugas'){
                                        if($_GET['halaman']=='homepetugas'){
                                            echo "<li class=\"dropdown aktif\"><a href=\"?halaman=homepetugas\"><i class=\"icon-home\"></i> Home</a></li> ";
                                        }else{
                                            echo "<li class=\"dropdown\"><a href=\"?halaman=homepetugas\"><i class=\"icon-home icon-white\"></i> Home</a></li>";
                                        }

                                        if($_GET['halaman']=='m_point' || $_GET['halaman']=='m_draw'){
                                            echo "<li class='dropdown aktif'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-edit'></i> Input Data <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                <li><a href='?halaman=m_point'>Data Point <b class='caret-right'></b></a><ul class='dropdown-menu'>
                                                            <li><a href='?halaman=m_point&aksi=add_point'>Tambah Point</a></li>
                                                        </ul>
                                                </li>
                                                <li><a href='?halaman=m_draw'>Draw Jaringan Pipa</a></li>                   
                                            </ul>
                                        </li> ";
                                        }else{
                                            echo "<li class='dropdown'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-edit icon-white'></i> Input Data <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                <li><a href='?halaman=m_point'>Data Point <b class='caret-right'></b></a><ul class='dropdown-menu'>
                                                            <li><a href='?halaman=m_point&aksi=add_point'>Tambah Point</a></li>
                                                        </ul>
                                                </li>
                                                <li><a href='?halaman=m_draw'>Draw Jaringan Pipa</a></li>                   
                                            </ul>
                                        </li> ";
                                        }

                                        if($_GET['halaman']=='m_regional' || $_GET['halaman']=='m_lokasi' || $_GET['halaman']=='m_sumberair'){
                                            echo "<li class='dropdown aktif'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-pencil'></i> Master Data <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                <li><a href='?halaman=m_regional'>Master Data Regional</a></li>
                                                <li><a href='?halaman=m_lokasi'>Master Data Lokasi</a></li>
                                                <li><a href='?halaman=m_sumberair'>Master Data Sumber Air</a></li>
                                            </ul>
                                        </li>";
                                        }else{
                                            echo "<li class='dropdown'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-pencil icon-white'></i> Master Data <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                <li><a href='?halaman=m_regional'>Master Data Regional</a></li>
                                                <li><a href='?halaman=m_lokasi'>Master Data Lokasi</a></li>
                                                <li><a href='?halaman=m_sumberair'>Master Data Sumber Air</a></li>
                                            </ul>
                                        </li>";
                                        }
                                        
                                        if($_GET['halaman']=='m_foto' || $_GET['halaman']=='m_peta_off'){
                                            echo " <li class='dropdown aktif'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-uploads'></i> Upload File <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>                                                
                                                <li><a href='?halaman=m_foto'>Upload Foto Jaringan</a></li>
                                                <li><a href='?halaman=m_peta_off'>Upload Foto Peta Offline</a></li>
                                            </ul>
                                        </li>";
                                        }else{
                                            echo " <li class='dropdown'>
                                            <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-uploads icon-white'></i> Upload File <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>                                                
                                                <li><a href='?halaman=m_foto'>Upload Foto Jaringan</a></li>
                                                <li><a href='?halaman=m_peta_off'>Upload Foto Peta Offline</a></li>
                                            </ul>
                                        </li>";
                                        }
                                    /*----------------*/
                                } 

                                ?>

                                    </ul>
                                </div>                            
                        </div>
                    </div>
                </div> 

             <?php  
                    include "../status_alert.php";
             ?> 

                
                <div id='box-waktu'>                    
                    <?php  
                        include "../componen/fungsi/jam.php";
                      ?>    
                </div>
            
            <!-- main content -->            
                <div class="main_content">                    
				  <div id="isi">
					<?php 
						include "moduladmin.php"; 
						?>							
					</div>
                </div>            		
		

        <div id='foot'>
 		<a href="<?php echo "$_SERVER[PHP_SELF]"; ?>"><p align="center">Copyright &copy; <?php echo date('Y'); ?> Dinas Pekerjaan Umum Kabupaten Kediri</p></a>
  		</div> 

  		</div> 


                        

            <!--
            <script src="../componen/gebo/jquery.min.js"></script>
            <script src="konf_global/usman/jquery-1.7.2.min.js"></script>            
            <script src="konf_global/usman/jquery-ui-1.8.21.custom.min.js"></script>            
            <script src="konf_global/usman/bootstrap-tooltip.js"></script>            
            <script src="konf_global/usman/jquery.noty.js"></script>
            
            -->            

            <script src="../componen/js/bootstrap-alert.js"></script>
            <script src="../componen/gebo/bootstrap.min.js"></script>
            <script src="../componen/gebo/gebo_common.js"></script>
            
            <!-- styled form elements -->
            <script src="../componen/gebo/jquery.uniform.min.js"></script>            
            <!-- multiselect -->
            <script src="../componen/gebo/jquery.multi-select.min.js"></script> 
            <!-- masked inputs
            <script src="../componen/gebo/jquery.inputmask.min.js"></script> -->           
            <!-- smart resize event -->
            <script src="../componen/gebo/jquery.debouncedresize.min.js"></script>
            <!-- hidden elements width/height -->
            <script src="../componen/gebo/jquery.actual.min.js"></script>
            <!-- js cookie plugin -->
            <script src="../componen/gebo/jquery.cookie.min.js"></script>            
            <!-- tooltips -->
            <script src="../componen/gebo/jquery.qtip.min.js"></script>
            <!-- jBreadcrumbs -->
            <script src="../componen/gebo/jquery.jBreadCrumb.1.1.min.js"></script>
            <!-- sticky messages -->
            <script src="../componen/gebo/sticky.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="../componen/gebo/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="../componen/gebo/antiscroll.js"></script>
            <script src="../componen/gebo/jquery-mousewheel.js"></script>
            <!-- lightbox -->
            <script src="../componen/gebo/jquery.colorbox.min.js"></script>
            <!-- common functions -->
                        
            <!-- datatable -->
            <script src="../componen/gebo/jquery.dataTables.min.js"></script>
            <script src="../componen/gebo/Scroller.min.js"></script>
            <!-- datatable functions -->
            <script src="../componen/gebo/gebo_datatables.js"></script>
            <script src="../componen/gebo/gebo_tables.js"></script>

            
            <script>
                $(document).ready(function() {
                    //* show all elements & remove preloader
                    setTimeout('$("html").removeClass("js")',1000);

                    //panggil fancy box
                    $("a.grup").fancybox({          
                        'overlayShow'   :   true
                    });
                });
            </script>


	</body>
    
<?php 
}
}
?>