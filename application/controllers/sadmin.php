<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');






class Sadmin extends CI_Controller

{





	function __construct()

	{

		parent::__construct();
		//$this->session->sess_destroy();
		$this->load->database();


       /*cache control*/

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');



    }



    /***default functin, redirects to login page if no admin logged in yet***/

    public function index()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');

        if ($this->session->userdata('sadmin_login') == 1)

            redirect(base_url() . 'index.php?sadmin/dashboard', 'refresh');

    }

	function app_system_name(){
		$sys_name = $this->db->get_where('settings', array("type" => 'system_name'))->row();
		return $sys_name->description;
	}
    
    function bursaryPayment(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'bursaryPayment';
        $page_data['page_title'] = get_phrase('Bursary Payment');
        $this->load->view('backend/index', $page_data);
    }
	
	function incomingMails(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'incoming_mails';
        $page_data['page_title'] = get_phrase('Inbox');
        $this->load->view('backend/index', $page_data);
    }
	
	function composeMail(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'compose_mail';
        $page_data['page_title'] = get_phrase('Compose');
        $this->load->view('backend/index', $page_data);
    }
	
	function schedule_meeting(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'schedule_meeting';
        $page_data['page_title'] = get_phrase('schedule_meeting');
        $this->load->view('backend/index', $page_data);
    }
	
	
	 function meeting($memo_option,$memo_id='',$MEMO_TRACKING_NO="")

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         
           
           if($memo_option=='PROCESS_SCHEDULE_MEETING'){
                                       
           $data['meeting_title']       = $this->input->post('meeting_title');
            $data['meeting_agenda']       = $this->input->post('meeting_agenda');
            $data['time_from']        =     $this->input->post('date_from').' '.$this->input->post('time_from');
            $data['time_to']            =   $this->input->post('date_to').' '.$this->input->post('time_to');
            $data['attendees']    =         $this->input->post('attendees');
            $data['venue']        =         $this->input->post('officelocation');
			
			//$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
//$sid=$login_details->sid;

			 $data['created_by']        =        $this->session->userdata('sadmin_id');
			 $data['requested_by']        =         $this->input->post('sid');
            $enable_zoom=                   $this->input->post('enable_zoom');
			if(!$enable_zoom)
			{
				$enable_zoom=0;
			}
			
            $data['enable_zoom']        =$enable_zoom ;
			$data['created_by_mda_unit_id']            = $this->session->userdata('dept_id');
            $data['created_by_mda_id']           = $this->session->userdata('unit_sch_id');
            
			$data['mda_id']       = $this->input->post('factId');
            $data['mda_unit_id']       = $this->input->post('depts');
			
            $data['time_created']        = date("Y-m-d H:i:s");
            $meeting_uid=time();
			$data['meeting_uid']        = $meeting_uid;
			$data['meeting_type'] =       $this->input->post('location');
			$mtype= $this->input->post('location');
			if($mtype=="Virtual"){
            $data['meeting_link']        = base_url()."index.php?sadmin/startvirtualmeetings/".$meeting_uid;
			}
            $this->db->insert('erp_meetings',$data);
  if($this->input->post('attendees')=="Restricted")
  {
     
	  $invitees=$this->input->post('invitee');
			foreach($invitees as $cc)
			{
				//echo $cc;
			
			$data2['meeting_id'] = $meeting_uid;
			$data2['invitee_id'] = $cc;
			$this->db->insert('erp_meeting_invitees',$data2);
			}
  }     
         $this->session->set_flashdata('message' , get_phrase('meeting_created_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/view_meetings');	
              
       }
	   
	   
	   
	   
	}
	
	function view_meetings(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'view_meetings';
        $page_data['page_title'] = get_phrase('view_meetings');
        $this->load->view('backend/index', $page_data);
    }
	
	function start_meeting($id){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$meeting_details = $this->db->get_where('erp_meetings',array('meeting_uid'=>$id))->row();
		
		$data2["status"] = "Commenced";
		$this->db->where('id', $meeting_details->id);
		    $this->db->update('erp_meetings', $data2);
		
		redirect($meeting_details->meeting_link, 'refresh');
		// $page_data['page_name']  = 'update_file';
        // $page_data['page_title'] = get_phrase('update_file');
        // $this->load->view('backend/index', $page_data);
    }
	
	function end_meeting($id){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$meeting_details = $this->db->get_where('erp_meetings',array('meeting_uid'=>$id))->row();
		
		$data2["status"] = "Ended";
		$this->db->where('id', $meeting_details->id);
		    $this->db->update('erp_meetings', $data2);
		
		redirect(base_url() . 'index.php?sadmin/view_meetings');	
		// $page_data['page_name']  = 'update_file';
        // $page_data['page_title'] = get_phrase('update_file');
        // $this->load->view('backend/index', $page_data);
    }
	
	
	function startvirtualmeetings($meeting_id){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'meeting_panel';
		$page_data['meeting_id']  = $meeting_id;
        $page_data['page_title'] = get_phrase('Meeting Panel');
        $this->load->view('backend/index', $page_data);
    }
	
	function add_new_file(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'add_new_file';
        $page_data['page_title'] = get_phrase('add_new_file');
        $this->load->view('backend/index', $page_data);
    }
	
	function update_file($id){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['file_details'] = $this->db->get_where('erp_documents',array('id'=>$id))->result_array();
		$page_data['page_name']  = 'update_file';
        $page_data['page_title'] = get_phrase('update_file');
        $this->load->view('backend/index', $page_data);
    }
	
	
	      function filedms($file_option,$file_id='',$TRACKING_NO="")

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
            $dept_id         = $this->session->userdata('dept_id');
            $sch_id          = $this->session->userdata('unit_sch_id');
            $desig_id        = $this->session->userdata('desig_id');
          
          
         
           
           if($file_option=='PROCESS_ADD_NEW_FILE'){
            $send_memo_sid=$this->input->post('sid');
            $dept=$this->input->post('depts');
            $min=$this->input->post('factId');
            $short_description=$this->input->post('short_description');
			
			$staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$send_memo_sid))->row();
            $dept_id_act  = $this->db->get_where('erp_depts', array('dept_code' =>$dept_code))->row()->dept_id;                              
           
            $data['document_name']          = $this->input->post('document_name');
			 $data['document_type']          = $this->input->post('document_type');
			
			 $data['date_uploaded']          = date("Y-m-d H:i:s");
			 $data['file_no']          = $this->input->post('file_no');
			if(!$this->input->post('file_no'))
			{
			 $data['file_no'] ="FILE/".time();
			}
            $data['uploaded_by']        = $this->session->userdata('sid');
            
            
			$data['size']          = $_FILES["file_name"]["size"];
			$data['ministry_id']          = $min;
			$data['addressed_to_id']          = $send_memo_sid;
			$data['waiting_approval_by']          = $send_memo_sid;
			
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_details->desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$staff_details->dept_id))->row()->deptName;
			
			$data['address_to_details']          = $staff_details->name."($designation - $dept_name)";
			$data['short_description']          = $short_description;
			$data['unit_dept_id']          = $dept;
			
            $data['upload_doc_path']        = "uploads/documents/". $_FILES["file_name"]["name"];
        
            $this->db->insert('erp_documents',$data);
  
        //$attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/documents/" . $_FILES["file_name"]["name"]);

        
         $this->session->set_flashdata('message' , get_phrase('file_uploaded_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/view_track_files');	
              
       }
	   
	       if($file_option=='PROCESS_MINUTE_FILE'){
           
		   $sid=$this->input->post('sid');
            
			$file_id =$this->input->post('file_id');
			
            $short_description=$this->input->post('short_description');
			$minute= $this->input->post('minute');
			$status= $this->input->post('status');                         
           
            $data['file_id']          = $file_id;
			$data['minuted_by']          = $this->session->userdata('sadmin_id');
			
			$staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$this->session->userdata('sadmin_id')))->row();
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_details->desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$staff_details->dept_id))->row()->deptName;
			
			$minutes = $this->db->query("select top(1) minute from erp_documents_minutes where file_id='$file_id' order by id DESC")->row()->minute;
			
			
			$data['minute']          = $minutes.$staff_details->name."($designation - $dept_name): ".$minute."</br>";
			
			$data['minuted_to']          = $sid;
			$data['minute_action']          = $status;
			
			$data['date_minuted'] =date("Y-m-d H:i:s");
			
			
        
            $this->db->insert('erp_documents_minutes',$data);
			
			$data2['status'] =$status;
			$data2['waiting_approval_by']          = $sid;
			$data2['minutes']          = $minutes.$staff_details->name."($designation - $dept_name): ".$minute."</br>";
			 $data2['last_minuted_by']                        = $staff_details->name."($designation - $dept_name)";
			$this->db->where('id', $file_id);
		    $this->db->update('erp_documents', $data2);
  
        //$attachment_id        = $this->db->insert_id();
          
         $this->session->set_flashdata('message' , get_phrase('file_uploaded_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/view_track_files');	
              
       }
	   
	   if($file_option=='sendtoarchive'){
           
		   $sid=$this->session->userdata('sadmin_id');
            
		                        
           
            $data['file_id']          = $file_id;
			$data['minuted_by']          = $this->session->userdata('sadmin_id');
			
			$staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$this->session->userdata('sadmin_id')))->row();
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_details->desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$staff_details->dept_id))->row()->deptName;
			
			$minutes = $this->db->query("select top(1) minute from erp_documents_minutes where file_id='$file_id' order by id DESC")->row()->minute;
			
			
			$data['minute']          = $minutes.$staff_details->name."($designation - $dept_name): Sent File to Archive</br>";
			
			$data['minuted_to']          = $sid;
			$data['minute_action']          = "ARCHIVED";
			
			$data['date_minuted'] =date("Y-m-d H:i:s");
			
			
        
            $this->db->insert('erp_documents_minutes',$data);
			
			$data2['status'] ="ARCHIVED";
			$data2['waiting_approval_by']          = $sid;
			$data2['minutes']          = $minutes.$staff_details->name."($designation - $dept_name): Sent File to Archive</br>";
			 $data2['last_minuted_by']                        = $staff_details->name."($designation - $dept_name)";
			$this->db->where('id', $file_id);
		    $this->db->update('erp_documents', $data2);
  
        //$attachment_id        = $this->db->insert_id();
          
         $this->session->set_flashdata('message' , get_phrase('file_uploaded_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/view_track_files');	
              
       }
	   
	   if($file_option=='PROCESS_SHARE_FILE'){
           
		   $sid=$this->input->post('sid');
            
			$file_id =$this->input->post('file_id');
			
         //   $short_description=$this->input->post('short_description');
			$minute= $this->input->post('minute');
			$status= $this->input->post('status');                         
           
            $data['file_id']          = $file_id;
			$data['minuted_by']          = $this->session->userdata('sadmin_id');
			
			$staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$this->session->userdata('sadmin_id')))->row();
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_details->desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$staff_details->dept_id))->row()->deptName;
			
			//$minutes = $this->db->query("select top(1) minute from erp_documents_minutes where file_id='$file_id' order by id DESC")->row()->minute;
			
			
			$data['minute']          = $staff_details->name."($designation - $dept_name): ".$minute."</br>";
			
			$data['minuted_to']          = $sid;
			$data['minute_action']          = $status;
			
			$data['date_minuted'] =date("Y-m-d H:i:s");
			
			
        
            $this->db->insert('erp_documents_minutes',$data);
			
			/* $data2['status'] =$status;
			$data2['waiting_approval_by']          = $sid;
			$data2['minutes']          = $minutes.$staff_details->name."($designation - $dept_name): ".$minute."</br>";
			 $data2['last_minuted_by']                        = $staff_details->name."($designation - $dept_name)";
			$this->db->where('id', $file_id);
		    $this->db->update('erp_documents', $data2); */
  
        //$attachment_id        = $this->db->insert_id();
          
         $this->session->set_flashdata('message' , get_phrase('file_uploaded_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/view_track_files');	
              
       }
	   
	    if($file_option=='filedetails'){
			
		
		$page_data['file_details'] = $this->db->get_where('erp_documents',array('id'=>$file_id))->result_array();

        $page_data['page_name']  = 'display_file_details';

        $page_data['page_title'] = get_phrase('file_details');

        $this->load->view('backend/index', $page_data);
		
		}
		
		if($file_option=='treatfile'){
			
			$page_data['file_details'] = $this->db->get_where('erp_documents',array('id'=>$file_id))->result_array();

        $page_data['page_name']  = 'treat_file';

        $page_data['page_title'] = get_phrase('treat_/_minute_file');

        $this->load->view('backend/index', $page_data);
		}
		
		if($file_option=='sharefile'){
			
			
			$page_data['file_details'] = $this->db->get_where('erp_documents',array('id'=>$file_id))->result_array();

        $page_data['page_name']  = 'share_file';

        $page_data['page_title'] = get_phrase('share_file');

        $this->load->view('backend/index', $page_data);
		
		}
	   
	}
	function view_all_files(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'view_all_files';
        $page_data['page_title'] = get_phrase('view_all_files');
        $this->load->view('backend/index', $page_data);
    }
	
	function view_treated_files(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'view_treated_files';
        $page_data['page_title'] = get_phrase('treated_files');
        $this->load->view('backend/index', $page_data);
    }
	
	function view_untreated_files(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'view_untreated_files';
        $page_data['page_title'] = get_phrase('untreated_files');
        $this->load->view('backend/index', $page_data);
    }
	
	function view_track_files(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'view_track_files';
        $page_data['page_title'] = get_phrase('view_uploaded_files');
        $this->load->view('backend/index', $page_data);
    }
	
	 function etransactFBPayment(){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'processetransactFBPayment';
        $page_data['page_title'] = 'Process FB Etransact with no Payee Id';
        $this->load->view('backend/index', $page_data);
    }
	
	function processetransactFBPayment(){
	session_start();
	$confirmCode = $this->input->post('conf');
	$regno = $this->input->post('regno');
	

		//load the etranzact library
		//set the terminal id
		//set the confirmation code
		//send the details to etranzact server and get return
		//if return value is successful
			//check if supplied payee id is the same with the return payee id
			//if true
				//get the return values
				//insert values to payment table
				//update the payee id generation table
				//then start ozioma library
				//set the sms message
				//set the sms recipient
				//send the message
				//return true
			//else return error
		//else return false
		
		//load the etranzact library
		$this->load->library('etranzact');
		
		//set the terminal id
		$this->etranzact->set_terminal("2140214016");
		
		//set the confirmation code
		$this->etranzact->set_conf($confirmCode);
		
		//send the details
		$this->etranzact->send();
		
		//if return is successful
		echo $this->etranzact->set_conf($confirmCode);
		if($this->etranzact->get_status() != "-1"){
			
			//check if supplied payee id is the same with returned payee id
			$payee_id = $this->etranzact->get_customer();
	
	
				$student_id =$this->crud_model->getStudentByRegno($payee_id)->student_id;
$portal_payee_id = $this->db->get_where('eduportal_generated_payeeid', array("student_id" => $student_id))->row()->payee_id;
	if(!isset($portal_payee_id))
	{
		$_SESSION['error'] = 'Error: Payeeid has not been generated for this Student!';
		redirect(base_url() . 'index.php?sadmin/etransactFBPayment');
	}
	else
	{
		$query1 =mysql_query("SELECT a.student_id, a.portal_id, a.payee_id, a.year, c.name,c.othername,c.dept,c.prog_type 

from eduportal_generated_payeeid a, student c where a.portal_id=c.portal_id and a.payee_id='$portal_payee_id'") or die(mysql_error());
while(list($id,$pid2,$payeeid,$yr,$fn,$on,$dept,$progt) = mysql_fetch_array($query1))
{
$data['level'] = $yr;
				$data['department'] = $dept;
				$data['programme_type'] = $progt;
}//$student = $this->db->get_where('student', array("payee_id" => $payeeID))->row();
				$data['bankcode'] = $this->etranzact->get_bankcode();
				$data['receipt_no'] = $this->etranzact->get_receipt();
				$data['bankname'] = $this->etranzact->get_bankname();
				$data['branchcode'] = $this->etranzact->get_branchcode();
			    $data['confirm_code'] = $this->etranzact->get_confirm();
				$amt =intval($this->etranzact->get_amount());
				$data['amount'] = $amt.".00";
				$data['description'] = $this->etranzact->get_descr();
				$data['payee_id'] =$portal_payee_id;
				$data['portal_id'] = $this->crud_model->getStudentByRegno($payee_id)->portal_id;
				$data['student_id'] = $this->crud_model->getStudentByRegno($payee_id)->student_id;
				$data['payment_confirmation_date'] = Date('jS F Y, h:i:s');
				$data['payment_method'] = 'BANK';
				$data['status'] = 'PAID';
				$data['session'] = '2015/2016';
				$data['session_id'] = '1';
				
				
				$data1['status'] = 'PAID';
				
		
		$payRecord = $this->db->get_where('eduportal_fee_payment', array("confirm_code" => $this->etranzact->get_confirm(), "receipt_no" => $this->etranzact->get_receipt()))->row();
				if($payRecord){
					$_SESSION['success1']= "Record already exists";
				}else{
			    $this->session->set_userdata('students_id', $student_id);
				$this->db->insert('eduportal_fee_payment', $data);
								$this->db->where('payee_id', $this->etranzact->get_customer());
				$this->db->update('eduportal_generated_payeeid', $data1);
				}
				
				
				unset($_SESSION['error']);
			    redirect(base_url() . 'index.php?sadmin/ViewStudentfeeReceipt');
			//	redirect(base_url() . 'index.php?sadmin/etransactFBPayment');
				
				/*
				$insertFee = $this->crud_model->insertStudentPaymentDetails($this->etranzact->get_customer(), $this->etranzact->get_receipt(), $this->etranzact->get_confirm(), $this->etranzact->get_amount(), $this->etranzact->get_descr(), $this->etranzact->get_bankname(), $this->etranzact->get_bankcode(), $this->etranzact->get_branchcode());
				
				if($insertFee){
					
					$this->crud_model->updateStudentPayeeIDStatus($this->etranzact->get_customer());
				
					//redirect to receipt page
					redirect(base_url() . 'index.php?student/feeReceipt');
				}
				*/
				
	}
			
		}else{
			$_SESSION['error'] = 'Incorrect payeeID or Confirmation Code / Etranzact Failed';
			$this->session->set_userdata('error', 'Incorrect payeeID or Confirmation Code / Etranzact Failed');
			redirect(base_url() . 'index.php?sadmin/etransactFBPayment');
		}
		
	}
		function ViewStudentfeeReceipt(){
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		
		$page_data['student'] = $this->crud_model->getStudent($this->session->userdata('students_id'));
		$page_data['payment'] = $this->crud_model->getPaymentByID($this->session->userdata('students_id'));
		$page_data['fee'] = $this->db->get_where('eduportal_settings', array("settings" => 'fee_title'))->row()->value;
		$page_data['page_name']  = 'viewStudentfeeReceipt';
		$page_data['page_title'] = get_phrase('Fee Payment Receipt');
		$this->load->view('backend/sadminprint', $page_data);
	}
	
	
	
	function newStudent(){
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'newStudent';
        $page_data['page_title'] = get_phrase('Register Screened Students');
        $this->load->view('backend/index', $page_data);
	}
	
	function registerScreenedStudents(){
		if ($this->session->userdata('sadmin_login') != 1)
			redirect(base_url(), 'refresh');
		
		//get the posted putme id
		//use the portal id to get the student details from the various tables
		//check if student have been given admission
		//generate portal id for the student
		//then insert the student details.
		
		$putmeID = $this->input->post('putmeID');
		
		//get the student details
		$student = $this->db->get_where('putme_students', array("putme_id" => $putmeID))->row();
		$card = $this->db->get_where('putme_card_details', array("putme_id" => $putmeID))->row();
		$lga = $this->db->get_where('putme_student_origin', array("putme_id" => $putmeID))->row();
		$admission = $this->db->get_where('putme_admission_list', array("putme_id" => $putmeID))->row();
		
		//check if student hav been admitted
		if($admission){
			
			//set up portal id
			//get the last portal id from the database
			$last = $this->db->query("select * from student order by portal_id desc limit 1")->row()->portal_id;
			$next =  intval(substr($last, 5, 6)) + 1;
			
			//check if next has been used
			if($this->db->get_where('student', array("portal_id" => $next))->row()){
				$l = $this->db->query("select * from student order by portal_id desc limit 1")->row()->portal_id;
				
				$pid = intval(substr($l, 5, 6)) + 1;
				$portal = 'AVN' . substr(date('Y'), 2, 2) . $pid;
			}else{
				$pid = intval(substr($last, 5, 6)) + 1;
				$portal = 'AVN' . substr(date('Y'), 2, 2) . $pid;
			}
			
			//Personal Details
			$data['name'] = $student->firstname;
			$data['othername'] = $student->middlename . ' ' . $student->lastname;
			$data['sex'] = $student->sex;
			$data['birthday'] = $student->date_of_birth;
			$data['address'] = $student->address;
			$data['parent_name'] = $student->parent_name;
			$data['parent_phone'] = $student->parent_phone;
			$data['parent_address'] = $student->parent_address;
			$data['nationality'] = $student->nationality;
			$data['password'] = '1234';
			$data['reg_no'] = $admission->jamb;
			$data['phone'] = $card->phone;
			$data['adm_session'] = $admission->session;
			$data['state'] = $lga->state;
			$data['lga'] = $lga->lga;
			$data['photo'] = $student->photo; 
			
			//academic details
			//get the department and get the school
			$data['dept'] = $admission->department;
			$data['school'] = $admission->school;
			$data['programme'] = $admission->programme;
			$data['prog_type'] = $admission->programme == 'DEGREE' ? 'DEGREE REGULAR' : 'NCE REGULAR';
			$data['level'] = $admission->programme == 'DEGREE' ? 'DEGREE 1' : 'NCE 1';
			$data['semester'] = 'FIRST';
			$data['first_login'] = '1';
			$data['portal_id'] = $portal;
			
			//check if student have been inserted yet
			$recorded = $this->db->get_where('student', array("reg_no" => $admission->jamb))->row();
			if($recorded){
				echo "student have been registered already!";
			}else{
				//echo "<pre>";
				//echo print_r($data);
				//echo "</pre>";
				
				$this->db->insert('student', $data);
				session_start();
				$_SESSION['success'] = 'Student Record Successfully Inserted';
				redirect(base_url() . 'index.php?sadmin/newStudent');
			}
			
		}else{
			echo "Student have not been admitted!";
		}
		
		
	}
	
	
	
	

    /***ADMIN DASHBOARD***/

    function dashboard()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

       // $page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
       // $page_data['etz'] = $this->db->order_by('trans_date', 'DESC')->get('eduportal_remita_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'dashboard';

        $page_data['page_title'] = get_phrase('admin_dashboard');

        $this->load->view('backend/index', $page_data);

    }
	
	function upload_staff_data()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'upload_staff_data';

        $page_data['page_title'] = get_phrase('upload_staff_data');

        $this->load->view('backend/index', $page_data);

    }
	
	function ajax_upload_staff_list()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
				
	$sadmin_id =$this->session->userdata('sadmin_id');

   $school= $this->input->post('school');
   $depts= $this->input->post('depts');

   
 
     
	  
	$path = "files/";
$session =time();
$_SESSION["sid"]=$session;
	$valid_formats = array("txt", "csv", "xlt");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimgstaff']['name'];
			$size = $_FILES['photoimgstaff']['size'];
			if(!$name)
			{
				$idm=1;
				$uploadedfile= "";
				$query =mysql_query("select* from eduportal_staff_record where dept_id = '$depts'") or die(mysql_error());
			while(list($id,$jamb,$surname,$firstname,$middlename) = mysql_fetch_array($query))
								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='left'><span class='style5'> $idm </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>

        
         
        
        </tr>";
								$idm++;}
				if(mysql_num_rows($query)<1)
				{
					echo "No Record Found!";
					exit;
				}					
								?>
									 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">STAFF ID </span></div></th>
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	  
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
								<?php exit;
			}
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(2024*2024))
						{
							$uploadedfile= "";
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimgstaff']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
								mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE eduportal_admission_list_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES SET session_id = '$session'") or die (mysql_error());
								$query =mysql_query("select* from eduportal_admission_list_temp where session_id = '$session'") or die("1");
								$i=1;
								while(list($id,$jamb,$surname,$firstname,$middlename,$type) = mysql_fetch_array($query))
								{
									
								if(trim($type)!="STAFF RECORD")
								{
								mysql_query("delete from eduportal_admission_list_temp where session_id = '$session'");
								echo "Invalid File!";
								exit;
								}
							
								$check_dup = mysql_query("select count(*) from eduportal_staff_record where regno='$jamb'") or die (mysql_error());
							$res = mysql_result($check_dup,0);
if($res>0)
								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>
<td><div align='center'><span class='style5'>DUPLICATE</span></div></td>
        
         
        
        </tr>";
								}
								else
								{
						
									mysql_query("insert into `eduportal_staff_record` (regno,surname,firstname,middlename,dept_id,school_id,user_id) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$sadmin_id')") or die (mysql_error()."3");
								//mysql_query("insert into `ebsuedu1_admission`.`eduportal_admission_list` (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype')") or die (mysql_error()."4");
								$uploadedfile= $uploadedfile." <tr>
          <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>
<td><div align='center'><span class='style5'>UPLOADED</span></div></td>
        
         
        
								</tr>";
								
								}
								$i++;
								}	
								$_SESSION["error"] ="List Uploaded Successfully!";
								?>
								 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">JAMB NO </span></div></th>
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">STATUS</span></div></th>
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
				  <?php 
				  ?>
								<?php
								//header("Location: index.php?sadmin/upload_admissions_list");	
echo		$_SESSION["error"];						
								?>
                                
                                

									<?php
									
								}
							else
								echo "failed 1";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
			
		}
	
}
function delete_stafflist($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 $data2['id']  = $id;
		$appno= $this->db->get_where('eduportal_staff_record', array("id" => $id))->row()->regno;
   
   $this->db->where('regno', $appno);
    $this->db->delete('eduportal_staff_record');
	
	   
   redirect(base_url().'index.php?sadmin/view_staff_list', 'refresh');
	}
 function view_staff_list()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->order_by('id', 'ASC')->get('eduportal_staff_record')->result_array();
        
        $page_data['page_name']  = 'view_staff_list';

        $page_data['page_title'] = get_phrase('view_staff_record');

        $this->load->view('backend/index', $page_data);

    }
	
	public function add_new_user_account()
{
	session_start();
if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
 
$page_data['page_name']  = 'add_new_user_account';
$page_data['page_title'] = 'Add New User Account';
$this->load->view('backend/index',$page_data);
}




public function view_user_accounts()
{
	session_start();
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');
		
		$prog = $this->input->post('prog');
		//$dept = $this->input->post('dept');
	
		//$_SESSION["progid"]= $prog;
	if($this->session->userdata('level') == 8)
{
$page_data['accounts'] = $this->db->get('sadmin')->result_array();
}
elseif($this->session->userdata('level') == 10)
{
$page_data['accounts'] = $this->db->query("select* from sadmin where level='6'")->result_array();
}
$page_data['page_name']  = 'view_user_accounts';
$page_data['page_title'] = ' View User Accounts';

//$this->session->userdata('admin_login');
$this->load->view('backend/index',$page_data);
}



function edituseraccount($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }			 
	 
		 

		//$appno= $this->db->get_where('sadmin', array("said" => $id))->row()->application_no;
        $page_data['account_details'] = $this->db->get_where('sadmin', array("sadmin_id" => $id))->row();
		 //echo $page_data['admlist_details']->id;
		 $page_data['states'] = $this->db->get('states')->result_array();
		$page_data['lgas'] = $this->db->get('lga')->result_array();
		$page_data['account_id']  = $id;
        $page_data['page_title'] = get_phrase('edit_account_details');
        $page_data['page_name']  = 'update_user_account';
        $this->load->view('backend/index', $page_data);
		   
	}
	
	
    function edituser_type($role_id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$role_id)
		 {
			 redirect(base_url(), 'refresh');
		 }			 
	 
		 

		
		$page_data['user_role_id']  = $role_id;
        $page_data['page_title'] = get_phrase('edit_user_type_role');
        $page_data['page_name']  = 'edit_user_type';
        $this->load->view('backend/index', $page_data);
		   
	}
	
		//USER ACCOUNT VIEW/CRUD FUNCTIONS
	
		function delete_useraccount($id){
	// 	if ($this->session->userdata('sadmin_login') != 1)

	// 	redirect(base_url(), 'refresh');
	//   if(!$id)
	//   {
	// 	  redirect(base_url(), 'refresh');
	//   }
		$this->db->where('sadmin_id', $id);

		$this->db->delete('sadmin');

		redirect(base_url() . 'index.php?sadmin/view_user_accounts/', 'refresh');
	}
	
	
	
		function process_edituseraccount($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		
   $data['name']= implode(',',$this->input->post('name'));
   //$email= $this->input->post('email');
   $data['phone']= $this->input->post('phone');
   //$data['name']= $this->input->post('school');
   $data['dept_id']= $this->input->post('depts');
   $data['level']= $this->input->post('role');
    $data['desig_id']= $this->input->post('role');
    $data['sid']= $this->input->post('school');
	$data['unit_sch_id']= $this->input->post('school');
   $data['address']= $this->input->post('address');

      $data['r_o_f_appointment']= $this->input->post('r_o_f_appointment');
   $data['salary_step']= $this->input->post('salary_step');
	$data['p_r_date']= $this->input->post('p_r_date');
	
	if($_FILES["publication_file"]["name"]){
	$data['publication_file']=rand(10, 1000) . $_FILES["publication_file"]["name"];
	$tmp = $_FILES["publication_file"]["tmp_name"];     
    if(!move_uploaded_file($tmp, "uploads/staff_images/" .$data['publication_file'])){
		return $_FILES["file"]["error"];
	} 
}

	$data['title']= $this->input->post('title');
   $data['sex']= $this->input->post('sex');
   $data['dob']= $this->input->post('dob');
   $data['file_no']= $this->input->post('file_no');
   $data['state']= $this->input->post('state');
   $data['lga']= $this->input->post('lga');
   $data['d_o_f_employment']= $this->input->post('d_o_f_employment');
   $data['s_g_level']= $this->input->post('s_g_level');
   $data['present_rank']= $this->input->post('present_rank');
   $data['entry_qualifications']= $this->input->post('entry_qualifications');
   $data['publications']= $this->input->post('publications');
   $data['cadre']= $this->input->post('cadre');
   $data['active_status']= $this->input->post('active_status');
   $data['employment_type']= $this->input->post('employment_type');

   if($_FILES["passport"]["name"]){
   $data['passport']=rand(10, 1000) . $_FILES["passport"]["name"];
   $temp = $_FILES["passport"]["tmp_name"];     
   if(!move_uploaded_file($temp, "uploads/staff_images/" . $data['passport'])){
	   return $_FILES["file"]["error"];
   } 
}
   $this->db->where('sadmin_id', $id);
	$this->db->update('sadmin', $data);
			
			
			
   redirect(base_url().'index.php?sadmin/edituseraccount/'.$id, 'refresh');
	}
	
	
	
	function create_user_account()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	include('application/config/z.php');			
	$sadmin_id =$this->session->userdata('sadmin_id');
    $sid= $this->input->post('school');
     $unit_sch_id= $this->input->post('school');
	  $nam=$this->input->post('name');
	  $name = implode(',',$nam);
   
   $email= $this->input->post('email');
   $phone= $this->input->post('phone');
    $dept_id  = $this->input->post('depts');                              

   $desig_id= $this->input->post('role');
   $address= $this->input->post('address');
   $rank_on_appointment = $this->input->post('rank_on_appointment');
   $salary_step = $this->input->post('salary_step');
   $present_rank_date = $this->input->post('present_rank_date');
   $title = $this->input->post('title');
   $sex = $this->input->post('sex');
   $dob = $this->input->post('dob');
   $fileno = $this->input->post('fileno');
   $state = $this->input->post('state');
   $lga = $this->input->post('lga');
   $date_first_employment = $this->input->post('date_first_employment');
   $salary_grade = $this->input->post('salary_grade');
   $present_rank = $this->input->post('present_rank');
   $entry_qualification = $this->input->post('entry_qualification');
   $publications = $this->input->post('publications');
   $cadre = $this->input->post('cadre');
   $employment_type = $this->input->post('employment_type');

   $filename =rand(10, 1000) . $_FILES["passport"]["name"];
   if(!move_uploaded_file($_FILES["passport"]["tmp_name"], "uploads/staff_images/" . $filename)){
	   return $_FILES["file"]["error"];
   }
   
   $fname = rand(10, 1000) . $_FILES["publicationfile"]["name"]; 
	$tmp = $_FILES["publicationfile"]["tmp_name"];     
    if(!move_uploaded_file($tmp, "uploads/staff_images/".$fname)){
		return $_FILES["file"]["error"];
	} 
   
   $check_dup = $this->db->query("select* from sadmin where email='$email'")->row;	
   if($check_dup>0)
								{
								echo 'Email already exist';	
								}
								else
								{
						$pass=mt_rand(1000,20000);
sqlsrv_query($conn,"insert into sadmin (name,email,reg_no,password,permissions,level,dept_id,phone,sid,desig_id,unit_sch_id,address,r_o_f_appointment,
salary_step,p_r_date,publication_file,title,sex,dob,file_no,state,lga,d_o_f_employment,s_g_level,
present_rank,entry_qualifications,publications,passport,cadre,employment_type) values ('$name','$email','$email','$pass','1','$desig_id','$dept_id','$phone','$sid','$desig_id','$unit_sch_id','$address','$rank_on_appointment',
'$salary_step','$present_rank_date','$fname','$title','$sex','$dob','$fileno','$state','$lga',
'$date_first_employment','$salary_grade','$present_rank','$entry_qualification','$publications',
'$filename','$cadre','$employment_type')") or  die(print_r( sqlsrv_errors(), true));
							$this->db->query("UPDATE erp_staff SET acct='Yes' WHERE sid='$sid'");
$names =explode(" ",$name);
$fname=$names[1];							
$to = "To: $fname<$email>";
$subject = "Your IDS Portal Account Login Details";

$message = "
<html>
<head>
<title>Welcome $name</title>
</head>
<body>
<p>This email contains your IDS Portal Login Details!</p>
<table>
<tr>
<th>Email/Username: $email</th>
<th>Password: $pass</th>
</tr>
<tr>
<td>Mobile No: $phone</td>
<td>LOGIN AND DO NOT FORGET TO CHANGE YOUR DEFAULT PASSWORD.</td>
<td>Login at http://www.delstateids.gov.ng</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Delta IDS ICT<noreply@delstateids.gov.ng>' . "\r\n";


mail($to,$subject,$message,$headers);

$name= $name;
$tel= $phone;
//$pid= $details->first_name;
//$fulldate= $fulldetails[3];

require_once 'assets/bsgateway.php';
$messageObj = new BSGateway($config);


$msg = "Hello $fname, your YABATECH Portal Login Details is Username: $email, Password: $pass Thankyou. Login at http://portal.YABATECH.edu.ng/nekede";
$tel ='234'.substr($tel,1);
$response= fopen("http://www.ipwebsms.com/index.php?option=com_spc&comm=spc_api&username=Sylvesterict&password=IGWE7963&sender=YABATECH&recipient=$tel&message=$msg&","r");							

//$response = $messageObj->sendMessage('igwesylvesteragbo@gmail.com', 'IGWE7963', 'YABATECHICT', $tel, $msg, 0);							
							
redirect(base_url() . 'index.php?sadmin/view_user_accounts');
	
  }

}
    
    // ADD NEW USER TYPE
      function add_new_user_type()
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
			
		
        $page_data['page_title'] = get_phrase('add_new_user_role');
        $page_data['page_name']  = 'add_user_type';
        $this->load->view('backend/index', $page_data);
		   
	}
    function process_add_new_usertype()
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		
   
   $data['user_type']= $this->input->post('user_type_name');
   
  
            $this->db->insert('erp_user_roles', $data);
			
			
			
   redirect(base_url().'index.php?sadmin/', 'refresh');
	}
	
    
    //EDIT USER TYPE PROCESS
    	function process_editusertype()
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		
		
  
  
   $user_role_id= $this->input->post('user_role_id');
   $data['user_type']= $this->input->post('user_type_name');
   
   $this->db->where('user_role_id', $user_role_id);
            $this->db->update('erp_user_roles', $data);
			
			
			
   redirect(base_url().'index.php?sadmin/', 'refresh');
	}
	
	 function view_staff_id_card_default()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'view_staff_data_idcard_default';

        $page_data['page_title'] = get_phrase('view_staff_data_id_card_data');

        $this->load->view('backend/index', $page_data);

    }
	
	function view_staff_data_idcard_database()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
