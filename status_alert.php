<?php 

	if($_GET['mod']=='foto'){
		if($_GET['p']=='fo-oke'){
			echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Upload Berhasil<br>Foto telah berhasil terupload di Server dan datanya telah tersimpan di Database</strong>.
			</div>
       ";   
		}elseif($_GET['p']=='fo-gagal'){
			echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf terjadi kesalahan.<br>Foto tidak berhasil terupload di Server dan Datanya tidak berhasil disimpan di Database. Coba Anda ulangi lagi proses Upload Foto</strong>.
			</div>
       ";   
		}elseif($_GET['p']=='del-gagal'){
			echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf terjadi kesalahan.<br>Foto tidak berhasil terhapus baik di Server dan Database</strong>.
			</div>
       ";   
		}elseif($_GET['p']=='del-oke'){
			echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Semua Foto Telah Berhasil Terhhapus baik di Server maupun Database</strong>.
			</div>
       ";   
		}
	}elseif($_GET['mod'] == 'line'){
		$data = "Data Line Pipa";
		if($_GET['p']=='li-oke'){
			echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
		}elseif($_GET['p']=='li-oke-up'){
			echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
       	}if($_GET['p']=='li-oke-rem'){
			echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus $data Berhasil<br>$data yang Anda pilih telah berhasil terhapus dari Database</strong>.
			</div>
       		";
       	}
       	elseif($_GET['p']=='li-gagal'){
			echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
		}
    }elseif($_GET['mod']=='lokasi'){
    	$data = "Data Lokasi";
    	if($_GET['p']=='lo-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='lo-oke-up'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='lo-oke-rem'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus $data Berhasil<br>$data yang Anda pilih telah berhasil terhapus dari Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='lo-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
    	}
    }elseif($_GET['mod']=='point'){
    	$data = "Data Point";
    	if($_GET['p']=='po-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='po-oke-up'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='po-oke-rem'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus $data Berhasil<br>$data yang Anda pilih telah berhasil terhapus dari Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='po-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
    	}
    }elseif($_GET['mod']=='reg'){
    	$data  = "Data Regional (Kecamatan)";
    	if($_GET['p']=='re-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='re-oke-up'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='re-oke-rem'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus $data Berhasil<br>$data yang Anda pilih telah berhasil terhapus dari Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='re-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
    	}
    }elseif($_GET['mod']=='sumber'){
    	$data = "Sumber Air";
    	if($_GET['p']=='su-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='su-oke-up'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='su-oke-rem'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus $data Berhasil<br>$data yang Anda pilih telah berhasil terhapus dari Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='su-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
    	}
    }elseif($_GET['mod']=='user'){
    	$data = "Data User";
    	if($_GET['p']=='us-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Simpan $data Berhasil<br>$data telah berhasil tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='us-oke-up'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Perbarui $data Berhasil<br>$data telah berhasil diperbarui  dan tersimpan di Database</strong>.
			</div>
       		";
    	}elseif($_GET['p']=='us-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Terjadi Kesalahan.<br>Proses Manajemen $data tidak berhasil dilaksanakan oleh Sistem. Segera Anda mengkonfirmasi hal ini pada Administrator</strong>.
			</div>
       		";
    	}
    }elseif($_GET['mod']=='log'){
    	if($_GET['p']=='lolos-ad'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Selamat, Anda Berhasil Masuk ke Sistem Manajemen Data Jaringan Pipa Air Bersih Kab. Kediri<br>Level Account Anda adalah Administrator</strong>.
			</div>
      		";   
    	}elseif($_GET['p']=='lolos-pe'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Selamat, Anda Berhasil Masuk ke Sistem Manajemen Data Jaringan Pipa Air Bersih Kab. Kediri<br>Level Account Anda adalah Petugas</strong>.
			</div>
      		";
    	}elseif($_GET['p']=='salah-acc'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Username atau Password Anda Salah<br>Pastikan kembali Username dan Password yang Anda ketik telah benar</strong>.
			</div>
      		";
    	}elseif($_GET['p']=='salah-kode'){
    		echo "<div class='alert'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Kode Keamanan yang Anda tulis tidak benar<br>Pastikan Anda menuliskan Kode Keamanan dengan benar</strong>.
			</div>
      		";
    	}elseif($_GET['p']=='acc-nonaktif'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Account Anda telah tidak Aktif<br>Untuk mengaktifkan kembali Account Anda bisa mengkonfirmasi ke Administrator</strong>.
			</div>
      		";
    	}elseif($_GET['p']=='error'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Proses tidak direspon sistem<br>Anda telah mencoba sesuatu yang tidak benar</strong>.
			</div>
      		";
    	}
    }elseif($_GET['mod']=='logs'){
    	$data = "Data History Log";
    	if($_GET['p']=='log-oke'){
    		echo "<div class='alert alert-success'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Proses Hapus Berhasil.<br>Semua $data telah berhasil terhapus di Database</strong>.
			</div>
      		";
    	}elseif($_GET['p']=='log-gagal'){
    		echo "<div class='alert alert-error'>
			<a class='close' data-dismiss='alert'>×</a>
			<strong>Maaf, Proses Hapus $data Gagal</strong>.
			</div>
      		";	
    	}
    }
 ?>