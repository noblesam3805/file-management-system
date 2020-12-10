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

 

 

class Mobileloginservice extends CI_Controller

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
    	
	}
    public function login()

    {
    	/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
      

    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $username = $request->username;
		if ($username == "") {
            echo "Please Enter your Username: " . $username;
        }
		$password = $request->password;
		if ($password != "") {
         //   echo "Please Enter your Password: " . $password;
        }
		
		$status = $this->db->query("select* from student where portal_id='$username' and password='$password'")->row();
       //echo $status;
		if($status)
		{
			echo  $status->student_id;
		}
		else{
			echo 0;
		}
    }
    else {
        echo "Error! Something went wrong.";
    }
       


		

        

    }
	
	
	public function adminlogin()

    {
    	/*if ($this->session->userdata('access') != 1)//this is done so as to disable anyone from having accommodation
            redirect(base_url(), 'refresh');*/
      

    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $username = $request->username;
		if ($username == "") {
            echo "Please Enter your Username: " . $username;
        }
		$password = $request->password;
		if ($password != "") {
         //   echo "Please Enter your Password: " . $password;
        }
		
		$status = $this->db->query("select* from sadmin where email='$username' and password='$password'")->row();
       //echo $status;
		if($status)
		{
			echo  $status->sadmin_id;
		}
		else{
			echo 0;
		}
    }
    else {
        echo "Error! Something went wrong.";
    }
       


		

        

    }

	function getAdminProfile($id)
{
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 header('Content-type: text/json'); 
 $data["userProfile"] = $this->db->query("select* from sadmin where sadmin_id='$id'")->result_array();

 $response = json_encode($data);
 print_r($response);



}


	public function checkHNDScreeningRes()

    {
  include('application/config/kee.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $username = $request->username;
		if ($username == "") {
            echo "Please Enter your Application no: " ;
        }
		
		
		$status = mysql_query("select count(*) from putme_scores where application_no='$username'");
		$result = mysql_result($status,0);
       //echo $status;
	   
		if($result>0)
		{
			$status2 = mysql_query("select putme_scores_id from putme_scores where application_no='$username'");
	   while($row= mysql_fetch_array($status2))
	   {
			echo  $row["putme_scores_id"];
	   }
		}
		else{
			echo 0;
		}
    }
    else {
        echo "Error! Something went wrong.";
    }
  
    }

	


function getApplicantResultData($id)
{
include('application/config/kee.php');
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 header('Content-type: text/json'); 
	   
$result = mysql_query("SELECT a.`application_no`,a.`screening_no`,b.surname,b.firstname,b.middlename, a.score,a.accum, c.dept_name, d.faculty_name, e.sex,f.credit_point,e.passport_url FROM `putme_scores` a, putme_applicants b, department c, faculty d, hnd_applicants_form e, hnd_applicants_tert_details f where a.`application_no`=b.`application_no` and a.`application_no`=e.`application_no` and a.`dept_id`=c.dept_id and d.faculty_id=b.school and a.application_no=f.applicant_no and a.`putme_scores_id`='$id'") or die(mysql_error());
while($row= mysql_fetch_object($result))
{
	$data["userProfile"] = array($row);
 $response = json_encode($data);
 print_r($response);

}

}

	public function checkHNDScreeningAdm()

    {
   include('application/config/kee.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $username = $request->username;
		if ($username == "") {
            echo "Please Enter your Application no: " ;
        }
		
		
		$status = mysql_query("select count(*) from eduportal_admission_list where application_no='$username'");
		$result = mysql_result($status,0);
       //echo $status;
	   
		if($result>0)
		{
			$status2 = mysql_query("select id from eduportal_admission_list where application_no='$username'");
	   while($row= mysql_fetch_array($status2))
	   {
			echo  $row["id"];
	   }
		}
		else{
			echo 0;
		}
    }
    else {
        echo "Error! Something went wrong.";
    }
  
    }


function getApplicantAdmissionData($id)
{
	mysql_close();
	include('application/config/kee.php');
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 header('Content-type: text/json'); 
	   
$result = mysql_query("sELECT a.`application_no`,a.surname,a.firstname,a.middlename,c.dept_name, d.faculty_name, e.sex,e.passport_url, f.programme_type_name FROM `eduportal_admission_list` a, hnd_applicants_tert_details b, department c, faculty d, hnd_applicants_form e, programme_type f where a.application_no=b.applicant_no and a.`application_no`=e.`application_no` and a.`dept_id`=c.dept_id and d.faculty_id=e.faculty_id and a.programme_type_id=f.`programme_type_id`  and a.`id`='$id'") or die(mysql_error());
while($row= mysql_fetch_object($result))
{
	$data["userProfile"] = array($row);
 $response = json_encode($data);
 print_r($response);

}

}	
	
function getStudentProfile($id)
{
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 header('Content-type: text/json'); 
 $data["userProfile"] = $this->db->query("select* from student a,department b,schools c,student_type d, programme_type e where student_id='$id' and a.dept=b.deptID and a.school=c.id and a.programme=d.student_type_id and a.prog_type=e.programme_type_id")->result_array();

 $response = json_encode($data);
 print_r($response);



}

