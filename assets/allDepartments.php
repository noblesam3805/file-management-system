<?php
include('../application/config/z.php');

$q = $_POST['q'];   
$sql = "SELECT *
FROM department inner join schools
on schools.schoolid = department.schoolid where schools.schoolid = '$q'";
$r = mysql_query($sql);

while($row = mysql_fetch_array($r)){
	$id = $row['deptID'];
	$inst_name = $row['deptName'];
	echo "<option value ='$id'> $inst_name </option>";
}
mysql_close();
?>