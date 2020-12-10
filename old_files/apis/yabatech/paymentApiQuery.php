<?php 
session_start();
include 'kee.php';
$rrr=$_POST["rrr"];
//$responseurl=$_POST["responseurl"];
//$Orderid=$_POST["Orderid"];
$i=0;
$query1= sqlsrv_query($conn,"select channel,trans_date from eduportal_remita_payment where rrr = '$rrr'") or die
(print_r( sqlsrv_errors(), true));
					while(list($channel,$transdate)=sqlsrv_fetch_array($query1))
					{
						 $query2= sqlsrv_query($conn,"select* from applicationinvoice_gen where rrr = '$rrr'") or die
(print_r( sqlsrv_errors(), true));
                    while(list($application_invoice_id,$payername,$payeremail,$payerphone,$order_id,,$amt,$session,,$paymentname)=sqlsrv_fetch_array($query2))
					{
							 $query3= sqlsrv_query($conn,"select* from transcript_applicants_destinations where rrr = '$rrr'") or die
(print_r( sqlsrv_errors(), true));
                    while(list($id1,$rrr2,$destination_id,$address,$destination_name,$courier)=sqlsrv_fetch_array($query3))
					{
						echo "PAYER_NAME=$payername&PAYER_EMAIL=$payeremail&PAYER_PHONE=$payerphone&ORDER_ID=$order_id&DESTINATION_ID=$destination_id&ADDRESS=$address&DESTINATION_NAME=$destination_name&COURIER=$courier&AMOUNT=$amt&SESSION=$session&PAYMENT_NAME=$paymentname";
					$i++;
					}
					}
	
	}
	if($i==0)
	{
echo "-1";
	}		
					
?>



