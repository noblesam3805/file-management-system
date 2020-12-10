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
	
	
	function processBursaryPayment(){
		if ($this->session->userdata('sadmin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if(isset($_POST['submit'])){
			//get the reg no
			$regno = $this->input->post('regno');
			
			//check for existence of reg no
			$student = $this->db->get_where('student', array("reg_no" => $regno))->row();
			if($student){
				//get the details for the payment table
				$data['customer_id'] = $student->reg_no;
				$data['fullname'] = $student->name . ' ' . $student->othername;
				$data['receipt_no'] = $this->input->post('receiptno');
				$data['confirm_code'] = $this->input->post('chequeno');
				$data['description'] = $this->input->post('type') . ' FEES-' . $student->name . ' ' . $student->othername . ' APPROVED BY BURSARY';
				$data['amount'] = $this->input->post('amount') . '.00';
				$data['dept'] = $student->dept;
				$data['prog_type'] = $student->prog_type;
				$data['level'] = $student->level;
				$data['session'] = $this->input->post('session');
				$data['bankname'] = 'BURSARY';
				$data['cust_add'] = $student->address;
				$data['phone'] = $student->phone;
				$data['payment_date'] = $this->input->post('date');
				$data['used_by'] = $student->reg_no;
				$data['status'] = 'paid';
			
				//check if student already have payment record
				$payRecord = $this->db->get_where('etranzact_payment', array("customer_id" => $regno, "receipt_no" => $this->input->post('receiptno'), "confirm_code" => $this->input->post('chequeno')))->row();
				if($payRecord){
					echo "Record already exists";
				}else{
					
					$this->db->insert('etranzact_payment', $data);
					
					session_start();
					$_SESSION['success'] = "Payment record added successfully";
					redirect(base_url() . 'index.php?sadmin/bursaryPayment');
				}
			}else{
				echo "reg no not registered";
			}
		}else{
			echo "nothing posted";
		}
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
        $page_data['etz'] = $this->db->order_by('trans_date', 'DESC')->get('eduportal_remita_payment',3)->result_array();
        $page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'dashboard';

        $page_data['page_title'] = get_phrase('admin_dashboard');

        $this->load->view('backend/index', $page_data);

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
		 $data["fee_desc"]= 'EBSU SCHOOL FEES - '.$year;
		 $data["indigene_amount"]= $indigene_amount[$i];
		 $data["nonindigene_amount"]= $nonindigene_amount[$i];
		 
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
				
	$sadmin_id =$this->session->userdata('sadmin_id');
	$programme= $this->input->post('programme');
   $school= $this->input->post('school');
   $depts= $this->input->post('depts');
   $deptsoptions= $this->input->post('deptsoptions');
   
 
      $programme_type_id=$this->input->post('prog_type');
	  
	  $batch=$this->input->post('batch');
   $ltype=$this->input->post('ltype');
   $sess=$this->input->post('session');
	$path = "files/";
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
				$query =mysql_query("select* from eduportal_admission_list where dept_id = '$depts' and dept_option_id='$deptsoptions' and programme_type_id='$programme_type_id' and session='$sess' and admissionlist_batch_id='$batch' and adm_type='$ltype'") or die(mysql_error());
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
								mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE eduportal_admission_list_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES SET session_id = '$session'") or die (mysql_error());
								$query =mysql_query("select* from eduportal_admission_list_temp where session_id = '$session'") or die("1");
								$i=1;
								while(list($id,$jamb,$surname,$firstname,$middlename,$type) = mysql_fetch_array($query))
								{
									
								if(trim($type)!="ADMISSIONS LIST")
								{
								mysql_query("delete from eduportal_admission_list_temp where session_id = '$session'");
								echo "Invalid Admission List File!";
								exit;
								}
								
								$check_dup = mysql_query("select count(*) from eduportal_admission_list where application_no='$jamb'") or die (mysql_error());
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
								
									
							mysql_query("insert into `eduportal_admission_list` (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype')") or die (mysql_error()."3");
								mysql_query("insert into `ebsuedun_admission`.`eduportal_admission_list` (application_no,surname,firstname,middlename,dept_id,school_id,dept_option_id,student_type,programme_type_id,session,admissionlist_batch_id,activated,user_id,adm_type) values ('$jamb','$surname','$firstname','$middlename','$depts','$school','$deptsoptions','$programme','$programme_type_id','$sess','$batch','1','$sadmin_id','$ltype')") or die (mysql_error()."4");
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

         $page_data['admlist_details'] = $this->db->get_where('eduportal_admission_list', array("application_no" => $id))->row();
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
		 $data2['id']  = $id;
		 $data['surname'] =$this->input->post('surname');
		 $data['firstname'] =$this->input->post('firstname');
		 $data['middlename'] =$this->input->post('middlename');
		    $data['school_id']= $this->input->post('school');
    $data['dept_id']= $this->input->post('depts');
    $data['dept_option_id']= $this->input->post('deptsoptions');
	$data['student_type']= $this->input->post('programme');
    $data['programme_type_id']=$this->input->post('prog_type');
	  
	  $data['admissionlist_batch_id']=$this->input->post('batch');
   $data['adm_type']=$this->input->post('ltype');
   $data['session']=$this->input->post('session');
   
   $this->db->where('application_no', $id);
            $this->db->update('eduportal_admission_list', $data);
			
			$this->db->where('application_no', $id);
            $this->db->update('ebsu_registration_portal.eduportal_admission_list', $data);
			
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
	
	   $this->db->where('application_no', $id);
    $this->db->delete('ebsu_registration_portal.eduportal_admission_list');
   redirect(base_url().'index.php?sadmin/view_adm_list', 'refresh');
	}
	   function screen_students()

    {

        if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');

        //$page_data['hostel'] = $this->db->order_by('id', 'DESC')->get('counter',3)->result_array();
        $page_data['fees'] = $this->db->order_by('id', 'DESC')->get('eduportal_fees_payment_log')->result_array();
        //$page_data['reg'] = $this->db->order_by('student_id', 'DESC')->get('student',3)->result_array();
        
        $page_data['page_name']  = 'screen_students';

        $page_data['page_title'] = get_phrase('screen_students_module');

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
		

        $page_data['page_title'] ="Generate EBSU Payment Reports";

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
$page_data['invoices']= $this->db->query("SELECT * FROM eduportal_remita_payment WHERE  `service_type` = '$payment_type' AND (trans_date BETWEEN '$date_1' AND '$date_2') order by trans_date")->result_array();


		
		$page_data['page_name']  = 'remita_reports';
	    
    $page_data['page_title'] ="EBSU Payment Reports";
       // $page_data['page_title'] = $this->db->get_where('application_type', array("application_typeid" => $payment_type))->application_type;

        $this->load->view('backend/index', $page_data);
	}
	
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
    $page_data['page_name']  = 'upload_courses';
    $page_data['page_title'] = "Upload Courses";
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
   'year_of_study_id'=> $this->input->post('level'),
   'activated'=> "1",
   'programme_type_id'=> $this->input->post('programme_type_id')
   );
   $data2 = array(
   'course_id'=> $course_id,
   'semester_id'=> $this->input->post('semester'),
   'student_type_id'=> $this->input->post('programme'),
   'department_id'=>$this->input->post('depts'),
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
   'level'=> $this->input->post('level'),
   'semester'=> $this->input->post('semester'),
   'programme_type_id'=>$this->input->post('programme_type_id'),
   'modeofentry'=>$this->input->post('modeofentry'),
   'page_name'=>'view_assigncourseto_dept_fast',
   'page_title'=>'Assign Courses To Department',
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
	 
$page_data = array(
   'programme'=> $this->session->userdata('programme'),
   'school'=> $this->session->userdata('school'),
   'depts'=> $this->session->userdata('depts'),
   'level'=> $this->session->userdata('levels'),
   'semester'=>$this->session->userdata('semester'),
   'programme_type_id'=> $this->session->userdata('programme_type_id'),
   'modeofentry'=> $this->session->userdata('modeofentry'),
   'page_name'=>'view_assigncourseto_dept_fast',
   'page_title'=>'Assign Courses To Department',
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
   'level_id'=> $this->input->post('level')
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

function ajax_coursereg_approval()
{
 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 
    $_SESSION["error"]="";	
	
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
	$page_data['page_name']  = 'view_student_registered_courses';
    $page_data['page_title'] = "Approve Registered Courses";
	$this->load->view('backend/index', $page_data);
}

 function ajax_update_unitload_of_dept(){
	 
	 if ($this->session->userdata('sadmin_login') != 1)

            redirect(base_url(), 'refresh');
	 
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
   'date_time_of_approval' => date("d M Y H:i:s"),
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
  

mysql_query("update course_unit_load set maximum_unit='$maxunit',minimum_unit='$minunit',maximum_elective='$max_elective' where semester_id='".$this->input->post('semester')."' and student_type_id='".$this->input->post('programme')."' and department_id='".$this->input->post('depts')."' and year_of_study_id ='".$this->input->post('level')."' and programme ='".$this->input->post('programme_type_id')."'") or die (mysql_error());
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
		
   $page_data = array(
   'programme'=> $this->input->post('programme'),
   'school'=> $this->input->post('school'),
   'depts'=> $this->input->post('depts'),
   'level'=> $this->input->post('level'),
   'modeofentry'=> $this->input->post('programme_type_id'),
   'programme_type_id'=> $this->input->post('programme_type_id'),
   'semester'=> $this->input->post('semester'),
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
    'programme_type_id'=> $this->input->post('programme_type_id'),
   'semester'=> $this->input->post('semester'),
   'page_name'=>'assign_unitload_to_dept',
   'page_title'=>'Assign Unit Load To Department',
   );
   
   
    $this->load->view('backend/index', $page_data);
    }
	
	  function get_depts(){
   $school= $this->input->get('school');

    echo $school;
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
								mysql_query("LOAD DATA LOCAL INFILE '".$path.$actual_image_name."' INTO TABLE 	eduportal_courses_temp FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' SET sid = '$session', activated='1'") or die (mysql_error());
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
								
									
							mysql_query("insert into `eduportal_courses` (course_code,course_title,code,activated) values ('$coursecode','$ct','$coursecode','1')") or die (mysql_error()."3");
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
		    $query = $this->db->query("select* from invoice_gen where `status` is null and date_generated like '%2018-10%' limit 20")->result_array();
			foreach($query as $row)
			{
				$rrr = $row["rrr"];
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




}

