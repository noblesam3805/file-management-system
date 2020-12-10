<?php



include('kee.php');



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

	

	//check if rrr already exists

	$insertedRecord = mysql_query("select * from eduportal_remita_payment where rrr = '$myPost[0]'");

	

	if(mysql_num_rows($insertedRecord) > 0){

		echo "Payment already confirmed!";

	}else{



		$updateRow = mysql_query("update applicationinvoice_gen set status = 'Payment Confirmed' where rrr = '$myPost[0]'");

		

		//if(mysqli_num_rows($updateRow) > 0){

	

			$insertRow = mysql_query("insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, branch, service_type, date_sent, date_requested, order_ref) values ('$myPost[0]','$myPost[6]', '$myPost[1]', '$myPost[2]', '$myPost[10]', '$myPost[14]', '$myPost[11]', '$uid', '$myPost[4]', '$myPost[3]', '$myPost[3]', '', '$myPost[8]', '$myPost[3]', '', '$myPost[3]', '$myPost[3]')");

			

			if($insertRow){

				echo "Payment Confirmed";
mysql_close();
			}else{

				die('Error: No data was Received!');
mysql_close();
			}

		//}else{

		//	die('Error: ' . $mysqli->error);

		//}

	}

	
mysql_close();
?>