<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
     session_start();
/*
 *  @author : Emmanuel Etti
 *  @contributor : Sunday Okoi
 *  18th January, 2015
 *  Eduportal
 *  www.autopathgrp.com
 *
 */


class Register extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index()
    {
		

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

        if ($this->session->userdata('sadmin_login') == 1)
            redirect(base_url() . 'index.php?sadmin/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
          $page_data['page_name']  = 'register';
          $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos');
     $this->load->view('backend/register', $page_data);

    }


    public function account_verification()
    {
		

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

        if ($this->session->userdata('sadmin_login') == 1)
            redirect(base_url() . 'index.php?sadmin/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
          $page_data['page_name']  = 'portal_account_verification';
          $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos | Account Verification');
     $this->load->view('backend/register', $page_data);

    }
	
	
	    public function account_verification_acceptancefees()
    {
		

       
          $page_data['page_name']  = 'register_acceptance';
          $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos | Acceptance Fee ');
     $this->load->view('backend/register', $page_data);

    }
	
	function process_account_verification_acceptance()
	{
		session_start();
		
		$serial = $this->input->post('serial');	
		$phone = $this->input->post('phone');	

		$adm_exist = $this->db->get_where('eduportal_admission_list', array("application_no" => $serial))->row();
		
		if($adm_exist){
			$student = $this->db->get_where('student', array("portal_id" => $serial))->row();
			if(!$student)
			 {
			$data["name"]=$adm_exist->surname;
			$data["othername"]=$adm_exist->firstname." ".$adm_exist->middlename;
			$data["reg_no"]=$adm_exist->application_no;
			$data["portal_id"]=$adm_exist->application_no;
			$data["password"]=rand(1000,100000);
			$data["dept"]=$adm_exist->dept_id;
			$data["school"]=$adm_exist->school_id;
			$data["programme"]=$adm_exist->student_type;
			$data["prog_type"]=$adm_exist->programme_type_id;
			$data["dept_option"]=$adm_exist->dept_option_id;
			$email =strtolower($adm_exist->surname).'.'.strtolower($adm_exist->firstname).mt_rand(1,1000).'@student.yabatech.edu.ng';
			$data["program_id"]=$adm_exist->program_id;		
			$data["phone"]=$phone;
            $data["email"]=$email;			
			$this->db->where('student_id',$row['student_id']);
            $this->db->update('student', $data);
		
			
			$result=$this->db->insert('student',$data);
						
			$query = $this->db->get_where('student' ,array(	'portal_id' => $serial));

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('newstudent_login', '1');

			  $this->session->set_userdata('newstudent_id', $row->student_id);

			  $this->session->set_userdata('name', $row->name);
			  
			  $this->session->set_userdata('oname', $row->othername);
			  
			  $this->session->set_userdata('fullname', $row->name.', '.$row->othername);

			  $this->session->set_userdata('reg_no', $row->reg_no);
			  			 			  
			  $this->session->set_userdata('portal_id', $row->portal_id);
			  $_SESSION["portalID"] =$row->portal_id;

			  $this->session->set_userdata('login_type', 'newstudent');

			}
			
				redirect(base_url() . 'index.php?register/generate_acp_fee_invoice');
			 }
			else
			 {
			    $query = $this->db->get_where('student' ,array(	'portal_id' => $serial));

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('newstudent_login', '1');

			  $this->session->set_userdata('newstudent_id', $row->student_id);

			  $this->session->set_userdata('name', $row->name);
			  
			  $this->session->set_userdata('oname', $row->othername);
			  
			  $this->session->set_userdata('fullname', $row->name.', '.$row->othername);

			  $this->session->set_userdata('reg_no', $row->reg_no);
			  
			
			  
			  $this->session->set_userdata('portal_id', $row->portal_id);
			  $_SESSION["portalID"] =$row->portal_id;

			  $this->session->set_userdata('login_type', 'newstudent');

			 

		}
			
			redirect(base_url() . 'index.php?register/generate_acp_fee_invoice');
			 }
			}
			else
			{
			$_SESSION['error'] = 'Sorry Application Form No does not Exist in Admissions List! Please Contact ICT Unit';
			redirect(base_url() . 'index.php?register/account_verification_acceptancefees');
			}
		
		
		
	}
 
 
	function process_account_verification()
	{
		session_start();
		$st_type = $this->input->post('st_type');
		if($st_type==1)
		{
		$serial = $this->input->post('serial1');	
		$adm_exist = $this->db->get_where('eduportal_admission_list', array("application_no" => $serial))->row();
		
		if($adm_exist){
			$acp_exist = $this->db->get_where('eduportal_fees_payment_log', array("regno" => $serial,"payment_fee_type"=>'1'))->row();
			if(!$acp_exist)
			{
			$_SESSION['error'] = 'Sorry You have not paid Acceptance Fee';
			redirect(base_url() . 'index.php?register/account_verification');
			}
			
			$scr_exist = $this->db->get_where('eduportal_admissions_screening', array("application_no" => $serial))->row();
			if(!$scr_exist)
			{
			$_SESSION['error'] = 'Sorry You have not been Screened! Kindly proceed to your Screening Officer.';
			redirect(base_url() . 'index.php?register/account_verification');
			}
			
			$student = $this->db->get_where('student', array("portal_id" => $serial))->row();
			if(!$student)
			 {
			$data["name"]=$adm_exist->surname;
			$data["othername"]=$adm_exist->firstname." ".$adm_exist->middlename;
			$data["reg_no"]=$adm_exist->application_no;
			$data["portal_id"]=$adm_exist->application_no;
			$data["password"]="12345";
			$data["dept"]=$adm_exist->dept_id;
			$data["school"]=$adm_exist->school_id;
			$data["programme"]=$adm_exist->student_type;
			$data["prog_type"]=$adm_exist->programme_type_id;
			$data["dept_option"]=$adm_exist->dept_option_id;
			$_SESSION['app_no'] = $serial;
			$_SESSION['st_type'] = '1';
			$result=$this->db->insert('student',$data);
			
				redirect(base_url() . 'index.php?register/portal_account_slip');
			 }
			else
			 {
			$_SESSION['app_no'] = $serial;
			$_SESSION['st_type'] = '1';
			
			redirect(base_url() . 'index.php?register/portal_account_slip');
			 }
			}
			else
			{
			$_SESSION['error'] = 'Sorry Application Form No does not Exist in Admissions List! Please Contact ICT Unit';
			redirect(base_url() . 'index.php?register/account_verification');
			}
		
		
		}
		else
		{
		$serial = $this->input->post('serial2');
		$student_exist = $this->db->get_where('eduportal_students_record', array("regno" => $serial))->row();
		if($student_exist){
			$student = $this->db->get_where('student', array("portal_id" => $serial))->row();
			if(!($student))
			{
			$data["name"]=$student_exist->surname;
			$data["othername"]=$student_exist->firstname." ".$adm_exist->middlename;
			$data["reg_no"]=$student_exist->regno;
			$data["portal_id"]=$student_exist->regno;
			$data["password"]="12345";
			$data["dept"]=$student_exist->dept_id;
			$data["school"]=$student_exist->school_id;
			$data["programme"]=$student_exist->student_type_id;
			$data["prog_type"]=$student_exist->programme_type_id;
			
			$this->db->insert('student',$data);
			$_SESSION['app_no'] = $serial;
			$_SESSION['st_type'] = '2';
			//$score =$alreadyRecorded->screening_result;
			//echo "<pre>".print_r($data)."</pre>";
				redirect(base_url() . 'index.php?register/portal_account_slip');
			}
			else
			{
				$_SESSION['app_no'] = $serial;
			$_SESSION['st_type'] = '2';
			//$score =$alreadyRecorded->screening_result;
			
				redirect(base_url() . 'index.php?register/portal_account_slip');
			}
			}
			else
			{
			$_SESSION['error'] = 'Sorry Registration/Matric No does not Exist in Students Record! Please Contact ICT Unit!';
			redirect(base_url() . 'index.php?register/account_verification');
			}
		}
		

		
		
	}
	
	function portal_account_slip()
	{
		 $page_data['page_name']  = 'portal_account_notification_slip';
     
        $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos | Portal Account Notification Slip');
         $this->load->view('backend/student_print', $page_data); 
	}
	
	
	function generate_acp_fee_invoice(){
		if ($this->session->userdata('newstudent_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_acp_fee_invoice';
        $page_data['page_title'] = get_phrase('Get Acceptance Fee Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('newstudent_id')
        ))->row();

        $this->load->view('backend/register', $page_data);
	}


	
function processRemitaAcceptanceInvoice(){

		session_start();
		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$programTpeID=$this->input->post('programTpeID');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?register/generate_acp_fee_invoice');
		}
			if($programTpeID==4){
			$studentDetails=$this->db->get_where('eduportal_admission_list', array("application_no" => $portalID,"session"=>$session))->row();
			
		   $programId=$studentDetails->program_id;
		
			$acceptanceLimit=$this->db->get_where('program_detailed', array("program_id" =>$programId))->row();
		   $limitValue=$acceptanceLimit->program_limits;
			
			$aceptLimitCount=$this->db->query("select * from eduportal_admission_list e inner join eduportal_fees_payment_log p on e.application_no=p.regno where e.session = '$session' and e.program_id='$programId' and p.payment_fee_type=4 ");
			 $countLimt=$aceptLimitCount->num_rows();
		
			 if($countLimt>= $limitValue){
			$_SESSION['err_msg'] = 'The Acceptance FEES payment for this Department has been closed.Thank you!';

			redirect(base_url() . 'index.php?register/generate_acp_fee_invoice');
			 }
			
		}
		$alreadyGenerated = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $portalID,"session"=>$session))->row();
		
