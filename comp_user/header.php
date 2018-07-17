<?php  
    session_start();
	echo "<div id='header-bar'>
                    <div id='header-1'>
                        <div id='logo_header'></div>
                        <div class='judul-header'>";
                        if($_SESSION['level']=='petugas'){
                            echo "<a href='index.php?halaman=homepetugas'>";
                        }elseif($_SESSION['level']=='admin'){
                            echo "<a href='index.php?halaman=homeadmin'>";
                        }else{
                            echo "<a href='media.php?page=home'>";
                        }                        
                            echo "<div class='eheader'>
                                <strong>PEMERINTAH KABUPATEN KEDIRI</strong>
                            </div>
                            <div class='sistem'>
                                SISTEM INFORMASI DATABASE<br>JARINGAN PIPA AIR BERSIH KABUPATEN KEDIRI
                            </div>
                        </a>        
                        </div>  
                    </div>
                </div> ";

?>