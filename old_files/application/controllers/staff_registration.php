<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_Registration extends CI_Controller{
	
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        //$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function index(){
		//redirect(base_url()); 
		session_start();
		
    
        $page_data['page_name']  = 'pre_registration_staff';
        $page_data['page_title'] =  'EBSU | Start Staff Registration';
        $this->load->view('backend/registration/index', $page_data);
    }
	
    function pre_registration(){
		//redirect(base_url()); 
		session_start();
		
    
        $page_data['page_name']  = 'pre_registration_staff';
        $page_data['page_title'] =  'EBSU | Start Staff Registration';
        $this->load->view('backend/registration/index', $page_data);
    }
	 public function getLGA(){
        session_start();
	
        $state = $_POST['state'];

        $lga = $this->db->get_where('lga', array("state_id" => $state))->result_array();
        echo "<option value=''>Select An Option</option>";
        foreach($lga as $l => $val){
            echo "<option value='" . $val['name'] . "'>" . $val['name'] . "</option>";
        }
    }
	function getStaffDepartments($param1){
		
		$programme = $param1;
		
		
			
			$prog = $this->db->get('department_staff')->result_array();
			
			echo "<option value=''>Select An Option</option>";
			foreach($prog as $p => $val){
				echo "<option value='" . $val['deptName'] . "'>" . $val['deptName'] . "</option>";
			}
		
		
	}
	function setStudentSession(){
		session_start();
		
		
		$desig = $this->input->post('programme');
		$portalID = $this->input->post('regno');
		
		$check=$this->db->get_where('eduportal_staff_record' , array('regno' => $portalID))->row();
		if($check)
		{
			$_SESSION['reg'] = $portalID;
		}
		else{
			$_SESSION['serror']="Invalid Staff ID/File No!";
			redirect(base_url() . 'index.php?staff_registration/pre_registration', 'refresh');
		}
		if($desig == 'JUNIOR'){
			$_SESSION['desig'] = 'JUNIOR';
		}elseif($desig == 'SENIOR'){
			$_SESSION['desig'] = 'SENIOR';
		}
		
		
		redirect(base_url() . 'index.php?staff_registration/page1');
	}
    
	function page1(){
		//redirect(base_url());
        session_start();
		
		
		if(!isset($_SESSION['reg'])){
			redirect(base_url() . 'index.php?registration/logout', 'refresh');
		}
		
		if($_SESSION['desig'] == 'JUNIOR'){
			//redirect to the new page1
			redirect(base_url() . 'index.php?staff_registration/JuniorStaffData');
		}
		if($_SESSION['desig'] == 'SENIOR'){
			//redirect to the new page1
			redirect(base_url() . 'index.php?staff_registration/SeniorStaffData');
		}
		
    }
	
	function JuniorStaffData(){
		session_start();
		
	
		if(!isset($_SESSION['desig']) && $_SESSION['desig'] != 'JUNIOR'){
			redirect(base_url() . 'index.php?registration/logout', 'refresh');
		}
		$page_data["staff_info"]= $this->db->get_where('eduportal_staff_record' , array('regno' => $_SESSION['reg']))->row();
		//$page_data['dept'] = $this->crud_model->getNceDept();
		$page_data['page_name']  = 'JuniorStaffData';
		$page_data['page_title'] =  'EBSU | Junior Staff Info';
        $this->load->view('backend/registration/index', $page_data);
		
	}
	
	function SeniorStaffData(){
		session_start();
		
	
		if(!isset($_SESSION['desig']) && $_SESSION['desig'] != 'SENIOR'){
			redirect(base_url() . 'index.php?registration/logout', 'refresh');
		}
		$page_data["staff_info"]= $this->db->get_where('eduportal_staff_record' , array('regno' => $_SESSION['reg']))->row();
	//	$page_data['dept'] = $this->crud_model->getNceDept();
		$page_data['page_name']  = 'SeniorStaffData';
		$page_data['page_title'] = 'EBSU | Senior Staff Info';
        $this->load->view('backend/registration/index', $page_data);
		
	}
	
	function insertStaffInformation($nationality){
		session_start();
		

		if(!isset($_SESSION['desig'])){
			redirect(base_url() . 'index.php?registration/logout', 'refresh');
		}
		
		if($nationality == 'nigerian'){
			//get the student details from form
			
			//Personal Details
			$data['tittle'] = $this->input->post('title');
			$data['firstname'] = $this->input->post('firstname');
			$data['middlename'] = $this->input->post('middlename');
			$data['surname'] = $this->input->post('surname');
			$data['sex'] = $this->input->post('sex');
			$data['phone'] = $this->input->post('phone');
			$data['birthday'] = $this->input->post('dob');
			$data['file_number'] = $this->input->post('fileno');
			$data['state'] = $this->crud_model->getStateById($this->input->post('state'));
			$data['lga'] = $this->input->post('lga');
			$data['nationality'] = 'Nigerian';
			$data['date_first_employment'] = $this->input->post('date_first_employment');
			$data['rank_on_appointment'] = $this->input->post('rank_on_appointment');
			$data['present_rank'] = $this->input->post('present_rank_date');
			$data['present_rank_date'] = $this->input->post('present_rank_date');
			$data['salary_grade'] = $this->input->post('salary_grade');
			$data['salary_step'] = $this->input->post('salary_step');
			
			$data['qualifications'] = $this->input->post('entry_qualification');
			$data['entry_qualification'] = $this->input->post('entry_qualification');
			$data['staff_dept'] = addslashes($this->input->post('staff_school'));
			$data['staff_school'] = addslashes($this->input->post('staff_dept'));
			
			//$data['publications'] = $this->input->post('regno');
			$data['staff_type'] = $_SESSION['desig'];
			
			//academic details
			//get the department and get the school
			
		//	$data['programme'] = $_SESSION['desig'];
		//	$data['comp_number'] = $this->input->post('prog_type');
			$data['staff_category'] = $_SESSION['desig'];
			
			$data['date_reg'] = date('jS F Y h:i:s') . ' GMT';
			
			//run photo upload
			$imgsize = $_FILES['passport']['size'];
			
			
			//verify image size
			if($this->crud_model->verifyImageSize($imgsize, '104200')){
				//run image upload
				$imgname = Date('Y') . '_REG_' . md5(mt_rand('100000', '999999'))  . '_' . md5(mt_rand('100000', '999999'));

				move_uploaded_file($_FILES['passport']['tmp_name'], 'staff/uploads/staff_image/' . $imgname . '.jpg');
				$this->crud_model->clear_cache();
				
				$data['photo'] = $imgname;
				
								
				
			}else{
				//return image error;
				$_SESSION['error'] = 'Passport image size is too large. Please upload an image less than 100KB';
				redirect(base_url() . 'index.php?staff_registration/page1');
			}
			
			//run photo upload
			$imgsize = $_FILES['usersign']['size'];
			
			
			//verify image size
			if($this->crud_model->verifyImageSize($imgsize, '104200')){
				//run image upload
				$imgname = Date('Y') . '_REG_' . md5(mt_rand('100000', '999999'))  . '_' . md5(mt_rand('100000', '999999'));

				move_uploaded_file($_FILES['usersign']['tmp_name'], 'staff/uploads/staff_signature/' . $imgname . '.jpg');
				$this->crud_model->clear_cache();
				
				$data['signature'] = $imgname;
				
				//set up portal id
				//get the last portal id from the database
				
					
				
				
			}else{
				//return image error;
				$_SESSION['error'] = 'Signature image size is too large. Please upload an image less than 50KB';
				redirect(base_url() . 'index.php?staff_registration/page1');
			}
			
			  
				
				$portal='EBSU'.time();
				$data['portal_id'] = $portal;
					$data['comp_number'] = $portal;
					$this->db->insert('staff', $data);
					unset($_SESSION["JAMBNO"]);
					redirect(base_url() . 'index.php?staff_registration/registration_printout/' . $portal);
		}
		
		if($nationality == 'foreign'){
			//get the student details from form
			
			//Personal Details
			$data['tittle'] = $this->input->post('title');
			$data['firstname'] = $this->input->post('firstname');
			$data['middlename'] = $this->input->post('middlename');
			$data['surname'] = $this->input->post('surname');
			$data['sex'] = $this->input->post('sex');
			$data['phone'] = $this->input->post('phone');
			$data['birthday'] = $this->input->post('dob');
			$data['file_number'] = $this->input->post('fileno');
			$data['nationality'] = $this->input->post('country');
			$data['date_first_employment'] = $this->input->post('date_first_employment');
			$data['rank_on_appointment'] = $this->input->post('rank_on_appointment');
			$data['present_rank'] = $this->input->post('present_rank_date');
			$data['present_rank_date'] = $this->input->post('present_rank_date');
			$data['salary_grade'] = $this->input->post('salary_grade');
			$data['salary_step'] = $this->input->post('salary_step');
			
			$data['qualifications'] = $this->input->post('entry_qualification');
			$data['entry_qualification'] = $this->input->post('entry_qualification'); 
			$data['staff_dept'] = addcslashes($this->input->post('staff_school'));
			$data['staff_school'] = addcslashes($this->input->post('staff_dept'));
			
			//$data['publications'] = $this->input->post('regno');
			$data['staff_type'] = $_SESSION['desig'];
			
			//academic details
			//get the department and get the school
			
			//$data['programme'] = $_SESSION['desig'];
			//$data['comp_number'] = $this->input->post('prog_type');
			$data['staff_category'] = $_SESSION['desig'];
			
			//$data['date_reg'] = date('jS F Y h:i:s');
			
			//run photo upload
			$imgsize = $_FILES['passport']['size'];
			
			
			//verify image size
			if($this->crud_model->verifyImageSize($imgsize, '104200')){
				//run image upload
				$imgname = Date('Y') . '_REG_' . md5(mt_rand('100000', '999999'))  . '_' . md5(mt_rand('100000', '999999'));

				move_uploaded_file($_FILES['passport']['tmp_name'], 'staff/uploads/staff_image/' . $imgname . '.jpg');
				$this->crud_model->clear_cache();
				
				$data['photo'] = $imgname;
				
								
				
			}else{
				//return image error;
				$_SESSION['error'] = 'Passport image size is too large. Please upload an image less than 100KB';
				redirect(base_url() . 'index.php?staff_registration/page1');
			}
			
			//run photo upload
			$imgsize = $_FILES['usersign']['size'];
			
			
			//verify image size
			if($this->crud_model->verifyImageSize($imgsize, '104200')){
				//run image upload
				$imgname = Date('Y') . '_REG_' . md5(mt_rand('100000', '999999'))  . '_' . md5(mt_rand('100000', '999999'));

				move_uploaded_file($_FILES['passport']['tmp_name'], 'staff/uploads/staff_signature/' . $imgname . '.jpg');
				$this->crud_model->clear_cache();
				
				$data['signature'] = $imgname;
				
				//set up portal id
				//get the last portal id from the database
				
					
				
				
			}else{
				//return image error;
				$_SESSION['error'] = 'Signature image size is too large. Please upload an image less than 50KB';
				redirect(base_url() . 'index.php?staff_registration/page1');
			}
			
			   $portal='EBSU'.time();
				
				
				
				
					$data['comp_number'] = $portal;
					$data['portal_id'] = $portal;
					$this->db->insert('staff', $data);
					unset($_SESSION["JAMBNO"]);
					redirect(base_url() . 'index.php?staff_registration/registration_printout/' . $portal);
		}
	}
	
	
	function registration_printout($portalID){
		session_start();
		
		
		if(!isset($_SESSION['desig'])){
			redirect(base_url() . 'index.php?registration/logout', 'refresh');
		}
		
		$page_data['staff'] = $this->db->get_where('staff' , array('portal_id' => $portalID))->row();
		$page_data['page_name']  = 'staff_registration_printout';
		$page_data['page_title'] = $this->crud_model->getSystemTitle() . ' | Staff Registration Printout';
        $this->load->view('backend/registration/printout', $page_data);
	}
	
	
	
	 function logoutRegistration(){
        session_start();
        redirect(base_url() . 'index.php?registration');
    }
	function qr_printout($portalid){
		session_start();
		
		
        $page_data['student'] = $this->crud_model->getStudentByPortalID($portalid);
		$page_data['page_name']  = 'registration_printout';
		$page_data['page_title'] = $this->crud_model->getSystemTitle() . ' | Registration Printout';
        $this->load->view('backend/registration/printout', $page_data);
    } 
	function qr_check($staffid){
		session_start();
		
		//check for regno availability
		$registeredReg = $this->db->get_where('staff', array('staff_id' => $staffid))->row();
		
		if($registeredReg){
			$_SESSION['desig'] = $registeredReg->staff_category;
			redirect(base_url() . 'index.php?staff_registration/registration_printout/' . $registeredReg->portal_id);
		}else{
			echo 'Sorry No record was found for the provided ID, ' . $portalid;
		}
	}
	
	function reprintSlip(){
		session_start();
		$no=$this->input->post('file_no');
		//check for regno availability
		$registeredReg = $this->db->get_where('staff', array('portal_id' => $no))->row();
		
		if($registeredReg){
			$_SESSION['desig'] = $registeredReg->staff_category;
			redirect(base_url() . 'index.php?staff_registration/registration_printout/' . $no);
		}else{
			echo 'No record was found for the provided PORTAL ID, ' . $portalid;
		}
	}
}