$school= addslashes($this->input->post('school'));
  // $depts= $this->input->post('depts');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['staffdata'] = $this->db->query("select* from staff where staff_school='$school'")->result_array();
        
        $page_data['page_name']  = 'view_staff_data_idcard_database';

        $page_data['page_title'] = get_phrase('view_staff_data_id_card_database');

        $this->load->view('backend/index', $page_data);

    }
	
	function upload_lecturer_data()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'upload_lecturer_data';

        $page_data['page_title'] = get_phrase('upload_lecturer_data');

        $this->load->view('backend/index', $page_data);

    }
	
	function ajax_upload_lecturer_list()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
				
	$sadmin_id =$this->session->userdata('sadmin_id');

   $school= $this->input->post('school');
   $depts= $this->input->post('depts');

   include('application/config/z.php');
 
     
	  
	$path = "files/";
$session =time();
$_SESSION["sid"]=$session;
	$valid_formats = array("txt", "csv", "xlt");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimglecturer']['name'];
			$size = $_FILES['photoimglecturer']['size'];
			if(!$name)
			{
				$idm=1;
				$uploadedfile= "";
				$query=sqlsrv_query($conn,"select* from sadmin where dept_id = '$depts'")or  die(print_r( sqlsrv_errors(), true));
			while(list($id,$name,$email,$reg_no,,,,,,$phone) = sqlsrv_fetch_array($query))
								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='left'><span class='style5'> $idm </span></div></td>
          <td><div align='left'><span class='style5'>$name</span></div></td>
          <td><div align='center'><span class='style5'>$email</span></div></td>
            <td><div align='center'><span class='style5'>$phone</span></div></td>
			<td><div align='center'><span class='style5'>LIST</span></div></td>

        
         
        
        </tr>";
								$idm++;}
				if(sqlsrv_num_rows($query)<1)
				{
					echo "No Record Found!";
					exit;
				}					
								?>
									 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
         
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FULLNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">E-MAIL</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">PHONE</span></div></th>
     <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">STATUS</span></div></th>
	  
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
								<?php exit;
			}
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(2024*2024))
						{
							$uploadedfile= "";
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimglecturer']['tmp_name'];
							sqlsrv_query($conn,"delete from sadmin_temp");
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
			$file = fopen($path.$actual_image_name, "r") or die ("File Path Not Found! ");
			$count=0;
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
			 //  echo $getData[0].$getData[1].$getData[2].$getData[3].$getData[4].$getData[5];
			 if($count>0)
			 {
             $sql = "INSERT into sadmin_temp (id,name,email,phone,type,session_id) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','$session')";
                   $result =sqlsrv_query($conn, $sql) or die(print_r( sqlsrv_errors(), true));
        if(!$result)
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";    
        }
			 }
        $count=$count+1;
           }
      
           fclose($file);  
		  
   
							//	sqlsrv_query($conn,"BULK INSERT sadmin_temp FROM 'C:\\inetpub\\wwwroot\\nekede\\files\\".$actual_image_name."'  WITH (ROWTERMINATOR ='\n', FIELDTERMINATOR =',',FIRSTROW=2 )") or die(print_r( sqlsrv_errors(), true));
							//	sqlsrv_query($conn,"update sadmin_temp set session_id '$session'");
								$query =sqlsrv_query($conn,"select* from sadmin_temp where session_id = '$session'") or die("Error5:".sqlsrv_errors());
								$i=1;
								while(list($id,$name,$email,$phone,$type) = sqlsrv_fetch_array($query))
								{
									
								if(trim($type)!="LECTURER RECORD")
								{
								sqlsrv_query($conn,"delete from sadmin_temp where session_id = '$session'");
								echo "Invalid File1!";
								exit;
								}
			
								$check_dup = $this->db->query("select* from sadmin where email='$email'")->row();
								
												
   
if ($check_dup)

								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$email</span></div></td>
          <td><div align='center'><span class='style5'>$name</span></div></td>
            <td><div align='center'><span class='style5'>$phone</span></div></td>
	
<td><div align='center'><span class='style5'>DUPLICATE</span></div></td>
        
         
        
        </tr>";
								}
								else
								{
						$pass=mt_rand(1000,20000);
									sqlsrv_query($conn,"insert into sadmin (name,email,reg_no,password,permissions,level,dept_id,phone) values ('$name','$email','$email','$pass','1','6','$depts','$phone')") or die(print_r( sqlsrv_errors(), true));
							
$names =explode(" ",$name);
$fname=$names[1];							
$to = "To: $names[0] $names[1] <$email>";
$subject = "Your YABATECH Portal Account Login Details";

$message = "
<html>
<head>
<title>Welcome $name</title>
</head>
<body>
<p>This email contains your YABATECH Portal Login Details!</p>
<table>
<tr>
<th>Email/Username: $email</th>
<th>Password: $pass</th>
</tr>
<tr>
<td>Mobile No: $phone</td>
<td>LOGIN AND DO NOT FORGET TO CHANGE YOUR DEFAULT PASSWORD.</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: YABATECH ICT<noreply@YABATECH.edu.ng>' . "\r\n";


mail($to,$subject,$message,$headers);

$name= $name;
$tel= $phone;
//$pid= $details->first_name;
//$fulldate= $fulldetails[3];

require_once 'assets/bsgateway.php';
$messageObj = new BSGateway($config);


$msg = "Hello $fname, your YABATECH Portal Login Details is Username: $email, Password: $pass Thankyou. Login to http://erp.yabatech.edu.ng/portal";
$tel ='234'.substr($tel,1);
//$response = $messageObj->sendMessage('igwesylvesteragbo@gmail.com', 'IGWE7963', 'YABATECHICT', $tel, $msg, 0);							
	$response= fopen("http://www.ipwebsms.com/index.php?option=com_spc&comm=spc_api&username=Sylvesterict&password=IGWE7963&sender=YABATECH&recipient=$tel&message=$msg&","r");							
						
							
							//mysql_query("insert into `ebsuedu1_admission`.`eduportal_admission_list` (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype')") or die (mysql_error()."4");
								$uploadedfile= $uploadedfile." <tr>
        <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$email</span></div></td>
          <td><div align='center'><span class='style5'>$name</span></div></td>
            <td><div align='center'><span class='style5'>$phone</span></div></td>
			 <td><div align='center'><span class='style5'>UPLOADED</span></div></td>
        
         
        
								</tr>";
								
								}
								$i++;
								}	
								$_SESSION["error"] ="List Uploaded Successfully!";
								?>
								 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
           <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
         
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FULLNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">E-MAIL</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">PHONE</span></div></th>
     <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">STATUS</span></div></th>
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
				  <?php 
				  ?>
								<?php
								//header("Location: index.php?sadmin/upload_admissions_list");	
echo		$_SESSION["error"];						
								?>
                                
                                

									<?php
									
								}
							else
								echo "failed 1";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
			
		}
	
}
function delete_lecturerlist($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		// $data2['id']  = $id;
		//$appno= $this->db->get_where('sadmin', array("sadmin_id" => $id))->row()->regno;
   
    $this->db->where('sadmin_id', $id);
    $this->db->delete('sadmin');
	
	   
   redirect(base_url().'index.php?sadmin/view_lecturer_list', 'refresh');
	}
 function view_lecturer_list()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("select* from sadmin where level='6' or level='10' or level='11' or level='9'")->result_array();
        
        $page_data['page_name']  = 'view_lecturer_list';

        $page_data['page_title'] = get_phrase('view_user_accounts');

        $this->load->view('backend/index', $page_data);

    }
	
	
	 function manage_sch_fee_invoice()
	 {
		        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        $page_data['feeinvoice'] = $this->db->get('invoice_gen')->result_array();
        $page_data['page_name']  = 'manage_sch_fee_invoice';

        $page_data['page_title'] = get_phrase('manage_sch_fee_invoice');

        $this->load->view('backend/index', $page_data);  
	 }
	
	function delete_sch_fee_invoice($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }

   
   $this->db->where('application_invoice_id', $id);
    $this->db->delete('invoice_gen');
	
	   
   redirect(base_url().'index.php?sadmin/manage_sch_fee_invoice', 'refresh');
	}
	
	function manage_acp_fee_invoice()
	 {
        if ($this->session->userdata('sadmin_login') != 1)

        redirect(base_url(), 'refresh');
include('application/config/z.php');
        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        $page_data['feeinvoice'] = $this->db->get('eduportal_remita_accp_temp_data')->result_array();
        $page_data['page_name']  = 'manage_acp_fee_invoice';
		 $page_data['conn']  = $conn;

        $page_data['page_title'] = get_phrase('manage_acp_fee_invoice');

        $this->load->view('backend/index', $page_data);  
	 }
	 
   function delete_acp_fee_invoice($id)
	{
         if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }

   
    $this->db->where('rrrid', $id);
    $this->db->delete('eduportal_remita_accp_temp_data');
	
	   
    redirect(base_url().'index.php?sadmin/manage_acp_fee_invoice', 'refresh');
	}
   function feesetup()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'set_up_fee_schedule';

        $page_data['page_title'] = get_phrase('set_up_fee_schedule');

        $this->load->view('backend/index', $page_data);

    }	 
 function processfeesetup()
        {


    //  $data2['hcp_name'] = $this->input->post('hcp_name');
      $programme = $this->input->post('programme');
	  $prog_type = $this->input->post('prog_type');
	  $session = $this->input->post('session');
	  $year = $this->input->post('year');

    

      $indigene_amount               = $this->input->post('indigene_amount');
       $nonindigene_amount               = $this->input->post('nonindigene_amount');
	   $foreign_amount               = $this->input->post('foreign_amount');
	   $dept_id               = $this->input->post('dept_id');
       

      $number_of_entries          = sizeof($indigene_amount);
      for ($i = 0; $i < $number_of_entries; $i++)
      {
		  
         $data["session"]= $session;
		 $data["fee_type"]= '2';
		 $data["level"]= $year;
		 $data["student_type_id"]= $prog_type;
		 $dept=$dept_id[$i];
		 $data["dept_id"]= $dept_id[$i];
		 $data["fee_desc"]= 'YABATECH SCHOOL FEES - '.$year;
		 $data["indigene_amount"]= $indigene_amount[$i];
		 $data["nonindigene_amount"]= $nonindigene_amount[$i];
		 $data["foreign_amount"]= $foreign_amount[$i];
		 
		 $check_fee_schedule=$this->db->query("select* from fedponek_fee_schedule where student_type_id='$prog_type' and level='$year' and session='$session' and fee_type='2' and dept_id='$dept'")->row();
	//echo $check_fee_schedule->student_type_id;
	//exit;
	if($check_fee_schedule)
	{
		$id= $check_fee_schedule->id;
		$this->db->where("id",$id);
		$this->db->update("fedponek_fee_schedule",$data);
	}
	else{
		//$this->db->insert("fedponek_fee_schedule",$data);
	}
	}
	
	$_SESSION['success'] = 'Fee Setup Updated Successfully!';
				redirect(base_url() . 'index.php?sadmin/feesetup');
		}

		
		 function view_student_database_default()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
       // $page_data['admlist'] = $this->db->order_by('id', 'ASC')->get('eduportal_admission_list')->result_array();
        
        $page_data['page_name']  = 'view_student_database_default';

        $page_data['page_title'] = get_phrase('view_student_database');

        $this->load->view('backend/index', $page_data);

    }
	
	 function ajax_procees_view_student_database()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
	
   $programme= $this->input->post('programme');
   $school= $this->input->post('school');
   $depts= $this->input->post('depts');
   //$deptsoptions= $this->input->post('deptsoptions');
  $programme_type_id=$this->input->post('prog_type'); 
 //echo $programme.'-'.$school.'-'.$depts.'-'.$programme_type_id;

  
        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
  $page_data['studentlist'] = $this->db->query("select* from student where dept='$depts' and school='$school' and programme='$programme' and prog_type='$programme_type_id'")->result_array();
        
        $page_data['page_name']  = 'view_student_database';

        $page_data['page_title'] = get_phrase('students_class_data');

        $this->load->view('backend/index', $page_data);

    }
	
	
	
	
	
	 function upload_adm_list()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'upload_adm_list';

        $page_data['page_title'] = get_phrase('upload_admissions_list');

        $this->load->view('backend/index', $page_data);

    }
    
	function ajax_upload_admissionlist()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		 include('application/config/z.php');		
	$sadmin_id =$this->session->userdata('sadmin_id');
	$programme= $this->input->post('programme');
   $school= $this->input->post('school');
   $depts= $this->input->post('depts');
   $deptsoptions= $this->input->post('deptsoptions');
   
 
      $programme_type_id=$this->input->post('prog_type');
	  $program_id=$this->input->post('program_id');
	  
	  $batch=$this->input->post('batch');
   $ltype=$this->input->post('ltype');
   $sess=$this->input->post('session');
	$path = "files/";
	echo $path;
$session =time();
$_SESSION["sid"]=$session;
	$valid_formats = array("txt", "csv", "xlt");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			if(!$name)
			{
				$idm=1;
				$uploadedfile= "";
				$query =sqlsrv_query($conn,"select* from eduportal_admission_list where dept_id = '$depts' and dept_option_id='$deptsoptions' and programme_type_id='$programme_type_id' and session='$sess' and admissionlist_batch_id='$batch' and adm_type='$ltype'") or die('1');
			while(list($id,$jamb,$surname,$firstname,$middlename) = sqlsrv_fetch_array($query))
								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='left'><span class='style5'> $idm </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>

        
         
        
        </tr>";
								$idm++;}
				if(sqlsrv_num_rows($query)<1)
				{
					echo "No Record Found!";
					exit;
				}					
								?>
									 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">JAMB NO </span></div></th>
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	  
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
								<?php exit;
			}
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(2024*2024))
						{
							$uploadedfile= "";
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									
		$file = fopen($path.$actual_image_name, "r") or die ("File Path Not Found! ");
			$count=0;
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
			 //  echo $getData[0].$getData[1].$getData[2].$getData[3].$getData[4].$getData[5];
			 if($count>0)
			 {
             $sql = "INSERT into eduportal_admission_list_temp (id,jambregno,surname,firstname,middlename,type,session_id) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','$session')";
                   $result =sqlsrv_query($conn, $sql) or die(print_r( sqlsrv_errors(), true));
				   
        if(!$result)
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";    
        }
			 }
        $count=$count+1;
           }
      
           fclose($file);					
									
							//	mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE eduportal_admission_list_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES SET session_id = '$session'") or die (mysql_error());
								$query =sqlsrv_query($conn,"select* from eduportal_admission_list_temp where session_id = '$session'") or die("2");
								$i=1;
								while(list($id,$jamb,$surname,$firstname,$middlename,$type) = sqlsrv_fetch_array($query))
								{
									
								if(trim($type)!="ADMISSIONS LIST")
								{
								sqlsrv_query($conn,"delete from eduportal_admission_list_temp where session_id = '$session'") or die("3");
								echo "Invalid Admission List File!";
								exit;
								}
							
								$check_dup = $this->db->query("select* from eduportal_admission_list where application_no='$jamb'")->row();
							//$res = mysql_result($check_dup,0);
if($check_dup)
								{
									$uploadedfile= $uploadedfile." <tr>
          <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>
<td><div align='center'><span class='style5'>DUPLICATE $check_dup->application_no</span></div></td>
        
         
        
        </tr>";
								}
								else
								{
							
									sqlsrv_query($conn,"insert into eduportal_admission_list (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type,program_id) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype','$program_id')") or die ("5");
							      include('application/config/dbApp.php');	
								  sqlsrv_query($conn2,"insert into eduportal_admission_list (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type,program_id) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype','$program_id')") or die ("5");
								$uploadedfile= $uploadedfile." <tr>
          <td><div align='center'><span class='style5'> $i </span></div></td>
          <td><div align='left'><span class='style5'>$jamb</span></div></td>
          <td><div align='center'><span class='style5'>$surname</span></div></td>
            <td><div align='center'><span class='style5'>$firstname</span></div></td>
			<td><div align='center'><span class='style5'>$middlename</span></div></td>
<td><div align='center'><span class='style5'>UPLOADED</span></div></td>
        
         
        
								</tr>";
								
								}
								$i++;
								}	
								$_SESSION["error"] ="List Uploaded Successfully!";
								?>
								 <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">JAMB NO </span></div></th>
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">STATUS</span></div></th>
         
        </tr>
      </thead>
	 <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	?>
         <tbody> 
       <?php echo $uploadedfile;?>
	   </tbody>
	   </table>
				  <?php 
				  ?>
								<?php
								//header("Location: index.php?sadmin/upload_admissions_list");	
echo		$_SESSION["error"];						
								?>
                                
                                

									<?php
									
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
			
		}
	
}
	

	

	 function view_adm_list()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->order_by('id', 'ASC')->get('eduportal_admission_list')->result_array();
        
        $page_data['page_name']  = 'view_admissions_list';

        $page_data['page_title'] = get_phrase('view_adm_list');

        $this->load->view('backend/index', $page_data);

    }
	
	function editadmislist($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }			 
		 $page_data['page_name']  = 'editadmislist';
		 $page_data['adm_list_id']  = $id;

         $page_data['admlist_details'] = $this->db->get_where('eduportal_admission_list', array("id" => $id))->row();
		 //echo $page_data['admlist_details']->id;
		 
        $page_data['page_title'] = get_phrase('edit_adm_list_details');

        $this->load->view('backend/index', $page_data);
		   
	}
	function update_admissionlist($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		// $data2['id']  = $id;
		 $data['surname'] =$this->input->post('surname');
		 $data['firstname'] =$this->input->post('firstname');
		 $data['middlename'] =$this->input->post('middlename');
		    $data['school_id']= $this->input->post('school');
    $data['dept_id']= $this->input->post('depts');
    $data['dept_option_id']= $this->input->post('deptsoptions');
	$data['student_type']= $this->input->post('programme');
    $data['programme_type_id']=$this->input->post('prog_type');
	$data['program_id']=$this->input->post('program_id');
	  
	  $data['admissionlist_batch_id']=$this->input->post('batch');
   $data['adm_type']=$this->input->post('ltype');
   $data['session']=$this->input->post('session');
   $admdetails=$this->db->get_where('eduportal_admission_list', array("id" => $id))->row();
$portal_id=	 $admdetails->application_no;
   $this->db->where('application_no', $portal_id);
            $this->db->update('eduportal_admission_list', $data);
		


    $data2['school']= $this->input->post('school');
	$data2['dept']= $this->input->post('depts');
    $data2['dept_option']= $this->input->post('deptsoptions');
	$data2['programme']= $this->input->post('programme');
    $data2['prog_type']=$this->input->post('prog_type');
	$data2['program_id']=$this->input->post('program_id');
			$this->db->where('portal_id', $portal_id);
         $this->db->update('student', $data2);
			
   redirect(base_url().'index.php?sadmin/editadmislist/'.$id, 'refresh');
	}
	
		function delete_admissionlist($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 $data2['id']  = $id;
		
   
   $this->db->where('application_no', $id);
    $this->db->delete('eduportal_admission_list');
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
   redirect(base_url().'index.php?sadmin/view_adm_list', 'refresh');
	}
	
 function assign_students_for_medical()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM eduportal_fees_payment_log WHERE payment_fee_type='2' and payment_session='2019/2020' and  (payment_level='ND I' OR payment_level='HND I')")->result_array();
        
        $page_data['page_name']  = 'assign_students_for_medical';

        $page_data['page_title'] = get_phrase('assign_students_for_medical_xray');

        $this->load->view('backend/index', $page_data);

    }
 function assign_medical_facility($id)

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist_details'] = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='$id'")->row();
        
        $page_data['page_name']  = 'assign_medical_facility';

        $page_data['page_title'] = get_phrase('assign_students_for_medical_xray');

        $this->load->view('backend/index', $page_data);

    }

    	function save_assign_medical_facility($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 
		 $adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
		 
		// $data2['id']  = $id;
		//$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_admissions_screening")->row()->asm;
		//$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                $data['regno'] = $adm->application_no;
				$data['facility'] = $this->input->post('facility');
				$data['medical_officer'] = $sadmin_name;
				
				$data['date_assigned'] = date("Y-m-d");
				$data['department_id'] = $adm->dept_id;
				
				
		 $check = $this->db->query("SELECT * FROM medical_screening WHERE regno='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
				$this->db->insert('medical_screening', $data);
		}
   //$this->db->where('application_no', $id);
   // $this->db->delete('eduportal_admission_list');
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
    $this->session->set_flashdata('flash_message', get_phrase('student_was_assigned_successfully!'));
   redirect(base_url().'index.php?sadmin/assign_students_for_medical', 'refresh');
	}
	
function view_assigned_students_medical_default()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
       // $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening")->result_array();
        
        $page_data['page_name']  = 'generate_xray_report';

        $page_data['page_title'] = get_phrase('view_assigned_students_medical_report');

        $this->load->view('backend/index', $page_data);

    }

 function view_assigned_students_medical()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
$facility = $this->input->post('facility');
$date_1 = $this->input->post('report_begin_date').' 00:00:00.000';
$date_2 = $this->input->post('report_end_date').' 00:00:00.000';
        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		if($facility=='1'){
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening where date_assigned between '$date_1' and '$date_2'")->result_array();
        }
		else{
	   $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening where facility ='$facility' and (date_assigned between '$date_1' and '$date_2')")->result_array();
		}
        $page_data['page_name']  = 'view_assigned_students_medical';

        $page_data['page_title'] = get_phrase('view_assigned_students_medical');

        $this->load->view('backend/index', $page_data);

    }
	
 function view_assigned_students_medical_xray()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening")->result_array();
        
        $page_data['page_name']  = 'view_assigned_students_medical_xray';

        $page_data['page_title'] = get_phrase('view_assigned_students_medical');

        $this->load->view('backend/index', $page_data);

    } 
	function attach_student_xray_results($id)

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $admlist_details = $this->db->query("SELECT * FROM medical_screening WHERE id='$id'")->row();
        $page_data['param1']= $admlist_details->regno;
        $page_data['page_name']  = 'manage_students_medical_attachments';
        $page_data['id']=$id;
        $page_data['page_title'] = get_phrase('students_medical_attachments');

        $this->load->view('backend/index', $page_data);

    }
function delete_student_xray_results($id,$sid)

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $admlist_details = $this->db->query("SELECT * FROM medical_screening WHERE id='$sid'")->row();
		$this->db->query("delete FROM student_medical_attachments WHERE attachment_id='$id'");
        $page_data['param1']= $admlist_details->regno;
        $page_data['page_name']  = 'manage_students_medical_attachments';
        $page_data['id']=$sid;
        $page_data['page_title'] = get_phrase('students_medical_attachments');

        $this->load->view('backend/index', $page_data);

    }
 function save_student_folder_attachment($id)
    {
        $data['timestamp']          = date("Y-m-d");
        //$data['report_type']        = $this->input->post('report_type');
        $data['application_number']            = $this->input->post('application_number');

        $data['doc_type']           = $this->input->post('document_type');
        $prefix                     = $data['doc_type'].'_'.'_'.$data['timestamp'].'_';
        $data['file_name']          = $prefix.$_FILES["file_name"]["name"];
        $data['description']        = $this->input->post('description');

        $this->db->insert('student_medical_attachments',$data);

       // $attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"],"uploads/student_medical_attachments/" . $prefix .$_FILES["file_name"]["name"]);
    redirect(base_url() . "index.php?sadmin/attach_student_xray_results/$id");
	
   }
function view_students_medical_xray_reports()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening")->result_array();
        
        $page_data['page_name']  = 'view_students_medical_xray_reports';

        $page_data['page_title'] = get_phrase('view_assigned_students_medical');

        $this->load->view('backend/index', $page_data);

    }

 function issue_id_cards()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening")->result_array();
        
        $page_data['page_name']  = 'issue_id_cards';

        $page_data['page_title'] = get_phrase('issue_id_cards');

        $this->load->view('backend/index', $page_data);

    }
 
  function assign_matric_no()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening where status='1' ")->result_array();
        
        $page_data['page_name']  = 'assign_matric_no';

        $page_data['page_title'] = get_phrase('assign_matric_no');

        $this->load->view('backend/index', $page_data);

    }
 
		function generate_matric_no($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
			  
		 }
		 
	$adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
	
	$student = $this->db->query("SELECT * FROM student WHERE portal_id='".$adm->application_no."'")->row();
	
	$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_admissions_screening where department_id='$adm->dept_id'")->row()->asm;
		$identificationno=$lastrow +1;
	$dept_code= $this->db->query("SELECT* from department where deptID='$adm->dept_id'")->row()->dept_code;
    
	$data["matric_no_issued"]=1;
   $this->db->where('regno', $adm->application_no);
   $this->db->update("medical_screening",$data);
   
   $data1["reg_no"]='19/00'.$identificationno.'/'.$dept_code;
   $this->db->where('student_id', $student->student_id);
   $this->db->update("student",$data1);
   
   $data2["identification_no"] =$identificationno;
   $data2["matric_no"]='19/00'.$identificationno.'/'.$dept_code;
   $this->db->where('application_no', $adm->application_no);
   $this->db->update("eduportal_admissions_screening",$data2);
   
   redirect(base_url() . 'index.php?sadmin/assign_matric_no');
	}

 function view_assigned_students_medical_id_card()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM medical_screening where status='1' and matric_no_issued='1'")->result_array();
        
        $page_data['page_name']  = 'view_assigned_students_medical_id_card';

        $page_data['page_title'] = get_phrase('view_issued_id_cards');

        $this->load->view('backend/index', $page_data);

    }	
	
	  function screen_students()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM eduportal_fees_payment_log WHERE payment_fee_type='1' and payment_session='2019/2020'")->result_array();
        
        $page_data['page_name']  = 'screen_students';

        $page_data['page_title'] = get_phrase('screen_applicants_module');

        $this->load->view('backend/index', $page_data);

    }
    	
		
    function schedule_applicants_cbt()

    {



        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'cbt_schedule';
        $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('applicants_cbt_module');
		$this->load->view('backend/index', $page_data);
	}
	    function assign_applicants_cbt()

    {

        

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		//$app= $db2->query("SELECT min(applicant_id) as expx FROM hnd_applicants_form WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'")->row()->expx;
		//$db2->query("update hnd_applicants_form set has_cbt_sit='1', WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'");
		
		$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'cbt_schedule2';
        $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('applicants_cbt_module');
		$this->load->view('backend/index', $page_data);
	}
	
	
	    function view_applicants_results_by_dept()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicants_results_by_dept';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_results_by_dept');
		$this->load->view('backend/index', $page_data);
	}
	
	   function view_applicants_results_by_dept_change_of_course()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicants_results_by_dept_change_of_course';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_results_change_of_course');
		$this->load->view('backend/index', $page_data);
	}
	
	
	
	
		    function screen_applicants()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		$db2= $this->load->database("db2",TRUE);
        
         
		 $this->load->library('pagination');

 		$config['base_url']= 'index.php?sadmin/screen_applicants';
 		$config['total_rows']=$db2->query("SELECT * FROM hnd_applicants_form WHERE olevelscreened='0' and progress_step='3' and (program_code<>'DEG')")->num_rows();
 		$config['per_page']= 10;
 		$config['num_links']= 3;

 		$this->pagination->initialize($config);

 		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//$db2->select('*')->from('hnd_applicants_form')->where(array('olevelscreened' => '0','progress_step' => '3'))->limit($config['per_page'])->offset($page);
		//$data['records']=$this->db->query("select* from `invoice` where `status`='unpaid' or status='Deposited' order by invoice_id DESC limit {$config["per_page"]} offset {$page}")->result_array();
        //$page_data['applicants']=$db2->get()->result_array();

$page_data['applicants'] = $db2->query("WITH Results_CTE AS (     SELECT*, 
        ROW_NUMBER() OVER (ORDER BY applicant_id ASC) AS RowNum
    FROM hnd_applicants_form
    WHERE olevelscreened='0' and progress_step='3' and (program_code<>'DEG')
)
SELECT *
FROM Results_CTE
WHERE RowNum >= {$page}
AND RowNum < {$page} + {$config["per_page"]}")->result_array();

//$page_data['applicants'] = $db2->query("SELECT * FROM hnd_applicants_form WHERE olevelscreened='0' and progress_step='3' order by applicant_id DESC LIMIT  offset {$page}")->result_array();
        $page_data['page_name']  = 'screen_applicants';
        $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('screen_applicants_module');

        $this->load->view('backend/index', $page_data);

    }
	
	function disapprove_applicant($id)
	{
			 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 $db2= $this->load->database("db2",TRUE);
		 $adm = $db2->query("SELECT * FROM hnd_applicants_form WHERE applicant_id='".$id."'")->row();
		 
		$data2['olevelscreened']  = 1;
		$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_applicant_screening")->row()->asm;
		$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                $data['application_no'] = $adm->application_no;
				$data['screening_result'] = 0;
				$data['screening_officer'] = $sadmin_name;
				$data['identification_no'] = $identificationno;
				$data['matric_no'] = $adm->application_no;
				$data['screening_date'] = date("d-m-Y");
				$data['department_id'] = $adm->dept_fst_ch;
				$data['student_type'] = $adm->program_code;
				
		 $check = $this->db->query("SELECT * FROM eduportal_applicant_screening WHERE application_no='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
				$this->db->insert('eduportal_applicant_screening', $data);
		}
   $db2->where('application_no', $adm->application_no);
   $db2->update('hnd_applicants_form',$data2);
	
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
    $this->session->set_flashdata('flash_message', get_phrase('student_was_screened_successfully_status:_failed!'));
   redirect(base_url().'index.php?sadmin/screen_applicants', 'refresh');
	}
	
	
	function disapprove_applicant_appno($appno)
	{
			
		 $db2= $this->load->database("db2",TRUE);
		 $adm = $db2->query("SELECT * FROM hnd_applicants_form WHERE application_no='".$appno."'")->row();
		 
		$data2['olevelscreened']  = 1;
		$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_applicant_screening")->row()->asm;
		$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                $data['application_no'] = $adm->application_no;
				$data['screening_result'] = 0;
				$data['screening_officer'] = $sadmin_name;
				$data['identification_no'] = $identificationno;
				$data['matric_no'] = $adm->application_no;
				$data['screening_date'] = date("d-m-Y");
				$data['department_id'] = $adm->dept_id;
				$data['student_type'] = $adm->program_code;
				
		 $check = $this->db->query("SELECT * FROM eduportal_applicant_screening WHERE application_no='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
				$this->db->insert('eduportal_applicant_screening', $data);
		}
   $db2->where('application_no', $adm->application_no);
   $db2->update('hnd_applicants_form',$data2);
	
	echo $adm->application_no;
	//exit;
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
    $this->session->set_flashdata('flash_message', get_phrase('student_was_screened_successfully_status:_failed!'));
   redirect(base_url().'index.php?sadmin/screen_applicants', 'refresh');
	}
	function approve_applicant($id)
	{
			 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 	$db2= $this->load->database("db2",TRUE);
		 $adm = $db2->query("SELECT * FROM hnd_applicants_form WHERE applicant_id='".$id."'")->row();
		 
		 
		 $data2['olevelscreened']  = 2;
		$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_applicant_screening")->row()->asm;
		$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                $data['application_no'] = $adm->application_no;
				$data['screening_result'] = 1;
			$data['screening_officer'] = $sadmin_name;
				$data['identification_no'] = $identificationno;
				$data['matric_no'] = $adm->application_no;
				$data['screening_date'] = date("d-m-Y");
				$data['department_id'] = $adm->dept_fst_ch;
				$data['student_type'] = $adm->program_code;
				
		 $check = $this->db->query("SELECT * FROM eduportal_applicant_screening WHERE application_no='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
				$this->db->insert('eduportal_applicant_screening', $data);
		}
   $db2->where('application_no', $adm->application_no);
   $db2->update('hnd_applicants_form',$data2);
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
    $this->session->set_flashdata('flash_message', get_phrase('applicant_was_screened_successfully_status:_failed!'));
   redirect(base_url().'index.php?sadmin/screen_applicants', 'refresh');
	}
     
		function approve_medical($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
			  
		 }
	//$adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
    $data["status"]=1;
   $this->db->where('id', $id);
   $this->db->update("medical_screening",$data);
   
   redirect(base_url() . 'index.php?sadmin/view_students_medical_xray_reports');
	}
	
		function disapprove_medical($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 
	// $adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
		
   //$this->db->query("update medical_screening set status='0' where regno='$adm->application_no'"); 
   
   $data["status"]=2;
   $this->db->where('id', $id);
   $this->db->update("medical_screening",$data);
   
   redirect(base_url() . 'index.php?sadmin/view_students_medical_xray_reports');
	}
	
	
		function update_screen_reason($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 
	// $adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
		
   //$this->db->query("update medical_screening set status='0' where regno='$adm->application_no'"); 
   $db2= $this->load->database("db2",TRUE);
   $data["olevelfailedreason"]= $this->input->post("reason$id");
   $db2->where('applicant_id', $id);
   $db2->update("hnd_applicants_form",$data);
   
   redirect(base_url() . 'index.php?sadmin/view_screened_applicants_failed');
	}
		
   //$this->db->where('application_no', $id);
   // $this->db->delete('eduportal_admission_list');
		
		function approve_admissions($id)
	{
		 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 
		 $adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
		 
		// $data2['id']  = $id;
		$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_admissions_screening")->row()->asm;
		$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                
				
		 $check = $this->db->query("SELECT * FROM eduportal_admissions_screening WHERE application_no='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
		
   //$this->db->where('application_no', $id);
   // $this->db->delete('eduportal_admission_list');
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
   
   
   
   $portalID = $adm->application_no;
		$session = '2019/2020';
		$semester = 'FIRST';
		if($adm->student_type=="1")
		{
			$year = 'ND I';
		}
		else{
		$year = 'HND I';
	}
		$paymentType = '2';
		//$department =$this->input->post('department');
		//$school=$this->input->post('school');
		$progtype = $this->db->get_where('programme_type', array("programme_type_id" => $adm->programme_type_id))->row()->programme_type_name;
		//$prog = $this->input->post('prog');
		$stu_prog=$adm->programme_type_id;
		if($stu_prog==4)
		{$application_form_category= '7';} 
	if($stu_prog==5){$application_form_category= '8';} 
	if($stu_prog==6){$application_form_category= '9';}  
	if($stu_prog==1){$application_form_category= '10';}  
	if($stu_prog==2){$application_form_category= '11';} 
	if($stu_prog==3){$application_form_category= '12';}
		if($portalID == '' || $portalID == ' ')
		{

		
			$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			redirect(base_url() . 'index.php?sadmin/screen_students');
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

		$responseurl = "http://162.144.134.70/nekede/newremitaResponse.php";

		

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

//$beneficiaryAmount3 ="50";
$deductFeeFrom=1;
$deductFeeFrom2=0;
		
	

		$beneficiaryAmount =0;
		$totalDeductions=4500 + 2500 + 300;

		$beneficiaryAmount2 =$totalAmount - $beneficiaryAmount;
		
	
		
		

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

		//$application_form_category = $this->input->post('programme_type_id');
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
   // $page_data['page_title'] = 'FPN HND Registration Payment Invoice';
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
		
		//redirect(base_url()."index.php?student/remita_schfee_invoice");
}

			
//$timesammp=date("dmyHis");		
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
			   'fee_description'=>$amount->fee_desc.' YABATECH SCHOOL FEE',
			   '[level]'=>$year,
			   'semester'=>$semester,
			   'service_type_code'=>$servicecode
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
 
 		$data['application_no'] = $adm->application_no;
				$data['screening_result'] = 1;
				$data['screening_officer'] = $sadmin_name;
				$data['identification_no'] = $identificationno;
				$data['matric_no'] = $adm->application_no;
				$data['screening_date'] = date("d-m-Y");
				$data['department_id'] = $adm->dept_id;
				$data['student_type'] = $adm->student_type;
				$data['sch_fee_rrr'] = $rrr;
		
		$this->db->insert('eduportal_admissions_screening', $data);
		
		$name = $studentDetails->othername;						
								$to = "To: $name <$studentDetails->email;>";
								$subject = "Notification of School Fee Invoice";

								$message = "
								<html>
								<head>
								<title>Hello $name</title>
								</head>
								<body>
								<p>This is to Notify you that your School Fee RRR have been generated!</p>
								<table>
								
								<tr>
								<td>Kindly Pay your School Fee with Remita RRR: $rrr, then create your Portal Account, Print Fee Receipt and Proceed for your Medicals	</td>
							
								<td>Visit https://portal.fedpolynekede.edu.ng</td>
								</tr>
								</table>
								</body>
								</html>
								";

								// Always set content-type when sending HTML email
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								// More headers
								$headers .= 'From: YABATECH <noreply@fedpolynekede.edu.ng>' . "\r\n";


								mail($to,$subject,$message,$headers);

							    $names= explode(" ",$name);
							    $firstname=$names[0];
								$tel= $studentDetails->phone;
								//$pid= $details->first_name;
								//$fulldate= $fulldetails[3];

								require_once 'assets/bsgateway.php';
								$messageObj = new BSGateway($config);


								$msg = "Hello $firstname,  Kindly Pay your School Fee with Remita RRR: $rrr, then create your Portal Account, Print Fee Receipt and Proceed for your Medicals";
								$tel ='234'.substr($tel,1);
								$response = $messageObj->sendMessage('igwesylvesteragbo@gmail.com', 'IGWE7963', 'YABATECH', $tel, $msg, 0);
		
		//redirect(base_url()."index.php?student/remita_schfee_invoice");
			


		}else{

			$_SESSION['err_msg'] = 'An error occured! Please try again '; 

			redirect(base_url() . 'index.php?sadmin/screen_students');

		}
   
	}
   
   
   
   
   
   
   
    $this->session->set_flashdata('flash_message', get_phrase('student_was_screened_successfully_status:_passed!'));
   redirect(base_url().'index.php?sadmin/screen_students', 'refresh');
	}
	
	 	function disapprove_admissions($id)
	{
			 if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
		 if(!$id)
		 {
			 redirect(base_url(), 'refresh');
		 }
		 
		 $adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE id='".$id."'")->row();
		 
		 $data2['id']  = $id;
		$lastrow = $this->db->query("SELECT max(identification_no) as asm FROM eduportal_admissions_screening")->row()->asm;
		$identificationno=$lastrow +1;
		
		$sadmin_name =$this->session->userdata('name');
		
                $data['application_no'] = $adm->application_no;
				$data['screening_result'] = 0;
				$data['screening_officer'] = $sadmin_name;
				$data['identification_no'] = $identificationno;
				$data['matric_no'] = $adm->application_no;
				$data['screening_date'] = date("d-m-Y");
				$data['department_id'] = $adm->dept_id;
				$data['student_type'] = $adm->student_type;
				
		 $check = $this->db->query("SELECT * FROM eduportal_admissions_screening WHERE application_no='".$adm->application_no."'")->row();
		if($check)
		{
		}
		else{
		
				$this->db->insert('eduportal_admissions_screening', $data);
		}
   //$this->db->where('application_no', $id);
   // $this->db->delete('eduportal_admission_list');
	
	//   $this->db->where('application_no', $id);
   // $this->db->delete('YABATECHedu1_admission.eduportal_admission_list');
    $this->session->set_flashdata('flash_message', get_phrase('student_was_screened_successfully_status:_failed!'));
   redirect(base_url().'index.php?sadmin/screen_students', 'refresh');
	}
	
		  function view_screened_students()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM eduportal_admissions_screening")->result_array();
        
        $page_data['page_name']  = 'view_screened_students';

        $page_data['page_title'] = get_phrase('view_screened_applicants');

        $this->load->view('backend/index', $page_data);

    }
	
	
		  function view_screened_applicants()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

