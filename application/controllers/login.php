<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');



/*

 *	@author : Joyonto Roy

 *	30th July, 2014

 *	Creative Item

 *	www.creativeitem.com

 *	http://codecanyon.net/user/joyontaroy

 */

 

 

class Login extends CI_Controller

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

    function access(){
		$this->session->set_userdata('access', 1);
		redirect(base_url() . 'index.php?login', refresh);

	}

	

    //Default function, redirects to logged in user area

    public function index()

    {
    	/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
        

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



		 $this->load->view('backend/login1');

        

    }



    public function register()

    {

		/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
	
		$page_data['page_name']  = 'registerdirect';

        $page_data['page_title'] = get_phrase('');

		$this->load->view('backend/register', $page_data);

    }



    public function regista($param1){

		/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/

    	//set session for manual;

		$this->session->set_userdata('paytype', 'e');



    	if($param1 == 'regular'){
			
			/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/

		 	$page_data['page_name']  = 'register';

	        $page_data['page_title'] = get_phrase('Federal Ploytechnic, Nekede Portal');

			$this->load->view('backend/register', $page_data);

		}

		if($param1 == 'manual'){


			/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/

			//set session for manual;

			$this->session->set_userdata('paytype', 'm');



			$page_data['page_name']  = 'register';

	        $page_data['page_title'] = get_phrase('Alvan Ikoku College of Education');

			$this->load->view('backend/register', $page_data);

		}	

    }

    

	//Ajax login function 
    public function auth_code()

    {
    	/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
      


		 $this->load->view('backend/auth_code');

        

    }
	
	    public function welcome()

    {
    	/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
      


		 $this->load->view('backend/welcome');

        

    }
	
	
	    public function prowelcome()

    {
    	  redirect(base_url()."index.php?login/welcome", 'refresh');
      

        

    }
	function ajax_login()

	{

		$response = array();



		//Recieving post input of email, password from ajax request

		$email 		= $_POST["email"]; //this is actually the reg_no omit the naming convention here

		//$email 		= 'admin@gtco.com'; //this is actually the reg_no omit the naming convention here

		$password 	= $_POST["password"];

		//$email = $this->input->post('email');

		//$password 	= '1234';

		$response['submitted_data'] = $_POST;

        //var_dump($email);

		//Validating login
		//break;

		$login_status = $this->validate_login( $email ,  $password );

		$response['login_status'] = $login_status;

		if ($login_status == 'success') {

			//$response['redirect_url'] = '';

			//if login is successful, redirect to

			  redirect(base_url() . 'index.php?login/auth_code', 'refresh');

		}

		//redirect(base_url() . )

		$_SESSION['err_msg'] = "Invalid Username / Password Combination.";

		$this->load->view('backend/login1');

	}

    

    //Validating login from ajax request

    function validate_login($email	=	'' , $password	 =  '')

    {
		session_start();
		
		 $credential	=	array(	'reg_no' => $email , 'password' => $password );
		 $credential1	=	array(	'email' => $email , 'password' => $password );
		 $credential2	=	array(	'portal_id' => $email , 'password' => $password );

		 

		 

		 // Checking login credential for admin

        $query = $this->db->get_where('admin' , $credential);

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('admin_login', '1');

			  $this->session->set_userdata('admin_id', $row->admin_id);

			  //$this->session->set_userdata('name', $row->name);

			  $this->session->set_userdata('name', 'GtcoAdmin');

			  $this->session->set_userdata('login_type', 'admin');

			  return 'success';

		}

		 

		 // Checking login credential for teacher

        $query = $this->db->get_where('teacher' , $credential1);

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('teacher_login', '1');

			  $this->session->set_userdata('teacher_id', $row->teacher_id);

			  $this->session->set_userdata('name', $row->name);

			  $this->session->set_userdata('login_type', 'teacher');

			  return 'success';

		}

		 

		 // Checking login credential for student

       $query = $this->db->get_where('student' , $credential2);
		$query2 = $this->db->get_where('student' , $credential1);

        if ($query->num_rows() > 0 || $query2->num_rows() > 0) {
            if($query->num_rows() > 0){
            $row = $query->row();
			}
			if($query2->num_rows() > 0){
            $row = $query2->row();
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

			  return 'success';

		}


        // Checking login credential for sub admin

        $query = $this->db->get_where('sadmin' , $credential);

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('sadmin_login', '1');

			  $this->session->set_userdata('sadmin_id', $row->sadmin_id);

			  $this->session->set_userdata('name', $row->name);

			  $this->session->set_userdata('level', $row->level);

			  $this->session->set_userdata('last_login', $row->last_login);

			  $this->session->set_userdata('ip_address', $row->ip_address);
              $this->session->set_userdata('sid', $row->sadmin_id);
              $this->session->set_userdata('dept_id', $row->dept_id);
              $this->session->set_userdata('unit_sch_id', $row->unit_sch_id);
              $this->session->set_userdata('desig_id', $row->desig_id);
                
			  $this->session->set_userdata('login_type', 'sadmin');

			  $data['ip_address'] = $this->input->ip_address();//retreive ip address
			  $data['last_login'] = date('Y-m-d H:i:s');//retrieve date

			  $this->db->where('sadmin_id', $row->sadmin_id);//get where
			  $this->db->update('sadmin',$data);//perform update

			  return 'success';

		}



		 /* Checking login credential for parent

        $query = $this->db->get_where('parent' , $credential);

        if ($query->num_rows() > 0) {

            $row = $query->row();

			  $this->session->set_userdata('parent_login', '1');

			  $this->session->set_userdata('parent_id', $row->parent_id);

			  $this->session->set_userdata('name', $row->name);

			  $this->session->set_userdata('login_type', 'parent');

			  return 'success';

		}*/

		

		return 'invalid';

    }

    

    /***DEFAULT NOR FOUND PAGE*****/

    function four_zero_four()

    {

        $this->load->view('four_zero_four');

    }

    



	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/

	function reset_password()

	{

		$account_type = $this->input->post('account_type');

		if ($account_type == "") {

			redirect(base_url(), 'refresh');

		}

		$email  = $this->input->post('email');

		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL

		if ($result == true) {

			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));

		} else if ($result == false) {

			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));

		}

		

		redirect(base_url(), 'refresh');		

	}

    /*******LOGOUT FUNCTION *******/

    function logout()

    {

        $this->session->unset_userdata();

        $this->session->sess_destroy();

        $this->session->set_flashdata('logout_notification', 'logged_out');

        redirect(base_url() , 'refresh');

    }

    

}

