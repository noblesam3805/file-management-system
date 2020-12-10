<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'remita_constants.php';
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
$tamt=0;
$rate='0.0';
$dest="";
if(!isset($courieropt))
{
	echo "Error: Invalid Request!";
	exit;
}
if($courieropt=='NIPOST')
{
	$tamt=$amt;
	$query3= sqlsrv_query($conn,"select * from courier_rates where id='$city'") or die (print_r( sqlsrv_errors(), true));

						while(list($id,$destination,$zn,$r)=sqlsrv_fetch_array($query3))
							
							{
								
								$dest=$destination;
								
							}
}
else
{
$query3= sqlsrv_query($conn,"select * from courier_rates where id='$city'") or die (print_r( sqlsrv_errors(), true));

						while(list($id,$destination,$zn,$r)=sqlsrv_fetch_array($query3))
							
							{
								$tamt=$rate+$amt;
								$dest=$destination;
								$rate=$r;
							}
}
?>
 <form action="confirmTranscriptPayment.php" name="SubmitRemitaForm5" id="SubmitRemitaForm5" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />
										<input type="hidden" name="courieropt" value="<?php echo $courieropt;?>" />
										<input type="hidden" name="city" value="<?php echo $city;?>" />
										<input type="hidden" name="schname" value="<?php echo $schname;?>" />
										<input type="hidden" name="schaddress" value="<?php echo $schaddress;?>" />
										<input type="hidden" name="tamt" value="<?php echo $tamt;?>" />
										<input type="hidden" name="rate" value="<?php echo $rate;?>" />
										<input type="hidden" name="destination" value="<?php echo $dest;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm5").submit();</script> 
