<?php
session_start();
include '../application/config/remita_constants_live.php';
include '../application/config/z.php';
$rrr=$_POST["rrr"];
$responseurl="";
$yabaorderID=0;
$orderref=0;
$pp="";
$pe="";
$pn="";
$date = date('Y-m-d H:i:s');
$query2= mysql_query("select surname,firstname,middlename,email from invoice_gen where rrr = '$rem'") or die(mysql_error());
while(list($sn,$fn,$mn,$em)=mysql_fetch_array($query2))
{
$pp=$sn.' '.$fn.' '.$mn;
$pe= $em;
$pn="0";
}
$query= mysql_query("select * from eduportal_remita_payment where rrr = '$rrr'") or die(mysql_error());
						if(mysql_num_rows($query) > 0){
							
							$_SESSION['payeeID']= $rrr;
							if($_SESSION["ptype"]== 1){
mysql_query("update eduportal_remita_accp_temp_data set status ='Approved' where rrr='$rrr'") or die (mysql_error());				
$query2= mysql_query("select * from eduportal_remita_accp_temp_data where rrr = '$rrr'") or die(mysql_error());

$insert = mysql_query("insert into eduportal_fees_payment_log( regno,payment_code, payment_session, payment_level, payment_amount, payment_status, payment_date, payment_fee_type, student_id, semester) values ('$_SESSION[regno]','$rrr', '$_SESSION[sess]', '$_SESSION[plevel]', '$_SESSION[amount]', 'F', '$date', '1', '$_SESSION[stud_id]', '$_SESSION[semester]')") or die(mysql_error());

header("Location: http://erp.yabatech.edu.ng/portal/index.php?student/remita_acp_receipt");
}
else
{
mysql_query("update invoice_gen set status ='Approved' where rrr='$rrr'") or die (mysql_error());
$query2= mysql_query("select session_id,semester,portal_id,amount,level from invoice_gen where rrr = '$rrr'") or die(mysql_error());
while(list($sess,$sem,$portal,$amount,$level)=mysql_fetch_array($query2))
{
$insert = mysql_query("insert into eduportal_fees_payment_log( regno,payment_code, payment_session, payment_level, payment_amount, payment_status, payment_date, payment_fee_type, student_id, semester) values ('$portal','$rrr', '$sess', '$level', 'amount', 'F', '$date', '2', '$_SESSION[stud_id]', '$sem')") or die(mysql_error());
}
header("Location: http://erp.yabatech.edu.ng/portal/index.php?student/remita_schfee_receipt");
}
?>
  <?php
						
						
					}
						else	
				{					
		
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
			$transtime=$response['transactiontime'];
			$paidamt =$response['amount'].".0";

			

			if($msg == 'Approved'){
//$stud = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
$insertRow = mysql_query("insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, branch, service_type, date_sent, date_requested, order_ref,status) values ('$rem','$yabaorderID', 'CARD', '$paidamt', '$pn', '$pe', '$pp', '$uniqueno', '00', '$transtime', '$transtime', '', '', '', '$transtime', '$transtime', '$orderref','Approved')");
mysql_query("update invoice_gen set status ='Approved' where rrr='$rem'") or die (mysql_error());
$_SESSION['payeeID']= $rem;

if($_SESSION["ptype"]== 1){
mysql_query("update eduportal_remita_accp_temp_data set status ='Approved' where rrr='$rem'") or die (mysql_error());				
$query2= mysql_query("select * from eduportal_remita_accp_temp_data where rrr = '$rrr'") or die(mysql_error());

$insert = mysql_query("insert into eduportal_fees_payment_log( regno,payment_code, payment_session, payment_level, payment_amount, payment_status, payment_date, payment_fee_type, student_id, semester) values ('$_SESSION[regno]','$rem', '$_SESSION[sess]', '$_SESSION[plevel]', '$_SESSION[amount]', 'F', '$date', '1', '$_SESSION[stud_id]', '$_SESSION[semester]')") or die(mysql_error());

header("Location: http://erp.yabatech.edu.ng/portal/index.php?student/remita_acp_receipt");
}
else
{
mysql_query("update invoice_gen set status ='Approved' where rrr='$rem'") or die (mysql_error());
$query2= mysql_query("select session_id,semester,portal_id,amount,level from invoice_gen where rrr = '$rem'") or die(mysql_error());
while(list($sess,$sem,$portal,$amount,$level)=mysql_fetch_array($query2))
{
$insert = mysql_query("insert into eduportal_fees_payment_log( regno,payment_code, payment_session, payment_level, payment_amount, payment_status, payment_date, payment_fee_type, student_id, semester) values ('$portal','$rem', '$sess', '$level', 'amount', 'F', '$date', '2', '$_SESSION[stud_id]', '$sem')") or die(mysql_error());
}
header("Location: http://erp.yabatech.edu.ng/portal/index.php?student/remita_schfee_receipt");
}
exit;
?>                    

  <?php	

				
			}else{
				//$_SESION['payeeID_failed'] =$rrr;
				
header("Location: http://erp.yabatech.edu.ng/portal/index.php?student/remita_failed");
exit;
				
				?>
                    
                  
  <?php
			}
			
		
?>
                    
                  
  <?php
					
				}