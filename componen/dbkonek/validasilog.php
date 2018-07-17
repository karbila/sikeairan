<?php
error_reporting(1);
session_start();
include "./confdb.php";
include "../fungsi/fungsi_antiinject.php";

// if(isset($_POST['security_code'])){
//   echo "good<br>".$_POST['security_code'];
// }else{
//   echo "tidak terkirim";
// }

if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'])) {    
    unset($_SESSION['security_code']);
    //echo "code benar";

    $user = anti_sql_injection($_POST['username']);
    $pass = anti_sql_injection($_POST['password']); 

    //untuk memastika bahwa username dan pass berupa huruf dan angka
    if(!ctype_alnum($user) OR !ctype_alnum($pass)){
      //echo "inject gagal";
     header("location:../../media.php?page=home&mod=log&p=error");
    }else{
      $a = "SELECT username, password, nama_lengkap, level, status FROM users WHERE username='$user' and password='$pass'";
      $sql = mysql_query($a);
      $ketemu=mysql_num_rows($sql);
      $r=mysql_fetch_array($sql);
      
      if ($ketemu == 1){      

        // session_register("username");
        // session_register("password");
        // session_register("nama_lengkap");
        // session_register("level");


        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['nama']= $r['nama_lengkap'];
        $_SESSION['level']= $r['level'];
        
        //udah diinisialisasi di componen/dbkonek/confdb.php
        $waktulog = $currentTime;

        $query=mysql_query("INSERT INTO logs (usernamelog, namalengkaplog, levellog, waktulog) values('$_SESSION[username]','$_SESSION[nama]','$_SESSION[level]','$waktulog')"); 
         
        if($r['status']=='Y'){
          if($_SESSION['level']=="admin"){           
             header("location:../../admin/index.php?halaman=homeadmin&mod=log&p=lolos-ad");
          }elseif($_SESSION['level']=="petugas"){
             header("location:../../admin/index.php?halaman=homepetugas&mod=log&p=lolos-pe");
          }
        }elseif($r['status']=='N'){
          header("location:../../media.php?page=home&mod=log&p=acc-nonaktif");  
        }
      }else{
        //echo "gagal login";
        header("location:../../media.php?page=home&mod=log&p=salah-acc");
      }
    }
  }else{ 
    //echo "kode salah";
    header("location:../../media.php?page=home&mod=log&p=salah-kode");
  }

?>