<?php
include('../application/config/e.php');

$query="select distinct c.fullname, c.customer_id, c.dept, c.bankname, c.confirm_code, c.description, c.amount from etranzact_payment c order by c.id";
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