if($alreadyGenerated){

				$_SESSION['portalID'] = $portalID;

				redirect(base_url() . 'index.php?register/remitaInvoice');

			}
		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
                $admissiondetails= $this->db->get_where('eduportal_admission_list', array("application_no" => $portalID))->row()->adm_type;
		
  
		$merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

		$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

		$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();

		$gatewayUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'gateway_url'))->row();

		$statusUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'status_url'))->row();

		$responseUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'response_url'))->row();

		$gatewayRRR = $this->db->get_where('eduportal_remita_details', array("type" => 'gatewayrrrpayment_url'))->row();



$totalAmount ='25000';
		

define("MERCHANTID", "576943955");
define("SERVICETYPEID", "2255371903");
define("APIKEY", "428537");


		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");
define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");
define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

        define("PATH", 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));

		
		

	//	echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

	//	exit;

				

		//$totalAmount = $amount->value;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->othername . ' ' . $studentDetails->name; 

		$payerEmail = $studentDetails->email == "" ? 'student@yabatech.com' : $studentDetails->email;  

		$payerPhone = $studentDetails->phone; 

		$responseurl = "http://erp.yabatech.edu.ng/portal/newremitaResponse.php";

		

		//echo $totalAmount; 

		//exit;

		

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="itemid1";

		$itemid2="34444".$itemtimestamp;

		$itemid3="8694".$itemtimestamp;
		
		

		
	//	$beneficiaryName3="Gtco Calscan Nig Ltd";
$beneficiaryName="Yaba College of Technology";
$beneficiaryName2="GTCO Calscan Nigeria Limited";
//$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0230468761012";
$beneficiaryAccount2="1014488172";
//$beneficiaryAccount3="4017904612";
$bankCode="000";
$bankCode2="057";
		
	//	$bankCode3="070";


    $beneficiaryAmount =0;

	$beneficiaryAmount2 =25000-$beneficiaryAmount;

		$deductFeeFrom=0;

		$deductFeeFrom2=1;
		
		//$deductFeeFrom3=0;

		//The JSON data.

		$content = '{"merchantId":"'. MERCHANTID

		.'"'.',"serviceTypeId":"'.SERVICETYPEID

		.'"'.",".'"totalAmount":"'.$totalAmount

		.'","hash":"'. $hash

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

		//exit;

		

		$curl = curl_init(GATEWAYURL);

		

		

		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($curl, CURLOPT_HTTPHEADER,

		array("Content-type: application/json"));
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
// Disable SSL verification

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		

		curl_close($curl);

		$jsonData = substr($json_response, 6, -1);

		$response = json_decode($jsonData, true);

		$statuscode = $response['statuscode'];

		$statusMsg = $response['status'];
		//echo $statusMsg.$statuscode.$status;print_r($response); exit;
		//exit;
		if($statuscode=='025'){

			

			//check if student generated rrr already

			$alreadyGenerated = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $portalID,"session"=>$session))->row();

			

			if($alreadyGenerated){

				$_SESSION['portalID'] = $portalID;
               $_SESSION['session'] = $session;
				redirect(base_url() . 'index.php?register/remitaInvoice');

			}

			

			$data['putme_id'] = $portalID;

			$data['rrr'] = trim($response['RRR']);

			$data['order_id'] = trim($response['orderID']);

			$data['status'] = 'Payment Pending'; 

			$data['datetime'] = date("Y-m-d H:i:s"); 

			$data['amount'] = $totalAmount;
			$data['session'] = $session;
			$data['year'] = $year;

			
$rrr=$response['RRR'];
			$this->db->insert('eduportal_remita_accp_temp_data', $data);

			
			//echo $statuscode.' '.$statusMsg.' '.$payerName .$payerEmail .$payerPhone ;
								//exit;
								$name = $studentDetails->othername;						
								$to = "To: $name <$studentDetails->email;>";
								$subject = "Notification of Acceptance Fee Invoice";

								$message = "
								<html>
								<head>
								<title>Hello $name</title>
								</head>
								<body>
								<p>This is to Notify you that your Acceptance Fee RRR have been generated!</p>
								<table>
								
								<tr>
								<td>Acceptance Fee RRR: $rrr;	</td>
							
								<td>Visit https://erp.yabatech.edu.ng/portal</td>
								</tr>
								</table>
								</body>
								</html>
								";

								// Always set content-type when sending HTML email
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								// More headers
								$headers .= 'From: YABATECH <noreply@yabatech.edu.ng>' . "\r\n";


								mail($to,$subject,$message,$headers);

							    $names= explode(" ",$name);
							    $firstname=$names[0];
								$tel= $studentDetails->phone;
								//$pid= $details->first_name;
								//$fulldate= $fulldetails[3];

								require_once 'assets/bsgateway.php';
								$messageObj = new BSGateway($config);


								$msg = "Hello $firstname,  Kindly Pay your Acceptance Fee with Remita RRR: $rrr";
								$tel ='234'.substr($tel,1);
							//	$response = $messageObj->sendMessage('igwesylvesteragbo@gmail.com', 'IGWE7963', 'YABATECH', $tel, $msg, 0);

		$response= fopen("http://www.ipwebsms.com/index.php?option=com_spc&comm=spc_api&username=Sylvesterict&password=IGWE7963&sender=YABATECH&recipient=$tel&message=$msg&","r");							
                                                                                                                           
       // return $result; 
			
			$_SESSION['portalID'] = $portalID;

			redirect(base_url() . 'index.php?register/remitaInvoice');

		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?register/generate_acp_fee_invoice');

		}

	}
   function remitaInvoice(){

		$page_data['page_name']  = 'remitaInvoice';

        $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos Acceptance Fee Invoice');

        $this->load->view('backend/newstudent_print', $page_data);

	} 	

function pay_acp_fees(){
	 // if ($this->session->userdata('sadmin_login') != 1)

        //    redirect(base_url() . 'index.php?login', 'refresh');
		session_start();
			
		$page_data['page_name']  = 'pay_acp_fees';
        $page_data['page_title'] = get_phrase('Pay Acceptance Fee');
     

        $this->load->view('backend/register', $page_data);
	}