function changeStudentProfilePhoto()
{
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) 
	{
        $request = json_decode($postdata);
		$student_id = $request->student_id;
        $base64pic = $request->imagedata;
		if ($base64pic == "" || $student_id == "" ) {
            echo 0;
			//exit;
        }
		else
		{
			 $passport_url = "uploads/student_image/".$student_id.".jpg";
			 $content = base64_decode($base64pic); 
//$file = fopen($passport_url,'w'); //echo $content;
file_put_contents($passport_url, $content);
			 echo $student_id;
		}
	}
	else{
		echo "Invalid Request Sent";
	}




}

	//Ajax login function 

	function processlogin()

	{
session_start();
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

			redirect(base_url());

		}

		//redirect(base_url() . )

		$_SESSION['err_msg'] = "Invalid Username / Password Combination.";

		 redirect('http://localhost:8000/EPUNI%20Portal/login.php');

	}

    

    //Validating login from ajax request

    function validate_login($email	=	'' , $password	 =  '')

    {
		
		 $credential	=	array(	'reg_no' => $email , 'password' => $password );
		 $credential1	=	array(	'email' => $email , 'password' => $password );
		 $credential2	=	array(	'portal_id' => $email , 'password' => $password );

		 

		 $status = $this->db->query("select* from students where portal_id='$username' and password='$password'")->row();
echo '1';
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

        if ($query->num_rows() > 0) {

            $row = $query->row();

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

    
function getStudentPaymentDetails()
{
session_start();	
$regno=$_POST["txtRegNumber"];
$semester= $_POST["semester"];
$session= $_POST["session"];

$data = $this->db->query("select* from student a,department b,schools c,student_type d, programme_type e where a.portal_id='$regno' and a.dept=b.deptID and a.school=c.id and a.programme=d.student_type_id and a.prog_type=e.programme_type_id")->row();
if(!$data)
{
	$_SESSION["error"] ="Sorry Your Record was not found in the Database! Please Contact ICT Unit.";
		header("Location: http://localhost:8000/FPN_ExamPhotoCard/index.php");
}
// $response = json_encode($data);
// print_r($response);
$fullname =$surname=$data->name.' '.$surname=$data->othername;
$department =$data->deptName;
$this->session->set_userdata('student_id',$data->student_id);
//echo "regno=$regno&semester=$semester&session=$session&fullname=$fullname&department=$department";
       
  	    $page_data['student_data'] = $data;
		  $page_data['session']  = $session;
		    $page_data['semester']  = $semester;
        $page_data['page_name']  = 'photoAlbum';
        $page_data['page_title'] = get_phrase('Pay Other Fees');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

   $this->load->view('backend/student_print', $page_data);
}


function generateClassPhotoCard()
{
session_start();	
$regno=$_POST["txtRegNumber"];
$semester= $_POST["semester"];
$session= $_POST["session"];

$dept= $_POST["dept"];
$programme= $_POST["programme"];
$level= $_POST["level"];
//$session= $_POST["session"];

$data = $this->db->query("select* from student a,department b,schools c,student_type d, programme_type e where  a.dept=b.deptID and a.school=c.id and a.programme=d.student_type_id and a.prog_type=e.programme_type_id and b.deptID='$dept'");
if(!$data)
{
	$_SESSION["error"] ="Sorry Your Record was not found in the Database! Please Contact ICT Unit.";
		header("Location: http://localhost:8000/FPN_ExamPhotoCard/index.php");
}
// $response = json_encode($data);
// print_r($response);
//$fullname =$surname=$data->name.' '.$surname=$data->othername;
//$department =$data->deptName;
//$this->session->set_userdata('student_id',$data->student_id);
//echo "regno=$regno&semester=$semester&session=$session&fullname=$fullname&department=$department";
       
  	    $page_data['student_data'] = $data;
		$page_data['department'] = $dept;
		$page_data['session']  = $session;
		$page_data['semester']  = $semester;
        $page_data['page_name']  = 'view_students_photocards';
        $page_data['page_title'] = get_phrase('Pay Other Fees');
        $page_data['my_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();

   $this->load->view('backend/student_print', $page_data);
}


function generatePaymentsRecord()
{


$data = $this->db->query("SELECT id,concat(a.surname,', ',a.firstname) as names,b.rrr as rrr,a.amount as amount,b.purpose as purpose,b.date_payment as date_payment  FROM `invoice_gen` a, remita_payments b where a.rrr=b.rrr and a.`invoice_type`='1' order by a.rrr");

// $response = json_encode($data);
// print_r($response);
//$fullname =$surname=$data->name.' '.$surname=$data->othername;
//$department =$data->deptName;
//$this->session->set_userdata('student_id',$data->student_id);
//echo "regno=$regno&semester=$semester&session=$session&fullname=$fullname&department=$department";
       
  	   ?>
	 <table width="95%" border="1" align="center"   style="background-color:#fff;margin-left: 20px;">  
	   <tr>
    <td align="left" valign="top" >S/N</td>
 
    <td align="left" valign="top" >STUDENT NAME</td>
    <td align="left" valign="top" >RRR</td>
    <td align="left" valign="top" >AMOUNT</td>

  
    <td align="left" valign="top" >PURPOSE</td>

  <td align="left" valign="top" >DATE OF PAYMENT</td>
 
 
  </tr>
 <?php 
 $id=1;
 foreach($data->result() as $row2)

	{
		?>

  <tr>
    <td align="left" valign="top"><?php echo $id;?></td>

    <td width="auto" align="left" valign="top"><?php echo $row2->names; ?></td>
    <td align="left" valign="top"><?php echo $row2->name." ".$row2->rrr;?></td>
    <td align="left" valign="top"><?php echo strtoupper($row2->amount) ; ?></td>

      <td align="left" valign="top"><?php echo $row2->purpose ;?> </td>
   
    <td align="left" valign="top"><?php echo $row2->date_payment ;?> </td>
     </tr>
	<?php $id++;}?>
	   </table>
	   <?php
}


function generatePaymentsRecordTEDCMIC()
{


$data = $this->db->query("SELECT concat(b.surname,', ',b.firstname) as names, b.rrr as rrr,b.amount, b.fee_description,a.`payment_date` FROM `eduportal_fees_payment_log` a, invoice_gen b WHERE a.`payment_code`=b.rrr and `payment_fee_type`='3' AND (a.`payment_date` between '2019-01-01' and '2019-01-31') and b.invoice_type='1' and a.`payment_amount`=3000");

// $response = json_encode($data);
// print_r($response);
//$fullname =$surname=$data->name.' '.$surname=$data->othername;
//$department =$data->deptName;
//$this->session->set_userdata('student_id',$data->student_id);
//echo "regno=$regno&semester=$semester&session=$session&fullname=$fullname&department=$department";
       
  	   ?>
	   <script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
	 <table width="95%" border="1" align="center"   style="background-color:#fff;margin-left: 20px;" id="testTable" >  
	   <tr>
    <td align="left" valign="top" >S/N</td>
 
    <td align="left" valign="top" >STUDENT NAME</td>
    <td align="left" valign="top" >RRR</td>
    <td align="left" valign="top" >AMOUNT</td>
 <td align="left" valign="top" >PAYMENT TYPE</td>
  


  <td align="left" valign="top" >DATE OF PAYMENT</td>
 
 
  </tr>
 <?php 
 $id=1;
 foreach($data->result() as $row2)

	{
		?>

  <tr>
    <td align="left" valign="top"><?php echo $id;?></td>

    <td width="auto" align="left" valign="top"><?php echo $row2->names; ?></td>
    <td align="left" valign="top"><?php echo $row2->name." ".$row2->rrr;?></td>
    <td align="left" valign="top"><?php echo strtoupper($row2->amount) ; ?></td>

 <td align="left" valign="top">TEDC PAYMENT</td>
   
    <td align="left" valign="top"><?php echo $row2->payment_date;?> </td>
     </tr>
	<?php $id++;}?>
	
	   </table>
	   <input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
	  
	   <?php
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
	
	
	
	function processRemitaOthersFeeInvoice()
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
             $request = json_decode($postdata);
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo 0 ;
			exit;
		}
		
		$session = $request->session;
		$year = $request->year;
		$paymentType = $request->paymentType;
		$semester = $request->semester;
		
		$department =$request->department;
		$school=$request->school;
		$progtype = $request->progtype;
		$prog = $request->prog;
		$amount=$request->amount;
		
		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();

			
		if($paymentType==5)
		{
		$application_form_category = 15;
		$totalAmount =   $amount;
	
		
		if ($amount<=0)
		{
			echo -1;
			exit;
		}
		
		}
		if($paymentType==6)
		{
		$application_form_category = 16;
		$totalAmount =   $amount;
		if ($amount<=0)
		{
			echo -1;
			exit;
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

		$payerEmail = $studentDetails->email == "" ? 'student@fpno.com' : $studentDetails->email;  

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
   // $page_data['page_title'] = 'FPN HND Registration Payment Invoice';
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
echo $application_exist->application_invoice_id;
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

//$_SESSION['fee_description']=$payment_description;
$this->db->insert('invoice_gen',$invoice_data);	
echo $this->db->get_where('invoice_gen', array("rrr" => trim($response['RRR'])))->row()->application_invoice_id;
			


		}else{

			echo 0;

		}
		}
    else {
        echo 0;
    }
				
				
	}


function processRemitaAcceptanceInvoice(){

		session_start();
//include('application/config/kee.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	
    $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $portalID = $request->portalID;
		
		if ($portalID == "" || $portalID == ' ') {
            echo "Invalid Portal ID: " ;
        }

		

		$portalID = $portalID;
		$session = $request->session;
		$year = $request->year;
		$paymentType = $request->paymentType;
		if($portalID == '' || $portalID == ' ')
		{

		
			echo 0 ;
			exit;
		}
		//echo $portalID ;

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


		


		

		//define("MERCHANTID", $merchantId->value);

		define("MERCHANTID", 532776942);

		//define("SERVICETYPEID", $serviceTypeId->value);

		define("SERVICETYPEID", 533711204);

		//define("APIKEY", $apiKey->value);

		define("APIKEY", 587460);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

		

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		//$totalAmount = $amount->value;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->othername . ' ' . $studentDetails->name; 

		$payerEmail = $studentDetails->email == "" ? 'student@fpno.com' : $studentDetails->email;  

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
		
		

		$beneficiaryName="Gtco Calscan Nig Ltd";
		
		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";
		
	//	$beneficiaryName3="Gtco Calscan Nig Ltd";

		$beneficiaryAccount="2022236317";

		$beneficiaryAccount2="0140468461017";
		
	

		$bankCode="011";

		$bankCode2="000";
		
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

			$alreadyGenerated = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $portalID))->row();

			

			if($alreadyGenerated){

			echo $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $alreadyGenerated->RRR))->row()->rrrid;

			}

			

			$data['putme_id'] = $portalID;

			$data['rrr'] = trim($response['RRR']);

			$data['order_id'] = trim($response['orderID']);

			$data['status'] = 'Payment Pending'; 

			$data['datetime'] = date("Y-m-d H:i:s"); 

			$data['amount'] = $totalAmount;
			$data['session'] = $session;

			

			$this->db->insert('eduportal_remita_accp_temp_data', $data);

			

			echo $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => trim($response['RRR'])))->row()->rrrid;

		}else{

			echo 0;

		}
}
    else {
        echo "Error! Something went wrong.";
    }
	}
    
	function getInvoiceDataAcceptance($invoice_id)
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	

 header('Content-type: text/json'); 
	   
