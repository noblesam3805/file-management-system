<?php
session_start();
include '../application/config/remita_constants_live.php';
$rrr=trim($_POST["rrr"]);
$responseurl=$_POST["responseurl"];
//$mert =  '2547916';

			//$api_key =  '1946';

$concatString = MERCHANTID.$rrr.APIKEY;

			$hash = hash('sha512', $concatString);
$_SESSION["RESPONSEURL"]=$responseurl
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body><p>You will be redirected to Remita in few seconds.......</p>
            <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  <input name="merchantId" value="<?php echo MERCHANTID;?>" type="hidden"> 
                   <input name="hash" value="<?php echo $hash;?>" type="hidden"> 
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo "http://erp.yabatech.edu.ng/portal/apis/payonlineresponse.php";?>" type="hidden"> 
                  	<input type="hidden" name="paymenttype" class="form-control" value="MASTERCARD" />

                 
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
  </body>
</html>