function processRemitaAcceptancePayment(){
 // if ($this->session->userdata('sadmin_login') != 1)

         //   redirect(base_url() . 'index.php?login', 'refresh');
		session_start();

		

		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		$rrr = $this->input->post('confirmcode');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$pmode = $this->input->post('pmode');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
		
		
		$payment= $this->db->get_where('eduportal_remita_accp_temp_data', array('rrr' => $rrr))->row();
		$PortalID1=$payment->putme_id;
		
			if(!$payment)
		{
			$_SESSION['err_msg'] = 'Invalid RRR: Sorry RRR was not generated on this Portal';

			redirect(base_url() . 'index.php?register/pay_acp_fees');

		}
		if($portalID!=$PortalID1)
		{
			$_SESSION['err_msg'] = 'Portal ID Does not Match.';

			redirect(base_url() . 'index.php?register/pay_acp_fees');

		}			
			$query = $this->db->get_where('student' ,array(	'portal_id' => $portalID));

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('newstudent_login', '1');

			  $this->session->set_userdata('newstudent_id', $row->student_id);

			  $this->session->set_userdata('name', $row->name);
			  
			  $this->session->set_userdata('oname', $row->othername);
			  
			  $this->session->set_userdata('fullname', $row->name.', '.$row->othername);

			  $this->session->set_userdata('reg_no', $row->reg_no);
			  		  
			  $this->session->set_userdata('portal_id', $row->portal_id);
			  $_SESSION["portalID"] =$row->portal_id;

			  $this->session->set_userdata('login_type', 'newstudent');

			

		}
		
		if($pmode==1)
		{
	    $exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
	
		
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('newstudent_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?register/etransact_acp_receipt');
}
else
{
 	$terminalID = '7630000003';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                }else{
                   $terminalID = '7630000002';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                  }
                 
                 else{
					  $terminalID = '7730020028';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                  }
					 else{
                  $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                 redirect(base_url() . 'index.php?student/pay_acp_fees');
					 }
                  }
                    
                    
                    
                } 
	
}
		}
		else{
		$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
		
		$session = $verify_invoice->session;
		//echo $session.$this->session->userdata('newstudent_id');
		//exit;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('newstudent_id'),'payment_session'=>$session))->row();
		//echo $verify_payment_log->payment_fee_type;
//exit;
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $rrr,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('newstudent_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);
	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?register/remita_acp_receipt');
}
else
{
	
			$mert =  '576943955';

			$api_key =  '428537';

			$concatString = $rrr . $api_key . $mert;

			$hash = hash('sha512', $concatString);

			$url 	= 'https://login.remita.net/remita/ecomm/' . $mert  . '/' . $rrr . '/' . $hash . '/' . 'status.reg';

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

			

			if($msg == 'Approved'){

				

				//get the applicant invoice details using the portal id

				$stud = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rem))->row();
                $student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
				

				$data['rrr'] = $rem;
				$data['payment_id'] = $response['orderId'];
				$data['channel'] = 'BRANCH';
				$data['amount'] = $response['amount'];
				$data['payer_name'] = $student->name.' '.$student->othername;
				$data['payer_email'] =$student->email;

				$data['payer_phone'] = $student->phone;

				$data['unique_id'] = $response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = date("Y-m-d");
				 $data['debit_date']=$response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();
$session = $verify_invoice->session;
$year = $verify_invoice->year;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_accp_temp_data', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					//$_SESSION['payeeID']= $rrr;
					//redirect(base_url() . 'index.php?register/remita_acp_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);
				}

$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('newstudent_id'),'payment_session'=>$session))->row();

		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $rrr,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('newstudent_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);
include('application/config/z.php');
 
$serviceheadid = "gtcopaul";
$token  = "736@_73gh";

$adm= sqlsrv_query($conn,"SELECT  application_no, surname, firstname, middlename from eduportal_admission_list where application_no='$portalID'")or die( print_r( sqlsrv_errors(), true));
 while(list($application_no, $surname, $firstname, $middlename)=sqlsrv_fetch_array($adm))
						{
						
						$names =$surname.' '.$firstname.' '.$middlename;  	
try{
	 $opts = array(
    'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
);
// SOAP 1.2 client


$params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
$soapclient = new SoapClient('http://portal.yabatech.edu.ng/paymentservice/yctoutservice.asmx?wsdl',$params);

$param=array(
'tx'=>$serviceheadid,
'ty'=>$token,
't1'=>"Approved",
't2'=>date('Y-m-d H:i:s'),
't3'=>$verify_invoice->amount,
't4'=>"ACCEPTANCE FEE PAYMENT FOR ".$names,
't5'=>$rrr,
't6'=>"4",
't7'=>$portalID);
//print_r($param);
//exit;

$response =$soapclient->dodo($param);

echo '<br>';
$array = json_decode(json_encode($response), true);
//$response = json_decode($jsonData, true);




	foreach($array as $item) {
		
echo $item;
$result =json_decode($item, true);
echo '<br/>';
	
	
}	
	sqlsrv_query($conn,"update eduportal_fees_payment_log set posted_citm='1' where regno='$portalID'") or die( print_r( sqlsrv_errors(), true));
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}
		}
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?register/remita_acp_receipt');
				

				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_acp_fees');	

}			
	
}

	}
	
	function remita_acp_receipt()
	{
		
		session_start();
$page_data['page_name']  = 'remita_acp_receipt';
    $page_data['page_title'] = 'YABATECH Acceptance Fee Payment Receipt';
$this->load->view('backend/newstudent_print',$page_data);
	
	}

	
function createaccountfromoutside()
	{
		 $page_data['page_name']  = 'createaccountfromoutside';
     
        $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos | Create Portal Account');
         $this->load->view('backend/student_print', $page_data); 
	}
	
		function access(){
		$this->session->set_userdata('access', 1);
		redirect(base_url() . 'index.php?student/hostel', refresh);

	}
	
