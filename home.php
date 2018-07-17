<?php 
error_reporting(0);
$judul = "Sistem Informasi Database Jaringan Pipa Air Bersih Kabupaten Kediri - Jawa Timur";
	
 ?>

<html>
<head>    
    <link rel="shortcut icon" href="webicons.ico" type="image/x-icon" />
    <style type="text/css" media="screen">
    	.input-captca{font-weight: bolder; font-size: 13px;}
    </style>
    <script type='text/javascript'>
            //<![CDATA[
            msg = "Selamat Datang di";
            msg = " .:Sistem Informasi Database Jaringan Pipa Air Bersih Kabupaten Kediri:. " + msg;pos = 100;
            function scrollMSG() {
                document.title = msg.substring(pos, msg.length) + msg.substring(0, pos); pos++;
                if (pos > msg.length) pos = 0
                window.setTimeout("scrollMSG()",200);
            }
            scrollMSG();
            //]]>
    </script>

    <title><?php echo "$judul"; ?></title>    
    <script src="componen/js/jquery-1.7.2.js"></script>
    <script src="componen/js/bootstrap-modal.js"></script>               
    <link href="componen/css/bootstrap.css" rel="stylesheet">
    <link href="componen/css/docs.css" rel="stylesheet">    
    <link rel="stylesheet" href="componen/css/style-login.css" type="text/css" >
	

<!--     <link rel="stylesheet" href="konf-global/css/style-tombol.css" type="text/css" > -->
	
</head>
<body>
    <script src="componen/js/jquery.min.js"></script>
	<script src="componen/js/jquery.backstretch.min.js"></script>
	<script>
    $.backstretch("componen/img/bags/bg-login.jpg");
	</script>

<div id='box-luar'>
	<div id='box-dalam'>
		<div id="header-bar">
				<div id="header-1">
				<div class="judul-header bungkus-logo" style=" height:85px; margin-top:-20px">
				<a href="index.php">
					<div class="eheader" style="margin-top:30px;"><strong>PEMERINTAH KABUPATEN KEDIRI</strong></div>
					<div class="sistem">SISTEM INFORMASI DATABASE<br>
				JARINGAN PIPA AIR BERSIH KABUPATEN KEDIRI</div>
				</a>		
				</div>	
			</div>
			</div>

          <div id="modal-from-dom" class="modal hide fade">
          	<form id="form_login" action="componen/dbkonek/validasilog.php" method="POST" accept-charset="utf-8">
          		<div class="top_b">Login ke Halaman Pengaturan Sistem</div>
          		<div class="alert alert-info alert-login">
					Silahkan Anda Login sesuai dengan Username & Password Anda. Sistem akan secara otomatis mendeteksi Level Akses Anda.
				</div>

				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" id="username" name="username" placeholder="Username"/>
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password"/>
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<img src="componen/capt/CaptchaSecurityImages.php?width=100&height=40&characters=5" class='img-capt'>
							<input class='input-captca' type="text" id="password" name="security_code" placeholder="Kode Keamanan"/>
						</div>
					</div>					
				</div>

				<div class="btm_b clearfix">					
					<button class="btn btn-inverse pull-right" type="reset">Reset</button>
					<button class="btn btn-inverse pull-right" type="submit">Login COYS</button>
				</div>
				<div class='cr'>
					Copyright &copy; Dinas PU Kabupaten Kediri
				</div> 

			</form>
          </div>

          <div class='keterangan-login'>
          		Untuk masuk ke Halaman Pengaturan Sistem, Anda harus melakukan <strong>LOGIN Sebagai Administrator atau Petugas</strong> terlebih dahulu. Bila Anda masuk sebagai User (Pengguna Biasa) maka Anda tidak perlu LOGIN dan hanya cukup menekan tombol "Halaman User" di bawah ini:
          		<!-- <div class='link-user'><a href="media.php?halaman=home">MENUJU HALAMAN HOME</a> -->
          		</div>
          </div>
          <a href="media.php?page=home"><button class="btn btn-success">HALAMAN USER</button></a>
          <button data-controls-modal="modal-from-dom" data-backdrop="true" data-keyboard="true" class="btn btn-primary">LOGIN (ADMIN DAN PETUGAS)</button>  

	</div>	
</div>
	</body>
</html>