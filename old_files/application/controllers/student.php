<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('application/config/z.php');
/*  
 *  @author : Joyonto Roy
 *  date    : 20 August, 2013
 *  University Of Dhaka, Bangladesh
 *  Ekattor School & College Management System
 *  http://codecanyon.net/user/joyontaroy
 */

class Student extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        //$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        //$this->output->set_header(("Access-Control-Allow-Origin: *");
        //$this->output->set_header(("Access-Control-Allow-Headers: *");
    }

    function access(){
        $this->session->set_userdata('access', 1);
        redirect(base_url() . 'index.php?student/manage_profile', refresh);
    }

    function app_system_name(){
        $sys_name = $this->db->get_where('settings', array("type" => 'system_name'))->row();
        return $sys_name->description;
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        
        
        
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/invoice', 'refresh');
            //redirect(base_url() . 'index.php?student/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
		session_start();
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
			if($_SESSION['fee_type'])
		{
			if($_SESSION['fee_type']==1)
			{
				redirect(base_url() . 'index.php?student/generate_acp_fee_invoice', 'refresh');
			}
			if($_SESSION['fee_type']==2)
			{
				redirect(base_url() . 'index.php?student/generate_sch_fee_invoice', 'refresh');
			}
			if($_SESSION['fee_type']==3)
			{
				redirect(base_url() . 'index.php?student/generate_tedc_fee_invoice', 'refresh');
			}
			if($_SESSION['fee_type']==4)
			{
				redirect(base_url() . 'index.php?student/generate_mscp_fee_invoice', 'refresh');
			}
				if($_SESSION['fee_type']>4)
			{
				redirect(base_url() . 'index.php?student/generate_other_fees_invoice', 'refresh');
			}
		}
$student= $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$account_status=$student->status;
if($account_status=="1")
						{
						//echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; 
						$_SESSION["err_msg"]="Please Complete your student account profile/Upload picture & signature to proceed! ";
						redirect(base_url().'index.php?student/manage_profile');
						}
        

        $reg = $this->session->userdata('reg_no');
        $page_data['hostel'] = $this->db->order_by('id', 'DESC')->get_where('counter',array('idno'=>$reg),1)->result_array();
        $page_data['etz'] = $this->db->order_by('id', 'DESC')->get_where('etranzact_payment',array('customer_id'=>$reg),1)->result_array();
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
	function my_profile(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'my_profile';
        $page_data['page_title'] = get_phrase('My_Profile');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
function pay_other_income_fee_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'pay_other_fees';
        $page_data['page_title'] = get_phrase('Pay Other Fees');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
function processOtherFeePayment()
   {
	 		session_start();
	
		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		$pmode = $this->input->post('pmode');
		//$year = $this->input->post('year');
		//$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_other_income_fee_invoice');
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

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if($verify_invoice->application_type_id!=14)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied is not for this payment purpose';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year,'payment_code'=>$confirmcode))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
           'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		
		$_SESSION['payeeID']= $confirmcode;
		
		redirect(base_url() . 'index.php?student/etransact_mscp_fee_receipt');
}
else
{
	$terminalID = '7631121137';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact
	    $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

		
		
     

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){     
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_mscp_fee_receipt');   
				             

                }else{

                    session_start();
                    $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                    redirect(base_url() . 'index.php?student/pay_mscp_fee');
                } 
echo "issue is here!";
	
}
		}
else
{
	
$rrr= $confirmcode;
			
			
			$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_other_income_fee_invoice');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=>$semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?student/remita_other_fees_receipt');
}
else
{
	
			$mert =  '532776942';

			$api_key =  '587460';

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

				$stud = $this->db->get_where('invoice_gen', array("rrr" => $rem))->row();
                $student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
				

				$data['rrr'] = $rem;
				$data['payment_id'] = $response['orderId'];
				$data['channel'] = 'BRANCH';
				$data['amount'] = $response['amount'];
				$data['payer_name'] = $stud->surname.' '.$stud->firstname;
				$data['payer_email'] =$stud->email;

				$data['payer_phone'] = $student->phone;

				$data['unique_id'] = $stud->$response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = $response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
$session = $verify_invoice->session_id;
$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_other_income_fee_invoice');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_mscp_fee_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);


$paymentType= $verify_invoice->application_type_id;
		if($paymentType==15)
		{
		$application_form_category = 5;
		}
		if($paymentType==16)
		{
		$application_form_category = 6;
	
		}
		if($paymentType==17)
		{
		$application_form_category = 7;
		}
		if($paymentType==18)
		{
		$application_form_category = 8;
		
		}
			if($paymentType==19)
		{
		$application_form_category = 9;
		
		}
			if($paymentType==20)
		{
		$application_form_category = 10;
		
		}
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $application_form_category,'student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'payment_fee_type' => $application_form_category,
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
$_SESSION["paytype"]=$verify_invoice->fee_description;
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_other_fees_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?student/pay_other_income_fee_invoice');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_other_income_fee_invoice');	

				
	
}
			
		}


   }
   function remita_other_fees_receipt()
 {
session_start()	;
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remita_otherincome_fees_receipt';
    $page_data['page_title'] = $_SESSION["paytype"].' Receipt';
$this->load->view('backend/student_print',$page_data);
 }	
	

function generate_other_fees_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_otherincome_fee_invoice';
        $page_data['page_title'] = get_phrase('Get OTHER Fees Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
	
	
	function processOtherFeesInvoice()
	{
		session_start();

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$department =$this->input->post('department');
		$school=$this->input->post('school');
		$progtype = $this->input->post('progtype');
		$prog = $this->input->post('prog');
		$semester = $this->input->post('semester');
		
	
		$this->load->library('form_validation');
		
		
		if($paymentType==5)
		{
		$application_form_category = 15;
		$totalAmount =  $this->input->post('amount');
		$this->form_validation->set_rules('amount', 'Amount', 'required|max_length[10]|integer');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$_SESSION['err_msg'] = 'Incorrect Amount Entered! Amount should be numbers only.';

			redirect(base_url() . 'index.php?student/generate_other_fees_invoice');
		}
		else
		{
		
		}
		}
		if($paymentType==6)
		{
		$application_form_category = 16;
		$totalAmount =   $this->input->post('amount');
		$this->form_validation->set_rules('amount', 'Amount', 'required|max_length[10]|numeric');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$_SESSION['err_msg'] = 'Incorrect Amount Entered! Amount should be numbers only.';

			redirect(base_url() . 'index.php?student/generate_other_fees_invoice');
		}
		else
		{
		
		}
		}
		if($paymentType==7)
		{
		$application_form_category = 17;
			$totalAmount =  5000;
		}
		if($paymentType==8)
		{
		$application_form_category = 18;
			$totalAmount =  5000;
		}
			if($paymentType==9)
		{
		$application_form_category = 19;
			$totalAmount =  10000;
		}
		
		if($paymentType==10)
		{
		$application_form_category = 20;
			$totalAmount = 5000;
		}
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_other_fees_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
	
		//define("MERCHANTID", $merchantId->value);

		define("MERCHANTID", 532776942);

		//define("SERVICETYPEID", $serviceTypeId->value);
		
		if($paymentType==5)
		{

		define("SERVICETYPEID", 2688258598);
		
		}
		if($paymentType==6)
		{

		define("SERVICETYPEID", 2688260475);
		}
		if($paymentType==7)
		{

		define("SERVICETYPEID", 2688260964);
		}
		
		if($paymentType==8)
		{

		define("SERVICETYPEID", 2688261439);
		}
			if($paymentType==9)
		{

		define("SERVICETYPEID", 2688261439);
		}
		
			if($paymentType==10)
		{

		define("SERVICETYPEID", 2744323159);
		}
		

		//define("APIKEY", $apiKey->value);

		define("APIKEY", 587460);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

		

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->name . ' ' . $studentDetails->othername; 

		$payerEmail = $studentDetails->email == "" ? 'student@YABATECHo.com' : $studentDetails->email;  

		$payerPhone = $studentDetails->phone; 

		$responseurl = "http://162.144.134.70/nekede/newremitaResponse.php";

		

		//echo $totalAmount; 

		//exit;

		

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="itemid1";

		$itemid2="34444".$itemtimestamp;

				

		$beneficiaryName="Gtco Calscan Nig Ltd";
		
		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";
		
		

		$beneficiaryAccount="0178130137";

		$beneficiaryAccount2="0140468461017";
		
		

		$bankCode="058";

		$bankCode2="000";
		
		

		$beneficiaryAmount =0;
		$totalDeductions=0;

		$beneficiaryAmount2 =$totalAmount - $totalDeductions;
		
		
		$deductFeeFrom=0;

		$deductFeeFrom2=1;
		
		

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
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		// Disable SSL verification

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		

		curl_close($curl);

		$jsonData = substr($json_response, 6, -1);

		$response = json_decode($jsonData, true);

		$statuscode = $response['statuscode'];

		$statusMsg = $response['status'];

		if($statuscode=='025'){

				$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;


$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->rrr;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);

//UPDATE FOR WRONG AMOUNT
$detail = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$idept = $detail->dept;
$iprogramme = $detail->programme;
$ilevel = $detail->level;
$iprog_type = $detail->prog_type;


//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
		
		redirect(base_url()."index.php?student/other_fees_invoice");
}

			
//$timesammp=date("dmyHis");		
//$orderID = $timesammp;
$payment_description = $this->db->get_where('application_type', array("application_typeid"=>$application_form_category))->row()->application_type;

$invoice_code="NIL";
$rrr = trim($response['RRR']);
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>0,
			   'invoice_no'=>$invoice_code,
			   'amount' => $totalAmount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>$payment_description,
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;
$_SESSION['fee_description']=$payment_description;
$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $rrr;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH '.$payment_description.' Invoice';
		
		redirect(base_url()."index.php?student/other_fees_invoice");
			


		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?student/generate_other_fees_invoice');

		}
		
				
				
	}
	
	public function other_fees_invoice()
{
	session_start();
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH '.$_SESSION['fee_description'].' Invoice';
$page_data['page_name']  = 'invoice_page_otherfees';
$this->load->view('backend/student_print',$page_data);
}
	

function generate_mscp_fee_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_mscp_fee_invoice';
        $page_data['page_title'] = get_phrase('Get MSCP Fee Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
	function processMscpInvoice()
	{
		session_start();

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$department =$this->input->post('department');
		$school=$this->input->post('school');
		$progtype = $this->input->post('progtype');
		$prog = $this->input->post('prog');
		$semester = $this->input->post('semester');
		
		
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_mscp_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
				

		//define("MERCHANTID", $merchantId->value);

		define("MERCHANTID", 532776942);

		//define("SERVICETYPEID", $serviceTypeId->value);

		define("SERVICETYPEID", 2688257942);

		//define("APIKEY", $apiKey->value);

		define("APIKEY", 587460);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

		

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		$totalAmount =  5000;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->name . ' ' . $studentDetails->othername; 

		$payerEmail = $studentDetails->email == "" ? 'student@YABATECHo.com' : $studentDetails->email;  

		$payerPhone = $studentDetails->phone; 

		$responseurl = "http://162.144.134.70/nekede/newremitaResponse.php";

		

		//echo $totalAmount; 

		//exit;

		

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="itemid1";

		$itemid2="34444".$itemtimestamp;

				

		$beneficiaryName="Gtco Calscan Nig Ltd";
		
		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";
		
		

		$beneficiaryAccount="0178130137";

		$beneficiaryAccount2="0140468461017";
		
		

		$bankCode="058";

		$bankCode2="000";
		
		

		$beneficiaryAmount =0;
		$totalDeductions=0;

		$beneficiaryAmount2 =$totalAmount - $totalDeductions;
		
		
		$deductFeeFrom=0;

		$deductFeeFrom2=1;
		
		

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

		if($statuscode=='025'){

				$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;

		$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->rrr;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);

//UPDATE FOR WRONG AMOUNT
$detail = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$idept = $detail->dept;
$iprogramme = $detail->programme;
$ilevel = $detail->level;
$iprog_type = $detail->prog_type;


//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
		
		redirect(base_url()."index.php?student/mscp_invoice");
}

			
//$timesammp=date("dmyHis");		
//$orderID = $timesammp;
$invoice_code="NIL";
$rrr = trim($response['RRR']);
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>0,
			   'invoice_no'=>$invoice_code,
			   'amount' => $totalAmount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>'MICROSOFT COLLABORATION PLATFORM FEE',
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $rrr;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH MSCP Invoice';
		
		redirect(base_url()."index.php?student/mscp_invoice");
			


		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?student/generate_mscp_fee_invoice');

		}
		
		/* 
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_mscp_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	

				
$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;
$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->invoice_no;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);
		
		redirect(base_url()."index.php?student/mscp_invoice");
}
else
{
$this->load->model('site_model');
$identification_no= $this->site_model->get_identification_no(array('application_type_id'=>$application_form_category));


$application_invoice_id = $this->site_model->get_invoice_id();
$applicationcategory_code = $this->db->get_where('application_type', array("application_typeid" => $application_form_category))->row();
$lpad_invoice_id =$this->site_model->get_lpad_invoice_id(array('application_invoice_id'=>$application_invoice_id));
$invoice_code="YABATECH/".$applicationcategory_code->application_code."/16".$lpad_invoice_id;
$paymentamount=5000;
//echo $invoice_code.$amount;
$timesammp=date("dmyHis");		
$orderID = $timesammp;
$rrr="NIL";
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>$identification_no,
			   'invoice_no'=>$invoice_code,
			   'amount' => $paymentamount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>'MICROSOFT COLLABORATION PLATFORM FEE',
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $invoice_code;
		
		
		redirect(base_url()."index.php?student/mscp_invoice");

} */
				
				
	}
	
	public function mscp_invoice()
{
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH Microsoft Collaboration Platform Fee Invoice';
$page_data['page_name']  = 'invoice_page_mscp';
$this->load->view('backend/student_print',$page_data);
}
		

function pay_mscp_fee(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'pay_mscp_fees';
        $page_data['page_title'] = get_phrase('Pay Microsoft Collaboration Fees');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
function processMSCPPayment()
   {
	 		session_start();
	
		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		$pmode = $this->input->post('pmode');
		//$year = $this->input->post('year');
		//$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
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

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
			if($verify_invoice->application_type_id!=14)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied is not for this payment purpose';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
           'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?student/etransact_mscp_fee_receipt');
}
else
{
	$terminalID = '7631121137';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact
	    $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

		
		
     

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){     
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '4',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_mscp_fee_receipt');   
				             

                }else{

                    session_start();
                    $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                    redirect(base_url() . 'index.php?student/pay_mscp_fee');
                } 
echo "issue is here!";
	
}
}
else
{
	
$rrr= $confirmcode;
			
			
			$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=>$semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?student/remita_tedc_fee_receipt');
}
else
{
	
			$mert =  '532776942';

			$api_key =  '587460';

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

				$stud = $this->db->get_where('invoice_gen', array("rrr" => $rem))->row();
                $student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
				

				$data['rrr'] = $rem;
				$data['payment_id'] = $response['orderId'];
				$data['channel'] = 'BRANCH';
				$data['amount'] = $response['amount'];
				$data['payer_name'] = $stud->surname.' '.$stud->firstname;
				$data['payer_email'] =$stud->email;

				$data['payer_phone'] = $student->phone;

				$data['unique_id'] = $stud->$response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = $response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
$session = $verify_invoice->session_id;
$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_mscp_fee_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);