$db2= $this->load->database("db2",TRUE);
        $page_data['applicants'] = $db2->query("SELECT * FROM hnd_applicants_form WHERE olevelscreened>0 and progress_step='3'")->result_array();
         
        $page_data['page_name']  = 'view_screened_applicants2';
$page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('screened_applicants');

        $this->load->view('backend/index', $page_data);
     

    }
	
	
	
		  function view_screened_applicants_failed()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

$db2= $this->load->database("db2",TRUE);
        $page_data['applicants'] = $db2->query("SELECT * FROM hnd_applicants_form WHERE olevelscreened='1' and progress_step='3'")->result_array();
         
        $page_data['page_name']  = 'view_screened_applicantsfailed';
$page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_failed');

        $this->load->view('backend/index', $page_data);
     

    }
	
		  function view_screened_succesful_students()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        $page_data['admlist'] = $this->db->query("SELECT * FROM eduportal_admissions_screening where screening_result='1'")->result_array();
        
        $page_data['page_name']  = 'view_screened_passed_students';

        $page_data['page_title'] = get_phrase('successfull_applicants');

        $this->load->view('backend/index', $page_data);

    }
	
	
	function fees_payment_breakdown()
	{

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'remita_fees_breakdown';

        $page_data['page_title'] = get_phrase('Remita_School_fees_Breakdown_Summary');

        $this->load->view('backend/index', $page_data);

    }
	
    function generate_payment_reports()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		
			$page_data['page_name']  = 'generate_payment_report';
		

        $page_data['page_title'] ="Generate Payment Reports";

        $this->load->view('backend/index', $page_data);
	}

	// GENERATING SCHOOL FEES PAYMENT FOR BURSARY MODULES YABATECH ERP


	 function generate_acceptance_payment_reports()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		
			$page_data['page_name']  = 'generate_acceptance_payment_report';
		

        $page_data['page_title'] ="Generate Acceptance Payment Reports";

        $this->load->view('backend/index', $page_data);
	}

	function processAcceptanceFeesPaymentReports()
	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
						
			  $academic_session = $this->input->post('academic_session');
			  $programmeType = $this->input->post('programmeType');
			  $schoolID = $this->input->post('schoolID');
			  $depts = $this->input->post('depts');
			 $ptype = $this->input->post('ptype');
			 $page_data['paymentType']= $ptype;
						 
		    if($ptype==4){
			$page_data['payments']= $this->db->query("SELECT * FROM eduportal_admission_list a 
		inner join  eduportal_remita_accp_temp_data e ON  a.application_no=e.putme_id WHERE  a.dept_id='$depts'
			and a.session='$academic_session' and a.programme_type_id='$programmeType' and e.status='Approved' ")->result_array();
	      }
		$page_data['page_name']  = 'acceptancepaymentreports';
	    
       $page_data['page_title'] ="YABATECH Payment Reports";
     

        $this->load->view('backend/index', $page_data);
	}
	 function generate_other_payment_reports()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		
			$page_data['page_name']  = 'generate_other_payment_report';
		

        $page_data['page_title'] ="Generate Other Payment Reports";

        $this->load->view('backend/index', $page_data);
	}

	function processOtherFeesPaymentReports()
	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
						
			 $date1 = $this->input->post('date1');
			 $date2 = $this->input->post('date2');
			 
			 $ptype = $this->input->post('ptype'); 
			 $page_data['paymentType']= $ptype;
					 
		    
			$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  paymentName='$ptype' AND	status='Approved' and (dategenerated BETWEEN '$date1 00:00:00' AND '$date2 00:00:00' )   ")->result_array();
	      
		$page_data['page_name']  = 'other_payment_reports';
	    
       $page_data['page_title'] ="YABATECH Payment Reports";
     

        $this->load->view('backend/index', $page_data);
	}

	
	function processSchoolFeesPayments()
	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
						
			 $academic_session = $this->input->post('academic_session');
			 $programme = $this->input->post('programme');
			 $school_fees_optn_reprt = $this->input->post('school_fees_optn_reprt');
			 $schoolID = $this->input->post('schoolID');
			 $programme_level = $this->input->post('programme_level');
			 $date_1 = $this->input->post('report_begin_date');
			 $date_2 = $this->input->post('report_end_date');
		     $checkSession=substr("$academic_session",0,4);
			 $page_data['checkSession']=$checkSession;
			 $page_data['programme_level']=$programme_level;
			
			if($checkSession>2018){
			
		if($programme==1 && $school_fees_optn_reprt==1){
			
				$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a 
		inner join  applicationinvoice_gen g ON  a.payment_code=g.rrr WHERE  g.status='Approved'
			and g.acadsession='$academic_session' and g.paymentid=5 ")->result_array();

		}
		
		elseif($programme==1 && $school_fees_optn_reprt==2){
			
		}
		elseif($programme==1 && $school_fees_optn_reprt==3){
				$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a 
		inner join  applicationinvoice_gen g ON  a.payment_code=g.rrr WHERE  g.status='Approved'
			and g.acadsession='$academic_session' and g.paymentid=5 and 
			(a.payment_date between '$date_1' and '$date_2') order by a.payment_date")->result_array();
		}
		elseif($programme==2 && $school_fees_optn_reprt==1){
					$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a 
		inner join  applicationinvoice_gen g ON  a.payment_code=g.rrr WHERE  g.status='Approved'
			and g.acadsession='$academic_session' and g.paymentid=70 ")->result_array();
		}
		elseif($programme==2 && $school_fees_optn_reprt==2){
				
		}
		elseif($programme==2 && $school_fees_optn_reprt==3){
			$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a 
		inner join  applicationinvoice_gen g ON  a.payment_code=g.rrr WHERE  g.status='Approved'
			and g.acadsession='$academic_session' and g.paymentid=70 and 
			(a.payment_date between '$date_1' and '$date_2') order by a.payment_date")->result_array();
		}
		else{
					$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a 
		inner join  applicationinvoice_gen g ON  a.payment_code=g.rrr WHERE  g.status='Approved'
			and g.acadsession='$academic_session' and (g.paymentid=70 OR g.paymentid=5 ) ")->result_array();
		}
	 }
	if($checkSession<2019){
		// ND1 AND HND 1 SCHOOL FEES ACTIVITIES
		if($programme==1 && $school_fees_optn_reprt==1 && $programme_level==1 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=5 AND (payerID like '8%' OR payerID like '96%') and programName  like 'ND%' ")->result_array();

		}
			if($programme==1 && $school_fees_optn_reprt==1 && $programme_level==2 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=5 AND payerID like 'YCT%' and programName  like 'HND%'  ")->result_array();

		}
		if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==1 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND payerID like 'YCT%' and programName  like 'ND%'  ")->result_array();

		}
		if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==2 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND payerID like 'YCT%' and programName  like 'HND%'  ")->result_array();

		}
		// ND 2 AND HND 2 SCHOOL FEES ACTIVITIES
		
		  /** begining of full time**/
		if($programme==1 && $school_fees_optn_reprt==1 && $programme_level==3 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=5 AND payerID like 'F/ND%'  and programName  like 'ND%' ")->result_array();

		}
			if($programme==1 && $school_fees_optn_reprt==1 && $programme_level==4 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=5 AND payerID like 'F/HD%'  and programName  like 'HND%' ")->result_array();

		}
		/**Beginning of Part Time**/
		if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==3 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND payerID like 'P/ND%'  and programName  like 'ND%' ")->result_array();

		}
			if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==4 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND payerID like 'P/HD%'  and programName  like 'HND%' ")->result_array();

		}
		
		if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==5 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND (payerID like 'P/ND/15%' OR payerID like 'P/ND/16%' ) 
			and programName  like 'ND%' ")->result_array();

		}
		if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==6 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 AND (payerID like 'P/HD/15%' OR payerID like 'P/HD/16%') 
			and programName  like 'HND%' ")->result_array();

		}
			if($programme==1 && $school_fees_optn_reprt==1 && $programme_level==9 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=5 ")->result_array();
		}
			if($programme==2 && $school_fees_optn_reprt==1 && $programme_level==9 ){
			
		$page_data['payments']= $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  status='Approved'
			and acadsession='$academic_session' and paymentid=70 ")->result_array();
		}
		
	}
		$page_data['page_name']  = 'remita_reports';
	    
    $page_data['page_title'] ="YABATECH Payment Reports";
       // $page_data['page_title'] = $this->db->get_where('application_type', array("application_typeid" => $payment_type))->application_type;

        $this->load->view('backend/index', $page_data);
	}
	
	// school fee report functions 
	
	    function school_fees_report()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		
			$page_data['page_name']  = 'generate_schoolfees_reports_view';
		

        $page_data['page_title'] ="Generate School Fees Payment Reports";

        $this->load->view('backend/index', $page_data);
	}
		
	function processSchoolPayments()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		//$session = $this->input->post('session');
$payment_type = $this->input->post('ptype');
$date_1 = $this->input->post('report_begin_date');
$date_2 = $this->input->post('report_end_date');
//echo $payment_type.$date_1.$date_2;
$page_data['payments']= $this->db->query("SELECT * FROM eduportal_fees_payment_log a, student b, department c, schools d WHERE a.student_id=b.student_id and b.dept=c.deptID and a.payment_fee_type='$payment_type' and d.schoolid=b.school and (a.payment_date between '$date_1' and '$date_2') order by a.payment_date")->result_array();


		
		$page_data['page_name']  = 'remita_reports';
	    
    $page_data['page_title'] ="YABATECH Payment Reports";
       // $page_data['page_title'] = $this->db->get_where('application_type', array("application_typeid" => $payment_type))->application_type;

        $this->load->view('backend/index', $page_data);
	}
	
	/*---- END OF BURSARY SECTION IMPLEMENTATION FOR ERP(YABATECH)*/
	
	function hostelAllocation($param1){
		session_start();
		
		if ($this->session->userdata('sadmin_login') != 1)
			redirect(base_url(), 'refresh');
		
		if($this->session->userdata('level') != '5')
			redirect(base_url(), 'refresh');
		
		if($param1 == 'reservedRooms'){
			$page_data['rooms'] = $this->db->get('eduportal_reserved_rooms')->result_array();
			$page_data['page_name'] = 'reservedRooms';
			$page_data['page_title'] = get_phrase('Reserved Rooms');
			$this->load->view('backend/index', $page_data);
		}
		if($param1 == 'hostel_i'){
			$page_data['rooms'] = $this->db->get_where('eduportal_hostel_i', array("status" => 'empty'))->result_array();
			$page_data['page_name'] = 'hostel_i';
			$page_data['page_title'] = get_phrase('Hostel I');
			$this->load->view('backend/index', $page_data);
		}
		if($param1 == 'doAllocation'){
			//get the values from form
			$portalID = $this->input->post('id');
			$accommodation = $this->input->post('accommodation');
			$space = $this->input->post('space');
			$serial = $this->input->post('serial');
			$pin = $this->input->post('pin');
			
			//check for valid putme id
			if($portalID == '' || empty($portalID) || strlen($portalID) != 11 || substr($portalID, 0, 3) != 'AVN'){
				//return error
				$_SESSION['error'] = 'Invalid Portal ID Supplied';
				redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
			}
			
			
			//check that the portalid is registered
			$registered  = $this->crud_model->getStudentByPortalID($portalID);
			
			if($registered){
				
				//check for valid card
				$validCard = $this->crud_model->validCard($serial, $pin);
				
				if($validCard){
					
					
					//check if card have been used already
					$usedCard = $this->crud_model->usedCard($serial, $pin);
					
					if($usedCard == 'Taken'){
						//throw error
						$_SESSION['error'] = 'Scratch card has been used';
						redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
					}else{
						
						//split the supplied accomodation_pins
						$split = explode('/', $accommodation);
						$hostel = trim($split[0]);
						$room = trim($split[1]);
						
						//then check if accommodation have been taken
						$taken = $this->crud_model->checkTakenAccommodation($hostel, $room, $space);
						
						if($taken){
							//get student that accommodation was assigned to
							$assignedStudent = $this->crud_model->getStudentByPortalID($taken->portal_id);
							
							//throw error
							$_SESSION['error'] = 'Accommodation have been assigned to ' . $assignedStudent->name . ' ' . $assignedStudent->othername . '. Please select another!';
							redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
							
						}
						
						//check if student have already been assigned accommodation
						$alreadyAssigned = $this->crud_model->checkStudentAllocation($portalID);
						
						if($alreadyAssigned){
							
							//throw error
							$_SESSION['error'] = 'Student have already been assigned accommodation';
							redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
						}
						
						$this->crud_model->doReservedAllocation($hostel, $room, $space, $registered->student_id, $registered->portal_id, $serial, $pin);
						
						$this->crud_model->updateCard($serial, $pin);
						
						//return success message
						$_SESSION['success'] = $hostel . ' Room ' . $room . ' Space ' . $space . ' has been assigned to ' . $registered->name . ' ' . $registered->othername;
						redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
					}
				}else{
					//error
					$_SESSION['error'] = 'Invalid card serial / pin combination';
					redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
				}
				
				
			}else{
				//throw error
				$_SESSION['error'] = 'Portal ID supplied is not registered';
				redirect(base_url() . 'index.php?sadmin/hostelAllocation/reservedRooms');
			}
		}
		if($param1 == 'allocateHostel_i'){
			//get the values from form
			$portalID = $this->input->post('id');
			$accommodation = $this->input->post('accommodation');
			$serial = $this->input->post('serial');
			$pin = $this->input->post('pin');
			
			//check for valid putme id
			if($portalID == '' || empty($portalID) || strlen($portalID) != 11 || substr($portalID, 0, 3) != 'AVN'){
				//return error
				$_SESSION['error'] = 'Invalid Portal ID Supplied';
				redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
			}
			
			//check that the portalid is registered
			$registered  = $this->crud_model->getStudentByPortalID($portalID);
			
			if($registered){
				
				//check of student is a year one student
				if($this->db->get_where('student', array("portal_id" => $portalID))->row()->adm_session == '2015/2016'){
				
				//check for valid card
					$validCard = $this->crud_model->validCard($serial, $pin);
					
					if($validCard){
						
						
						//check if card have been used already
						$usedCard = $this->crud_model->usedCard($serial, $pin);
						
						if($usedCard == 'Taken'){
							//throw error
							$_SESSION['error'] = 'Scratch card has been used';
							redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
						}else{
							
							//split the supplied accomodation_pins
							$split = explode('/', $accommodation);
							$hostel = 'HOSTEL I';
							$room = trim($split[0]);
							$space = trim($split[1]);
							
							//then check if accommodation have been taken
							$taken = $this->crud_model->checkTakenAccommodation($hostel, $room, $space);
							
							if($taken){
								//get student that accommodation was assigned to
								$assignedStudent = $this->crud_model->getStudentByPortalID($taken->portal_id);
								
								//throw error
								$_SESSION['error'] = 'Accommodation have been assigned to ' . $assignedStudent->name . ' ' . $assignedStudent->othername . '. Please select another!';
								redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
								
							}
							
							//check if student have already been assigned accommodation
							$alreadyAssigned = $this->crud_model->checkStudentAllocation($portalID);
							
							if($alreadyAssigned){
								
								//throw error
								$_SESSION['error'] = 'Student have already been assigned accommodation';
								redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
							}
							
							//do the allocation
							$this->crud_model->doReservedAllocation($hostel, $room, $space, $registered->student_id, $registered->portal_id, $serial, $pin);
							//update the status of the hostel
							$this->crud_model->updateHostel_i($hostel, $room, $space);
							
							//then update the card
							$this->crud_model->updateCard($serial, $pin);
							
							//return success message
							$_SESSION['success'] = $hostel . ' Room ' . $room . ' Space ' . $space . ' has been assigned to ' . $registered->name . ' ' . $registered->othername;
							redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
						}
					}else{
						//error
						$_SESSION['error'] = 'Invalid card serial / pin combination';
						redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
					}
				}else{
					//error
					$_SESSION['error'] = 'Not a year one student!';
					redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
				}
				
				
			}else{
				//throw error
				$_SESSION['error'] = 'Portal ID supplied is not registered';
				redirect(base_url() . 'index.php?sadmin/hostelAllocation/hostel_i');
			}
		}
	}
	
	function do_ajax($param1 = '', $param2 = '', $param3 = ''){
		/*if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');*/
		
		if($param1 == 'search'){
			$type = $param2;
			
			/*$this->db->get('courses');
			$this->db->like('course_name', $type);
			$this->db->or_like('course_code', $type);
			$this->db->or_like('prog_type', $type);*/

			$page_data['svalue'] = $param2;
			$this->load->view('backend/search', $page_data);
			
			//echo $type;
		}
		
		if($param1 == 'edit'){

			$page_data['svalue'] = $param2;
			$this->load->view('backend/editData', $page_data);
			
			//echo $type;
		}
		
	}
	
	function putme_registration_details(){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['regDetails'] = $this->db->get('putme_students')->result_array();
		$page_data['page_name'] = 'putme_registration_details';
		$page_data['page_title'] = 'POST-UTME Student Registration Details';
		$this->load->view('backend/index', $page_data);
		
	}
	function putme_student_details(){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name'] = 'putme_student_details';
		$page_data['page_title'] = 'Post Utme Student Details';
		$this->load->view('backend/index', $page_data);
	}
	
	function updateCourseDetails($param1 = '', $param2 = '', $param3 = ''){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1 == 'details'){
			$page_data['course_name'] = $this->input->post('coursename');
			$page_data['course_code'] = $this->input->post('coursecode');
			$page_data['credit_load'] = $this->input->post('creditload');
			$page_data['course_semester'] = $this->input->post('coursesemester');
			$page_data['course_year'] = $this->input->post('courseyear');
			$page_data['prog_type'] = $this->input->post('progtype');
			
			$this->db->where('course_code', $this->input->post('hidecode'));
			$updatedRecord = $this->db->update('courses', $page_data);
			
			session_start();
			$_SESSION['report'] = "Course details have been updated successfully.";
			redirect(base_url() . 'index.php?sadmin/course_management');
		}
		
		if($param1 == 'head'){
			
			$page_data['course_lecturer'] = $this->input->post('courselecturer');
			
			$this->db->where('course_code', $this->input->post('hidecode'));
			$updatedRecord = $this->db->update('courses', $page_data);
			
			session_start();
			$_SESSION['report'] = "Course Head have been successfully registered.";
			redirect(base_url() . 'index.php?sadmin/course_management');
		}
		
		if($param1 == 'dept'){
			
			$page_data['school'] = $this->input->post('school');
			$page_data['department'] = $this->input->post('department');
			
			$this->db->where('course_code', $this->input->post('hidecode'));
			$updatedRecord = $this->db->update('courses', $page_data);
			
			session_start();
			$_SESSION['report'] = "Course originating department have been successfully registered.";
			redirect(base_url() . 'index.php?sadmin/course_management');
			
		}
		
		if($param1 == 'depts'){
			
			$cload = $this->input->post('cload');
			$dpt = $this->input->post('dpt');
			
			//var_dump($cload);
			
			
			for($i = 0; $i < count($dpt); $i++){
				
				$data['department'] = $dpt[$i];
				$data['course_code'] = $this->input->post('hidecode');
				$data['credit_load'] = $cload[$i];
				
				$this->db->insert('department_credit_load', $data);
			}
			session_start();
			$_SESSION['report'] = "Credit load for individual departments have been set successfully.";
			redirect(base_url() . 'index.php?sadmin/course_management');
			
		}
		
		
		/*
		$page_data['course_name'] = $this->input->post('coursename');
		$page_data['course_code'] = $this->input->post('coursecode');
		$page_data['credit_load'] = $this->input->post('creditload');
		$page_data['course_semester'] = $this->input->post('coursesemester');
		$page_data['course_year'] = $this->input->post('courseyear');
		$page_data['prog_type'] = $this->input->post('progtype');
		//$page_data['course_lecturer'] = $this->input->post('courselecturer');
		//$page_data['school'] = $this->input->post('school');
		//$page_data['department'] = $this->input->post('department');
		
		$this->db->where('course_code', $this->input->post('hidecode'));
		$updatedRecord = $this->db->update('courses', $page_data);
		
		//$cload = $this->input->post('cload');
		//$dpt = $this->input->post('dpt');
		//var_dump($cload);
		
		/*
		echo "<pre>";
		echo print_r($cload);
		echo "</pre>";
		
		echo "<pre>";
		echo print_r($dpt);
		echo "</pre>";
		*/
		
		//if($updatedRecord){
			
			/*for($i = 0; $i < count($dpt); $i++){
				//
				$data['department'] = $dpt[$i];
				$data['course_code'] = $this->input->post('coursecode');
				$data['credit_load'] = $cload[$i];
				
				$this->db->insert('department_credit_load', $data);
			}*/
			/*
			session_start();
			$_SESSION['report'] = "Course details have been updated successfully.";
			redirect(base_url() . 'index.php?sadmin/course_management');
		} */
		
	}
	
	function student_portal($param1 = '', $param2 = '', $param3 = ''){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        /******MANAGE STUDENT PROFILE AND CHANGE PASSWORD***/

        if ($param1 == 'update_profile') {
		$school =$this->input->post('school');
		if($school=='1')
		{
		$sch ="SCHOOL OF AGRIC AND VOCATIONAL STUDIES";
		}
		elseif($school=='2')
		{
		$sch ="SCHOOL OF NATURAL SCIENCES";
		}
		elseif($school=='3')
		{
		$sch ="SCHOOL OF SOCIAL SCIENCES";
		}
		elseif($school=='4')
		{
		$sch ="SCHOOL OF ARTS";
		}
		elseif($school=='5')
		{
		$sch ="SCHOOL OF EDUCATION";
		}
		elseif($school=='6')
		{
		$sch ="SCHOOL OF GENERAL STUDIES";
		}
		
		
            $student_id        = $this->input->post('student_id');
            $data['name']        = $this->input->post('name');
            $data['othername']   = $this->input->post('othername');
            $data['birthday']    = $this->input->post('birthday');
            $data['reg_no']    = $this->input->post('reg_no');
            $data['sex']           = $this->input->post('sex');
            $data['religion']       = $this->input->post('religion');
            $data['blood_group']    = $this->input->post('blood_group');
            $data['address']        = $this->input->post('address');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            $data['marital_status'] = $this->input->post('marital_status');
            $data['nationality'] = $this->input->post('nationality');
            $data['state']       = $this->input->post('state');
            $data['title']       = $this->input->post('title');
            $data['lga']         = $this->input->post('lga');
            $data['dept']        = $this->input->post('dept');
            $data['programme']   = $this->input->post('programme');
            $data['school']      = $sch;
            $data['prog_type']   = $this->input->post('prog_type');
            $data['level']       = $this->input->post('level');
            $data['semester']    = $this->input->post('semester');
            $data['parent_name']        = $this->input->post('parent_name');
            $data['parent_phone']       = $this->input->post('parent_phone');
            $data['parent_address']     = $this->input->post('parent_address');
            $data['password']             = $this->input->post('password');



            $this->db->where('student_id', $student_id);
            $this->db->update('student', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            echo 'Account has been updated Successfully';
            return $data['name'];
            //return $data['name'];
        }

        if ($param1 == 'etz') {

        	echo 'Updates are currently going on for this function';
        	return 0;

        	$serial = $this->input->post('serial');

        	$student = $this->db->get_where('etranzact_payment', array("customer_id" => $serial))->row();
        	if($student){
        	//	var_dump($serial);
        	//return 0;
        	var_dump($serial);
        	$sql = "UPDATE etranzact_payment INNER JOIN student ON (student.reg_no = 'BD/12/60364') SET etranzact_payment.prog_type = student.prog_type,etranzact_payment.dept = student.dept,etranzact_payment.level = student.level,etranzact_payment.cust_add = student.address,etranzact_payment.phone = student.phone,etranzact_payment.used_by = 'BD/12/60364',etranzact_payment.status = 'Paid',etranzact_payment.session = '2014/2015'"; 
			//$this->db->query($sql, array('Paid','2014/2015'));
			$this->db->query($sql);
			$afftectedRws = $this->db->affected_rows();
			echo $afftectedRws;
			return 0;

			}else{
				echo 'Student payment Records for '.$serial.' was not found';
				return 0;
			}

        	
        }
        if ($param1 == 'change_picture') {

	        //$student_id = (int)$student_id;
	        $student_id = $this->input->post('student_id');
	        //var_dump($student_id);
	        //return $student_id;

	        $max_file_size = 51200;

	      $imagesize = $_FILES['userfile']['size'];
	      $signsize = $_FILES['usersign']['size'];
	      //var_dump($signsize);
	      //var_dump($imagesize);
	      //return $student_id;
	      if($imagesize <= 0 || $signsize <= 0){
	      		echo "No image has been uploaded.";
	      		return FALSE;
	      }
	      elseif($imagesize > $max_file_size){
	        $_SESSION['imgerror'] = "Passport image size is too large. Please upload an image less than 50kb";
	        echo "Passport image size is too large. Please upload an image less than 50kb";
	        return FALSE;
	      }elseif($signsize > $max_file_size){
	        $_SESSION['imgerror'] = "Signature image size is too large. Please upload an image less than 50kb";
	        echo "Signature image size is too large. Please upload an image less than 50kb";
	        return FALSE;
	      }else{
	        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
	        $this->crud_model->clear_cache();

	        move_uploaded_file($_FILES['usersign']['tmp_name'], 'uploads/student_signature/' . $student_id . '.jpg');
	        $this->crud_model->clear_cache();

	        echo 'Picture and Signature Have been updated Successfully';
	        return true;
	      }
  	  }
		
		$page_data['page_title'] = get_phrase('Alvan Ikoku Federal University Of Education | Student Portal');
		$page_data['page_name'] = 'student_portal';
		$this->load->view('backend/student_portal', $page_data);
	}
	
	function course_management(){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		$nceCourses = $this->db->get_where('courses', array("prog_type" => 'NCE'))->result_array();
		$degreeCourses = $this->db->get_where('courses', array("prog_type" => 'DEGREE'))->result_array();
		
		$this->db->select('programmes.programme');
		$this->db->distinct();
		$this->db->from('programmes');
		$prog = $this->db->get()->result_array();
		
		
		$page_data['nceCourses'] = $nceCourses;
		$page_data['degreeCourses'] = $degreeCourses;
		$page_data['prog'] = $prog;
		$page_data['page_title'] = $this->app_system_name() . ' | Course Management';
		$page_data['page_name'] = 'course_management';
		$this->load->view('backend/course_management', $page_data);
	}

	function grading($param1 = '', $param2 = ''){
		
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		
		$grades = $this->db->get('grade_scale')->result_array();
		$page_data['grade'] = $grades;
		$page_data['page_title'] = get_phrase('Grading System');
		$page_data['page_name'] = 'grading_system';
		$this->load->view('backend/index', $page_data);
		
		if($param1 == 'edit'){
			
			redirect(base_url() . 'index.php?sadmin/gradeOptions/edit/' . $param2);
			
		}
	}
	
	function gradeOptions($param1 = '', $param2 = ''){
	
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
	
		if($param1 == 'edit'){
			$page_data['id'] = $param2;
			$page_data['page_name'] = 'edit_grade';
			$page_data['page_title'] = 'Edit Grade';
			$this->load->view('backend/index', $page_data);
		}
		if($param1 == 'add'){
			$page_data['page_name'] = 'add_grade';
			$page_data['page_title'] = 'Add Grade';
			$this->load->view('backend/index', $page_data);
		}
		if($param1 == 'addGrade'){
			if($this->input->post('grade') == '')
			redirect(base_url(), 'refresh');
			
			$data['grade'] = $this->input->post('grade');
			$data['percent'] = $this->input->post('percent');
			$data['count_in_gpa'] = $this->input->post('count');
			$data['points'] = $this->input->post('points');
			$data['status'] = $this->input->post('status');
			
			$insertedGrade = $this->db->insert('grade_scale', $data);
			//var_dump();
			if($insertedGrade){
				session_start();
				$_SESSION['report'] = 'New Grade Successfully Created!';
				redirect(base_url() . 'index.php?sadmin/gradeOptions/add');
			}
			
		}
		if($param1 == 'editGrade'){
			if($this->input->post('grade') == '')
			redirect(base_url(), 'refresh');
			
			$data['grade'] = $this->input->post('grade');
			$data['percent'] = $this->input->post('percent');
			$data['count_in_gpa'] = $this->input->post('count');
			$data['points'] = $this->input->post('points');
			$data['status'] = $this->input->post('status');
			$id = $this->input->post('id');
			
			$this->db->where('ID', $id);
			$updatedGrade = $this->db->update('grade_scale', $data);
			//var_dump();
			if($updatedGrade){
				session_start();
				$_SESSION['report'] = 'Grade Successfully Updated!';
				redirect(base_url() . 'index.php?sadmin/grading');
			}
			
		}
		
		if($param1 == 'delete'){
			
			$id = $this->input->post('id');
			
			$this->db->where('ID', $param2);
			$updatedGrade = $this->db->delete('grade_scale');
			//var_dump();
			if($updatedGrade){
				session_start();
				$_SESSION['report'] = 'Grade Successfully Deleted!';
				redirect(base_url() . 'index.php?sadmin/grading');
			}
			
		}
	}
	
	function credit_load(){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['creditLoad'] = $this->db->get('credit_load')->result_array();
		$page_data['page_name'] = 'credit_load';
		$page_data['page_title'] = 'Credit Load';
		$this->load->view('backend/index', $page_data);
		
	}


    /****MANAGE STUDENTS CLASSWISE*****/

	function student_add()

	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



		$page_data['page_name']  = 'student_add';

		$page_data['page_title'] = get_phrase('add_student');

		$this->load->view('backend/index', $page_data);

	}

	//Add courses
	function courses($param1 = ''){
		if($this->session->userdata('sadmin_login') != 1)
			redirect(base_url(), 'refresh');
		
		/*$this->db->select('department.deptName');
		$this->db->distinct();
		$this->db->from('department');
		$this->db->join('schools', 'department.schoolid = schools.schoolid', 'inner');
		
		$dept = $this->db->get()->result_array();*/
		$courses = $this->db->get('courses')->result_array();
		$schools = $this->db->get('schools')->result_array();
		$lect = $this->db->get('course_heads')->result_array();
		
		$this->db->select('programmes.programme');
		$this->db->distinct();
		$this->db->from('programmes');
		$prog = $this->db->get()->result_array();
		
		/*echo "<pre>";
		echo print_r($dept);
		echo "</pre>";*/
		//var_dump($dept);
		
		if($param1 == 'insert_course'){
			
			if($this->input->post('coursename') != ''){
				$page_data['course_name'] = ucwords(strtolower($this->input->post('coursename')));
				$page_data['credit_load'] = $this->input->post('creditload');
				$page_data['course_code'] = strtoupper($this->input->post('coursecode'));
				$page_data['course_year'] = $this->input->post('courseyear');
				$page_data['course_semester'] = $this->input->post('coursesemester');
				$page_data['prog_type'] = $this->input->post('progtype');
				$page_data['inserted_by'] = $this->session->userdata('name');
				
				//check if there's a record already in the database
				$registeredCourse = $this->db->get_where('courses', array("course_code" => $page_data['course_code']))->row();
				if($registeredCourse){
					session_start();
					$_SESSION['report'] = 'Course has already been registered. Please register another course.';
					redirect(base_url() . 'index.php?sadmin/course_management');
				}else{
					$insertedCourse = $this->db->insert('courses', $page_data);
					if($insertedCourse){
						//$this->session->set_userdata('report', 'Course have been recorded');
						session_start();
						$_SESSION['report'] = 'Course have been successfully created';
						redirect(base_url() . 'index.php?sadmin/course_management');
						
					}
				}
				
				/*$page_data['course_lecturer'] = $this->input->post('courselecturer');
				$page_data['department'] = $this->input->post('department');
				$page_data['school'] = $this->input->post('school');*/
				
				/*
				$this->db->select('deptID');
				$deptid = $this->db->get_where('department', array("deptName" => $this->input->post('department')))->row();
				$page_data['department'] = $deptid->deptID;
				
				$this->db->select('schoolid');
				$schoolid = $this->db->get_where('schools', array("schoolname" => $this->input->post('school')))->row();
				$page_data['school'] = $schoolid->schoolid;
				*/
				
				
				//$this->session->unset_userdata('report');
			}else{
				redirect(base_url(), 'refresh');
				$this->session->unset_userdata('report');
			}
			
				
		}
		if($param1 == 'upload_excel'){
			
			move_uploaded_file($_FILES['excelfile']['tmp_name'], 'uploads/courses_import.xlsx');
			// Importing excel sheet for bulk student uploads

			include 'simplexlsx.class.php';

			$xlsx = new SimpleXLSX('uploads/courses_import.xlsx');

			list($num_cols, $num_rows) = $xlsx->dimension();
			$f = 0;
			foreach( $xlsx->rows() as $r )
			{
				// Ignore the inital name row of excel file
				if ($f == 0)
				{
					$f++;
					continue;
				}
				for( $i=0; $i < $num_cols; $i++ )
				{
					if ($i == 0)		$data['course_name'] = $r[$i];
					else if ($i == 1)	$data['course_code'] = $r[$i];
					else if ($i == 2)	$data['credit_load'] = $r[$i];
					else if ($i == 3)	$data['course_year'] = $r[$i];
					else if ($i == 4)	$data['course_semester'] = $r[$i];
					else if ($i == 5)	$data['course_lecturer'] = $r[$i];
					else if ($i == 6)	$data['school'] = $r[$i];
					else if ($i == 7)	$data['department'] = $r[$i];
					else if ($i == 8)	$data['prog_type'] = $r[$i];
				}
				//$data['class_id']	=	$this->input->post('class_id');

				$uploaded_excel = $this->db->insert('courses' , $data);
				if($uploaded_excel){
					$this->session->set_userdata('report', 'Excel Course have been recorded');
				}else{
					redirect(base_url() . 'index.php', 'refresh');
				}
				//print_r($data);
			}
			//redirect(base_url() . 'index.php?admin/student_information/' . $this->input->post('class_id'), 'refresh');
		}
		
		$page_data['courses'] = $courses;
		$page_data['lect'] = $lect;
		$page_data['schools'] = $schools;
		$page_data['dept'] = $dept;
		$page_data['prog'] = $prog;
		$page_data['page_name'] = 'courses';
		$page_data['page_title'] = get_phrase('add_courses');
		$this->load->view('backend/index', $page_data);
	}

	function student_bulk_add($param1 = '')

	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



		if ($param1 == 'import_excel')

		{

			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx');

			// Importing excel sheet for bulk student uploads



			include 'simplexlsx.class.php';



			$xlsx = new SimpleXLSX('uploads/student_import.xlsx');



			list($num_cols, $num_rows) = $xlsx->dimension();

			$f = 0;

			foreach( $xlsx->rows() as $r )

			{

				// Ignore the inital name row of excel file

				if ($f == 0)

				{

					$f++;

					continue;

				}

				for( $i=0; $i < $num_cols; $i++ )

				{

					if ($i == 0)	$data['name']				=	$r[$i];

					else if ($i == 1)	$data['birthday']		=	$r[$i];

					else if ($i == 2)	$data['sex']			=	$r[$i];

					else if ($i == 3)	$data['address']		=	$r[$i];

					else if ($i == 4)	$data['phone']			=	$r[$i];

					else if ($i == 5)	$data['email']			=	$r[$i];

					else if ($i == 6)	$data['password']		=	$r[$i];

					else if ($i == 7)	$data['roll']			=	$r[$i];

				}

				$data['class_id']	=	$this->input->post('class_id');



				$this->db->insert('student' , $data);

				//print_r($data);

			}

			redirect(base_url() . 'index.php?sadmin/student_information/' . $this->input->post('class_id'), 'refresh');

		}

		$page_data['page_name']  = 'student_bulk_add';

		$page_data['page_title'] = get_phrase('add_bulk_student');

		$this->load->view('backend/index', $page_data);

	}
    //function to display student login details
    function login_details($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        
    $page_data['invoices'] = $this->db->get('student')->result_array();
    $page_data['total'] = $this->db->get('student')->num_rows();

    $page_data['page_name']  = 'login_details';
    $page_data['page_title'] = get_phrase('Login Details');
    $this->load->view('backend/index', $page_data);
    }




   
    function upload_courses(){
   
    if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			include('application/config/z.php');
    $page_data['page_name']  = 'upload_courses';
    $page_data['page_title'] = "Upload Courses";
	 $page_data['conn'] = $conn;
    $this->load->view('backend/index', $page_data);
    }
	
	 function assign_credit_load(){
    if ($this->session->userdata('sadmin_login') != 1)

     redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'assign_credit_load';
    $page_data['page_title'] = "Assign Unit Load";
    $this->load->view('backend/index', $page_data);
    }


  function courses_assignment_report(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'courses_assignment_report';
    $page_data['page_title'] = "Course Assigment Report";
    $this->load->view('backend/index', $page_data);
    }

  function assign_course_to_dept(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'assign_course_to_dept';
    $page_data['page_title'] = "Assign Courses To Department";
    $this->load->view('backend/index', $page_data);
    }
	
	 function assign_course_to_dept_two(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		include('application/config/z.php');

	 $page_data['conn'] = $conn;
    $page_data['page_name']  = 'assign_course_to_dept2';
    $page_data['page_title'] = "Assign Courses To Department";
    $this->load->view('backend/index', $page_data);
    }
	
	 function ajax_assign_course_to_dept(){
		 
		 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		 
    $_SESSION["error"]="";
    foreach($_POST['course_id']  as $course_id) {

$data = array(
   'course_id'=> $course_id,
   'course_unit'=> $this->input->post("creditunit".$course_id),
   'course_type_id'=> $this->input->post("coursetype".$course_id),
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'student_mode_of_entry_id'=> $this->input->post('modeofentry'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'activated'=> "1",
   'programme_type_id'=> $this->input->post('programme_type_id')
   );
   $data2 = array(
   'course_id'=> $course_id,
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'programme_type_id'=>$this->input->post('programme_type_id')
   );

   
   $detailsexit = $this->db->get_where('course_assigned_to_department',$data2);
	if($detailsexit->num_rows() > 0)
	{
		
		$coursedetails = $this->db->get_where('eduportal_courses', array('course_id'=> $course_id))->row();
   $_SESSION["error"]= $_SESSION["error"]." ".$coursedetails->course_code." - ".$coursedetails->course_title." have already been assigned to this Class!<br>";
	}
	else
	{
	$course=$course_id;
		$credithr = $this->input->post("creditunit".$course_id);
		$ctype = $this->input->post("coursetype".$course_id);
	
		if($course==0 || $credithr==0 || $ctype==0)
		{
			 $_SESSION["error"] = "Some Course Details where not selected correctly!";
		}
		else
		{
	$this->db->insert('course_assigned_to_department',$data);
		}
	}
	}
	
	$page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'level'=> $this->input->post('level'),
   'semester'=> $this->input->post('semester'),
   'programme_type_id'=>$this->input->post('programme_type_id'),
   'modeofentry'=>$this->input->post('modeofentry'),
   'page_name'=>'view_assign_course_to_dept',
   'page_title'=>'Assign Courses To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
}


 function ajax_assign_course_to_dept_two(){
		 
		 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
				include('application/config/z.php');
  
	 
    $_SESSION["error"]="";
   for($course_id=1;$course_id<=10; $course_id++)
			  {
$coursedetails = $this->db->get_where('eduportal_courses', array('course_id'=> $this->input->post("course_id".$course_id)))->row();
$coursetypedetails = $this->db->get_where('course_type', array('course_type_id'=> $this->input->post("coursetype".$course_id)))->row();
//$semesterdetails = $this->db->get_where('course_type', array('course_type_id'=> $this->input->post("coursetype".$course_id)))->row();
$data = array(
   'course_id'=> $this->input->post("course_id".$course_id),
   'course_unit'=> $this->input->post("creditunit".$course_id),
   'course_type_id'=> $this->input->post("coursetype".$course_id),
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'student_mode_of_entry_id'=> $this->input->post('modeofentry'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'activated'=> "1",
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'user_id'=> $this->session->userdata('sadmin_id'),
   'ip_address' => $_SERVER['REMOTE_ADDR'],
   'datetime_of_activity' => date("d M Y H:i:s"),
   'c_code'=> $coursedetails->course_code,
   'c_title'=> $coursedetails->course_title,
   'c_type'=> $coursetypedetails->course_type_name,
   'sem'=> $this->input->post('sem'),
   'prog'=> $this->input->post('prog'),
   'departmt'=> $this->input->post('departmt'),
   'level_of_study'=> $this->input->post('level_of_study'),
   'sadmin_name'=> $this->input->post('sadmin_name'),
   'prog_type'=> $this->input->post('prog_type')
   );
   $data2 = array(
   'course_id'=> $this->input->post("course_id".$course_id),
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'programme_type_id'=>$this->input->post('programme_type_id')
   );


$data_audit = array(
   'course_id'=> $this->input->post("course_id".$course_id),
   'course_unit'=> $this->input->post("creditunit".$course_id),
   'course_type_id'=> $this->input->post("coursetype".$course_id),
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'student_mode_of_entry_id'=> $this->input->post('modeofentry'),
   'department_id'=>$this->input->post('depts'),
   'dept_option_id'=>$this->input->post('deptsoptions'),
   'year_of_study_id'=> $this->input->post('level'),
   'activated'=> "1",
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'type' => "INSERT",
   'user_id'=> $this->session->userdata('sadmin_id'),
   'ip_address' => $_SERVER['REMOTE_ADDR'],
   'activity_date_time' => date("d M Y H:i:s")
   );
   
   $detailsexit = $this->db->get_where('course_assigned_to_department',$data2);
	if($detailsexit->num_rows() > 0)
	{
		
	
   $_SESSION["error"]= $_SESSION["error"]." ".$coursedetails->course_code." - ".$coursedetails->course_title." have already been assigned to this Class!<br>";
	}
	else
	{
		$course=$this->input->post("course_id".$course_id);
		$credithr = $this->input->post("creditunit".$course_id);
		$ctype = $this->input->post("coursetype".$course_id);
	
		if($course==0 || $credithr==0 || $ctype==0)
		{
			 $_SESSION["error"] = "Some Course Details where not selected correctly!";
		}
		else
		{
	$this->db->insert('course_assigned_to_department',$data);
	$this->db->insert('course_assigned_to_department_audit_trail',$data_audit);
		}
	}
	}
	
	$page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'deptsoptions'=>$this->input->post('deptsoptions'),
   'level'=> $this->input->post('level'),
   'semester'=> $this->input->post('semester'),
   'programme_type_id'=>$this->input->post('programme_type_id'),
   'modeofentry'=>$this->input->post('modeofentry'),
   'page_name'=>'view_assigncourseto_dept_fast',
   'conn'=>$conn,
   'page_title'=>'Assign Courses To Department'
   );
   
   
    $this->load->view('backend/index', $page_data);
}


function update_course_assigned_to_dept_table()
{
$id1=1;
$query1 =mysql_query("
SELECT id, sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT, course_type_name FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i, course_type j where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.course_type_id=j.course_type_id  order by id") or die(mysql_error());
while(list($id,$sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2,$cu,$cty2) = mysql_fetch_array($query1))
{
echo $id." ".$code2."   $sname2, $cty2 ";
$id = $id1 + 1;

$data = array(
  
   'c_code'=> $code2,
   'c_title'=> $ct2,
   'c_type'=> $cty2,
   'sem'=> $sem2,
   'prog'=> $st2,
   'departmt'=> $dept2,
   'level_of_study'=> $yr2,
   'sadmin_name'=> $sname2,
   'prog_type'=> $prt2
   );
 $data2 = array(
 'id'=>$id
 );
 $this->db->where('id', $id);
 $this->db->update('course_assigned_to_department',$data);
}

}


function ajax_unassign_course_dept($course_assign_id){
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	
    $_SESSION["error"]="";
  
   $data2 = array(
   'course_assign_to_dept_id'=> $course_assign_id
   );
   
   
   $detailsexit = $this->db->get_where('courses_registered',$data2);
	if($detailsexit->num_rows() > 0)
	{
		
  //$coursedetails = $this->db->get_where('eduportal_courses', array('course_id'=> $course_id))->row();
   $_SESSION["error"]= " This Course have been registered by some students";
	}
	else
	{
	
	$this->db->where('id', $course_assign_id);
    $this->db->delete('course_assigned_to_department');
	}
 redirect('sadmin/view_assigned_courses');
	  
  
}

 function view_assigned_courses(){
	 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	include('application/config/z.php'); 
$page_data = array(
   'programme'=> $this->session->userdata('programme'),
   'school'=> $this->session->userdata('school'),
   'depts'=> $this->session->userdata('depts'),
   'deptsoptions'=>$this->session->userdata('deptsoptions'),
   'level'=> $this->session->userdata('levels'),
   'semester'=>$this->session->userdata('semester'),
   'programme_type_id'=> $this->session->userdata('programme_type_id'),
   'modeofentry'=> $this->session->userdata('modeofentry'),
   'page_name'=>'view_assigncourseto_dept_fast',
   'page_title'=>'Assign Courses To Department',
   'conn'=>$conn
   );
  $this->load->view('backend/index', $page_data);
  
 }



  function approve_registered_courses(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
 
    
	$page_data['page_name']  = 'approve_registered_courses';
    $page_data['page_title'] = "Approve Registered Courses";
    $this->load->view('backend/index', $page_data);
    }

   function ajax_view_student_coursereg()
   {
	   session_start();
	  
   if ($this->session->userdata('sadmin_login') != 1)

    redirect(base_url(), 'refresh');
	include('application/config/z.php');
	$_SESSION["error"]="";
	
    $data1 = array(
	'reg_no'=> $this->input->post('regno')
    );
   
    $regnoexit = $this->db->get_where('student',$data1);
	if($regnoexit->num_rows() > 0)
	{
	$student_details = $regnoexit->row();
		
	$page_data = array(
   'student_id'=>$student_details->student_id,
   'regno'=> $this->input->post('regno'),
   'semester'=> $this->input->post('semester'),
   'session_id'=>$this->input->post('session'),
   'level_id'=> $this->input->post('level'),
   'conn'=>$conn
   );	
	$page_data['page_name']  = 'view_student_registered_courses';
    $page_data['page_title'] = "Approve Registered Courses";
	$this->load->view('backend/index', $page_data);
	}
	
	else
	{
	$_SESSION["error"]="Sorry Regno / Matric No does not exit.";
	 redirect('sadmin/approve_registered_courses');	
	}
			
   }
   
    function view_courses_registered(){
  if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

   $page_data['page_name']  = 'view_courses_registered';
   $page_data['page_title'] = "View Courses Registered";
   $this->load->view('backend/index', $page_data);
   }


function view_student_course_registration(){
	if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');
	
include('application/config/z.php');
  $page_data = array(
  'programme'=> $this->input->post('programme'),
  'school'=> $this->input->post('school'),
  'depts'=> $this->input->post('depts'),
  'level'=> $this->input->post('level'),
  'dept_option_id'=> $this->input->post('deptsoptions'),
  'programme_type_id'=> $this->input->post('prog_type'),
  'semester'=> $this->input->post('semester'),
  'session'=> $this->input->post('session'),
  'page_name'=>'view_student_course_registration',
  'conn'=>$conn,
  'page_title'=>'Courses Assigned to Department Class/Level '
  );
  
  
   $this->load->view('backend/index', $page_data);
   }

   function courses_registration_status($id){
	   session_start();
    if ($this->session->userdata('sadmin_login') != 1)

             redirect(base_url(), 'refresh');
			 include('application/config/z.php');
	if($id=="On" || $id=="Off")
	{
		sqlsrv_query($conn,"update course_status set status='$id'") or die();
		$_SESSION['err_msg']="Status Changed to $id Successfully";
	}
     $page_data['page_name']  = 'courses_registration_status';
     $page_data['page_title'] = "courses_registration_status";
     $this->load->view('backend/index', $page_data);
     }
function approve_stduent_courses(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'approve_stduent_courses';
    $page_data['page_title'] = "Bulk Approve Registered Courses";
    $this->load->view('backend/index', $page_data);
    }

function ajax_coursereg_bulk_approval()
{
 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 session_start();
    $_SESSION["error"]="";	
	 $semester= $this->input->post('semester');
   $session_id=$this->input->post('session');
   $level_id= $this->input->post('level');
$datastu = $this->db->query("SELECT distinct student_id FROM courses_registered WHERE session='$session_id' and year_of_study='$level_id' and semester='$semester'")->row();	
	foreach($datastu as $row)	
	{
		
	$datafee = array(
   
   'student_id'=> $row["student_id"],
   'payment_session'=> $this->input->post('session'),
   'payment_fee_type '=> '2'
   );
  

   
    $detailsexit = $this->db->get_where('eduportal_fees_payment_log',$datafee);
	if($detailsexit->num_rows() <=0)
	{
   
	}
	else
	{	

		$data = array(
   'student_id'=>$row["student_id"],
   'semester'=> $this->input->post('semester'),
   'session'=>$this->input->post('session'),
   'year_of_study'=> $this->input->post('level')
   );
   
   		$data_approval = array(
   'sadmin_id'=> $this->session->userdata('sadmin_id'),
   'student_id'=>$row["student_id"],
   'year_of_study'=> $this->input->post('level'),
   'semester_id'=> $this->input->post('semester'),
   'session_id'=>$this->input->post('session'),
   'date_time_of_approval' => date("d M Y H:i:s"),
   'ip_address' => $_SERVER['REMOTE_ADDR']
   );
   
   $data1 = array(
   'approved'=>"1",
   );
   
 $this->db->where($data);	  
$this->db->update('courses_registered', $data1);
$this->db->insert('course_approval',$data_approval);
 $_SESSION["error"]="Courses Approved Successfully!";
	$page_data = array(
   'student_id'=>$row["student_id"],
   'semester'=> $this->input->post('semester'),
   'session_id'=>$this->input->post('session'),
   'level_id'=>$this->input->post('level')
   );	
	}
	}
	$_SESSION["err_msg"]="Courses Approved Successfully";
	header("Location: index.php?sadmin/approve_stduent_courses");
}
function ajax_coursereg_approval()
{
 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 
    $_SESSION["error"]="";	
	include('application/config/z.php');
		$data = array(
   'student_id'=>$this->input->post('studentid'),
   'semester'=> $this->input->post('semester'),
   'session'=>$this->input->post('session'),
   'year_of_study'=> $this->input->post('year_of_study')
   );
   
   		$data_approval = array(
   'sadmin_id'=> $this->session->userdata('sadmin_id'),
   'student_id'=>$this->input->post('studentid'),
   'year_of_study'=> $this->input->post('year_of_study'),
   'semester_id'=> $this->input->post('semester'),
   'session_id'=>$this->input->post('session'),
   'date_time_of_approval' => date("d M Y H:i:s"),
   'ip_address' => $_SERVER['REMOTE_ADDR']
   );
   
   $data1 = array(
   'approved'=>"1",
   );
   
 $this->db->where($data);	  
$this->db->update('courses_registered', $data1);
$this->db->insert('course_approval',$data_approval);
 $_SESSION["error"]="Courses Approved Successfully!";
	$page_data = array(
   'student_id'=>$this->input->post('studentid'),
   'semester'=> $this->input->post('semester'),
   'session_id'=>$this->input->post('session'),
   'level_id'=> $this->input->post('year_of_study')
   );	
   $page_data['conn']  = $conn;
	$page_data['page_name']  = 'view_student_registered_courses';
    $page_data['page_title'] = "Approve Registered Courses";
	$this->load->view('backend/index', $page_data);
}
function ajax_update_unitload_of_dept(){
	 
	 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 include('application/config/z.php');
    $_SESSION["error"]="";
  

$data = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
    
  'year_of_study_id'=> $this->input->post('level'),
  'maximum_unit'=> $this->input->post('maximum_unit'),
  'minimum_unit'=> $this->input->post('minimum_unit'),
  'maximum_elective'=> $this->input->post('maximum_elective'),
  'programme'=> $this->input->post('programme_type_id'),
  'user_id'=> $this->session->userdata('sadmin_id'),
   'datetime_of_activity' => date("d M Y H:i:s"),
   'ip_address' => $_SERVER['REMOTE_ADDR']
   );
   
   $data_audit = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
    
  'year_of_study_id'=> $this->input->post('level'),
  'maximum_unit'=> $this->input->post('maximum_unit'),
  'minimum_unit'=> $this->input->post('minimum_unit'),
  'maximum_elective'=> $this->input->post('maximum_elective'),
  'programme'=> $this->input->post('programme_type_id'),
    'user_id'=> $this->session->userdata('sadmin_id'),
    'ip_address' => $_SERVER['REMOTE_ADDR'],
     'type' => "INSERT",
      'activity_date_time' => date("d M Y H:i:s")
   );
   
      $data_audit2 = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
    
  'year_of_study_id'=> $this->input->post('level'),
  'maximum_unit'=> $this->input->post('maximum_unit'),
  'minimum_unit'=> $this->input->post('minimum_unit'),
  'maximum_elective'=> $this->input->post('maximum_elective'),
  'programme'=> $this->input->post('programme_type_id'),
    'user_id'=> $this->session->userdata('sadmin_id'),
    'ip_address' => $_SERVER['REMOTE_ADDR'],
     'type' => "UPDATE",
      'activity_date_time' => date("d M Y H:i:s")
   );
   
   $data2 = array(
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
   'year_of_study_id'=> $this->input->post('level'),
   'programme'=> $this->input->post('programme_type_id')
   );

   $data3 = array(
   'maximum_unit'=> $this->input->post('maximum_unit'),
  'minimum_unit'=> $this->input->post('minimum_unit'),
  'maximum_elective'=> $this->input->post('maximum_elective')
   );
   $maxunit =$this->input->post('maximum_unit');
   $minunit =$this->input->post('minimum_unit');
   $max_elective =$this->input->post('maximum_elective');
   $detailsexit = $this->db->get_where('course_unit_load',$data2);
	if($detailsexit->num_rows() > 0)
	{

	
$_SESSION["error"]= "Details Updated Successfully!";
  

sqlsrv_query($conn,"update course_unit_load set maximum_unit='$maxunit',minimum_unit='$minunit',maximum_elective='$max_elective' where semester_id='".$this->input->post('semester')."' and student_type_id='".$this->input->post('programme')."' and department_id='".$this->input->post('depts')."' and year_of_study_id ='".$this->input->post('level')."' and programme ='".$this->input->post('programme_type_id')."'") or die("Error1:".sqlsrv_errors());
	$this->db->insert('course_unit_load_audit_trail',$data_audit2);
	}
	else
	{
	$this->db->insert('course_unit_load',$data);
	$this->db->insert('course_unit_load_audit_trail',$data_audit);
	}
	
	
	$page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'level'=> $this->input->post('level'),
   'semester'=> $this->input->post('semester'),
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'page_name'=>'assign_unitload_to_dept',
   'page_title'=>'Assign Unit Load To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
}
    //$page_data['page_name']  = 'assign_course_to_dept';
    //$page_data['page_title'] = "Assign Courses To Department";
   // $this->load->view('backend/index', $page_data);
    
	
	function ajax_view_assign_course_to_dept(){
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		
   $page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'level'=> $this->input->post('level'),
   'modeofentry'=> $this->input->post('programme_type_id'),
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'semester'=> $this->input->post('semester'),
   'page_name'=>'view_assign_course_to_dept',
   'page_title'=>'Assign Courses To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
    }
	
	
	function ajax_view_assign_course_to_dept_two(){
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	include('application/config/z.php');	
   $page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'deptsoptions'=> $this->input->post('deptsoptions'),
   'level'=> $this->input->post('level'),
   'modeofentry'=> $this->input->post('programme_type_id'),
   'programme_type_id'=> $this->input->post('prog_type'),
   'semester'=> $this->input->post('semester'),
   'conn'=>$conn,
   'page_name'=>'view_assigncourseto_dept_fast',
   'page_title'=>'Assign Courses To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
    }
	
	
		function ajax_view_assign_unitload_to_dept(){
			if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
   $page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'level'=> $this->input->post('level'),
    'programme_type_id'=> $this->input->post('prog_type'),
   'semester'=> $this->input->post('semester'),
   'page_name'=>'assign_unitload_to_dept',
   'page_title'=>'Assign Unit Load To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
    }
	
	 function assign_course_to_lecturer(){
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

    $page_data['page_name']  = 'assign_course_to_lecturer';
    $page_data['page_title'] = "Assign Courses";
    $this->load->view('backend/index', $page_data);
    }
	

	function ajax_view_assign_course_to_lecturer(){
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	include('application/config/z.php');	
   $page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'level'=> $this->input->post('level'),
   'dept_option_id'=> $this->input->post('deptsoptions'),
   'programme_type_id'=> $this->input->post('prog_type'),
   'semester'=> $this->input->post('semester'),
   'session'=> $this->input->post('session'),
   'page_name'=>'view_assign_course_to_lecturer',
   'conn'=>$conn,
   'page_title'=>'Assign Courses To Lecturer',
   );
   
   
    $this->load->view('backend/index', $page_data);
    }
	
