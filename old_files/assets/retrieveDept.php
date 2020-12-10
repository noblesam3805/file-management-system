<?php
include('../application/config/z.php');
$q = $_GET['q'];   
$sql = "SELECT * FROM department where schoolid ='$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());

echo "<option value=''>SELECT YOUR DEPARTMENT</option>";
while($row = sqlsrv_fetch_array($r)){
	$id = $row['deptID'];

	$inst_name = $row['deptName'];
	echo "<option value ='$id'> $inst_name </option>";
}
sqlsrv_close($conn);
?>