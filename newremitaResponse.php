<?php
if( isset( $_GET['orderID'] )) {
$orderID = $_GET["orderID"];
header("Location: http://erp.yabatech.edu.ng/portal/apis/payonlineresponse.php?orderID=$orderID");
exit;
}
include('application/config/z.php');



	// if(isset($_SESSION['confirmed'])){echo $_SESSION['confirmed'];}

	

	session_start();



	$raw_post_data = file_get_contents('php://input');

	$response_arr = json_decode(stripcslashes($raw_post_data), TRUE); //use json_decode when the post body is in json format

	
	if($response_arr !== NULL){



	     foreach($response_arr as $value)

	     {

	     	//$output = $value;
 
	     //}

			

			$check_rrr = mysql_query("select * from eduportal_remita_accp_temp_data where rrr = '".$value['rrr']."'");

		

			if(!empty($value['rrr']) && $check_rrr){



			//check if rrr already exists in payment table

				$insertedRecord = mysql_query("select * from eduportal_remita_payment where rrr = '".$value['rrr']."'");

				

				if(mysql_num_rows($insertedRecord) > 0){

					echo "Payment already confirmed for RRR: ".$value['rrr']."! \n";

				}else{



					$updateRow = mysql_query("update eduportal_remita_accp_temp_data set status = 'Payment Confirmed' where rrr = '".$value['rrr']."'");

					

					//if(mysql_num_rows($updateRow) > 0){

						$str  = "insert into eduportal_remita_payment(payment_id, rrr, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date,"; 

						$str .=	"debit_date, bank, branch, service_type, date_sent, date_requested, order_ref)"; 

						$str .=	"values ('".$value['id']."', '".$value['rrr']."', '".$value['channnel']."', '".$value['amount']."',";

						$str .=	" '".$value['payerName']."', '".$value['payerEmail']."', '".$value['payerPhoneNumber']."','".$value['uniqueIdentifier']."',";

						$str .= " '".$value['responseCode']."', '".$value['transactiondate']."', '".$value['debitdate']."', '".$value['bank']."',";

						$str .= " '".$value['branch']."', '".$value['serviceTypeId']."', '".$value['dateSent']."', '".$value['dateRequested']."', '".$value['orderRef']."') ";

				

						$insertRow = mysql_query($str);

						

						if($insertRow){

							echo "Payment Confirmed for RRR: ".$value['rrr']."\n";

						}else{

							die('Error');

						}

					//}else{

					//	die('Error: ' . $mysqli->error);

					//}

				}

			}else{

				echo "Invalid Data: The Data that was sent could not be processed because the RRR value is NULL or Invalid";

			}

		}

	}else

		echo "No data has been received";

	

?>