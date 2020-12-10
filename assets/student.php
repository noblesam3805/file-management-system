<?php
include('../application/config/e.php');
if( $_REQUEST['name'] )
{
   $id = $_REQUEST['name'];
$query="select distinct c.* from student c where c.student_id ='".$id."' order by c.student_id ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;
	}
}

# JSON-encode the response
$json_response = json_encode($arr);
//var_dump($json_response);
// # Return the response
echo $json_response;
}
?>