<?php



if (!defined('BASEPATH'))



    exit('No direct script access allowed');



class Payment extends CI_Controller



{

    

    function __construct()



    {



        parent::__construct();



        $this->load->database();

        $this->load->library('remita');



        /*cache control*/



        //$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');



        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');



        $this->output->set_header('Pragma: no-cache');



    }



    function morning_student(){



		$page_data['page_name']  = 'morning_student';



        $page_data['page_title'] = 'HND/ND Morning';



        $this->load->view('backend/putm', $page_data);



	}



	function evening_student(){



		$page_data['page_name']  = 'evening_student';



        $page_data['page_title'] = 'HND/ND Evening/Weekend';



        $this->load->view('backend/putm', $page_data);



	}



	function new_morning_student(){



		$page_data['page_name']  = 'new_morning_students';



        $page_data['page_title'] = 'HND/ND Morning';



        $this->load->view('backend/putm', $page_data);



	}



	function new_evening_student(){



		$page_data['page_name']  = 'new_evening_students';



        $page_data['page_title'] = 'HND/ND Evening/Weekend';



        $this->load->view('backend/putm', $page_data);



	}



	/*This function resolves remita issues for old students*/

	function res_old_student(){

		if($_POST){

			session_start();

			$portalID = $this->input->post('regno');

			$rrr = $this->input->post('rrr');//Remita Retrieval Reference

			if($rrr == "" || strlen($rrr) < 9 ){

				$_SESSION['apError'] = 'Please Enter a Valid Remita Retrieval Reference (RRR)';

				redirect(base_url() . 'index.php?payment/res_new_student');

			} 

	    	if(substr($portalID, 0, 4) == 'PHND' || substr($portalID, 0, 3) == 'FPN'){ 

				$_SESSION['apError'] = "Error: You are a new student, Please you the appopriate link";

	        	redirect(base_url().'index.php?payment/res_new_student', 'refresh');

			}



	    	$session  = $this->input->post('session');

	    	$fname = $this->input->post('fname');

	    	$surname = $this->input->post('surname');

	    	$fullname = $surname.', '.$fname;

	        $email = $this->input->post('email');

	        $phone = $this->input->post('phone');

	        $regno = $this->input->post('regno');//reg no

	        $prog = $this->input->post('prog');//programme type

	        $level = $this->input->post('level');//course type



	        if(isset ($email) && strlen($email) && ($phone) && strlen($phone)  && ($session) && strlen($session)  && ($regno) && strlen($regno) && ($fname) 

	        	&& strlen($fname) && ($prog) && strlen($prog) && ($surname) && strlen($surname) && ($level) && strlen($level) && ($rrr) ) {

			}

			else {

				$_SESSION['formerror'] = 'All form fields are required.';

				redirect(base_url() . 'index.php?payment/res_old_student');

			} //if all form fields were not filled return to page



			//Check if issue was submitted already

			// $alreadyGenerated = $this->db->get_where('remita_resolution', array("reg_no" => $regno,"session"=> $session,"rrr"=>$rrr))->row();

			$alreadyGenerated = $this->db->get_where('remita_resolution', array("rrr"=>$rrr))->row();



			if(count($alreadyGenerated) > 0){

				$_SESSION['apError'] = "You have submitted your issue already with this RRR: ".$rrr;

				redirect(base_url() . 'index.php?payment/res_old_student');

			}



			$amount = $this->db->get_where('eduportal_fee_schedule', array('fee_desc' => $prog,'level_desc' => $level,'session' => "2014/2015"))->row()->amount;

			// var_dump($amount); die("i got here");

			if ($amount != NULL){



				$data['reg_no'] = $regno;

				$data['rrr'] = trim($rrr);

				// $data['order_id'] = trim($response['orderID']);

				$data['status'] = 'Issue Created'; 

				$data['datetime'] = date("Y-m-d H:i:s"); 

				$data['amount'] = $amount;

				$data['fullname'] = $fullname;

		        $data['email'] = $email;

		        $data['phone'] = $phone;

		        $data['programme'] = $prog;

		        $data['level'] = $level;

		        //$data['description'] = $pop;

		        $data['session'] = $session;

				

				$this->db->insert('remita_resolution', $data);

				

				$_SESSION['apError'] = "You issue was submitted successfully, please print your School Fee Confirmation receipt from the Portal after 24 hours of submission. Thank you";

				

				redirect(base_url() . 'index.php?payment/res_old_student');

			}else{



				$_SESSION['apError'] = "Error: Check the data you entered.";

				

				redirect(base_url() . 'index.php?payment/res_old_student');

			}

		}else{

			$page_data['page_name']  = 'remita_res_oldstudent';



	        $page_data['page_title'] = 'HND/ND Morning';



	        $this->load->view('backend/putm', $page_data);

		}



	}



	/*This function resolves remita issues for new 2015/2016 students*/

