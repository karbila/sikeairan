<?php  
$info="SELECT i.id_info, i.jaringan_pipa, i.diameter_pipa, i.jenis_pipa, i.panjang_pipa, i.debit_air, i.lat, i.lng, i.thn_pemasangan, i.kondisi_pipa, i.kondisi_bangunan, i.elevasi, i.keterangan, i.foto1, i.foto2, i.foto3, i.foto4, l.id_lokasi, l.nama_desa, s.id_sumber, s.nama_sumber
       FROM tbl_informasi_point2 i, tbl_lokasi l, tbl_sumber s, tbl_regional r 
       WHERE l.id_lokasi = i.id_lokasi
       AND r.id_regional = l.id_regional
       AND l.id_lokasi = s.id_lokasi
       AND s.id_sumber = i.id_sumber";
?>