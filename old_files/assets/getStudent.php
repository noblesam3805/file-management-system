<?php
include('../application/config/e.php');

$query="select distinct c.student_id,c.reg_no, c.name, c.othername, c.sex, c.programme, c.prog_type, c.password, c.level, c.school from student c order by c.student_id";
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
echo $json_response;
?>