function createportalaccountfromoutside()
	{
		session_start();
		$portalID = $this->input->post('portal_id');
		$lname = $this->input->post('lastname');
		$firstname = $this->input->post('firstname');
		$middlename = $this->input->post('middlename');
		$student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
			if(!$student)
			 {
		
			$data['name']        = $this->input->post('name');
            $data['othername']   = $this->input->post('othername');
			$data["reg_no"]=$portalID ;
			$data["portal_id"]=$portalID;
			$data["password"]="12345";
			$data['dept']        = $this->input->post('dept');
            $data['programme']   = $this->input->post('programme');
            $data['school']      = $this->input->post('school');
            $data['prog_type']   = $this->input->post('prog_type');
			$data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
			$data['status']       = '2';
			
			//$data["prog_type"]=$this->input->post('middlename');
			
			$_SESSION['app_no'] = $portalID;
			$_SESSION['st_type'] = '1';
			$_SESSION['fee_type'] = $this->input->post('paymentType');
			$result=$this->db->insert('student',$data);
			//$score =$alreadyRecorded->screening_result;
			//echo $result;
			$credential2	=	array(	'portal_id' => $portalID  );
			$query = $this->db->get_where('student' , $credential2);

        if ($query->num_rows() > 0) {

            $row = $query->row();
		}
			
			$this->session->set_userdata('student_login', '1');

			  $this->session->set_userdata('student_id', $row->student_id);

			  $this->session->set_userdata('name', $row->name);
			  
			  $this->session->set_userdata('oname', $row->othername);
			  
			  $this->session->set_userdata('fullname', $row->name.', '.$row->othername);

			  $this->session->set_userdata('reg_no', $row->reg_no);
			  
			  $this->session->set_userdata('email', $row->email);

			  $this->session->set_userdata('phone', $row->phone);
			  
			  $this->session->set_userdata('portal_id', $row->portal_id);

			  $this->session->set_userdata('login_type', 'student');
			
				$credential2	=	array(	'portal_id' => $portalID  );
			$query = $this->db->get_where('student' , $credential2);

        if ($query->num_rows() > 0) {

            $row = $query->row();
		}
			
			$this->session->set_userdata('student_login', '1');

			  $this->session->set_userdata('student_id', $row->student_id);

			  $this->session->set_userdata('name', $row->name);
			  
			  $this->session->set_userdata('oname', $row->othername);
			  
			  $this->session->set_userdata('fullname', $row->name.', '.$row->othername);

			  $this->session->set_userdata('reg_no', $row->reg_no);
			  
			  $this->session->set_userdata('email', $row->email);

			  $this->session->set_userdata('phone', $row->phone);
			  
			  $this->session->set_userdata('portal_id', $row->portal_id);

			  $this->session->set_userdata('login_type', 'student');
			
				redirect(base_url() . 'index.php?register/portal_account_slip');
			 }
			else
			 {
			$_SESSION['app_no'] = $portalID;
			$_SESSION['st_type'] = '2';
			$_SESSION['fee_type'] = $this->input->post('paymentType');
			
			
			//echo '1';
			redirect(base_url() . 'index.php?register/portal_account_slip');
			 }
			
	}
    function password($param1 = '', $param2 = '', $param3 = '')
    {
		
		
        //if ($this->session->userdata('admin_login') != 1)
            //redirect(base_url(), 'refresh');
        $this->session->set_userdata('etti','etti');
        if ($param1 == 'forgot') {
            $reg                 = $this->input->post('name');
            $phone               = $this->input->post('phone');
            $check = $this->db->get_where('student', array('reg_no' => $reg,'phone'=>$phone))->row();
            

            if($check){
                if($this->session->userdata('etti')){
                $this->load->library('ozioma'); //load the ozioma library  $this->input->post('message')
                $this->ozioma->set_message("Hello ".$reg.", Your password is ".$check->password.". Please login with your Reg/Matric No and password.");//message from textfield
                $this->ozioma->set_recipient($check->phone);//separate numbers with commas and include zip code in every number
                $this->ozioma->set_sender("YABATECH EDUPORTAL");//sender from database
                        //echo "am here too";
                $this->session->unset_userdata('etti');
                $this->ozioma->send();
            }

                $_SESSION['err_msg'] = "The message has been sent...";
                $_SESSION['etti'] = 'pishaun';
                redirect(base_url() . 'index.php?register/password');
            }else{
               $_SESSION['err_msg'] = "Sorry: Reg No/ Matric Number and phone number combination is incorrect, please enter the correct reg number and the phone number used during registration..."; 
            }
            
            //$this->db->insert('teacher', $data);
            //$teacher_id = mysql_insert_id();
            //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            //$this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            //redirect(base_url(), 'refresh');
            

            
        }
        $page_data['page_name'] = 'forgot_password';
        $page_data['page_title'] = get_phrase('Federal Polytechnic Owerri | Forgor Password');
        $this->load->view('backend/register', $page_data);
    }

    public function register1()
    {     //$page_data['teachers']   = $this->db->get('teacher')->result_array();

		
	
        $page_data['user']    = $_SESSION['user'];
        session_unset($_SESSION['user']);
        //$page_data['page_name']  = 'register2';
        //$page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/login1', $page_data);

         //$this->load->view('backend/login');
    }


    public function register2()
    {
		
		
		
      if(!isset($_SESSION['register2'])){
    header('Location:index.php?register');
    }
        if(!$this->input->post('submit')){
        $page_data['user']    = $_SESSION['user'];

         $page_data['page_name']  = 'register1';
         $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/register', $page_data);
        }
        else{
           $page_data['fname']        = strtoupper($this->input->post('fname'));
           $page_data['name']        = strtoupper($this->input->post('name'));
            $page_data['address']     = $this->input->post('address');
            $page_data['reg_no']     = $this->input->post('reg_no');
            $page_data['phone']       = $this->input->post('phone');
            $page_data['email']       = $this->input->post('email');
            $page_data['title']       = $this->input->post('title');
            $page_data['password']       = $this->input->post('password');
            $page_data['password_c']      = $this->input->post('password_c');

		if(($page_data['password'] == $page_data['password_c']) && (is_numeric($page_data['phone'])) && (filter_var($page_data['email'], FILTER_VALIDATE_EMAIL))){

			$countries = $this->db->get("countries");
			$conlist = $countries->result_array();

			$_SESSION['register3'] = 'register3';
			$page_data['country']  = $conlist;
			$page_data['page_name']  = 'register2';
			$page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
			$this->load->view('backend/register', $page_data);
		}
      else{
        //$_SESSION['err_msg'] = "Your passwords do  not match.";
        //$page_data['pwd_verify'] = "Your passwords do  not match";
        //$this->load->view('backend/register/register1');

        $page_data['error'] = "One or more of the following errors may have occured. <br /> &nbsp; &nbsp; \\\ Your passwords do  not match, <br /> &nbsp; &nbsp; \\\ Your phone number input is not a number, <br /> &nbsp; &nbsp; \\\ Your email input is not a valid email address. <br /> Please review and input again.";
        $page_data['fname'] = $page_data['fname'];
        $page_data['name'] = $page_data['name'];
        $page_data['user'] = $page_data['reg_no'];
        $page_data['phone'] = $page_data['phone'];
        $page_data['email'] = $page_data['email'];
        $page_data['title'] = $page_data['title'];
        $page_data['address'] = $page_data['address'];

        $page_data['page_name']  = 'register1';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College Of Education | Register');
        $this->load->view('backend/register', $page_data);
      }
        }
    }

    public function register21()
    {
		
		
		
    if(!isset($_SESSION['user'])){
    header('Location:index.php?register');
    }
         $page_data['user']    = $_SESSION['user'];

         $page_data['page_name']  = 'register2';
         $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/register', $page_data);
    }

    public function register3($param1 = '', $param2 = '', $param3 = '')
    {
		
		
		
        if(!isset($_SESSION['register3'])){
    header('Location:index.php?register');
    }
    unset($_SESSION['register2']);
         if($param1 == 'info'){
			if(!isset($_SESSION['ertti'])){
            $data['name']        = $this->input->post('name');
            $data['othername']   = $this->input->post('fname');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['religion']    = $this->input->post('religion');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['address']     = $this->input->post('address');
            $data['reg_no']     = $this->input->post('reg_no');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['marital_status']       = $this->input->post('marital_status');
            $data['nationality'] = $this->input->post('nationality');
            $data['state']       = $this->input->post('state');
            $data['title']       = $this->input->post('title');
            $data['country']       = $this->input->post('country');
            $data['lga']         = $this->input->post('lga');
            $data['dept']        = $this->input->post('dept');
            $data['programme']   = $this->input->post('programme');
            $data['school']      = $this->input->post('school');
            $data['prog_type']   = $this->input->post('prog_type');
            $data['level']       = $this->input->post('level');
            $data['semester']    = $this->input->post('semester');
            $data['parent_name']        = $this->input->post('parent_name');
            $data['parent_phone']       = $this->input->post('parent_phone');
            $data['parent_address']     = $this->input->post('parent_address');
            $data['password']     = $this->input->post('password');
            $data['date_reg']     = date("Y-m-d h:i:s");


            //$page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
            //$this->load->view('backend/register', $page_data);
			$_SESSION['ertti'] = 'etti';
            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();

            $_SESSION['id'] = $student_id;
            $_SESSION['phone'] = $data['phone'];
            $_SESSION['address'] = $data['address'];
            $_SESSION['dept'] = $data['dept'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['prog'] = $data['prog_type'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['fullname'] = $data['name'] . " " . $data['othername'];
            $_SESSION['reg'] = $data['reg_no'];

			}
            header('Location:index.php?register/register3');
		 
         }
        if($param1 == 'picture'){
      $student_id = $_SESSION['id'];
			
      $max_file_size = 51200;

      $imagesize = $_FILES['userfile']['size'];
      $signsize = $_FILES['usersign']['size'];

      if($imagesize > $max_file_size){
        $_SESSION['imgerror'] = "Passport image size is too large. Please upload an image less than 50kb";
        $page_data['page_name']  = 'register3';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
        header('Location:index.php?register/register3');
        //$this->load->view('backend/register', $page_data);
      }elseif($signsize > $max_file_size){
        $_SESSION['imgerror'] = "Signature image size is too large. Please upload an image less than 50kb";
        $page_data['page_name']  = 'register3';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
        header('Location:index.php?register/register3');
        //$this->load->view('backend/register', $page_data);
      }else{
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
        $this->crud_model->clear_cache();
        $_SESSION['image'] = 'uploads/student_image/' . $student_id . '.jpg';

        move_uploaded_file($_FILES['usersign']['tmp_name'], 'uploads/student_signature/' . $student_id . '.jpg');
        $_SESSION['signature'] = 'uploads/student_signature/' . $student_id . '.jpg';
        $this->crud_model->clear_cache();
        $_SESSION['register4'] = "register4";
        header('Location:index.php?register/register4');
      }

          //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
          //$this->crud_model->clear_cache();
          //$_SESSION['image'] = 'uploads/student_image/' . $student_id . '.jpg';
          //$imagesize = getImageSize($_SESSION['image']);

          /*move_uploaded_file($_FILES['usersign']['tmp_name'], 'uploads/student_signature/' . $student_id . '.jpg');
          $_SESSION['signature'] = 'uploads/student_signature/' . $student_id . '.jpg';
          $this->crud_model->clear_cache();
          header('Location:index.php?register/register4');*/
        }

        $page_data['page_name']  = 'register3';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/register', $page_data);
		$this->session->set_userdata('ph','08131342381');

            /*var_dump($student_id);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/student_add/' . $data['class_id'], 'refresh');


         redirect(base_url().'index.php?register/register3' , 'refresh'); */
    }

    public function register4()
    {
		
		
	unset($_SESSION['ertti']);
    if(!isset($_SESSION['register4'])){
    header('Location:index.php?register');
    }
    unset($_SESSION['register3']);
    unset($_SESSION['imgerror']);
        $page_data['reg_no']  = $_SESSION['reg'];
        $_SESSION['page'] = 'ozioma';
        //$page_data['page_name']  = 'register4';
        $page_data['page_name']  = 'register4';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/register', $page_data);
    }

    public function register5($param1 = '', $param2 = '', $param3 = '')
    {
		
		
		
    if(!isset($_SESSION['user'])){
    header('Location:index.php?register');
    }
	
    $sid = $_SESSION['id'];
    if($param1 == 'e'){
			unset($_SESSION['register4']);
			
			$this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
			$this->etranzact->set_terminal($this->input->post('TERMINAL_ID'));//message from textfield
			$this->etranzact->set_conf($this->input->post('CONFIRMATION_NO'));//message from textfield
			$this->session->set_userdata('level',$_SESSION['level']);
			$this->session->set_userdata('session',$this->input->post('session'));
			//$this->session->set_userdata('conff',$this->input->post('CONFIRMATION_NO'));
			$this->session->set_userdata('serial',$this->input->post('serial'));
			$this->session->set_userdata('address',$_SESSION['address']);
			$this->session->set_userdata('phone',$_SESSION['phone']);
			$this->session->set_userdata('image',$_SESSION['image']);
			$this->session->set_userdata('signature',$_SESSION['signature']);
			$this->session->set_userdata('prog',$_SESSION['prog']);
			$this->session->set_userdata('dept',$_SESSION['dept']);
			$this->session->set_userdata('password',$_SESSION['password']);

			$check = $this->db->get_where('etranzact_payment', array('customer_id' => $this->session->userdata('serial'),'confirm_code'=>$this->input->post('CONFIRMATION_NO')))->row();
			if(!$check){ //check if student has not registered
				$check = $this->db->get_where('etranzact_payment', array('confirm_code'=>$this->input->post('CONFIRMATION_NO')))->result_array();
				//var_dump($check);
				//if( !empty($check) && $check->customer_id != $this->session->userdata('serial')){
				if($check){
					$_SESSION['err_msg'] = "Sorry: The Confirmation Code is Invalid, it has been used by another Student...";
				}else {
					$this->etranzact->send();
					//var_dump($this->session->userdata('fullname'));
					if($this->etranzact->get_status() != "-1"){  //start etranzact check

						$this->session->set_userdata('receipt',$this->etranzact->get_receipt()); //Trans Receipt
						$this->session->set_userdata('fullname',$this->etranzact->get_fullname()); //Student Name
						$this->session->set_userdata('bankcode',$this->etranzact->get_bankcode()); //Bank Code
						$this->session->set_userdata('bankname',$this->etranzact->get_bankname());  //Bank Name
						$this->session->set_userdata('branchcode',$this->etranzact->get_branchcode());//Branch Code
						$this->session->set_userdata('conff',$this->etranzact->get_confirm());
						$this->session->set_userdata('amount',$this->etranzact->get_amount());//transaction Amount
						$this->session->set_userdata('descr',$this->etranzact->get_descr());  //Transaction Description
						$this->session->set_userdata('date',$this->etranzact->get_date());    //Transaction Date


						/*start ozioma sms*/
						if($this->etranzact->get_status() != "-1"){
						//echo "am here";
							if($this->session->userdata('ph')){
							//var_dump($_SESSION['page']);
							//var_dump($this->session->userdata('phone'));
								$this->load->library('ozioma'); //load the ozioma library  $this->input->post('message')
								$this->ozioma->set_message("Hello ".$this->session->userdata('fullname').", Your fee has been successfully processed for the ".   $this->session->userdata('session')." Session. And your login details are: ".$this->session->userdata('serial')." & password: ".$this->session->userdata('password'));//message from textfield
								$this->ozioma->set_recipient($this->session->userdata('phone'));//separate numbers with commas and include zip code in every number
								$this->ozioma->set_sender("Alvan Reg");//sender from database
								$this->ozioma->send();
								$this->session->unset_userdata('ph');
								if(!$this->ozioma->get_status() == 'OK'){
									/// exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
								}
							}
							//end ozioma
						}

						$data['customer_id'] =  $this->session->userdata('serial');
                        $data['date_reg'] =  date("Y-m-d");
						$data['fullname'] =  $this->session->userdata('fullname');
						$data['receipt_no'] =  $this->session->userdata('receipt');
						$data['confirm_code'] = $this->session->userdata('conff');
						$data['description'] = $this->session->userdata('descr');
						$data['amount'] =    $this->session->userdata('amount');
						$data['phone'] =    $this->session->userdata('phone');
						$data['prog_type'] =      $this->session->userdata('prog');
						$data['dept'] =      $this->session->userdata('dept');
						$data['level'] =      $this->session->userdata('level');
						$data['session'] =      $this->session->userdata('session');
                        $data['bankname'] =  $this->session->userdata('bankname');
						$data['bankcode'] =  $this->session->userdata('bankcode');
						$data['branchcode'] =  $this->session->userdata('branchcode');
						$data['cust_add'] =     $this->session->userdata('address');
						$data['payment_date'] =   $this->session->userdata('date');
						$data['used_by'] =      $this->session->userdata('serial');
						$data['status'] =       "paid";

						$this->db->insert('etranzact_payment', $data);


						//$invoice_id                = $_POST['custom'];
						//$this->db->where('invoice_id', $invoice_id);
						//$this->db->update('invoice', $data);
						$_SESSION['err_msg'] = "Correct Pin / Serial Number Combination.";
						$link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print reciept for your fees</a>';
						$_SESSION['prn_msg'] = $link;
					}else if($this->etranzact->get_status() == "-1"){
						$_SESSION['err_msg'] = "Sorry: The Confirmation Code is Invalid...";
					}else if($this->etranzact->get_status() == "00"){
						$_SESSION['err_msg'] = "The server is down at the Moment, Please try again in an hour.";
					}//end etranzact check
                }
            }else{ //if he has registered retrieve data from database
              $payment =  $this->db->get_where('etranzact_payment', array('customer_id' => $this->session->userdata('serial')))->row();
				//var_dump($payment);
			   $this->session->set_userdata('fullname',$payment->fullname);
			   $this->session->set_userdata('bankcode',$payment->bankcode);
			   $this->session->set_userdata('bankname',$payment->bankname);
			   $this->session->set_userdata('branchcode',$payment->branchcode);
			   $this->session->set_userdata('conff',$payment->confirm_code);
			   $this->session->set_userdata('amount',$payment->amount);
			   $this->session->set_userdata('descr',$payment->description);
			   $this->session->set_userdata('date',$payment->payment_date);
			   $this->session->set_userdata('receipt',$payment->receipt_no);
			   $this->session->set_userdata('session',$payment->session);
               $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$sid));//
               $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$sid));
			   //$this->session->set_userdata('conf',$payment->confirm_code);
			   $this->session->set_userdata('address',$payment->cust_add);
			   $this->session->set_userdata('phone',$payment->phone);
			   $this->session->set_userdata('dept',$payment->dept);
			   $this->session->set_userdata('level',$payment->level);
			   //$this->session->set_userdata('ph','08131342381');
			   
			   if($this->etranzact->get_status() != "-1"){
				//echo "am here";
				//$_SESSION['page'] = 'k';
					if($this->session->userdata('ph')){
					//var_dump($_SESSION['page']);
					//var_dump($this->session->userdata('phone'));
						$this->load->library('ozioma'); //load the ozioma library  $this->input->post('message')
						$this->ozioma->set_message("Hello ".$this->session->userdata('fullname').", Your fee has been successfully processed for the ".   $this->session->userdata('session')." Session. And your login details are: ".$this->session->userdata('serial')." & password: ".$this->session->userdata('password'));//message from textfield
						$this->ozioma->set_recipient($this->session->userdata('phone'));//separate numbers with commas and include zip code in every number
						$this->ozioma->set_sender("Alvan Reg");//sender from database
						//echo "am here too";
						$this->ozioma->send();
						unset($_SESSION['page']);
						if(!$this->ozioma->get_status() == 'OK'){
							/// exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
						}
					}
					//end ozioma
				}
						
			   $_SESSION['err_msg'] = "This Etranzact Confirmation Code was previously been used You...";
			   $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print reciept for your fees</a>';
			   $_SESSION['prn_msg'] = $link;
            }//end

        }// end of param e

        if($param1 == 'm'){
	      unset($_SESSION['register4']);
          $manual = $this->db->get_where('manual_payment', array('payment_code'=>$this->input->post('CONFIRMATION_NO')))->row();
          //var_dump($manual);
          if($manual){
            //echo "proceed to print page";
            $verify = $this->db->get_where('manual_etranzact', array('confirm_code'=>$this->input->post('CONFIRMATION_NO')))->row();//if exists
            $check = $this->db->get_where('manual_etranzact', array('confirm_code'=>$this->input->post('CONFIRMATION_NO'),'customer_id'=>$this->input->post('serial')))->row();//if exist and assigned to a student

            $this->session->set_userdata('level',$_SESSION['level']);
            $this->session->set_userdata('session',$this->input->post('session'));
            //$this->session->set_userdata('conff',$this->input->post('CONFIRMATION_NO'));
            $this->session->set_userdata('serial',$this->input->post('serial'));
            $this->session->set_userdata('address',$_SESSION['address']);
            $this->session->set_userdata('phone',$_SESSION['phone']);
            $this->session->set_userdata('image',$_SESSION['image']);
            $this->session->set_userdata('signature',$_SESSION['signature']);
            $this->session->set_userdata('dept',$_SESSION['dept']);
			$this->session->set_userdata('prog',$_SESSION['prog']);
            $this->session->set_userdata('password',$_SESSION['password']);
            $this->session->set_userdata('fullname',$_SESSION['fullname']); //get from student input
            $this->session->set_userdata('bankcode',$manual->merchant_code); //get from student input
            $this->session->set_userdata('bankname','');
            $this->session->set_userdata('branchcode','');
            $this->session->set_userdata('receipt',$manual->trans_no);
            $this->session->set_userdata('conff',$manual->payment_code);
            $this->session->set_userdata('amount',$manual->trans_amount);
            $this->session->set_userdata('descr',$manual->trans_descr);
            $this->session->set_userdata('date',$manual->trans_date);

            if($verify){
              if($check){
                //echo "retriving from database";
                $this->session->set_userdata('level',$check->level);
                $this->session->set_userdata('session',$check->session);
                //$this->session->set_userdata('conff',$this->input->post('CONFIRMATION_NO'));
                $this->session->set_userdata('serial',$check->customer_id);
                $this->session->set_userdata('address',$check->cust_add);
                $this->session->set_userdata('phone',$check->phone);
                $this->session->set_userdata('image',$_SESSION['image']);
                $this->session->set_userdata('signature',$_SESSION['signature']);
                $this->session->set_userdata('prog',$check->prog_type);
                $this->session->set_userdata('dept',$check->dept);
                $this->session->set_userdata('password',$_SESSION['password']);
                $this->session->set_userdata('fullname',$check->fullname); //get from student input
                $this->session->set_userdata('bankcode',$check->bankcode); //get from student input
                $this->session->set_userdata('bankname',$check->bankname);
                $this->session->set_userdata('branchcode',$check->branchcode);
                $this->session->set_userdata('conff',$check->confirm_code);
                $this->session->set_userdata('amount',$check->amount);
                $this->session->set_userdata('descr',$check->description);
                $this->session->set_userdata('date',$check->payment_date);

                $_SESSION['err_msg'] = "This Etranzact Confirmation Code was previously been used You...";
                $link = '<a target ="_blank" href='.base_url().'index.php?student/printer/manual>Click here to print your School Fees reciept</a>';
                 $_SESSION['prn_msg'] = $link;
               }
               else if(!$check){
                $_SESSION['err_msg'] = "This Etranzact Confirmation Code was used by Another Student...";

               }
            }else{
               //echo "insering into manual_etranzact";
              $data['customer_id'] =  $this->session->userdata('serial');
              $data['date_reg'] =  date("Y-m-d");
              $data['fullname'] =  $this->session->userdata('fullname');
              $data['receipt_no'] =  $this->session->userdata('receipt');
              $data['confirm_code'] = $this->session->userdata('conff');
              $data['description'] = $this->session->userdata('descr');
              $data['amount'] =    $this->session->userdata('amount');
              $data['phone'] =    $this->session->userdata('phone');
              $data['prog_type'] =      $this->session->userdata('prog');
              $data['dept'] =      $this->session->userdata('dept');
              $data['level'] =      $this->session->userdata('level');
              $data['session'] =      $this->session->userdata('session');
              $data['bankcode'] =  $this->session->userdata('bankcode');
              $data['branchcode'] =  $this->session->userdata('branchcode');
              $data['cust_add'] =     $this->session->userdata('address');
              $data['payment_date'] =   $this->session->userdata('date');
              $data['used_by'] =      $this->session->userdata('reg_no');
              $data['status'] =       "paid";

              if($data['confirm_code'] == 0 || $data['confirm_code'] == '0'){
                $_SESSION['err_msg'] = "Transaction unsuccessful...";
                return false;
                exit;
              }
                
              $this->db->insert('manual_etranzact', $data);
              /*Start Ozioma*/
              $this->load->library('ozioma'); //load the ozioma library  $this->input->post('message')
              $this->ozioma->set_message("Hello ".$this->session->userdata('fullname').", Your fee has been successfully processed for the ".$this->session->userdata('session')." Session. And your login details are: ".$this->session->userdata('reg_no')." & password: ".$this->session->userdata('password')."");//message from textfield
              $this->ozioma->set_recipient($this->session->userdata('phone'));//separate numbers with commas and include zip code in every number
              $this->ozioma->set_sender("Alvan Reg");//sender from database
              $this->ozioma->send();
              /*Emd Ozioma */

              $_SESSION['err_msg'] = "Correct Confirmation Code...";
              $link = '<a target ="_blank" href='.base_url().'index.php?student/printer/manual>Click here to print your School Fees reciept</a>';
              $_SESSION['prn_msg'] = $link;
              }
          }else if(!$manual){
            $_SESSION['err_msg'] = "Sorry: This Etranzact Confirmation Code is invalid...";
          }

        }// end of param m

          //$page_data['page_name']  = 'register5';
          /*$page_data['page_name']  = 'print';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/printout', $page_data); */
          $page_data['page_name']  = 'register4';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
         $this->load->view('backend/register', $page_data);

    }