$result = mysql_query("SELECT* FROM `eduportal_remita_accp_temp_data` where rrrid='$invoice_id'") or die(mysql_error());
while($row= mysql_fetch_object($result))
{
	$data["InvoiceDetails"] = array($row);
 $response = json_encode($data);
 print_r($response);

}
	}
	
	function getInvoiceDataOthers($invoice_id)
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	 header('Content-type: text/json'); 
	   
$result = mysql_query("SELECT* FROM `invoice_gen` where application_invoice_id='$invoice_id'") or die(mysql_error());
while($row= mysql_fetch_object($result))
{
	$data["InvoiceDetails"] = array($row);
 $response = json_encode($data);
 print_r($response);

}

	}

	function processRemitaSchoolFeeInvoice()
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $portalID = $request->portalID;
		
		
		
		$session = $request->session;
		$year = $request->year;
		$paymentType = $request->paymentType;
		$semester = $request->semester;
		
		$department =$request->department;
		$school=$request->school;
		$progtype = $request->progtype;
		$prog = $request->prog;
		
		
		if($portalID == '' || $portalID == ' ')
		{

echo 0 ;
			exit;
		}
		
$application_form_category=0;
		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
	if($progtype == "ND MORNING"){

					$pType = "MORNING";
$application_form_category=10;
				}elseif($progtype == "ND EVENING"){

					$pType = "EVENING";
$application_form_category=11;
				}elseif($progtype == "ND WEEKEND"){

					$pType = "WEEKEND";
$application_form_category=12;
				}
				elseif($progtype == "HND MORNING"){

					$pType = "MORNING";
$application_form_category=7;
				}
				elseif($progtype == "HND EVENING"){

					$pType = "EVENING";
$application_form_category=8;
				}elseif($progtype == "HND WEEKEND"){

					$pType = "WEEKEND";
$application_form_category=9;
				}

	
		$feelevel = $this->db->get_where('course_year_of_study', array("year_of_study_name" => $year))->row()->fee_level;	
