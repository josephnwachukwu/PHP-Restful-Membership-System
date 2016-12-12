<?php
	$hostname = "hostname";
	$database = "database_name";
	$username = "database_username";
	$password = "database_password";
	
	$login = mysql_connect ( $hostname, $username, $password ) or trigger_error ( mysql_error(),E_USER_ERROR );
	mysql_select_db ( $database );
?>
