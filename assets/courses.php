<?php
include('../application/config/z.php');


$q = $_GET['q'];   
$sql = "SELECT * FROM courses where level ='$q'";
$r = mysql_query($sql);

while($row = mysql_fetch_array($r)){
	//$id = $row['id'];
	$inst_name = $row['course_title'];
	echo "<option value ='$inst_name'> $inst_name </option>";
}
mysql_close()
?>