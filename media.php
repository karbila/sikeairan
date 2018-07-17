<?php  
error_reporting(0);
session_start();
include "componen/dbkonek/confdb.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Sistem Informasi Database</title>
    <link rel="icon" href="webicons.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="webicon.ico" type="image/x-icon" />
    <script type='text/javascript'>            
            msg = "Selamat Datang di";
            msg = " .:Sistem Informasi Database Jaringan Pipa Air Bersih Kabupaten Kediri:. " + msg;pos = 100;
            function scrollMSG() {
                document.title = msg.substring(pos, msg.length) + msg.substring(0, pos); pos++;
                if (pos > msg.length) pos = 0
                window.setTimeout("scrollMSG()",200);
            }
            scrollMSG();            
    </script>

    <link rel="stylesheet" href="componen/css/style-admin.css" / type="text/css">
        <link rel="stylesheet" href="componen/css/bootstrap.css" /> 
        <link rel="stylesheet" href="componen/css/eastern_blue.css" id="link_theme" />       
        <link rel="stylesheet" href="componen/css/splashy.css" />
        <link rel="stylesheet" href="componen/css/style-gebo.css" />
        <link href='componen/usman/jquery.noty.css' rel='stylesheet'>
        <link href='componen/usman/noty_theme_default.css' rel='stylesheet'>
        
        <!--<script type="text/javascript" src="componen/js/jquery-1.8.1.min.js"></script>
        -->
        <script src="componen/js/jquery-1.7.2.js"></script>
        <script src="componen/gebo/bootstrap.min.js"></script>
        
        <!-- fancy -->
        <script type="text/javascript" src="componen/fancy/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript" src="componen/fancy/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="componen/fancy/jquery.mousewheel-3.0.4.pack.js"></script> 
        <link rel="stylesheet"  href="componen/fancy/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>


                <!-- BAGIAN DATATABLE !!!!! POSISI INI JANGAN DIRUBAH !!!!! -->

        <script type="text/javascript" charset="utf-8">
                  $(document).ready(function(){
                      $('#datatables').dataTable({
                          "sPaginationType":"full_numbers",
                          "aaSorting":[[0, "asc"]],
                          "bJQueryUI":true
                      });

                      //panggil fancy box
                        $("a.grup").fancybox({          
                            'overlayShow'   :   true
                        });                      
                  });


                  function MM_jumpMenu(targ,selObj,restore){ //v3.0
                      eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
                      if (restore) selObj.selectedIndex=0;
                  }

                  function cetak(){
                       var a=confirm("Apakah Anda Mau Mencetak Semua Data?");
                       if(a==true){
                        self.location.href="comp_user/cetak_tabel_data.php"
                       }
                     }
                function tambahFotoOff(){
                    window.location.href='?page=petaoffline&form=tambahfoto';
                }
        </script>

        <!--
        <script src="componen/lib/DataTables/media/js/jquery.js" type="text/javascript"></script>-->
        <script src="componen/lib/DataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>        
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=id&amp;key=AIzaSyDsGlvjgZxGoDXrWKDA_nB9azrPs7f-F0M"></script>
             
        <style type="text/css">
            @import "componen/lib/DataTables/media/css/demo_table_jui.css";
            @import "componen/lib/DataTables/media/themes/start/jquery-ui.css";
        </style>

        <script src="componen/js/bootstrap-alert.js"></script>        
        <script src="componen/js/bootstrap-modal.js"></script>

        <link rel="stylesheet" href="componen/css/style-login.css" type="text/css" >
        <!-- AKHIR BAGIAN DATATABLE !!!!! POSISI INI JANGAN DIRUBAH !!!!! -->        
    