public function getappformdata()
{
//echo "Testinf";
//exit;
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//sinclude('application/config/z.php');
//include 'remita_constants.php';
//include 'kee.php';

$payerID=base64_decode($_POST["virus11"]);
$payername = base64_decode($_POST["virus7"]);
$payerEmail = base64_decode($_POST["virus1"]);
$payerPhone=base64_decode($_POST["virus2"]);
$Orderid=base64_decode($_POST["virus8"]);
$paymentID=base64_decode($_POST["virus10"]);
$paymentName=base64_decode($_POST["virus9"]);
$responseurl="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx";
$amt=base64_decode($_POST["virus3"]);
$acadsession=base64_decode($_POST["virus4"]);
$paymentdescription=base64_decode($_POST["virus5"]);
$programName=base64_decode($_POST["virus6"]);
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $paymentName." FOR ".$payername;
$_SESSION["payment_name"] = $paymentName;
//if($_SERVER['HTTP_REFERER'] =="http://localhost:21235/ALVAN_UTMECBT_APP/Webservice.aspx")
if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) =="portal.yabatech.edu.ng" || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) =="erp.yabatech.edu.ng" )
{
if($paymentID==21)
{
$query= sqlsrv_query($conn,"select * from applicationinvoice_gen where sid='$Orderid'") or die
(sqlsrv_errors());

						if(sqlsrv_num_rows($query) > 0){
	$query2= sqlsrv_query("select * from applicationinvoice_gen where sid='$Orderid' limit 1") or die
(print_r( sqlsrv_errors(), true));
						while(list($id,$payername,$payeremail,
					
$payerphone,$orderid,$paymentid,$amt,$acadsession,$paymentdescription,$paymentName,$rem,$dategenerated)=sqlsrv_fetch_array($query2))
						{
?>
<form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/choosemethod_two.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rem;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
                  <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
                       </form>

  <?php
						}?>
                            <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm1").submit();</script>
  <?php
						
					}
						else	
				{

$totalAmount = $amt;
$timesammp=DATE("dmyHis");		
$orderID = $timesammp;
$payerName = base64_decode($_POST["virus7"]);
$payerEmail = base64_decode($_POST["virus1"]);
$payerPhone=base64_decode($_POST["virus2"]);
$responseurl = "http://45.34.15.68/getRemitaResponse.php";
//$responseurl = "http://45.34.15.68/apis/yabatech/getRemitaResponse.php";
$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
$hash = hash('sha512', $hash_string);
$itemtimestamp = $timesammp;
$itemid1="itemid1";
$itemid2="34444".$itemtimestamp;
$itemid3="8694".$itemtimestamp;
$beneficiaryName="Oshadami Mke";
$beneficiaryName2="Mujib Ishola";
$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0360883515";
$beneficiaryAccount2="4017904612";
$beneficiaryAccount3="4017904612";
$bankCode="011";
$bankCode2="050";
$bankCode3="070";
$beneficiaryAmount ="1000";
$beneficiaryAmount2 ="0";
$beneficiaryAmount3 ="0";
$deductFeeFrom=1;
$deductFeeFrom2=0;
$deductFeeFrom3=0;
//The JSON data.
$content = '{"merchantId":"'. MERCHANTID
.'"'.',"serviceTypeId":"'.SERVICETYPEID
.'"'.",".'"totalAmount":"'.$totalAmount
.'","hash":"'. $hash
.'"'.',"orderId":"'.$orderID
.'"'.",".'"responseurl":"'.$responseurl
.'","payerName":"'. $payerName
.'"'.',"payerEmail":"'.$payerEmail
.'"'.",".'"payerPhone":"'.$payerPhone
.'","lineItems":[
{"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"},
{"lineItemsId":"'.$itemid2.'","beneficiaryName":"'.$beneficiaryName2.'","beneficiaryAccount":"'.$beneficiaryAccount2.'","bankCode":"'.$bankCode2.'","beneficiaryAmount":"'.$beneficiaryAmount2.'","deductFeeFrom":"'.$deductFeeFrom2.'"},
{"lineItemsId":"'.$itemid3.'","beneficiaryName":"'.$beneficiaryName3.'","beneficiaryAccount":"'.$beneficiaryAccount3.'","bankCode":"'.$bankCode3.'","beneficiaryAmount":"'.$beneficiaryAmount3.'","deductFeeFrom":"'.$deductFeeFrom3.'"}
]}';
$curl = curl_init(GATEWAYURL);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
// Disable SSL verification
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$jsonData = substr($json_response, 6, -1);
$response = json_decode($jsonData, true);
$statuscode = $response['statuscode'];
$statusMsg = $response['status'];

if($statuscode=='025'){
$rrr = trim($response['RRR']);
$new_hash_string = MERCHANTID . $rrr . APIKEY;
$new_hash = hash('sha512', $new_hash_string);

$date =date('Y-m-d H:i:s');
$sql = "INSERT INTO applicationinvoice_gen (payername,payeremail,payerphone,orderid,paymentid,amt,acadsession,paymentdescription,paymentName,rrr,dategenerated,status,sid,payerID,programName) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array("$payerName","$payerEmail","$payerPhone","$orderID","$paymentID","$amt","$acadsession","$description","$paymentName","$rrr","$date","Payment Reference generated","$Orderid","$payerID","$programName");
$query = sqlsrv_query($conn,$sql,$params);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close($conn);
?>
<form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/choosemethod_two.php" name="SubmitRemitaForm" id="SubmitRemitaForm" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="http://45.34.15.69/apis/yabatech/getRemitaResponse.php" type="hidden"> 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm").submit();</script>
<?php }
else{
	
	?>
<form action="rrrgen.php" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                 
                 <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>
<?php
}

			}
	exit;		
}
if($paymentID==1)
{
	?>
    <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_putme.php" name="SubmitRemitaForm3" id="SubmitRemitaForm3" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm3").submit();</script>
    
    <?php
	exit;
}
if($paymentID==3)
{
	?>
   <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_changecourse.php" name="SubmitRemitaForm4" id="SubmitRemitaForm4" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
  <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm4").submit();</script> 
    <?php
	exit;
}
if($paymentID==6)
{
	?>
       <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_hostelapp.php" name="SubmitRemitaForm5" id="SubmitRemitaForm5" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm5").submit();</script> 
    <?php
	exit;
}
if($paymentID==7)
{
	?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_hostelfee.php" name="SubmitRemitaForm6" id="SubmitRemitaForm6" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
									<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm6").submit();</script> 
    <?php
	exit;
}
if($paymentID==18)
{
	?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_putme.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}

