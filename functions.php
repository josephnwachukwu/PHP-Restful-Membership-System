<?php
	// ------------------------------------------------------------------------
	
	/**
	 * Check login
	 *
	 * Applyes restrictions to visitors based on membership and level access
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
 
 
	function checkLogin ( $levels )
	{
		if(!$_SESSION['logged_in'])
		{
			$access = FALSE;
		}
		else {
			$kt = split(' ', $levels);
			
			$query = mysql_query('SELECT Level_access FROM users WHERE ID = "'.mysql_real_escape_string($_SESSION['user_id']).'"');
			$row = mysql_fetch_assoc($query);
			
			$access = FALSE;
			
			while(list($key,$val)=each($kt))
			{
				if($val==$row['Level_access'])
				{//if the user level matches one of the allowed levels
					$access = TRUE;
				}
			}
		}
		if($access==FALSE)
		{
			header("Location: login.php");
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Validate if email
	 *
	 * Determines if the passed param is a valid email
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	
	function valid_email($str)
	{
		return ( ! preg_match ( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str ) ) ? FALSE : TRUE;
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Check unique
	 *
	 * Performs a check to determine if one parameter is unique in the database
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
 
 
	function checkUnique($field, $compared)
	{
		$query = mysql_query ( "SELECT `" . mysql_real_escape_string ( $field ) . "` FROM `users` WHERE `" . mysql_real_escape_string ( $field ) . "` = '" . mysql_real_escape_string ( $compared ) . "'" );
		if ( mysql_num_rows ( $query ) == 0 )
		{
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Validate if numeric
	 *
	 * Validates string against numeric characters
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
 
 
	function numeric($str)
	{
		return ( ! ereg("^[0-9\.]+$", $str)) ? FALSE : TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Validate if alfa numeric
	 *
	 * Validates string against alpha numeric characters
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
 
	function alpha_numeric($str)
	{
		return ( ! preg_match("/^([-a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create a Random String
	 *
	 * Useful for generating passwords or hashes.
	 *
	 * @access	public
	 * @param	string 	type of random string.  Options: alunum, numeric, nozero, unique
	 * @param	none
	 * @return	string
	 */
	 
	 
	function random_string($type = 'alnum', $len = 8)
	{					
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
			
					switch ($type)
					{
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}
	
					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
					}
					return $str;
			  break;
			case 'unique' : return md5(uniqid(mt_rand()));
			  break;
		}
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Get username - Returns the username of the logged in member based on session ID
	 *
	 * @access	public
	 * @param	id
	 * @return	string
	 */
	 
	 
	function get_username ( $id )
	{
		$query = mysql_query("SELECT `Username` FROM `users` WHERE `ID` = '" . mysql_real_escape_string ( $id ) . "'");
		
		if ( mysql_num_rows ( $query ) == 1 )
		{
			$row = mysql_fetch_array ( $query );
			
			return $row['Username'];
		}
		else {
			return FALSE;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Is admin - Determines if the logged in member is an admin
	 *
	 * @access	public
	 * @param	id
	 * @return	bool
	 */
	 
	
	function isadmin ( $id )
	{
		$query = mysql_query("SELECT `Level_access` FROM `users` WHERE `ID` = '" . mysql_real_escape_string ( $id ) . "'");
		
		if ( mysql_num_rows ( $query ) == 1 )
		{
			$row = mysql_fetch_array ( $query );
			
			if ( $row['Level_access'] == 1 )
			{
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}
?>