function ajax_view_lecturer_courses()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
 include('application/config/z.php');
 
$_SESSION["sem"]=$this->input->post('semester');
$_SESSION["ses"] = $this->input->post('session');
   $page_data = array(
   'semester'=> $this->input->post('semester'),
   'session'=> $this->input->post('session'),
   'page_name'=>'manage_lecturer_results',
   'conn'=>$conn,
   'page_title'=>'View Lecturer Courses Panel'
   );

  
    $this->load->view('backend/index', $page_data);
    }	
	  function get_depts(){
   $school= $this->input->get('school');

    echo $school;
    }
function manage_lecturer_results()
{
	session_start();
		 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			//$_SESSION['id']=1;
	$page_data = array(
   
   'page_name'=>'manage_lecturer_results_homepage',
   'page_title'=>'Update Result'
   );
  $this->load->view('backend/index', $page_data);
}

function approve_lecturer_results()
{
	session_start();
		 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			//$_SESSION['id']=1;
	$page_data = array(
   
   'page_name'=>'approve_lecturer_results_homepage',
   'page_title'=>'Results Approval'
   );
  $this->load->view('backend/index', $page_data);
}
function ajax_upload_lecturer_score_sheet($id = "")
{
	session_start();
		
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

  //$cid1 = $this->input->post('cid'.$id);	
	include('application/config/z.php');
 
	$path = "score_sheets/";
$sid =mt_rand(100000000,900000000);
$_SESSION["sid"]=$sid;
$date= date("d-M-Y");
	$valid_formats = array("xlsx", "xls");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg'.$id]['name'];
			$size = $_FILES['photoimg'.$id]['size'];
			
			if(strlen($name))
				{ //echo "Am Here";
					// exit;
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(2024*2024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).$id.".".$ext;
							$tmp = $_FILES['photoimg'.$id]['tmp_name'];
						
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{ 
								$uploadedby=$this->session->userdata('name');
							//	mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE students_result_upload_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES SET sid = '$sid', uploaded_by='$uploadedby', date_uploaded='$date'") or die (mysql_error());
							
				include("Classes/PHPExcel/IOFactory.php");
                    try {
						
						$file = $path.$actual_image_name;
                        //Load the excel(.xls/.xlsx) file
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }

           $uploadedby=$this->session->userdata('name');
		   $sid =mt_rand(1,900000000);
$_SESSION["sid"]=$sid;
		   //An excel file may contains many sheets, so you have to specify which one you need to read or work with.
                    $sheet = $objPHPExcel->getSheet(0);
                    //It returns the highest number of rows
                    $total_rows = $sheet->getHighestRow();
                    //It returns the highest number of columns
                    $total_columns = $sheet->getHighestColumn();
                  
        
                  
                    //Loop through each row of the worksheet
                    for($row =2; $row <= $total_rows; $row++) {
                       $single_row = $sheet->rangeToArray('A' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
					    
						
					   if($single_row[0][0]<=0)
					   {
					   }
					   else {
                      $query =sqlsrv_query($conn,"insert into students_result_upload_temp (id, matric_no, students_name, department,assesment_score,test_score,exams_score,course_code,exam_date,cid,student_id,session,sid,date_uploaded,uploaded_by) VALUES ('".$single_row[0][0]."','".$single_row[0][1]."','".$single_row[0][2]."','".$single_row[0][3]."','".$single_row[0][4]."','".$single_row[0][5]."','".$single_row[0][6]."','".$single_row[0][7]."','".$single_row[0][8]."','".$single_row[0][9]."','".$single_row[0][10]."','".$single_row[0][11]."','$sid','$date','$uploadedby')") or die('1');  
					   //echo $single_row[0][0];
					 //exit;
					   }
                    }
								
                   
								$query2 =sqlsrv_query($conn,"select* from students_result_upload_temp where sid = '$sid'") or die("1");
								while(list($fid,$matric_no,$std,$dept,$asc,$testsc,$exam_sc,$prog_type,$session,$c_code,$cid2,$student_id)=sqlsrv_fetch_array($query2))
								{
								
								if($id == $cid2)
									{
	$course_assigned_details = $this->db->query("select *  from courses_registered where student_id='$student_id' and course_assign_to_dept_id='$id' and session='$session'")->row();
//echo $course_assigned_details->course_assign_to_dept_id.' '.$cid2;	exit;
if($course_assigned_details)
{
	$total= $asc + $testsc + $exam_sc;
	if($total>100)
	{
		if($total==111)
	{
	}
	else{
			$_SESSION["error"] ="Upload Failed: Total Score is higher than 100 for $std - $matric_no !";
	header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");
	exit;
	}
	}

}
else
{
	$_SESSION["error"] ="Upload Failed: $std - $matric_no did not register for this course!";
header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");
exit;
}
                                    }
									else
									{
$_SESSION["error"] ="Upload Failed: You are trying to upload a wrong Result file for this Course! $id-$cid2";
header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");
									exit;
									}
								}
								$query2 =sqlsrv_query($conn,"select* from students_result_upload_temp where sid = '$sid'") or die("1");
								while(list($fid,$matric_no,$std,$dept,$asc,$testsc,$exam_sc,$prog_type,$session,$c_code,$cid2,$student_id)=sqlsrv_fetch_array($query2))
								{
	$total= $asc + $testsc + $exam_sc;
	$grade = $this->getGrade($total);
	if($total==111)
		{
		$total='0.00';
$exam_sc='0.00';
$asc='0.00';
$test_sc='0.00';		
		}
	echo "Am here";
		sqlsrv_query($conn,"update courses_registered set assignment_score='$asc', test_score='$testsc', exam_score='$exam_sc', total_score='$total', grade='$grade' where student_id='$student_id' and course_assign_to_dept_id='$id' and session='$session'") or die ();
								}
									sqlsrv_query($conn,"update course_assigned_to_department set has_result='1' where id='$id'") or die ();
							$_SESSION["error"] ="Results Uploaded Successfully!";

						header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");						
								?>
                                
                                

									<?php
									
								}
							else
								
								$_SESSION["error"]= "failed";
								header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");
	
						}
						else
					//	echo "Image file size max 1 MB";	
							$_SESSION["error"]= "Image file size max 1 MB";
			header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");			
						}
						else
						echo	$_SESSION["error"]= "Invalid File Type";
					//	 
	header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");				}
				
			else
			
								$_SESSION["error"]=  "Please select image..!";
	header("Location: index.php?sadmin/ajax_view_lecturer_courses_two");
						
		
			
		}
	
}
function getGrade($score)
{
	if($score>=0 && $score<=9)
		{
			return "F";
		}
	if($score>=10 && $score<=19)
		{
			return "E";
		}
	if($score>=20 && $score<=29)
		{
			return "D";
		}
		if($score>=30 && $score<=39)
		{
			return "CD";
		}
		if($score>=40 && $score<=49)
		{
			return "C";
		}
		if($score>=50 && $score<=59)
		{
			return "BC";
		}
		if($score>=60 && $score<=69)
		{
			return "B";
		}
		if($score>=70 && $score<=79)
		{
			return "AB";
		}
		if($score>=80 && $score<=100)
		{
			return "A";
		}
		
if($score==111)
		{
			return "ABS";
		}
					
}

function getRemark($score)
{
	if($score>=0 && $score<=9)
		{
			return "WORTHLESS";
		}
	if($score>=10 && $score<=19)
		{
			return "FAIL";
		}
	if($score>=20 && $score<=29)
		{
			return "FAIL";
		}
		if($score>=30 && $score<=39)
		{
			return "FAIL";
		}
		if($score>=40 && $score<=49)
		{
			return "PASS";
		}
		if($score>=50 && $score<=59)
		{
			return "FAIRLY GOOD";
		}
		if($score>=60 && $score<=69)
		{
			return "GOOD";
		}
		if($score>=70 && $score<=79)
		{
			return "VERY GOOD";
		}
		if($score>=80 && $score<=100)
		{
			return "EXCELLENT";
		}
}
function ajax_view_lecturer_courses_two()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
include('application/config/z.php');
   $page_data = array(
   'semester'=> $_SESSION["sem"],
   'session'=> $_SESSION["ses"],
   'conn'=>$conn,
   'page_name'=>'manage_lecturer_results',
   'page_title'=>'View Lecturer Courses Panel'
   );

  
    $this->load->view('backend/index', $page_data);
    }
function download_registered_gss_courses_classlist()
		{
			if ($this->session->userdata('sadmin_login') != 1)

	            redirect(base_url(), 'refresh');
			$code=$this->input->post('code');
							$session = $this->input->post('session');
		
include('application/config/z.php');		            //redirect(base_url(), 'refresh');
	$course_details = $this->db->query("select *  from eduportal_courses where course_code='$code'")->row();
	header('Content-type: application/msexcel');
	header("Content-Disposition: attachment; filename=YABATECH_GSS_REPORT_".str_replace(' ','',trim($code)).str_replace(' ','',trim($course_details->course_title)).".xls");
	//echo "YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim(	?>
    
         
          
	    <?php 
		$i=1;
			$query1 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (i.course_code='$code') and (a.session='$session') order by g.deptID") or die();
		
	//$row1=sqlsrv_fetch_array($query1);		
			?>
	
		
	          <table width="920px" id="myColumnId" border="1">
	        <thead>
		 <tr  bgcolor="#0066CC">
		            <th width="61"><div align="left" class="style6"><span class="style4">SN</span></div></th>
            
		            <th width="133"><div align="left" class="style6"><span class="style4">SURNAME</span></div></th>
		            <th width="180" style="width:180px;"><div align="left" ><span class="style4">FIRSTNAME</span></div></th>
					<th width="180" style="width:180px;"><div align="left" ><span class="style4">MIDDLENAME</span></div></th>
		            <th width="280" style="width:280px;"><div align="left" ><span class="style4">FACULTY</span></div></th>
		            <th width="180" style="width:180px;"><div align="left" ><span class="style4">DEPARTMENT</span></div></th>
					<th width="180" style="width:180px;"><div align="left" ><span class="style4">JAMB REGNO</span></div></th>
					<th width="180" style="width:180px;"><div align="left" ><span class="style4">MATRIC NO</span></div></th>
		            <th width="180" style="width:180px;"><div align="left" ><span class="style4">PASSPORT URL</span></div></th>
				    <th width="180" style="width:180px;"><div align="left" ><span class="style4">COURSE CODE</span></div></th>
					<th width="180" style="width:180px;"><div align="left" ><span class="style4">COURSE TITLE</span></div></th>
			
		          </tr>
		        </thead>


		           <tbody>
		
				<?php 
				while($row=sqlsrv_fetch_array($query1))
				{
				?>
		      <tr >
		             <td><?php echo $i;?></td>
		             <td  id="myColumn2"><?php echo $row["SURNAME"];?></td>
		            <?php 
						 $othernames= explode(' ',$row["OTHERNAMES"]);
						// echo strtoupper($row["SURNAME"]);?>
					 <td><?php echo strtoupper($othernames[0]);?></td>
					 <td><?php echo strtoupper($othernames[1]);?></td>
             <td><?php $this->getFaculty($row["SCHOOL"]);?></td>
		             <td><?php echo strtoupper($row["DEPARTMENT"]);?></td>
					  <td><?php echo strtoupper($row["PORTAL_ID"]);?></td>
					 <td><?php echo strtoupper($row["REGNO"]);?></td>
					 <td >../portal/uploads/student_image/<?php echo $row["STUDENT_ID"];?>.jpg</td>
				     <td><?php echo strtoupper($row["COURSE_CODE"]);?></td>
				     <td><?php echo strtoupper($row["TITLE"]);?></td>
             
		           </tr><?php $i++;}?>
	            </tbody>
	           </table>
           
	           <?php 
		}


	