$amount = $this->db->get_where('fedponek_fee_schedule', array("fee_type" =>2,"level"=> $feelevel,"session" => $session,"dept_id" => $studentDetails->dept, "student_type_id" => $studentDetails->prog_type))->row();
		//define("MERCHANTID", $merchantId->value);
		
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	echo $application_exist->application_invoice_id;
	exit;
}	
			

		//define("MERCHANTID", $merchantId->value);

		define("MERCHANTID", 532776942);

		//define("SERVICETYPEID", $serviceTypeId->value);

		define("SERVICETYPEID", 561126769);

		//define("APIKEY", $apiKey->value);

		define("APIKEY", 587460);

		define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");

		define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");

		define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");

		

		//echo MERCHANTID . ' - ' . SERVICETYPEID . ' - ' . APIKEY; 

		//exit;

				

		$totalAmount = $amount->amount + 500;

		$timesammp=DATE("dmyHis");		

		$orderID = $timesammp;

		$payerName = $studentDetails->name . ' ' . $studentDetails->othername; 

		$payerEmail = $studentDetails->email == "" ? 'student@fpno.com' : $studentDetails->email;  

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
		
		

		$beneficiaryName="Gtco Calscan Nig Ltd";
		
		$beneficiaryName2="Federal Polytechnic Nekede Treasury Single Account (CBN)";
		
	

		$beneficiaryAccount="0178130137";

		$beneficiaryAccount2="0140468461017";
		
		

		$bankCode="058";

		$bankCode2="000";
		
	

		$beneficiaryAmount =0;
		$totalDeductions=4500 + 2500 + 300;

		$beneficiaryAmount2 =$totalAmount - $beneficiaryAmount;
		
	//	$beneficiaryAmount3 ="2500";
		
	//	$beneficiaryAmount4 ="300";

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

	//	$application_form_category = $this->input->post('programme_type_id');
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>$application_form_category,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	$invoice_data = array(
               
               'surname' => $surname,
               'firstname' => $firstname,
			   'middlename'=> $middlename,
			   
			    'email' => $email);
	
	//$_SESSION['application_form_category'] =$application_exist->application_type_id;
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


echo $application_exist->application_invoice_id;
}

			
$timesammp=date("dmyHis");		
$orderID = $timesammp;
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
			   'fee_description'=>$amount->fee_desc.' - SCHOOL FEE',
			   'level'=>$year,
			   'semester'=>$semester,
			   'service_type_code'=>SERVICETYPEID
			   
			   
            );			
//$this->load->model('site_model');

//$this->load->model('site_model');
//$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
echo $this->db->get_where('invoice_gen', array("rrr" => trim($response['RRR'])))->row()->application_invoice_id;
			


		}else{

			echo 0;

		}
}	


    else {
        echo "Error! Something went wrong.";
    }
	
	}
	

function processTedcInvoice()
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $portalID = $request->portalID;
		
		
		
		$session = $request->session;
		$year = $request->year;
		$paymentType = $request->paymentType;
		$semester = $request->semester;
		
		$department =$request->department;
		$school=$request->school;
		$progtype = $request->progtype;
		$prog = $request->prog;
		
		
		if($portalID == '' || $portalID == ' ')
		{

		
		echo 0 ;
			exit;
		}
		

$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>13,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	echo $application_exist->application_invoice_id;
	exit;
}

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

		$payerEmail = $studentDetails->email == "" ? 'student@fpno.com' : $studentDetails->email;  

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

		$application_form_category = 13;
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>13,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
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


//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
echo $application_exist->application_invoice_id;
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


$this->db->insert('invoice_gen',$invoice_data);	
echo $this->db->get_where('invoice_gen', array("rrr" => trim($response['RRR'])))->row()->application_invoice_id;
			


		}else{

			echo 0;

		}
	
				
		
}	


    else {
        echo 0;
    }
	}	


