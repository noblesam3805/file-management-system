<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Making Payment via eTranzact</title>
</head>
<body topmargin="0" leftmargin="0" >
<?php
//Generate your own unique transId per transaction.
$i = 0;
$tmp = mt_rand(1,9);
do {
    $transId .= mt_rand(0, 9);
} while(++$i < 15);
//echo $tmp;
//$transId = "1234567589101112";
//var_dump($transId);
//if ($transId==null) $transId="";
$terminalId = "0000000001";
$responseurl = 'http://www.alvanportal.edu.ng/eduportal/assets/paymentClient.php';
//if ($terminalId == null) $terminalId = "0000000001";
$success = $HTTP_POST_VARS["SUCCESS"];
//$success = '0';
$amount = $HTTP_SESSION_VARS["TOTAL"];
if ($amount == NULL) $amount = 19000;
//session_register("TOTAL");
//echo "Amount Charged: ".$amount;
$descr = $HTTP_GET_VARS["DESCRIPTION"];
if ($descr == NULL) $descr = "";
$secret_key="DEMO_KEY";
$str=$amount.$terminalId.$transId.$responseurl.$secret_key;
$checksum=md5($str);
//echo "Requesting Transaction ID . . .  ";
if ($success == null){ //or success = "" for php
	echo "<form method='POST' action='http://demo.etranzact.com/WebConnectPlus/query.jsp'>";
	echo "<input type='hidden' name='TERMINAL_ID' value='".$terminalId."'>";
	echo "<input type='hidden' name = 'TRANSACTION_ID' value='".$transId."'>";
	echo "<input type='hidden' name = 'AMOUNT' value='".$amount."'>";
	echo "<input type='hidden' name = 'DESCRIPTION' value='My Payment Description'>";
	echo "<input type='hidden' name = 'EMAIL' value='xyz@yahoo.com'>";
	echo "<input type='hidden' name = 'CURRENCY_CODE' value='NGN'>";
	echo "<input type='hidden' name = 'RESPONSE_URL' value='http://www.alvanportal.edu.ng/eduportal/assets/queryCard.php'>";
	echo "<input type='hidden' name = 'CHECKSUM' value='".$checksum."'>"; 
	echo "<input type=hidden name = 'ECHODATA' value='
			<customerinfo><firstname>Emmanuel</firstname><lastname>Etti</lastname><phoneno>08131342381</phoneno><e
			mail>etti.emman@gmail.com</email><address></address><city></city><state></state><zipcode></zipcode><
			postalcode></postcode><country></country><otherdetails></otherdetails></customerinfo>'>";
	echo "<input type='hidden' name = 'LOGO_URL' value='http://www.mywebsite.com/receipt.php/mfmlogo.jpg'>";
	echo "</form>";
	echo "<script language='javascript'>";
	echo "var form = document.forms[0];";
	echo "form.submit()</script>";
}else if ($success == "0"){
	//deal with successful transaction
	echo "Transaction Successful";

	session_register("transId");


}else	//Deal with Timeout Here, Transaction ID no more valid
	echo "Error while requesting for transaction authorisation, Transaction ID no more valid ";
?>
</body>
</html>
