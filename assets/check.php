<?php
session_start();
	$queryStr = rawurldecode($_SERVER['QUERY_STRING']);
	print_r($queryStr);
	return 0;

	//$url = 'http://www.alvanportal.edu.ng/eduportal/assets/check.php';

	//parse_str(parse_url($url, PHP_URL_QUERY), $array);
	//print_r($array);
	//return 0;
	$customer_id = isset($_REQUEST['ECHODATA'])?$_REQUEST['ECHODATA']:'';
	echo $customer_id;
	
     $xml_post = file_get_contents('php://input');

	$decode_url =rawurldecode($xml_post);
	var_dump($xml_post);
	exit;
	$url ="http://www.alvanportal.edu.ng/eduportal/assets/done.php?$decode_url";
	if ($f = @fopen($url, "r"))
	{
	$answer = fgets($f, 255);
		if ($answer == "1")
		{
			var_dump($xml_post);
			//header("Location: index.php?error=Invalid Confirmation Order"); http://www.alvanportal.edu.ng/eduportal/assets/paymentClient.php
			exit;
		}
		elseif($answer == "0")
		{
			header("Location: done.php");
			var_dump($xml_post);
			exit;
		}

	}
	else
	{
	echo "Error: URL could not be opened.";
	}

	/*RESPONSE_URL=http%3A%2F%2Fwww.alvanportal.edu.ng%2Feduportal%2Fassets%2Fcheck.php&
	CURRENCY_CODE=NGN&
	TERMINAL_ID=0000000001&
	TRANSACTION_ID=808750355522999&
	AMOUNT=19000&
	DESCRIPTION=My+Payment+Description&
	ECHODATA=null,%20%20%09%09%09%3Ccustomerinfo%3E%3Cfirstname%3EEmmanuel%3C/firstname%3E%3Clastname%3EEtti%3C/lastname%3E%3Cphoneno%3E08131342381%3C/phoneno%3E%3Ce%20%20%09%09%09mail%3Eetti.emman@gmail.com%3C/email%3E%3Caddress%3E%3C/address%3E%3Ccity%3E%3C/city%3E%3Cstate%3E%3C/state%3E%3Czipcode%3E%3C/zipcode%3E%3C%20%20%09%09%09postalcode%3E%3C/postcode%3E%3Ccountry%3E%3C/country%3E%3Cotherdetails%3E%3C/otherdetails%3E%3C/customerinfo%3E&
	FINAL_CHECKSUM=1529CA1EECA743AF492BB0F3B4FE9EED&
	SUCCESS=-1&
	CHECKSUM=1784bb1428e9cee0a655dfc5b72d8a3c&
	TRANS_NUM=01ESA242128478588132&
	msg=&
	DEBITED_AMOUNT=19000*/


?>
