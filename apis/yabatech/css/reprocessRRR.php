<?php
include 'remita_constants.php';
include 'kee.php';
$rrr=$_POST["rrr"];
$responseurl="http://www.yabatech.edu.ng/UnifiedYCTPAY/PaymentFeedback.aspx";
$yabaorderID=0;
$_SESSION["yabaurl"] =$responseurl;

$queryunique= mysql_query("select sid,orderid,payerphone,payeremail,payername,paymentName from applicationinvoice_gen where rrr = '$rrr' and status='Payment Reference generated'");
				if(mysql_num_rows($queryunique) > 0){
while(list($sid,$oid,$pphone,$pemail,$pname,$payname)=mysql_fetch_array($queryunique))
{

$yabaorderID =$sid;
$_SESSION["payment_name"] =$payname;
}
?>

<form action="choosePaymentMethod.php" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
                 <input name="Orderid" value="http://162.144.59.193/getRemitaResponse.php" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
  <?php
				}
				else
				{
					echo "RRR does not Exist/Payment has already been Confirmed";
					
				}
				
				?>