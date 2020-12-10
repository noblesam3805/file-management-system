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
			//echo $response;
//echo $response['message'];
			$msg = $response['message'];

			$rem = $response['RRR'];
			$transtime=$response['transactiontime'];
			$paidamt = $response['amount'].".0";

			$queryunique= sqlsrv_query($conn,"select sid,orderid,payerphone,payeremail,payername,server from applicationinvoice_gen where rrr = '$rem'") or die(print_r( sqlsrv_errors(), true));
while(list($sid,$oid,$pphone,$pemail,$pname,$server)=sqlsrv_fetch_array($queryunique))
{
$uniqueno =$sid;
$orderref= $oid;
$yabaorderID =$sid;
$pn=$pname;
$pp=$pphone;
$pe=$pemail;
$ser = $server;
//echo "Please Wait...";
}

			if($msg == 'Approved'){

				echo $id." ".$rem." $transtime Paid<br/>";

				//get the applicant invoice details using the portal id

				//$stud = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
$insertRow = sqlsrv_query($conn,"insert into eduportal_remita_payment( rrr,payment_id, channel, amount, payer_name, payer_email, payer_phone, unique_id, response_code, trans_date, debit_date, bank, branch, service_type, date_sent, date_requested, order_ref,status) values ('$rem','$yabaorderID', 'BRANCH', '$paidamt', '$pn', '$pe', '$pp', '$uniqueno', '00', '$transtime', '$transtime', '', '', '', '$transtime', '$transtime', '$orderref','Approved')") or die
(print_r("Error3:". sqlsrv_errors(), true));

			//	sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved', transtime='$transtime' where rrr='$rem'") or die
//(print_r( "Error2:".sqlsrv_errors(), true));

sqlsrv_query($conn,"update applicationinvoice_gen set status ='Approved' where rrr='$rem'") or die
(print_r( "Error5:".sqlsrv_errors(), true));

				echo $id." ".$rem." $transtime Paid<br/>";
				


				
			}else{
				?>
             
  <?php
  echo $i." ".$rem." Not Paid<br/>";
  //sqlsrv_query($conn,"update applicationinvoice_gen set status ='Payment Reference generated' where rrr='$rrr'") or die
//(print_r( "Error5:".sqlsrv_errors(), true));
//sqlsrv_query($conn,"delete from  eduportal_remita_payment where rrr='$rrr'") or die
//(print_r( "Error5:".sqlsrv_errors(), true));
			}
			
		
?>
                    
                  
  <?php
$i++;					
}


				?>