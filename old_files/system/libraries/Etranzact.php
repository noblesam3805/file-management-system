<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



  /**
    * @author Emmanuel Etti
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property mailbox_actions          $mailbox_actions
    * @property user_actions          $user_actions
    * @property employees_actions          $employees_actions
    */



  class etranzact

  {





	//rtype = plain/json/xml



	//private $api_url = "http://localhost/OtimkpuSMS/api/sms_handler.php";

    private $balance = 0.0;

    private $api_url = "http://197.255.244.5/WebConnectPlus/query.jsp";

    private $status_msg = "";

    private $status_code = "";



	public function __construct()

	{



	}



    private function get_terminal()

	{

		return $this->terminal;

	}



	private function get_conf()

	{

		return $this->conf;

	}



    public function set_terminal($message)

	{

		$this->terminal = $message;

        //echo $message;

	}



     public function set_conf($message)

	{

		$this->conf = $message;

        //echo $message;

	}



    public function get_receipt()

	{

		return $this->receipt;

	}



    public function get_date()

	{

		return $this->date;

	}



    public function get_customer()

	{

		return $this->customer_id;

	}



    public function get_fullname()

	{

		return $this->fullname;

	}



    public function get_status()

	{

		return $this->status_code;

	}



    public function get_bankcode()

	{

		return $this->bankcode;

	}



    public function get_bankname()

	{

		return $this->bankname;

	}



    public function get_branchcode()

	{

		return $this->branchcode;

	}



    public function get_confirm()

	{

		return $this->conf;

	}



    public function get_amount()

	{

		return $this->trans_amount;

	}



    public function get_descr()

	{

		return $this->descr;

	}



	private function prepare_fee_params()

	{

		return array(

					'TERMINAL_ID'=>urlencode($this->get_terminal()),

					'CONFIRMATION_NO'=>urlencode($this->get_conf())

				);

	}



	public function check_balance()

	{

		$this->remote_op = 'bal';

		$params = array(

					'username'=>urlencode($this->get_user_name()),

					'password'=>urlencode($this->get_password()),

					'balance'=>urlencode(true),

					'remoteOp'=>urlencode($this->remote_op)

				);



		//send sms and retrieve response

		$response = $this->execute_curl($params);



		//process response

		$this->parse_response($response);

	}



	public function send()

	{

		//$this->remote_op = 'snd';

		//encode each parameter value and present array

		$params = $this->prepare_fee_params();



		//send sms and retrieve response

		$response = $this->execute_curl($params);

		//$response = 'RECEIPT_NO=50015020910505&PAYMENT_CODE=500856721423481776059&MERCHANT_CODE=9999080103&TRANS_AMOUNT=12000.0&TRANS_DATE=2015/02/09 11:36:28&TRANS_DESCR=Peter-APPLICATION%20FEE%20-001-2015448981&CUSTOMER_ID=2015448981&BANK_CODE=500&BRANCH_CODE=001&SERVICE_ID=2015448981&CUSTOMER_NAME=Peter&CUSTOMER_ADDRESS=11%20adu%20street&TELLER_ID=etzbankteller&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=eTranzact%20Test%20Bank&BRANCH_NAME=ETZ%20BANK%20HEAD%20OFFICE&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=5569056&TRANS_FEE=0.0&TYPE_NAME=APPLICATION%20FEE&LEAD_BANK_CODE=999&LEAD_BANK_NAME=eTranzact%20Test%20Bank';

		//$response = 'RECEIPT_NO=111912093187118&PAYMENT_CODE=1119107082870708254&TRANS_AMOUNT=3000&TRANS_DATE=2011-12-12%2013:35:00.0&TRANS_DESCR=RESERVATION%20FEE%201323457634:OSIKEMUDU%20ISAAC&CUSTOMER_ID=1323457634&BANK_CODE=091&BANK_NAME=ZENITH&BRANCH_CODE=209&SERVICE_ID=1323457634&CUSTOMER_NAME=OSIKEMUDU%20ISAAC&CUSTOMER_ADDRESS=2%20IKOTA%20VILLA';



		//process response

		$this->parse_response($response);

	}







	private function parse_response($response)

	{







         if($response != NULL)

		{

			//get status code and status message from response json and set local variable





			//parameters were complete and login was successful

            $response_arr = preg_replace("/\s+/", "", $response);

    		$response_arr = rawurldecode($response);

            $response_arr = preg_replace("/\s+/", " ", $response_arr);

            $response_arr = trim($response_arr);

             $values=explode("&",$response_arr);



             $output=array();

             foreach($values as $value)

             {

                list($k,$v)=explode("=",$value);

                $output[$k]=$v;

             }

            // var_dump($output);



			$this->status_msg = '';

			$this->status_code = $output['SUCCESS'];

			//$this->status_code = "-1";



			//check if login failed or incomplete parameters





            $this->receipt =  $output['RECEIPT_NO'];

            $this->date =  $output['TRANS_DATE'];

             $this->customer_id =  $output['CUSTOMER_ID'];

             $this->fullname =  $output['CUSTOMER_NAME'];

             $this->bankcode =  $output['BANK_CODE'];

             $this->bankname =  $output['BANK_NAME'];

             $this->branchcode =  $output['BRANCH_CODE'];

             $this->conf =  $output['PAYMENT_CODE'];

             $this->trans_amount = $output['TRANS_AMOUNT'];

             $this->descr = $output['TRANS_DESCR'];



             if($this->customer_id == '' || $this->conf == '' || $this->conf == '0' || $this->trans_amount == ''){

              //$this->status_msg = 'The Confirmation Code is Invalid';

              $this->status_code = "-1";

			  return;

                }



		}

		else

		{

			//if json_decode() function cannot parse response, it means that there is remote server error

			$this->status_code = '00';

			//$this->status_msg = 'The server is down at the Moment, Please try again in an Hour.';

		}



	}







	private function execute_curl($params)

	{

		$encoded_params = "";

		foreach($params as $key=>$value)

		{

			$encoded_params .= $key.'='.$value.'&';

		}

        //var_dump($encoded_params);

		rtrim($encoded_params,'&');

        //var_dump($encoded_params);



		//open connection

		$ch = curl_init();



		//set the url, number of POST vars, POST data

		curl_setopt($ch,CURLOPT_URL,$this->api_url);

		curl_setopt($ch,CURLOPT_POST,count($params));

		curl_setopt($ch,CURLOPT_POSTFIELDS,$encoded_params);

		//curl_setopt($ch,CURLOPT_POSTFIELDS,"TERMINAL_ID=0000000001&CONFIRMATION_NO=500856741337711398213");

		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);



		//execute post

		$result = curl_exec($ch);



        //var_dump($this->api_url);



        //var_dump($result);



		//close connection

		curl_close($ch);



		return rtrim($result,' ');

		//return $result;

	}

}

/* End of file Etranzact.php */