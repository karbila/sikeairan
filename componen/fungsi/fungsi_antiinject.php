<?php 
	function anti_inject($d){
		$f = stripslashes(strip_tags(htmlspecialchars($d, ENT_QOUTES)));
		return $f;
	}
	function anti_sql_injection($data){
		$filter = mysql_real_escape_string($data);
		return $filter;
	}

 ?>