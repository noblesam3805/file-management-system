<?php
include 'remita_constants.php';
include 'kee.php';
error_reporting(E_ALL & ~E_NOTICE);
$yabaorderID=0;
$orderref=0;
$pp="";
$pe="";
$pn="";
$uniqueno=0;
$i =1;
//$query= sqlsrv_query($conn,"select * from eduportal_remita_payment where rrr = '$rrr'") or die(print_r( sqlsrv_errors(), true));
$query= sqlsrv_query($conn,"select rrr from rrr_issues") or die(print_r( "Error1:".sqlsrv_errors(), true));
while(list($rrr)=sqlsrv_fetch_array($query))
{




		
		

			$queryunique= sqlsrv_query($conn,"select sid,orderid,payerphone,payeremail,payername,server,dategenerated,amt from applicationinvoice_gen where rrr = '$rrr'") or die(print_r( sqlsrv_errors(), true));
while(list($sid,$oid,$pphone,$pemail,$pname,$server,$transtime,$paidamt)=sqlsrv_fetch_array($queryunique))
{
$uniqueno =$sid;
$orderref= $oid;
$yabaorderID =$sid;
$pn=$pname;
$pp=$pphone;
$pe=$pemail;
$ser = $server;
$paidamt=$paidamt.'.0';
//echo "Please Wait...";


			

				//get the applicant invoice details using the portal id

				//$stud = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
$insertRow = sqlsrv_query($conn,"insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, 
payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, 
branch, service_type, date_sent, date_requested, order_ref,status) values ('$rrr','$yabaorderID', 'BRANCH', '$paidamt', '$pn', '$pe',
 '$pp', '$uniqueno', '00', '$transtime', '$transtime', '', '', '', '$transtime', '$transtime', '$orderref','Approved')") or die(print_r( sqlsrv_errors(), true));

			//	sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved', transtime='$transtime' where rrr='$rem'") or die
//(print_r( "Error2:".sqlsrv_errors(), true));

sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved' where rrr='$rrr'") or die
(print_r( "Error5:".sqlsrv_errors(), true));

				echo $id." ".$rem." $transtime Paid<br/>";
				


	
			
		
?>
                    
                  
  <?php
}
$i++;					
}


				?>