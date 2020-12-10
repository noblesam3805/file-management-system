<?php

include('application/config/z.php');

$dept="";
$school ="";
$sch='';
	if( isset($_REQUEST['PAYEE_ID'])){

		

		$name = $_REQUEST['PAYEE_ID'];

		$ghg = $_REQUEST['PAYMENT_TYPE'];
		
		
		if(isset($_REQUEST['PAYMENT_TYPE'])){
			
			//$applicationinvoice = $this->db->get_where('invoice_gen', array("invoice_no" => $name))->row();
$query= mysql_query("select * from invoice_gen where invoice_no = '$name'") or die(mysql_error());
if(mysql_num_rows($query) > 0){
while(list($application_invoice_id,$portal_id,$surname,$firstname,$middlename,$order_id,$application_type_id,$session_id,$identification_no,$invoice_no,$amount,$date_generated,$rrr,$email,$status,$dept_id,$level,,$semester)=mysql_fetch_array($query))
{
$q1= mysql_query("select schoolid,deptName from department where deptid='$dept_id'") or die(mysql_error());
		while(list($schoolid,$dept_name)=mysql_fetch_array($q1))
		{
			$dept= strtoupper($dept_name);
			$sch=$schoolid;
			
		}
		$q2= mysql_query("select schoolname from schools where schoolid='$sch'") or die(mysql_error());
		while(list($schoolname)=mysql_fetch_array($q2))
		{
			$school= strtoupper($schoolname);
		}

	
	$query2= mysql_query("select * from application_type
 where application_typeid='$application_type_id'") or die(mysql_error());
 while(list($aptid,$application_type,$application_code,$amt,$active,$payment_type,$program_code,$programme,$school1)=mysql_fetch_array($query2))
 {
	 if($_REQUEST['PAYMENT_TYPE'] !=$payment_type)
	 {
	        echo 'Wrong Payment Type Selected for this Payee ID ' . $name.' correct Payment Type is '.$payment_type;
			exit;
	 }
			
			
			header( "content-type: application/xml; charset=ISO-8859-15" );	

					echo '<?xml version="1.0" encoding="utf-8"?>';

					echo '<FeeRequest>';

					echo '<PayeeName>' . strtoupper($firstname) . ' ' . strtoupper($middlename) . ' ' . strtoupper($surname) . '</PayeeName>';

					echo '<Faculty>' . $school . '</Faculty>';

					echo '<Department>' . $dept . '</Department>';

					echo '<Level>' .$level. '</Level>';

					echo '<ProgrammeType>' . $application_type . '</ProgrammeType>'; 

					echo '<StudyType>' . $school1. '</StudyType>';

					echo '<Session>' . $session_id . '</Session>';

					echo '<PayeeID>' . $name . '</PayeeID>';

		

					echo '<Amount>' . $amount . '</Amount>';

					
					

					echo '<FeeStatus>' .'FULL PAYMENT' . '</FeeStatus>';

					echo '<Semester>' . $semester . '</Semester>';

					echo '<PaymentType>' . $payment_type. '</PaymentType>';

				

					

					echo '<MatricNumber>' . $portal_id. '</MatricNumber>';

					echo '<Email>' . $email . '</Email>';

					echo '<PhoneNumber>' . $mobile_no . '</PhoneNumber>';

					echo '</FeeRequest>';
       }
     }
	}
	else
	{
		echo 'No record found for this Payee ID ' . $name;
	}
		}
				else{

					echo 'No record found for this Payee ID ' . $name;

				}
	       }
			
			else
			{
				
		echo 'Payee ID not Found.';
			}
	


	
?>	