$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '4','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();

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
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_mscp_fee_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?student/pay_mscp_fee');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_mscp_fee');	

				
	
}
			
		}


   }
   function remita_mscp_fee_receipt()
 {
	 if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remita_mscp_fee_receipt';
    $page_data['page_title'] = 'YABATECH MSCP Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
 }	
   
   	function etransact_mscp_fee_receipt()
	{

		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'etransact_mscp_fee_receipt';
    $page_data['page_title'] = 'YABATECH Microsoft Collaboration Platform Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}


function generate_tedc_fee_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_tedc_fee_invoice';
        $page_data['page_title'] = get_phrase('Get TEDC Fee Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
function processTedcInvoice()
	{
		session_start();

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$department =$this->input->post('department');
		$school=$this->input->post('school');
		$progtype = $this->input->post('progtype');
		$prog = $this->input->post('prog');
		$semester = $this->input->post('semester');
		
	
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_tedc_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
				

		//define("MERCHANTID", $merchantId->value);

		define("MERCHANTID", 532776942);

		//define("SERVICETYPEID", $serviceTypeId->value);

		define("SERVICETYPEID", 2688257188);

		//define("APIKEY", $apiKey->value);

		define("APIKEY", 587460);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

		

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		$totalAmount =  3000;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->name . ' ' . $studentDetails->othername; 

		$payerEmail = $studentDetails->email == "" ? 'student@YABATECHo.com' : $studentDetails->email;  

		$payerPhone = $studentDetails->phone; 

		$responseurl = "http://162.144.134.70/nekede/newremitaResponse.php";

		

		//echo $totalAmount; 

		//exit;

		

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="itemid1";

		$itemid2="34444".$itemtimestamp;

				

		$beneficiaryName="Gtco Calscan Nig Ltd";
		
		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";
		
		

		$beneficiaryAccount="0178130137";

		$beneficiaryAccount2="0140468461017";
		
		

		$bankCode="058";

		$bankCode2="000";
		
		

		$beneficiaryAmount =0;
		$totalDeductions=0;

		$beneficiaryAmount2 =$totalAmount - $totalDeductions;
		
		
		$deductFeeFrom=0;

		$deductFeeFrom2=1;
		
		

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

		if($statuscode=='025'){

				$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;

		$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->rrr;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);

//UPDATE FOR WRONG AMOUNT
$detail = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$idept = $detail->dept;
$iprogramme = $detail->programme;
$ilevel = $detail->level;
$iprog_type = $detail->prog_type;


//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
		
		redirect(base_url()."index.php?student/tedc_invoice");
}

			
//$timesammp=date("dmyHis");		
//$orderID = $timesammp;
$invoice_code="NIL";
$rrr = trim($response['RRR']);
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>0,
			   'invoice_no'=>$invoice_code,
			   'amount' => $totalAmount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>'TEDC FEE',
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $rrr;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH TEDC Invoice';
		
		redirect(base_url()."index.php?student/tedc_invoice");
			


		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?student/generate_tedc_fee_invoice');

		}
		
		/* if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_tedc_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	

				
$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;
$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->invoice_no;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);
		
		redirect(base_url()."index.php?student/tedc_invoice");
}
else
{
$this->load->model('site_model');
$identification_no= $this->site_model->get_identification_no(array('application_type_id'=>$application_form_category));


$application_invoice_id = $this->site_model->get_invoice_id();
$applicationcategory_code = $this->db->get_where('application_type', array("application_typeid" => $application_form_category))->row();
$lpad_invoice_id =$this->site_model->get_lpad_invoice_id(array('application_invoice_id'=>$application_invoice_id));
$invoice_code="YABATECH/".$applicationcategory_code->application_code."/16".$lpad_invoice_id;
$paymentamount=3000;
//echo $invoice_code.$amount;
$timesammp=date("dmyHis");		
$orderID = $timesammp;
$rrr="NIL";
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>$identification_no,
			   'invoice_no'=>$invoice_code,
			   'amount' => $paymentamount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>'TEDC FEE',
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $invoice_code;
		
		
		redirect(base_url()."index.php?student/tedc_invoice");

}
				 */
				
	}
	
	
	public function tedc_invoice()
{
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH TEDC Fee Invoice';
$page_data['page_name']  = 'invoice_page_tedc';
$this->load->view('backend/student_print',$page_data);
}


function pay_tedc_fees(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'pay_tedc_fees';
        $page_data['page_title'] = get_phrase('Pay TEDC Fees');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}

function processTedcPayment()
   {
	 		session_start();
	
		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		$pmode = $this->input->post('pmode');
		//$year = $this->input->post('year');
		//$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
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

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '3','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
           'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?student/etransact_tedc_fee_receipt');
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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_tedc_fee_receipt');   
				             

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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,

			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_tedc_fee_receipt');   
				             
			}
			else{
				$terminalID = '0570000124';
          //  $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact
	    $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID);//message from textfield
            $this->etranzact->set_conf($confirmcode);//message from textfield
            $this->etranzact->send();

		
		
     

          
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){     
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,


			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_tedc_fee_receipt');   
				             
			}
			else{
				
				
                    session_start();
                    $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                    redirect(base_url() . 'index.php?student/pay_tedc_fees');
			}
			}
                } 
echo "issue is here!";
	

}
		}
		else
		{
			$rrr= $confirmcode;
			
			
			$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '3','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=>$semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?student/remita_tedc_fee_receipt');
}
else
{
	
			$mert =  '532776942';

			$api_key =  '587460';

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

				$stud = $this->db->get_where('invoice_gen', array("rrr" => $rem))->row();
                $student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
				

				$data['rrr'] = $rem;
				$data['payment_id'] = $response['orderId'];
				$data['channel'] = 'BRANCH';
				$data['amount'] = $response['amount'];
				$data['payer_name'] = $stud->surname.' '.$stud->firstname;
				$data['payer_email'] =$stud->email;

				$data['payer_phone'] = $student->phone;

				$data['unique_id'] = $stud->$response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = $response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
$session = $verify_invoice->session_id;
$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_tedc_fee_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);

$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '3','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();

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
			   'payment_fee_type' => '3',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_tedc_fee_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?student/pay_tedc_fees');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_tedc_fees');	

				
	
}
			
		}

   }
   
 function remita_tedc_fee_receipt()
 {
	 if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remita_tedc_fee_receipt';
    $page_data['page_title'] = 'YABATECH TEDC Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
 }
   
   	function etransact_tedc_fee_receipt()
	{

		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'etransact_tedc_fee_receipt';
    $page_data['page_title'] = 'YABATECH TEDC Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}
	
	
	

		function generate_acp_fee_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_acp_fee_invoice';
        $page_data['page_title'] = get_phrase('Get Acceptance Fee Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	



	function generate_sch_fee_invoice(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'generate_sch_fee_invoice';
        $page_data['page_title'] = get_phrase('Get School Fee Invoice');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
	
	function processRemitaAcceptanceInvoice(){

		session_start();

		

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_acp_fee_invoice');
		}
		
if($alreadyGenerated){

				$_SESSION['portalID'] = $portalID;

				redirect(base_url() . 'index.php?student/remitaInvoice');

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

$totalAmount =0;
if($admissiondetails==1)
{
$totalAmount ='20000';
}
else
{
$totalAmount ='25000';
}
if($session=="2014/2015" || $session=="2018/2019")		//$amount = $this->db->get_where('eduportal_remita_details', array("type" => 'new_acceptance_fee_amount'))->row(); 
{
    $totalAmount ='20500';
}

$totalAmount='20500';
		

		

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

		$responseurl = "http://162.144.134.70/nekede/newremitaResponse.php";

		

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

if($admissiondetails==1)
{
		$beneficiaryAmount = 0;

		$beneficiaryAmount2 =20000 - $beneficiaryAmount;
		
		
}
else
{
        	$beneficiaryAmount =0;

		$beneficiaryAmount2 =25000-$beneficiaryAmount;
		
	
}

if($session=="2014/2015" || $session=="2018/2019")		//$amount = $this->db->get_where('eduportal_remita_details', array("type" => 'new_acceptance_fee_amount'))->row(); 
{
    $beneficiaryAmount =0;

		$beneficiaryAmount2 =20500-$beneficiaryAmount;
}
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
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

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

		if($statuscode=='025'){

			

			//check if student generated rrr already

			$alreadyGenerated = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $portalID,"session"=>$session))->row();

			

			if($alreadyGenerated){

				$_SESSION['portalID'] = $portalID;
               $_SESSION['session'] = $session;
				redirect(base_url() . 'index.php?student/remitaInvoice');

			}

			

			$data['putme_id'] = $portalID;

			$data['rrr'] = trim($response['RRR']);

			$data['order_id'] = trim($response['orderID']);

			$data['status'] = 'Payment Pending'; 

			$data['datetime'] = date("Y-m-d H:i:s"); 

			$data['amount'] = $totalAmount;
			$data['session'] = $session;

			

			$this->db->insert('eduportal_remita_accp_temp_data', $data);

			

			$_SESSION['portalID'] = $portalID;

			redirect(base_url() . 'index.php?student/remitaInvoice');

		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?student/generate_acp_fee_invoice');

		}

	}
    
	function processRemitaSchoolFeeInvoice()
	{
		session_start();

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$semester = $this->input->post('semester');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$department =$this->input->post('department');
		$school=$this->input->post('school');
		$progtype = $this->input->post('progtype');
		$prog = $this->input->post('prog');
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_sch_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
	if($progtype == "ND MORNING"){

					$pType = "MORNING";

				}elseif($progtype == "ND EVENING"){

					$pType = "EVENING";

				}elseif($progtype == "ND WEEKEND"){

					$pType = "WEEKEND";

				}
				elseif($progtype == "HND MORNING"){

					$pType = "MORNING";

				}
				elseif($progtype == "HND EVENING"){

					$pType = "EVENING";

				}elseif($progtype == "HND WEEKEND"){

					$pType = "WEEKEND";

				}

	
$feelevel = $this->db->get_where('course_year_of_study', array("year_of_study_name" => $year))->row()->fee_level;	
$amount = $this->db->get_where('fedponek_fee_schedule', array("fee_type" =>2,"level"=> $feelevel,"session" => $session,"dept_id" => $studentDetails->dept, "student_type_id" => $studentDetails->prog_type))->row();
		//define("MERCHANTID", $merchantId->value);
		
	
			
define("MERCHANTID", "576943955");
define("SERVICETYPEID", "2255372164");
define("APIKEY", "428537");
define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");
define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");
define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");
define("PATH", 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		$totalAmount = $amount->amount + 500;
		if($session=="2019/2020")
		{
			$totalAmount = 35500;
		}

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->name . ' ' . $studentDetails->othername; 

		$payerEmail = $studentDetails->email == "" ? 'student@YABATECH.com' : $studentDetails->email;  

		$payerPhone = $studentDetails->phone; 

		$responseurl = "http://45.34.15.68/portal/newremitaResponse.php";

		

		//echo $totalAmount; 

		//exit;

		

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="itemid1";

		$itemid2="34444".$itemtimestamp;

		$itemid3="8694".$itemtimestamp;
		
		$itemid4="3884".$itemtimestamp;
		
		

$beneficiaryName="Yaba College of Technology";
$beneficiaryName2="GTCO Calscan Nigeria Limited";
//$beneficiaryName3="Ogunseye Olarewanju";
$beneficiaryAccount="0230468761012";
$beneficiaryAccount2="1014132327";
//$beneficiaryAccount3="4017904612";
$bankCode="000";
$bankCode2="057";
//$bankCode3="070";
$beneficiaryAmount =$totalAmount-0;
$beneficiaryAmount2 =0;
//$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
//$deductFeeFrom3=0;
		
	
		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 


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

		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		

		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		

		curl_close($curl);

		$jsonData = substr($json_response, 6, -1);

		$response = json_decode($jsonData, true);

		$statuscode = $response['statuscode'];

		$statusMsg = $response['status'];

		if($statuscode=='025'){

				$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;

		$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->rrr;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);

//UPDATE FOR WRONG AMOUNT
$detail = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$idept = $detail->dept;
$iprogramme = $detail->programme;
$ilevel = $detail->level;
$iprog_type = $detail->prog_type;

if($ilevel>2){
	$ilevel = $ilevel -2;	
	}
$feedetail = $this->db->get_where('fedponek_fee_schedule', array("fee_type" =>2,"level"=> $ilevel,"session" => $session,"dept_id" => $idept, "student_type_id" => $iprog_type))->row();

$fp['amount'] = $feedetail->amount + 500;
$fp['fee_description'] = $feedetail->fee_desc;
$fp['dept_id'] = $feedetail->dept_id;

//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
		
		redirect(base_url()."index.php?student/remita_schfee_invoice");
}

			
$timesammp=date("dmyHis");		
$orderID = $timesammp;
$invoice_code="NIL";
$rrr = trim($response['RRR']);
$servicecode=SERVICETYPEID;
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>'0',
			   'invoice_no'=>$invoice_code,
			   'amount' => $totalAmount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>$progtype.' - SCHOOL FEE',
			   '[level]'=>$year,
			   'semester'=>$semester,
			   'service_type_code'=>$servicecode
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $rrr;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH School Fee Payment Invoice';
		
		redirect(base_url()."index.php?student/remita_schfee_invoice");
			


		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?student/generate_sch_fee_invoice');

		}
}
	
	
	public function remita_schfee_invoice()
{
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH School Fee Invoice';
$page_data['page_name']  = 'invoice_page_remita_schfee';
$this->load->view('backend/student_print',$page_data);
}
	
	function remitaInvoice(){

		$page_data['page_name']  = 'remitaInvoice';

        $page_data['page_title'] = get_phrase('Federal Polytechnic Nekede Acceptance Fee Invoice');

        $this->load->view('backend/student_print', $page_data);

	}
	

	function processEtranzactAcceptanceInvoice(){

		session_start();

		

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_acp_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
		$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;
$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->invoice_no;
	$page_data['page_name']  = 'invoice_page';
    $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);
		
		redirect(base_url()."index.php?student/etranzact_invoice");
}
else
{
$this->load->model('site_model');
$identification_no= $this->site_model->get_identification_no(array('application_type_id'=>$application_form_category));


$application_invoice_id = $this->site_model->get_invoice_id();
$applicationcategory_code = $this->db->get_where('application_type', array("application_typeid" => $application_form_category))->row();
$lpad_invoice_id =$this->site_model->get_lpad_invoice_id(array('application_invoice_id'=>$application_invoice_id));
$invoice_code="YABATECH/".$applicationcategory_code->application_code."/17".$lpad_invoice_id;
$amount=$applicationcategory_code->amount;

       $admissiondetails= $this->db->get_where('eduportal_admission_list', array("application_no" => $portalID))->row()->adm_type;
if($admissiondetails==1)
{
$amount =20000;
}
else
{
$amount =25000;
}
		
//echo $invoice_code.$amount;
$timesammp=date("dmyHis");		
$orderID = $timesammp;
$rrr="NIL";
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>$identification_no,
			   'invoice_no'=>$invoice_code,
			   'amount' => $amount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description	'=>'HND ACCEPTANCE FEE',
			   'level'=>'HND I',
			   'semester'=>'FIRST'
			   
            );			