function processRemitaMicrosoftFeeInvoice()
	{
			session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo 0 ;
			exit;
		}
		
		$session = $request->session;
		$year = $request->year;
		$paymentType = $request->paymentType;
		$semester = $request->semester;
		
		$department =$request->department;
		$school=$request->school;
		$progtype = $request->progtype;
		$prog = $request->prog;
		
		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
	
			
$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
$application_exist = $this->db->get_where('invoice_gen', array("portal_id" => $portalID,"application_type_id"=>14,"session_id" => $session,"level" => $year,"invoice_type" => '1'))->row();
if($application_exist)
{
	echo $application_exist->application_invoice_id;
	exit;
}
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

		$payerEmail = $studentDetails->email == "" ? 'student@fpno.com' : $studentDetails->email;  

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

$application_form_category = 13;
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


//$this->db->where('rrr', $_SESSION["invoice_no"]);
//$this->db->update("invoice_gen",$fp);
echo $application_exist->application_invoice_id;
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
//$_SESSION['application_form_category']=$application_form_category;

$this->db->insert('invoice_gen',$invoice_data);	
echo $this->db->get_where('invoice_gen', array("rrr" => trim($response['RRR'])))->row()->application_invoice_id;
			


		}else{
echo 0;

		}
		
	
				
				
	}
	 else {
        echo 0;
    }
	
	}
	
	
	
	function processAllFeePayments()
   {
	 
	 			session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo 0 ;
			exit;
		}
		
		$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
		
		$confirmcode = $request->confirmcode;
		$pmode = $request->pmode;

		
		if($pmode==1)
		{
		
		
			
		$exp_paid = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $confirmcode))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("invoice_no" => $exp_paid->payee_id,"portal_id"=>$portalID))->row();
		if(!$verify_invoice)
		{
			echo -1;
			exit;
		}
		
		$application_form_category = 1;
		$paymentType= $verify_invoice->application_type_id;
			
		if($paymentType==7)
		{
		$application_form_category = 2;
		}
		if($paymentType==8)
		{
		$application_form_category = 2;
		}
		if($paymentType==9)
		{
		$application_form_category = 2;
		}
		if($paymentType==10)
		{
		$application_form_category = 2;
		}
	    if($paymentType==11)
		{
		$application_form_category = 2;
		}
	    if($paymentType==12)
		{
		$application_form_category = 2;
		}
		if($paymentType==13)
		{
		$application_form_category = 3;
		}
		if($paymentType==14)
		{
		$application_form_category = 4;
		}
		if($paymentType==15)
		{
		$application_form_category = 5;
		}
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
		
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		
		
		//$student= $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $application_form_category,'student_id' =>$studentDetails->student_id,'payment_session'=>$session,'payment_level'=>$year,'payment_code'=>$confirmcode))->row();
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
			   'payment_fee_type' => $application_form_category ,
			   'student_id' => $studentDetails->student_id,
			   'semester'=> $semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	
 $data2["status"] = 'Approved';
			    $this->db->where('invoice_no', $verify_invoice->invoice_no);

				$this->db->update('invoice_gen', $data2);
		}
		
		//$_SESSION['payeeID']= $confirmcode;
		
		echo $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $confirmcode))->row()->id;
		exit;
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
		
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		$session = $verify_invoice->session_id;
		
		//$verify_invoice2 = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();

		if($verify_invoice )
		{
			echo -1;
			exit;
		}
			$application_form_category = 1;
		$paymentType= $verify_invoice->application_type_id;
			
		if($paymentType==7)
		{
		$application_form_category = 2;
		}
		if($paymentType==8)
		{
		$application_form_category = 2;
		}
		if($paymentType==9)
		{
		$application_form_category = 2;
		}
		if($paymentType==10)
		{
		$application_form_category = 2;
		}
	    if($paymentType==11)
		{
		$application_form_category = 2;
		}
	    if($paymentType==12)
		{
		$application_form_category = 2;
		}
		if($paymentType==13)
		{
		$application_form_category = 3;
		}
		if($paymentType==14)
		{
		$application_form_category = 4;
		}
		if($paymentType==15)
		{
		$application_form_category = 5;
		}
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
		
               $student = $this->db->get_where('student', array("student_id" => $studentDetails->student_id))->row();
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
	
$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $application_form_category,'student_id' => $studentDetails->student_id,'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'payment_fee_type' => $application_form_category,
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
		
echo $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $confirmcode))->row()->id;  
				             

                }else{

             echo 0;
			 exit;
                } 
//echo "issue is here!";
	
}
		}
else
{
	
$rrr= $confirmcode;
			
			
			$exp_paid = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
		if($exp_paid)
		{
		$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
	
		$session = $verify_invoice->session_id;
		$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		
		
		$verify_invoice2 = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();

		if(!($verify_invoice || $verify_invoice2))
		{
			echo -1;
		}
		if($verify_invoice2)
		{
			$year='HND I';
			$session = $verify_invoice2->session;
			$semester ='FIRST';
		}
			$application_form_category = 1;
		$paymentType= $verify_invoice->application_type_id;
			
		if($paymentType==7)
		{
		$application_form_category = 2;
		}
		if($paymentType==8)
		{
		$application_form_category = 2;
		}
		if($paymentType==9)
		{
		$application_form_category = 2;
		}
		if($paymentType==10)
		{
		$application_form_category = 2;
		}
	    if($paymentType==11)
		{
		$application_form_category = 2;
		}
	    if($paymentType==12)
		{
		$application_form_category = 2;
		}
		if($paymentType==13)
		{
		$application_form_category = 3;
		}
		if($paymentType==14)
		{
		$application_form_category = 4;
		}
		if($paymentType==15)
		{
		$application_form_category = 5;
		}
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
			   'payment_fee_type' => $application_form_category,
			   'student_id' => $studentDetails->student_id,
			   'semester'=>$semester
            );			

$this->db->insert('eduportal_fees_payment_log',$payment_data);	

		}
	$pid=	 $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $rrr))->row()->id;
	echo $pid;