if($paymentID==5)
{
	?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_schoolfee.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}

if($paymentID==4)
{
	?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_acpfee.php" name="SubmitRemitaForm7" id="SubmitRemitaForm7" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm7").submit();</script> 
    <?php
	exit;
}
if($paymentID==48)
{
?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_damagefee.php" name="SubmitRemitaForm8" id="SubmitRemitaForm8" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm8").submit();</script> 
    <?php
	exit;
	

}
if($paymentID==2)
{
?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_applicationform.php" name="SubmitRemitaForm9" id="SubmitRemitaForm9" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
									<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm9").submit();</script> 
    <?php
	exit;
	

}

if($paymentID==701)
{
?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_hostelfeebalance.php" name="SubmitRemitaForm10" id="SubmitRemitaForm10" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm10").submit();</script> 
    <?php
	exit;
	

}

if($paymentID==22 || $paymentID==23)
{
?>
      <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/chooseTransciptDestination.php" name="SubmitRemitaForm11" id="SubmitRemitaForm11" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm11").submit();</script> 
    <?php
	exit;
	

}

if($paymentID !=21 || $paymentID !=205 || $paymentID !=1 || $paymentID !=2 || $paymentID !=3 || $paymentID !=6 || $paymentID !=7 || $paymentID !=18 || $paymentID !=5 || $paymentID !=4 || $paymentID !=48 || $paymentID !=701 || $paymentID !=22 || $paymentID !=23)
{
	?>
 <form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/getappformdata_otherfees.php" name="SubmitRemitaForm8" id="SubmitRemitaForm8" method="POST"> 
                  
                  <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" value="<?php echo $paymentdescription;?>" />
										<input type="hidden" name="programName" value="<?php echo $programName;?>" />

            </form>
             <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm8").submit();</script> 

<?php
}
}
else
{
	echo "Sorry Request Denied by Remote Server! Please Try Again Later";
}
sqlsrv_close($conn);

	
}

