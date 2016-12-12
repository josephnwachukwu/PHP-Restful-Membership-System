<?php
	$hostname = "localhost";
	$database = "louisdag_fastflowers";
	$username = "louisdag_joseph";
	$password = "aventador1";
	
	$login = mysql_connect ( $hostname, $username, $password ) or trigger_error ( mysql_error(),E_USER_ERROR );
	mysql_select_db ( $database );
?>