exit;	 
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

				
				      //  $this->session->set_userdata('receipt',$stud->$response['orderId']); //Trans Receipt
						   //Transaction PayeeID
						
				
				      //  	include('application/config/z.php');
							
					
$verify_invoice = $this->db->get_where('invoice_gen', array("rrr" => $rrr,"portal_id"=>$portalID))->row();
$verify_invoice2 = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $rrr,"putme_id"=>$portalID))->row();

$session = $verify_invoice->session_id;
$year = $verify_invoice->level;
		$semester = $verify_invoice->semester;
		if(!($verify_invoice || $verify_invoice2))
		{
			echo -1;
			exit;
		}
		if($verify_invoice2)
		{
			$year='HND I';
			$session = $verify_invoice2->session;
			$semester ='FIRST';
		}	
				$this->db->where('rrr', $rrr);

				$this->db->update('invoice_gen', $data2);
				
				$this->db->where('rrr', $rrr);

				$this->db->update('eduportal_remita_payment', $data2);

				

				//check if record already exists

				$rrrset = $this->db->get_where('eduportal_remita_payment', array("rrr" => $rrr))->row();
				

				if($rrrset){

				
			echo $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $rrr))->row()->id;

					

				}else{
					

					$this->db->insert('eduportal_remita_payment', $data);


	    $application_form_category = 1;
		$paymentType= $verify_invoice->application_type_id;
			
		if($paymentType==7)
		{
		$application_form_category = 2;
		}
		if($paymentType==8)
		{
		$application_form_category = 2;
		}
		if($paymentType==9)
		{
		$application_form_category = 2;
		}
		if($paymentType==10)
		{
		$application_form_category = 2;
		}
	    if($paymentType==11)
		{
		$application_form_category = 2;
		}
	    if($paymentType==12)
		{
		$application_form_category = 2;
		}
		if($paymentType==13)
		{
		$application_form_category = 3;
		}
		if($paymentType==14)
		{
		$application_form_category = 4;
		}
		if($paymentType==15)
		{
		$application_form_category = 5;
		}
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
		
		
		
		$verify_payment_log = $this->db->get_where('eduportal_fees_payment_log', array("payment_fee_type" => $application_form_category,'student_id' => $studentDetails->student_id,'payment_session'=>$session,'payment_level'=>$year))->row();
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
			   'student_id' => $studentDetails->student_id,
			   'semester'=> $semester
			   
            );			
//$_SESSION["paytype"]=$verify_invoice->fee_description;
$this->db->insert('eduportal_fees_payment_log',$payment_data);	
		}
echo $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $rrr))->row()->id;
exit;				
}
				
			
	}
	else{
		echo 0 ;
			exit;
		}
	echo 0 ;
			exit;

				
	
}
			
		}


   }
   
   else
   {
	   echo 0 ;
			exit;
   }

   }
   
   
   	function getFeeReceipt($receipt_id)
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	 header('Content-type: text/json'); 
	   
$result = mysql_query("SELECT* FROM `eduportal_fees_payment_log` where id='$receipt_id'") or die(mysql_error());
while($row= mysql_fetch_object($result))
{
	$data["ReceiptDetails"] = array($row);
 $response = json_encode($data);
 print_r($response);

}

	}
	
	
function getFeeReceipts($id)
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	 header('Content-type: text/json'); 
	  $invoice_entries            = array();
  
$result = mysql_query("SELECT* FROM `eduportal_fees_payment_log` where student_id='$id'") or die(mysql_error());
while($row= mysql_fetch_array($result))
{
	$new_entry = $row;
 
array_push($invoice_entries, $new_entry);
}
$data["Receipts"] = $invoice_entries;
$response=json_encode($data);
 print_r($response);
	}
	

function ajax_check_coursereg_details()
	{
 			session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
		//print_r($request);
		
		//exit;
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo -1 ;
			exit;
		}
		
		//$studentDetails = $this->db->get_where('student', array("portal_id" => $portalID))->row();
		
		$confirmcode ='1';
	
	
	$data = array(
   
   'student_id'=> $request->student_id,
   'payment_session'=> $request->session,
   'payment_fee_type'=> '2'
   );
  