function download_uploaded_results_marksheets($id)
{
	session_start();
			if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
//$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
header('Content-type: application/msexcel');
header("Content-Disposition: attachment; filename=YABATECHGRADESHEET_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim($course_assigned_details->c_title)).".xls");

$i=1;
$result_details= $this->db->query("select a.assignment_score as ASSCORE,a.test_score as TESTSCORE, a.exam_score as EXAMSCORE, a.total_score as TOTALSCORE,a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no");

$dept_id = $course_assigned_details->department_id;
$course_type_id = $course_assigned_details->course_type_id;

$dept = $this->db->query("select *  from department where deptID='$dept_id'")->row();
$school = $this->db->query("select *  from schools where schoolid='".$dept->schoolid."'")->row();
$course_type = $this->db->query("select *  from course_type where course_type_id='$course_type_id'")->row();
$deptsoptions=$course_assigned_details->dept_option_id;
if($deptsoptions=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$deptsoptions."'")->row()->dept_option_name;
}

?>

<style type="text/css">
	.country-line{
		float:left;
		width:100%;
		padding:5px;
		background:#DEDEDE;
		margin:20px 0 0 10px;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line span{
		color:#CB4A18;
		font-size:19px;
		margin-left:10px;
	}
	.country-line h5{
		margin:5px 0;
	}
</style>
<div class="print_page" style="width:1100px; border:0px;">
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;border:0px;">
				<div class="col-md-12 receipt-head" style="margin-top:10px;">
					<img src="images/neklogo.png"  />
					<p align="center"><h3><B>FEDERAL POLYTECHNIC NEKEDE, OWERRI</B></h3></p>
					<p align="center">OFFICIAL GRADE REPORT AND CLASS ROSTER											
</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
						  <hr />
						</div>
					  <div class="col-md-12 print-table">
						  <table width="120%" border="0" align="center" cellpadding="0" cellspacing="10" class="formtxt">
						    <!--DWLayoutTable-->
						    <tr>
						      <td width="13%" height="27"><span class="style65">SCHOOL: </span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $school->schoolname; ?>
						      </span></td>
						      <td width="17%"><span class="style65">DEPARTMENT: </span></td>
						      <td width="31%" ><span class="style65">
						        <?php  echo $dept->deptName; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="21"><span class="style65">
						        <label for="lname2">PROGRAMME:</label>
						        </span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->prog; ?>
						      </span></td>
						      <td width="17%" class="style65">PROGRAMME TYPE:</td>
						      <td width="31%" ><span class="style65">
						       <?php  echo $course_assigned_details->prog_type; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="20"><span class="style65">
						        <label for="dept2">SESSION:</label></span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $_SESSION["ses"]; ?>
						      </span></td>
						      <td width="17%" class="style65">YEAR OF STUDY:</td>
						      <td width="31%" ><span class="style65">
						        <?php  echo $course_assigned_details->level_of_study; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65"><span class="style65">
						        <label for="falc2">SEMESTER:</label>
                              </span></td>
						      <td><span class="style65">
						        <?php  echo $course_assigned_details->sem; ?>
						      </span></td>
						      <td class="style65">COURSE CODE:</td>
						      <td valign="top"><span class="style65">
						        <?php  echo $course_assigned_details->c_code; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65">COURSE TITLE:</td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->c_title; ?>
						      </span></td>
						      <td width="17%" class="style65">COURSE TYPE:</td>
						      <td width="31%" valign="top"><span class="style65">
						        <?php  echo $course_type->course_type_name; ?>
						      </span></td>
					        </tr>
                            <tr>
						      <td height="19" class="style65">CREDIT HOURS:</td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->course_unit; ?>
						      </span></td>
						      <td width="17%" class="style65">DEPARTMENT OPTION</td>
						      <td width="31%" valign="top"><span class="style65">
						     <?php echo $deptopt;?>
						      </span></td>
					        </tr>
				        </table>
</div>
					
					<div class="col-md-12 no-p">
						<div class="col-md-12"></div>
						<div class="col-md-12 print-table">
						  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row"> <div id="sales2">
						      <p>&nbsp;</p>
						      <table width="100%"  class="" >
						          <thead>
						            <tr bgcolor="#ffffff"></tr>
						            <tr bgcolor="#ffffff">
						              <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
						              <th width="146"><div align="left" class="style6"><span class="style4">MATRIC NUMBER</span></div></th>
						              <th width="257"><div align="left" class="style6">STUDENTS NAME</div></th>
						              <th width="112"><div align="center" class="style6"><span class="style4">ASS.SCORE</span></div></th>
						              <th width="129"><div align="center" class="style6"><span class="style4">TEST.SCORE</span></div></th>
						              <th width="140"><div align="center" class="style6"><span class="style4">EXAMS SCORE</span></div></th>
						              <th width="154" ><div align="center" class="style6"> TOTAL SCORE</div></th>
						              <th width="112"><div align="center" class="style6">GRADE</div></th>
                                          <th width="112"><div align="center" class="style6">REMARK</div></th>
					                </tr>
				                </thead>
			
						          <tbody>
						            <tr  style="" >
						              <td colspan="9" style="border-bottom:1px solid #000;" ></td>
					                </tr>
                                    			          <?php $id2=1; 
				$tcu = 0;
				foreach($result_details->result() as $row)
			  {
						?>
						            <tr  style="border-bottom:1px solid #000;">
						              <td><?php echo $id2;?></td>
						              <td>
						               <?php echo strtoupper($row->REGNO);?> &nbsp;</td>
						              <td><div align="left"><span class="style5">
						              
					                  </span><?php echo strtoupper($row->SURNAME.' '. $row->OTHERNAMES);?></div></td>
						              <td><div align="center"><?php echo $row->ASSCORE;?> </div></td>
						              <td><div align="center"> <?php echo $row->TESTSCORE;?>     </div></td>
						              <td align="center"><div align="center"><?php echo $row->EXAMSCORE;?> 
						              
						                </div></td>
						              <td align="center"><div align="center">
						         <?php echo $row->TOTALSCORE;?> 
						            
									</div></td>
						              <td align="center"><div align="center"><?php echo $this->getGrade(number_format($row->TOTALSCORE));?>
						               
						                </div></td>
                                        
                                            <td align="center"><div align="center">
						      <?php echo $this->getRemark(number_format($row->TOTALSCORE));?>
						                </div></td>
					                </tr>
                                  <?php 	  $id2 = $id2 +1;
				//$tcu= $tcu +$course_unit2;
				  
				  }?>  
					              </tbody>
						          <?php 
			
				    if($id2<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses Registered!</h3></td></tr>";
				  }
				
				  
				  ?>
					            </table>
						        <p>&nbsp;</p>
					             <p>&nbsp;</p>
						      </div></th>
					        </tr>
						
						
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>
							  <table>
							    <tr>
							  <td colspan="5"><b>Grading System: &nbsp;&nbsp;</b></td>
							 
							  </tr>
							  <tr>
							  <td>Grade &nbsp;&nbsp;</td>
							  <td>Min Score&nbsp;&nbsp;</td>
							  <td>Max Score&nbsp;&nbsp;</td>
							  <td>Points Weight&nbsp;&nbsp;</td>
							   <td>Rating &nbsp;&nbsp;</td>
							  </tr>
							   <tr>
							  <td>A</td>
							  <td>80</td>
							  <td>100</td>
							  <td>4</td>
							   <td>Distinction </td>
							  </tr>
							   <tr>
							  <td>AB</td>
							  <td>70</td>
							  <td>79</td>
							  <td>3.5</td>
							   <td>Very Good </td>
							  </tr>
							   <tr>
							  <td>B</td>
							  <td>60</td>
							  <td>69</td>
							  <td>3</td>
							   <td>Goo</td>
							  </tr>
							   <tr>
							  <td>BC</td>
							  <td>50</td>
							  <td>59</td>
							  <td>2.5</td>
							   <td>Fairly Good</td>
							  </tr>
							  							  





							   <tr>
							  <td>C</td>
							  <td>40</td>
							  <td>49</td>
							  <td>2</td>
							   <td>Pass</td>
							  </tr>
							   <tr>
							  <td>CD</td>
							  <td>30</td>
							  <td>39</td>
							  <td>1.5</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>D</td>
							  <td>20</td>
							  <td>29</td>
							  <td>1</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>E</td>
							  <td>10</td>
							  <td>19</td>
							  <td>0.5</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>F</td>
							  <td>0</td>
							  <td>9</td>
							  <td>0</td>
							   <td>Worthless</td>
							  </tr>
							  
							  </table>


</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">Signature of Lecturer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.............................................</th>
						      <th align="left"  class="style27" scope="row">Signature of Head of Department ................................................</th>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
						    <tr class="border">
						      <th width="46%" class="style27" scope="row" align="left">Signature of School Dean &nbsp;   ..............................................</th>
						      <td width="54%">&nbsp;</td>
					        </tr>
                                <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
                                <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
						
					      </table>
					  </div>
					</div>
				
				</div>
			</div>
		</div>
<?php 
	
		
}
	
function download_uploaded_results_marksheets_pdf($id)
{
	session_start();
			if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();


$i=1;
$result_details= $this->db->query("select a.assignment_score as ASSCORE,a.test_score as TESTSCORE, a.exam_score as EXAMSCORE, a.total_score as TOTALSCORE,a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no");

$page_data['page_name']  = 'view_uploaded_result_marksheet';
$page_data['page_title'] = "Mark Sheet";
$page_data['result_details'] =$result_details;
$page_data['course_assigned_details'] = $course_assigned_details;
$this->load->view('backend/print_admin', $page_data);		
		
}	
	
	function download_registeredcourses_classlist($id)
	{
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
header('Content-type: application/msexcel');
header("Content-Disposition: attachment; filename=YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim($course_assigned_details->c_title)).".xls");
//echo "YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim(	?>
    
         
          
    <?php 
	$i=1;
		$query1 =sqlsrv_query($conn,"select top(1) a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,l.dept_option_name as DEPARTMENTOPTION,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k, dept_options l  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (l.dept_option_id = h.dept_option) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		
$row1=sqlsrv_fetch_array($query1);		
		?>
		<div class="col-md-12 receipt-head" style="margin-top:10px;">
	<img src="images/neklogo.png" />
			<p><h2><b>CLASS LIST</b></h2>
			</p>
		</div>
		  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="10" class="formtxt">
		    <!--DWLayoutTable-->
		 
		    
	    <tr>
	      <td ><span class="style65">
	        <label for="dept2">DEPARTMENT:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENT"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="dept2">DEPARTMENT OPTION:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENTOPTION"]); ?></span></td>
        </tr>

	    <tr>
	      <td ><span class="style65">PROGRAMME</span>:</td>
	      <td><span class="style65"><?php echo  strtoupper($row1["PROGRAMME"]); ?></span></td>
        </tr>
	    <tr>
	      <td >STUDENT TYPE</td>
	      <td> <?php echo  strtoupper($row1["PROGRAMME_TYPE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">SESSION:</label>
	        </span></td>
	      <td ><?php echo  strtoupper($row1["SESSION"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">LEVEL:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["LEVEL"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">COURSE TITLE:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["TITLE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">COURSE CODE:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["COURSE_CODE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">CREDIT UNIT :</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["CREDIT_UNIT"]); ?></span></td>
        </tr>
		    <tr>
		      <td height="19"><!--DWLayoutEmptyCell-->&nbsp;</td>
		      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
	        </tr>
		 
		    <tr>
		      <td height="19" colspan="2"><h3>Registered Students</h3></td>
	        </tr>
	      </table>
          <table width="920px" id="myColumnId" border="1">
        <thead>
          <tr  bgcolor="#0066CC">
            <th width="61"><div align="left" class="style6"><span class="style4">SN</span></div></th>
            <th width="180" style="width:180px;"><div align="left" ><span class="style4">MATRIC NO</span></div></th>
            <th width="133"><div align="left" class="style6"><span class="style4">STUDENT NAME</span></div></th>
            
         
 
        
          </tr>
        </thead>
           <tbody>
		
		<?php 
		$query2 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		while($row=sqlsrv_fetch_array($query2))
		{
		?>
      <tr >
             <td><?php echo $i;?></td>
             <td  id="myColumn2"><?php echo $row["REGNO"];?></td>
             <td><?php echo strtoupper($row["SURNAME"].' '.$row["OTHERNAMES"]);?></td>
             
             
             
           </tr><?php $i++;}?>
            </tbody>
           </table>
           
           <?php 
	}
	
	
	
		function download_registeredcourses_classlist_pdf($id)
	{
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
//header('Content-type: application/msexcel');
//header("Content-Disposition: attachment; filename=YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim($course_assigned_details->c_title)).".xls");
//echo "YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim(	?>
    
         
          
    <?php 
	$i=1;
		$query1 =sqlsrv_query($conn,"select top(1) a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,l.dept_option_name as DEPARTMENTOPTION,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k, dept_options l  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (l.dept_option_id = h.dept_option) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		
$row1=sqlsrv_fetch_array($query1);		
		?>
		<html>
		<head>
		<style>

        body{

          color:#000000;

        }

        @media print

          body{

             background:url('images/alvan.png');

             no-repeat;

          }

    </style>   <script>

function printDiv() {

     var printContents = document.getElementById('print').innerHTML;

     var originalContents = document.body.innerHTML;



     document.body.innerHTML = printContents;



     window.print();



     document.body.innerHTML = originalContents;

}



</script>

    </head>



    <body   onLoad="window.print();">

		<div class="col-md-12 receipt-head" style="margin-top:10px;">
	<img src="images/neklogo.png" />
			<p><h2><b>CLASS LIST</b></h2>
			</p>
		</div>
		  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="5" class="formtxt">
		    <!--DWLayoutTable-->
		 
		    
	    <tr>
	      <td ><span class="style65">
	        <label for="dept2">DEPARTMENT:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENT"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="dept2">DEPARTMENT OPTION:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENTOPTION"]); ?></span></td>
        </tr>

	    <tr>
	      <td ><span class="style65">PROGRAMME</span>:</td>
	      <td><span class="style65"><?php echo  strtoupper($row1["PROGRAMME"]); ?></span></td>
        </tr>
	    <tr>
	      <td >STUDENT TYPE</td>
	      <td> <?php echo  strtoupper($row1["PROGRAMME_TYPE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">SESSION:</label>
	        </span></td>
	      <td ><?php echo  strtoupper($row1["SESSION"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">LEVEL:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["LEVEL"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">COURSE TITLE:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["TITLE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">COURSE CODE:</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["COURSE_CODE"]); ?></span></td>
        </tr>
	    <tr>
	      <td ><span class="style65">
	        <label for="falc2">CREDIT UNIT :</label>
	        </span></td>
	      <td ><span class="style65"><?php echo  strtoupper($row1["CREDIT_UNIT"]); ?></span></td>
        </tr>
		    <tr>
		      <td height="19"><!--DWLayoutEmptyCell-->&nbsp;</td>
		      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
	        </tr>
		 
		   
	      </table>
          <table width="920px" id="myColumnId" border="1">
        <thead>
          <tr  bgcolor="#0066CC">
            <th width="61"><div align="left" class="style6"><span class="style4">SN</span></div></th>
            <th width="180" style="width:180px;"><div align="left" ><span class="style4">MATRIC NO</span></div></th>
            <th width="133"><div align="left" class="style6"><span class="style4">STUDENT NAME</span></div></th>
            
         
 
        
          </tr>
        </thead>
           <tbody>
		
		<?php 
		$query2 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		while($row=sqlsrv_fetch_array($query2))
		{
		?>
      <tr >
             <td><?php echo $i;?></td>
             <td  id="myColumn2"><?php echo $row["REGNO"];?></td>
             <td><?php echo strtoupper($row["SURNAME"].' '.$row["OTHERNAMES"]);?></td>
             
             
             
           </tr><?php $i++;}?>
            </tbody>
           </table>
           </body>
		   </html>
           <?php 
	}
	
	
	
	
	
	
	function download_registeredcourses_classlist_photoalbum($id)
	{
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
//header('Content-type: application/pdf');
//header("Content-Disposition: attachment; filename=YABATECHCLASSLIST_PHOTOALBUM_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim($course_assigned_details->c_title)).".pdf");
//echo "YABATECHCLASSLIST_".str_replace(' ','',trim($course_assigned_details->c_code)).str_replace(' ','',trim(	?>

         
          
    <?php 
	$i=1;
		$query1 =sqlsrv_query($conn,"select top(1) a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,l.dept_option_name as DEPARTMENTOPTION,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k, dept_options l  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (l.dept_option_id = h.dept_option) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		
		$row1=sqlsrv_fetch_array($query1);		
				?>
		
	   				<div class="col-md-12 receipt-head" style="margin-top:10px;">
	   			<img src="images/neklogo.png" />
	   					<p><h2><b>COURSE EXAMINATION PHOTO ALBUM</b></h2>
	   					</p>
	   				</div>
	   				
				    <table width="920px" id="myColumnId" style="border:1px solid #ccc " >
			      <thead>
   			        <tr >
   			          

<td  colspan="6">  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="2" class="formtxt">
	   				    <!--DWLayoutTable-->
	
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="dept2">DEPARTMENT:</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENT"]); ?></span></td>
	   			        </tr>
		
	   		    <tr>
	   		      <td ><span class="style65">
	   		        <label for="dept2">DEPARTMENT OPTION:</label>
	   		        </span></td>
	   		      <td ><span class="style65"><?php echo  strtoupper($row1["DEPARTMENTOPTION"]); ?></span></td>
	   	        </tr>
	   				    <tr>
	   				      <td ><span class="style65">PROGRAMME</span>:</td>
	   				      <td><span class="style65"><?php echo  strtoupper($row1["PROGRAMME"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td >STUDENT TYPE</td>
	   				      <td> <?php echo  strtoupper($row1["PROGRAMME_TYPE"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">SESSION:</label>
	   				        </span></td>
	   				      <td ><?php echo  strtoupper($row1["SESSION"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">LEVEL:</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["LEVEL"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">SEMESTER:</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["SEMESTER"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">COURSE TITLE:</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["TITLE"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">COURSE CODE:</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["COURSE_CODE"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td ><span class="style65">
	   				        <label for="falc2">CREDIT UNIT :</label>
	   				        </span></td>
	   				      <td ><span class="style65"><?php echo  strtoupper($row1["CREDIT_UNIT"]); ?></span></td>
	   			        </tr>
	   				    <tr>
	   				      <td height="19"><!--DWLayoutEmptyCell-->&nbsp;</td>
	   				      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
	   			        </tr>
		 
	   				    <tr>
	   				      
	   			        </tr>
	   			      </table> </td>
   			        </tr>
			        <tr  bgcolor="#0066CC" style="border:1px solid #ccc " >
			          <th width="61"><div align="left" class="style6"><span class="style4">SN</span></div></th>
			          <th width="100" style=width:180px;"><div align="left" ><span class="style4">MATRIC NO</span></div></th>
			          <th width="280" style="border:1px solid #ccc;width:390px" ><div align="left" class="style6"><span class="style4">STUDENT NAME</span></div></th>
			          
			  	   <th style="width:250px" style="border:1px solid #ccc " ><div align="center" class="style6"><span class="style4">PHOTO</span></div></th>
			  	   <th width="100" style="border:1px solid #ccc " ><div align="center" class="style6"><span class="style4">SIGN IN</span></div></th>
			  	   <th width="100" style="border:1px solid #ccc " ><div align="center" class="style6"><span class="style4">SIGN OUT</span></div></th>
       

      
			        </tr>
			      </thead>
			         <tbody>	
		
	<?php	
	$query2 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
	while(list($cid,$crid,$sid,$sname,$oname,$pid,$regno,$dept,$prog,$prog_type,$cc,$ct,$cu,$sem,$level,$session)=sqlsrv_fetch_array($query2))
		{
			//echo $sid.' '.$sname;
	
	?>
      
      <tr >
             <td style="border:1px solid #ccc " ><?php echo $i;?></td>
             <td style="border:1px solid #ccc "  id="myColumn2"><?php echo $regno;?></td>
             <td style="border:1px solid #ccc " ><?php echo strtoupper($sname.' '.$oname);?></td>
             
             
			  <td style="backgroud-size:cover;border:1px solid #ccc"><img src="uploads/student_image/<?php echo $sid;?>.jpg"  style="backgroud-size:cover; height:120px; width:120px;border:1px solid #ccc"/></td>
             <td style="border:1px solid #ccc "></td>
             <td style="border:1px solid #ccc "></td>
           </tr><?php $i++;}?>
            </tbody>
           </table>
           
           <?php 
	}
function download_registeredcourses_scoresheet($id){
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
 include('application/config/z.php');
		//$results=$this->results_m->get_batch_results($id);
		
		//$name=$this->excel_batch_m->get($id,true)->EXCEL_BATCH_TITLE;
		$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
		$deptcode = $this->db->query("select *  from department where deptID='$course_assigned_details->department_id'")->row()->dept_code;
 
 $deptsoptions=$course_assigned_details->dept_option_id;
 //echo $course_assigned_details->dept_option_id; exit;
if($course_assigned_details->dept_option_id==0)
{
	$deptopt= "NONE";
}
else
{
$deptopt= $this->db->query("select *  from dept_options where dept_option_id='".$course_assigned_details->dept_option_id."'")->row()->dept_option_name;
}
		$filename = str_replace(' ','',trim($course_assigned_details->c_code)).$deptcode.'ClassList.xlsx';
		//dump($results);
//echo $filename; exit;
	//	if(!count($results)){ exit();}
		//require_once  '/Classes/Excel.php';
require('Classes/PHPExcel.php');
$phpExcel = new PHPExcel;
// Setting font to Arial Black
//$phpExcel->getDefaultStyle()->getFont()->setName('Arial Black');
// Setting font size to 14
//$phpExcel->getDefaultStyle()->getFont()->setSize(14);
//Setting description, creator and title
$docname=str_replace(' ','',trim($course_assigned_details->c_code)).$deptcode.'ClassList';
$phpExcel ->getProperties()->setTitle("$docname");
$phpExcel ->getProperties()->setCreator("Yabatech ERP Portal");
$phpExcel ->getProperties()->setDescription("$docname");
// Creating PHPExcel spreadsheet writer object
// We will create xlsx file (Excel 2007 and above)
/* Password protect sheet */


$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
// When creating the writer object, the first sheet is also created
// We will get the already created sheet
$sheet = $phpExcel ->getActiveSheet();
// Setting title of the sheet
$sheet->setTitle($docname);


// Creating spreadsheet header
$sheet ->getCell('A1')->setValue('S/N');
$sheet ->getCell('B1')->setValue('Matric No');
$sheet ->getCell('C1')->setValue('Fullname');
$sheet ->getCell('D1')->setValue('Student Department');
$sheet ->getCell('E1')->setValue('Assigment Score');
$sheet ->getCell('F1')->setValue('Test Score');
$sheet ->getCell('G1')->setValue('Exam Score');
$sheet ->getCell('H1')->setValue('Course Code');
$sheet ->getCell('I1')->setValue('Exam Date');
$sheet ->getCell('J1')->setValue('');
$sheet ->getCell('K1')->setValue('');
$sheet ->getCell('L1')->setValue('Session');
// Making headers text bold and larger
$sheet->getStyle('A1:L1')->getFont()->setBold(true)->setSize(11);
// Insert product data
// Autosize the columns

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setWidth(0);
$sheet->getColumnDimension('K')->setWidth(0);
$sheet->getColumnDimension('L')->setAutoSize(true);
$i=2;
$dept = $this->db->query("select *  from department where deptID='$course_assigned_details->department_id'")->row()->deptName;
$query1 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die( print_r( sqlsrv_errors(), true));
		while(list($cid,$crid,$sid,$sname,$oname,$pid,$regno,$schoolid,$dept,$prog,$prog_type,$cc,$ct,$cu,$sem,$level,$session)=sqlsrv_fetch_array($query1))
		{
$name = $sname.' '.$oname;
$sheet ->getCell("A$i")->setValue($i-1);
$sheet ->getCell("B$i")->setValue($regno);
$sheet ->getCell("C$i")->setValue($name);
$sheet ->getCell("D$i")->setValue($dept.'['.$deptopt.']');
$sheet ->getCell("E$i")->setValue('');
$sheet ->getCell("F$i")->setValue('');
$sheet ->getCell("G$i")->setValue('');
$sheet ->getCell("H$i")->setValue($cc);
$sheet ->getCell("I$i")->setValue('');
$sheet ->getCell("J$i")->setValue($cid);
$sheet ->getCell("K$i")->setValue($sid);
$sheet ->getCell("L$i")->setValue($session);


$i++;
	 }


$sheet->getProtection()->setPassword('GTCOYCT');
$sheet->getProtection()->setSheet(true);	
$sheet->getStyle('C1:C50')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED);
/* Unprotect editable cells */
$highestRowCount = $sheet->getHighestRow();
$highestColumnCount = $sheet->getHighestColumn();
$sheet->getStyle("E2:E$highestRowCount")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$sheet->getStyle("F2:F$highestRowCount")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$sheet->getStyle("G2:G$highestRowCount")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$sheet->getStyle("I2:I$highestRowCount")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

header('Content-type: application/vnd.ms-excel');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1


header("Content-Disposition: attachment;filename=".$filename);
header('Cache-Control: max-age=0');
$writer->setOffice2003Compatibility(true);
$writer->save('php://output');
	//echo $output;
	}
	
function download_registeredcourses_scoresheet1($id)
	{
		if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
include('application/config/z.php');
$course_assigned_details = $this->db->query("select *  from course_assigned_to_department where id='$id'")->row();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=YABATECHSCORESHEET_".str_replace(' ','',trim($course_assigned_details->c_code)).".xls");
		?>
        <table width="920px"   border="1" >

        <tr  >
          <td width="61">SN</td>
          <td width="80" >MATRIC NO</td>
          <td width="180" >STUDENT NAME</td>
          <td width="263">DEPARTMENT </td>
          <td width="71">ASSG. SCORE</td>
          <td width="71">TEST SCORE</td>
          <td width="71">EXAMS SCORE</td>
          <td width="111">PROGRAMME</td>
          <td width="159">PROGRAMME TYPE</td>
		  <td width="141">SESSION</td>
          <td width="141">COURSE CODE</td>
		 
           <td width="0">CID</td>
            <td width="0">SID</td>
   <td width="141">EXAM DATE</td>
        
        </tr>
   
        
         
          
    <?php 
	$i=1;
		$query1 =sqlsrv_query($conn,"select a.course_assign_to_dept_id AS CID,a.course_registered_id AS COURSE_REG_ID,a.student_id AS STUDENT_ID,h.name AS SURNAME,h.othername AS OTHERNAMES,h.portal_id AS PORTAL_ID,h.reg_no AS REGNO,g.schoolid AS SCHOOL,g.deptName AS DEPARTMENT,k.student_type_name AS PROGRAMME,j.programme_type_name AS PROGRAMME_TYPE,i.course_code AS COURSE_CODE,i.course_title AS TITLE,a.course_unit AS CREDIT_UNIT,c.semester_name AS SEMESTER,d.year_of_study_name AS LEVEL,e.sessionn_name AS SESSION,f.status AS APPROVAL_STATUS from courses_registered a, course_assigned_to_department b, course_semester c,  course_year_of_study d, course_session e,  course_approval_codes f, department g, student h, eduportal_courses i, programme_type j , student_type k  where (a.course_assign_to_dept_id = b.id) and (a.year_of_study = d.year_of_study_id) and (a.semester = c.semester_id) and (a.session = e.sessionn_name) and (b.department_id = g.deptID) and (a.student_id = h.student_id) and (a.approved = f.id) and (b.course_id = i.course_id) and (b.programme_type_id = j.programme_type_id) and (b.student_type_id = k.student_type_id) and (a.course_assign_to_dept_id='$id') order by h.reg_no") or die();
		while(list($cid,$crid,$sid,$sname,$oname,$pid,$regno,$schid,$dept,$prog,$prog_type,$cc,$ct,$cu,$sem,$level,$session)=sqlsrv_fetch_array($query1))
		{
	?>
      <tr >
             <td><?php echo $i;?></td>
             <td><?php echo $regno;?></td>
             <td><?php echo strtoupper($sname.' '.$oname);?></td>
             <td><?php echo strtoupper($dept);?></td>
             <td>0</td>
             <td>0</td>
             <td>0</td>
             <td><?php echo $prog;?></td>
             <td><?php echo $prog_type;?></td>
             <td><?php echo $session;?></td>
              <td><?php echo $cc;?></td>
			  
			   
              <td width="0" ><?php echo $cid;?></td> 
              <td width="0" ><?php echo $sid;?></td> 
            <td></td>
           </tr><?php $i++;}?>

           </table>
           
           <?php 
	}

function ajax_view_lecturer_results_approval()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
 include('application/config/z.php');
$_SESSION["sem"]=$this->input->post('semester');
$_SESSION["ses"] = $this->input->post('session');
   $page_data = array(
   'semester'=> $this->input->post('semester'),
   'session'=> $this->input->post('session'),
   'page_name'=>'manage_lecturer_results_approval',
    'conn'=>$conn,
   'page_title'=>'Courses / Results Panel'
   );

  
    $this->load->view('backend/index', $page_data);
    }
	
	
	function ajax_view_lecturer_results_approval_two()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
 include('application/config/z.php');
   $page_data = array(
    'semester'=> $_SESSION["sem"],
   'session'=> $_SESSION["ses"],
   'page_name'=>'manage_lecturer_results_approval',
   'conn'=>$conn,
   'page_title'=>'Courses / Results Panel'
   );
    $this->load->view('backend/index', $page_data);
    }
	
	

	function ajax_approve_lecturer_results($id)
{
	session_start();
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
			$ca_id= $id;
			
			$data['result_approved'] =1;
			$this->db->where(array('course_assign_to_dept_id'=>$ca_id));
			$this->db->update('courses_registered',$data);
			$_SESSION['error'] = "Results Approved Successfully";
			header("Location: index.php?sadmin/ajax_view_lecturer_results_approval_two");
			
}
	
	
	
function ajax_upload_courses()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	
	
	$path = "files/";
$session =mt_rand(100000000,900000000);
$_SESSION["sid"]=$session;
	$valid_formats = array("txt", "csv", "xlt");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(2024*2024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
								mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE 	eduportal_courses_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES SET sid = '$session', activated='1'") or die (mysql_error());
								$query =mysql_query("select* from eduportal_courses_temp where sid = '$session'") or die("1");
								while(list($id,$coursecode,$ct,$code,$activated) = mysql_fetch_array($query))
								{
								
								$check_dup = mysql_query("select count(*) from eduportal_courses where course_code='$coursecode'") or die (mysql_error());
							$res = mysql_result($check_dup,0);
if($res>0)
								{
								}
								else
								{
								
									
							mysql_query("insert into eduportal_courses (course_code,course_title,code,activated) values ('$coursecode','$ct','$coursecode','1')") or die (mysql_error()."3");
								}
								}	
								$_SESSION["error"] ="Courses Uploaded Successfully!";
								header("Location: index.php?sadmin/upload_courses");						
								?>
                                
                                

									<?php
									
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
			
		}
	
}
 function update_manual_payment_session(){
	 
	 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 
$page_data = array(
   
   'page_name'=>'update_manual_payment',
   'page_title'=>'Update Manual Payments',
   );
  $this->load->view('backend/index', $page_data);
	 
 }
 
 
 
 	function ajax_verify_pin_manual_etranzact()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		session_start();
	 $data = array(
     'confirm_code'=> $this->input->post('pin')

     );
   
     $detailsexit = $this->db->get_where('manual_etranzact',$data);
	 $detailsdata = $this->db->get_where('manual_etranzact',$data)->row();
	if($detailsexit->num_rows() > 0)
	  {
	  $detailsprog = $detailsdata->prog_type;
	  
	  
		  
		   $page_data = array(
   'page_name'=>'update_manual_payment2',
   'page_title'=>'Update Manual Payments',
   'session_pay'=>$detailsdata->session,
   'confirm_code'=> $this->input->post('pin'),
   'detailsprog'=>$detailsprog
   );
  $this->load->view('backend/index', $page_data);
	  }
	  else
	  {
   $_SESSION["error"]="Confirmation Code Does no Exist";
   $page_data = array(
   'page_name'=>'update_manual_payment',
   'page_title'=>'Update Manual Payments',
   );
  $this->load->view('backend/index', $page_data);
	  }
	  
    }

	function ajax_update_pin_manual_etranzact()
	{
		
			  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		session_start();
	 	 	 $data = array(
     'confirm_code'=> $this->input->post('confirm_code')

     );
		 $data2 = array(
     'session'=> $this->input->post('session')

     );
	$detailsdata = $this->db->get_where('manual_etranzact',$data)->row();
	$session =$this->input->post('session');
	$confirm_code= $this->input->post('confirm_code');
		if($session==0)
		{
			$_SESSION["error"]="Please Select Payment Session";
	$page_data = array(
   'page_name'=>'update_manual_payment2',
   'page_title'=>'Update Manual Payments',
   'session_pay'=>$detailsdata->session,
   'confirm_code'=> $this->input->post('confirm_code')
   );
   $this->load->view('backend/index', $page_data);
		}
		else
		{
	
	$this->db->where('confirm_code',$confirm_code);
    $this->db->update('manual_etranzact', $data2);
	$detailsdata2 = $this->db->get_where('manual_etranzact',$data)->row();
   $page_data = array(
   'page_name'=>'update_manual_payment2',
   'page_title'=>'Update Manual Payments',
   'session_pay'=>$detailsdata2->session,
   'confirm_code'=> $this->input->post('confirm_code')
   );
   $this->load->view('backend/index', $page_data);
		}
		
	}
	
	
	//Update Live Payment
	
	 function update_live_payment_session(){
	 
	 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 
$page_data = array(
   
   'page_name'=>'update_live_payment',
   'page_title'=>'Update Live Etranzact Payments',
   );
  $this->load->view('backend/index', $page_data);
	 
 }
	
	function ajax_verify_pin_live_etranzact()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		session_start();
	 $data = array(
     'confirm_code'=> $this->input->post('pin')

     );
   
     $detailsexit = $this->db->get_where('etranzact_payment',$data);
	 $detailsdata = $this->db->get_where('etranzact_payment',$data)->row();
	if($detailsexit->num_rows() > 0)
	  {
		  
		   $page_data = array(
   'page_name'=>'update_live_payment2',
   'page_title'=>'Update  Payments',
   'session_pay'=>$detailsdata->session,
   'paylevel'=>$detailsdata->level,
   'confirm_code'=> $this->input->post('pin')
   );
  $this->load->view('backend/index', $page_data);
	  }
	  else
	  {
   $_SESSION["error"]="Confirmation Code Does no Exist";
   $page_data = array(
   'page_name'=>'update_live_payment',
   'page_title'=>'Update Payments',
   );
  $this->load->view('backend/index', $page_data);
	  }
	  
    }

	function ajax_update_pin_live_etranzact()
	{
		
			  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
		session_start();
	 	 	 $data = array(
     'confirm_code'=> $this->input->post('confirm_code')

     );
		 $data2 = array(
     'session'=> $this->input->post('session'),
	 'level'=> $this->input->post('level')

     );
	$detailsdata = $this->db->get_where('etranzact_payment',$data)->row();
	$session =$this->input->post('session');
	$confirm_code= $this->input->post('confirm_code');
		if($session==0)
		{
			$_SESSION["error"]="Please Select Payment Session";
	$page_data = array(
   'page_name'=>'update_live_payment2',
   'page_title'=>'Update Payments',
   'paylevel'=>$detailsdata->level,
   'session_pay'=>$detailsdata->session,
   'confirm_code'=> $this->input->post('confirm_code')
   );
   $this->load->view('backend/index', $page_data);
		}
		else
		{
	
	$this->db->where('confirm_code',$confirm_code);
    $this->db->update('etranzact_payment', $data2);
	$detailsdata2 = $this->db->get_where('etranzact_payment',$data)->row();
   $page_data = array(
   'page_name'=>'update_live_payment2',
   'page_title'=>'Update Payments',
   'paylevel'=>$detailsdata2->level,
   'session_pay'=>$detailsdata2->session,
   'confirm_code'=> $this->input->post('confirm_code')
   );
   $this->load->view('backend/index', $page_data);
		}
		
	}
	
	

	function student_information($class_id = '')

	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');



		$page_data['page_name']  	= 'student_information';

		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".

											$this->crud_model->get_class_name($class_id);

		$page_data['class_id'] 	= $class_id;

		$this->load->view('backend/index', $page_data);

	}

	function student_data($param1 = '', $param2 = '', $param3 = '', $param4 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'search') {

            if($this->input->post('school') != ''){
            $school = $this->input->post('school');
            $school = $this->db->get_where('schools', array("id" => $school))->row()->schoolname;
        }else{
            $school = '';
        }
            //var_dump($this->input->post());

            $school = $school;
            $dept = $this->input->post('dept');
            $programme = $this->input->post('programme');
            $prog_type = $this->input->post('prog_type');
            $level = $this->input->post('level');
            $sex = $this->input->post('sex');

            $page_data['school'] = $school;
            $page_data['dept'] = $dept;
            $page_data['prog'] = $programme;
            $page_data['prog_type'] = $prog_type;
            $page_data['level'] = $level;
            $page_data['sex'] = $sex;

            $page_data['result'] = $this->db->get_where('student', array('school' => $school, 'dept' => $dept, 'programme' => $programme, 'prog_type' => 
                $prog_type, 'level' => $level, 'sex' => $sex))->result_array();
            //var_dump($page_data['result']);
            //return 0;
        }

        $page_data['page_name']     = 'student_data';
        $page_data['page_title']    = 'Student Data';
        $this->load->view('backend/index', $page_data);
    }



	function student_marksheet($class_id = '')

	{

		if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');



		$page_data['page_name']  = 'student_marksheet';

		$page_data['page_title'] 	= get_phrase('student_marksheet'). " - ".get_phrase('class')." : ".

											$this->crud_model->get_class_name($class_id);

		$page_data['class_id'] 	= $class_id;

		$this->load->view('backend/index', $page_data);

	}

    function update_record($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') == 1)
            redirect('login', 'refresh');
        if($param1 == 'update'){
            $old = $this->input->post('old_reg');
            $new = $this->input->post('new_reg');

            $reg = $this->db->get_where('student', array('reg_no' => $old))->result_array();
            if($reg){

            $data['reg_no']             = $new;
            $data1['customer_id']        = $new;
            $data2['idno']               = $new;

            $this->db->where('reg_no', $old);
            $this->db->update('student', $data);
            $afftectedRws = $this->db->affected_rows();

            $this->db->where('customer_id', $old);
            $this->db->update('etranzact_payment', $data1);
            $afftectedRow = $this->db->affected_rows();

            $this->db->where('idno', $old);
            $this->db->update('counter', $data2);
            $afftectedRos = $this->db->affected_rows();

            $afftectedRows = $afftectedRos+$afftectedRow+$afftectedRws;


            //$this->db->where($old);
            //return $this->db->get('counter')->row()->idno;

            

            /*
            $this->db->set('t1.row','New value');
            $this->db->set('t2.row','New value');
            $this->db->where('t1.row','Your Condition');
            $this->db->where('t2.row','Your Condition');
            $this->db->update('table1 as t1, table2 as t2');
            */

            //var_dump($old.$new);

            $_SESSION['err_msg'] = "Student Records for: ".$old." have been successfully Updated to: ".$new." in Hostel & School Fees Records";
            }
            else{
                $_SESSION['err_msg'] = "Student Records for: ".$old." does not exist";
            }
        }
            
        $page_data['page_name']     = 'update_record';
        $page_data['page_title']    = get_phrase('update_student_records');
        $this->load->view('backend/index', $page_data);
    }



    function student($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');

        if ($param1 == 'create') {

            $data['name']        = $this->input->post('name');

            $data['birthday']    = $this->input->post('birthday');

            $data['sex']         = $this->input->post('sex');

            $data['address']     = $this->input->post('address');

            $data['phone']       = $this->input->post('phone');

            $data['email']       = $this->input->post('email');

            $data['password']    = $this->input->post('password');

            $data['class_id']    = $this->input->post('class_id');

            $data['roll']        = $this->input->post('roll');

            $this->db->insert('student', $data);

            $student_id = mysql_insert_id();



            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');

            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

            redirect(base_url() . 'index.php?admin/student_add/' . $data['class_id'], 'refresh');

        }

        if ($param2 == 'do_update') {

            $data['name']        = $this->input->post('name');

            $data['birthday']    = $this->input->post('birthday');

            $data['sex']         = $this->input->post('sex');

            $data['address']     = $this->input->post('address');

            $data['phone']       = $this->input->post('phone');

            $data['email']       = $this->input->post('email');

            $data['class_id']    = $this->input->post('class_id');

            $data['roll']        = $this->input->post('roll');



            $this->db->where('student_id', $param3);

            $this->db->update('student', $data);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');

            $this->crud_model->clear_cache();



            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');

        }



        if ($param2 == 'delete') {

            $this->db->where('student_id', $param3);

            $this->db->delete('student');

            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');

        }

    }


    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function student_reg($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        
        if ($param1 == 'search') {

            $reg =$this->input->post('s_reg');
            //$id =2;
            $semester =$this->input->post('semester');
            $session =$this->input->post('session');

            $page_data['reg'] = $reg;
            $page_data['semester'] = $semester;
            $page_data['session'] = $session;
            /*variable that contains all the courses a student has registered
            *In a specific academic year and semester
            */
            $page_data['courses'] = $this->db->get_where('course_records' , array('reg_no' =>$reg,'selected_semester'=>$semester,'session'=>$session))->result_array();
            
            $page_data['year'] = $session; //academic year
            $page_data['student'] = $this->db->get_where('student' , array('reg_no'=> $reg))->row();// current student level
            //$page_data['dept'] = $page_data['student']->dept;
            $page_data['current_level'] = $this->db->get_where('student' , array('reg_no'=> $reg))->row()->level;// current student level
            $level = explode(" ", $page_data['current_level']);
            $prog = $level['0'];
            $level = $level['1'];
            //$page_data['current_load'] = $this->db->get_where('course_records' , array('reg_no' =>$reg,'std_id'=>$id,'session'=>$session))->result_array();
            $page_data['max_credit'] = $this->db->get_where('credit_load' , array('programme'=> $prog,'semester'=>$semester,'level'=>$level))->row()->sem_max_load;
            $page_data['min_credit'] = $this->db->get_where('credit_load' , array('programme'=> $prog,'semester'=>$semester,'level'=>$level))->row()->sem_min_load;
            //redirect(base_url() . 'index.php?admin/student_reg', 'refresh');
        }
        if ($param1 == 'print') {


            $reg =$this->input->post('s_reg');
            $confirmed = '1';
            $semester =$this->input->post('semester');
            $adviser =$this->input->post('adviser');
            $session =$this->input->post('session');
            //$session = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;//academic year
            $student = $this->db->get_where('student' , array('reg_no' =>$reg))->row();//academic year
            $id = $student->student_id;
            $this->session->set_userdata('serial',$reg);//set serial
            $this->session->set_userdata('id',$id);//set serial
            //$this->session->set_userdata('fullname',$payment->fullname); //set name
            $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id)); //image
            
            $this->session->set_userdata('session',$session);
            $this->session->set_userdata('semester',$semester);
            $this->session->set_userdata('dept',$student->dept);
            $this->session->set_userdata('level',$student->level);
            $this->session->set_userdata('prog_type',$student->prog_type);
            //var_dump($this->session->userdata('level'));
            $page_data['courses'] =$this->db->get_where('course_records' , array('reg_no' =>$reg,'std_id'=>$id,'selected_semester'=>$semester,'session'=>$session))->result_array();
            $page_data['page_name'] = 'print_course';
            $page_data['adviser'] = $adviser;
            $page_data['confirmed'] = $confirmed;
            $page_data['time'] = date("D M j Y G:i:s");
            $page_data['admin'] = $this->session->userdata('name');
            $this->load->view('backend/printout', $page_data);
            //redirect(base_url() . 'index.php?backend/printout', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?sadmin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?sadmin/invoice', 'refresh');
        }
        $page_data['page_name']  = 'student_reg';
        $page_data['page_title'] = get_phrase('Student Course Registration');
        //$page_data['courses'] = $this->db->get('course_records')->result_array();
        //var_dump($page_data['courses']);
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*this Function handles receipt from link*/
    function receipt($param1 = '', $param2 = '', $param3 = '')
    { 
    	if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');
    	if ($param1 == 'print') {


            $reg =$this->input->post('s_reg');
            $confirmed = '1';
            $semester =$this->input->post('semester');
            $adviser =$this->input->post('adviser');
            $session =$this->input->post('session');
            //$session = $this->db->get_where('settings' , array('type' =>'academic_year'))->row()->description;//academic year
            $student = $this->db->get_where('student' , array('reg_no' =>$reg))->row();//academic year
            $id = $student->student_id;
            $this->session->set_userdata('serial',$reg);//set serial
            $this->session->set_userdata('id',$id);//set serial
            //$this->session->set_userdata('fullname',$payment->fullname); //set name
            $this->session->set_userdata('image',$this->crud_model->get_image_url('student',$id)); //image
            
            $this->session->set_userdata('session',$session);
            $this->session->set_userdata('semester',$semester);
            $this->session->set_userdata('dept',$student->dept);
            $this->session->set_userdata('level',$student->level);
            $this->session->set_userdata('prog_type',$student->prog_type);
            //var_dump($this->session->userdata('level'));
            $page_data['courses'] =$this->db->get_where('course_records' , array('reg_no' =>$reg,'std_id'=>$id,'selected_semester'=>$semester,'session'=>$session))->result_array();
            $page_data['page_name'] = 'print_course';
            $page_data['adviser'] = $adviser;
            $page_data['confirmed'] = $confirmed;
            $page_data['time'] = date("D M j Y G:i:s");
            $page_data['admin'] = $this->session->userdata('name');
            $this->load->view('backend/printout', $page_data);
        }
    }

     /****MANAGE PARENTS CLASSWISE*****/

    function parent($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');

        if ($param1 == 'create') {

            $data['name']        			= $this->input->post('name');

            $data['email']       			= $this->input->post('email');

            $data['password']    			= $this->input->post('password');

            $data['student_id']  			= $param2;

            $data['relation_with_student']  = $this->input->post('relation_with_student');

            $data['phone']       			= $this->input->post('phone');

            $data['address']     			= $this->input->post('address');

            $data['profession']  			= $this->input->post('profession');

            $this->db->insert('parent', $data);

            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL



			 $class_id	=	$this->db->get_where('student', array('student_id'=>$data['student_id']))->row()->class_id;

            redirect(base_url() . 'index.php?admin/parent/' . $class_id , 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']        			= $this->input->post('name');

            $data['email']       			= $this->input->post('email');



			 if ($this->input->post('password') != "")

            		$data['password']    		=  $this->input->post('password');

            $data['relation_with_student']  = $this->input->post('relation_with_student');

            $data['phone']       			= $this->input->post('phone');

            $data['address']     			= $this->input->post('address');

            $data['profession']  			= $this->input->post('profession');



            $this->db->where('parent_id', $param2);

            $this->db->update('parent', $data);



            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('parent', array(

                'parent_id' => $param3

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('parent_id', $param2);

            $this->db->delete('parent');

            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');

        }

        $page_data['class_id']   = $param1;

        $page_data['students']   = $this->db->get_where('student', array(

											'class_id' => $param1	))->result_array();

        $page_data['page_title'] 	= get_phrase('parent_information'). " - ".get_phrase('class')." : ".

											$this->crud_model->get_class_name($param1);

        $page_data['page_name']  = 'parent';

        $this->load->view('backend/index', $page_data);

    }





    /****MANAGE TEACHERS*****/

    function teacher($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name']        = $this->input->post('name');

            $data['birthday']    = $this->input->post('birthday');

            $data['sex']         = $this->input->post('sex');

            $data['address']     = $this->input->post('address');

            $data['phone']       = $this->input->post('phone');

            $data['email']       = $this->input->post('email');

            $data['password']    = $this->input->post('password');

            $this->db->insert('teacher', $data);

            $teacher_id = mysql_insert_id();

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');

            $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']        = $this->input->post('name');

            $data['birthday']    = $this->input->post('birthday');

            $data['sex']         = $this->input->post('sex');

            $data['address']     = $this->input->post('address');

            $data['phone']       = $this->input->post('phone');

            $data['email']       = $this->input->post('email');

            $data['password']    = $this->input->post('password');



            $this->db->where('teacher_id', $param2);

            $this->db->update('teacher', $data);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');

            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');

        } else if ($param1 == 'personal_profile') {

            $page_data['personal_profile']   = true;

            $page_data['current_teacher_id'] = $param2;

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('teacher', array(

                'teacher_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('teacher_id', $param2);

            $this->db->delete('teacher');

            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');

        }

        $page_data['teachers']   = $this->db->get('teacher')->result_array();

        $page_data['page_name']  = 'teacher';

        $page_data['page_title'] = get_phrase('manage_Lecturer');

        $this->load->view('backend/index', $page_data);

    }



    /****MANAGE SUBJECTS*****/

    function subject($param1 = '', $param2 = '' , $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name']       = $this->input->post('name');

            $data['class_id']   = $this->input->post('class_id');

            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->insert('subject', $data);

            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']       = $this->input->post('name');

            $data['class_id']   = $this->input->post('class_id');

            $data['teacher_id'] = $this->input->post('teacher_id');



            $this->db->where('subject_id', $param2);

            $this->db->update('subject', $data);

            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('subject', array(

                'subject_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('subject_id', $param2);

            $this->db->delete('subject');

            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');

        }

		 $page_data['class_id']   = $param1;

        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();

        $page_data['page_name']  = 'subject';

        $page_data['page_title'] = get_phrase('manage_subject');

        $this->load->view('backend/index', $page_data);

    }



    /****MANAGE CLASSES*****/

    function classes($param1 = '', $param2 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name']         = $this->input->post('name');

            $data['name_numeric'] = $this->input->post('name_numeric');

            $data['teacher_id']   = $this->input->post('teacher_id');

            $this->db->insert('class', $data);

            redirect(base_url() . 'index.php?admin/classes/', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']         = $this->input->post('name');

            $data['name_numeric'] = $this->input->post('name_numeric');

            $data['teacher_id']   = $this->input->post('teacher_id');



            $this->db->where('class_id', $param2);

            $this->db->update('class', $data);

            redirect(base_url() . 'index.php?admin/classes/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('class', array(

                'class_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('class_id', $param2);

            $this->db->delete('class');

            redirect(base_url() . 'index.php?admin/classes/', 'refresh');

        }

        $page_data['classes']    = $this->db->get('class')->result_array();

        $page_data['page_name']  = 'class';

        $page_data['page_title'] = get_phrase('manage_class');

        $this->load->view('backend/index', $page_data);

    }



    /****MANAGE EXAMS*****/

    function exam($param1 = '', $param2 = '' , $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name']    = $this->input->post('name');

            $data['date']    = $this->input->post('date');

            $data['comment'] = $this->input->post('comment');

            $this->db->insert('exam', $data);

            redirect(base_url() . 'index.php?admin/exam/', 'refresh');

        }

        if ($param1 == 'edit' && $param2 == 'do_update') {

            $data['name']    = $this->input->post('name');

            $data['date']    = $this->input->post('date');

            $data['comment'] = $this->input->post('comment');



            $this->db->where('exam_id', $param3);

            $this->db->update('exam', $data);

            redirect(base_url() . 'index.php?admin/exam/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('exam', array(

                'exam_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('exam_id', $param2);

            $this->db->delete('exam');

            redirect(base_url() . 'index.php?admin/exam/', 'refresh');

        }

        $page_data['exams']      = $this->db->get('exam')->result_array();

        $page_data['page_name']  = 'exam';

        $page_data['page_title'] = get_phrase('manage_exam');

        $this->load->view('backend/index', $page_data);

    }



    /****MANAGE EXAM MARKS*****/

    function marks($exam_id = '', $class_id = '', $subject_id = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



        if ($this->input->post('operation') == 'selection') {

            $page_data['exam_id']    = $this->input->post('exam_id');

            $page_data['class_id']   = $this->input->post('class_id');

            $page_data['subject_id'] = $this->input->post('subject_id');



            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {

                redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');

            } else {

                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');

                redirect(base_url() . 'index.php?admin/marks/', 'refresh');

            }

        }

        if ($this->input->post('operation') == 'update') {

            $data['mark_obtained'] = $this->input->post('mark_obtained');

            $data['attendance']    = $this->input->post('attendance');

            $data['comment']       = $this->input->post('comment');



            $this->db->where('mark_id', $this->input->post('mark_id'));

            $this->db->update('mark', $data);



            redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');

        }

        $page_data['exam_id']    = $exam_id;

        $page_data['class_id']   = $class_id;

        $page_data['subject_id'] = $subject_id;



        $page_data['page_info'] = 'Exam marks';



        $page_data['page_name']  = 'marks';

        $page_data['page_title'] = get_phrase('manage_exam_marks');

        $this->load->view('backend/index', $page_data);

    }











    /****MANAGE GRADES*****/

    function grade($param1 = '', $param2 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name']        = $this->input->post('name');

            $data['grade_point'] = $this->input->post('grade_point');

            $data['mark_from']   = $this->input->post('mark_from');

            $data['mark_upto']   = $this->input->post('mark_upto');

            $data['comment']     = $this->input->post('comment');

            $this->db->insert('grade', $data);

            redirect(base_url() . 'index.php?admin/grade/', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']        = $this->input->post('name');

            $data['grade_point'] = $this->input->post('grade_point');

            $data['mark_from']   = $this->input->post('mark_from');

            $data['mark_upto']   = $this->input->post('mark_upto');

            $data['comment']     = $this->input->post('comment');



            $this->db->where('grade_id', $param2);

            $this->db->update('grade', $data);

            redirect(base_url() . 'index.php?admin/grade/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('grade', array(

                'grade_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('grade_id', $param2);

            $this->db->delete('grade');

            redirect(base_url() . 'index.php?admin/grade/', 'refresh');

        }

        $page_data['grades']     = $this->db->get('grade')->result_array();

        $page_data['page_name']  = 'grade';

        $page_data['page_title'] = get_phrase('manage_grade');

        $this->load->view('backend/index', $page_data);

    }



    /**********MANAGING CLASS ROUTINE******************/

    function class_routine($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['class_id']   = $this->input->post('class_id');

            $data['subject_id'] = $this->input->post('subject_id');

            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));

            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));

            $data['day']        = $this->input->post('day');

            $this->db->insert('class_routine', $data);

            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['class_id']   = $this->input->post('class_id');

            $data['subject_id'] = $this->input->post('subject_id');

            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));

            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));

            $data['day']        = $this->input->post('day');



            $this->db->where('class_routine_id', $param2);

            $this->db->update('class_routine', $data);

            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('class_routine', array(

                'class_routine_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('class_routine_id', $param2);

            $this->db->delete('class_routine');

            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');

        }

        $page_data['page_name']  = 'class_routine';

        $page_data['page_title'] = get_phrase('manage_class_routine');

        $this->load->view('backend/index', $page_data);

    }



	/****** DAILY ATTENDANCE *****************/

	function manage_attendance($date='',$month='',$year='',$class_id='')

	{

		if($this->session->userdata('sadmin_login')!=1)redirect('login' , 'refresh');



		if($_POST)

		{

			$verify_data	=	array(	'student_id' 		=> $this->input->post('student_id'),

										'date' 				=> $this->input->post('date'));

			$attendance = $this->db->get_where('attendance' , $verify_data)->row();

			$attendance_id		= $attendance->attendance_id;



			$this->db->where('attendance_id' , $attendance_id);

			$this->db->update('attendance' , array('status' => $this->input->post('status')));



			redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id , 'refresh');

		}

		$page_data['date']			=	$date;

		$page_data['month']		=	$month;

		$page_data['year']			=	$year;

		$page_data['class_id']	=	$class_id;



		$page_data['page_name']		=	'manage_attendance';

		$page_data['page_title']		=	get_phrase('manage_daily_attendance');

		$this->load->view('backend/index', $page_data);

	}

	function attendance_selector()

	{

		redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.

					$this->input->post('month').'/'.

						$this->input->post('year').'/'.

							$this->input->post('class_id') , 'refresh');

	}

    /******MANAGE BILLING / INVOICES WITH STATUS*****/

    function invoice($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



        if ($param1 == 'create') {

            $data['student_id']         = $this->input->post('student_id');

            $data['title']              = $this->input->post('title');

            $data['description']        = $this->input->post('description');

            $data['amount']             = $this->input->post('amount');

            $data['status']             = $this->input->post('status');

            $data['creation_timestamp'] = strtotime($this->input->post('date'));



            $this->db->insert('invoice', $data);

            redirect(base_url() . 'index.php?admin/invoice', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['student_id']         = $this->input->post('student_id');

            $data['title']              = $this->input->post('title');

            $data['description']        = $this->input->post('description');

            $data['amount']             = $this->input->post('amount');

            $data['status']             = $this->input->post('status');

            $data['creation_timestamp'] = strtotime($this->input->post('date'));



            $this->db->where('invoice_id', $param2);

            $this->db->update('invoice', $data);

            redirect(base_url() . 'index.php?admin/invoice', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('invoice', array(

                'invoice_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('invoice_id', $param2);

            $this->db->delete('invoice');

            redirect(base_url() . 'index.php?admin/invoice', 'refresh');

        }

        $page_data['page_name']  = 'invoice';

        $page_data['page_title'] = get_phrase('manage_invoice/payment');

        $this->db->order_by('creation_timestamp', 'desc');

        $page_data['invoices'] = $this->db->get('invoice')->result_array();

        $this->load->view('backend/index', $page_data);

    }



    //function to handle request for etranzact report
    function payment_reports($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'view_fee_payment_reports';
     
        //var_dump($page_data['school']);
        //$page_data['hostel'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->result_array();
        //$page_data['htotal'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->num_rows();
        $page_data['page_title'] = get_phrase('Fee_payment_list');


        $this->load->view('backend/index', $page_data);
	}
    function remita($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 ==''){

            $par="%";
            $page_data['invoices'] = $this->db->get('eduportal_remita_payment')->result_array();
             $page_data['total'] = $this->db->get('eduportal_remita_payment')->num_rows();
        }
        else if ($param1 == 'First') {


        $par = "011";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'FCMB') {


        $par = "214";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Unity') {


        $par = "215";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Sterling') {


        $par = "232";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Skye') {


        $par = "076";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'ENB') {


        $par = "084";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Diamond') {


        $par = "011";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();
        }

        else if ($param1 == 'GTB') {


        $par = "058";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();
        }

        else if ($param1 == 'Access') {


        $par = "044";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Uba') {


        $par = "033";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

         }
        else if ($param1 == 'Mainstreet') {


        $par = "014";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

         }
        else if ($param1 == 'Fidelity') {


        $par = "070";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Zenith') {


        $par = "057";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Union') {


        $par = "032";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Alvana') {
        $param1 = 'Alvana Microfinance';

        $par = "770";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'delete') {
            $this->db->where('confirm_code', $param2);
            $this->db->delete('etranzact_pay');
            redirect(base_url() . 'index.php?sadmin/etranzact', 'refresh');
        }
		



        $page_data['page_name']  = 'remita';
        $page_data['bank'] = $param1;
        $sch = "School Fees";
        $hos = "Hostel Fees";
        $page_data['school'] = $this->db->get('eduportal_remita_payment')->result_array();
        $page_data['stotal'] = $this->db->get('eduportal_remita_payment')->num_rows();
        //var_dump($page_data['school']);
        //$page_data['hostel'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->result_array();
        //$page_data['htotal'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->num_rows();
        $page_data['page_title'] = get_phrase('Remita_payment_list');


        $this->load->view('backend/index', $page_data);
    }

	

	function view_students_report_by_dept()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        

        $page_data['page_name']  = 'view_students_report_by_dept';
       
        $page_data['page_title'] = get_phrase('view_students_report_by_dept');


        $this->load->view('backend/index', $page_data);
    }

	function confirm_payments_by_dept()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        $dept= $this->input->post('dept');
        
        $page_data['page_name']  = 'confirm_payments_by_dept';
       
        $page_data['payments'] = $this->db->query("SELECT * FROM eduportal_fees_payment_log a, student b, department c, schools d WHERE a.student_id=b.student_id and b.dept=c.deptID and b.dept='$dept' and d.schoolid=b.school")->result_array();
        
		$page_data['page_title'] = get_phrase('confirm_payments_by_dept');
        $this->load->view('backend/index', $page_data);
    }
	
	
	function view_students_report_by_student()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        

        $page_data['page_name']  = 'view_students_report_by_student';
       
        $page_data['page_title'] = get_phrase('view_students_report_by_student_name_/_matric_no');


        $this->load->view('backend/index', $page_data);
    }

function confirm_payments_by_student()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        $matric= $this->input->post('matric');
        
        $page_data['page_name']  = 'confirm_payments_by_student';
       
        $page_data['payments'] = $this->db->query("SELECT * FROM eduportal_fees_payment_log a, student b, department c, schools d WHERE a.student_id=b.student_id and b.dept=c.deptID and d.schoolid=b.school and (b.name like '%$matric%' or b.othername like '%$matric%' or b.reg_no like '%$matric%' or b.portal_id like '%$matric%')")->result_array();
        
		$page_data['page_title'] = get_phrase('confirm_payments_by_student');
        $this->load->view('backend/index', $page_data);
    }
    
	function student_payment_history()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        $matric= $this->input->post('matric');
        
        $page_data['page_name']  = 'student_history_display_page';
       
        $page_data['payments'] = $this->db->query("SELECT * FROM applicationinvoice_gen WHERE  payerID ='$matric' ")->result_array();
        
		$page_data['page_title'] = get_phrase('student_payments_history');
        $this->load->view('backend/index', $page_data);
    }
	
    //Displays the record of students who have not paid fees
    function not_paid($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        /*if ($param1 ==''){

            $par="%";
            /*$this->db->select('*');
            $this->db->from('student as b');
            $this->db->where('b.reg_no NOT IN (SELECT a.customer_id FROM etranzact_payment a)', NULL, FALSE);
            $total = $this->db->get()->result_array();/

            //$total=$this->db->select('*')->join('student','student.reg_no = etranzact_payment.customer_id ','RIGHT')->where('reg_no IS NOT NULL',NULL,FALSE)->get('etranzact_payment')->result_array()->limit(10);

            //$result =$this->db->select('*')->join('student','student.reg_no = etranzact_payment.customer_id ','RIGHT')->where('reg_no IS NOT NULL',NULL,FALSE)->get('etranzact_payment')->result_array()->limit(10);
            //$page_data['invoices'] =$this->db->get_where('student')->result_array();
            $page_data['invoices'] ='';
			//var_dump($result);
            

                /*$this->db
               ->select('SQL_CALC_FOUND_ROWS employees.employee_id, name, avatar, position_name,status,IFNULL(department_name,"-") as department_name',FALSE)
               ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
               ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
               ->join('departments','departments.department_id = positions.department_id','LEFT')
               ->order_by('name')
               ->from('employees')/
            //$page_data['total'] = $invoice;
        }*/
      
        



        $page_data['page_name']  = 'not_paid';
        $page_data['bank'] = $param1;
        $male = "male";
        $female = "female";
        //$page_data['male'] = $this->db->get_where('student',array('sex' => $male))->result_array();
        //$page_data['stotal'] = $this->db->get_where('student',array('sex' => $male))->num_rows();
        //var_dump($page_data['school']);
        //$page_data['female'] = $this->db->get_where('student',array('sex' => $female))->result_array();
        //$page_data['htotal'] = $this->db->get_where('student',array('sex' => $female))->num_rows();
		$page_data['invoices'] =$this->db->get_where('student')->result_array();;
        $page_data['page_title'] = get_phrase('Pay Student Fees');


        $this->load->view('backend/index', $page_data);
    }

    //Displays the record of students who have not paid fees
    function unmatched()
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

	
        if ($param1 ==''){
			//$page_data['invoice'] = $this->db->get_where('etranzact_payment')->result_array();
            /*$par="%";
            $this->db->select('*');
            //$this->db->from('etranzact_payment a,student b');
            $this->db->from('etranzact_payment as b');
            //$this->db->where('a.customer_id = b.reg_no',NULL,FALSE);
            $this->db->where('b.customer_id NOT IN (SELECT a.reg_no FROM student a)', NULL, FALSE);
            //$this->db->where('a.idno',$reg_no);
            $total = $this->db->get()->result_array();
            //$invoice = $total->num_rows();
            //var_dump($total);
            $page_data['invoices'] = $total;
            //$page_data['total'] = $invoice;*/
        }       
        else if ($param1 == 'delete') {
            $this->db->where('student_id', $param2);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?sadmin/student_report', 'refresh');
        }


		
        $page_data['page_name']  = 'unmatched';
        $page_data['bank'] = $param1;
        $male = "male";
        $female = "female";
        //$page_data['male'] = $this->db->get_where('student',array('sex' => $male))->result_array();
        //$page_data['stotal'] = $this->db->get_where('student',array('sex' => $male))->num_rows();
        //var_dump($page_data['school']);
        $page_data['invoices'] = $this->db->get_where('etranzact_payment',array('status'=> NULL))->result_array();
        //$page_data['htotal'] = $this->db->get_where('student',array('sex' => $female))->num_rows();
        $page_data['page_title'] = get_phrase('Payment Report for students who have not registered on the portal');


        $this->load->view('backend/index', $page_data);
    }


    //display payment by nce list

    function payment_by_nce($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');





        if ($param1 ==''){



            $par="NCE";

            //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();

            $this->db->like('prog_type', $par);

            $query=$this->db->get('etranzact_pay');

            $page_data['invoices'] = $query->result_array();

            //var_dump($page_data['invoices']);

            $page_data['total'] = $query->num_rows();

        }

        else if ($param1 == 'regular') {





        $par = "NCE REGULAR";

        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->num_rows();



        }

        else if ($param1 == 'sandwich') {





        $par = "NCE SANDWICH";

        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->num_rows();



        }







        $page_data['page_name']  = 'payment_by_nce';

        $page_data['bank'] = $param1;

        $sch = "School Fees";

        $hos = "Hostel Fees";

        $page_data['school'] = $this->db->get_where('etranzact_pay', array('description' => $sch))->result_array();

        $page_data['stotal'] = $this->db->get_where('etranzact_pay', array('description' => $sch))->num_rows();

        //var_dump($page_data['school']);

        $page_data['hostel'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->result_array();

        $page_data['htotal'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->num_rows();

        $page_data['page_title'] = get_phrase('Payment_By_NCE_Students');





        $this->load->view('backend/index', $page_data);

    }
    /*This Function Desplays a table with edit for old fee records*/
    function old_etranzact($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['page_name']  = 'old_etranzact';
        $page_data['page_title'] = get_phrase('Old Fees_payment_list (2009 - 2014)');
        $this->load->view('backend/index', $page_data);
    } 

    /*This Function Displays a form to insert old fee*/
    function add_manual($param1 = '', $param2 = '', $param3 = ''){
    	if($this->session->userdata('level') != '2')
    		redirect(base_url(), 'refresh');
        if ($this->session->userdata('sadmin_login') != 1 )
            redirect(base_url(), 'refresh');

    if($param1 == 'add'){
        if($this->input->post('check') == 'check'){
            $par = $this->input->post('CONFIRMATION_NO');
            $verify = $this->db->get_where('manual_payment', array('payment_code' => $par))->result_array();
           if(!$verify){
          //var_dump($this->input->post());  

           $data['trans_date'] = $this->input->post('trans_date'); 
           $data['trans_descr'] = $this->input->post('trans_descr'); 
           $data['trans_amount'] = $this->input->post('amount');
           $data['merchant_code'] = $this->input->post('merchant_code');
           $data['subscriber_id'] = $this->input->post('serial');   
           $data['fullname'] = $this->input->post('name');
           $data['address'] = $this->input->post('address'); 
           $data['trans_no'] = $this->input->post('receipt');
           $data['payment_code'] = $this->input->post('CONFIRMATION_NO');
           $data['school'] = $this->input->post('school');
           $data['prog_type'] = $this->input->post('prog_type');
           $data['dept'] = $this->input->post('dept');
           $data['session'] = $this->input->post('session');
           $data['inserted_by'] = $this->input->post('author');
           $data['entry_date'] = $this->input->post('insert_date');

           //var_dump($data);
           $this->db->insert('manual_payment', $data);
           $this->session->set_userdata('error','Data Has been inserted successfully');
       }else{
            $this->session->set_userdata('error','You entered a confirmation code that already exists');
       }

        }else{

            $this->session->set_userdata('error','You have not clicked on the check box');

        }
        
    }

    $page_data['page_name']  = 'add_manual';
    $page_data['page_title'] = get_phrase('Insert Old Fee Record');
    $this->load->view('backend/index', $page_data);
    }

    //display payment by degree list

    function payment_by_degree($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');





        if ($param1 ==''){



            $par="DEGREE";

            //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();

            $this->db->like('prog_type', $par);

            $query=$this->db->get('etranzact_pay');

            $page_data['invoices'] = $query->result_array();

            //var_dump($page_data['invoices']);

            $page_data['total'] = $query->num_rows();

        }

        else if ($param1 == 'regular') {





        $par = "DEGREE REGULAR";

        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->num_rows();



        }

        else if ($param1 == 'sandwich') {





        $par = "DEGREE SANDWICH";

        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('etranzact_pay', array('prog_type' => $par))->num_rows();



        }







        $page_data['page_name']  = 'payment_by_degree';

        $page_data['bank'] = $param1;

        $sch = "School Fees";

        $hos = "Hostel Fees";

        $page_data['school'] = $this->db->get_where('etranzact_pay', array('description' => $sch))->result_array();

        $page_data['stotal'] = $this->db->get_where('etranzact_pay', array('description' => $sch))->num_rows();

        //var_dump($page_data['school']);

        $page_data['hostel'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->result_array();

        $page_data['htotal'] = $this->db->get_where('etranzact_pay', array('description' => $hos))->num_rows();

        $page_data['page_title'] = get_phrase('Payment_By_Degree_Students');





        $this->load->view('backend/index', $page_data);

    }



    //display data for pre nce

    function pre_nce($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');





        if ($param1 ==''){



            $par="%";

            $page_data['invoices'] = $this->db->get_where('student')->result_array();

             $page_data['total'] = $this->db->get_where('student')->num_rows();

        }

        else if ($param1 == 'OND') {





        $par = "OND";

        $page_data['invoices'] = $this->db->get_where('student', array('programme' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('student', array('programme' => $par))->num_rows();



        }

        else if ($param1 == 'HND') {





        $par = "HND";

        $page_data['invoices'] = $this->db->get_where('student', array('programme' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('student', array('programme' => $par))->num_rows();



        }





        $page_data['page_name']  = 'nce_students';

        $page_data['bank'] = $param1;

        $sch = "male";

        $hos = "female";

        $page_data['male'] = $this->db->get_where('student', array('sex' => $sch))->result_array();

        $page_data['stotal'] = $this->db->get_where('student', array('sex' => $sch))->num_rows();

        //var_dump($page_data['school']);

        $page_data['female'] = $this->db->get_where('student', array('sex' => $hos))->result_array();

        $page_data['htotal'] = $this->db->get_where('student', array('sex' => $hos))->num_rows();

        $page_data['page_title'] = get_phrase('NCE Students');





        $this->load->view('backend/index', $page_data);

    }

    function pin_info($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect('login', 'refresh');

        $page_data['hostel'] = $this->db->get_where('counter')->result_array();
        $page_data['total'] = $this->db->get_where('counter')->num_rows();
        $page_data['stotal'] = $this->db->get_where('scratch_cards')->num_rows();
        $page_data['htotal'] = $page_data['stotal'] - $page_data['total'];

        $page_data['page_name']   = 'accomodation_pins';
        $page_data['page_title']  = get_phrase('Scratch_card_Information');
        $this->load->view('backend/index', $page_data);

    }


     //display data for degree students

    function degree_students($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 ==''){

            $par="DEGREE";
            $param1="DEGREE";
            //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();
            $this->db->like('prog_type', $par);
            $query=$this->db->get('student');
            $page_data['invoices'] = $query->result_array();
            //var_dump($page_data['invoices']);
            $page_data['total'] = $query->num_rows();
        }
        else if ($param1 == 'degree_r') {


        $par = "DEGREE REGULAR";
        $param1 = "DEGREE REGULAR";
        $page_data['invoices'] = $this->db->get_where('student', array('prog_type' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('student', array('prog_type' => $par))->num_rows();

        }
        else if ($param1 == 'degree_s') {


        $par = "DEGREE SANDWICH";
        $param1 = "DEGREE SANDWICH";
        $page_data['invoices'] = $this->db->get_where('student', array('prog_type' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('student', array('prog_type' => $par))->num_rows();

        }


        $page_data['page_name']  = 'degree_students';
        $page_data['bank'] = $param1;
        $sch = "male";
        $hos = "female";
        $page_data['male'] = $this->db->get_where('student', array('sex' => $sch))->result_array();
        $page_data['stotal'] = $this->db->get_where('student', array('sex' => $sch))->num_rows();
        //var_dump($page_data['school']);
        $page_data['female'] = $this->db->get_where('student', array('sex' => $hos))->result_array();
        $page_data['htotal'] = $this->db->get_where('student', array('sex' => $hos))->num_rows();
        $page_data['page_title'] = get_phrase('DEGREE Students');


        $this->load->view('backend/index', $page_data);
    }



    //display data for nce students

    function nce_students($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 ==''){

            $par="NCE";
            $param1="NCE";
            //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();
            $this->db->like('prog_type', $par);
            $query=$this->db->get('student');
            $page_data['invoices'] = $query->result_array();
            //var_dump($page_data['invoices']);
            $page_data['total'] = $query->num_rows();
        }
        else if ($param1 == 'pre_nce') {


        $par = "PRE NCE";
        $param1 = "PRE NCE";
        $page_data['invoices'] = $this->db->get_where('student', array('prog_type' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('student', array('prog_type' => $par))->num_rows();

        }
        else if ($param1 == 'nce_r') {


        $par = "NCE REGULAR";
        $param1 = "NCE REGULAR";
        $page_data['invoices'] = $this->db->get_where('student', array('prog_type' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('student', array('prog_type' => $par))->num_rows();

        }
        else if ($param1 == 'nce_s') {


        $par = "NCE SANDWICH";
        $param1 = "NCE SANDWICH";
        $page_data['invoices'] = $this->db->get_where('student', array('prog_type' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('student', array('prog_type' => $par))->num_rows();

        }


        $page_data['page_name']  = 'nce_students';
        $page_data['bank'] = $param1;
        $sch = "male";
        $hos = "female";
        $page_data['male'] = $this->db->get_where('student', array('sex' => $sch))->result_array();
        $page_data['stotal'] = $this->db->get_where('student', array('sex' => $sch))->num_rows();
        //var_dump($page_data['school']);
        $page_data['female'] = $this->db->get_where('student', array('sex' => $hos))->result_array();
        $page_data['htotal'] = $this->db->get_where('student', array('sex' => $hos))->num_rows();
        $page_data['page_title'] = get_phrase('NCE Students');


        $this->load->view('backend/index', $page_data);
    }



    //to display student data by sex

    function student_report_sex($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');





        if ($param1 ==''){



            $par="%";

            $page_data['invoices'] = $this->db->get('student')->result_array();

             $page_data['total'] = $this->db->get('student')->num_rows();

        }

        else if ($param1 == 'Male') {





        $par = "male";

        $page_data['invoices'] = $this->db->get_where('student', array('sex' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('student', array('sex' => $par))->num_rows();



        }

        else if ($param1 == 'Female') {





        $par = "female";

        $page_data['invoices'] = $this->db->get_where('student', array('sex' => $par))->result_array();

        $page_data['total'] = $this->db->get_where('student', array('sex' => $par))->num_rows();



        }





        $page_data['page_name']  = 'student_report_sex';

        $page_data['bank'] = $param1;

        $sch = "male";

        $hos = "female";

        $page_data['male'] = $this->db->get_where('student', array('sex' => $sch))->result_array();

        $page_data['stotal'] = $this->db->get_where('student', array('sex' => $sch))->num_rows();

        //var_dump($page_data['school']);

        $page_data['female'] = $this->db->get_where('student', array('sex' => $hos))->result_array();

        $page_data['htotal'] = $this->db->get_where('student', array('sex' => $hos))->num_rows();

        $page_data['page_title'] = get_phrase('Student Report by Sex');





        $this->load->view('backend/index', $page_data);

    }

    //function to display individual student reports

    function export_student($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        if($param1 =='exp'){
        	$items = array();
        	if ($this->input->post('students'))
            {
            	//var_dump($this->input->post('students'));
              foreach($this->input->post('students') as $student=>$i)
              {
                 $items[] = $student;
              }
            }
            else{
            	redirect(base_url().'index.php?sadmin/export_student', 'refresh');
            }

            //var_dump($items);
            $string = rtrim(implode(',', $items), ',');

        	$this->load->dbutil();
        	$file_name = 'Student Report  Alvan Ikoku Federal University Of Education';
        	//$query = $this->db->get_where('student', $items)->result_array();
			$query = $this->db->query("SELECT $string FROM student limit 10");
			$exp =  $this->dbutil->csv_from_result($query);

			$this->load->helper('download');
			force_download($file_name.'.csv', $exp);

        }
        $page_data['data']  = $this->db->list_fields('student');
        $page_data['page_name']  = 'export_student';
        $page_data['page_title'] = get_phrase('Export Student Data');
        $this->load->view('backend/index', $page_data);

    }

    function export_etranzact($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
        if($param1 =='exp'){
        	$items = array();
        	if ($this->input->post('payments'))
            {
            	//var_dump($this->input->post('students'));
              foreach($this->input->post('payments') as $payment=>$i)
              {
                 $items[] = $payment;
              }
            }
            else{
            	redirect(base_url().'index.php?sadmin/export_etranzact', 'refresh');
            }

            //var_dump($items);
            $string = rtrim(implode(',', $items), ',');

        	$this->load->dbutil();
        	$file_name = 'Payment Report  Alvan Ikoku Federal University Of Education';
        	//$query = $this->db->get_where('student', $items)->result_array();
			$query = $this->db->query("SELECT $string FROM etranzact_payment");
			$exp =  $this->dbutil->csv_from_result($query);

			$this->load->helper('download');
			force_download($file_name.'.csv', $exp);

        }
        $page_data['data']  = $this->db->list_fields('etranzact_payment');
        $page_data['page_name']  = 'export_etranzact';
        $page_data['page_title'] = get_phrase('Export Etranzact Payment Data (2014/2015 -)');
        $this->load->view('backend/index', $page_data);

    }
    	function student_report($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 ==''){

            $par="%";
            $page_data['invoices'] = $this->db->get('student')->result_array();
            $page_data['total'] = $this->db->get('student')->num_rows();
        }
        else if ($param1 == 'degree') {
        $par="Degree";
        $param1="DEGREE";
        //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();
        $this->db->like('prog_type', $par);
        $query=$this->db->get('student');
        $page_data['invoices'] = $query->result_array();
        //var_dump($page_data['invoices']);
        $page_data['total'] = $query->num_rows();

        /*$par = "011";
        $param1 = "First Bank";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();*/

        }
        else if ($param1 == 'nce') {
        $par="NCE";
        $param1="NCE";
        //$page_data['invoices'] = $this->db->get('etranzact_pay')->result_array();
        $this->db->like('prog_type', $par);
        $query=$this->db->get('student');
        $page_data['invoices'] = $query->result_array();
        //var_dump($page_data['invoices']);
        $page_data['total'] = $query->num_rows();

        /*$par = "214";
        $param1 = "FCMB";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();*/

        }
        else if ($param1 == 'Zenith') {


        $par = "057";
        $param1 = "Zenith Bank";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'Alvana') {


        $par = "770";
        $param1 = "Alvana Microfinance Bank";
        $page_data['invoices'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->result_array();
        $page_data['total'] = $this->db->get_where('etranzact_pay', array('bankcode' => $par))->num_rows();

        }
        else if ($param1 == 'delete') {
            $this->db->where('student_id', $param2);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?sadmin/student_report', 'refresh');
        }



        $page_data['page_name']  = 'student_report';
        $page_data['bank'] = $param1;
        $male = "male";
        $female = "female";
        $page_data['male'] = $this->db->get_where('student',array('sex' => $male))->result_array();
        $page_data['stotal'] = $this->db->get_where('student',array('sex' => $male))->num_rows();
        //var_dump($page_data['school']);
        $page_data['female'] = $this->db->get_where('student',array('sex' => $female))->result_array();
        $page_data['htotal'] = $this->db->get_where('student',array('sex' => $female))->num_rows();
        $page_data['page_title'] = get_phrase('Student Report');


        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/

    function book($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');

        if ($param1 == 'create') {

            $data['name']        = $this->input->post('name');

            $data['description'] = $this->input->post('description');

            $data['price']       = $this->input->post('price');

            $data['author']      = $this->input->post('author');

            $data['class_id']    = $this->input->post('class_id');

            $data['status']      = $this->input->post('status');

            $this->db->insert('book', $data);

            redirect(base_url() . 'index.php?admin/book', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']        = $this->input->post('name');

            $data['description'] = $this->input->post('description');

            $data['price']       = $this->input->post('price');

            $data['author']      = $this->input->post('author');

            $data['class_id']    = $this->input->post('class_id');

            $data['status']      = $this->input->post('status');



            $this->db->where('book_id', $param2);

            $this->db->update('book', $data);

            redirect(base_url() . 'index.php?admin/book', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('book', array(

                'book_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('book_id', $param2);

            $this->db->delete('book');

            redirect(base_url() . 'index.php?admin/book', 'refresh');

        }

        $page_data['books']      = $this->db->get('book')->result_array();

        $page_data['page_name']  = 'book';

        $page_data['page_title'] = get_phrase('manage_library_books');

        $this->load->view('backend/index', $page_data);



    }

    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/

    function transport($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');

        if ($param1 == 'create') {

            $data['route_name']        = $this->input->post('route_name');

            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');

            $data['description']       = $this->input->post('description');

            $data['route_fare']        = $this->input->post('route_fare');

            $this->db->insert('transport', $data);

            redirect(base_url() . 'index.php?admin/transport', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['route_name']        = $this->input->post('route_name');

            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');

            $data['description']       = $this->input->post('description');

            $data['route_fare']        = $this->input->post('route_fare');



            $this->db->where('transport_id', $param2);

            $this->db->update('transport', $data);

            redirect(base_url() . 'index.php?admin/transport', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('transport', array(

                'transport_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('transport_id', $param2);

            $this->db->delete('transport');

            redirect(base_url() . 'index.php?admin/transport', 'refresh');

        }

        $page_data['transports'] = $this->db->get('transport')->result_array();

        $page_data['page_name']  = 'transport';

        $page_data['page_title'] = get_phrase('manage_transport');

        $this->load->view('backend/index', $page_data);



    }

    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/

    function dormitory($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect('login', 'refresh');

        if ($param1 == 'create') {

            $data['name']           = $this->input->post('name');

            $data['number_of_room'] = $this->input->post('number_of_room');

            $data['description']    = $this->input->post('description');

            $this->db->insert('dormitory', $data);

            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['name']           = $this->input->post('name');

            $data['number_of_room'] = $this->input->post('number_of_room');

            $data['description']    = $this->input->post('description');



            $this->db->where('dormitory_id', $param2);

            $this->db->update('dormitory', $data);

            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('dormitory', array(

                'dormitory_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('dormitory_id', $param2);

            $this->db->delete('dormitory');

            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');

        }

        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();

        $page_data['page_name']   = 'dormitory';

        $page_data['page_title']  = get_phrase('manage_dormitory');

        $this->load->view('backend/index', $page_data);



    }



    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/

    function noticeboard($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



        if ($param1 == 'create') {

            $data['notice_title']     = $this->input->post('notice_title');

            $data['notice']           = $this->input->post('notice');

            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));

            $this->db->insert('noticeboard', $data);

            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');

        }

        if ($param1 == 'do_update') {

            $data['notice_title']     = $this->input->post('notice_title');

            $data['notice']           = $this->input->post('notice');

            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));

            $this->db->where('notice_id', $param2);

            $this->db->update('noticeboard', $data);

            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));

            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(

                'notice_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {

            $this->db->where('notice_id', $param2);

            $this->db->delete('noticeboard');

            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');

        }

        $page_data['page_name']  = 'noticeboard';

        $page_data['page_title'] = get_phrase('manage_noticeboard');

        $page_data['notices']    = $this->db->get('noticeboard')->result_array();

        $this->load->view('backend/index', $page_data);

    }



    /*****SITE/SYSTEM SETTINGS*********/

    function system_settings($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');



        if ($param1 == 'do_update') {



			 $data['description'] = $this->input->post('system_name');

			 $this->db->where('type' , 'system_name');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('system_title');

			 $this->db->where('type' , 'system_title');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('address');

			 $this->db->where('type' , 'address');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('phone');

			 $this->db->where('type' , 'phone');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('paypal_email');

			 $this->db->where('type' , 'paypal_email');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('currency');

			 $this->db->where('type' , 'currency');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('system_email');

			 $this->db->where('type' , 'system_email');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('buyer');

			 $this->db->where('type' , 'buyer');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('system_name');

			 $this->db->where('type' , 'system_name');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('purchase_code');

			 $this->db->where('type' , 'purchase_code');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('language');

			 $this->db->where('type' , 'language');

			 $this->db->update('settings' , $data);



			 $data['description'] = $this->input->post('text_align');

			 $this->db->where('type' , 'text_align');

			 $this->db->update('settings' , $data);



            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');

        }

        if ($param1 == 'upload_logo') {

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');

        }

        $page_data['page_name']  = 'system_settings';

        $page_data['page_title'] = get_phrase('system_settings');

        $page_data['settings']   = $this->db->get('settings')->result_array();

        $this->load->view('backend/index', $page_data);

    }



    /*****LANGUAGE SETTINGS*********/

    function manage_language($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		if ($param1 == 'edit_phrase') {

			$page_data['edit_profile'] 	= $param2;

		}

		if ($param1 == 'update_phrase') {

			$language	=	$param2;

			$total_phrase	=	$this->input->post('total_phrase');

			for($i = 1 ; $i < $total_phrase ; $i++)

			{

				//$data[$language]	=	$this->input->post('phrase').$i;

				$this->db->where('phrase_id' , $i);

				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));

			}

			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');

		}

		if ($param1 == 'do_update') {

			$language        = $this->input->post('language');

			$data[$language] = $this->input->post('phrase');

			$this->db->where('phrase_id', $param2);

			$this->db->update('language', $data);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');

		}

		if ($param1 == 'add_phrase') {

			$data['phrase'] = $this->input->post('phrase');

			$this->db->insert('language', $data);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');

		}

		if ($param1 == 'add_language') {

			$language = $this->input->post('language');

			$this->load->dbforge();

			$fields = array(

				$language => array(

					'type' => 'LONGTEXT'

				)

			);

			$this->dbforge->add_column('language', $fields);



			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');

		}

		if ($param1 == 'delete_language') {

			$language = $param2;

			$this->load->dbforge();

			$this->dbforge->drop_column('language', $language);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));



			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');

		}

		$page_data['page_name']        = 'manage_language';

		$page_data['page_title']       = get_phrase('manage_language');

		//$page_data['language_phrases'] = $this->db->get('language')->result_array();

		$this->load->view('backend/index', $page_data);

    }



    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/

    function backup_restore($operation = '', $type = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');



        if ($operation == 'create') {

            $this->crud_model->create_backup($type);

        }

        if ($operation == 'restore') {

            $this->crud_model->restore_backup();

            $this->session->set_flashdata('backup_message', 'Backup Restored');

            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');

        }

        if ($operation == 'delete') {

            $this->crud_model->truncate($type);

            $this->session->set_flashdata('backup_message', 'Data removed');

            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');

        }



        $page_data['page_info']  = 'Create backup / restore from backup';

        $page_data['page_name']  = 'backup_restore';

        $page_data['page_title'] = get_phrase('manage_backup_restore');

        $this->load->view('backend/index', $page_data);

    }



    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/

    function manage_profile($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {

            $data['name']  = $this->input->post('name');

            $data['email'] = $this->input->post('email');



            $this->db->where('sadmin_id', $this->session->userdata('sadmin_id'));

            $this->db->update('sadmin', $data);

            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));

            redirect(base_url() . 'index.php?sadmin/manage_profile/', 'refresh');

        }

        if ($param1 == 'change_password') {

            $data['password']             = $this->input->post('password');

            $data['new_password']         = $this->input->post('new_password');

            $data['confirm_new_password'] = $this->input->post('confirm_new_password');



            $current_password = $this->db->get_where('sadmin', array(

                'sadmin_id' => $this->session->userdata('sadmin_id')

            ))->row()->password;

            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {

                $this->db->where('sadmin_id', $this->session->userdata('sadmin_id'));

                $this->db->update('sadmin', array(

                    'password' => $data['new_password']

                ));

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));

            } else {

                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));

            }

            redirect(base_url() . 'index.php?sadmin/manage_profile/', 'refresh');

        }

        $page_data['page_name']  = 'manage_profile';

        $page_data['page_title'] = get_phrase('manage_profile');

        $page_data['edit_data']  = $this->db->get_where('sadmin', array(

            'sadmin_id' => $this->session->userdata('sadmin_id')

        ))->result_array();

        $this->load->view('backend/index', $page_data);

    }
	
	/*****Enterprise**********/
	
/*function schoolenterprise(){
	if($_POST){
		$data = array(
		'schoolName'=>$_POST['schoolName'],
		'schoolCode'=>$_POST['schoolCode'],
		'description'=>$_POST['description']
		);
		$this->school_enterprise_model->insert_school($data);
	}
}
*/

function schoolenterprises(){
	
	if($_POST){
		$data = array(
		'schoolName'=>$_POST['schoolName'],
		'schoolCode'=>$_POST['schoolCode'],
		'description'=>$_POST['description']
		);
		$this->db->insert('enterprise_school', $data); 
		
	}
	$this->load->view('backend/schoolenterprise',$data);
}


function departmententerprise(){
	if($_POST){
		$data = array(
		'deptName'=>$_POST['deptName'],
		'deptCode'=>$_POST['deptCode'],
		'schoolID'=>$_POST['schoolID'],
		'description'=>$_POST['description']
		
		);
		$this->db->insert('enterprise_department',$data);
	}
	$this->load->view('backend/department_enterprise',$data);
}

function check_payment_status()
	{
		$count=1;
		    $query = $this->db->query("select* from invoice_gen where status is null")->result_array();
			foreach($query as $row)
			{
				
				$rrr = $row["rrr"];
				$portalID=$row["portal_id"];
			$mert =  '2266665151';

			$api_key =  '591873';

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

				$data['unique_id'] = $response['orderId'];

				$data['response_code'] = $response['status'];

				$data['trans_date'] = $response['transactiontime'];
				
				$data['service_type'] = '3276893356';

				$data2['status'] = $msg;


						
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);
				}

			

		
			$count++;
			}
		echo "$count ".$rem." ".$response['message'].' '.$row["surname"].' '.$row["firstname"];
		}
			
	}
	
	function check_acceptance_payment_status()
	{
		$count=1;
		    $query = $this->db->query("select* from eduportal_remita_accp_temp_data where  status='Payment Pending'")->result_array();
			foreach($query as $row)
			{
					$rrr = $row["rrr"];
				$portalID=$row["putme_id"];
			$mert =  '2266665151';

			$api_key =  '591873';

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
				
				$data['service_type'] = '2223831078';

				$data2['status'] = $msg;


						
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_accp_temp_data', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
					

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);
				}

			

		
			$count++;
			}
		echo "$count ".$rem." ".$response['message'].' '.$data['payer_name'];
			}
			
	}


 function send_bulk_sms()

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'send_bulk_sms';

        $page_data['page_title'] = get_phrase('send_bulk_sms');

        $this->load->view('backend/index', $page_data);

    }
	function ajax_send_bulk_sms()
{
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
				
	$sadmin_id =$this->session->userdata('sadmin_id');

   $sendtype= $this->input->post('sendtype');	
   if($sendtype=="1")
   {
	   $page_data['smslist']= $this->db->get_where('student', array("status" => 2))->result_array(); 
   }
   

   else{ 
   $school= $this->input->post('school');
   $depts= $this->input->post('depts');
   $message= addslashes($this->input->post('message'));
 
   $page_data['smslist']= $this->db->get_where('student', array("dept" => $depts,"status" => "2"))->result_array();
   }
   $page_data['message']  = $message;
   $page_data['page_name']  = 'ajax_send_bulk_sms';
   $page_data['page_title'] = get_phrase('ajax_send_bulk_sms');

   $this->load->view('backend/index', $page_data);
   
}

function approve_lecturer_results_hod()
{
	session_start();
		 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			//$_SESSION['id']=1;
	$page_data = array(
   
   'page_name'=>'approve_lecturer_results_homepage_hod',
   'page_title'=>'Results Approval'
   );
  $this->load->view('backend/index', $page_data);
}

function ajax_view_lecturer_results_approval_hod()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
 include('application/config/z.php');
$_SESSION["sem"]=$this->input->post('semester');
$_SESSION["ses"] = $this->input->post('session');
   $page_data = array(
   'semester'=> $this->input->post('semester'),
   'conn'=> $conn,
   'session'=> $this->input->post('session'),
   'page_name'=>'manage_lecturer_results_approval_hod',
   'page_title'=>'Results Approval Panel'
   );

  
    $this->load->view('backend/index', $page_data);
    }
	
	
function ajax_approve_lecturer_results_hod($id)
{
	session_start();
	if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
			$ca_id= $id;
			
			$data['dean_approved'] =1;
			$this->db->where(array('course_assigned_to_dept_id'=>$ca_id));
			$this->db->update('course_assigned_to_lecturers',$data);
			
			$data2['result_approved'] =1;
			$this->db->where(array('course_assign_to_dept_id'=>$ca_id));
			$this->db->update('courses_registered',$data2);
			
			$data3['course_assigned_to_dept_id']=$ca_id;
			$data3['approver_id	']=$this->session->userdata('sadmin_id');
		
			$data3['ip'] = $this->input->ip_address();//retreive ip address
			$data3['date_approved'] = date('Y-m-d H:i:s');//retrieve date
			
			$this->db->insert("results_approval_log",$data3);
			
			$_SESSION['error'] = "Results Approved Successfully";
			header("Location: index.php?sadmin/ajax_view_lecturer_results_approval_two_hod");
			
}

	function ajax_view_lecturer_results_approval_two_hod()
	{
				session_start();
			if ($this->session->userdata('sadmin_login') != 1)

 redirect(base_url(), 'refresh');
include('application/config/z.php');
   $page_data = array(
    'semester'=> $_SESSION["sem"],
   'session'=> $_SESSION["ses"],
   'conn'=> $conn,
   'page_name'=>'manage_lecturer_results_approval_hod',
   'page_title'=>'Results Panel'
   );
    $this->load->view('backend/index', $page_data);
    }
	
public function processview_applicants_all()
{
	session_start();
   if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');
		
		$prog = $this->input->post('prog');
		//$dept = $this->input->post('dept');
		$_SESSION["deptid"]= $dept;
		//$_SESSION["progid"]= $prog;
$page_data['page_name']  = 'applicants_reports_all';
$page_data['page_title'] = ' View Applicants All';

//$this->session->userdata('admin_login');
$this->load->view('backend/index',$page_data);
}


	   
 public function verify_olevel_result()
   {
   	session_start();
      if ($this->session->userdata('sadmin_login') != 1)

               redirect(base_url() . 'index.php?login', 'refresh');
		
   		
   $page_data['page_name']  = 'verify_olevel_result';
   $page_data['page_title'] = 'Verify OLevel Results';

   //$this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
   }
   
    public function process_verify_olevel_result()
   {
   	session_start();
	error_reporting(0);
	//include('phpseclib/Crypt/RSA.php');
      if ($this->session->userdata('sadmin_login') != 1)

    redirect(base_url() . 'index.php?login', 'refresh');
		
   	$ExamType = $this->input->post('ExamType');
	$eExamYear = $this->input->post('eExamYear');
	$eCandidateNo = $this->input->post('eCandidateNo');
	$Username = 'vofene';
	$ePassword ='excellency1';
	$eSecToken = 'FP6j2FF176n44DbTOFTMcrIPUVVn95s9uO6mcQdyZtoUmWTTEW';
	
	$PrivateKey = "jHCqGUeK";


    
 try{
	 $opts = array(
    'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
);
// SOAP 1.2 client
$params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
$soapclient = new SoapClient('https://waeconline.org.ng/verification/subscriber.asmx?WSDL',$params);

$param=array('Username'=>$Username,'ePassword'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$ePassword,"Key"=>$PrivateKey))->EncryptDataResult),'eCandidateNo'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eCandidateNo,"Key"=>$PrivateKey))->EncryptDataResult),'eExamYear'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eExamYear,"Key"=>$PrivateKey))->EncryptDataResult),'ExamType'=>$ExamType,'eSecToken'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eSecToken,"Key"=>$PrivateKey))->EncryptDataResult));
//print_r($param);
//exit;

