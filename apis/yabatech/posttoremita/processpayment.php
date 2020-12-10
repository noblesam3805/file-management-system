<?php 
session_start();
include 'remita_constants.php';
include 'kee.php';
$payerName=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid='JAMB-UTME-0002';
$paymentID='1002';
$paymentName="YABATECH CBT CENTRE 2";
$responseurl=PATH . "/sample-receipt-page.php";
$amt=$_POST["amt"];
$acadsession="2016/2017";
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $payerName." PAYMENT FOR USE OF ".$paymentName." FOR UTME";
$_SESSION["payment_name"] = $paymentName;
$timesammp=DATE("dmyHis");
$orderID = $timesammp;
$concatString = MERCHANTID . SERVICETYPEID . $orderID . $amt . $responseurl . APIKEY;
$payerID= "JAMB-UTME";
$hash = hash('sha512', $concatString);
$paymenttype ="RRRGEN";
$date =date('Y-m-d H:i:s');
$rrr ="RRR";
$sql = "INSERT INTO applicationinvoice_gen (payername,payeremail,payerphone,orderid,paymentid,amt,acadsession,paymentdescription,paymentName,rrr,dategenerated,status,sid,payerID) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array("$payerName","$payerEmail","$payerPhone","$orderID","$paymentID","$amt","$acadsession","$description","$paymentName","$rrr","$date","Payment Reference generated","$Orderid","$payerID");
$query = sqlsrv_query($conn,$sql,$params);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close($conn);
?>
<html>
<p>You will be redirected to Remita in few seconds.......</p>
<form action="<?php echo GATEWAYURL; ?>" id="remita_form" name="remita_form" method="POST">
<input id="merchantId" name="merchantId" value="<?php echo MERCHANTID; ?>" type="hidden"/>
<input id="serviceTypeId" name="serviceTypeId" value="<?php echo SERVICETYPEID; ?>" type="hidden"/>
<input id="amt" name="amt" value="<?php echo $amt; ?>" type="hidden"/>
<input id="responseurl" name="responseurl" value="<?php echo $responseurl; ?>" type="hidden"/>
<input id="hash" name="hash" value="<?php echo $hash; ?>" type="hidden"/>
<input id="payerName" name="payerName" value="<?php echo $payerName; ?>" type="hidden"/>
<input id="paymenttype" name="paymenttype" value="<?php echo $paymenttype; ?>" type="hidden"/>
<input id="payerEmail" name="payerEmail" value="<?php echo $payerEmail; ?>" type="hidden"/>
<input id="payerPhone" name="payerPhone" value="<?php echo $payerPhone; ?>" type="hidden"/>
<input id="orderId" name="orderId" value="<?php echo $orderID; ?>" type="hidden"/>
</form>
<script type="text/javascript">document.getElementById("remita_form").submit();</script>
</html>