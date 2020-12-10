<?php  

	$myServer = "localhost";
	$myUser ="root"; 
	$myPass ="";
	$myDB = "yabatech"; //not needed already specified in odbc.ini

	
	//connection to the database
	$con = mysql_connect($myServer, $myUser, $myPass) or die (mysql_error());
	$db = mysql_select_db($myDB);
	
?>