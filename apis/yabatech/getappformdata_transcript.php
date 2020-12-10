<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'kee.php';
$payerID=$_POST["payerID"];
$payername=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid=$_POST["orderId"];
$paymentID=$_POST["paymentID"];
$paymentName=$_POST["paymentName"];
$responseurl="http://www.yabatech.edu.ng/UnifiedYCTPAY/PaymentFeedback.aspx";
$amt=$_POST["amt"];
$acadsession=$_POST["acadsession"];
$paymentdescription=$_POST["paymentdescription"];
$programName=$_POST["programName"];
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $paymentName." FOR ".$payername;
$_SESSION["payment_name"] = $paymentName;
$courieropt=$_POST["courieropt"];
$city=$_POST["city"];
$schname=$_POST["schname"];
$schaddress=$_POST["schaddress"];
$tamt=$_POST["tamt"];
$rate=$_POST["rate"];
$destination=$_POST["destination"];
$courier=$_POST["courier"];
//if($_SERVER['HTTP_REFERER'] =="http://localhost/ytranscript/postfrm.php")
if($_SERVER['HTTP_REFERER'] =="https://erp.yabatech.edu.ng/portal/apis/yabatech/confirmTranscriptPayment.php")
{


$totalAmount = $tamt;
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = $_POST["payerName"];
$payerEmail = $_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$responseurl = "http://erp.yabatech.edu.ng/portal/apis/yabatech/getRemitaResponse.php";
//$responseurl = "http://localhost/YABATECH/apis/yabatech/getRemitaResponse.php";



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
if($paymentID==22)
{
include 'includes/remita_constants_transcriptlocal.php';
$beneficiaryAmount =($amt+$rate)-0;
$beneficiaryAmount2 =0;
}
else
{
include 'includes/remita_constants_transcript_intl.php';
$beneficiaryAmount =($amt+$rate)-0;
$beneficiaryAmount2 =0;
}

$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
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
//echo $statusMsg;
$date =date('Y-m-d H:i:s');
$sql = "INSERT INTO applicationinvoice_gen (payername,payeremail,payerphone,orderid,paymentid,amt,acadsession,paymentdescription,paymentName,rrr,dategenerated,status,sid,payerID,programName) VALUES (?,?, ?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array("$payerName","$payerEmail","$payerPhone","$orderID","$paymentID","$tamt","$acadsession","$description","$paymentName","$rrr","$date","Payment Reference generated","$Orderid","$payerID","$programName");
$query = sqlsrv_query($conn,$sql,$params);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$sql2 = "INSERT INTO transcript_applicants_destinations (rrr,destination_id,address,destination_name,courier) VALUES (?,?, ?,?,?)";
$params2 = array("$rrr","$destination","$schaddress","$schname","$courier");
$query2 = sqlsrv_query($conn,$sql2,$params2);
if( $query2 === false ) {
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close($conn);
?>
<form action="https://erp.yabatech.edu.ng/portal/index.php?register/choosePaymentMethod" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
<?php }
else{
	
	?>
<form action="rrrgen.php" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>
<?php
}

			
			}
else
{
	echo "Sorry Request Denied by Remote Server!";
}
//sqlsrv_close($conn);
?>