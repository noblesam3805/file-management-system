<?php
session_start();
	$server ='localhost';
	$user = 'dmatrix0_admin';
	$pass = 'HTGD<l;HFJD@@**123**';
	$db= 'dmatrix0_eduportal';
	mysql_connect($server,$user,$pass);
	mysql_select_db($db);
	
	$serial = $_GET['serial'];
	//$pin = $_GET['pin'];

	$query = "select * from student where reg_no = '$serial'";
	$r = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($r) > 0){
		//echo "there's a record in database";
        $_SESSION['user'] = $serial;
		echo "ok";
	}else{
		echo "no record found";
        $_SESSION['user'] = $serial;
		$_SESSION['register2'] = "register2";
	}
?>