<?php
error_reporting(E_ALL & ~E_NOTICE);
include('kee.php');

if($_GET["orderID"])
{
$orderId=$_GET["orderID"];
header("Location: payonlineresponse.php?orderID=$orderId");
exit;
}

	if(isset($_SESSION['confirmed'])){echo $_SESSION['confirmed'];}

	

	session_start();



	$raw_post_data = file_get_contents('php://input');

	$raw_post_array = explode('&', $raw_post_data);

	$myPost = array();

	

	foreach ($raw_post_array as $keyval){

		$a = explode(",", $keyval);

		for($i=0; $i<count($a); $i++){

			$b = explode(':', $a[$i]);

			$myPost[] = trim(str_replace('"', '', $b[1]));

		}

	}

	

	$str = str_replace(']', '', trim($myPost[16]));

	$uid = str_replace('}', '', $str);

	

	// $myPost[0] = ID

	// $myPost[1] = rrr

	// $myPost[2] = channel

	// $myPost[3] = amount

	// $myPost[4] = responseCode

	// $myPost[5] = transactiondate

	// $myPost[6] = debitdate

	// $myPost[7] = bank

	// $myPost[8] = branch

	// $myPost[9] = serviceTypeId

	// $myPost[10] = datesent

	// $myPost[11] = dateRequested

	// $myPost[12] = orderRef

	// $myPost[13] = payerName

	// $myPost[14] = payerEmail

	// $myPost[15] = payerPhoneNumber

	// $myPost[16] = uniqueIdentifier

	
$uniqueno=0;
$orderid=0;
$payid=0;
$email="";
$paydate =  date("jS F Y, H:i:s");
	//check if rrr already exists

	$insertedRecord = sqlsrv_query($conn,"select * from eduportal_remita_payment where rrr = '$myPost[0]'") or die
(print_r( sqlsrv_errors(), true));

	

	if(sqlsrv_num_rows($insertedRecord) > 0){

		echo "Payment already confirmed!";

	}else{
$queryunique= sqlsrv_query($conn,"select sid,orderid,paymentid,payeremail from applicationinvoice_gen where rrr = '$myPost[0]'") or die
(print_r( sqlsrv_errors(), true));
while(list($sid,$oid,$pid,$em)=sqlsrv_fetch_array($queryunique))
{
$uniqueno =$sid;
$orderid =$oid;
$payid=$pid;
$email=$em;
}


		$updateRow = sqlsrv_query($conn,"update applicationinvoice_gen set status = 'Approved' where rrr = '$myPost[0]'");

		

		//if(mysqli_num_rows($updateRow) > 0){

	

			$insertRow = sqlsrv_query($conn,"insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, branch, service_type, date_sent, date_requested, order_ref,status) values ('$myPost[0]','$payid', '$myPost[1]', '$myPost[2]', '$myPost[10]', '$email', '$myPost[11]', '$uniqueno', '', '$myPost[3]', '$myPost[3]', '$paydate', '', '', '$paydate', '$myPost[3]', '$orderid','Approved')");

			

			if($insertRow){

				echo "OK";

			}else{

				die('Error: No data was Received!');

			}

		//}else{

		//	die('Error: ' . $mysqli->error);

		//}

	}

	

?>