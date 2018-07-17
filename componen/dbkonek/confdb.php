<?php
	$dbhost = 'localhost'; // Isi nama hosting
	$dbuser = 'karbila'; // Isi Nama User MySQL
	$dbpass = 'karbila'; // Isi Password Database MySQL
	$dbname = 'dbairjelas'; // Isi dengan nama Database
	
	$koneksi = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname,$koneksi);
	
	$tanggal=date("Y-m-d");
	$currentTime=date("Y-m-d H:i:s");
	$waktu=date("H:i:s");


	$hari=date('w');
	$tgl =date('d');
	$bln =date('m');
	$thn =date('Y');
	switch($hari){		
		case 0 : {
			$hari='Minggu';
		}break;
		case 1 : {
			$hari='Senin';
		}break;
		case 2 : {
			$hari='Selasa';
		}break;
		case 3 : {
			$hari='Rabu';
		}break;
		case 4 : {
			$hari='Kamis';
		}break;
		case 5 : {
			$hari="Jum'at";
		}break;
		case 6 : {
			$hari='Sabtu';
		}break;
		default: {
			$hari='UnKnown';
		}break;
	}

switch($bln){		
	case 1 : {
		$bln='Januari';
	}break;
	case 2 : {
		$bln='Februari';
	}break;
	case 3 : {
		$bln='Maret';
	}break;
	case 4 : {
		$bln='April';
	}break;
	case 5 : {
		$bln='Mei';
	}break;
	case 6 : {
		$bln="Juni";
	}break;
	case 7 : {
		$bln='Juli';
	}break;
	case 8 : {
		$bln='Agustus';
	}break;
	case 9 : {
		$bln='September';
	}break;
	case 10 : {
		$bln='Oktober';
	}break;		
	case 11 : {
		$bln='November';
	}break;
	case 12 : {
		$bln='Desember';
	}break;
	default: {
		$bln='UnKnown';
	}break;
}
$sekarang="".$hari." , ".$tgl." ".$bln." ".$thn;
?>