//$this->load->model('site_model');

$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $invoice_code;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
		
		redirect(base_url()."index.php?student/etranzact_invoice");

}
	}


public function etranzact_invoice()
{
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH HND Acceptance Fee Invoice';
$page_data['page_name']  = 'invoice_page_etransact';
$this->load->view('backend/student_print',$page_data);
}

	function processEtransactSchoolFeeInvoice()
	{
		session_start();

		$portalID = $this->input->post('portalID');
		$session = $this->input->post('session');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		$department =$this->input->post('department');
		$school=$this->input->post('school');
		$progtype = $this->input->post('progtype');
		$prog = $this->input->post('prog');
		$semester = $this->input->post('semester');
		
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/generate_sch_fee_invoice');
		}
		

		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
	if($progtype == "ND MORNING"){

					$pType = "MORNING";

				}elseif($progtype == "ND EVENING"){

					$pType = "EVENING";

				}elseif($progtype == "ND WEEKEND"){

					$pType = "WEEKEND";

				}
				elseif($progtype == "HND MORNING"){

					$pType = "MORNING";

				}
				elseif($progtype == "HND EVENING"){

					$pType = "EVENING";

				}elseif($progtype == "HND WEEKEND"){

					$pType = "WEEKEND";

				}

$feelevel = $this->db->get_where('course_year_of_study', array("year_of_study_name" => $year))->row()->fee_level;	
$amount = $this->db->get_where('fedponek_fee_schedule', array("fee_type" =>2,"level"=> $feelevel,"session" => $session,"dept_id" => $studentDetails->dept, "student_type_id" => $studentDetails->prog_type))->row();
		//define("MERCHANTID", $merchantId->value);
				
$surname = $studentDetails->name;

$firstname = $studentDetails->othername;

$middlename = " ";

$email = $studentDetails->email;

$mobile_no = $studentDetails->phone;
$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	$_SESSION['application_form_category'] =$application_exist->application_type_id;
	$_SESSION['invoice_no']=   $application_exist->invoice_no;
	//$page_data['page_name']  = 'invoice_page';
   // $page_data['page_title'] = 'YABATECH HND Registration Payment Invoice';
//$this->db->where('invoice_no', $application_exist->invoice_no);	  
//$this->db->update('applicationinvoice_gen', $invoice_data);
	
	//UPDATE FOR WRONG AMOUNT
$detail = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$idept = $detail->dept;
$iprogramme = $detail->programme;
$ilevel = $detail->level;
$iprog_type = $detail->prog_type;

if($ilevel>2){
	$ilevel = $ilevel -2;	
	}
$feedetail = $this->db->get_where('fedponek_fee_schedule', array("fee_type" =>2,"level"=> $ilevel,"session" => $session,"dept_id" => $idept, "student_type_id" => $iprog_type))->row();

$fp['amount'] = $feedetail->amount + 500;
$fp['fee_description'] = $feedetail->fee_desc;
$fp['dept_id'] = $feedetail->dept_id;

$this->db->where('invoice_no', $_SESSION["invoice_no"]);
$this->db->update("invoice_gen",$fp);
	
		redirect(base_url()."index.php?student/etranzact_schfee_invoice");
}
else
{
$this->load->model('site_model');
$identification_no= $this->site_model->get_identification_no(array('application_type_id'=>$application_form_category));


$application_invoice_id = $this->site_model->get_invoice_id();
$applicationcategory_code = $this->db->get_where('application_type', array("application_typeid" => $application_form_category))->row();
$lpad_invoice_id =$this->site_model->get_lpad_invoice_id(array('application_invoice_id'=>$application_invoice_id));
$invoice_code="YABATECH/".$applicationcategory_code->application_code."/17".$lpad_invoice_id;
$paymentamount=$amount->amount+500;
//echo $invoice_code.$amount;
$timesammp=date("dmyHis");		
$orderID = $timesammp;
$rrr="NIL";
$invoice_data = array(
               'portal_id'=>$portalID,
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   'order_id'=>$orderID,
			   'application_type_id' =>$application_form_category,
			   'session_id' =>$session,
			   'identification_no'=>$identification_no,
			   'invoice_no'=>$invoice_code,
			   'amount' => $paymentamount,
			   'date_generated' => date('Y-m-d H:i:s'),
			   'rrr' => $rrr,
			   'email' => $email,
			   'dept_id' => $studentDetails->dept,
			   'fee_description'=>$amount->fee_desc.' - SCHOOL FEE',
			   'level'=>$year,
			   'semester'=>$semester
			   
			   
            );			
//$this->load->model('site_model');

$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
  $_SESSION['invoice_no']=   $invoice_code;
		$page_data['page_name']  = 'invoice_page';
        $page_data['page_title'] = 'YABATECH HND School Fee Payment Invoice';
		
		redirect(base_url()."index.php?student/etranzact_schfee_invoice");

}
				
				
	}
	
	public function etranzact_schfee_invoice()
{
	if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_title'] = 'YABATECH School Fee Invoice';
$page_data['page_name']  = 'invoice_page_etransact_schfee';
$this->load->view('backend/student_print',$page_data);
}
	
	function pay_acp_fees(){
		session_start();
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
	$page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
		if($_SESSION["paytype"])
		{
			redirect(base_url() . 'index.php?student/pay_acp_fees_morning_etransact');
		}
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id')))->row();
//		if($verify_payment_log)
//		{
//			$stu_prog=$my_data->prog_type;
//		$_SESSION['payeeID']= $verify_payment_log->payment_code;
//		if($stu_prog==4){
//				redirect(base_url() . 'index.php?student/remita_acp_receipt');
//		}
//		else
//		{
//				redirect(base_url() . 'index.php?student/etransact_acp_receipt');
//		}
//		}
		 
		
		$page_data['page_name']  = 'pay_acp_fees';
        $page_data['page_title'] = get_phrase('Pay Acceptance Fee');
     

        $this->load->view('backend/index', $page_data);
	}
	
	function pay_acp_fees_morning_etransact(){
		session_start();
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
	$page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
		
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id')))->row();
//		if($verify_payment_log)
//		{
//			$stu_prog=$my_data->prog_type;
//		$_SESSION['payeeID']= $verify_payment_log->payment_code;
//		if($stu_prog==4){
//				redirect(base_url() . 'index.php?student/remita_acp_receipt');
//		}
//		else
//		{
//				redirect(base_url() . 'index.php?student/etransact_acp_receipt');
//		}
//		}
		 
		
		$page_data['page_name']  = 'pay_acp_fees_etransactpayments';
        $page_data['page_title'] = get_phrase('Pay Acceptance Fee - Etransact Payments for HND Morning');
     

        $this->load->view('backend/index', $page_data);
	}
	
	function processRemitaAcceptancePayment(){

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

			redirect(base_url() . 'index.php?student/pay_acp_fees');
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
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?student/etransact_acp_receipt');
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
		$verify_invoice = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		$session = $verify_invoice->session;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();
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
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?student/remita_acp_receipt');
}
else
{
	
			$mert =  '532776942';

			$api_key =  '587460';

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

				$data['trans_date'] = $response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();
$session = $verify_invoice->session;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_accp_temp_data', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_acp_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);

$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '1','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session))->row();

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
			   'payment_fee_type' => '1',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> 'FIRST'
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_acp_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_acp_fees');	

}			
	
}

	}
	
	function remita_acp_receipt()
	{
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remita_acp_receipt';
    $page_data['page_title'] = 'YABATECH HND Acceptance Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}
	
   function processEtranzactAcceptancePayment()
   {
	 		session_start();
	

		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		$year = $this->input->post('year');
		$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_acp_fees');
		}
		
		$exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
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
			   'payment_level'=> 'HND I',
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
		redirect(base_url() . 'index.php?student/etransact_acp_receipt');
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
			   'payment_level'=> 'HND I',
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
			   'payment_level'=> 'HND I',
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
			   'payment_level'=> 'HND I',
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
   
   	function etransact_acp_receipt()
	{

		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'etransact_acp_receipt';
    $page_data['page_title'] = 'YABATECH HND Acceptance Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}
	
function processRemitaFeePayment(){

		session_start();

		

		$portalID = $this->input->post('portalID');
		
		$pmode = $this->input->post('pmode');
		//$year = $this->input->post('year');
		//$paymentType = $this->input->post('paymentType');
		//$session = $this->input->post('session');
		//$semester = $this->input->post('semester');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		if($pmode==1)
		{
		    $confirmcode = $this->input->post('confirmcode');
			$exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
		   // echo $exp_paid->payee_id.' '.$portalID;
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
           'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?student/etransact_schfee_receipt');
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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);

		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_schfee_receipt');   
				             

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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_schfee_receipt');   
			}
			else{

                    session_start();
                    $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                    redirect(base_url() . 'index.php?student/pay_fees');
			}
                } 
echo "issue is here!";
	
}

		}
		else
		{
		    $rrr = $this->input->post('confirmcode');
		$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=>$semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		$_SESSION['payeeID']= $rrr;
		redirect(base_url() . 'index.php?student/remita_schfee_receipt');
}
else
{
	
			$mert =  '532776942';

			$api_key =  '587460';

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

				$stud = $this->db->get_where('invoice_gen', array("rrr" => $rem))->row();
                $student = $this->db->get_where('student', array("portal_id" => $portalID))->row();
				

				$data['rrr'] = $rem;
				$data['payment_id'] = $response['orderId'];
				$data['channel'] = 'BRANCH';
				$data['amount'] = $response['amount'];
				$data['payer_name'] = $stud->surname.' '.$stud->firstname;
				$data['payer_email'] =$stud->email;

				$data['payer_phone'] = $student->phone;

				$data['unique_id'] = $stud->$response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = $response['transactiontime'];

				$data2['status'] = $msg;

				
				        $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
$session = $verify_invoice->session_id;
$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry RRR Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
						
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					//$this->session->set_userdata('logged_in',"1");	
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_schfee_receipt');
								//echo $rem . ' already in accp table <br />';

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);

$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();

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
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	

		}
					$_SESSION['payeeID']= $rrr;
					redirect(base_url() . 'index.php?student/remita_schfee_receipt');
				
}
				
			
	}
	else{
			$_SESSION['err_msg'] = 'Invalid Remita RRR';
				

			redirect(base_url() . 'index.php?student/pay_fees');
		}
	$_SESSION['err_msg'] = 'Error: Network problem. Please try again at a later time.';
	$this->session->set_userdata('error', 'Error: Network problem. Please again at a later time.');
redirect(base_url() . 'index.php?student/pay_fees');	

				
	
}
		}
	}
	
	function remita_schfee_receipt()
	{
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remita_schfee_receipt';
    $page_data['page_title'] = 'YABATECH School Fees Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}
	
		function remita_failed()
	{
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'remitaFailedPayment';
    $page_data['page_title'] = 'YABATECH Payment Status';
$this->load->view('backend/student_print',$page_data);
	
	}
	   function processEtranzactFeePayment()
   {
	 		session_start();
	
		$portalID = $this->input->post('portalID');
		$confirmcode = $this->input->post('confirmcode');
		//$year = $this->input->post('year');
		//$paymentType = $this->input->post('paymentType');
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		
		$exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{
			$payment_data = array(
           'regno'=>$portalID,
               'payment_code' => $confirmcode,
               'payment_session' => $session,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		$_SESSION['payeeID']= $confirmcode;
		redirect(base_url() . 'index.php?student/etransact_schfee_receipt');
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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_schfee_receipt');   
				             

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
//echo  $portalID;
 $verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $this->etranzact->get_customer(),"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			$_SESSION['err_msg'] = 'Sorry Confirmation Code Supplied does not Belong to you! Contact Administrator for further information';

			redirect(base_url() . 'index.php?student/pay_fees');
		}
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
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
        
                    $data['session'] = $session; 
					$data['fullname'] = $student->name.' '.$student->othername;
					$data['phone'] = $student->phone;
					$data['email'] = $student->email;
					$data['programme'] = $programme_type->programme_type_name;
					$data['faculty'] = $school->schoolname;
					$data['department'] = $dept->deptName;
					$data['level'] = $yr->year_of_study_name;                
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                  //  $this->db->where('payee_id', $this->etranzact->get_customer());
				  

		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => '2','student_id' => $this->session->userdata('student_id'),'payment_session'=>$session,'payment_level'=>$year))->row();
		if(!$verify_payment_log)
		{

			$payment_data = array(
                          'regno'=>$portalID,
                          'payment_code' => $confirmcode,
                           'payment_session' => $verify_invoice->session_id,
			   'payment_level'=> $year,
			   'payment_amount'=>$verify_invoice->amount,
			   'payment_status' =>'E',
			   'payment_date' => date('Y-m-d H:i:s'),
			   'payment_fee_type' => '2',
			   'student_id' => $this->session->userdata('student_id'),
			   'semester'=> $semester
			   
            );			
//echo "issue is here!";	
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
		
        
		$this->db->insert('nekede_etranzact_payment', $data);
                $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		
					$_SESSION['payeeID']= $confirmcode;
		
                   redirect(base_url() . 'index.php?student/etransact_schfee_receipt');   
			}
			else{

                    session_start();
                    $_SESSION['err_msg'] = 'The Confirmation Code you entered is incorrect';
                    redirect(base_url() . 'index.php?student/pay_fees');
			}
                } 
