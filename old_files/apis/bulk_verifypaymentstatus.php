<?php
include 'remita_constants.php';
//include 'kee.php';
$rrr=$_GET["RRR"];

//$responseurl="http://www.yabatech.edu.ng/UnifiedYCTPAY/PaymentFeedback.aspx";


                    
                   
		
		$mert =  MERCHANTID;
		$api_key =  APIKEY;

			$concatString = $rrr . $api_key . $mert;

			$hash = hash('sha512', $concatString);

			$url 	= "https://login.remita.net/remita/ecomm".'/' . $mert  . '/' . $rrr . '/' . $hash . '/' . 'status.reg';

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

			$msg = $response['message'];

			$rem = $response['RRR'];
			$transtime=$response['transactiontime'];
			$paidamt =$response['amount'].".0";

			

			if($msg == 'Approved'){

echo "SUCCESS=1&RRR=$rem&TRANS_DATE=$transtime&AMOUNT=$paidamt&RESPONSE_MSG=$msg";
				
			}else{
				echo "-1";
			}
			
		
?>
                    
 