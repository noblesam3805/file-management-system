<?php
	include('../application/config/database.php');

$con = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']) or die("fail");
$db = mysql_select_db($db['default']['password']);

echo $con;
?>