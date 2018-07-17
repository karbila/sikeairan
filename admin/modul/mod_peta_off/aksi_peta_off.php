<?php
    error_reporting(0);
    include '../../../componen/dbkonek/confdb.php';

    $hal = "m_peta_off";
    $simpanoke = "&mod=foto&p=fo-oke";
    $simpangagal = "&mod=foto&p=fo-gagal";
    $delgagal = "&mod=foto&p=del-gagal";
    $deloke = "&mod=foto&p=del-oke";
    

    if($_GET['proses']=='upload_foto'){

            for($i=0;$i<count($_FILES['photo']['name']);$i++){
                $file   =$_FILES['photo']['name'][$i];
                $filerand = rand(0000, 9999)."_".$file;
                $lokasi =$_FILES['photo']['tmp_name'][$i];
                

                if(!empty($file)){    
                        $dt = mysql_fetch_array(mysql_query("SELECT nama_sumber FROM tbl_sumber WHERE id_sumber='$_POST[sum]'"));                
                        $desti = "../../foto_peta_offline/$dt[nama_sumber]/";
                        
                        mkdir("$desti", 0755);
                        
                        move_uploaded_file($lokasi,$desti.$filerand);
                        $tgl = date('Y-m-d');
                        $d = "INSERT INTO tbl_peta_off (id_sumber, nama_foto, tanggal_upload) VALUES ('$_POST[sum]', '$filerand', '$tgl')";
                        //echo "$d<br>";
                        if(mysql_query($d)){
                            //echo "Berhasil mengupload <b>$filerand</b><br>".mysql_error();        
                            header("location:../../index.php?halaman=$hal$simpanoke");
                        }else{
                            //echo "Gagal<br>".mysql_error();    
                            header("location:../../index.php?halaman=$hal$simpangagal");
                        }
                }
                continue;
        }
    }elseif($_GET['proses']=='edit_foto'){

        for($n=0; $n<count($_FILES['ftupload']['name']); $n++){
                $file   =$_FILES['ftupload']['name'][$n];
                $filerand = rand(0000, 9999)."_".$file;
                $lokasi =$_FILES['ftupload']['tmp_name'][$n];
                $gb = $_POST['gambar'][$n];

                if(!empty($file)){
                    $dt = mysql_fetch_array(mysql_query("SELECT nama_sumber FROM tbl_sumber WHERE id_sumber='$_POST[idsum]'"));
                    $desti = "../../foto_peta_offline/$dt[nama_sumber]/";
                    //unlink($desti.$gb);
                    $a = $desti.$gb;
                    if(file_exists($a)){
                        
                        unlink($a);

                        move_uploaded_file($lokasi,$desti.$filerand);                        
                        
                        $dt = mysql_fetch_array(mysql_query("SELECT id_peta FROM tbl_peta_off WHERE nama_foto LIKE  '%$gb%'"));
                        $s = "UPDATE  tbl_peta_off SET  nama_foto =  '$filerand' WHERE  tbl_peta_off.id_peta = '$dt[id_peta]'";
                        
                        if(mysql_query($s)){
                            //echo "oke<br>";
                            header("location:../../index.php?halaman=$hal$simpanoke");
                        }else{
                            //echo "gagal<br>";
                            header("location:../../index.php?halaman=$hal$simpangagal");
                        }
                        

                    }else{
                        //echo "gak ada<br>";
                        header("location:../../index.php?halaman=$hal$simpangagal");
                    }
                }
        
        continue;    
        }   
        
        
    }elseif($_GET['proses']=='del_foto'){
        echo "";
        //echo "$_GET[id]";
        // $g = "SELECT p.id_peta, p.nama_foto, s.nama_sumber FROM tbl_peta_off p, tbl_sumber s WHERE s.id_sumber=p.id_sumber AND s.id_sumber='$_GET[id]'";
        // $t = mysql_query($g);
        
        // while ($r = mysql_fetch_array($t)) {
        //     $desti = "../../foto_peta_offline/$r[nama_sumber]/";
        //     $lokasidel = $desti.$r['nama_foto'];
        //     //echo "$lokasidel<br>";
        //     unlink($lokasidel);

        //     $a = "DELETE FROM tbl_peta_off WHERE id_peta = '$r[id_peta]'";
        //     //echo "$a<br>";
        //     if(mysql_query($a)){
        //         //echo "oke<br>";                
        //         header("location:../../index.php?halaman=$hal$deloke");
        //     }else{
        //         //echo "gagal<br>";
        //         header("location:../../index.php?halaman=$hal$delgagal");
                
        //     }        
        // }
        

        
    }

    
?>
