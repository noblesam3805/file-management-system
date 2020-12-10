<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');


class Registration extends CI_Controller{

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
    public function index(){
		session_start();//
		$_SESSION['userid'] = '1';//
			$_SESSION['registration_login'] = 1;//
		$this->session->set_userdata('registration_login', '1');//
        if ($this->session->userdata('registration_login') == 1)
		
            redirect(base_url() . 'index.php?staff_registration/pre_registration', 'refresh');
		
		
    }
	
	  public function staff(){
		session_start();//
		$_SESSION['userid'] = '1';//
			$_SESSION['registration_login'] = 1;//
		$this->session->set_userdata('registration_login', '1');//
       // if ($this->session->userdata('registration_login') == 1)
		
            redirect(base_url() . 'index.php?staff_registration/pre_registration', 'refresh');
		
		    }



	//login function 

	function login(){
		session_start();

		$response = array();

		//Recieving post input of email, password from ajax request

		$email 		= $_POST["username"];
		$password 	= $_POST["password"];

		$response['submitted_data'] = $_POST;

		//Validating login

		$login_status = $this->validate_login( $email ,  $password );

		$response['login_status'] = $login_status;

		if ($login_status == 'success') {
			redirect(base_url() . 'index.php?registration');

		}

		//redirect(base_url() . )

		$_SESSION['err_msg'] = "Invalid Username / Password Combination.";
		
		$page_data['page_title'] = $this->crud_model->getSystemTitle() . ' | Student Registration';
		$page_data['system_name'] = $this->crud_model->getSystemTitle();
		$page_data['app_type'] = 'Student Registration';
		$this->load->view('backend/registration/login1', $page_data);

	}

    

    //Validating login from ajax request

    function validate_login($email	=	'' , $password	 =  ''){
		session_start();
		
		$credential	=	array(	'username' => $email , 'password' => $password );

		 // Checking login credential for admin

        $query = $this->db->get_where('eduportal_registration_users' , $credential);

        if ($query->num_rows() > 0) {

            $row = $query->row();

			$this->session->set_userdata('registration_login', '1');
			$_SESSION['userid'] = $row->user_id;
			$_SESSION['registration_login'] = 1;
			return 'success';

		}
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

        redirect(base_url() . 'index.php?login' , 'refresh');

    }

    

}

