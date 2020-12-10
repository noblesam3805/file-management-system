<?php

	$myServer = "localhost";
	$myUser ="fpnoedup_admin"; 
	$myPass ="365486@@GT%$7COl";
	$myDB = "fpnoedup_portalfp_nekportal"; //not needed already specified in odbc.ini

	
	//connection to the database
	$con = mysql_connect($myServer, $myUser, $myPass) or die (mysql_error());
	$db = mysql_select_db($myDB);
	
?>