//$_SESSION["sessio_id"]= $this->input->post('session') ;
//$_SESSION["level_id"]=$this->input->post('level');
//$_SESSION["semester"]=$this->input->post('semester') ;
//$_SESSION["stuReg_id"]=$this->session->userdata('student_id');
   
    $detailsexit = $this->db->get_where('eduportal_fees_payment_log',$data);
	if($detailsexit->num_rows() > 0)
	{
   $data2 = array(
   'semester_id'=> $request->semester,
   'student_type_id'=> $request->programme,
   'department_id'=>$request->depts,
   'dept_option_id'=>$request->deptsoptions,
   'session'=>$request->session,
   'programme'=> $request->programme,
   'level'=> $request->level,
   'programme_type_id'=> $request->programme_type_id
   );
	// $page_data['page_name']  = 'process_register_courses';
    //$page_data['page_title'] = "Register Courses";
    //$this->load->view('backend/index', $page_data);
	// echo $this->input->post('pin').$this->input->post('portal_id').$this->input->post('session');
	$pin=$detailsexit->payment_code;
	}
	else
	{
	echo 0;
	exit;	
	}
	
    $data3 = 	array(
    'semester_id'=> $request->semester,
   'student_type_id'=> $request->programme,
   'department_id'=>$request->depts,
   'dept_option_id'=>$request->deptsoptions,
   'year_of_study_id'=> $request->level,
   'programme_type_id'=> $request->programme_type_id
   
	);
	
	 $detailsexit2 = $this->db->get_where('course_assigned_to_department',$data3);
	if($detailsexit2->num_rows() > 0)
	{
   $page_data = array(
    
   'semester'=> $request->semester,
   'student_type_id'=> $request->programme,
   'department_id'=>$request->depts,
   'session_id'=>$request->session,
   'programme'=> $request->programme,
   'level_id'=> $request->level,
   'programme_type_id'=> $request->programme_type_id,
   'deptsoptions'=>$request->deptsoptions,
   'confirm_code'=> $pin
   );
 $data1["courseData"]= $this->db->get_where('course_assigned_to_department',$data3)->result_array();
 $response=json_encode($data1);
 print_r($response);
 exit;
	}
	
	else
	{
	echo -1;
	}
	
		
}
 else
   {
	   echo -1 ;
			exit;
   }

   }
   
   
   
   	function ajax_do_submit_coursereg (){
    			session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
		//print_r($request);
		
		//exit;
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo -1 ;
			exit;
		}
		
		
	
	
   $data2 = array(
  
   'semester_id'=> $request->semester,
   'student_type_id'=> $request->programme,
   'department_id'=> $request->depts,
   'year_of_study_id'=> $request->level,
   'programme'=> $request->programme_type_id
   
   
   );
   
   	$page_data = array(
   'semester'=> $request->semester,
   'student_type_id'=> $request->programme,
   'department_id'=>$request->depts,
   'session_id'=>$request->session,
   'programme'=> $request->programme_type_id,
   'level_id'=> $request->level,
   

   'confirm_code'=> '1'
   );
   
	// $page_data['page_name']  = 'process_register_courses';
    // $page_data['page_title'] = "Register Courses";
   $details = $this->db->get_where('course_unit_load', $data2)->row();
  // echo $details->maximum_unit; exit;
   if(!isset($details->maximum_unit))
   {
	   echo "Error:  Maximum credit unit load of your class has not assigned! Contact your Class Adviser.";
	   exit;
	
	 
   }
   else
   {
   $maxunit=$details->maximum_unit;
   
 
   
	$course_unit=0;
	$credit=0;
	 $dataverify1=array(
   'student_id'=>$request->student_id,
   'year_of_study'=>$request->level,
   'session'=>$request->session,
   'semester'=> $request->semester
	);
	$detailscredit = $this->db->get_where('courses_registered',$dataverify1);
	foreach($detailscredit->result() as $row)
	{
		$credit= $credit + $row->course_unit;
	}
	
	foreach($request->courses  as $course_assign_id) {

  
   $course_unit=$course_unit+($this->db->get_where('course_assigned_to_department',array('id'=>$course_assign_id))->row()->course_unit);
   
   
	}
	$course_unit=$course_unit+$credit;

   if($course_unit>$maxunit)
   {
	   echo "Error: Total Selected Credit Unit of $course_unit is higher than assigned Maximum credit unit of $maxunit!";
	   
	exit;
     //$this->load->view('backend/index', $page_data);
	 
   }
   else
   {
    foreach($request->courses  as $course_assign_id) {


	
	if($request->semester==1)
	{
		$sm ='First Semester';
	}
	if($request->semester==2)
	{
		$sm ='Second Semester';
	}
	
	if($request->level==1)
	{
		$yr ='ND I';
	}
	if($request->level==2)
	{
		$yr ='ND II';
	}
	if($request->level==3)
	{
		$yr ='HND I';
	}
	if($request->semester==4)
	{
		$yr ='HND II';
	}
  $data = array(
   'student_id'=>$request->student_id,
   'course_assign_to_dept_id'=> $course_assign_id,
   'course_unit'=>$this->db->get_where('course_assigned_to_department',array('id'=>$course_assign_id))->row()->course_unit,
   'year_of_study'=>$request->level,
   'session'=>$request->session,
   'semester'=> $request->semester,
   'course_status_id'=>"R",
   'approved'=> '0',
   'date_submitted'=>date("d M Y H:i:s"),
   'semestr'=> $sm,
   'level'=> $yr,
   'sess'=> $request->session
   
   );
   
   $dataverify=array(
   'student_id'=>$request->student_id,
   'course_assign_to_dept_id'=> $course_assign_id,
   'year_of_study'=>$request->level,
   'session'=>$request->session,
   'semester'=> $request->semester
	);
	$detailsexit = $this->db->get_where('courses_registered',$dataverify);
	if($detailsexit->num_rows() > 0)
	{

	   
	
     
	}
	else
	{
		$this->db->insert('courses_registered',$data);
		//echo $data;
		echo 1 ;
			exit;	
	}
	
  }
   }
   }
  echo 1 ;
			exit;
}

	else
   {
	   echo -1 ;
			exit;
   }

   }


   function view_coursereg_details()
{
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
	
	$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
		//print_r($request);
		
		//exit;
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo -1 ;
			exit;
		}
	$semester=$request->semester;
   $student_type_id= $request->programme;
   $department_id=$request->depts;
   $session_id=$request->session;
   $programme= $request->programme_type_id;
   $level_id= $request->level;
   $studentid=$request->student_id;
   
 header('Content-type: text/json'); 
 $data["courseData"] = $this->db->query("(select `a`.`course_assign_to_dept_id` AS `CID`,`a`.`semester` AS `semester_id`,`a`.`course_registered_id` AS `COURSE_REG_ID`,`a`.`student_id` AS `STUDENT_ID`,`h`.`name` AS `SURNAME`,`h`.`othername` AS `OTHERNAMES`,`h`.`portal_id` AS `PORTAL_ID`,`h`.`reg_no` AS `REGNO`,`g`.`deptName` AS `DEPARTMENT`,`k`.`student_type_name` AS `PROGRAMME`,`j`.`programme_type_name` AS `PROGRAMME_TYPE`,`i`.`course_code` AS `COURSE_CODE`,`i`.`course_title` AS `TITLE`,`a`.`course_unit` AS `CREDIT_UNIT`,`c`.`semester_name` AS `SEMESTER`,`d`.`year_of_study_name` AS `LEVEL`,`e`.`sessionn_name` AS `SESSION`,`f`.`status` AS `APPROVAL_STATUS` from ((((((((((`courses_registered` `a` join `course_assigned_to_department` `b`) join `course_semester` `c`) join `course_year_of_study` `d`) join `course_session` `e`) join `course_approval_codes` `f`) join `department` `g`) join `student` `h`) join `eduportal_courses` `i`)join `programme_type` `j`) join `student_type` `k`) where ((`a`.`course_assign_to_dept_id` = `b`.`id`) and (`a`.`year_of_study` = `d`.`year_of_study_id`) and (`a`.`semester` = `c`.`semester_id`) and (`a`.`session` = `e`.`sessionn_name`) and (`b`.`department_id` = `g`.`deptID`) and (`a`.`student_id` = `h`.`student_id`) and (`a`.`approved` = `f`.`id`) and (`b`.`course_id` = `i`.`course_id`) and (`b`.`programme_type_id` = `j`.`programme_type_id`) and (`b`.`student_type_id` = `k`.`student_type_id`) and (`a`.`student_id`='$studentid') and (`a`.`semester`='$semester') and (`a`.`session`='$session_id')) ) ")->result_array();

 $response = json_encode($data);
 print_r($response);



}