public function choosePaymentMethod()
{
session_start();
	
	$page_data['page_name']  = 'choosePaymentMethod';
          $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos | Choose Payment  Method ');
     $this->load->view('backend/register', $page_data);


}

 function paymentInvoice(){

		$page_data['page_name']  = 'invoice_page_otherfees';

        $page_data['page_title'] = get_phrase('Yaba College of Technology, Lagos Acceptance Fee Invoice');

        $this->load->view('backend/newstudent_print', $page_data);

	}
	
	function remitaGetReceipt(){
  //if ($this->session->userdata('sadmin_login') != 1)

         //   redirect(base_url() . 'index.php?login', 'refresh');
		$this->session->set_userdata('putme_login', 1);

		

		$page_data['page_name']  = 'remitaGetReceipt';

        $page_data['page_title'] = get_phrase('Payment Confirmation');

        $this->load->view('backend/putm', $page_data);

	}
	
	function processRemitaReceipt(){
// if ($this->session->userdata('sadmin_login') != 1)

//            redirect(base_url() . 'index.php?login', 'refresh');
		session_start();

		

		$rrr = $this->input->post('rrr');
		
		if($rrr == '' || $rrr == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect RRR supplied.';

			redirect(base_url() . 'index.php?register/remitaGetReceipt');
		}
		
		
		$payment= $this->db->get_where('applicationinvoice_gen', array('rrr' => $rrr))->row();
		$PortalID1=$payment->payerID;
		$st= $this->db->get_where('student', array('portal_id' => $PortalID1))->row();
		if(!$st)
			 {
				 $names = explode(" ",$payment->payername);
				 
			$data["name"]=$names[0];
			$data["othername"]=$names[1]." ".$names[2];
			$data["reg_no"]=$payment->payerID;
			$data["portal_id"]=$payment->payerID;
			$data["password"]=rand(1000,100000);
			$data["dept"]=0;
			$data["school"]=0;
			$data["programme"]=0;
			$data["prog_type"]=0;
			$data["dept_option"]=0;
			//$email =strtolower($adm_exist->surname).'.'.strtolower($adm_exist->firstname).mt_rand(1,1000).'@student.yabatech.edu.ng';
			$data["program_id"]=0;		
			$data["phone"]=$payment->payerphone;
            $data["email"]=$payment->payeremail;			
			//$this->db->where('student_id',$row['student_id']);
           // $this->db->update('student', $data);
			//$data["email"]=$adm_exist->dept_option_id;
			
			$result=$this->db->insert('student',$data);
			 }
		
			if(!$payment)
		{
			$_SESSION['err_msg'] = 'Invalid RRR: Sorry RRR was not generated on this Portal';

			redirect(base_url() . 'index.php?register/remitaGetReceipt');

		}
		
		
		if($pmode==1)
		{
	    $exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
	
		
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('newstudent_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?register/etransact_acp_receipt');
}
else
{
 	$terminalID = '7630000003';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                }else{
                   $terminalID = '7630000002';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                  }
                 
                 else{
					  $terminalID = '7730020028';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

               $student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
			   $school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $student->level))->row();
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = $this->etranzact->get_date();
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $student->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id'); 
					   
                    $data['portal_id'] = $portalID;
        
                    $data['session'] = '2016/2017'; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session_id;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND Acceptance Fee payment.");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348034158429');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_acp_receipt');   
				             

                  }
					 else{
                  $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                 redirect(base_url() . 'index.php?student/pay_acp_fees');
					 }
                  }
                    
                    
                    
                } 
	
}
		}
		else{
		$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Exist';

			redirect(base_url() . 'index.php?register/remitaGetReceipt');
		}
		$session = $verify_invoice->acadsession;
		$student= $this->db->get_where('student', array('portal_id' => $verify_invoice->payerID))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $verify_invoice->paymentid,'payment_code' => $rrr,'payment_session'=>$session))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$verify_invoice->payerID,
               'payment_code' => $rrr,
               'payment_session' => $session,
			   'payment_level'=> $session,
			   'payment_amount'=>$verify_invoice->amt,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => $verify_invoice->paymentid,
			   'student_id' => $student->student_id,
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?register/remita_payment_receipt');
}
else
{
	
			$mert =  '576943955';

			$api_key =  '428537';

			$concatString = $rrr . $api_key . $mert;

			$hash = hash('sha512', $concatString);

			$url 	= 'https://login.remita.net/remita/ecomm/' . $mert  . '/' . $rrr . '/' . $hash . '/' . 'status.reg';

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

			

			if($msg == 'Approved'){

				

				//get the applicant invoice details using the portal id

				$stud = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rem))->row();
               $student = $this->db->get_where('student', array("portal_id" => $stud->payerID))->row();
				

				$data5['rrr'] = $rem;
				$data5['payment_id'] = $response['orderId'];
				$data5['channel'] = 'BRANCH';
				$data5['amount'] = $response['amount'];
				$data5['payer_name'] = $stud->payername;
				$data5['payer_email'] =$stud->payeremail;

				$data5['payer_phone'] = $stud->payerphone;

				$data5['unique_id'] = $response['orderId'];

				$data5['response_code'] = $response['status'];

				$data5['trans_date'] = date("Y-m-d");
                 $data5['debit_date']=$response['transactiontime'];
				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('applicationinvoice_gen', array("rrr" => $rrr))->row();