echo "issue is here!";
	
}

   }
   
	function etransact_schfee_receipt()
	{
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
$page_data['page_name']  = 'etransact_schfee_receipt';
    $page_data['page_title'] = 'YABATECH Fee Payment Receipt';
$this->load->view('backend/student_print',$page_data);
	
	}
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }


    private function generateAptID(){

        $num = mt_rand(100000, 999999);

        $paymentMethod = $this->session->userdata('paymentMethod') == 'Bank' ? 1 : 2;

        return 'NEK' . $paymentMethod . substr(Date('Y'), 2) . $num;

    }

    function receiptprintout($param1 = ''){
        session_start();
        if ($this->session->userdata('student_login') != 1 || $param1 == '')
            redirect(base_url(), 'refresh'); 

        $page_data['payeeData']  = $param1;
		$_SESSION['payeeID']= $param1;
		$payDetails2 = $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $_SESSION['payeeID']))->row();
		$type=$payDetails2->payment_status;
		if($type=='F')
		{
			if($payDetails2->payment_fee_type==1){
				  $page_data['page_name']  = 'remita_acp_receipt';
				} else {
					
					 $page_data['page_name']  = 'remita_schfee_receipt';
       
				}
		
		}
		else
		{
		 $page_data['page_name']  = 'etransact_schfee_receipt';
		}
        $page_data['page_title'] = get_phrase('Fee Payment Receipt');

        $this->load->view('backend/student_print', $page_data);

    }

    function pay_fees_card(){

        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        //start session and get the variables needed for etranzact

        session_start();
        $student = $this->db->get_where('student', array("portal_id" => $this->session->userdata('portal_id')))->row();
        $amt = '1000';//$this->db->get_where('prehnd_settings', array("settings" => 'amount'))->row();
        $paytype = 'fees';//$this->db->get_where('prehnd_settings', array("settings" => 'paymenttype'))->row();       
        /*$_SESSION['transid'] = $student->payee_id;
        $_SESSION['firstname'] = $student->firstname;
        $_SESSION['middlename'] = $student->middlename;
        $_SESSION['address'] = $student->address;
        $_SESSION['phone'] = $student->phone;
        $_SESSION['email'] = $student->email;
        $_SESSION['nation'] = $student->nationality;
        $_SESSION['amt'] = $amt->value;
        $_SESSION['paytype'] = $paytype->value;
        $page_data['page_name'] = 'paymentClient';
        $this->load->view('backend/index', $page_data);*/

        $firstname = $student->oname;;
        $middlename = $student->name;;
        $address = $student->address;
        $phone = $student->phone;
        $email = $student->email;
        $nation = $student->country;

        $terminalId = "0000000001";
        $transId = $this->generateAptID();;
        $responseurl = base_url().'card_response.php';
        $success = $HTTP_POST_VARS["SUCCESS"];
        $descr = $paytype;
        $amount = $amt;


        if ($descr == NULL) $descr = "";
        $secret_key="DEMO_KEY";

        $str=$amount.$terminalId.$transId.$responseurl.$secret_key;
        $checksum=md5($str);

        //echo "Requesting Transaction ID . . .  ";
        if ($success == null){ //or success = "" for php
            echo "<form method='POST' action='http://demo.etranzact.com/WebConnectPlus/caller.jsp'>";
            echo "<input type='hidden' name='TERMINAL_ID' value='".$terminalId."'>";
            echo "<input type='hidden' name = 'TRANSACTION_ID' value='".$transId."'>";
            echo "<input type='hidden' name = 'AMOUNT' value='".$amount."'>";
            echo "<input type='hidden' name = 'DESCRIPTION' value='".$descr."'>";
            echo "<input type='hidden' name = 'EMAIL' value='".$email."'>";
            echo "<input type='hidden' name = 'CURRENCY_CODE' value='NGN'>";
            echo "<input type='hidden' name = 'RESPONSE_URL' value='".$responseurl."'>";
            echo "<input type='hidden' name = 'CHECKSUM' value='".$checksum."'>"; 
            echo "<input type=hidden name = 'ECHODATA' value='<customerinfo><firstname>$firstname</firstname><lastname>$middlename</lastname><phoneno>$phone</phoneno><email>$email</email><address>$address</address><city></city><state></state><zipcode></zipcode><postcode></postcode><country>$nation</country><otherdetails></otherdetails></customerinfo>'>";
            echo "<input type='hidden' name = 'LOGO_URL' value='http://94.249.189.40/nekede/assets/images/eduportal.png'>";
            echo "<h4 style='margin-left:20px;'>Redirecting... Please wait!</h4>";
            echo "</form>";
            echo "<script language='javascript'>";
            echo "var form = document.forms[0];";
            echo "form.submit()</script>";
        }else if ($success == "0"){
            //deal with successful transaction
            echo "Transaction Successful";
            session_register("transId");
        }else   //Deal with Timeout Here, Transaction ID no more valid
            echo "Error while requesting for transaction authorisation, Transaction ID no more valid ";
    }

    public function card_response(){

        $queryStr = rawurldecode($_SERVER['QUERY_STRING']);
        print_r($queryStr);
        return 0;
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
    }

    /*New fee payment with payee_id*/
    function pay_fees($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

   

 $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        
      

        //var_dump($page_data['payee_id']);
        $page_data['page_name']  = 'pay_sch_fees';
        $page_data['page_title'] = get_phrase('Fee Payment');
        $this->load->view('backend/index', $page_data);
    }



    //@future*/

     function bankfeerequest($param1 = ''){

        if(empty($param1) || $param1 == ''){

            redirect(base_url());

        }else{

            $student = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $param1))->row();

            if(count($student) > 0){

                $page_data['student'] = $this->db->get_where('student', array("student_id" => $student->student_id))->row();

                $page_data['faculty'] = ' ';

                $page_data['department'] = ' ';

                $page_data['session'] = $student->session;

                $page_data['level'] = ' ';

                $page_data['programmetype'] = ' ';

                $page_data['studytype'] = ' ';

                $page_data['amount'] = $student->amount;

                $page_data['feestatus'] = $student->status;
                
                $page_data['payee_id'] = $student->payee_id;

                $page_data['session'] = $student->session;

                $page_data['paymenttype'] = $student->payment_method;

                

                $this->load->view('backend/feexml', $page_data);

            }else{

                echo 'No record found for payee id: ' . $param1;

            }

        }

    }

     public function performPay(){
        $payee_id = $this->input->post('pid');        


        if($payee_id == '' || $payee_id == ' ' || strlen($payee_id) != 12){

            session_start();
            $_SESSION['payeeError'] = 'Incorrect payee id supplied.';
            redirect(base_url() . 'index.php?student/pay_fees');
        }       

            //$terminalID = $this->db->get_where('prehnd_settings', array('settings' => 'terminal_id'))->row();         
            $terminalID = '000000001';
            $cfc = $this->input->post('CONFIRMATION_NO');          
            
            //start etranzact

            $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
            $this->etranzact->set_terminal($terminalID->value);//message from textfield
            $this->etranzact->set_conf($this->input->post('CONFIRMATION_NO'));//message from textfield
            $this->etranzact->send();

            echo '<pre>';
            var_dump($this->etranzact->get_confirm());
            echo strlen($this->etranzact->get_confirm());
            echo '</pre>';
            //break;
            if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){             

                if($payee_id == $this->etranzact->get_customer() && $cfc == $this->etranzact->get_confirm()){
                
                    $data['receipt_no'] = $this->etranzact->get_receipt();
                    $data['bankcode'] = $this->etranzact->get_bankcode();
                    $data['bankname'] = $this->etranzact->get_bankname();
                    $data['branchcode'] = $this->etranzact->get_branchcode();
                    $data['confirm_code'] = $this->etranzact->get_confirm();
                    $data['amount'] = $this->etranzact->get_amount();
                    $data['description'] = $this->etranzact->get_descr();
                    $data['payment_confirmation_date'] = Date('jS F Y');
                    $data['payee_id'] = $this->etranzact->get_customer();
                    $data['payment_method'] = 'Bank';
                    $data['status'] = 'PAID';
                    $data['prog_type'] = $prog_type->prog_type;                  
                    $data['student_id'] = $this->session->userdata('student_id');                  
                    

                    //$this->db->insert('prehnd_etranzact_data', $data);
                    $this->db->where('payee_id', $this->etranzact->get_customer());
                    $this->db->update('nekede_etranzact_payment', $data);
                    

                    //get the sms sender
                    //$sender = $this->db->get_where('prehnd_settings', array('settings' => 'sms_sender'))->row();
                    $sender = 'Eduportal';
                    $reciever = $this->session->userdata('fullname');                   

                    // Start Ozioma
                    $this->load->library('ozioma');                 

                    //set message
                    $this->ozioma->set_message("Hello " . $reciever . ", you have successfully confirmed your HND registration payment. Your portal ID is " . $putmeID->putme_id . " Best of luck");

                    //recipient phone number
                    $this->ozioma->set_recipient('2348141130373');

                    //sender
                    //$this->ozioma->set_sender($sender->value);
                    $this->ozioma->set_sender($sender);
                    
                    //send
                    $this->ozioma->send();
                    session_start();
                    $_SESSION['payeeError'] = 'The payment was successful.';
                    redirect(base_url() . 'index.php?student/pay_fees');              

                }else{

                    session_start();
                    $_SESSION['payeeError'] = 'The Confirmation Code you entered is incorrect/not associated with your payee ID.';
                    redirect(base_url() . 'index.php?student/pay_fees');
                }   
                
            }elseif($this->etranzact->get_status() == "00"){

                session_start();
                $_SESSION['payeeError'] = 'Etranzact server down time. Please try again in a moment.';
                redirect(base_url() . 'index.php?student/pay_fees');
            }else{

                session_start();
                $_SESSION['payeeError'] = 'Your payment cannot be confirmed at the moment. Please try again in a moment.';
                redirect(base_url() . 'index.php?student/pay_fees');
            }

     }

     public function payeeprintout($param1=''){

        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->session->userdata('pid') == '' && empty($param1))
            redirect(base_url() . 'index.php?student/pay_fees', 'refresh');

        //var_dump($this->session->userdata('pid'));

        
      
        //session_start();
        $payee_id = $this->session->userdata('pid') != null? $this->session->userdata('pid') : $param1;
        $page_data['printout'] = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $payee_id))->row();   

        //$_SESSION['payeeID'] = $payeeID->payee_id;
        $page_data['page_name']  = 'bankprintout';
        $page_data['page_title'] = get_phrase('Printout For Bank Payment');
        $this->load->view('backend/print', $page_data);

    }


    /****Update Profile*****/
    function update_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['page_name']  = 'Update Department Info';
        $page_data['page_title'] = get_phrase('update_profile');
        $this->load->view('backend/index', $page_data);
    }
    
    function manage_courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['year'] = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;//academic year
        
        $page_data['page_name']  = 'manage_courses';
        $page_data['page_title'] = get_phrase('Course Management');
        $this->load->view('backend/index', $page_data);
    }

    /*This is the course management function*/
    function course_management($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('student_login') != 1){
            redirect(base_url(), 'refresh');
            $_SESSION['err_msg'] = "Please pay your fees so you can register your courses...";
        }
        $status = $this->db->get_where('etranzact_payment', array('customer_id' => $this->session->userdata('reg_no')))->row();
        $level = $this->db->get_where('student', array('reg_no' => $this->session->userdata('reg_no')))->row()->level;
        $_SESSION['err_msg'] = '';
        $this->session->unset_userdata('err');

        if(!$status)
            redirect(base_url()."index.php?student/invoice", 'refresh');
        //var_dump($level);
        //if($level != 'DEGREE 1'){ 
        if ( !in_array($level, array('DEGREE 1','NCE 1'), true ) ) 
            echo "<script>window.close();</script>";

        $id = $this->session->userdata('student_id');
        $reg = $this->session->userdata('reg_no');
        $page_data['academic_year'] = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;//academic year
        $session = $page_data['academic_year'];
        $page_data['courses'] = $this->db->get_where('course_records' , array('reg_no' =>$reg,'std_id'=>$id,'selected_semester'=>$param1,'session'=>$session))->result_array();//retrieve courses
        //$page_data['active_semester'] = $this->db->get_where('settings' , array('type'=>'active_semester'))->row()->description;// curent semester
        $page_data['active_semester'] = $param1;// current semester
        $sem = $page_data['active_semester'];
        $page_data['current_level'] = $this->db->get_where('student' , array('student_id'=> $id))->row()->level;// current student level
        $level = explode(" ", $page_data['current_level']);
        $prog = $level['0'];
        $level = $level['1'];
        //$page_data['current_load'] = $this->db->get_where('course_records' , array('reg_no' =>$reg,'std_id'=>$id,'session'=>$session))->result_array();
        $page_data['max_credit'] = $this->db->get_where('credit_load' , array('programme'=> $prog,'semester'=>$sem,'level'=>$level))->row()->sem_max_load;
        $page_data['min_credit'] = $this->db->get_where('credit_load' , array('programme'=> $prog,'semester'=>$sem,'level'=>$level))->row()->sem_min_load;
        $courses = $page_data['courses'];
        foreach ($courses as $row) {
            $current_load += $row['credit_load'];
        }
        $max = $page_data['max_credit'];
        
        $this->db->select('programmes.programme');
        $this->db->distinct();
        $this->db->from('programmes');
        $prog = $this->db->get()->result_array();

        if ($param2 == 'add') {
            $c_id = $param3; //course id from link
            $courses = $this->db->get_where('courses' , array('id' =>$c_id))->row();
            if($current_load <= $max){
                $added = $this->db->get_where('course_records' , array('course_id'=>$c_id,'reg_no' =>$reg,'std_id'=>$id,'session'=>$session))->result_array();
                if(!$added){
                    if($courses){
                    $data['course_name'] = $courses->course_name;
                    $data['course_code'] = $courses->course_code;
                    $data['credit_load'] = $courses->credit_load;
                    $data['course_semester'] = $courses->course_semester;
                    $data['selected_semester'] = $sem;
                    $data['course_year'] = $courses->course_year;
                    $data['course_id'] = $courses->id;
                    $data['department'] = $courses->department;
                    $data['school'] = $courses->school;
                    $data['std_id'] = $id;
                    $data['reg_no'] = $reg;
                    $data['session'] = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;

                    $this->db->insert('course_records', $data);
                    }else{ $_SESSION['err_msg'] = "The selected course is unavailable...";$this->session->set_userdata('err','The selected course is unavailable'); }
                }else{ $_SESSION['err_msg'] = "You have already added this course...";}
            }else{ $_SESSION['err_msg'] = "You have reached the maximum number of courses you can add...";}
            //var_dump($param2);
            redirect(base_url() . 'index.php?student/course_management/'.$sem, 'refresh');
             //redirect(base_url(), 'refresh');
        }
        if ($param2 == 'delete') {
            $this->db->where('id', $param3);
            $this->db->delete('course_records');
            redirect(base_url() . 'index.php?student/course_management/'.$sem, 'refresh');
        }
        
        $page_data['prog'] = $prog;// not in use
        
        $page_data['page_title'] = $this->app_system_name() . ' | Course Management';
        //$page_data['page_name'] = 'course_management';
        $this->load->view('backend/student_course_management', $page_data);
    }
    
    
    /***********************************************************************************************************/
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {
        $data['student_id'] = $this->session->userdata('student_id');
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            //$data['class_id']   = $this->input->post('level');
            $data['student_id'] = $this->session->userdata('student_id');
            $this->db->insert('subject', $data);

            redirect(base_url() . 'index.php?student/subject/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?student/subject/', 'refresh');
        }
        /*if($param1 == 'registerCourse'){
            $data['department'] = $row['department'];
            $data['department'] = $row['department'];
            //$this->db->insert
            var_dump($dept); 
        }*/ //will continue later
        /*$student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $student_class_id        = $student_profile->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $student_class_id
        ))->result_array();*/
        //$page_data['page_name']  = 'Courses';

        $studentData = $this->db->get_where('student', array('student_id' => $data['student_id']))->row();
        $dept  = $studentData->dept;
        $school = $studentData->school;

       // print_r($school);

        $page_data['subjects'] = $this->db->get_where('student_courses', array('department' => $dept, 'school' => $school, 'course_year' => 3, 'course_semester' => 'FIRST'))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('Register Courses');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile       = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $page_data['class_id'] = $student_profile->class_id;
         $page_data['student_id'] = $this->db->get_where('student', array( 'student_id' => $this->session->userdata('student_id') 
                            ))->row()->student_id;
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            //$page_data['class_id']    =   $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?student/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?student/marks/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        //$page_data['class_id']    =   $class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $page_data['class_id']   = $student_profile->class_id;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
    /*MANAGE HOSTEL ALLOCATION*/
    function hostel($param1 = '', $param2 = '', $param3 = '')
    {
        
        
        
      if ($this->session->userdata('student_login') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');
        $_SESSION['err_msg'] = "Please pay your fees so you can be given accomodation...";
       $accommodation_status         = $this->db->get_where('etranzact_payment', array(
            'customer_id' => $this->session->userdata('reg_no')
            ))->row();
       if(!$accommodation_status)
            redirect(base_url()."index.php?student/invoice", 'refresh');

        


        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
            ))->row();
            $sid = $student_profile->student_id;
        $reg_no = $student_profile->reg_no;
        //var_dump($reg_no);
        $sex  =$student_profile->sex;
        $name = $student_profile->name;
        $lname = $student_profile->othername;
        $fname = $name.", ".$lname;




        if($param1 == 'pay'){

            //get inputs from form
            $serial = $this->input->post('cserial');
            $pin = $this->input->post('cpin');


            //confirm that pin and serial are in database and they match
            $pay = $this->db->get_where('scratch_cards', array('serial' => $serial,'pins'=> $pin))->row();

            //check if the card exist
            if($pay){
                //check if student is already registered for accommodation;
                $cst1 = $this->db->get_where('counter', array('idno'=> $reg_no))->result_array();

                //if student is already registered; ie have already recieved accommodation;
                if($cst1){
                   
                    //check if student is registered to the given serial and pin;
                    $ct = $this->db->get_where('counter', array('serial' => $serial, 'pin'=> $pin, 'idno'=> $reg_no))->row();
                    //if student is registered to the given serial and pin;
                    if($ct){

                        //echo already registered, click to print.
                        $_SESSION['err_msg'] = "This Card had been used by You, You have been assigned Accomodation.";
                        $link = '<a target ="_blank" href='.base_url().'index.php?student/printer/hostel>Click here to print reciept for accomodation</a>';
                        $_SESSION['prn_msg'] = $link;

                    }else{

                        //echo card already used by someone else
                        $_SESSION['err_msg'] = "Sorry: This Card had been used...";

                    }
                }else{

                    //check if serial and pin is used;
                    $usedcard = $this->db->get_where('counter', array('serial' => $serial, 'pin'=> $pin))->row();

                    //if card is used;
                    if($usedcard){

                        $_SESSION['err_msg'] = "Sorry: This Card had been used by someone else...";

                    }else{
                        //set sessions for serial and pin
                        $this->session->set_userdata('serial', $serial);
                        $this->session->set_userdata('pin', $pin);

                        //proceed to allocation;
                        $data7['status'] = "Taken";

                        $this->db->where(array('serial'=> $serial,'pins' => $pin));
                        $this->db->update('scratch_cards', $data7);//update scratch card status to taken
                        
                        //start a security session
                        $this->session->set_userdata('hostelsec', 'accommodation security');
                        
                        $this->allocate();
                        redirect(base_url() . "index.php?student/allocate");
                    }  
                }
            }else{

                //invalid serial and pin match
                $_SESSION['err_msg'] = "Invalid Card";
            }


        }   $this->db->select('*');
            $this->db->from('counter a,student b');
            $this->db->where('a.idno = b.reg_no',NULL,FALSE);
            $this->db->where('a.idno',$reg_no);
            $query = $this->db->get();
            //return $query->result_array();

            $page_data['hostel']   = $query->result_array();

            //$page_data['hostel']   = $this->db->get_where('student', array('student_id' => $sid))->result_array();
            $page_data['page_name']  = 'accomodation';
            $page_data['page_title'] = get_phrase('Manage_Accomodation');
            $this->load->view('backend/index', $page_data);  
    }

    public function allocate(){
    
    if ($this->session->userdata('hostelsec') != 'accommodation security')//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');

        $studentData = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
        $sex = $studentData->sex;

        $page_data['page_name'] = strtolower($sex) . 'hostel';
        $page_data['page_title'] = get_phrase('_' . $sex . ' Hostel Allocation System');

        $this->load->view('backend/index', $page_data);
    }

    public function deleter(){
        $id = $this->session->userdata('reg_no');
        $this->db->delete('etranzact_payment', array('customer_id' => $id));
        redirect(base_url(), 'refresh');
    }

    public function updater($param1 ='', $param2 = ''){
        $id = $this->session->userdata('reg_no');

        $edit_data      =   $this->db->get_where('student' , array('reg_no' => $id) )->row();

        //$this->load->library('etranzact'); 
        $data['customer_id'] =  $id;
        $data['date_reg'] =  date("Y-m-d"); //date registered
        $data['fullname'] =  $edit_data->name.",".$edit_data->othername;
        $data['phone'] =    $edit_data->phone;
        $data['prog_type'] =      $edit_data->prog_type;
        $data['dept'] =      $edit_data->dept;
        $data['level'] =      $edit_data->level;
        $data['session'] =      $edit_data->session;
        $data['cust_add'] =     $edit_data->address;
        $data['used_by'] =      $id;
        $data['status'] =       "paid";

        $invoice_id = $param2;//$this->input->post('CONFIRMATION_NO');
        $this->db->where('confirm_code', $invoice_id);
        $this->db->update('etranzact_payment', $data);
        redirect(base_url() . 'index.php?admin/not_paid', 'refresh');

        $this->db->delete('etranzact_payment', array('customer_id' => $id));
        redirect(base_url(), 'refresh');
    }

    function takeRoom($param1, $param2, $param3, $param4, $param5){

        //redirect if student session data is not registered
        $data['student_id'] = $this->session->userdata('student_id');
        if ($this->session->userdata('hostelsec') != 'accommodation security')
            redirect(base_url(), 'refresh');

        //join hostel
        $hosteljoin = $param1 . " " . $param2;

        //get student reg number;
        $studentData = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
        $reg = $studentData->reg_no;

        //retrieve the serial and pin set sessions;
        $serial = $this->session->userdata('serial');
        $pin = $this->session->userdata('pin');

        //check if student reg number is registered in the counter table
        $record = $this->db->get_where('counter', array('idno' => $reg))->result_array();

        //check if hostel room and corner is already taken
        $takenspace = $this->db->get_where('counter', array('hostel_name' => $hosteljoin, 'room_no' => $param3, 'space' => $param4))->row();

        //if space have been taken;
        if($takenspace){

            //get the student data
            $studentData = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

            //get student sex
            $sex = $studentData->sex;

            //set error session
            $this->session->set_userdata('takenreport', 'Sorry! This space has been taken, please kindly take another');
            //$_SESSION['takenreport'] = 'Sorry! This space has been taken, please kindly take another';

            $page_data['page_name'] = $sex . 'hostel';
            $page_data['page_title'] = get_phrase('_' . $sex . ' Hostel Allocation System');
            

            $this->load->view('backend/index', $page_data);
        }
        //if registered;
        else if($record){

            //set the sessions
            $sid = $this->session->userdata('student_id');

            $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$sid));//
            $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$sid));

            //redirect to print out page
            $page_data['page_name']  = 'print_hostel';
            $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Accomodation Receipt');
            $this->load->view('backend/printout', $page_data);
            //redirect(base_url() . 'index.php?student/printOut', 'refresh');

        }else{

            //add record to counter table;
            $hostelName = $param1 . " " . $param2; //merge the splitted hostel name

            $data5['hostel_name'] = $hostelName;
            $data5['room_no'] = $param3;
            $data5['space'] = $param4;
            $data5['idno'] = $reg;
            $data5['serial'] = $serial;
            $data5['pin'] = $pin;

            $result = $this->db->insert('counter', $data5);

            //update student record with accommodation information;

            $data3['hostel_name'] = $hostelName;
            $data3['room_number'] = $param3;
            $data3['bed_space_no'] = $param4;

            $this->db->where('reg_no', $reg);
            $result2 = $this->db->update('student', $data3);

            //convert hostel name to table name
            $tableName = strtolower(str_replace(' ', '_', $hostelName));

            //update table to reflect taken room;
            $data4['status'] = "Taken";

            $this->db->where('counter', $param5);
            $result3 = $this->db->update($tableName, $data4);

            //check if all processes are completed;
            if($result && $result2 && $result3){
                $this->printer('hostel', $hostelName, $param3);
                //unset security
                $this->session->unset_userdata('hostelsec');
            }else{
                $_SESSION['err_msg'] = "An Error Occured!";
                redirect(base_url() . 'index.php?student/hostel');
            }
        }
        

    }

    /****** Some Nice functions I created----------

    //hostel type function; returns the view based on te paramater asigned to it;
    private function hostelType($param1){
        $page_data['page_name'] = $param1 . "hostel";
        $page_date['page_title'] = get_phrase("_" . $param1 . 'Hostel Allocation');
        return $this->load->view('backend/index', $page_data);
    }

    function maleHostels($param1, $param2, $param3, $param4, $param5){
        $hostel_query = $this->db->get($param1)->result_array();

        for($i = 0; $i < count($hostel_query); $i++){
            if($hostel_query[$i]['status'] == 'Vacant'){
                //display vacant rooms
                $output = "<ul>";
                $output .= "<li>" . $this->hostelLink($hostel_query, $i);
                $output .= "</ul>";

                

            }else if($hostel_query[$i]['status'] == 'Taken'){
                //display taken rooms;

            }
        }
        $this->hostelType($param5);

    }


    private function hostelLink($param1, $param2){
        $hostel_split = explode(' ', $param1[$param2]['hostel_name']);

        return $param1 . "<a href='" . $hostel_split[0] . "/" . $hostel_split[1] . "/" . $param1[$param2]['hostel_name'] . "/" . $param1[$param2]['room_no'] . "/" . $param1[$param2]['bed_space_no'] . "'></li>"; 
    }
    ***********************/

    function printe($param1 = '', $param2 = '', $param3 = ''){
      //if (!$this->session->userdata('serial'))
            //redirect(base_url() . 'index.php?login', 'refresh');

     if($param1=='fee'){
     $page_data['page_name']  = 'print_fee';
     $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Fee Receipt');
     $this->load->view('backend/printout', $page_data);

     }
     }

    function printer($param1 = '', $param2 = '', $param3 = ''){
      //if ($this->session->userdata('student_login') != 1)
            //redirect(base_url() . 'index.php?login', 'refresh');

    if($param1=='hostel'){

        $sid = $this->session->userdata('student_id');

        $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$sid));//
        $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$sid));

        $page_data['page_name']  = 'print_hostel';
        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Accomodation Receipt');
        $this->load->view('backend/printout', $page_data);
    }
     if($param1=='manual'){
     $page_data['page_name']  = 'print_manual';
     $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Fee Receipt');
     $this->load->view('backend/printout', $page_data);
     }
     if($param1=='fees'){
     $page_data['page_name']  = 'print_fee';
     $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Fee Receipt');
     $this->load->view('backend/printout', $page_data);

     }
    }
    
    function authenticate($param1 = '', $param2 = '', $param3 = ''){
            //$reg_no = $param1;
            $confirm = $param1;
            if($param1 !== '' || $param1 == ''){
            $db =  $this->db->get_where('student', array('student_id' => $reg_no))->row();
            $payment =  $this->db->get_where('etranzact_payment', array('customer_id' => $db->reg_no))->row();
            //var_dump($payment);
           $this->session->set_userdata('serial',$payment->customer_id);
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
           //$this->session->set_userdata('conf',$payment->confirm_code);
           $this->session->set_userdata('address',$payment->cust_add);
           $this->session->set_userdata('phone',$payment->phone);
           $this->session->set_userdata('etti','bom boy');
           $this->session->set_userdata('dept',$payment->dept);
           $this->session->set_userdata('level',$payment->level);
           $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id));
           $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id));
            }
            $page_data['page_name']  = 'print_fee';
            $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Fee Receipt');
            $this->load->view('backend/printout', $page_data);
    
    
    }

    function qr_check($param1 = '', $param2 = '', $param3 = ''){
            //$reg_no = $param1; >urlencode($this->remote_op); rawurldecode($response);
            $reg_no = rawurldecode($param1);
            if($param1 != ''){
                $db =  $this->db->get_where('student', array('reg_no' => $reg_no))->row();
                if($db){ 
                    $page_data['old_fees']  = $this->db->get_where('manual_etranzact', array('customer_id' => $db->reg_no))->result_array();
                    $page_data['new_fees']  = $this->db->get_where('etranzact_payment', array('customer_id' => $db->reg_no))->result_array();
                    $page_data['hostel']  = $this->db->get_where('counter', array('idno' => $db->reg_no))->result_array();
                   $this->session->set_userdata('serial',$db->reg_no);
                   $this->session->set_userdata('fullname',$db->name . ", " . $db->othername);
                   $this->session->set_userdata('dob',$db->birthday);
                   $this->session->set_userdata('address',$db->address);
                   $this->session->set_userdata('phone',$db->phone);
                   $this->session->set_userdata('email',$db->email);
                   $this->session->set_userdata('sex',$db->sex);
                   $this->session->set_userdata('etti','bom boy');
                   $this->session->set_userdata('dept',$db->dept);
                   $this->session->set_userdata('level',$db->level);
                   $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$db->student_id));
                   //$this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$db->id));

                   $page_data['page_name']  = 'print_info';
                   $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Fee Receipt');
                   $this->load->view('backend/printout', $page_data);
                }else{
                    echo "Student record not found";
                }
            }else{
                echo "Student record not found";
            }
    }

    /*this Function handles receipt from link*/
    function receipt($param1 = '', $param2 = '', $param3 = '')
    {     
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

         $reg_no   =   $this->session->userdata('reg_no');//student reg numbr from session
         $id        =   $this->session->userdata('student_id'); //student id from session

         $student = $this->db->get_where('student', array('reg_no' => $reg_no,'student_id' => $id))->row();
         //query etranzact table in db
         if($param1 == 'etranzact'){

            $payment =  $this->db->get_where('etranzact_payment', array('customer_id' => $reg_no,'confirm_code' => $param2))->row();
            //var_dump($payment);
           $this->session->set_userdata('serial',$payment->customer_id);//set serial
           $this->session->set_userdata('fullname',$payment->fullname); //set name
           $this->session->set_userdata('bankcode',$payment->bankcode); //set bank code
           $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id)); //image
           $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id)); //signature
           $this->session->set_userdata('bankname',$payment->bankname);//set bank name
           $this->session->set_userdata('branchcode',$payment->branchcode);//set branch code
           $this->session->set_userdata('conff',$payment->confirm_code);//set confirm code
           $this->session->set_userdata('amount',$payment->amount);
           $this->session->set_userdata('descr',$payment->description);
           $this->session->set_userdata('date',$payment->payment_date);
           $this->session->set_userdata('receipt',$payment->receipt_no);
           $this->session->set_userdata('session',$payment->session);
           //$this->session->set_userdata('conf',$payment->confirm_code);
           $this->session->set_userdata('address',$payment->cust_add);
           $this->session->set_userdata('phone',$payment->phone);
           $this->session->set_userdata('dept',$payment->dept);
           $this->session->set_userdata('level',$payment->level);
           //var_dump($this->session->userdata('level'));
           //$page_data['page_name'] = 'print_fee';
           $page_data['page_name'] = 'print_fee';
           $this->load->view('backend/printout', $page_data);
       }if($param1 == 'manual'){

            $payment =  $this->db->get_where('manual_etranzact', array('customer_id' => $reg_no,'confirm_code' => $param2))->row();
            //var_dump($payment);
           $this->session->set_userdata('serial',$payment->customer_id);//set serial
           $this->session->set_userdata('fullname',$payment->fullname); //set name
           $this->session->set_userdata('bankcode',$payment->bankcode); //set bank code
           $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id)); //image
           $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id)); //signature
           $this->session->set_userdata('bankname',$payment->bankname);//set bank name
           $this->session->set_userdata('branchcode',$payment->branchcode);//set branch code
           $this->session->set_userdata('conff',$payment->confirm_code);//set confirm code
           $this->session->set_userdata('amount',$payment->amount);
           $this->session->set_userdata('descr',$payment->description);
           $this->session->set_userdata('date',$payment->payment_date);
           $this->session->set_userdata('receipt',$payment->receipt_no);
           $this->session->set_userdata('session',$payment->session);
           //$this->session->set_userdata('conf',$payment->confirm_code);
           $this->session->set_userdata('address',$payment->cust_add);
           $this->session->set_userdata('phone',$payment->phone);
           $this->session->set_userdata('dept',$payment->dept);
           $this->session->set_userdata('level',$payment->level);
           //var_dump($this->session->userdata('level'));
           $page_data['page_name'] = 'print_fee';
           $this->load->view('backend/printout', $page_data);
       }if($param1 == 'courses'){
        $email      = $_POST["username"];//username
        $password   = $_POST["password"];//password
        $credential =   array(  'reg_no' => $email , 'password' => $password );
        $query = $this->db->get_where('sadmin' , $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_name', $row->name);

            $session = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;//academic year
            //$semester = $this->db->get_where('settings' , array('type' =>'active_semester'))->row()->description;//academic year
            $semester = $param2;//academic year
            $this->session->set_userdata('serial',$reg_no);//set serial
            $this->session->set_userdata('id',$id);//set serial
            $this->session->set_userdata('fullname',$payment->fullname); //set name
            $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id)); //image
            $this->session->set_userdata('session',$session);
            $this->session->set_userdata('semester',$semester);
            $this->session->set_userdata('dept',$student->dept);
            $this->session->set_userdata('level',$student->level);
            $this->session->set_userdata('prog_type',$student->prog_type);
            //var_dump($this->session->userdata('level'));
            $page_data['courses'] =$this->db->get_where('course_records' , array('reg_no' =>$reg_no,'std_id'=>$id,'selected_semester'=>$param2,'session'=>$session))->result_array();
            $page_data['page_name'] = 'print_course';
            $page_data['time'] = date("D M j Y G:i:s");
            $page_data['admin'] = $this->session->userdata('admin_name');
            $this->load->view('backend/printout', $page_data);
        }else{
            $_SESSION['err_msg'] = "Invalid Username / Password Combination. Printout failed";
            $this->session->set_userdata('err','Invalid Admin Username / Password Combination.');
            redirect(base_url() . 'index.php?student/course_management/'.$param2, 'refresh');

        }
       }
    }
    

    /******MANAGE BILLING / INVOICES WITH STATUS/ Manage Fees from Etranzact*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {     $reg_no   =   $this->session->userdata('reg_no');

    //$pay = $this->db->get_where('student', array('reg_no' => $reg_no))->result_array();
    $id = $this->session->userdata('student_id');
    $pay = $this->db->get_where('student', array('reg_no' => $reg_no))->result_array();
            //var_dump($pay);
        if($pay){
            foreach ($pay as $row ) {
                //$amount = $row['amount'];
                $id = $row['student_id'];
                $this->session->set_userdata('session',$this->input->post('session'));

                $this->session->set_userdata('serial',$reg_no);
                $this->session->set_userdata('conf',$this->input->post('CONFIRMATION_NO'));
                $this->session->set_userdata('address',$row['address']);
                $this->session->set_userdata('phone',$row['phone']);
                $this->session->set_userdata('dept',$row['dept']);
                $this->session->set_userdata('ph','etti');
                $this->session->set_userdata('level',$row['level']);
                $this->session->set_userdata('prog',$row['programme']);
                $this->session->set_userdata('lname',$row['name']);
                $this->session->set_userdata('fname',$row['othername']);
                $this->session->set_userdata('fullname',$this->session->userdata('lname').",".$this->session->userdata('fname')); //Student Name
                }
            }

            if($this->session->userdata('student_login')!=1)
                redirect(base_url() , 'refresh');

        $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
        $this->etranzact->set_terminal($this->input->post('TERMINAL_ID'));//message from textfield
        $this->etranzact->set_conf($this->input->post('CONFIRMATION_NO'));//message from textfield

         if($param1 == 'pay') {
            $check = $this->db->get_where('etranzact_payment', array('customer_id' => $reg_no,'confirm_code'=>$this->input->post('CONFIRMATION_NO')))->row();

            if(!$check){ //check if student has not registered
                $check = $this->db->get_where('etranzact_payment', array('confirm_code'=>$this->input->post('CONFIRMATION_NO')))->result_array();
                //var_dump($check);
                //if( !empty($check) && $check->customer_id != $this->session->userdata('serial')){
                if($check){
                    $_SESSION['err_msg'] = "Sorry: The Confirmation Code is Invalid, it has been used by another Student...";
                }else {
                    $this->etranzact->send();
                    //var_dump($this->etranzact->get_confirm());
                    //var_dump($this->session->userdata('fullname'));
                    if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != '0' && $this->etranzact->get_confirm() != '0'){  //start etranzact check

                        $this->session->set_userdata('receipt',$this->etranzact->get_receipt()); //Trans Receipt
                        //$this->session->set_userdata('fullname',$this->etranzact->get_fullname()); //Student Name
                        $this->session->set_userdata('bankcode',$this->etranzact->get_bankcode()); //Bank Code
                        $this->session->set_userdata('bankname',$this->etranzact->get_bankname());  //Bank Name
                        $this->session->set_userdata('branchcode',$this->etranzact->get_branchcode());//Branch Code
                        $this->session->set_userdata('conff',$this->etranzact->get_confirm());
                        $this->session->set_userdata('amount',$this->etranzact->get_amount());//transaction Amount
                        $this->session->set_userdata('descr',$this->etranzact->get_descr());  //Transaction Description
                        $this->session->set_userdata('date',$this->etranzact->get_date());    //Transaction Date


                        /*start ozioma sms*/
                        if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != '0' && $this->etranzact->get_confirm() != '0'){
                        /*echo "am here";*/
                            if($this->session->userdata('ph')){
                            //var_dump($_SESSION['page']);
                            //var_dump($this->session->userdata('phone'));
                                $this->load->library('ozioma'); //load the ozioma library  $this->input->post('message')
                                $this->ozioma->set_message("Hello ".$this->session->userdata('name').", Your fee has been successfully processed for the ".$this->session->userdata('session')." Session.");//message from textfield
                                $this->ozioma->set_recipient($this->session->userdata('phone'));//separate numbers with commas and include zip code in every number
                                $this->ozioma->set_sender("Alvan Reg");//sender from database
                                $this->ozioma->send();
                                $this->session->unset_userdata('ph');
                                if(!$this->ozioma->get_status() == 'OK'){
                                    /// exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
                                }
                            }
                            /**///end ozioma
                        }

                        $data['customer_id'] =  $this->session->userdata('serial');
                        $data['date_reg'] =  date("Y-m-d"); //date registered
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

                        if($data['confirm_code'] == 0 || $data['confirm_code'] == '0'){
                            $_SESSION['err_msg'] = "Transaction unsuccessful...";
                            return false;
                            exit;
                        }

                        $this->db->insert('etranzact_payment', $data);


                        //$invoice_id                = $_POST['custom'];
                        //$this->db->where('invoice_id', $invoice_id);
                        //$this->db->update('invoice', $data);
                        $_SESSION['err_msg'] = "Correct Pin / Serial Number Combination.";
                        $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print reciept for your fees</a>';
                        $_SESSION['prn_msg'] = $link;
                    }else if($this->etranzact->get_status() == "-1"){
                        $_SESSION['err_msg'] = "Sorry: The Confirmation Code is Invalid...";
                    }else if($this->etranzact->get_status() == "00" || $this->etranzact->get_status() == '0' || $this->etranzact->get_confirm() == '0'){
                        $_SESSION['err_msg'] = "The Etranzact server is down at the Moment, Please try again in an hour.";
                    }//end etranzact check
                }
            }else{ //if he has registered retrieve data from database
              $payment =  $this->db->get_where('etranzact_payment', array('customer_id' => $reg_no))->row();
                //var_dump($payment);
               $this->session->set_userdata('serial',$reg_no);
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

               /*if($this->etranzact->get_status() != "-1"){
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
                }*/

               $_SESSION['err_msg'] = "This Etranzact Confirmation Code has been used by you previously...";
               $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print reciept for your fees</a>';
               $_SESSION['prn_msg'] = $link;
            }//end


        }
        



        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $student_id              = $student_profile->student_id;
        $student_sex             = $student_profile->sex;
        $reg_no                  = $student_profile->reg_no;

            //table join
            $this->db->select('*');
            $this->db->from('etranzact_payment a,student b');
            $this->db->where('a.customer_id = b.reg_no',NULL,FALSE);
            $this->db->where('a.customer_id',$reg_no);
			$this->db->group_by("confirm_code"); 
            $query = $this->db->get();
            //return $query->result_array();

            //$page_data['hostel']   = $query->result_array();

        $page_data['invoices']   = $query->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }

    /*Manual payments from old etranzact data*/
    function m_invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if($this->session->userdata('student_login') != 1)
           redirect(base_url() , 'refresh');

       $reg_no = $this->session->userdata('reg_no');


        if($param1 == 'pay') {

            if($this->input->post('terminal') != '' && $this->input->post('type') == 'live'){
                $check = $this->db->get_where('manual_etranzact', array('confirm_code'=>$this->input->post('CONFIRMATION_NO'),'customer_id'=>$reg_no))->row();
                if(!$check){

                    $pay = $this->db->get_where('student', array('reg_no' => $reg_no))->result_array();

                    foreach ($pay as $row ) {
                        $this->session->set_userdata('address',$row['address']);
                        $this->session->set_userdata('phone',$row['phone']);
                        $this->session->set_userdata('dept',$row['dept']);
                        $this->session->set_userdata('ph','etti');
                        $this->session->set_userdata('level',$row['level']);
                        $this->session->set_userdata('prog',$row['programme']);
                        $this->session->set_userdata('fullname',$row['name'].', '.$row['othername']);
                    }

                    $this->session->set_userdata('session',$this->input->post('session'));
                    $this->session->set_userdata('serial',$reg_no);
                    
                    //var_dump($this->input->post('terminal'));
                    $this->load->library('etranzact'); //load the ozioma library  $this->input->post('message')
                    $this->etranzact->set_terminal($this->input->post('terminal'));//message from textfield
                    $this->etranzact->set_conf($this->input->post('CONFIRMATION_NO'));//message from textfield
                    $this->etranzact->send();


                    if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != '0' && $this->etranzact->get_confirm() != '0'){  //start etranzact che

                        $this->session->set_userdata('receipt',$this->etranzact->get_receipt()); //Trans Receipt
                        //$this->session->set_userdata('fullname',$this->etranzact->get_fullname()); //Student Name
                        $this->session->set_userdata('bankcode',$this->etranzact->get_bankcode()); //Bank Code
                        $this->session->set_userdata('bankname',$this->etranzact->get_bankname());  //Bank Name
                        $this->session->set_userdata('branchcode',$this->etranzact->get_branchcode());//Branch Code
                        $this->session->set_userdata('conff',$this->etranzact->get_confirm());
                        $this->session->set_userdata('amount',$this->etranzact->get_amount());//transaction Amount
                        $this->session->set_userdata('descr',$this->etranzact->get_descr());  //Transaction Description
                        $this->session->set_userdata('date',$this->etranzact->get_date());    //Transaction Date

                    
                        $data['customer_id'] =  $this->session->userdata('reg_no');
                        $data['fullname'] =  $this->session->userdata('fullname');
                        $data['date_reg'] =  date("Y-m-d");
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

                        $_SESSION['err_msg'] = "Correct Confirmation Code...";
                        $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print your School Fees reciept</a>';
                        $_SESSION['prn_msg'] = $link;
                        //redirect(base_url() . 'index.php?student/m_invoice');
                    }
                    else if($this->etranzact->get_status() == "-1"){
                        $_SESSION['err_msg'] = "Sorry: The Confirmation Code is Invalid...";
                        //redirect(base_url() . 'index.php?student/m_invoice');
                    }else if($this->etranzact->get_status() == "00" || $this->etranzact->get_status() == '0' || $this->etranzact->get_confirm() == '0'){
                        $_SESSION['err_msg'] = "The Etranzact server is down at the Moment, Please try again in an hour.";
                        //redirect(base_url() . 'index.php?student/m_invoice');
                    }

                }else{

                    $this->session->set_userdata('level',$check->level);
                    $this->session->set_userdata('session',$check->session);
                    $this->session->set_userdata('serial',$check->customer_id);
                    $this->session->set_userdata('address',$check->cust_add);
                    $this->session->set_userdata('phone',$check->phone);
                    $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id));
                    $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id));
                    $this->session->set_userdata('dept',$check->dept);
                    //$this->session->set_userdata('password',$_SESSION['password']);
                    $this->session->set_userdata('fullname',$check->fullname); //get from student input
                    $this->session->set_userdata('bankcode',$check->bankcode); //get from student input
                    $this->session->set_userdata('bankname',$check->bankname);
                    $this->session->set_userdata('branchcode',$check->branchcode);
                    $this->session->set_userdata('conff',$check->confirm_code);
                    $this->session->set_userdata('amount',$check->amount);
                    $this->session->set_userdata('descr',$check->description);
                    $this->session->set_userdata('date',$check->payment_date);

                    $_SESSION['err_msg'] = "This Etranzact Confirmation Code was previously been used You...";
                    $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print your School Fees reciept</a>'; 
                    $_SESSION['prn_msg'] = $link;      
                    //redirect(base_url() . 'index.php?student/m_invoice');
                }

            }elseif($this->input->post('terminal') == '' || $this->input->post('type') == 'manual'){               
               
                  $manual = $this->db->get_where('manual_payment', array('payment_code'=>$this->input->post('CONFIRMATION_NO')))->row();
                  if($manual){ //if it exists
                    $check = $this->db->get_where('manual_etranzact', array('customer_id' => $reg_no,'confirm_code'=>$this->input->post('CONFIRMATION_NO')))->result_array();
                    if(!$check){//if used by another user

                        $pay = $this->db->get_where('student', array('reg_no' => $reg_no))->result_array();
                    
                        foreach ($pay as $row ) {
                            $id = $row['student_id'];
                            $this->session->set_userdata('address',$row['address']);
                            $this->session->set_userdata('phone',$row['phone']);
                            $this->session->set_userdata('prog',$row['prog_type']);
                            $this->session->set_userdata('dept',$row['dept']);
                            $this->session->set_userdata('level',$row['level']);
                            $this->session->set_userdata('fullname',$row['name'].', '.$row['othername']);
                        }

                        $this->session->set_userdata('amount',$manual->trans_amount);//transaction amount
                        
                        $this->session->set_userdata('session',$this->input->post('session'));//Academic year/session

                        $this->session->set_userdata('conff',$this->input->post('CONFIRMATION_NO'));//etz confrmation code
                        

                        $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id));
                        $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id));
                           

                          $data['customer_id'] =  $this->session->userdata('reg_no');
                          $data['fullname'] =  $this->session->userdata('fullname');
                          $data['date_reg'] =  date("Y-m-d");
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

                        $_SESSION['err_msg'] = "Correct Confirmation Code...";
                          $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print your School Fees reciept</a>';
                        $_SESSION['prn_msg'] = $link;
                        //redirect(base_url() . 'index.php?student/m_invoice');

                        //end database search for previously used conf_code by the same user
                        }else{
                            $check = $this->db->get_where('manual_etranzact', array('confirm_code'=>$this->input->post('CONFIRMATION_NO'),'customer_id'=>$reg_no))->row();

                            $this->session->set_userdata('level',$check->level);
                            $this->session->set_userdata('session',$check->session);
                            $this->session->set_userdata('serial',$check->customer_id);
                            $this->session->set_userdata('address',$check->cust_add);
                            $this->session->set_userdata('phone',$check->phone);
                            $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id));
                            $this->session->set_userdata('signature',$this->crud_model->get_sign_url('student',$id));
                            $this->session->set_userdata('dept',$check->dept);
                            $this->session->set_userdata('fullname',$check->fullname); //get from student input
                            $this->session->set_userdata('bankcode',$check->bankcode); //get from student input
                            $this->session->set_userdata('bankname',$check->bankname);
                            $this->session->set_userdata('branchcode',$check->branchcode);
                            $this->session->set_userdata('conff',$check->confirm_code);
                            $this->session->set_userdata('amount',$check->amount);
                            $this->session->set_userdata('descr',$check->description);
                            $this->session->set_userdata('date',$check->payment_date);

                            $_SESSION['err_msg'] = "This Etranzact Confirmation Code was previously been used You...";
                            $link = '<a target ="_blank" href='.base_url().'index.php?student/printe/fee>Click here to print your School Fees reciept</a>'; 
                            $_SESSION['prn_msg'] = $link; 
                            //redirect(base_url() . 'index.php?student/m_invoice');     
                        }
                    
                    }//end database search for identical conf_code
                  else{
                    $_SESSION['err_msg'] = "Sorry: This Etranzact Confirmation Code doesnt exist...";
                    //redirect(base_url() . 'index.php?student/m_invoice');
                  }
            }
            //redirect(base_url() . 'index.php?student/m_invoice');
            }//end loop for parameter 'pay'

        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $student_id              = $student_profile->student_id;
        $student_sex             = $student_profile->sex;
        $reg_no                  = $student_profile->reg_no;

        $page_data['invoices']   = $this->db->get_where('manual_etranzact', array(
            'customer_id' => $reg_no
        ))->result_array();
        $page_data['page_name']  = 'm_invoice';
        $page_data['page_title'] = get_phrase('Old Fees from Etranzact');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);

    }
    
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
		session_start();
        if ($this->session->userdata('student_login') != 1 && $this->session->userdata('access') != 1)
        //if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $updRegNo = $this->input->post('reg_no');
			$updRegNo = str_replace(" ","",$updRegNo);
			$updRegNo = str_replace(".","",$updRegNo);
			
            //INVOICE
			//OLD REG NO
			$id = $this->session->userdata('student_id');
			$old0 = $this->db->get_where("student",array('student_id'=>$id))->row();
			$oldRNo = $old0->reg_no;
			$inv['dept_id']        = $this->input->post('dept');
			$inv['portal_id'] = $updRegNo;
			$this->db->where('portal_id', $oldRNo)
			->update('invoice_gen', $inv);
			//---INVOICE---
            
            
            $data['name']        = $this->input->post('name');
            $data['reg_no']      = $updRegNo;
	    $data['portal_id']   = $updRegNo;
            $data['othername']   = $this->input->post('othername');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['religion']    = $this->input->post('religion');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['marital_status']       = $this->input->post('marital_status');
            $data['nationality'] = $this->input->post('nationality');
            $data['state']       = $this->input->post('state');
            $data['title']       = $this->input->post('title');
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
            $data['status']     = '2';


            /*if($data['school'] == '0' || $data['prog_type'] == '0' || $data['programme'] == '0' || $data['level'] == '0'){
                $_SESSION[err_msg] = 'School Data is missing';
                if($data['school'] == '' || $data['prog_type'] == '' || $data['programme'] == '' || $data['level'] == ''){
                    $_SESSION[err_msg] = 'School Data is missing';
                }
                return 0;
            }*/
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);

			//EDU FEES PORTAL
           	$reg['regno']= $updRegNo;
			$newRegNo = $updRegNo; 
	    	$this->db->where('student_id', $this->session->userdata('student_id'));
			$this->db->update('eduportal_fees_payment_log',$reg);
				//GET PIN
				$pinInfo = $this->db->get_where("eduportal_fees_payment_log",array("regno"=>$newRegNo))->row();
				$pin = $pinInfo->payment_code;
			
			
			//ETRANZACT  TABLE
			
			$chk = $this->db->get_where("nekede_etranzact_payment",array("confirm_code"=>$pin))->row();
				
			if($chk){
				$oldRegNo = $chk->portal_id;
				$etz['portal_id']= $newRegNo; 
	    	$this->db->where('portal_id', $oldRegNo);
			$this->db->update('nekede_etranzact_payment',$etz);
			}
	
	
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?student/manage_profile', 'refresh');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('student', array(
                'student_id' => $this->session->userdata('student_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        }

        if ($param1 == 'change_picture') {

        $student_id = (int)$this->db->get_where('student', array(
                'student_id' => $this->session->userdata('student_id')
            ))->row()->student_id;

        $max_file_size = 51200;

      $imagesize = $_FILES['userfile']['size'];
      $signsize = $_FILES['usersign']['size'];

      //var_dump($imagesize);
      //var_dump($signsize);

      if($imagesize > $max_file_size){
        $_SESSION['imgerror'] = "Passport image size is too large. Please upload an image less than 50kb";
        //$page_data['page_name']  = 'register3';
        
        //$page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
        //header("location:" . base_url() . "index.php?student/manage_profile");

        //redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        //$this->load->view('backend/register', $page_data);
      }elseif($signsize > $max_file_size){
        $_SESSION['imgerror'] = "Signature image size is too large. Please upload an image less than 50kb";
        //$page_data['page_name']  = 'register3';
        //$page_data['page_title'] = get_phrase('Alvan Ikoku College of Education | Register');
        //redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        //$this->load->view('backend/register', $page_data);
      }else{
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
       // $this->crud_model->clear_cache();

        move_uploaded_file($_FILES['usersign']['tmp_name'], 'uploads/student_signature/' . $student_id . '.jpg');
       // $this->crud_model->clear_cache();
        //$_SESSION['register4'] = "register4";
        //redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
      }
      redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');


        /*move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
        $this->crud_model->clear_cache();

        move_uploaded_file($_FILES['usersign']['tmp_name'], 'uploads/student_signature/' . $student_id . '.jpg');
        $this->crud_model->clear_cache();*/

        

        }
		
        $page_data['page_name']  = 'manage_profile';
		$page_data['conn']  = $conn;
        $page_data['page_title'] = get_phrase('Manage_Profile');
        $page_data['edit_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->result_array();

        $this->load->view('backend/index', $page_data);
    }

public function view_students_information()
{
	
$page_data['page_title'] = 'YABATECH Students Information';
$page_data['page_name']  = 'students_info';
$this->load->view('backend/student_print',$page_data);
}
public function view_students_information_programmetype($id)
{
	
$page_data['page_title'] = 'YABATECH Students Information';
$page_data['page_name']  = 'students_info_programme_type';
$page_data['id'] =$id;
$this->load->view('backend/student_print',$page_data);
}

    //PORTAL SYNC
    function fetch_portal_info($payment_code){
                $student_id = $this->db->get_where("eduportal_fees_payment_log",array("payment_code"=>$payment_code))->row();
        if($student_id){
			$status = 1;	
		}
		else{
			$status = 0;	
		}
		if($student_id->payment_fee_type == 1){
			$fee_type_id = 1;
		}
		elseif($student_id->payment_fee_type == 2){
			$fee_type_id = 2;
		}
		elseif($student_id->payment_fee_type == 3){
			$fee_type_id = 12;
		}
		elseif($student_id->payment_fee_type == 4){
			$fee_type_id = 13;
		}
		//level
		if($student_id->payment_level == "ND I"){
			$fee_level_id = 1;
		}
		elseif($student_id->payment_level == "ND II"){
			$fee_level_id = 2;
		}
		elseif($student_id->payment_level == "HND I"){
			$fee_level_id = 4;
		}
		else{
			$fee_level_id = 5;
		}
		
		$fee_session = str_replace("/","__",$student_id->payment_session);
		$trans_date = str_replace("-","__",$student_id->payment_date);
		
        $stud_data = $this->db->get_where("student",array("student_id"=>$student_id->student_id))->row();
		
		//PROG
		if($stud_data->prog_type == 1 ||$stud_data->prog_type == 4){
			$fee_prog_id = 1;
		}
		elseif($stud_data->prog_type == 2 ||$stud_data->prog_type == 5){
			$fee_prog_id = 2;
		}
		else{
			$fee_prog_id = 3;
		}
		
	$receipt_no = $student_id->payment_code;
						$staff_code = str_replace("/","__",$stud_data->reg_no);
			//	$surname = str_replace(" ","__",$stud_data->name);
			//		$othernames = str_replace(" ","__",$stud_data->othername);
					$surname = str_replace(".","__",$stud_data->name);
					$othernames = str_replace(".","__",$stud_data->othername);
					
					$dept_id = $stud_data->dept;
					$fee_type_id = $fee_type_id;
					$fee_level_id = $fee_level_id;
					$fee_prog_id = $fee_prog_id;
					$fee_session = $fee_session;

		?>
        <script language="javascript">
		window.location.href="http://localhost/bursary_system/stud_acct/syncInfo/<?php echo $status."/".$receipt_no."/".$staff_code."/".$surname ."/".$othernames."/".$dept_id."/".$fee_type_id."/".$fee_level_id."/".$fee_prog_id."/".$fee_session."/".$trans_date;?>";
		</script>
        <?php
    

        
    
    }
    
    function check_payment_status()
	{
		$count=1;
		    $query = $this->db->query("select* from invoice_gen where date_generated like '%2018-02%' limit 20")->result_array();
			foreach($query as $row)
			{
				$rrr = $row["rrr"];
			$mert =  '532776942';

			$api_key =  '587460';

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

			

			
echo "$count ".$rem." ".$response['message'].' '.$row["surname"].' '.$row["firstname"];
		
			$count++;
			}
			
	}
	
	function check_acceptance_payment_status()
	{
		$count=1;
		    $query = $this->db->query("select* from eduportal_remita_accp_temp_data where datetime like '%2018-02%'")->result_array();
			foreach($query as $row)
			{
				$rrr = $row["rrr"];
			
			
$exist=$this->db->query("select* from eduportal_remita_payment where rrr='$rrr'")->row();
if($exist)
{
$data2['status'] = 'Approved';
$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_accp_temp_data', $data2);
		//	if($msg == 'Approved'){
echo "$count ".$rrr." ".$row['datetime'];
}
		//	}
			$count++;
			}
			
	}
	
	function payments(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'payments';
        $page_data['page_title'] = get_phrase('Payments');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
	function feeReceipt($param1 = ''){
        session_start();
        if ($this->session->userdata('student_login') != 1 || $param1 == '')
            redirect(base_url(), 'refresh'); 

        $page_data['payeeData']  = $param1;
		$_SESSION['payeeID']= $param1;
		$payDetails2 = $this->db->get_where('eduportal_fees_payment_log', array("id" => $_SESSION['payeeID']))->row();
		$type=$payDetails2->payment_status;
		if($type=='F')
		{
        $page_data['page_name']  = 'remita_schfee_receipt';
		}
		else
		{
		 $page_data['page_name']  = 'etransact_schfee_receipt';
		}
        $page_data['page_title'] = get_phrase('Fee Payment Receipt');

        $this->load->view('backend/student_print', $page_data);

    }
	
	function adm_status_default_page(){
		if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'admission_status';
        $page_data['page_title'] = get_phrase('Reprint Admissions Letter');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

        $this->load->view('backend/index', $page_data);
	}
	
	public function verify_appno(){
		
		session_start();
			
				$application_no = $this->input->post('jambreg');
			
		
		/*if ($this->form_validation->run() == FALSE){*/
		if(!$application_no){
	
			redirect(base_url().'index.php?student/adm_status_default_page');	
		}	
		else{
			
			
			$verif = "select * from eduportal_fees_payment_log where regno = ? and payment_fee_type='1'";
			$verify = $this->db->query($verif,$application_no);
			if($verify->num_rows()==0){
			
			//	$_SESSION["error"] = "Sorry you have not yet paid Acceptance fees!";
			//	redirect(base_url().'index.php?student/adm_status_default_page');		
			}
			else{
				$check1 = "select * from eduportal_admission_list e inner join programme_type p on e.programme_type_id=p.programme_type_id where e.application_no = '$application_no'";
				$check2 = $this->db->query($check1);
				if($check2->num_rows()>0){
					$_SESSION["progCode"]= $program_code;
					$_SESSION["application_no"] = $application_no;

					redirect(base_url().'index.php?student/adm_letter');
				}
				else{
					$page_data['page_name']  = 'admission_status';
					$page_data['page_title'] = 'Reprint Admission Letter';
					$_SESSION["error"] = "No Admission Record found. Please contact ICT";
					redirect(base_url().'index.php?student/adm_status_default_page');		
				}
			}
		}
	}
	public function adm_letter(){
		session_start();
		$page_data['page_name']  = 'DEG_adm_letter';
		$page_data['page_title'] = '2018/2019 YABATECH ('.substr($_SESSION["progCode"],-1).') ADMISSION LETTER';
		$this->load->view('backend/student_print',$page_data);	
	}
	function register_courses(){
		
   session_start();

    $page_data['page_name']  = 'register_courses';
    $page_data['page_title'] = "Register Courses";
    $this->load->view('backend/index', $page_data);
    
	}
	
	
	function register_carryover_courses(){
		
   

    $page_data['page_name']  = 'register_carryover_courses';
    $page_data['page_title'] = "Register Carry Over / Elective Courses";
    $this->load->view('backend/print', $page_data);
    
	}
	
	function reprint_courses()
	{
		$page_data['page_name']  = 'reprint_courses';
    $page_data['page_title'] = "Print Courses";
    $this->load->view('backend/index', $page_data);
	}
	
	function ajax_submit_coursereg (){
		include('application/config/z.php');
		
    $_SESSION["error"]="";
	
   $data2 = array(
  
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'year_of_study_id'=> $this->input->post("year_of_study"),
   'programme'=> $this->input->post("programme_type_id")
   
   
   );
   
   	$page_data = array(
   'semester'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'session_id'=>$this->input->post('session'),
   'programme'=> $this->input->post('programme'),
   'level_id'=> $this->input->post('year_of_study'),
   

   'confirm_code'=> $this->input->post('pin')
   );
   
	 $page_data['page_name']  = 'process_register_courses';
     $page_data['page_title'] = "Register Courses";
	 $page_data['conn'] = $conn;
   $details = $this->db->get_where('course_unit_load', $data2)->row();
   
   if(!isset($details->maximum_unit))
   {
	   $_SESSION["error"]= "Error:  Maximum credit unit load of your class has not assigned! Contact your Class Adviser.";
	   
	
     $this->load->view('backend/index', $page_data);
	 
   }
   else
   {
   $maxunit=$details->maximum_unit;
   

	$course_unit=0;
	$credit=0;
	 $dataverify1=array(
   'student_id'=>$this->input->post('studentid'),
   'year_of_study'=>$this->input->post("year_of_study"),
   'session'=>$this->input->post('session'),
   'semester'=> $this->input->post('semester')
	);
	$detailscredit = $this->db->get_where('courses_registered',$dataverify1);
	foreach($detailscredit->result() as $row)
	{
		$credit= $credit + $row->course_unit;
	}
	
	foreach($_POST['course_assign_id']  as $course_assign_id) {

  
   $course_unit=$course_unit+$this->input->post("creditunit".$course_assign_id);
   
   
	}
	$course_unit=$course_unit+$credit;

   if($course_unit>$maxunit)
   {
	   $_SESSION["error"]= "Error: Total Selected Credit Unit of $course_unit is higher than assigned Maximum credit unit of $maxunit!";
	   
	
     $this->load->view('backend/index', $page_data);
	 
   }
   else
   {
    foreach($_POST['course_assign_id']  as $course_assign_id) {

  $data = array(
   'student_id'=>$this->input->post('studentid'),
   'course_assign_to_dept_id'=> $course_assign_id,
   'course_unit'=>$this->input->post("creditunit".$course_assign_id),
   'year_of_study'=>$this->input->post("year_of_study"),
   'session'=>$this->input->post('session'),
   'semester'=> $this->input->post('semester'),
   'course_status_id'=>"R",
   'approved'=> '0',
   'date_submitted'=>date("d M Y H:i:s"),
   'semestr'=> $this->input->post('sem'),
   'level'=> $this->input->post('level_of_study'),
   'sess'=> '2018/2019'
   
   );
   
   $dataverify=array(
   'student_id'=>$this->input->post('studentid'),
   'course_assign_to_dept_id'=> $course_assign_id,
   'year_of_study'=>$this->input->post("year_of_study"),
   'session'=>$this->input->post('session'),
   'semester'=> $this->input->post('semester')
	);
	$detailsexit = $this->db->get_where('courses_registered',$dataverify);
	if($detailsexit->num_rows() > 0)
	{
    $_SESSION["error"]= "Course Registration Updated Successfully!";
	   
	
     
	}
	else
	{
		$this->db->insert('courses_registered',$data);
		$_SESSION["error"]= "Courses Registered Successfully!";
	header("Location: index.php?student/course_reg_complete");	
	}
	
  }
   }
   }
  $this->load->view('backend/index', $page_data);
}




function ajax_submit_carryover_coursereg (){
    $_SESSION["error"]="";
	
   $data2 = array(
  
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'year_of_study_id'=> $this->session->userdata('level_id'),
   'programme'=> $this->input->post("programme_type_id")
   
   
   );
   
   	$page_data = array(
   'semester'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'session_id'=>$this->session->userdata('sess'),
   'programme'=> $this->input->post('programme'),
   'level_id'=> $this->input->post('year_of_study')
   

   );
   
 $page_data['page_name']  = 'process_carryover_courses';
     $page_data['page_title'] = "Register Carry Over / Elective Courses";
   $details = $this->db->get_where('course_unit_load', $data2)->row();
   
   if(!isset($details->maximum_unit))
   {
	   $_SESSION["error"]= "Error:  Maximum credit unit load of your class has not assigned! Contact your Class Adviser.";
	   
	
     $this->load->view('backend/index', $page_data);
	 
   }
   else
   {
   $maxunit=$details->maximum_unit;
   

	$course_unit=0;
	$credit=0;
	 $dataverify1=array(
   'student_id'=>$this->input->post('studentid'),
   'year_of_study'=>$this->session->userdata('level_id'),
   'session'=>$this->session->userdata('sess'),
   'semester'=> $this->input->post('semester')
	);
	$detailscredit = $this->db->get_where('courses_registered',$dataverify1);
	foreach($detailscredit->result() as $row)
	{
		$credit= $credit + $row->course_unit;
	}
	
	foreach($_POST['course_assign_id']  as $course_assign_id) {

  
   $course_unit=$course_unit+$this->input->post("creditunit".$course_assign_id);
   
   
	}
	$course_unit=$course_unit+$credit;

   if($course_unit>$maxunit)
   {
	   $_SESSION["error"]= "Error: Total Selected Credit Unit of $course_unit is higher than assigned Maximum credit unit of $maxunit!";
	   
	
     $this->load->view('backend/index', $page_data);
	 
   }
   else
   {
    foreach($_POST['course_assign_id']  as $course_assign_id) {

  $data = array(
   'student_id'=>$this->input->post('studentid'),
   'course_assign_to_dept_id'=> $course_assign_id,
   'course_unit'=>$this->input->post("creditunit".$course_assign_id),
   'year_of_study'=>$this->session->userdata('level_id'),
   'session'=>$this->session->userdata('sess'),
   'semester'=> $this->input->post('semester'),
   'course_status_id'=>"R",
   'approved'=> '0',
   'date_submitted'=>date("d M Y H:i:s"),
   'semestr'=> $this->input->post('sem'),
   'level'=> $this->input->post('level_of_study'),
   'sess'=> '2018/2019'
   
   );
   
   $dataverify=array(
   'student_id'=>$this->input->post('studentid'),
   'course_assign_to_dept_id'=> $course_assign_id,
   'year_of_study'=>$this->session->userdata('level_id'),
   'session'=>$this->session->userdata('sess'),
   'semester'=> $this->input->post('semester')
	);
	$detailsexit = $this->db->get_where('courses_registered',$dataverify);
	if($detailsexit->num_rows() > 0)
	{
    $_SESSION["error"]= "Course Registration Updated Successfully!";
	   
	
     
	}
	else
	{
		$this->db->insert('courses_registered',$data);
		$_SESSION["error"]= "Courses Registered Successfully!";
	//header("Location: index.php?student/course_reg_complete");	
	}
	
  }
   }
   }
  $this->load->view('backend/print', $page_data);
}






	function course_reg_complete()
	{
		 include('application/config/z.php');
	$page_data['conn']  = $conn;	 
	$page_data['page_name']  = 'course_reg_complete';
    $page_data['page_title'] = "Course Registration Slip";
    $this->load->view('backend/print', $page_data);
	}
	
	
	function drop_registered_course($course_reg_id){
    $_SESSION["error"]="";
  
   $data2 = array(
   'course_registered_id'=> $course_reg_id
   );
   
   
   $detailsexit = $this->db->get_where('courses_registered',$data2)->row();
	if($detailsexit->approved > 0)
	{
		
  //$coursedetails = $this->db->get_where('eduportal_courses', array('course_id'=> $course_id))->row();
   $_SESSION["error"]= " This Course have been Approved by Class Adviser";
	}
	else
	{
	
	$this->db->where('course_registered_id', $course_reg_id);
    $this->db->delete('courses_registered');
	}
	
	
	
 redirect('student/view_registered_courses');
	
	
   
   
  
}


function view_registered_courses()
	{
		  if($this->session->userdata('student_login')!=1)
		{
			 redirect(base_url() . 'index.php?login/logout', 'refresh');
		}
   	$page_data = array(
   'semester'=> $this->session->userdata('semester_id'),
   'student_type_id'=> $this->session->userdata('programme'),
   'department_id'=>$this->session->userdata('depts'),
   'session_id'=>$this->session->userdata('sess'),
   'programme'=> $this->session->userdata('programme'),
   'level_id'=> $this->session->userdata('level_id'),
   

   'confirm_code'=> $this->session->userdata('pin')
   );
   
	 $page_data['page_name']  = 'process_register_courses';
     $page_data['page_title'] = "Register Courses";
	$this->load->view('backend/index', $page_data);
}
	function ajax_verify_pin_coursereg()
	{
		session_start();
	include('application/config/z.php');
		//echo $conn;
	$data = array(
   
   'student_id'=> $this->session->userdata('student_id'),
   'payment_session'=> $this->input->post('session'),
   'payment_fee_type'=> '2'
   );
  
//$_SESSION["sessio_id"]= $this->input->post('session') ;
//$_SESSION["level_id"]=$this->input->post('level');
//$_SESSION["semester"]=$this->input->post('semester') ;
//$_SESSION["stuReg_id"]=$this->session->userdata('student_id');
   
  
   $data2 = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'session'=>$this->input->post('session'),
   'programme'=> $this->input->post('programme'),
   'level'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id')
   );
	// $page_data['page_name']  = 'process_register_courses';
    //$page_data['page_title'] = "Register Courses";
    //$this->load->view('backend/index', $page_data);
	// echo $this->input->post('pin').$this->input->post('portal_id').$this->input->post('session');
	$pin=$detailsexit->payment_code;
	
	
	
    $data3 = 	array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id')
   
	);
	
	 $detailsexit2 = $this->db->get_where('course_assigned_to_department',$data3);
	if($detailsexit2->num_rows() > 0)
	{
   $page_data = array(
   'semester'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'session_id'=>$this->input->post('session'),
   'programme'=> $this->input->post('programme'),
   'level_id'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'deptsoptions'=>$this->input->post('deptsoptions'),
   'confirm_code'=> $pin
   );
  // redirect('student/view_registered_courses');
  // $_SESSION["level"] = $this->input->post('level');
	 $page_data['page_name']  = 'process_register_courses';
     $page_data['page_title'] = "Register Courses";
	 $page_data['conn'] = $conn;
     $this->load->view('backend/index', $page_data);
	}
	
	else
	{
	$_SESSION["error"]= "Sorry your Class Adviser has not assigned Courses to your department for this semester ! Contact your Class Adviser";
	$page_data['page_name']  = 'register_courses';
    $page_data['page_title'] = "Register Courses";
    //$this->load->view('backend/index', $page_data);
	redirect('student/register_courses');
	}
	
		
}