$response =$soapclient->CheckResultJSON($param);

echo '<br>';
$array = json_decode(json_encode($response), true);
//$response = json_decode($jsonData, true);




	foreach($array as $item) {
		
//echo $item;
$result =json_decode($item, true);
	//echo '<br/>';
	
	//print_r($result);exit;
	$page_data['result']  = $result;
	foreach($result['Candidate'] as $item2) {
		$_SESSION['CandNo'] =$item2["CandNo"];
   //echo $item2["CandNo"].' '.$item2["FormNo"]."<br/>" ;
}
	foreach($result['CandidateResult'] as $item3) {
  // echo $item3["Subject"].' '.$item3["Grade"]."<br/>" ;
}
}	
	
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}	

 
//Print out the response output.
//echo $result;
	
   $page_data['page_name']  = 'WAECVerifiedResult';
   $page_data['page_title'] = ' Result Page ';

  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
   }
   
   public function verify_olevel_result_api($ExamType,$eExamYear,$eCandidateNo)
   {
   	session_start();
	//include('phpseclib/Crypt/RSA.php');
     error_reporting(0);
   	
	$Username = 'vofene';
	$ePassword ='excellency1';
	$eSecToken = 'FP6j2FF176n44DbTOFTMcrIPUVVn95s9uO6mcQdyZtoUmWTTEW';
	
	$PrivateKey = "jHCqGUeK";
 
//echo $ExamType.$eExamYear.$eCandidateNo;
//  exit;  
 try{
	 $opts = array(
    'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
);
// SOAP 1.2 client
$params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
$soapclient = new SoapClient('https://waeconline.org.ng/verification/subscriber.asmx?WSDL',$params);

$param=array('Username'=>$Username,'ePassword'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$ePassword,"Key"=>$PrivateKey))->EncryptDataResult),'eCandidateNo'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eCandidateNo,"Key"=>$PrivateKey))->EncryptDataResult),'eExamYear'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eExamYear,"Key"=>$PrivateKey))->EncryptDataResult),'ExamType'=>$ExamType,'eSecToken'=>base64_encode($soapclient->EncryptData(array("DataPlain"=>$eSecToken,"Key"=>$PrivateKey))->EncryptDataResult));
//print_r($param);
//exit;

