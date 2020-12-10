<?php
session_start();
require 'remita_constants.php';
$orderID = "";
if( isset( $_GET['orderID'] )) {
$orderID = $_GET["orderID"];
}
$response_code ="";
$rrr = "";
$response_message = "";

//Verify Transaction
function remita_transaction_details($orderId){
		$mert =  MERCHANTID;
		$api_key =  APIKEY;
		$concatString = $orderId . $api_key . $mert;
		$hash = hash('sha512', $concatString);
		$url 	= CHECKSTATUSURL . '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$response = json_decode($result, true);
		return $response;
	}
	if($orderID !=null){
		$response = remita_transaction_details($orderID);
		$response_code = $response['status'];
		if (isset($response['RRR']))
			{
			$rrr = $response['RRR'];
			header("Location: http://localhost:8000/nekede/index.php?student/processRemitaSchoolFeeInvoice/$rrr");
			}
		$response_message = $response['message'];
}
?>
