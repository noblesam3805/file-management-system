<?php 
session_start();
include 'remita_constants.php';
include 'kee.php';
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
		$url 	= "https://login.remita.net/remita/ecomm". '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
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
		$response_message = $response['message'];
}
?>
<html>
<head>
<title></title>
</head>
<body>
	<div style="text-align: center;">
		<?php if($response_code == '01' || $response_code == '00') { ?>
		<h2>Transaction Successful</h2>
		<p><b>Remita Retrieval Reference: </b><?php echo $rrr; ?><p>
		<?php }else if($response_code == '021') { ?>
						<h2>RRR Generated Successfully</h2>
						<p><b>Remita Retrieval Reference: </b><?php echo $rrr;
						$q=sqlsrv_query($conn,"update applicationinvoice_gen set rrr ='$rrr' where  rrr='RRR' and sid='$_SESSION[orderid]'") or die
(print_r( sqlsrv_errors(), true));
						 ?><p>
    
<form action="../choosePaymentMethod.php" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
                 <input name="Orderid" value="<?php echo $_SESSION["orderid"];?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
<?php }	else{ ?>
						<h2>Your Transaction was not Successful</h2>
						<?php if ($rrr !=null){ ?>
						 <p>Your Remita Retrieval Reference is <span><b><?php echo $rrr; ?></b></span><br />
						<?php } ?> 
						  <p><b>Reason: </b><?php echo $response_message; ?><p>
		 <?php }?>
	</div>
</body>
</html>