$response =$soapclient->CheckResultJSON($param);

echo '<br>';
$array = json_decode(json_encode($response), true);
//$response = json_decode($jsonData, true);




	foreach($array as $item) {
		
//echo $item;
$result =json_decode($item, true);
	//echo '<br/>';
	
	//print_r($result);exit;
	$page_data['result']  = $result;
	foreach($result['Candidate'] as $item2) {
		$_SESSION['CandNo'] =$item2["CandNo"];
   //echo $item2["CandNo"].' '.$item2["FormNo"]."<br/>" ;
}
	foreach($result['CandidateResult'] as $item3) {
  // echo $item3["Subject"].' '.$item3["Grade"]."<br/>" ;
}
}	
	
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}	

 
//Print out the response output.
//echo $result;
	
   $page_data['page_name']  = 'WAECVerifiedResult';
   $page_data['page_title'] = ' Result Page ';

  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
   }
   
   
    function view_applicants_phone()

    {
$total=0;
     $db2= $this->load->database("db2",TRUE);   
$details =$db2->query("select* from View_Applicant_Data where program_code='DEG' and cbt_score < 12")->result_array();
						
						?>
						<table>
						<tr>
						<td>SN</td>
						<td>NAME</td>
						<td>MOBILE NO</td>
						<td>DEPARTMENT</td>
						</tr>
						<?php 
						foreach($details as $row){
						$id= $row["mobile_no"];
						$total++;
						?>
						<tr>
						<td><?php echo $total;?></td>
						<td><?php echo $row["candidate_name"];?></td>
						<td><?php echo '0'.$row["mobile_no"];?></td>
						<td><?php echo $row["dept_name"];?></td>
						</tr><?php }?>
						</table>
					<?php
					
						
						
        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		//$app= $db2->query("SELECT min(applicant_id) as expx FROM hnd_applicants_form WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'")->row()->expx;
		//$db2->query("update hnd_applicants_form set has_cbt_sit='1', WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'");
		
	
	}
	
	 function view_invoice_applicants_info()

    {

  $db2= $this->load->database("db2",TRUE);      

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		//$app= $db2->query("SELECT min(applicant_id) as expx FROM hnd_applicants_form WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'")->row()->expx;
		//$db2->query("update hnd_applicants_form set has_cbt_sit='1', WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'");
   $page_data['page_name']  = 'manage_appform_fee_invoice';
   $page_data['page_title'] = ' Applicant_invoice ';
$page_data['feeinvoice'] = $db2->query("select* from applicationinvoice_gen")->result_array();
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	
	 function view_cbt_schedule()
    {

  
   $page_data['page_name']  = 'view_applicants_cbt_exam_schedule';
   $page_data['page_title'] = ' view_applicants_cbt_exam_schedule ';

  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	function process_view_cbt_schedule()
    {
 $exam= $this->input->post('exam');
  
   $page_data['page_name']  = 'view_cbt_schedule';
   $page_data['page_title'] = ' view_cbt_schedule ';
$page_data['exam'] = $exam;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	
	
	function process_view_applicant_results_by_dept()
    {
   $dept= $this->input->post('dept');
  
   $page_data['page_name']  = 'view_process_applicant_exams';
   $page_data['page_title'] = ' view_process_applicant_exams ';
   $page_data['dept'] = $dept;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	
	
	function process_view_applicant_results_by_dept_changecourse()
    {
   $dept= $this->input->post('dept');
  
   $page_data['page_name']  = 'view_process_applicant_exams_course_change';
   $page_data['page_title'] = ' view_process_applicant_exams ';
   $page_data['dept'] = $dept;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	
		function process_view_applicant_results_by_dept_corrections()
    {
   $dept= $this->input->post('dept');
  
   $page_data['page_name']  = 'view_process_applicant_exams_corrections';
   $page_data['page_title'] = ' view_process_applicant_exams ';
   $page_data['dept'] = $dept;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	   function view_applicants_results_by_dept_corrections()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicants_results_by_dept_corrections';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_results_by_dept_corrections');
		$this->load->view('backend/index', $page_data);
	}
	
	    function view_applicants_results_by_dept_two()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicants_results_by_dept_two';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_results_by_dept_two');
		$this->load->view('backend/index', $page_data);
	}
	
	
	  function view_applicants_results_by_low_age()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicants_results_by_low_age';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicants_results_by_low_age');
		$this->load->view('backend/index', $page_data);
	}
	function process_view_applicant_results_by_age()
    {
   $dept= $this->input->post('dept');
  
   $page_data['page_name']  = 'process_view_applicant_results_by_age';
   $page_data['page_title'] = ' process_view_applicant_results_by_age ';
   $page_data['dept'] = $dept;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	   function view_process_applicant_cbt_total_dept()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_process_applicant_cbt_total_dept';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_process_applicant_cbt_total_dept');
		$this->load->view('backend/index', $page_data);
	}
	  
	  function view_process_applicant_hnd()

    {

		//$db2= $this->load->database("db2",TRUE);
		$page_data['page_name']  = 'view_applicant_hnd';
       // $page_data['db2']  = $db2;
        $page_data['page_title'] = get_phrase('view_applicant_hnd_applicants');
		$this->load->view('backend/index', $page_data);
	}
	
	function process_view_process_applicant_hnd()
    {
   $dept= $this->input->post('dept');
   $prog= $this->input->post('prog');
  
   $page_data['page_name']  = 'view_process_applicant_hnd';
   $page_data['page_title'] = ' view_process_applicant_hnd';
   $page_data['dept'] = $dept;
   $page_data['prog'] = $prog;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
	
	
	
		 function sendsms()

    {

  //$db2= $this->load->database("db2",TRUE);      

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
      //  $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
         //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
		//$app= $db2->query("SELECT min(applicant_id) as expx FROM hnd_applicants_form WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'")->row()->expx;
		//$db2->query("update hnd_applicants_form set has_cbt_sit='1', WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'");
?><table border='1'><?php 
		include('application/config/z2.php');
 $application_query= sqlsrv_query($conn,"SELECT  applicant_id,application_no,firstname,surname, email,mobile_no,cbt_day, cbt_date, cbt_time, cbt_venue, cbt_exam_no FROM hnd_applicants_form WHERE has_cbt_sit='1' and has_cbt_sms='0' and program_code='DEG' and progress_step='3'")or die( print_r( sqlsrv_errors(), true));
 while(list($app_id,$application_no,$fn,$sn,$email,$mn,$cbt_day,$cbt_date,$cbt_time,$cbt_venue,$cbt_exam_no)=sqlsrv_fetch_array($application_query))
						{
						
						$names =$fn.' '.$sn;
$fname=$fn;							
$to = "To: $names <$email>";
?>

<tr>
<th><?php echo $app_id;?></th>
<th><?php echo $application_no;?></th>
<th><?php echo $fn;?></th>
<th><?php echo $sn;?></th>
<th><?php echo $email;?></th>
<th><?php echo $mn;?></th>
<th><?php echo $cbt_day;?></th>
<th><?php echo $cbt_date;?></th>
<th><?php echo $cbt_time;?></th>
<th><?php echo $cbt_venue;?></th>
<th><?php echo $cbt_exam_no;?></th>

</tr>
						<?php

sqlsrv_query($conn, "Update hnd_applicants_form set has_cbt_sms='1' where application_no='$application_no' "); 						}
						exit;
						?>
</table>
<?php
$subject = "Notification of Yabatech PUTME CBT Examination";

$message = "
<html>
<head>
<title>Notification of Yabatech PUTME CBT Examination</title>
</head>
<body>
<p><img src='http://erp.yabatech.edu.ng/application/assets/sites/default/files/logo.png'></p>
<p>Hello $fname,</p>
<p>Find Details of your CBT Examination ,</p>
<table>
<tr>
<th>Examination Date: $cbt_day - $cbt_date</th>
<th>Time: $cbt_time</th>
</tr>
<tr>
<th>Venue: $cbt_venue</th>
<th>Exam Serial No: $cbt_exam_no</th>
</tr>
<tr>
<td>Mobile No: $phone</td>
<td>DO NOT FORGET TO BE AT THE VENUE AT LEAST 2HRS BEFORE EXAM. SUCCESS!!!</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: YABATECH PUTME<noreply@YABATECH.edu.ng>' . "\r\n";


//mail($to,$subject,$message,$headers);

$name= $names;
$tel= $mn;
//$pid= $details->first_name;
//$fulldate= $fulldetails[3];

//require_once 'assets/bsgateway.php';
//$messageObj = new BSGateway($config);
$arrContextOptions=array(
    "ssl"=>array(
        "cafile" => "cacert-2019-08-28.pem",
        "verify_peer"=> true,
        "verify_peer_name"=> true,
    ),
);

$msg = "Hello $fname, your YABATECH CBT Examination are as follows: Date: $cbt_day, $cbt_date. Time: $cbt_time, SerialNo: $cbt_exam_no, Venue: $cbt_venue. 09029776883";
$tel ='234'.substr($tel,1);
							
	$url=str_replace(" ","%20","https://netbulksms.com/index.php?option=com_spc&comm=spc_api&username=victorofene&password=excellency1&sender=YABATECH&recipient=$tel&message=");
$response= fopen($url, "r");
echo phpinfo();							
exit;
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_CAINFO,"cacert-2019-08-28.pem");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$data = curl_exec($ch);
	curl_close($ch);
	echo $data;
// Close request to clear up some resources
//url_close($curl);
//echo $resp;
/* 	if($response=='OK 1.2'){
sqlsrv_query($conn, "Update hnd_applicants_form set has_cbt_sms='1' where application_no='$application_no' "); 	
}		 */
						
	}

	

public function postpaymentdata()
   {
   	session_start();
	//include('phpseclib/Crypt/RSA.php');
 
 
$serviceheadid = "gtcopaul";
$token  = "736@_73gh";
//echo $ExamType.$eExamYear.$eCandidateNo;
//  exit;  
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
't1'=>"Paid",
't2'=>"2009-01-01",
't3'=>"30000",
't4'=>"TEST ACCEPTANCE FEE PAYMENT FOR OLADIPO OLUWASEGUN",
't5'=>"5433222234432",
't6'=>"2",
't7'=>"547643867FR" );
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
	
	//print_r($result);exit;
	/* $page_data['result']  = $result;
	foreach($result['Candidate'] as $item2) {
		$_SESSION['CandNo'] =$item2["CandNo"];
   //echo $item2["CandNo"].' '.$item2["FormNo"]."<br/>" ;
}
	foreach($result['CandidateResult'] as $item3) {
  // echo $item3["Subject"].' '.$item3["Grade"]."<br/>" ;
} */
}	
	
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}
   }

