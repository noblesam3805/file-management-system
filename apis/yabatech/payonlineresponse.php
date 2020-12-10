<?php
session_start();
include 'remita_constants.php';
include 'kee.php';
$orderID = "";
$yabaorderID = $_SESSION["orderid"];
if( isset( $_GET['orderID'] )) {
$orderID = $_GET["orderID"];
}
$responseurl=$_SESSION["RESPONSEURL"];
$response_code ="";
$rrr = "";
$response_message = "";
//Verify Transaction
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
	if($orderID !=null){
		$response = remita_transaction_details($orderID);
		$response_code = $response['status'];
		if (isset($response['RRR']))
			{
			$rrr = $response['RRR'];
			}
	//	$response_message = $response['message'];
	if($response_code == '01' || $response_code == '00') {
			//		mysql_query("update applicationinvoice_gen set status ='Approved' where rrr='$rrr'") or die (mysql_error());
					echo "Payment was Successfull. Please Wait...";
					?>
                    
                    <form action="verifypaymentstatus.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="1" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
                        <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm1").submit();</script>

  <?php
						} else{
							echo "Payment was not Successfull. Please Wait...";
							?>
                        
<form action="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Not Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
                        <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>

  <?php
						}
	}else {?>	
	
<form action="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx" name="SubmitRemitaForm3" id="SubmitRemitaForm3" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Not Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
 <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm3").submit();</script>
  <?php
						}?>
