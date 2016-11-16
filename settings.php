<?php

	session_start();
						//	$_SESSION["UserEmail"] = 'c.kieselmann@web.de';
						//	$_SESSION["UserPermissions"] = 'A';

							
							
	error_reporting(E_ALL);
	ini_set('display_errors', True);
	
	/* The following values can be changed for the MySQL database you want to use */
	
// --- Live Setting - 123reg	
//	$db_username = "bmet-5hh-u-022982";
//	$db_password = "V011eyb@11!";
//	$db_server = "mysql4.clusterdb.net";
//	$db_name = "bmet-5hh-u-022982";

// --- Live Setting - 1&1	
	$db_username = "dbo650064209";
	$db_password = "V011eyb@11!";
	$db_server = "db650064209.db.1and1.com";
	$db_name = "db650064209";

// --- Home Test Setting
	// $db_username = "root";
	// $db_password = "";
	// $db_server = "localhost";
	// $db_name = "volleyball";
	
	/* This value is the path to the upload folder. Make sure that PHP has write access!
		- e.g. uploads/
		- Make sure it has the trailing slash!*/
	$uploadFolder = "uploads/";
	
	/* Permissions follow! A = Admin, U = User */ 
	function GetLoginStatus()
	{
		if (IsSet($_SESSION['UserEmail']) && IsSet($_SESSION['UserPermissions']))
		{
			return $_SESSION['UserPermissions'];		
		}
	}
	
	function CheckToBool($CheckString)
	{
		if (!IsSet($CheckString))
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
	
	function BoolToCheck($CheckBool)
	{
		if ($CheckBool = 0)
		{
			return '';
		}
		else
		{
			return 'checked';
		}
	}
	
	// --- Toggle Debug Mode
	$DebugMode = False;
	
		
?>