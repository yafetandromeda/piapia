<?php 
	$server="localhost";
	$database="natasyag_piapia37";
	$username="natasyag_piapia";
	$password="gogreen2812";

	mysql_connect($server,$username,$password)
		or die ("GAGAL TERHUBUNG");
	mysql_select_db($database)
		or die ("Database Tidak Ada");
 ?>