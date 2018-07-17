<?php  
	
	error_reporting(0);
	session_start();
	
	include '../../../componen/dbkonek/confdb.php';

	$hal = "m_draw";
    
    $myArray = $_REQUEST[koordinat];

    $pecah = explode(" ", $myArray);

    $jumlah = sizeof($pecah);
    
    for($i = 1; $i<$jumlah; $i++){

    	// echo " -->".$pecah[$i];	
    	// if($i > 0){

    		$split = explode(",", $pecah[$i]);

    		// echo "\n".$split[0]." , ".$split[1]." , ".$split[2];

    		$query = "INSERT INTO tbl_line_pipa (id_sumber, id_koordinat, lat, lng) VALUES($pecah[0], $i, $split[0], $split[1])";

    		// echo $query;
    		if (mysql_query($query)) {
                // echo "berhasilll==>$query<br>";
                header("location:../../index.php?halaman=$hal");
            }else{
                echo "string".mysql_error()."<br>";
            }

    	// }
    }
    

    // $query = "INSERT INTO tbl_line_pipa VALUES()";

?>