function ajax_view_carryover_coursereg()
	{
	
	$data = array(
  
   'portal_id'=> $this->input->post('portal_id')
   );
  

   

   $data2 = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'programme'=> $this->input->post('programme'),
   'level'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id')
   );
	// $page_data['page_name']  = 'process_register_courses';
    //$page_data['page_title'] = "Register Courses";
    //$this->load->view('backend/index', $page_data);
	// echo $this->input->post('pin').$this->input->post('portal_id').$this->input->post('session');

	
    $data3 = 	array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'year_of_study_id'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id')
   
	);
	
	 $detailsexit2 = $this->db->get_where('course_assigned_to_department',$data3);
	if($detailsexit2->num_rows() > 0)
	{
   $page_data = array(
   'semester'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'session_id'=>$this->session->userdata('sess'),
   'programme'=> $this->input->post('programme'),
   'level_id'=> $this->input->post('level'),
   'programme_type_id'=> $this->input->post('programme_type_id')
   );
  // $_SESSION["level"] = $this->input->post('level');
	 $page_data['page_name']  = 'process_carryover_courses';
     $page_data['page_title'] = "Register Carry Over / Elective Courses";
     $this->load->view('backend/print', $page_data);
	}
	
	else
	{
	$_SESSION["error"]= "Sorry the Class Adviser has not assigned Courses to the department for the selected semester ! Contact the Class Adviser.";
	$page_data['page_name']  = 'register_carryover_courses';
    $page_data['page_title'] = "Register Carry Over / Elective Courses";
    $this->load->view('backend/index', $page_data);
	}
	
		
}

