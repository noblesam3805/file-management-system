<?php
include('../application/config/e.php');

if( isset($_REQUEST['id']) )
{
   $id = $_REQUEST['id'];
$query="select * from counter c where c.id ='".$id."' order by c.id ";
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
else{
$query="select * from counter c order by c.id";
//$query="select * from etranzact_paymen";
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
echo $json_response; }
?>