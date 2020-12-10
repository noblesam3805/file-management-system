<?php
include 'kee.php';
$rrr=$_POST["rrr"];
$responseurl="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$yabaorderID=0;
$orderref=0;
$pp="";
$pe="";
$pn="";
$ser="";
$uniqueno=0;
$queryunique= sqlsrv_query($conn,"select sid,orderid,payerphone,payeremail,payername,server from applicationinvoice_gen where rrr = '$rrr'") or die(print_r( sqlsrv_errors(), true));
while(list($sid,$oid,$pphone,$pemail,$pname,$server)=sqlsrv_fetch_array($queryunique))
{
$uniqueno =$sid;
$orderref= $oid;
$yabaorderID =$sid;
$pn=$pname;
$pp=$pphone;
$pe=$pemail;
$ser = $server;
echo "Please Wait...";
}
$query= sqlsrv_query($conn,"select * from eduportal_remita_payment where rrr = '$rrr'") or die(print_r( sqlsrv_errors(), true));
		echo "<br>";
		$sql1="select * from eduportal_remita_payment where rrr='$rrr'";
		$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
		$rowcount = sqlsrv_num_rows( $stmt );
		
		if($rowcount > 0){
						$q=sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved' where rrr='$rrr'") or die
(print_r( sqlsrv_errors(), true));
						
?>
                    
                    <form action="http://erp.yabatech.edu.ng/portal/index.php?register/processRemitaReceipt" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
 <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm1").submit();</script>
  <?php
						
						
					}
						else	
				{
if($ser=="2")
{
include 'remita_constants.php';
}
else
{
include 'remita_constants2.php';
}					
		
		$mert =  MERCHANTID;
		$api_key =  APIKEY;

			$concatString = $rrr . $api_key . $mert;

			$hash = hash('sha512', $concatString);

			$url 	= "https://login.remita.net/remita/ecomm".'/' . $mert  . '/' . $rrr . '/' . $hash . '/' . 'status.reg';

			//  Initiate curl

			$ch = curl_init();

			// Disable SSL verification

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			// Will return the response, if false it print the response

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Set the url

			curl_setopt($ch, CURLOPT_URL,$url);

			// Execute

			$result=curl_exec($ch);

			// Closing

			curl_close($ch);

			$response = json_decode($result, true);

			$msg = $response['message'];

			$rem = $response['RRR'];
			$transtime=date("jS F Y, H:i:s");
			$paidamt =$response['amount'].".0";

			

			if($msg == 'Approved'){

/* $date1= "2017-08-16 23:59:00";
$date2= $transtime;
$time1= strtotime($date);
$time2= strtotime($date2);
if($time2 > $time1)
{
	echo "Sorry Your School Fees was Paid Late. School Fees Payment";
}
else
{
	echo "Application is still On ";
}
 */
				//get the applicant invoice details using the portal id

				//$stud = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
//$transtime2= date("jS F Y, H:i:s");

//$insertRow = sqlsrv_query($conn,"insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, branch, service_type, date_sent, date_requested, order_ref,status) values ('$rem','$yabaorderID', 'BRANCH', '$paidamt', '$pn', '$pe', '$pp', '$uniqueno', '00', '$transtime', '$transtime', '', '', '', '$transtime2', '$transtime', '$orderref','Approved')") or die
//(print_r( sqlsrv_errors(), true));

			//	sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved' where rrr='$rem'") or die
//(print_r( sqlsrv_errors(), true));

				
				


					?>
 <form action="http://erp.yabatech.edu.ng/portal/index.php?register/processRemitaReceipt" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
 <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
                    
                  
  <?php	

				
			}else{
				?>
                    
                    <form action="http://erp.yabatech.edu.ng/portal/index.php?register/processRemitaReceipt" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Not Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
 <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>
  <?php
			}
			
		
?>
                    
                  
  <?php
					
				}