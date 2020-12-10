<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



  /**
    * @author Emmanuel Etti
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */



  class Remita

  {

	private $MERCHANTID = "2547916";//should come from database

	private $SERVICETYPEID = "4430731";//should come from database

	private $APIKEY  = "1946";//should come from database

	private $SPLIT_GATEWAYURL = "http://www.remitademo.net/remita/ecomm/v2/init.reg"; //split payment url

	private $GATEWAYRRRPAYMENTURL = "http://www.remitademo.net/remita/ecomm/finalize.reg";//split payment gateway url

	private $SPLIT_CHECKSTATUSURL= "http://www.remitademo.net/remita/ecomm";//SPLIT PAYMENT CHECK STATUS URL

	private $CHECKSTATUSURL = "http://www.remitademo.net/remita/ecomm";//normal payment check status url

	private $GATEWAYURL = "http://www.remitademo.net/remita/ecomm/init.reg";//normal payment url

    private $status_msg = "";

    private $status_code = "";



	public function __construct()

	{



	}

	//get method for amount
	private function get_total_amount()
	{
		return $this->total_amount;
	}

	//set method for the total amount
	public function set_total_amount($amt) 
	{
		$this->total_amount = $amt;
	}
	//get method for payer name
	private function get_payer_name()
	{
		return $this->payer_name;
	}

	//set method for the payer_name
	public function set_payer_name($name) 
	{
		$this->payer_name = $name;
	}
	//get method for payer email
	private function get_payer_email()
	{
		return $this->payer_email;
	}

	//set method for the payer email
	public function set_payer_email($email) 
	{
		$this->payer_email = $email;
	}

	//get method for payer phone
	private function get_payer_phone()
	{
		return $this->payer_phone;
	}

	//set method for the payer details
	public function set_payer_phone($phone) 
	{
		$this->payer_phone = $phone;
	}

	//get method for school account
	private function get_beneficiary()
	{
		return $this->beneficiary;
	}

	//set method for the school account
	public function set_beneficiary($ben) 
	{
		$this->beneficiary = $ben;
	}
	//get method for cloud school account
	private function get_beneficiary_cloud()
	{
		return $this->beneficiary_cloud;
	}

	//set method for the cloudskul account
	public function set_beneficiary_cloud($ben) 
	{
		$this->beneficiary_cloud = $ben;
	}

	//get method for payment type
	private function get_payment_type()
	{
		return $this->payment_type;
	}

	//set method for the payment type
	public function set_payment_type($type) 
	{
		$this->payment_type = $type;
	}
	//get method for payment type
	private function get_responseurl()
	{
		return $this->responseurl;
	}

	//set method for the payment type
	public function set_responseurl($url) 
	{
		$this->responseurl = $url;
	}

	 public function get_content()
	{
		
		$beneficiaryAmount ="1000";//cloudskul service charge
		$beneficiaryAmount2 = $this->get_total_amount();//school fees
		$totalAmount = intval($this->get_total_amount()) + intval($beneficiaryAmount);
		$totalAmount = (string)$totalAmount;
		//$totalAmount = "7500";
		$timesammp=DATE("dmyHis");		
		$orderID = $timesammp;
		$payerName = $this->get_payer_name();
		$payerEmail = $this->get_payer_email();
		$payerPhone = $this->get_payer_phone();
		//$responseurl = "http://localhost/remita/sample-receipt-page.php";
		$responseurl = $this->get_responseurl();
		$hash_string = $this->MERCHANTID . $this->SERVICETYPEID . $orderID . $totalAmount . $responseurl . $this->APIKEY;
		$hash = hash('sha512', $hash_string);
		$itemtimestamp = $timesammp;
		$itemid1="itemid1";
		$itemid2="34444".$itemtimestamp;
		$cloudskul = $this->get_beneficiary_cloud();
		$school_account = $this->get_beneficiary();

		$beneficiaryName=$cloudskul->account_name;//cloudskul account name
		$beneficiaryName2=$school_account->account_name;//school account name

		$beneficiaryAccount=$cloudskul->account_number;//cloudskul account number
		$beneficiaryAccount2=$school_account->account_number;//school account number

		$bankCode=$cloudskul->bank_code;//cloudskul bank code
		$bankCode2=$school_account->bank_code;//school bank code

		$deductFeeFrom=1;
		$deductFeeFrom2=0;
		//The JSON data.
		$content = '{"merchantId":"'. $this->MERCHANTID
		.'"'.',"serviceTypeId":"'.$this->SERVICETYPEID
		.'"'.",".'"totalAmount":"'.$totalAmount
		.'","hash":"'. $hash
		.'","description":"'. "School fees"
		.'"'.',"orderId":"'.$orderID
		.'"'.",".'"responseurl":"'.$responseurl
		.'","payerName":"'. $payerName
		.'"'.',"payerEmail":"'.$payerEmail
		.'"'.",".'"payerPhone":"'.$payerPhone
		.'","lineItems":[
		{"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"},
		{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"}
		]}';

		//var_dump($content);
		//break;

		return $content;
	}

	public function execute_remita(){

		$params = $this->get_content();
		//var_dump($params);

		$response = $this->remita_connect($params);

		$this->remita_response($response);

	}

	private function remita_response($remit){

		//var_dump($remit);
		$jsonData = substr($remit, 6, -1);
		//var_dump($jsonData);
		$response = json_decode($jsonData, true);
		//var_dump($response);
		$statuscode = $response['statuscode'];
		$statusMsg = $response['status'];
		//$statuscode = '025';
		if($statuscode == '025'){
		$rrr = trim($response['RRR']);
		$new_hash_string = $this->MERCHANTID . $rrr . $this->APIKEY;
		$new_hash = hash('sha512', $new_hash_string);
		echo '<html>
		<head>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-dark.min.css">
		</head>
		<body>
		  <div class="container">
			<div class="row">
		    <div class="col-xs-12 col-md-9 col-lg-7">
		    <h4 style="margin-left:20px;">Redirecting to Remita... Please wait!</h4>"

		<form action="'.$this->GATEWAYRRRPAYMENTURL.'" method="POST">
		<input id="merchantId" name="merchantId" value="'.$this->MERCHANTID.'" type="hidden"/>
		<input id="rrr" name="rrr" value="'.$rrr.'" type="hidden"/>
		<input id="responseurl" name="responseurl" value="'.$this->get_responseurl().'" type="hidden"/>
		<input id="hash" name="hash" value="'.$new_hash.'" type="hidden"/>
		<div class="form-group">
			<!--label class="col-sm-4 control-label">Payment Type</label-->
			<div class="col-sm-8">
				<select style="display:none" name="paymenttype" class="form-control">
					<option value=""> -- Select --</option>
					<option value="REMITA_PAY"> Remita Account Transfer</option>
					<option value="Interswitch"> Verve Card</option>
					<option value="UPL"> Visa</option>
					<option value="UPL"> MasterCard</option>
					<option value="PocketMoni"> PocketMoni</option>
					<option value="RRRGEN"> POS</option>
					<option value="ATM"> ATM</option>
					<option selected value="BANK_BRANCH">BANK BRANCH</option>
					<option value="BANK_INTERNET">BANK INTERNET</option>
				</select>
			</div>
		</div>
		 <div class="form-group">
			<div class="col-sm-8 col-sm-offset-4">
				<!--input type="submit" class="btn btn-sm btn-primary" name="submit" value="Submit" /-->
			</div>
		</div>
			</form>
			<script type="text/javascript">
			var form = document.forms[0];
            form.submit()</script>
		</div>
		</div>
		</div>
		</body>
		</html>';
		}
		else{
		echo "Error Generating RRR - " .$statusMsg;
		}
		//break;
	}

	private function remita_connect($content){

		$curl = curl_init($this->SPLIT_GATEWAYURL);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER,
		array("Content-type: application/json"));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		$json_response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		var_dump($status);
		curl_close($curl);
		//var_dump($this->SPLIT_GATEWAYURL);
		//echo "in curl;;";

		return $json_response;

	}

	//This functions confirms that the transaction was succesful
	public function remita_transaction_details($orderId){

		$concatString = $orderId . $this->APIKEY . $this->MERCHANTID;
		$hash = hash('sha512', $concatString);
		$url 	= $this->SPLIT_CHECKSTATUSURL . '/' . $this->MERCHANTID  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
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
		return $response;
	}

	

}

/* End of file Remita.php */