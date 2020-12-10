<?php
session_start();
include 'remita_constants.php';
include 'kee.php';
$rrr=$_POST["rrr"];
$responseurl="http://www.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$yabaorderID=0;
$_SESSION["yabaurl"] =$responseurl;
$count=0;
$queryunique=sqlsrv_query($conn,"select sid,orderid,payerphone,payeremail,payername,paymentName from applicationinvoice_gen where rrr = '$rrr' and status='Payment Reference generated'") or die(print_r( sqlsrv_errors(), true));
				
while(list($sid,$oid,$pphone,$pemail,$pname,$payname)=sqlsrv_fetch_array($queryunique))
{
$_SESSION["payment_name"]=$payname;
$yabaorderID =$sid;
$_SESSION["payment_name"] =$payname;
$count =$count +1;
}
?>

<form action="choosePaymentMethod.php" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="http://45.34.15.68/getRemitaResponse.php" type="hidden"> 
                 <input name="Orderid" value="http://45.34.15.68/getRemitaResponse.php" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
  <?php
				if($count<=0)
				{
					echo "RRR does not Exist/Payment has already been Confirmed";
					
				}
				
				?>