// api to sent acceptance fees details
public function postpaymentdatainbatches()
   {
   	session_start();
	//include('phpseclib/Crypt/RSA.php');
 
	include('application/config/z.php');
 
$serviceheadid = "gtcopaul";
$token  = "736@_73gh";
//echo $ExamType.$eExamYear.$eCandidateNo;
//  exit;
$application_query= sqlsrv_query($conn,"SELECT TOP(200) id, regno, payment_code, payment_session, payment_level, payment_amount, payment_status, convert(varchar, payment_date, 23), payment_fee_type, student_id, semester 
FROM   eduportal_fees_payment_log where posted_citm='0' and payment_session='2019/2020'")or die( print_r( sqlsrv_errors(), true));
 while(list($id, $regno, $payment_code, $payment_session, $payment_level, $payment_amount, $payment_status, $payment_date, $payment_fee_type, $student_id, $semester)=sqlsrv_fetch_array($application_query))
						{
							
$adm= sqlsrv_query($conn,"SELECT  portal_id, name, othername from student where portal_id='$regno'")or die( print_r( sqlsrv_errors(), true));
 while(list($application_no, $surname, $firstname)=sqlsrv_fetch_array($adm))
						{
					
						$names =$surname.' '.$firstname;  
						if($payment_fee_type==4)
		{
			$description="ACCEPTANCE FEE PAYMENT FOR ".$names;
		}
		else{
			$description= $this->db->query("select* from applicationinvoice_gen where rrr='$payment_code'")->row()->paymentdescription;
		}
		
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
't2'=>$payment_date,
't3'=>$payment_amount,
't4'=>$description,
't5'=>$payment_code,
't6'=>$payment_fee_type,
't7'=>$application_no );
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
	
	//print_r($result);exit;
	/* $page_data['result']  = $result;
	foreach($result['Candidate'] as $item2) {
		$_SESSION['CandNo'] =$item2["CandNo"];
   //echo $item2["CandNo"].' '.$item2["FormNo"]."<br/>" ;
}
	foreach($result['CandidateResult'] as $item3) {
  // echo $item3["Subject"].' '.$item3["Grade"]."<br/>" ;
} */
}	
sqlsrv_query($conn,"update eduportal_fees_payment_log set posted_citm='1' where regno='$application_no' and payment_fee_type='$payment_fee_type'") or die( print_r( sqlsrv_errors(), true));
	
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}
   }
   }}   
   
   // Web service api to get payment details from CITM server
   public function postpaymentsingle($rrr)
   {
   	session_start();
	//include('phpseclib/Crypt/RSA.php');
 
	include('application/config/z.php');
 $id=0;
$serviceheadid = "gtcopaul";
$token  = "736@_73gh";
//echo $ExamType.$eExamYear.$eCandidateNo;
//  exit;
$application_query= sqlsrv_query($conn,"SELECT  id, regno, payment_code, payment_session, payment_level, payment_amount, payment_status, convert(varchar, payment_date, 23), payment_fee_type, student_id, semester 
FROM   eduportal_fees_payment_log where payment_code='$rrr'")or die( print_r( sqlsrv_errors(), true));
 while(list($id, $regno, $payment_code, $payment_session, $payment_level, $payment_amount, $payment_status, $payment_date, $payment_fee_type, $student_id, $semester)=sqlsrv_fetch_array($application_query))
						{
							
$adm= sqlsrv_query($conn,"SELECT  portal_id, name, othername from student where portal_id='$regno'")or die( print_r( sqlsrv_errors(), true));
 while(list($application_no, $surname, $firstname)=sqlsrv_fetch_array($adm))
						{
					
						$names =$surname.' '.$firstname;  
						if($payment_fee_type==4)
		{
			$description="ACCEPTANCE FEE PAYMENT FOR ".$names;
		}
		else{
			$description= $this->db->query("select* from applicationinvoice_gen where rrr='$payment_code'")->row()->paymentdescription;
		}
		
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
't2'=>$payment_date,
't3'=>$payment_amount,
't4'=>$description,
't5'=>$payment_code,
't6'=>$payment_fee_type,
't7'=>$application_no );
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
	
	//print_r($result);exit;
	/* $page_data['result']  = $result;
	foreach($result['Candidate'] as $item2) {
		$_SESSION['CandNo'] =$item2["CandNo"];
   //echo $item2["CandNo"].' '.$item2["FormNo"]."<br/>" ;
}
	foreach($result['CandidateResult'] as $item3) {
  // echo $item3["Subject"].' '.$item3["Grade"]."<br/>" ;
} */
}	
	sqlsrv_query($conn,"update eduportal_fees_payment_log set posted_citm='1' where regno='$application_no' and payment_fee_type='$payment_fee_type'") or die( print_r( sqlsrv_errors(), true));
	$id++;
	//print_r($items);
}catch(Exception $e){
	echo $e->getMessage();
}
   }
   }
  // if($id<1){echo "Payment has not been processed";
  // }
   }   
    public function callpaymentdata()
   {
	   session_start();

	   try{
	
$soapclient = new SoapClient('http://portal.yabatech.edu.ng/paymentservice/yctoutservice.asmx?wsdl');


$response =$soapclient->dodo();

echo '<br>';
$array = json_decode(json_encode($response), true);

//$response = json_decode($jsonData, true);




	foreach($array as $item) {
		
echo $item;
$result =json_decode($item, true);
echo '<br/>';
	
	
}

} catch(soapFault $exception){
echo $exception->getMessage();

}	

}

// admission activities new features implementation

 function admitted_student_view()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
		
			$page_data['page_name']  = 'admitted_student_view';
		

        $page_data['page_title'] ="Generate Admitted Students Report";

        $this->load->view('backend/index', $page_data);
	}

	
	 function processAdmittedStudents()
	{
		  if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
			
			 $academic_session = $this->input->post('academic_session');
			 $programmeType = $this->input->post('programmeType');
			 $reportOptn = $this->input->post('reportOptn');
			 $deptID = $this->input->post('depts');
			 
			 if($reportOptn==2 &&  $programmeType!='ALL' ){
				 
				  $page_data['admitted_list']=$this->db->query("SELECT * FROM eduportal_admission_list WHERE  dept_id='$deptID' and session='$academic_session' and programme_type_id='$programmeType' ")->result_array();
			 }
			  if($reportOptn==1 &&  $programmeType!='ALL'){
				 
				  $page_data['admitted_list']=$this->db->query("SELECT * FROM eduportal_admission_list WHERE  session='$academic_session' and programme_type_id='$programmeType' ")->result_array();
			 }
			
			if($reportOptn==1 &&  $programmeType=='ALL'){
				 
				  $page_data['admitted_list']=$this->db->query("SELECT * FROM eduportal_admission_list WHERE  session='$academic_session'  ")->result_array();
			 }
		
			$page_data['page_name']  = 'admitted_list';
	        $page_data['page_title'] ="Student Admitted List Report";

            $this->load->view('backend/index', $page_data);
	    }
	// end of admission activities new features implementation#
	

	
	// UNADMITTED APPLICANTS FUNCTIONALITY
		  function view_process_unadmitted_applicants()

    {
		$page_data['page_name']  = 'view_unadmitted_applicants';
        $page_data['page_title'] = get_phrase('view_unadmitted_hnd_applicants');
		$this->load->view('backend/index', $page_data);
		
	}
	
	
	function process_view_unadmitted_applicant_hnd()
    {
   $dept= $this->input->post('dept');
   $prog= $this->input->post('prog');
  
   $page_data['page_name']  = 'view_process_unadmitted_applicants_hnd';
   $page_data['page_title'] = 'View Process Unadmitted Applicant hnd';
   $page_data['dept'] = $dept;
   $page_data['prog'] = $prog;
  // $this->session->userdata('admin_login');
   $this->load->view('backend/index',$page_data);
	
	}
    
     function create_nw_user()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');
    }
  
  // COLLEGE STAFF ACTVITIES
  function staff($view_option,$sid='')

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');


        if($view_option=='ALL_STAFF'){
  
        $page_data['staffdata'] = $this->db->order_by('sid', 'ASC')->get('erp_staff')->result_array();
        $page_data['page_name']  = 'view_all_staff';

        $page_data['page_title'] = get_phrase('view_all_staff');

        $this->load->view('backend/index', $page_data);
        }
       
        if($view_option=='ACADEMIC_STAFF'){
  
        $page_data['staffdata'] = $this->db->order_by('sid', 'ASC')->get('erp_staff')->result_array();
        $page_data['page_name']  = 'view_all_staff';

        $page_data['page_title'] = get_phrase('view_all_staff');

        $this->load->view('backend/index', $page_data);
        }
        if($view_option=='VIEW_STAFF_DETAILS'){
            
        $page_data['staff_detail'] = $this->db->get_where('erp_staff',array('sid'=>$sid))->result_array();
        $page_data['page_name']  = 'staff_details';

        $page_data['page_title'] = get_phrase('staff_details');

        $this->load->view('backend/index', $page_data);
        }
        
    }
    
    // end of staff activities
    
    // beginning of memo activities
    
       function memos($memo_option,$memo_id='',$MEMO_TRACKING_NO="",$navigation_options='')

    {

        if ($this->session->userdata('sadmin_login') != 1)

           redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        //$page_data['etz'] = $this->db->order_by('id', 'DESC')->get('etranzact_payment',3)->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
            $dept_id         = $this->session->userdata('dept_id');
            $sch_id          = $this->session->userdata('unit_sch_id');
            $desig_id        = $this->session->userdata('desig_id');
          
          
           if($memo_option=='SEND_MEMO'){
        $page_data['page_name']  = 'send_memo';

        $page_data['page_title'] = get_phrase('send memo');

        $this->load->view('backend/index', $page_data);
           }
           
           if($memo_option=='PROCESS_SEND_MEMO'){
            $send_memo_sid=$this->input->post('sid');
			
			
            $dept_code=$this->input->post('depts');
          
            $staff_details  = $this->db->get_where("sadmin", array('sadmin_id' =>$send_memo_sid))->row();
			
			
            $dept_id_act  = $dept_code;                              
           
            $data['memo_title']          = $this->input->post('memo_title');
            $data['memo_initiator_sid']        = $this->session->userdata('sid');
            $data['initiator_dept_id']            = $dept_id;
            $data['initiator_unit_sch_id']           = $sch_id ;
            $data['initiator_desig_id']        = $desig_id;

            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $dept_id_act;
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $staff_details->desig_id;
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $memo_tracking_id        = "MEMO".$staff_details->sadmin_id.strtotime(date("Y-m-d H:i:s"));
            $data['memo_tracking_id']=$memo_tracking_id ;
			
			$data['memo_timestamp']        = date("Y-m-d H:i:s");
			
			
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$dept_id))->row()->deptName;
			$memo_comment = $this->input->post('memo_comment');
			$data['memo_minutes'] =strtoupper($this->session->userdata('name'))."($designation - $dept_name): $memo_comment <br/>";
			$sent_to_id = $this->input->post('sid');
			
			$designation_sent_to=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_details->desig_id))->row()->designation_name;
			$dept_name_sent_to=$this->db->get_where('department',array('deptID'=>$dept_id_act))->row()->deptName;
			
			$data['awaiting_staff_minute_id'] = $sent_to_id;
			$data['awaiting_staff_minute_name']= $staff_details->name." ($designation_sent_to - $dept_name_sent_to)";
			
				//	print_r($data);
//exit;	
			
            if($this->input->post('memo_status')=="SEND"){
            $data['memo_status']        = "PENDING";
            }
             if($this->input->post('memo_status')=="DRAFT"){
            $data['memo_status']        = "DRAFT";
            }
            
            $data['upload_doc_path']        = "uploads/memos/" . $staff_details->sadmin_id. trim($_FILES["file_name"]["name"]);
        
            $this->db->insert('erp_memo_act',$data);
  
  $ccs=$this->input->post('cc');
			foreach($ccs as $cc)
			{
				//echo $cc;
			$data2['memo_tracking_id'] = $memo_tracking_id;
			$data2['staff_copied_id'] = $cc;
			$this->db->insert('erp_memo_act_user_copied',$data2);
			}
  
        //$attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/memos/" . $staff_details->sadmin_id. trim($_FILES["file_name"]["name"]));

        
         $this->session->set_flashdata('message' , get_phrase('memo_sent_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/send_all_memo');	
              
       }
       
            if($memo_option=='VIEW_PENDING_MEMO'){
               
               
        $page_data['page_name']  = 'pending_memos';

        $page_data['page_title'] = get_phrase('pending memo');

        $this->load->view('backend/index', $page_data);
               
                
                
            }
			
			 if($memo_option=='VIEW_COPIED_MEMO'){
               
               
        $page_data['page_name']  = 'copied_memos';

        $page_data['page_title'] = get_phrase('copied memo');

        $this->load->view('backend/index', $page_data);
               
                
                
            }
            
        if($memo_option=='VIEW_MEMO_DETAILS'){
               
        $page_data['memo_detail'] = $this->db->get_where('erp_memo_act',array('id'=>$memo_id))->result_array();

        $page_data['page_name']  = 'display_detail_sent_memo';

        $page_data['page_title'] = get_phrase('sent detail memo');

        $this->load->view('backend/index', $page_data);
               
                
                
            }
            
                if($memo_option=='EDIT_MEMO_SENT'){
               
        $page_data['edit_memo_detail'] = $this->db->get_where('erp_memo_act',array('id'=>$memo_id))->result_array();

        $page_data['page_name']  = 'edit_pending_sent_memo';

        $page_data['page_title'] = get_phrase('edit pending memo');

        $this->load->view('backend/index', $page_data);
      
            }
            
            if($memo_option=='PROCESS_EDIT_SENT_MEMO'){
            
            $id      = $this->input->post('id');
            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $this->input->post('dept_code');
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $this->input->post('desig_id');
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $this->db->where('id', $id);
            $this->db->update('erp_memo_act', $data);
            
            redirect(base_url() . 'index.php?sadmin/send_all_memo');
            
            }

             if($memo_option=='VIEW_ALL_MEMO_DETAILS'){
               
        $page_data['all_memo_detail'] = $this->db->get_where('erp_memo_act',array('memo_tracking_id'=>$MEMO_TRACKING_NO))->result_array();
          
          $dataMemo['memo_status']="READ";
          $this->db->where('id', $memo_id);
          $this->db->update('erp_memo_act', $dataMemo);
            
        $page_data['page_name']  = 'display_all_memo';
        $data['memo_id']  =$memo_id;
        $page_data['page_title'] = get_phrase('all memo detail');

        $this->load->view('backend/index', $page_data);
               
                
                
            }
            if($memo_option=='REPLY_MEMO_DETAILS'){
                
         $page_data['reply_memo_detail'] = $this->db->get_where('erp_memo_act',array('memo_tracking_id'=>$MEMO_TRACKING_NO))->result_array();
          
          $dataMemo['memo_status']="REPLY";
          $this->db->where('id', $memo_id);
          $this->db->update('erp_memo_act', $dataMemo);
         $data['memo_id']=$memo_id;
        $page_data['page_name']  = 'display_reply_memo_page';

        $page_data['page_title'] = get_phrase('reply memo');

        $this->load->view('backend/index', $page_data);
                
            }
            
            if($memo_option=='PROCESS_REPLY_MEMO'){
                
            $send_memo_sid=$this->input->post('sid');
            $dept_id=$this->input->post('dept_code');
          
            $staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$send_memo_sid))->row();
                                       
           
            $data['memo_title']          = 'RE:'.$this->input->post('memo_title');
            $data['memo_initiator_sid']        = $this->session->userdata('sid');
            $data['initiator_dept_id']            = $this->session->userdata('dept_id');
            $data['initiator_unit_sch_id']           = $this->session->userdata('unit_sch_id');
            $data['initiator_desig_id']        = $this->session->userdata('desig_id');

            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $dept_id;
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $this->input->post('desig_id');
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $data['memo_tracking_id']        = $this->input->post('memo_track_id');
            $data['memo_timestamp']        = date("Y-m-d H:i:s");
            $data['memo_status']        = "REPLIED";
            $data['upload_doc_path']        = "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"];
			
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$dept_id))->row()->deptName;
			$memo_comment = $this->input->post('memo_comment');
            $previous_minutes= $this->input->post('memo_minutes');
			
			$data['memo_minutes'] =$previous_minutes.strtoupper($this->session->userdata('name'))."($designation - $dept_name): $memo_comment <br/>";
            $this->db->insert('erp_memo_act',$data);
  
        //$attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"]);

        
         $this->session->set_flashdata('message' , get_phrase('memo_sent_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/send_all_memo');	
            }
            
      if($memo_option=="FORWARD_MEMO_DETAILS"){
       
          $page_data['forward_memo_detail'] = $this->db->get_where('erp_memo_act',array('memo_tracking_id'=>$MEMO_TRACKING_NO))->result_array();
          
          $dataMemo['memo_status']="FORWARD";
          $this->db->where('id', $memo_id);
          $this->db->update('erp_memo_act', $dataMemo);
         $data['memo_id']=$memo_id;
        $page_data['page_name']  = 'display_forward_memo_page';

        $page_data['page_title'] = get_phrase('forward memo');

        $this->load->view('backend/index', $page_data); 
        
        }     
        if($memo_option=="PROCESS_FORWARD_MEMO"){
            
              $send_memo_sid=$this->input->post('sid');
            
          
            $staff_details  = $this->db->get_where('sadmin', array('sadmin_id' =>$send_memo_sid))->row();
            $dept_id  =  $dept_code=$this->input->post('depts');                              
           
              //$dept_code=$this->input->post('depts');                             
           
            $data['memo_title']          = 'FORWARD: '.$this->input->post('memo_title');
            $data['memo_initiator_sid']        = $this->session->userdata('sid');
            $data['initiator_dept_id']            = $this->session->userdata('dept_id');
            $data['initiator_unit_sch_id']           = $this->session->userdata('unit_sch_id');
            $data['initiator_desig_id']        = $this->session->userdata('desig_id');
            //
            $desig_id=$this->session->userdata('desig_id');

            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $dept_id;
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $staff_details->desig_id;
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $data['memo_tracking_id']        = $this->input->post('memo_track_id');
            $data['memo_timestamp']        = date("Y-m-d H:i:s");
            $data['memo_status']        = $this->input->post('status');
            $data['upload_doc_path']        = "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"];
            
			$previous_minutes= $this->input->post('memo_minutes');
			$dept_senderid=$this->session->userdata('dept_id');
			$designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$desig_id))->row()->designation_name;
			$dept_name=$this->db->get_where('department',array('deptID'=>$dept_senderid))->row()->deptName;
			$memo_comment = $this->input->post('memo_comment');
            
			$data['memo_minutes'] =$previous_minutes. strtoupper($this->session->userdata('name'))."($designation - $dept_name): $memo_comment <br/>";
		
            $this->db->insert('erp_memo_act',$data);
  
        //$attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"]);

        
         $this->session->set_flashdata('message' , get_phrase('memo_sent_successfuly'));
        
        redirect(base_url() . 'index.php?sadmin/send_all_memo');
        
            
        }
        if($memo_option=="VIEW_DRAFT_MEMO"){
            
            $page_data['page_name']  = 'all_draft_memos';

            $page_data['page_title'] = get_phrase('all draft memo');
       
            $this->load->view('backend/index', $page_data);
                             
        }
        
          if($memo_option=='EDIT_DRAFT_MEMO'){
               
        $page_data['edit_trash_memo_detail'] = $this->db->get_where('erp_memo_act',array('id'=>$memo_id))->result_array();

        $page_data['page_name']  = 'display_trash_memo_edit_page';

        $page_data['page_title'] = get_phrase('edit pending memo');

        $this->load->view('backend/index', $page_data);
               
                
            }
            if($memo_option=="PROCESS_EDIT_TRASH_MEMO"){
                $id      = $this->input->post('id');
            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $this->input->post('dept_code');
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $this->input->post('desig_id');
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $data['memo_status']        = "PENDING";
            if($_FILES["file_name"]["name"]!=""){
            $data['upload_doc_path']        = "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"];
        
            $this->db->insert('erp_memo_act',$data);
  
        //$attachment_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/memos/" . $staff_details->payroll_no. $_FILES["file_name"]["name"]);

            }
           $this->session->set_flashdata('message' , get_phrase('memo_sent_successfuly'));
        
            $this->db->where('id', $id);
            $this->db->update('erp_memo_act', $data);
            
            redirect(base_url() . 'index.php?sadmin/send_all_memo');
                
            }
            if($memo_option=='PROCESS_EDIT_SENT_MEMO'){
            
            $id      = $this->input->post('id');
            $data['send_to_sid']        = $this->input->post('sid');
            $data['send_to_dept_id']            = $this->input->post('dept_code');
            $data['send_to_sch_unit_id']           = $this->input->post('factId');
            $data['send_to_desig_id']        =  $this->input->post('desig_id');
            $data['memo_corresponding_comment']        = $this->input->post('memo_comment');
            $data['memo_date']        = $this->input->post('send_date');
            $this->db->where('id', $id);
            $this->db->update('erp_memo_act', $data);
            
            redirect(base_url() . 'index.php?sadmin/send_all_memo');
            
            }
         if($memo_option=="VIEW_ALL_MEMO_OPTION"){
            
            $page_data['page_name']  = 'view_all_memos_option';

            $page_data['page_title'] = get_phrase('all draft memo');
       
            $this->load->view('backend/index', $page_data); 
            
         }
       if($memo_option=="PROCESS_VIEW_ALL_MEMO"){

          $begin_date         = $this->input->post('begin_date');
          $end_date           = $this->input->post('end_date');
          $memo_type          =  $this->input->post('memo_option');
     
        if($memo_type=="ALL_REVEIVED_MEMO"){
           
          
          //  $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM erp_memo_act  where send_to_desig_id='$desig_id' AND send_to_dept_id='$dept_id' AND memo_status='READ' AND memo_date BETWEEN '$begin_date' AND '$end_date' ")->result_array();  
            $page_data['all_memo_detail']= $this->db->query("SELECT *  FROM erp_memo_act WHERE (memo_date BETWEEN  '$begin_date' AND '$end_date') AND memo_status='READ' and send_to_dept_id='$dept_id' AND send_to_desig_id='$desig_id'")->result_array(); 
            $page_data['page_name']  = 'view_all_memos_received_display_page';
        
            $page_data['page_title'] = get_phrase('all memo received');
       
            $this->load->view('backend/index', $page_data); 
        }     
       
        if($memo_type=="ALL_DRAFT_MEMO" || $navigation_options=="ALL_DRAFT_MEMO" ){
          
            //$page_data['all_memo_detail'] = $this->db->query("SELECT * erp_memo_act WHERE memo_status='DRAFT' AND initiator_dept_id='$dept_id' AND initiator_desig_id='$desig_id' AND memo_date BETWEEN '$begin_date' AND '$end_date' ")->result_array();   
            $page_data['all_memo_detail']= $this->db->query("SELECT *  FROM erp_memo_act WHERE (memo_date BETWEEN  '$begin_date' AND '$end_date') AND memo_status='DRAFT' and initiator_dept_id='$dept_id' AND initiator_desig_id='$desig_id'")->result_array();
            $page_data['page_name']  = 'view_all_memos_draft_display_page';
            $page_data['page_title'] = get_phrase('all memo draft');
       
            $this->load->view('backend/index', $page_data); 
        }
        if($memo_type=="ALL_MEMO"){
 
            $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM erp_memo_act where (initiator_dept_id = '$dept_id' AND initiator_desig_id='$desig_id'  ) OR (send_to_desig_id = '$desig_id' AND send_to_dept_id='$dept_id') AND (memo_date BETWEEN '$begin_date' AND '$end_date')")->result_array();    
            $page_data['page_name']  = 'view_all_memos_display_page';
        
            $page_data['page_title'] = get_phrase('all memo sent');
       
            $this->load->view('backend/index', $page_data); 
        }
        if($memo_type=="ALL_SENT_MEMO"){
          
            //  $page_data['all_memo_detail']= $this->db->query("SELECT *  FROM erp_memo_act WHERE (memo_date BETWEEN  '$begin_date' AND '$end_date') AND memo_status='DRAFT' and initiator_dept_id='$dept_id' AND initiator_desig_id='$desig_id'")->result_array();
            $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM erp_memo_act where (memo_date BETWEEN  '$begin_date' AND '$end_date') AND initiator_dept_id = '$dept_id' AND initiator_desig_id='$desig_id'  AND memo_status = 'READ' OR memo_status='PENDING'" )->result_array();     
            
            $page_data['page_name']  = 'view_all_memos_sent_display_page';
        
            $page_data['page_title'] = get_phrase('all memo sent');
       
            $this->load->view('backend/index', $page_data);     
       
        }
        
         if($memo_type=="ALL_REPLY_MEMO"){
         
         
           // $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM epr_memo_act where initiator_dept_id = '$dept_id' AND initiator_desig_id='$desig_id' AND memo_status ='REPLY'  AND memo_date BETWEEN ('$begin_date' AND '$end_date')")->result_array();     
             $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM erp_memo_act where (memo_date BETWEEN  '$begin_date' AND '$end_date') AND send_to_dept_id = '$dept_id' AND send_to_desig_id='$desig_id'  AND memo_status = 'REPLY'" )->result_array();     
            $page_data['page_name']  = 'view_all_memos_reply_display_page';
        
            $page_data['page_title'] = get_phrase('all replied sent');
       
            $this->load->view('backend/index', $page_data);     
       
        }
        
         if($memo_type=="ALL_FORWARD_MEMO"){
                     
            $page_data['all_memo_detail'] = $this->db->query("SELECT * FROM erp_memo_act where (memo_date BETWEEN '$begin_date' AND '$end_date') AND send_to_dept_id = '$dept_id' AND send_to_desig_id='$desig_id'  AND memo_status = 'FORWARD' ")->result_array();     
            $page_data['page_name']  = 'display_forward_memo_page';
        
            $page_data['page_title'] = get_phrase('all memo sent');
       
            $this->load->view('backend/index', $page_data);     
       
        }
        
       
       }
       
       
       
    }


 function send_all_memo()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url() . 'index.php?login', 'refresh');
            
           
            $page_data['page_name']  = 'all_sent_memos';

            $page_data['page_title'] = get_phrase('all sent memo');
       
            $this->load->view('backend/index', $page_data);
       
            
    }    
    
    
	
	 function add_mda_form(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		$page_data['page_name']  = 'add_mda_form';

		$page_data['page_title'] = get_phrase('add mda');
   
		$this->load->view('backend/index', $page_data);
	}
	function add_mda(){
		if($_POST){
			$data = array(
			'faculty_name'=>$_POST['mda'],
			'faculty_code'=>$_POST['code'],
			'email'=>$_POST['email'],
			
			);
			if($this->db->insert('faculty',$data)){
			$this->session->set_flashdata('success', 'MDA added successfully');
			$page_data['page_name']  = 'add_mda_form';

			$page_data['page_title'] = get_phrase('add mda form');
			
	   
			$this->load->view('backend/index', $page_data);
			}
			else{
				return "false";
			}

			
		}

	}

	function add_dept_form(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'add_dept_form';

		$page_data['page_title'] = get_phrase('add department');
   		$page_data['ministries'] = $this->db->get('faculty')->result_array();
		$this->load->view('backend/index', $page_data);
	}

	function add_dept(){
		if($_POST){
			$data = array(
			'deptname'=>$_POST['dept'],
			'dept_code'=>$_POST['code'],
			'schoolid'=>$_POST['ministry_id'],
			
			);
			if($this->db->insert('department',$data)){
			$this->session->set_flashdata('success', 'Department added successfully');
			$page_data['page_name']  = 'add_dept_form';

			$page_data['page_title'] = get_phrase('add department');
			
	   
			$this->load->view('backend/index', $page_data);
			}
			else{
				return "false";
			}

			
		}

	}
	
	function add_des_form(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'add_des_form';

		$page_data['page_title'] = get_phrase('add designation');
		$this->load->view('backend/index', $page_data);
	}
	function add_des(){
		if($_POST){
			$data = array(
			'designation_name'=>$_POST['des'],
			
			);
			if($this->db->insert('erp_staff_designations',$data)){
			$this->session->set_flashdata('success', 'Designation added successfully');
			$page_data['page_name']  = 'add_des_form';

			$page_data['page_title'] = get_phrase('add designation');
			
	   
			$this->load->view('backend/index', $page_data);
			}
			else{
				return "false";
			}

			
		}

	}
	function view_dept(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'view_dept';
		$page_data['departments'] = $this->db->query("select* from department a, faculty b where a.schoolid=b.faculty_id")->result_array();
		$page_data['faculties'] = $this->db->get('faculty')->result_array();
		$page_data['page_title'] = get_phrase('view all departments');
		$this->load->view('backend/index', $page_data);
	}

	function d_dept($id){
		$this->db->where('deptID', $id);

		$this->db->delete('department');

		redirect(base_url() . 'index.php?sadmin/view_dept/', 'refresh');
	}
	function u_dept($id){
		$data['deptname']        =  $this->input->post('dept');
		$data['dept_code']        = $this->input->post('dept_code');
		$data['schoolid']        = 	$this->input->post('ministry');
		$this->db->where('deptID', $id);
		$this->db->update('department', $data);

		redirect(base_url() . 'index.php?sadmin/view_dept/', 'refresh');
	}
	function view_mda(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'view_mda';
		$page_data['faculties'] = $this->db->get('faculty')->result_array();
		$page_data['page_title'] = get_phrase('view all MDA');
		$this->load->view('backend/index', $page_data);
	}
	function u_mda($id){
		$data['faculty_name']        =  $this->input->post('name');
		$data['faculty_code']        = $this->input->post('code');
		$data['email']        = 	$this->input->post('email');
		$this->db->where('faculty_id', $id);
		$this->db->update('faculty', $data);

		redirect(base_url() . 'index.php?sadmin/view_mda/', 'refresh');
	}
	function d_mda($id){
		$this->db->where('faculty_id', $id);

		$this->db->delete('faculty');

		redirect(base_url() . 'index.php?sadmin/view_mda/', 'refresh');
	}
	function view_des(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'view_des';
		$page_data['designations'] = $this->db->get('erp_staff_designations')->result_array();
		$page_data['page_title'] = get_phrase('view all Designations');
		$this->load->view('backend/index', $page_data);
	}
	function d_des($id){
		$this->db->where('designation_id', $id);

		$this->db->delete('erp_staff_designations');

		redirect(base_url() . 'index.php?sadmin/view_des/', 'refresh');
	}
	function u_des($id){
		$data['designation_name']        =  $this->input->post('name');
		$this->db->where('designation_id', $id);
		$this->db->update('erp_staff_designations', $data);

		redirect(base_url() . 'index.php?sadmin/view_des/', 'refresh');
	}
	
	
		function add_cadre_form(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'add_cadre_form';

		$page_data['page_title'] = get_phrase('add cadre');
		$this->load->view('backend/index', $page_data);
	}
	function add_cadre(){
		if($_POST){
			$data = array(
			'name'=>$_POST['cadre'],
			
			);
			if($this->db->insert('cadres',$data)){
			$this->session->set_flashdata('success', 'Cadre added successfully');
			$page_data['page_name']  = 'add_cadre_form';

			$page_data['page_title'] = get_phrase('add cadre');
			
	   
			$this->load->view('backend/index', $page_data);
			}
			else{
				return "false";
			}

			
		}

	}
	function view_cadre(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'view_cadre';
		$page_data['cadres'] = $this->db->get('cadres')->result_array();
		$page_data['page_title'] = get_phrase('view all Cadres');
		$this->load->view('backend/index', $page_data);
	}

	function d_cadre($id){
		$this->db->where('ID', $id);

		$this->db->delete('cadres');

		redirect(base_url() . 'index.php?sadmin/view_cadre/', 'refresh');
	}
	function u_cadre($id){
		$data['Name']        =  $this->input->post('cadre');
		$this->db->where('ID', $id);
		$this->db->update('cadres', $data);

		redirect(base_url() . 'index.php?sadmin/view_cadre/', 'refresh');
	}
	
	//END CADRE
    
	
	// REPORT PAGES VIEW/SADMIN FUNCTIONS
	
		function sex_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$s_name = $this->input->post('s_name');
		$page_data['r_b_sex'] = $this->db->get_where('sadmin', array('sex'=>$s_name))->result_array();
		$page_data['page_name']  = 'r_b_sex';
		$page_data['page_title'] = get_phrase('staff matter report ');
		$this->load->view('backend/index', $page_data);
	   }
	}

	function status_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$employment_type = $this->input->post('employment_type');
		$page_data['r_b_status'] = $this->db->get_where('sadmin', array('employment_type'=>$employment_type))->result_array();
		$page_data['page_name']  = 'r_b_status';
		$page_data['page_title'] = get_phrase('staff matter report ');
		$this->load->view('backend/index', $page_data);
	   }
	}

	function r_b_mda(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'r_b_mda';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['faculties'] = $this->db->get('faculty')->result_array();
		$this->load->view('backend/index', $page_data);
	}

	function mda_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$mda_id = $this->input->post('mda_id');
		$page_data['q_r_b_mda'] = $this->db->query('select * from sadmin where unit_sch_id ='.$mda_id)->result_array();
		$page_data['page_name']  = 'r_b_mda';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['faculties'] = $this->db->get('faculty')->result_array();
		$this->load->view('backend/index', $page_data);
	   }
	}
	
	function r_b_e_date(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'r_b_e_date';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['dates'] = $this->db->query('select * from sadmin')->result_array();
		$this->load->view('backend/index', $page_data);
	}
	function e_d_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$s_date = $this->input->post('s_date');
		$page_data['q_r_b_e_date'] = $this->db->get_where('sadmin', array('d_o_f_employment'=>$s_date))->result_array();
		$page_data['page_name']  = 'r_b_e_date';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['dates'] = $this->db->query('select * from sadmin')->result_array();
		$this->load->view('backend/index', $page_data);
	   }
	}

	function r_b_age(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'r_b_age';

		$page_data['page_title'] = get_phrase('staff matter report by age');
		$this->load->view('backend/index', $page_data);
	}

	function age_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$page_data['q_r_b_age'] = $this->db->query("SELECT * from sadmin where dob >= '".$from."' AND dob <='".$to."'")->result_array();
		$page_data['page_name']  = 'r_b_age';

		$page_data['page_title'] = get_phrase('staff matter report by age');
		$this->load->view('backend/index', $page_data);
	   }
	}
	function r_b_lga(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'r_b_lga';
		$page_data['lgas'] = $this->db->query('select * from lga')->result_array();
		$page_data['page_title'] = get_phrase('staff matter report by LGAs');
		$this->load->view('backend/index', $page_data);
	}
	function lga_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$lga_id = $this->input->post('lga_id');
		$page_data['q_r_b_lga'] = $this->db->query("select * from sadmin where lga ='".$lga_id."' ")->result_array();
		$page_data['page_name']  = 'r_b_lga';

		$page_data['page_title'] = get_phrase('staff matter report by LGA');
		$page_data['lgas'] = $this->db->query('select * from lga')->result_array();
		$this->load->view('backend/index', $page_data);
	   }
	}
	
		function report_lga(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'report_lga';

		$page_data['page_title'] = get_phrase('staff report ');
		$this->load->view('backend/index', $page_data);
	}

	function r_b_department(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'r_b_department';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['depts'] = $this->db->get('department')->result_array();
		$this->load->view('backend/index', $page_data);
	}
	function r_b_cadre(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'r_b_cadre';

		$page_data['page_title'] = get_phrase('staff matter report ');
   		$page_data['cadres'] = $this->db->get('cadres')->result_array();
		$this->load->view('backend/index', $page_data);
	}
	function r_b_sex(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'r_b_sex';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$this->load->view('backend/index', $page_data);
	}
	function r_b_status(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'r_b_status';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$this->load->view('backend/index', $page_data);
	}

	function department_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$deptID = $this->input->post('deptID');
		$page_data['q_r_b_deptID'] = $this->db->query('select * from sadmin where dept_id ='.$deptID)->result_array();
		$page_data['page_name']  = 'r_b_department';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['depts'] = $this->db->get('department')->result_array();
		$this->load->view('backend/index', $page_data);
	   }
	}

	function cadre_report(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   if($_POST){
		$c_id = $this->input->post('c_id');
		$page_data['q_r_b_c_id'] = $this->db->query('select * from sadmin where cadre ='.$c_id)->result_array();
		$page_data['page_name']  = 'r_b_cadre';

		$page_data['page_title'] = get_phrase('staff matter report ');
		$page_data['cadres'] = $this->db->get('cadres')->result_array();
		$this->load->view('backend/index', $page_data);
	   }
	}
	
	//STATISTICAL RECORDS
	
	function view_statistical_reports(){
		if ($this->session->userdata('sadmin_login') != 1)

		redirect(base_url() . 'index.php?login', 'refresh');
		
	   
		
		$page_data['page_name']  = 'summary_report';

		$page_data['page_title'] = get_phrase('statistical reports ');
		$this->load->view('backend/index', $page_data);
	}
	
	
	    function messageRefresh($param1 = ''){
        
        $total_unread_message_number = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('sadmin_id');

        $this->db->where('sender', $current_user);
        $this->db->or_where('reciever', $current_user);
        $message_threads = $this->db->get('message_thread')->result_array();

        foreach ($message_threads as $msg => $row) {
            $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
            $total_unread_message_number += $unread_message_number;
        }
        echo $total_unread_message_number; 
    }

    function isNewMsg($param1 = ''){

        $current_user = $this->session->userdata('login_type'). '-' .$this->session->userdata('login_user_id');
        $this->db->select('timestamp');
        $this->db->where('reciever',$current_user);
        $this->db->order_by('timestamp', 'desc');
        $this->db->limit(1);
        $last_message_timestamp = $this->db->get('message')->row()->timestamp;

        if ($last_message_timestamp > $this->session->userdata('login_timestamp'))
        {
            $status = '1';
            $this->session->set_userdata('login_timestamp', $last_message_timestamp);
        }
        else
        {
            $status = '0';
        }
        echo $status;
    }
	
	
	 function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?sadmin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?sadmin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    function ajaxMessageRefresh($thread_code){
        $page_data['current_message_thread_code'] = $thread_code;  // $param2 = message_thread_code
        $this->crud_model->mark_thread_messages_read($thread_code);
        $this->load->view('backend/messageChat', $page_data);
    }
}

