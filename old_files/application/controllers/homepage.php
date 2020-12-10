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

 

 

class Homepage extends CI_Controller

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
		//$page_data['page_name']  = 'homepage';

        $page_data['page_title'] = get_phrase('FPN Portal');

		$this->load->view('backend/homepage', $page_data);

        

    }



    

}