function qrCheck($param1, $param2 , $param3, $param4,$param5){
	if($param1=="fee")
	{
		$feedata = array(
                   'student_id'  => $param2
				   );
$this->session->set_userdata($feedata); 
header("Location: index.php?student/qrfeeReceipt");
	}
	else






{
	$newdata = array(
                   'student_id'  => $param1,
                   'semester_id'     => $param2,
                   'sess' => $param3.'/'.$param4,
				   'level_id' => $param5,
				   'session' => $param3.'/'.$param4,
				   'level' => $this->db->query("select *  from course_year_of_study where year_of_study_id='$param5'")->row()->year_of_study_name
               );

$this->session->set_userdata($newdata); 
header("Location: index.php?student/course_reg_complete");
	 
} 
}

function process_reprint_course_regslip()
{
	session_start();
	  if($this->session->userdata('student_login')!=1)
		{
	    redirect(base_url() . 'index.php?login/logout', 'refresh');
		}
$param1= $this->session->userdata('student_id');
$param2= $this->input->post('session') ;
$param3= $this->input->post('level');
$param4= $this->input->post('semester') ;

$data = array(
   
   'student_id'=> $this->session->userdata('student_id'),
   'payment_session'=> $this->input->post('session'),
   'payment_fee_type '=> '2'
   );
  

   
    $detailsexit = $this->db->get_where('eduportal_fees_payment_log',$data);
	if($detailsexit->num_rows() > 0)
	{
   
	}
	

	$newdata = array(
                   'student_id'  => $param1,
                   'semester_id'     => $param4,
                   'sess' => $param2,
				   'level_id' => $param3,
				   'session' => $param2,
				   'level' => $this->db->query("select *  from course_year_of_study where year_of_study_id='$param3'")->row()->year_of_study_name
               );

$this->session->set_userdata($newdata); 
header("Location: index.php?student/course_reg_complete");
	 
} 

