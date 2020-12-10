<?php
include('../application/config/z.php');

$q = $_GET['q'];   
$sql = "SELECT b.name,b.id FROM states a, lga b where a.id=b.state_id and a.id='$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
//echo "<option value ='1'> 1 </option>";
while($row = sqlsrv_fetch_array($r)){
	//$id = $row['id'];
	$inst_name = $row['name'];
	$inst_id = $row['id'];
	echo "<option value ='$inst_id'> $inst_name </option>";
}
sqlsrv_close($conn);


// include('../application/config/z.php');

// $q = $_GET['q'];   
// $sql = "SELECT * FROM lga";
// $r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
// // echo "<option value ='1'> 1 </option>";
// while($row = sqlsrv_fetch_array($r)){
// //	$id = $row['id'];
// 	$inst_name = $row['name'];
// 	$inst_id = $row['id'];
// 	echo "<option value ='$inst_id'> $inst_name </option>";
// }
// sqlsrv_close($conn);
?>


