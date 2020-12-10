<?php
/*
*Author: Emmanuel Etti jr.
*Please create a column payeeID and paymentType very important
*Content of paymentType should be 'Remedial fees', very important
*Please include that in Master.php file
*Also try n duplicate the content of the first comment below 
*	to reflect what is in the database, i will call to clarify
**Badder than Bad**
*Reference Client Data Verification On the XML should look like
*/


include('../application/config/e.php');
if( $_REQUEST['PAYEE_ID'] && $_REQUEST['PAYMENT_TYPE'])
{
   $name = $_REQUEST['PAYEE_ID'];
   $name = rawurldecode($name);
   $type = $_REQUEST['PAYMENT_TYPE'];
   $type = rawurldecode($type);
//$query="select fullname as PayeeName,dept,level,prog_type,session,status as FeeStatus,payeeID,payment_type as PaymentType,reg_no as MAtricNumber,phone as PhoneNumber from etranzact_payment c where c.payeeID ='".$name."' AND c.payment_type = '".$type."' order by c.student_id ";
//$query="select fullname as PayeeName,dept,level,prog_type,session,status as FeeStatus,customer_id as payeeID,description as PaymentType,customer_id as MatricNumber,phone as PhoneNumber from etranzact_payment c where c.id ='".$name."' AND c.description = '".$type."'";

$query="select * from etranzact_payment Limit 1";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if($result->num_rows > 0){
header( "content-type: application/xml; charset=ISO-8859-15" );	
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<FeeRequest>';
	while($data = $result->fetch_assoc()) {
	  foreach($data as $key => $value) {
	    echo "<$key>$value</$key>";
	  }
	  echo '</FeeRequest>';
	}
	$result->close();
	$mysqli->close();
	
	}
	else{
		echo 'N/A1';
	}
}else{
	echo 'N/A2';
}
?>