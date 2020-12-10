<?php 
session_start();
include 'kee.php';
include 'remita_constants.php';	
function remita_transaction_details($orderId){
		$mert =  MERCHANTID;
		$api_key =  APIKEY;
		$concatString = $orderId . $api_key . $mert;
		$hash = hash('sha512', $concatString);
		$url 	= "https://login.remita.net/remita/ecomm". '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
		//$url 	= "http://www.remitademo.net/remita/ecomm". '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
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

		
	//	$response_message = $response['message'];
$id=0;
				
           				$query2= sqlsrv_query($conn,"select $response_date rrr,orderid from applicationinvoice_gen where status='Approved' and server='2'") or die
(print_r( sqlsrv_errors(), true));

					while(list($rrr,$orderID)=sqlsrv_fetch_array($query2))
					{
			if($orderID !=null)
			{
		$response = remita_transaction_details($orderID);
		$response_code = $response['status'];
		$response_date= $response['transactiontime'];
		
		$ampm = array("AM", "PM");
$response_date = str_replace($ampm, "", $response_date);

		sqlsrv_query($conn,"update eduportal_remita_payment set debit_date='$response_date' where order_ref='$orderID'") or die
(print_r( sqlsrv_errors(), true));
echo "Success: ".$orderID.' '.$response_code.' '.$response_date;
					
			}					?>
               
           
              
                <?php 
				$id= $id +1;
					}
			
				
?>
           Total: NGN<?php echo $id;?>