	function res_new_student(){



		if($_POST){

			session_start();

			$portalID = strtoupper($this->input->post('putmeID'));



			$rrr = $this->input->post('rrr');

			if($rrr == "" || strlen($rrr) < 9 ){

				$_SESSION['formerror'] = 'Please Enter a Valid Remita Retrieval Reference (RRR)';

				redirect(base_url() . 'index.php?payment/res_new_student');

			} 

			if(substr($portalID, 0, 4) == 'PHND'){

				

				/*Start Student,Payment information trtrieval*/ 

				$studentDetails = $this->db->query("SELECT a.*,b.programme,b.school,b.department FROM fpnoedup_portalfp_portal.prehnd_students as a,fpnoedup_portalfp_portal.prehnd_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();

				// var_dump($studentDetails); die("I got here ..");

				if(!$studentDetails){

					$_SESSION['formerror'] = 'HND Morning Portal ID Does not exist';

					redirect(base_url() . 'index.php?payment/res_new_student');

				} 



				$pType = $studentDetails->programme;

				

				if($studentDetails->school == 'School of Business & Management Technology'){

					if($studentDetails->department == 'Office Technology and Management'){

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SBMT' ))->row();

					}

					else

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

				}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SEDT' ))->row();

				}elseif($studentDetails->school == 'School of Humanities and Social Science'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

				}elseif($studentDetails->school == 'School of Engineering Technology'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SET' ))->row();

				}elseif($studentDetails->school == 'School of Industrial and Applied Science'){

					if($studentDetails->department == 'Library Science'){

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

					}else

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS'))->row();

				}else{

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

				}



				

			}elseif (substr($portalID, 0, 3) == 'FPN') {

				$studentDetails = $this->db->get_where('nd_morning_admission_list', array("app_form_number" => $portalID))->row();

				if(!$studentDetails){

					$_SESSION['apError'] = 'ND Morning Portal ID Does not exist';

					redirect(base_url() . 'index.php?payment/res_new_student');

				}

				if($studentDetails->programme_name == "ND Morning"){

					$pType = "MORNING";

				}elseif($studentDetails->programme_name == "ND Evening"){

					$pType = "EVENING";

				}elseif($studentDetails->programme_name == "ND Weekend"){

					$pType = "WEEKEND";

				}

				

				if($studentDetails->school == 'School of Business & Management Technology'){

					if($studentDetails->department_name == 'Office Technology and Management'){

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SBMT' ))->row();

					}

					else

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

				}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SEDT' ))->row();

				}elseif($studentDetails->school == 'School of Humanities and Social Science'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

				}elseif($studentDetails->school == 'School of Engineering Technology'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SET' ))->row();

				}elseif($studentDetails->school == 'School of Industrial and Applied Science'){

					if($studentDetails->department_name == 'Library and Information Sciences'){

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

					}else

						$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS'))->row();

				}else{

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

				}

			}else{

				$_SESSION['formerror'] = 'Incorrect portal id supplied.';

				redirect(base_url() . 'index.php?payment/res_new_student');

			}



			$totalAmount = $amount->amount;

			if(substr($portalID, 0, 4) == 'PHND'){

				$payerName = $studentDetails->firstname . ' ' . $studentDetails->middlename . ' ' . $studentDetails->lastname; 

				$payerEmail = $studentDetails->email == "" ? "student@nekede.edu.ng":$studentDetails->email; 

				$payerPhone = $studentDetails->phone; 

			}elseif (substr($portalID, 0, 3) == 'FPN') {

				$payerName = $studentDetails->first_name . ' ' . $studentDetails->other_names . ' ' . $studentDetails->last_name;

				$payerEmail = $studentDetails->email; 

				$payerPhone = $studentDetails->phone; 

			}



			if($payerEmail == "" || $payerEmail ==  " "){

				$payerEmail = "student@nekede.edu.ng";

			}else{

				$payerEmail = $payerEmail;

			}

			if($payerPhone == "" || $payerPhone == " "){

				$payerPhone = "08000000000";

			}else{

				$payerPhone = $payerPhone;

			}



			/*End Student,Payment information trtrieval*/ 



			// $alreadyCreated = $this->db->get_where('remita_resolution', array("reg_no" => $portalID,"rrr"=>$rrr))->row();

			$alreadyCreated = $this->db->get_where('remita_resolution', array("rrr"=>$rrr))->row();

			

			// die("i got here");

		

			if(count($alreadyCreated) >0){

				$_SESSION['apError'] = "You have submitted your issue already with this RRR: ".$rrr;

				redirect(base_url() . 'index.php?payment/res_new_student');

				

			}else{

				$data['reg_no'] = $portalID;

				$data['rrr'] = trim($rrr);

				// $data['order_id'] = trim($response['orderID']);

				$data['status'] = 'Issue Created'; 

				$data['datetime'] = date("Y-m-d H:i:s"); 

				$data['fullname'] = strtoupper($payerName);

				$data['amount'] = $amount->amount;

		        $data['email'] = $studentDetails->email;

		        $data['phone'] = $studentDetails->phone;

		        $data['school'] = $studentDetails->school;

		        if(substr($portalID, 0, 4) == 'PHND'){

			    	$data['department'] = $studentDetails->department;

			    }elseif (substr($portalID, 0, 3) == 'FPN') {

			    	$data['department'] = $studentDetails->department_name;

			    }

		        $data['programme'] = $amount->fee_desc;

		        $data['level'] = $amount->level_desc;

		        $data['session'] = $studentDetails->session;

				

				$this->db->insert('remita_resolution', $data);

				

				$_SESSION['apError'] = "You issue was submitted successfully, please print your School Fee Confirmation receipt from the Portal after 24 hours of submission. Thank you";

				redirect(base_url() . 'index.php?payment/res_new_student');

			}

			

		}else{

			$page_data['page_name']  = 'remita_res_newstudent';



	        $page_data['page_title'] = 'HND/ND Morning';



	        $this->load->view('backend/putm', $page_data);

		}

	}



	/*Function to get the receipt view*/

	function remitaGetReceipt(){

		$this->session->set_userdata('putme_login', 1);

		

		$page_data['page_name']  = 'remitaGetReceipt';

        $page_data['page_title'] = get_phrase('Payment Confirmation');

        $this->load->view('backend/putm', $page_data);

	}



	function etranzactConfirmation(){

		

		//redirect(base_url() . 'index'); 

		

		$this->session->set_userdata('putme_login', 1);

		

		$page_data['page_name']  = 'etranzactConfirmation';

        $page_data['page_title'] = get_phrase('Weekend and Evening Students Payment Confirmation');

        $this->load->view('backend/putm', $page_data);

	}





	public function etti(){

		session_start();

		echo $this->session->userdata('etti');

		echo $_SESSION["etti"];

	}



	//function to handle remita payments for new 2015/2016 students

	function newRemita(){

		session_start();



		/*Remita Payment Details*/

		$merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

		$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

		$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();

		$gatewayUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'gateway_url'))->row();

		$statusUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'status_url'))->row();

		$responseUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'response_url'))->row();

		$gatewayRRR = $this->db->get_where('eduportal_remita_details', array("type" => 'gatewayrrrpayment_url'))->row();

		



		$portalID = strtoupper($this->input->post('putmeID'));



		if(substr($portalID, 0, 4) == 'PHND'){

		

			$studentDetails = $this->db->query("SELECT * FROM prehnd_students as a,fpnoedup_portalfp_portal.prehnd_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();

			// $studentDetails = $this->db->query("SELECT * FROM prehnd_students as a,fpnoedup_portalfp_portal.prehnd_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();

			//die;

			if(!$studentDetails){

				$_SESSION['apError'] = 'HND Morning Portal ID Does not exist';

				redirect(base_url() . 'index.php?payment/new_morning_student');

			}

	

			$pType = $studentDetails->programme;

			

			if($studentDetails->school == 'School of Business & Management Technology'){

				if($studentDetails->department == 'Office Technology and Management'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SBMT' ))->row();

				}

				else

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SEDT' ))->row();

			}elseif($studentDetails->school == 'School of Humanities and Social Science'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Engineering Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SET' ))->row();

			}elseif($studentDetails->school == 'School of Industrial and Applied Science' || $studentDetails->school == 'School of Industrial & Applied Science'){

				if($studentDetails->department == 'Library Science'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

				}else

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS'))->row();

			}else{

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

			}

			

		}elseif (substr($portalID, 0, 3) == 'FPN') {

			//echo "you are here";

			//$studentDetails = $this->db->query("SELECT * FROM prehnd_students as a,prehnd_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();

			$studentDetails = $this->db->get_where('nd_morning_admission_list', array("app_form_number" => $portalID))->row();

			if(!$studentDetails){

				$_SESSION['apError'] = 'ND Morning Portal ID Does not exist';

				redirect(base_url() . 'index.php?payment/new_morning_student');

			}

			if($studentDetails->programme_name == "ND Morning"){

				$pType = "MORNING";

			}elseif($studentDetails->programme_name == "ND Evening"){

				$pType = "EVENING";

			}elseif($studentDetails->programme_name == "ND Weekend"){

				$pType = "WEEKEND";

			}

			

			if($studentDetails->school == 'School of Business & Management Technology'){

				if($studentDetails->department_name == 'Office Technology and Management'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SBMT' ))->row();

				}

				else

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SEDT' ))->row();

			}elseif($studentDetails->school == 'School of Humanities and Social Science'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Engineering Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SET' ))->row();

			}elseif($studentDetails->school == 'School of Industrial and Applied Science'){

				if($studentDetails->department_name == 'Library and Information Sciences'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

				}else

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS'))->row();

			}else{

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}

	

		}else{

			$_SESSION['apError'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?payment/new_morning_student');

		}



		$alreadyGenerated = $this->db->get_where('eduportal_remita_temp_data', array("reg_no" => $portalID))->row();

			

		if(count($alreadyGenerated) >0){

			$_SESSION['portalID'] = $portalID;

			$this->session->set_userdata('regno',$portalID);

			$this->session->set_userdata('session',$studentDetails->session);

			redirect(base_url() . 'index.php?payment/remitaInvoice');

		}

		

		define("MERCHANTID", $merchantId->value);

		define("SERVICETYPEID", $serviceTypeId->value);

		define("APIKEY", $apiKey->value);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

				

		$totalAmount = $amount->amount;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		if(substr($portalID, 0, 4) == 'PHND'){

			$payerName = $studentDetails->firstname . ' ' . $studentDetails->middlename . ' ' . $studentDetails->lastname; 

			$payerEmail = $studentDetails->email == "" ? "student@nekede.edu.ng":$studentDetails->email; 

			$payerPhone = $studentDetails->phone; 

		}elseif (substr($portalID, 0, 3) == 'FPN') {

			$payerName = $studentDetails->first_name . ' ' . $studentDetails->other_names . ' ' . $studentDetails->last_name;

			$payerEmail = $studentDetails->email; 

			$payerPhone = $studentDetails->phone; 

		}

		

		if($payerEmail == "" || $payerEmail ==  " "){

			$payerEmail = "student@nekede.edu.ng";

		}else{

			$payerEmail = $payerEmail;

		}



		if($payerPhone == "" || $payerPhone == " "){

			$payerPhone = "08000000000";

		}else{

			$payerPhone = $payerPhone;

		}





		$responseurl = "http://162.144.134.70/nekede/remitaResponse.php";

		

		$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

		$hash = hash('sha512', $hash_string);

		$itemtimestamp = $timesammp;

		$itemid1="1".$itemtimestamp;

		$itemid2="2".$itemtimestamp;

		$itemid3="3".$itemtimestamp;

		$beneficiaryName="Gtco Calscan Nig Ltd";

		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";

		$beneficiaryName3="Gtco Calscan Nig Ltd TSHIP";

		$beneficiaryAccount="0178130137";

		$beneficiaryAccount2="0140468461017";

		$beneficiaryAccount3="5600327264";

		$bankCode="058";

		$bankCode2="000";

		$bankCode3="070";

		$beneficiaryAmount ="4500";

		$beneficiaryAmount3 ="2500";
        $totalDeductions=4500 + 2500 ;
		$beneficiaryAmount2 =$totalAmount - $totalDeductions ;

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



		$this->session->set_userdata('etti',$content);



		// var_dump($content); die();

		//die;



		$curl = curl_init(GATEWAYURL);

		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($curl, CURLOPT_HTTPHEADER,

		array("Content-type: application/json"));

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

			

			$data['reg_no'] = $portalID;

			$data['rrr'] = trim($response['RRR']);

			$data['order_id'] = trim($response['orderID']);

			$data['status'] = 'Payment Pending'; 

			$data['datetime'] = date("Y-m-d H:i:s"); 

			$data['fullname'] = $payerName;

			$data['amount'] = $amount->amount;

	        $data['email'] = $studentDetails->email;

	        $data['phone'] = $studentDetails->phone;

	        $data['school'] = $studentDetails->school;

	        if(substr($portalID, 0, 4) == 'PHND'){

		    	$data['department'] = $studentDetails->department;

		    }elseif (substr($portalID, 0, 3) == 'FPN') {

		    	$data['department'] = $studentDetails->department_name;

		    }

	        $data['programme'] = $amount->fee_desc;

	        $data['level'] = $amount->level_desc;

	        $data['session'] = $studentDetails->session;

			

			$this->db->insert('eduportal_remita_temp_data', $data);

			

			$_SESSION['portalID'] = $portalID;

			$this->session->set_userdata('regno',$portalID);

			$this->session->set_userdata('session',$studentDetails->session);

			redirect(base_url() . 'index.php?payment/remitaInvoice');

		}else{

			$_SESSION['apError'] = 'An error occured! '.$statusMsg.'. Please try again ';

			redirect(base_url() . 'index.php?payment/new_morning_student');

		}

	}



	public function my_status($param1 = ''){

		$orderId = $param1;

		if($orderId != ""){

			$merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

			$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

			$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();



			define("MERCHANTID", $merchantId->value);

			define("SERVICETYPEID", $serviceTypeId->value);

			define("APIKEY", $apiKey->value);

			define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

			define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

			//define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

			define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm");

			

			$mert =  MERCHANTID;

			$api_key =  APIKEY;

			$concatString = $orderId . $api_key . $mert;

			$hash = hash('sha512', $concatString);

			$url 	= CHECKSTATUSURL . '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';

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

			// var_dump($result);

			// die;

			// // Closing

			curl_close($ch);

			$response = json_decode($result, true);

			if($response != null ){

				echo "<pre>";

				var_dump($response);

				echo "</pre>";

			}else{

				echo "Nothing was returned";

			}

		}else{

			echo "Please insert orderID";

		}

		

	}



	public function rrrStatus(){

		/*if($this->session->userdata('userLevel') !=  2 || $this->session->userdata('userLevel') !=  '2')

			redirect(base_url() . 'index.php?login/logout');

		*/

		// error_reporting(E_ALL);

		$data['page_name'] = 'getRRRstatus';

		$data['page_title'] = get_phrase('Get RRR Status');

        $this->load->view("backend/putm", $data);

		

	}



	public function getRRRstatus(){

		/*

		if($this->session->userdata('userLevel') !=  2 || $this->session->userdata('userLevel') !=  '2')

			redirect(base_url() . 'index.php?login/logout');

		session_start();

		*/



		session_start();

		$rrr = $this->input->post('rrr');



		if(strlen($rrr) > 8){

			$merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

			$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

			$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();

			// var_dump($merchantId);

			$mert =  $merchantId->value;

			$api_key =  $apiKey->value;

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

			$orderID = $response['orderId'];

			$date = $response['transactiontime'];

			$_SESSION['msg'] = $msg;

			$_SESSION['rrr'] = $rem;

			$_SESSION['rrr2'] = $rrr;

			$_SESSION['oid'] = $orderID;

			$_SESSION['date'] = $date;

			redirect(base_url() . 'index.php?payment/rrrStatus');

		}else{

			echo "The RRR You entered is invalid";

		}

		// redirect(base_url() . 'index.php?admin/rrrStatus');

		

	}



	function remita_check($rrr){



		if(strlen($rrr) > 8){

			$merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

			$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

			$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();

			// var_dump($merchantId);

			$mert =  $merchantId->value;

			$api_key =  $apiKey->value;

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

			$orderID = $response['orderId'];

			$date = $response['transactiontime'];

			/*

			echo "<pre>";

			print_r($response);

			echo "</pre>";

			die("die");

			*/

			return $response;

		}else{

			return false;

		}

	}



	function remita_pay($param1 = '', $param2 = '', $param3 = '')

    {

    	$portalID = $this->input->post('regno');

    	if(substr($portalID, 0, 4) == 'PHND' || substr($portalID, 0, 3) == 'FPN'){ 

			//$_SESSION['apError'] = "Error: You are a new student, Please you the appopriate link";

        	redirect(base_url().'index.php?payment/new_morning_student', 'refresh');

		}



    	$session  = $this->input->post('session');

    	$fname = $this->input->post('fname');

    	$surname = $this->input->post('surname');

    	$fullname = $surname.', '.$fname;

        $email = $this->input->post('email');

        $phone = $this->input->post('phone');

        $regno = $this->input->post('regno');//reg no

        $prog = $this->input->post('prog');//programme type

        $level = $this->input->post('level');//course type

        session_start();



        if(isset ($email) && strlen($email) && ($phone) && strlen($phone)  && ($session) && strlen($session)  && ($regno) && strlen($regno) && ($fname) 

        	&& strlen($fname) && ($prog) && strlen($prog) && ($surname) && strlen($surname) && ($level) && strlen($level) ) {

		    //return true;

		}

		else {

			$_SESSION['error'] = 'All form fields are required.';

			redirect(base_url() . 'index.php?payment/morning_student');

		    //return false;

		}//$pop = $session.' School Fees';//purpose of payment



		

		//check if student generated rrr already

		$alreadyGenerated = $this->db->get_where('eduportal_remita_temp_data', array("reg_no" => $regno,"session"=> $session))->row();

		

		if(count($alreadyGenerated) > 0){

			$this->session->set_userdata('regno',$regno);

			$this->session->set_userdata('session',$session);

			redirect(base_url() . 'index.php?payment/remitaInvoice_nek');

		}





        $merchantId = $this->db->get_where('eduportal_remita_details', array("type" => 'merchant_id'))->row();

		$serviceTypeId = $this->db->get_where('eduportal_remita_details', array("type" => 'service_type_id'))->row();

		$apiKey = $this->db->get_where('eduportal_remita_details', array("type" => 'api_key'))->row();

		$gatewayUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'gateway_url'))->row();

		$statusUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'status_url'))->row();

		$responseUrl = $this->db->get_where('eduportal_remita_details', array("type" => 'response_url'))->row();

		$gatewayRRR = $this->db->get_where('eduportal_remita_details', array("type" => 'gatewayrrrpayment_url'))->row();

		$amount = $this->db->get_where('eduportal_fee_schedule', array('fee_desc' => $prog,'level_desc' => $level,'session' => "2014/2015"))->row()->amount;

		//$amount = $this->db->get_where('eduportal_fee_schedule', array('programme' => $prog,'level' => $level,'session' => "2014/2015"))->row()->amount;



		//var_dump($amount) and die("Dev in progress, Try again in 20m");

		$this->session->set_userdata("etti",$amount);

		$_SESSION["etti"] = $amount;

        

		if ($amount != NULL){



			define("MERCHANTID", $merchantId->value);

			define("SERVICETYPEID", $serviceTypeId->value);

			define("APIKEY", $apiKey->value);

			define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

			define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

			define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

					

			$totalAmount = $amount;

			$timesammp=DATE("dmyHis");		

			$orderID = $timesammp;

			$payerName  = $fullname; 

			$payerEmail = $email; 

			$payerPhone = $phone; 

			$responseurl = "http://162.144.134.70/nekede/remitaResponse.php";

			

			$hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;

			$hash = hash('sha512', $hash_string);

			$itemtimestamp = $timesammp;

			$descr = $session." school fees for FPNO";

			$itemid1="itemid1";

			$itemid2="34444".$itemtimestamp;

			$itemid3="8694".$itemtimestamp;

			$beneficiaryName="Gtco Calscan Nig Ltd";

			$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";

			//$beneficiaryName3="POLY MEDICARE COLLECTION ACCOUNT";

			$beneficiaryAccount="0178130137";

			$beneficiaryAccount2="0140468461017";

			//$beneficiaryAccount3="0042738797";

			$bankCode="058";

			$bankCode2="000";

			//$bankCode3="033";

			$beneficiaryAmount ="4500";

			//$beneficiaryAmount3 ="2500";

			$beneficiaryAmount2 =$amount - $beneficiaryAmount ;

			$deductFeeFrom=1;

			$deductFeeFrom2=0;

			//$deductFeeFrom3=0;

			//The JSON data.

			$content = '{"merchantId":"'. MERCHANTID

			.'"'.',"serviceTypeId":"'.SERVICETYPEID

			.'"'.",".'"totalAmount":"'.$totalAmount

			.'"'.",".'"description":"'.$descr

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



			



			$curl = curl_init(GATEWAYURL);

			curl_setopt($curl, CURLOPT_HEADER, false);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($curl, CURLOPT_HTTPHEADER,

			array("Content-type: application/json"));

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

				

				$data['reg_no'] = $regno;

				$data['rrr'] = trim($response['RRR']);

				$data['order_id'] = trim($response['orderID']);

				$data['status'] = 'Payment Pending'; 

				$data['datetime'] = date("Y-m-d H:i:s"); 

				$data['amount'] = $amount;

				$data['fullname'] = $fullname;

		        $data['email'] = $email;

		        $data['phone'] = $phone;

		        $data['programme'] = $prog;

		        $data['level'] = $level;

		        //$data['description'] = $pop;

		        $data['session'] = $session;

				

				$this->db->insert('eduportal_remita_temp_data', $data);

				

				$this->session->set_userdata('regno',$regno);

				$this->session->set_userdata('session',$session);

				redirect(base_url() . 'index.php?payment/remitaInvoice_nek');

			}else{

				$_SESSION['error'] = 'An error occured! '.$statusMsg.'. Please try again ';

				redirect(base_url() . 'index.php?payment/morning_student');

			}

		} else{

        	$_SESSION['error'] = "Error: There was a problem generating an invoice...";

        	redirect(base_url().'index.php?payment/morning_student', 'refresh');   

        }

    }



    function remitaInvoice(){

		$page_data['page_name']  = 'newRemitaInvoice';

        $page_data['page_title'] = get_phrase('Remita Invoice');

        $this->load->view('backend/payment_print', $page_data);

	}



	function remitaInvoice_nek(){

		$page_data['page_name']  = 'remitaInvoice';

        $page_data['page_title'] = get_phrase('Remita Invoice');

        $this->load->view('backend/payment_print', $page_data);

	}



	/*New fee payment with payee_id*/

    function pay_fees($param1 = '', $param2 = '', $param3 = '')

    {

        //if ($this->session->userdata('student_login') == 1)

            //redirect(base_url(), 'refresh');

    	session_start();

        $portal_id = $this->session->userdata('portal_id');

        $payee_id = $this->generateAptID();

        $portalID = $this->input->post('regno');



		if(substr($portalID, 0, 4) == 'PHND' || substr($portalID, 0, 3) == 'FPN'){ 

			//$_SESSION['apError'] = "Error: You are a new student, Please you the appopriate link";

        	redirect(base_url().'index.php?payment/new_evening_student', 'refresh');

		}

        if($param1 == 'start'){

            

        $session  = $this->input->post('session');//academic session

      	$fname = $this->input->post('fname');

      	$surname = $this->input->post('surname');

        $fullname = $this->input->post('surname').', '.$this->input->post('fname');

        $email = $this->input->post('email');

        $state = $this->input->post('state');

        $phone = $this->input->post('phone');

        $regno = $this->input->post('regno');//reg no

        $prog = $this->input->post('prog');//programme type

        $level = $this->input->post('level');//course type



        if(isset ($email) && strlen($email) && ($phone) && strlen($phone) && ($session) && strlen($session) && ($regno) && strlen($regno) && ($fname) 

        	&& strlen($fname) && ($prog) && strlen($prog) && ($surname) && strlen($surname) && ($level) && strlen($level) ) {

		    //return true;

		}

		else {

			$_SESSION['error'] = 'All form fields are required.';

			redirect(base_url() . 'index.php?payment/evening_student');

		    //return false;

		}



        $pop = $this->db->get_where('settings' , array('type'=>'payment_type'))->row()->description;;//purpose of payment

        $amt = $this->db->get_where('eduportal_fee_schedule', array('fee_desc' => $prog,'level_desc' => $level))->row()->amount;

        //$amt = $this->db->get_where('fees_schedule', array('programme' => $prog,'level' => $level,'session' => "2014/2015"))->row()->amount;

       

        if($amt != NULL){



        	$alreadyGenerated = $this->db->get_where('nekede_etranzact_payment', array("portal_id" => $regno,"session"=> $session))->row();

				

			if(count($alreadyGenerated) > 0){

				$this->session->set_userdata('regno',$regno);

				$this->session->set_userdata('session',$session);

				$this->session->set_userdata('pid',$alreadyGenerated->payee_id);

				redirect(base_url() . 'index.php?payment/payeeprintout');

			}



	        $this->session->set_userdata('pid',$payee_id);



	        $data['payee_id'] = $payee_id;

	        $data['portal_id'] = $regno;

	        $data['fullname'] = $fullname;

	        $data['email'] = $email;

	        $data['phone'] = $phone;

	        $data['programme'] = $prog;

	        $data['level'] = $level;

	        $data['description'] = $pop;

	        $data['status'] = 'NOT PAID';

	        $data['amount'] = $amt;

	        $data['session'] = $session;

	             

	        $this->db->insert('nekede_etranzact_payment', $data); 



	        redirect(base_url().'index.php?payment/payeeprintout', 'refresh');    

        } else{

        	$_SESSION['error'] = "Error: There was a problem generating an invoice.";

        	redirect(base_url().'index.php?payment/evening_student', 'refresh');   

        }



        }



    }



    /*New fee payment with payee_id on etranzct for new students*/

    function new_pay_fees($param1 = '', $param2 = '', $param3 = '')

    {

    	session_start();

        $portal_id = $this->session->userdata('portal_id');

        $payee_id = $this->generateAptID();



        if($param1 == 'start'){

        $portalID = $this->input->post('putmeID');



        if(substr($portalID, 0, 4) == 'PHND'){



		$studentDetails = $this->db->query("SELECT * FROM prehnd_students as a,fpnoedup_portalfp_portal.prehnd_evening_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();



		if(count($studentDetails) < 1){

			$studentDetails = $this->db->query("SELECT * FROM prehnd_students as a,fpnoedup_portalfp_portal.prehnd_weekend_admission_list as b where a.putme_id = b.putme_id and b.putme_id = "."'$portalID'"."")->row();

			

			if(count($studentDetails) < 1){

			$_SESSION['apError'] = "Error: Portal ID Doesn't exist, Invalid PortalID Supplied";

        	redirect(base_url().'index.php?payment/new_evening_student', 'refresh');

			}

		}



		$pType = $studentDetails->programme;

		

		if($studentDetails->school == 'School of Business & Management Technology'){

			if($studentDetails->department == 'Office Technology and Management'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SBMT' ))->row();

			}

			else

			$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

		}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

			$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SEDT' ))->row();

		}elseif($studentDetails->school == 'School of Humanities and Social Science'){

			$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

		}elseif($studentDetails->school == 'School of Engineering Technology'){

			$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SET' ))->row();

		}elseif($studentDetails->school == 'School of Industrial and Applied Science' || $studentDetails->school == 'School of Industrial & Applied Science'){

			if($studentDetails->department == 'Library Science'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

			}else

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'SIAS'))->row();

		}else{

			$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "HND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'HND', "faculty" => 'OTHERS' ))->row();

		}



        $fullname = $studentDetails->firstname . ' ' . $studentDetails->middlename . ' ' . $studentDetails->lastname; 

    	}elseif (substr($portalID, 0, 3) == 'FPN') {



    		$studentDetails = $this->db->get_where('nd_evening_admission_list', array("app_form_number" => $portalID))->row();

			if(!$studentDetails){

				$_SESSION['apError'] = 'ND Evening/Weekend Portal ID Does not exist';

				redirect(base_url() . 'index.php?payment/new_morning_student');

			}

			if($studentDetails->programme_name == "ND Morning"){

				$pType = "MORNING";

			}elseif($studentDetails->programme_name == "ND Evening"){

				$pType = "EVENING";

			}elseif($studentDetails->programme_name == "ND Weekend"){

				$pType = "WEEKEND";

			}

			

			if($studentDetails->school == 'School of Business & Management Technology'){

				if($studentDetails->department_name == 'Office Technology and Management'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SBMT' ))->row();

				}

				else

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Environmental and Design Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SEDT' ))->row();

			}elseif($studentDetails->school == 'School of Humanities and Social Science'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}elseif($studentDetails->school == 'School of Engineering Technology'){

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SET' ))->row();

			}elseif($studentDetails->school == 'School of Industrial and Applied Science'){

				if($studentDetails->department_name == 'Library and Information Sciences'){

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS', "department" => "Library Science"  ))->row();

				}else

					$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'SIAS'))->row();

			}else{

				$amount = $this->db->get_where('eduportal_fee_schedule', array("level_desc" => "ND I","programme_type"=> $pType,"session" => "2014/2015","programme" => 'ND', "faculty" => 'OTHERS' ))->row();

			}



			$fullname = $studentDetails->first_name . ' ' . $studentDetails->other_names . ' ' . $studentDetails->last_name;



    	}else{

			$_SESSION['apError'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?payment/new_evening_student');

		}





        $email = $studentDetails->email;

        $phone = $studentDetails->phone;

        $regno = $portalID;//reg no

        //$level = $this->input->post('level');//course type

        $pop = $this->db->get_where('settings' , array('type'=>'payment_type'))->row()->description;;//purpose of payment

        //var_dump($amount);

        //break;

        if($amount->amount != NULL){



        	$alreadyGenerated = $this->db->get_where('nekede_etranzact_payment', array("portal_id" => $regno,"session"=> $studentDetails->session))->row();

				

			if(count($alreadyGenerated) > 0){



		        $data['faculty'] = $studentDetails->school;

			    if(substr($portalID, 0, 4) == 'PHND'){

			    	$data['department'] = $studentDetails->department;

			    }elseif (substr($portalID, 0, 3) == 'FPN') {

			    	$data['department'] = $studentDetails->department_name;

			    }

		        $data['programme'] = $amount->fee_desc;

		        $data['description'] = $pop;

		        $data['status'] = 'NOT PAID';

		        $data['amount'] = $amount->amount;

		        $data['level'] = $amount->level_desc;

		        $data['session'] = $studentDetails->session;



		        $this->db->where('portal_id', $regno);

				$this->db->update('nekede_etranzact_payment', $data);

				

				$this->session->set_userdata('pid',$alreadyGenerated->payee_id);



				redirect(base_url().'index.php?payment/payeeprintout', 'refresh');  



			}



	        $this->session->set_userdata('pid',$payee_id);



	        $data['payee_id'] = $payee_id;

	        $data['portal_id'] = $regno;

	        $data['fullname'] = $fullname;

	        $data['email'] = $email;

	        $data['phone'] = $phone;

	        $data['faculty'] = $studentDetails->school;

		    if(substr($portalID, 0, 4) == 'PHND'){

		    	$data['department'] = $studentDetails->department;

		    }elseif (substr($portalID, 0, 3) == 'FPN') {

		    	$data['department'] = $studentDetails->department_name;

		    }

	        $data['programme'] = $amount->fee_desc;

	        $data['description'] = $pop;

	        $data['status'] = 'NOT PAID';

	        $data['amount'] = $amount->amount;

	        $data['level'] = $amount->level_desc;

	        $data['session'] = $studentDetails->session;

	             

	        $this->db->insert('nekede_etranzact_payment', $data); 



	        redirect(base_url().'index.php?payment/payeeprintout', 'refresh');    

        } else{

        	$_SESSION['apError'] = "Error: There was a problem generating an invoice..";

        	redirect(base_url().'index.php?payment/new_evening_student', 'refresh');   

        }



        }



    }



    function processFeeConfirmation(){

		

		

		$payee_id = $this->input->post('payee_id');

		

		$spayee_id = strtolower(substr($payeeID, 0, 3));



		if($payee_id == '' || $payee_id == ' ' || strlen($payee_id) != 12){

			session_start();

			$_SESSION['apError'] = 'Incorrect payee id supplied.';

			redirect(base_url() . 'index.php?payment/etranzactConfirmation');

		}

		//$terminalID = $this->db->get_where('prehnd_settings', array('settings' => 'ewe_terminal_id'))->row()->value;

		$terminalID ='7630000003';

		//confirm if payee id is registered.

		$regpayee = $this->db->get_where('nekede_etranzact_payment', array('payee_id' => $payee_id))->row();

		

		if($regpayee){

		

			//start etranzact

			$this->load->library('etranzact'); 

			$this->etranzact->set_terminal($terminalID);//message from textfield

			$this->etranzact->set_conf($this->input->post('confirm_code'));//message from textfield

			   

			$this->etranzact->send();



			 if($this->etranzact->get_status() != "-1" && $this->etranzact->get_status() != "00" && strlen($this->etranzact->get_confirm()) > 3){



				//check amount also

				if($payee_id == $this->etranzact->get_customer()){

			

					$data['receipt_no'] = $this->etranzact->get_receipt();//

					$data['bankcode'] = $this->etranzact->get_bankcode();//

					$data['bankname'] = $this->etranzact->get_bankname();//

					$data['branchcode'] = $this->etranzact->get_branchcode();//

					$data['confirm_code'] = $this->etranzact->get_confirm();//

					//$data['amount'] = $this->etranzact->get_amount();

					$data['description'] = $this->etranzact->get_descr();

					$data['payment_confirmation_date'] = $this->etranzact->get_date();//

					//$data['payee_id'] = $this->etranzact->get_customer();

					$data['payment_method'] = 'Bank';//

					$data['status'] = 'PAID';//

					//$data['putme_id'] = $portalID->putme_id;

					

					//$data2['payment_status'] = 'PAID';

					//$data2['putme_id'] = $portalID->putme_id;

					

					//$this->db->insert('prehnd_accp_etranzact_data', $data);

					$this->db->where('payee_id', $this->etranzact->get_customer());

					$this->db->update('nekede_etranzact_payment', $data);

					//var_dump($data);

					

					$this->session->set_userdata('putme_login', '1');

					

					session_start();

					$_SESSION['step6'] = '6';

					$_SESSION['evening'] = 1;

					$_SESSION['payeeID'] = $this->etranzact->get_customer();

					$_SESSION['rrr'] = $this->etranzact->get_customer();

					$_SESSION['portalID'] = $regpayee->portal_id;

					redirect(base_url() . 'index.php?payment/etranzactReceipt');

					

				}else{

					session_start();

					$_SESSION['payeeError'] = 'The supplied payee ID is not registered to the supplied confirmation code.'.$this->etranzact->get_customer().' '.$this->etranzact->get_confirm();

					redirect(base_url() . 'index.php?payment/etranzactConfirmation');

				}	

			}else{

				session_start();

				$_SESSION['payeeError'] = 'The Confirmation Code is invalid.';

				redirect(base_url() . 'index.php?payment/etranzactConfirmation');

			}

		}else{

			session_start();

			$_SESSION['payeeError'] = 'Payee ID is not yet registered.';

			redirect(base_url() . 'index.php?payment/etranzactConfirmation');

		}

	}



	/*Function to get payment confirmation details*/

	function processRemitaReceipt(){

		session_start();

		// error_reporting(E_ALL);

		$rrr = $this->input->post('rrr');

		$existingRRR1 = $this->db->get_where('eduportal_remita_temp_data', array("rrr" => $rrr))->row();

		if(count($existingRRR1) > 0){

			//check if rrr number exists in the remita payment table

			$existingRRR = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();

			$response = $this->remita_check($rrr);

			$status = $response["message"];

			// die;

			if(count($existingRRR) > 0){

				

				// $rrr = $this->db->get_where('eduportal_remita_temp_data', array("rrr" => $rrr))->row();

				$_SESSION['portalID'] = $existingRRR1->reg_no;

				$_SESSION['putmeID'] = $existingRRR1->reg_no;

				$_SESSION['rrr'] = $existingRRR->rrr;

				$_SESSION['step6'] = 6;

				$this->session->set_userdata('paymentMethod', 'Bank');

				redirect(base_url() . 'index.php?payment/remitaReceipt');

			}else if($status == "Approved"){

				$data["order_ref"] = $response["orderId"];

				$data["payer_name"] = $existingRRR1->fullname;

				$data["payer_email"] = $existingRRR1->email;

				$data["payer_phone"] = $existingRRR1->phone;

				$data["amount"] = $response["amount"];

				$data["trans_date"] = $response["transactiontime"];

				$data["date_sent"] = date("Y-m-d");

				$data["rrr"] = $response["RRR"];



				$this->db->where('rrr', $response["rrr"]);

				$this->db->update('eduportal_remita_temp_data', array("status"=>"Payment Confirmed"));



				$this->db->insert('eduportal_remita_payment', $data);



				$_SESSION['portalID'] = $existingRRR1->reg_no;

				$_SESSION['putmeID'] = $existingRRR1->reg_no;

				$_SESSION['rrr'] = $existingRRR1->rrr;

				$_SESSION['step6'] = 6;

				$this->session->set_userdata('paymentMethod', 'Bank');

				redirect(base_url() . 'index.php?payment/remitaReceipt');

			}else{

				session_start();

					$_SESSION['apError'] = 'Your receipt is not yet ready! Please try again later';

					redirect(base_url() . 'index.php?payment/remitaGetReceipt');

			}

		}else{

			session_start();

			$_SESSION['apError'] = 'The Remita Retrieval Reference you entered was not found in our Records. Kindly Register Again!';

			redirect(base_url() . 'index.php?payment/remitaGetReceipt');	

		}

	}



	function ssceresult(){

		if ($this->session->userdata('putme_login') != 1)

            redirect(base_url(), 'refresh');

		

		session_start();

        if(!isset($_SESSION['step6'])){

            $_SESSION['reprintError'] = "You've not completed your registration";

            redirect(base_url() . 'index.php?putme/continueRegistrationView');

        }

		

		$page_data['page_name']  = 'ssce_result';

        $page_data['page_title'] = get_phrase('SSCE Result');

        $this->load->view('backend/index', $page_data);

	}



	function remitaReceipt(){

		$page_data['page_name']  = 'remitaReceipt';

        $page_data['page_title'] = get_phrase('Receipt Printout');

        $this->load->view('backend/payment_print', $page_data);

	}



	function etranzactReceipt(){

		$page_data['page_name']  = 'etranzactReceipt';

        $page_data['page_title'] = get_phrase('Receipt Printout');

        $this->load->view('backend/payment_print', $page_data);

	}



    private function generateAptID(){



        $num = mt_rand(100000, 999999);

        $num2 = mt_rand(1000000, 9999899);



        $paymentMethod = $this->session->userdata('paymentMethod') == 'Bank' ? 1 : 2;



        return 'NEK' . $paymentMethod . substr(Date('Y'), 2) .$num ;//. substr($num2, 2);

        //return 'NEK' . $paymentMethod . substr(Date('Y'), 2) . DATE("mdHis");//$num ;//. substr($num2, 2);



    }



    public function seeGen(){

    	$payee_id = $this->generateAptID();

    	echo $payee_id;

    }



    public function payeeprintout($param1=''){



        //if ($this->session->userdata('student_login') != 1)

            //redirect(base_url(), 'refresh');



        if ($this->session->userdata('pid') == '' && empty($param1))

            redirect(base_url() . 'index.php?payment/evening_student', 'refresh');

      

        //session_start();

        $payee_id = $this->session->userdata('pid') != null? $this->session->userdata('pid') : $param1;

        $page_data['printout'] = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $payee_id))->row();   



        //$_SESSION['payeeID'] = $payeeID->payee_id;

        $page_data['page_name']  = 'bankprintout';

        $page_data['page_title'] = get_phrase('Printout For Bank Payment');

        $this->load->view('backend/payment_print', $page_data);



    }



    public function new_payeeprintout($param1=''){



        //if ($this->session->userdata('student_login') != 1)

            //redirect(base_url(), 'refresh');



        if ($this->session->userdata('pid') == '' && empty($param1))

            redirect(base_url() . 'index.php?payment/new_evening_student', 'refresh');



      

        //session_start();

        $payee_id = $this->session->userdata('pid') != null? $this->session->userdata('pid') : $param1;

        $page_data['printout'] = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $payee_id))->row();   



        //$_SESSION['payeeID'] = $payeeID->payee_id;

        $page_data['page_name']  = 'new_bankprintout';

        $page_data['page_title'] = get_phrase('Printout For Bank Payment');

        $this->load->view('backend/payment_print', $page_data);



    }



}
