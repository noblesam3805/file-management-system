<?php 
session_start();
$_SESSION["time"]= time();
include 'remita_constants.php';
$amount = $_POST["amt"];
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = $_POST["payerName"];
$payerEmail = $_POST["payerEmail"];
$payerPhone = $_POST["payerPhone"];
$responseurl = PATH . "/sample-receipt-page.php";
$concatString = MERCHANTID . SERVICETYPEID . $orderID . $amount . $responseurl . APIKEY;
$hash = hash('sha512', $concatString);
$paymenttype = $_POST["paymenttype"];
?>
<html>
<p>You will be redirected to Remita in few seconds.......</p>
<form action="<?php echo GATEWAYURL; ?>" id="remita_form" name="remita_form" method="POST">
<input id="merchantId" name="merchantId" value="<?php echo MERCHANTID; ?>" type="hidden"/>
<input id="serviceTypeId" name="serviceTypeId" value="<?php echo SERVICETYPEID; ?>" type="hidden"/>
<input id="amt" name="amt" value="<?php echo $amount; ?>" type="hidden"/>
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