$session = $verify_invoice->acadsession;
$year = $verify_invoice->acadsession;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Exit';

			redirect(base_url() . 'index.php?register/pay_acp_fees');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('applicationinvoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?register/remita_acp_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data5);

	$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $verify_invoice->paymentid,'payment_code' => $rrr,'payment_session'=>$session))->row();
	
		if(!$verify_payment_log)
		{
			$payment_data = array(
               'regno'=>$verify_invoice->payerID,
               'payment_code' => $rrr,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amt,
			   'payment_status' =>'F',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => $verify_invoice->paymentid,
			   'student_id' => $student->student_id,
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);
include('application/config/z.php');
 
$serviceheadid = "gtcopaul";
$token  = "736@_73gh";

$adm= sqlsrv_query($conn,"SELECT   payername, payerID from applicationinvoice_gen where rrr='$rrr'")or die( print_r( sqlsrv_errors(), true));
 while(list( $payername, $payerID)=sqlsrv_fetch_array($adm))
						{
						
						$names =$payername;  	
try{
	 $opts = array(
    'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
);
// SOAP 1.2 client


$params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
$soapclient = new SoapClient('http://portal.yabatech.edu.ng/paymentservice/yctoutservice.asmx?wsdl',$params);

$param=array(
'tx'=>$serviceheadid,
'ty'=>$token,
't1'=>"Approved",
't2'=>date('Y-m-d H:i:s'),
't3'=>$verify_invoice->amt,
't4'=>$verify_invoice->paymentdescription,
't5'=>$rrr,
't6'=>$verify_invoice->paymentid,
't7'=>$payerID);
//print_r($param);
//exit;

$response =$soapclient->dodo($param);

echo '<br>';
$array = json_decode(json_encode($response), true);
//$response = json_decode($jsonData, true);




	foreach($array as $item) {
		
echo $item;
$result =json_decode($item, true);
echo '<br/>';
	
	
}	$pid=$verify_invoice->paymentid;
	sqlsrv_query($conn,"update eduportal_fees_payment_log set posted_citm='1' where regno='$payerID' and payment_fee_type='$pid'") or die( print_r( sqlsrv_errors(), true));
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
	
	sqlsrv_query($conn,"update eduportal_fees_payment_log set posted_citm='1' where regno='$payerID' and payment_fee_type='$pid'") or die( print_r( sqlsrv_errors(), true));
	
}
		}
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?register/remita_payment_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?register/remitaGetReceipt');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/remitaGetReceipt');	

}			
	
}

	}
	
	function remita_payment_receipt()
	{
	//	 if ($this->session->userdata('sadmin_login') != 1)

        //    redirect(base_url() . 'index.php?login', 'refresh');
		
		session_start();
$page_data['page_name']  = 'remita_other_fees_receipt';
    $page_data['page_title'] = 'YABATECH  Fee Payment Receipt';
$this->load->view('backend/newstudent_print',$page_data);
	
	}

	}
