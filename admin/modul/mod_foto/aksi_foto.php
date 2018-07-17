<?php
    error_reporting(0);
    include '../../../componen/dbkonek/confdb.php';

    $hal = "m_foto";
    $simpanoke = "&mod=foto&p=fo-oke";
    $simpangagal = "&mod=foto&p=fo-gagal";

    if($_GET['proses']=='upload_foto'){
        for ($i =1; $i<=6; $i++){
            $lokasi_file = $_FILES["foto$i"]['tmp_name'];   
             // echo "$i - $lokasi_file <br>";
            $nama_file = $_FILES["foto$i"]['name'];  

            $id_info = $_POST['po'];
            $b = "SELECT i.jaringan_pipa, s.nama_sumber FROM tbl_informasi_point2 i, tbl_sumber s, tbl_lokasi l WHERE s.id_sumber = i.id_sumber AND l.id_lokasi = i.id_lokasi AND l.id_lokasi = s.id_lokasi AND i.id_info = '$id_info'";        
            $a = mysql_fetch_array(mysql_query($b));

            $l = "../../foto_sumber/$a[nama_sumber]/$a[jaringan_pipa]/";
            $lokasi = $l.$nama_file;
            if($i <= 4){
                if(file_exists($l)){
                    if(move_uploaded_file($lokasi_file, $lokasi)){
                    
                        $add = "UPDATE  tbl_informasi_point2 
                                SET  foto$i =  '$nama_file'
                                WHERE  tbl_informasi_point2.id_info ='$id_info'";    
                        //echo "$add<br>";
                        if (mysql_query($add)) {
                            //echo "berhasilll==>$i<br>";
                            header("location:../../index.php?halaman=$hal$simpanoke");
                        }else{
                            //echo "string".mysql_error()."<br>";
                            header("location:../../index.php?halaman=$hal$simpangagal");
                        }
                        // echo "bisa kakaaaak ==> $l => $a[jaringan_pipa],$a[nama_sumber]<br>";

                    }else{
                        header("location:../../index.php?halaman=$hal$simpangagal");
                    }
                }else{
                    mkdir($l, 0, true);
                    move_uploaded_file($lokasi_file, $lokasi);
                    $add = "UPDATE  tbl_informasi_point2 
                            SET  foto$i =  '$nama_file'
                            WHERE  tbl_informasi_point2.id_info ='$id_info'";    
                        //echo "berhasilll";
                    if (mysql_query($add)) {
                        // echo "berhasilll==>$i<br>";
                        header("location:../../index.php?halaman=$hal$simpanoke");
                    }else{
                        //echo "string".mysql_error()."<br>";
                        header("location:../../index.php?halaman=$hal$simpangagal");
                    }
                }    

            }else{
                $index = $i - 4;
                if(file_exists($l)){
                    if(move_uploaded_file($lokasi_file, $lokasi)){
                        
                        $add = "UPDATE  tbl_informasi_point2 
                                SET  blokplan$index =  '$nama_file'
                                WHERE  tbl_informasi_point2.id_info ='$id_info'";    
                        //echo "$add<br>";
                        if (mysql_query($add)) {
                            header("location:../../index.php?halaman=$hal$simpanoke");
                        }else{
                            //echo "string".mysql_error()."<br>";
                            header("location:../../index.php?halaman=$hal$simpangagal");
                        }
                        // echo "bisa kakaaaak ==> $l<br>";
                    }else{
                        header("location:../../index.php?halaman=$hal$simpangagal");
                    }
                }else{
                    mkdir($l, 0, true);
                    move_uploaded_file($lokasi_file, $lokasi);
                    $add = "UPDATE  tbl_informasi_point2 
                            SET  blokplan$index =  '$nama_file'
                            WHERE  tbl_informasi_point2.id_info ='$id_info'";    
                        //echo "$add<br>";
                    //echo "berhasilll";
                    if (mysql_query($add)) {
                        // echo "berhasilll==>$i<br>";
                        header("location:../../index.php?halaman=$hal$simpanoke");
                    }else{
                        //echo "string".mysql_error()."<br>";
                        header("location:../../index.php?halaman=$hal$simpangagal");
                    }
                }
            }
        }
    
    }elseif($_GET['proses']=='edit_foto'){
        for($n=0; $n<count($_FILES['ftupload']['name']); $n++){
                $file   =$_FILES['ftupload']['name'][$n];
                $filerand = rand(0000, 9999)."_".$file;
                $lokasi =$_FILES['ftupload']['tmp_name'][$n];
                $gb = $_POST['gambar'][$n];

                if(!empty($file)){
                    $o = $_POST['idinfo'];
                    $dt = mysql_fetch_array(mysql_query("SELECT i.id_info, i.jaringan_pipa, i.foto1, i.foto2, i.foto3, i.foto4, s.nama_sumber FROM tbl_informasi_point2 i, tbl_sumber s WHERE s.id_sumber=i.id_sumber AND id_info = '$o'"));
                    $desti = "../../foto_sumber/$dt[nama_sumber]/$dt[jaringan_pipa]/";                    
                    //unlink($desti.$gb);
                    $a = $desti.$gb;
                    if($gb=='-'){
                        echo "biarkan<br>";
                    }else{
                        //echo "$a<br>";
                        if(file_exists($a)){
                            
                            // unlink($a);
                            // move_uploaded_file($lokasi,$desti.$filerand);                        
                            $l = $n+1;
                            $k = "SELECT id_info FROM tbl_informasi_point2 WHERE foto$l LIKE  '%$gb%'";
                            echo "$k<br>";

                            
                            
                            //$dt = mysql_fetch_array(mysql_query($k));
                            
                            $s = "UPDATE  tbl_peta_off SET  nama_foto =  '$filerand' WHERE  tbl_peta_off.id_peta = '$dt[id_peta]'";
                            
                            // if(mysql_query($s)){
                            //     //echo "oke<br>";
                            //     header("location:../../index.php?halaman=$hal$simpanoke");
                            // }else{
                            //     //echo "gagal<br>";
                            //     header("location:../../index.php?halaman=$hal$simpangagal");
                            // }
                            

                        }else{
                            //echo "gak ada<br>";
                            header("location:../../index.php?halaman=$hal$simpangagal");
                        }     
                    }
                    
                }
        
        continue;    
        } 
    }

    elseif($_GET['proses']=='del_foto'){
        echo "del foto<br>-->$_GET[id]";
    }
?>
