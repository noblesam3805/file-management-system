<?php

/*

*Author: Emmanuel Etti jr.

*Please create a column payeeID and paymentType very important

*Content of paymentType should be 'Remedial fees', very important

*Please include that in Master.php file

*Also try n duplicate the content of the first comment below 

*	to reflect what is in the database, i will call to clarify

**Badder than Bad**

*Reference Client Data Verification On the XML should look like

*/





include('application/config/db.php');

//if( $_REQUEST['PAYEE_ID'] && $_REQUEST['PAYMENT_TYPE'])

if( $_REQUEST['PAYEE_ID'])

{

   	$name = $_REQUEST['PAYEE_ID'];

   	$name = rawurldecode($name);

   	$type = $_REQUEST['PAYMENT_TYPE'];

   	$type = rawurldecode($type);

	$query="select fullname as PayeeName, IFNULL(faculty,'N/A') as Faculty, IFNULL(department,'N/A') as Department, programme as ProgrammeType, session as Session, payee_id as PayeeID, amount as Amount, status as FeeStatus, description as PaymentType, portal_id as MatricNumber, IFNULL(email,'N/A') as Email, phone as PhoneNumber from nekede_etranzact_payment where payee_id ='".$name."' ";
	//$query="select fullname as PayeeName, faculty as Faculty, department as Department, programme as ProgrammeType, session as Session, payee_id as PayeeID, amount as Amount, status as FeeStatus, description as PaymentType, portal_id as MatricNumber, email as Email, phone as PhoneNumber from nekede_etranzact_payment where payee_id ='".$name."' ";
	
	$result = mysql_query($query) or die('Error');


	if(mysql_num_rows($result) > 0){

		// $data = $result->fetch_assoc();
		$data = mysql_fetch_assoc($result);

		$n1 = array_slice($data, 0, 3, true) + array('Level' => 'N/A') + array_slice($data, 3, NULL, true);

		$n2 = array_slice($n1, 0, 5, true) + array('StudyType' => 'N/A') + array_slice($n1, 5, NULL, true);

		$n3 = array_slice($n2, 0, 10, true) + array('Semester' => 'N/A') + array_slice($n2, 10, NULL, true);
		

		$i = 0;

		header( "content-type: application/xml; charset=ISO-8859-15" );

		echo '<?xml version="1.0" encoding="utf-8"?>';

		echo '<FeeRequest>';


		foreach($n3 as $key => $value) {

			$value=trim(preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $value));

			echo "<$key>$value</$key>";

		}

		echo '</FeeRequest>';
	
	}else{

		echo 'N/A1';
	}

}else{

	echo 'N/A2';

}
mysql_close(); //close MSSQL connection

?>