else
   {
	   echo -1 ;
			exit;
   }

   }
   
   
   
   function view_res_details()
{
	
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
	
	$postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
		//print_r($request);
		
		//exit;
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo -1 ;
			exit;
		}
	$semester=$request->semester;
   $student_type_id= $request->programme;
   $department_id=$request->depts;
   $session_id=$request->session;
   $programme= $request->programme_type_id;
   $level_id= $request->level;
   $studentid=$request->student_id;
   
 header('Content-type: text/json'); 
 $data["ResultData"] = $this->db->query("(select `a`.`course_assign_to_dept_id` AS `CID`,`a`.`grade` AS `GRADE`,`a`.`semester` AS `semester_id`,`a`.`course_registered_id` AS `COURSE_REG_ID`,`a`.`student_id` AS `STUDENT_ID`,`h`.`name` AS `SURNAME`,`h`.`othername` AS `OTHERNAMES`,`h`.`portal_id` AS `PORTAL_ID`,`h`.`reg_no` AS `REGNO`,`g`.`deptName` AS `DEPARTMENT`,`k`.`student_type_name` AS `PROGRAMME`,`j`.`programme_type_name` AS `PROGRAMME_TYPE`,`i`.`course_code` AS `COURSE_CODE`,`i`.`course_title` AS `TITLE`,`a`.`course_unit` AS `CREDIT_UNIT`,`c`.`semester_name` AS `SEMESTER`,`d`.`year_of_study_name` AS `LEVEL`,`e`.`sessionn_name` AS `SESSION`,`f`.`status` AS `APPROVAL_STATUS` from ((((((((((`courses_registered` `a` join `course_assigned_to_department` `b`) join `course_semester` `c`) join `course_year_of_study` `d`) join `course_session` `e`) join `course_approval_codes` `f`) join `department` `g`) join `student` `h`) join `eduportal_courses` `i`)join `programme_type` `j`) join `student_type` `k`) where ((`a`.`course_assign_to_dept_id` = `b`.`id`) and (`a`.`year_of_study` = `d`.`year_of_study_id`) and (`a`.`semester` = `c`.`semester_id`) and (`a`.`session` = `e`.`sessionn_name`) and (`b`.`department_id` = `g`.`deptID`) and (`a`.`student_id` = `h`.`student_id`) and (`a`.`approved` = `f`.`id`) and (`b`.`course_id` = `i`.`course_id`) and (`b`.`programme_type_id` = `j`.`programme_type_id`) and (`b`.`student_type_id` = `k`.`student_type_id`) and (`a`.`student_id`='$studentid') and (`a`.`semester`='$semester') and (`a`.`session`='$session_id') and (a.`grade`<>'')) ) ")->result_array();
if(!$data["ResultData"])
{
	echo -1;
	exit;
}
 $response = json_encode($data);
 print_r($response);
exit;


}

else
   {
	   echo -1 ;
			exit;
   }

   }
 

 
   	function viewStudentAllFees()
	{
		session_start();
		   include('application/config/z.php');
    //http://stackoverflow.com/questions/18382740/cors-not-working-php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 $postdata = file_get_contents("php://input");
    if ($postdata) {
        $request = json_decode($postdata);
		//print_r($request);
		
		//exit;
        $portalID = $request->portalID;
		
			if($portalID == '' || $portalID == ' ')
		{

		
		//	$_SESSION['err_msg'] = 'Incorrect portal id supplied.';

			echo -1 ;
			exit;
		}
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
	 header('Content-type: text/json'); 
$count=0;	   




$invoice_entries            = array();
  
$result = mysql_query("SELECT* FROM `eduportal_fees_payment_log` a, student b where a.student_id=b.student_id and a.regno='$portalID'") or die(mysql_error());
while($row= mysql_fetch_array($result))
{
	$new_entry = $row;
 
array_push($invoice_entries, $new_entry);
}
$data["ReceiptDetails"] = $invoice_entries;
$response=json_encode($data);
 print_r($response);

exit;
	} 
	else{
		echo -1;
		exit;
	}
	
	}
	
}