</head>
    <!-- body -->

    <body class="sidebar_hidden gebo-fixed" onload="peta_awal()">
        <div id="loading_layer" style="display:none"><img src="componen/img/mix/ajax_loader.gif" alt="" /></div>
        <!-- headernya... -->        
        <div id="maincontainer">            
                <?php include 'comp_user/header.php'; ?>
                 <div class="navbar">                
                    <div class="navbar-inner">
                        <div class="container-fluid">                            
                            <ul class="nav user_menu pull-right">
                                <li class="dropdown">
                                     <a href="index.php"><i class="icon-keluar icon-white"></i> Keluar</a> 
                                    <!--<button data-controls-modal="modal-from-dom" data-backdrop="true" data-keyboard="true" class="btn btn-inverse" style='margin-top: 7px;margin-right: 0px;margin-bottom: 6px;'><i class="icon-lock icon-white"></i> Keluar</button> -->                                   
                                </li>
                            </ul>
                                <div class="nav-collapse">
                                    <ul class="nav">

                                        <?php  
                                            if($_GET['page']=='home'){
                                                echo "<li class='dropdown aktif'><a href='?page=home'><i class='icon-home'></i> Home</a></li> ";
                                            }else{
                                                echo "<li class='dropdown'><a href='?page=home'><i class='icon-home icon-white'></i> Home</a></li> ";
                                            }

                                            if($_GET['page']=='data'){
                                                echo "<li class='dropdown aktif'><a href='?page=data'><i class='icon-list-alt'></i> Data</a></li>";
                                            }else{
                                                echo "<li class='dropdown'><a href='?page=data'><i class='icon-list-alt icon-white'></i> Data</a></li>";
                                            }

                                            if($_GET['page']=='peta'){
                                                echo "<li class='dropdown aktif'><a href='?page=peta'><i class='icon-map-marker'></i> Peta Online</a></li> ";
                                            }else{
                                                echo "<li class='dropdown'><a href='?page=peta'><i class='icon-map-marker icon-white'></i> Peta Online</a></li> ";
                                            }

                                            if($_GET['page']=='petaoffline'){
                                                echo "<li class='dropdown aktif'><a href='?page=petaoffline'><i class='icon-map-marker'></i> Peta Offline</a></li> ";
                                            }else{
                                                echo "<li class='dropdown'><a href='?page=petaoffline'><i class='icon-map-marker icon-white'></i> Peta Offline</a></li> ";
                                            }

                                            if($_GET['page']=='panduan'){
                                                echo "<li class='dropdown aktif'><a href='?page=panduan'><i class='icon-question-sign'></i> Panduan</a></li>";
                                            }else{
                                                echo "<li class='dropdown'><a href='?page=panduan'><i class='icon-question-sign icon-white'></i> Panduan</a></li>";
                                            }


                                        ?>

                                                                     
                                    </ul>
                                </div>                            
                        </div>
                    </div>
                </div> 

                <?php  
                    include 'status_alert.php';        
                ?> 

                
                <div id='box-waktu'>                    
                    <?php  
                        include "componen/fungsi/jam.php";
                      ?>    
                </div>
            
            <!-- main content -->            
                <div class="main_content">                    
                  <div id="isi">
                    <?php 
                        include "comp_user/content_user.php";
                    ?>                          
                    </div>
                </div>                  
        

        <div id='foot'>
        <a href="<?php echo "$_SERVER[PHP_SELF]"; ?>"><p align="center">Copyright &copy; <?php echo date('Y'); ?> Dinas Pekerjaan Umum Kabupaten Kediri</p></a>
        </div>



        </div> 


                                
            
            
            <!--           
            <script src="componen/gebo/jquery.uniform.min.js"></script>                        
            <script src="componen/gebo/jquery.multi-select.min.js"></script>             
            <script src="componen/gebo/jquery.debouncedresize.min.js"></script>            
            <script src="componen/gebo/jquery.actual.min.js"></script>            
            <script src="componen/gebo/jquery.cookie.min.js"></script>                        
            <script src="componen/gebo/jquery.qtip.min.js"></script>            
            <script src="componen/gebo/jquery.jBreadCrumb.1.1.min.js"></script>            
            <script src="componen/gebo/sticky.min.js"></script>            
            <script src="componen/gebo/ios-orientationchange-fix.js"></script>            
            <script src="componen/gebo/antiscroll.js"></script>
            <script src="componen/gebo/jquery-mousewheel.js"></script>            
            <script src="componen/gebo/jquery.colorbox.min.js"></script>            
            -->

            <!-- datatable -->
            <script src="componen/gebo/gebo_common.js"></script>
            <script src="componen/gebo/jquery.dataTables.min.js"></script>
            <script src="componen/gebo/Scroller.min.js"></script>
            <!-- datatable functions -->
            <script src="componen/gebo/gebo_datatables.js"></script>
            <script src="componen/gebo/gebo_tables.js"></script>

            
            <script>
                $(document).ready(function() {
                    //* show all elements & remove preloader
                    setTimeout('$("html").removeClass("js")',1000);
                });
            </script>
    </body>


    <!-- akhir body -->



</html>
