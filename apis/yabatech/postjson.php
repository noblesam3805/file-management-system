<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->
<?php
include 'remita_constants.php';
$totalAmount = "1000";
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = $_POST["name"];
$payerEmail = $_POST["email"];
$payerPhone = $_POST["phone"];
$responseurl = PATH . "/sample-receipt-page.php";
$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
$itemid1="itemid1";
$itemid2="34444".$itemtimestamp;
$itemid3="8694".$itemtimestamp;
$beneficiaryName="Oshadami Mke";
$beneficiaryName2="Mujib Ishola";
$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0360883515";
$beneficiaryAccount2="4017904612";
$beneficiaryAccount3="4017904612";
$bankCode="011";
$bankCode2="050";
$bankCode3="070";
$beneficiaryAmount ="900";
$beneficiaryAmount2 ="50";
$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
$deductFeeFrom3=0;
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
{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"},
{"lineItemsId":"'.$itemid3.'","beneficiaryName":"'.$beneficiaryName3.'","beneficiaryAccount":"'.$beneficiaryAccount3.'","bankCode":"'.$bankCode3.'","beneficiaryAmount":"'.$beneficiaryAmount3.'","deductFeeFrom":"'.$deductFeeFrom3.'"}
]}';
$curl = curl_init(GATEWAYURL);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
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
echo $rrr ;
}
else{
echo "Error Generating RRR - " .$statusMsg;
}
?>