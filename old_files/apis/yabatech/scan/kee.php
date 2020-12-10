<?php  

	$myServer = "localhost";
	$myUser ="alvanpor_yabatec"; 
	$myPass ="376436@@GT%$7qft";
	$myDB = "alvanpor_yabatech"; //not needed already specified in odbc.ini

	
	//connection to the database
	$con = mysql_connect($myServer, $myUser, $myPass) or die (mysql_error());
	$db = mysql_select_db($myDB);
	
?>