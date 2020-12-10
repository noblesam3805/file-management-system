<?php
session_start();
include 'remita_constants.php';
include 'kee.php';
error_reporting(E_ALL & ~E_NOTICE);
$payerID=$_POST["payerID"];
$payername=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid=$_POST["orderId"];
$paymentID=$_POST["paymentID"];
$paymentName=$_POST["paymentName"];
$responseurl="http://www.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$amt=$_POST["amt"];
$acadsession=$_POST["acadsession"];
$paymentdescription=$_POST["paymentdescription"];
$programName=$_POST["programName"];
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $paymentName." FOR ".$payername;
$_SESSION["payment_name"] = $paymentName;

	$ben1amt=$amt - 0;
    $ben2amt=0;
	
$totalAmount = $amt;
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = $_POST["payerName"];
$payerEmail = $_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$responseurl = "https://erp.yabatech.edu.ng/portal/apis/yabatech/getRemitaResponse.php";
$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
$itemid1="itemid1";
$itemid2="34444".$itemtimestamp;
$itemid3="8694".$itemtimestamp;
$beneficiaryName="Yaba College of Technology";
$beneficiaryName2="GTCO Calscan Nigeria Limited";
//$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0230468761012";
$beneficiaryAccount2="1014488172";
//$beneficiaryAccount3="4017904612";
$bankCode="000";
$bankCode2="057";
//$bankCode3="070";
$beneficiaryAmount =$ben1amt;
$beneficiaryAmount2 =$ben2amt;
//$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
//$deductFeeFrom3=0;
//The JSON data.
$content = '{"merchantId":"'. MERCHANTID
.'"'.',"serviceTypeId":"'.SERVICETYPEID
.'"'.",".'"totalAmount":"'.$totalAmount
.'","hash":"'. $hash
.'"'.',"orderId":"'.$orderID
.'"'.",".'"responseurl":"'.$responseurl
.'","payerName":"'. $payerName
.'"'.',"payerEmail":"'.$payerEmail
.'"'.",".'"payerPhone":"'.$payerPhone
.'","lineItems":[
{"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"},
{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"}
]}';
$curl = curl_init(GATEWAYURL);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
// Disable SSL verification
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$jsonData = substr($json_response, 6, -1);
$response = json_decode($jsonData, true);
$statuscode = $response['statuscode'];
$statusMsg = $response['status'];
if($statuscode=='025'){
$rrr = trim($response['RRR']);
$new_hash_string = MERCHANTID . $rrr . APIKEY;
$new_hash = hash('sha512', $new_hash_string);
echo $rrr;
}
else
{
	echo  "Error Generating RRR:".$response;
}

?>