function check_sessional_result(){
		
   

    $page_data['page_name']  = 'check_sessional_result';
    $page_data['page_title'] = "Check Semester Results";
    $this->load->view('backend/index', $page_data);
    
	}
	
	function process_check_sessional_result()
{
	session_start();
	  if($this->session->userdata('student_login')!=1)
		{
	    redirect(base_url() . 'index.php?login/logout', 'refresh');
		}
$param1= $this->session->userdata('student_id');
$param2= $this->input->post('session') ;
$param3= $this->input->post('level');
$param4= $this->input->post('semester') ;

$data = array(
   
   'student_id'=> $this->session->userdata('student_id'),
   'payment_session'=> $this->input->post('session'),
   'payment_fee_type '=> '2'
   );
  

   
    $detailsexit = $this->db->get_where('eduportal_fees_payment_log',$data);
	if($detailsexit->num_rows() > 0)
	{
   
	}
	
	
	$data5 = array(
   
   'student_id'=> $this->session->userdata('student_id'),
   'session'=> $this->input->post('session'),
   'year_of_study'=> $this->input->post('level'),
   'semester'=> $this->input->post('semester'),
   'result_approved'=> 1
   
   );
	 $resultexit = $this->db->get_where('courses_registered',$data5);
	if($resultexit->num_rows() > 0)
	{
   
	}
	else
	{
	$_SESSION["err_msg"]= "Sorry you have no results Approved for this session !";
	redirect(base_url() . 'index.php?student/check_sessional_result');
	}

	$newdata = array(
                   'student_id'  => $param1,
                   'semester_id'     => $param4,
                   'sess' => $param2,
				   'level_id' => $param3,
				   'session' => $param2,
				   'level' => $this->db->query("select *  from course_year_of_study where year_of_study_id='$param3'")->row()->year_of_study_name
               );

$this->session->set_userdata($newdata); 
header("Location: index.php?student/sessional_result_slip");
	 
} 

function sessional_result_slip()
	{
		 include('application/config/z.php');
		
		  $page_data['conn']  = $conn;
	$page_data['page_name']  = 'sessional_result_slip';
    $page_data['page_title'] = "Sessional Result Slip";
    $this->load->view('backend/print', $page_data);
	}
	
}