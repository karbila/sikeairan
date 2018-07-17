<?php
	session_start();
	if(!isset($_SESSION['namaUser']))
	{
		echo "<script>location.href=\"../?info=belumlogin\";</script>";
	}
?>