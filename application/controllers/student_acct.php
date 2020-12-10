<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
     session_start();
/*
 *  @author : GTCO
 *  @contributor : CEKAL
 *  March, 2018
 *  Student Account
 *  162.144.134.70/nekede/index.php?student_acct/index
 *
 */


class Student_acct extends CI_Controller
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
    public function index()  {
		$this->load->model("site_model");
		session_start();
		if(isset($_SESSION['SA_user'])){
			$page_data['page_name']  = 'console'; 
			$page_data['page_title'] = get_phrase('Student Account');
			$page_data['page_sub_heading'] ="Welcome ";
		
		}
		else{
			$page_data['page_name']  = 'auth'; 
		
			$page_data['page_title'] = get_phrase('Student Account: Login');
			$page_data['page_sub_heading'] ="Student Account: Login";
			
		}
		
	$this->load->view('backend/student_acct_print', $page_data); 
    }
	
	public function pro_verify_auth(){
		$uname = $this->input->post('username');
			$pword = $this->input->post('password');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[60]');	
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');	
			if ($this->form_validation->run() == FALSE){
			?>
           <script language="javascript">
		alert("All fields are compulsory. Amend and continue");
		window.location.href="<?php echo base_url();?>index.php?student_acct/index";
		</script>
            <?php
			}
			else{
				$password = md5($pword).sha1($pword);
				$valid1 = "SELECT * from student_acct_users where auth_one =? and auth_two =?";
				//$valid2 = "SELECT * from admin_users where auth_two =?";
				$q1 = $this->db->query($valid1,array($uname,$password));	
				
				if($q1->num_rows()>0){
					session_start();
				
					foreach($q1->result() as $info){
						if($info->status==0){
							?>
								   <script language="javascript">
                                alert("Your account is blocked. Contact the system Admin.");
                                window.location.href="<?php echo base_url();?>index.php?student_acct/index";
                                </script>
            <?php
						}
						else{
							$_SESSION['SA_userCat'] = $info->cat;	//Category
							$_SESSION['SA_user']= $info->auth_one;//User Name
							$_SESSION['SA_userSaid'] = $info->said;//User ID
							//Redirects to Account status check
							redirect(base_url()."index.php?student_acct/index");
						}
					}
					
		
    		 	}
				else{
				?>
           <script language="javascript">
		alert("Invalid account combinations");
		window.location.href="<?php echo base_url();?>index.php?student_acct/index";
		</script>
            <?php	
				}
			}
		
			
	}
	
/*	function verified(){
		$page_data['page_name']  = 'console'; 
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="Welcome ";
		$this->load->view('backend/student_acct_print', $page_data); 
		
	}
	
*/	
	
	
	function saUsers(){
		if($_SESSION['SA_userCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?student_acct/terminate";
		</script>
            <?php	
		}
		$page_data['page_name']  = 'saUsers'; 
		$page_data['page_sub_heading'] ="Student Account : Users ";
		$this->load->view('backend/student_acct_print', $page_data);
	}
	function newUser(){
		if($_SESSION['SA_userCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?student_acct/terminate";
		</script>
            <?php	
		}
		$page_data['page_name']  = 'newUser';
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="New User ";
		$this->load->view('backend/student_acct_print', $page_data);	
	}
	
	function pro_newUser(){
		if($_SESSION['SA_userCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?student_acct/terminate";
		</script>
            <?php	
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('auth_one', 'User Name', 'required');
		$this->form_validation->set_rules('auth_two', 'Pass word', 'required');
		if ($this->form_validation->run() == FALSE){
			?>
           <script language="javascript">
		alert("All fields are compulsory. Amend and continue");
		window.location.href="<?php echo base_url();?>index.php?student_acct/newUser";
		</script>
            <?php
			}
			else{
				$auth_one = $this->input->post('auth_one');
				$auth_two = $this->input->post('auth_two');
				
				$password = md5($auth_two).sha1($auth_two);
				//check for existing user
				$check = $this->db->get_where("student_acct_users",array("auth_one"=>$auth_one))->row();
				if($check){
					?>
           <script language="javascript">
		alert("User already exist");
		window.location.href="<?php echo base_url();?>index.php?student_acct/newUser";
		</script>
            <?php
					
				}
				else{
					$data=array('auth_one'=>$auth_one, 'auth_two'=>$password);
					$this->db->insert("student_acct_users",$data);
					
					$said = $this->db->get_where("student_acct_users",array("auth_one"=>$auth_one))->row()->said;
					
					?>
           <script language="javascript">
		alert("New User Created!");
		window.location.href="<?php echo base_url();?>index.php?student_acct/saUsers#<?php echo $said;?>";
		</script>
            <?php	
				}
			}
		
	}
	
	function accountStatus($status,$said){//Block : Unblock Account
		$upd["status"] = $status;
		$this->db->where("said",$said)->update("student_acct_users",$upd);
		redirect(base_url().'index.php?student_acct/saUsers');
	}
	
	function stud_search(){
		$page_data['page_name']  = 'stud_search'; 
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="Student Profile : Option ";
		$this->load->view('backend/student_acct_print', $page_data);
	}
	
	function studentProfile($student_id){
		$page_data['page_name']  = 'studentProfile';
		$page_data['student_id'] = $student_id; 
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="Student Profile : Profile ";
		$this->load->view('backend/student_acct_print', $page_data);
	}
	
	//SYNC FEES
	function sync_fee($student_id){
		$page_data['page_name']  = 'sync_fee';
		$page_data['student_id'] = $student_id; 
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="Student Profile : Sync Payments ";
		$this->load->view('backend/student_acct_print', $page_data);
		
	}
	function pro_sync_fee_fpno(){//Checks old portal first
		$this->load->library('portal_sync');
		$payCode = $this->input->post('payCode');
		$student_id = $this->input->post('student_id');
		
		$this->portal_sync->fetch_details_fpno($payCode,$student_id);
			
	}
	
	function syncInfo_fpno($status,$payment_code,$student_id,$payment_amount,$payment_session,$payment_level,$semester,$fee_type,$student_name,$OldRegNo,	$payment_date){//Remeber to check existing code before inserting
			$payment_session = str_replace("__","/",$payment_session);
			$payment_level = str_replace("__"," ",$payment_level);
			$student_name = str_replace("__"," ",$student_name);
			$payment_date = str_replace("__","-",$payment_date);
			$payment_date = str_replace("--","-",$payment_date);
			$OldRegNo = str_replace("__","-",$OldRegNo);
			$OldRegNo = str_replace("_","/",$OldRegNo);
			
			$payment_code = str_replace("__","|",$payment_code);
		 $payment_code = str_replace("_","-",$payment_code);
			
			if($fee_type == 0 || $fee_type == 22 || $fee_type == 44){
				$payment_fee_type = 2;//Sch fee
			}
			elseif($fee_type == 3){
				$payment_fee_type = 1;//Acceptance Fee
					
			}
			elseif($fee_type == 4){
				$payment_fee_type = 7;//Damages fee
					
			}
			elseif($fee_type == 6){
				$payment_fee_type = 3;// TEDC
					
			}
			elseif($fee_type == 7){
				if($payment_amount==5000){
					$payment_fee_type = 8;// Local Transcript
				}
				else{
					$payment_fee_type = 9;// Foreign Transcript
				}
					
			}
			elseif($fee_type == 10 || $fee_type == 11 || $fee_type == 12){
				$payment_fee_type = 5;//Late / Completion of Sch fee
			}
	
		if($status==1){
			$page_data['page_name']  = 'syncInfo_fpno';
			$page_data['student_id'] = $student_id; 
			$page_data['payment_code'] = $payment_code;
			$page_data['payment_amount'] = $payment_amount;
			$page_data['payment_session'] = $payment_session;
			$page_data['payment_level'] = $payment_level;
			$page_data['semester'] = $semester;
			$page_data['payment_fee_type'] = $payment_fee_type;
			$page_data['student_name'] = $student_name;
			$page_data['payment_date'] = $payment_date;
			$page_data['OldRegNo'] = $OldRegNo;
			$page_data['payment_status'] = "E";
			
			$page_data['page_title'] = get_phrase('Student Account');
			$page_data['page_sub_heading'] ="Student Profile : STUDENT IN VIEW ";
			$this->load->view('backend/student_acct_print', $page_data);
			
		}
		else{//Navigate to other tables on same site: Remita
			
			redirect(base_url()."index.php?student_acct/pro_sync_fee_remita/".$payment_code."/".$student_id);
		}
	}
	
	function pro_syncInfo_fpno(){
		$payment_code = $this->input->post('payment_code');
		$payment_amount = $this->input->post('payment_amount');
		$payment_session = $this->input->post('payment_session');
		$level2 = $this->input->post('level2');
		$level1 = $this->input->post('level1');
		$semester = $this->input->post('semester');
		$payment_fee_type = $this->input->post('payment_fee_type');
		$payment_date = $this->input->post('payment_date');
		$student_id = $this->input->post('student_id');
		$payment_status = $this->input->post('payment_status');
		
		$payment_level = $level1." ".$level2;
		
		
		$info = $this->db->get_where("student",array("student_id"=>$student_id))->row();//Student INFO
		$check = $this->db->get_where("eduportal_fees_payment_log",array("payment_code"=>$payment_code))->row();//Check if PIN already Exist
		if(!$check){
			$data=array('payment_code'=>$payment_code, 'payment_amount'=>$payment_amount, 'payment_session'=>$payment_session, 'payment_level'=>$payment_level, 'payment_status'=>$payment_status, 'payment_date'=>$payment_date,'semester'=>$semester, 'payment_fee_type'=>$payment_fee_type, 'student_id'=>$student_id, 'regno'=>$info->reg_no);
			
			$this->db->insert("eduportal_fees_payment_log",$data);
			
			$staff["tag_data"] = "Sync of payment for ".$info->name.", ".$info->othername." - ".$info->reg_no."[".$payment_code."]";
			$staff["dy"] = date('d');
			$staff["mt"] = date('m');
			$staff["yr"] = date('Y');
			$staff["trans_date"] = date("D, M d Y");
			$staff["said"] = $_SESSION['SA_userSaid'];
			$this->db->insert("student_acct_users_actv",$staff);
		}
		
		redirect(base_url()."index.php?student_acct/studentProfile/".$student_id);
	}
	
	function pro_sync_fee_remita($payment_code,$student_id){//Remita
		$secondDbase = $this->load->database('secondDbase', TRUE);
		$data = $this->db->get_where("eduportal_remita_payment",array("rrr"=>$payment_code))->row();
		if($data){
			$invoiceInfo = $secondDbase->get_where("eduportal_remita_accp_payment_data",array("rrr"=>$payment_code))->row();//ACP
			if($invoiceInfo){
				$page_data['payment_session'] = $invoiceInfo->session;
				$page_data['payment_level'] = "HND I";
				$page_data['semester'] = "First";
				$page_data['payment_fee_type'] = 1;
				$page_data['OldRegNo'] = $invoiceInfo->putme_id;
			}
			else{
				$invoiceInfo = $this->db->get_where("eduportal_remita_temp_data",array("rrr"=>$payment_code))->row();//Sch Fees
				if($invoiceInfo){
					$page_data['payment_session'] = $invoiceInfo->session;
					$page_data['payment_level'] = $invoiceInfo->level;
					$page_data['semester'] = "First";
					$page_data['payment_fee_type'] = 2;
					$page_data['OldRegNo'] = $invoiceInfo->reg_no;
				}
				else{
					$invoiceInfo = $this->db->get_where("invoice_gen",array("rrr"=>$payment_code))->row();//Sch Fees
					$page_data['payment_session'] = $invoiceInfo->session_id;
					$page_data['payment_level'] = $invoiceInfo->level;
					$page_data['semester'] = $info->semester;
					$page_data['payment_fee_type'] = 2;
					$page_data['OldRegNo'] = $invoiceInfo->portal_id;
				}
			}
			$page_data['page_name']  = 'syncInfo_fpno';
			$page_data['student_id'] = $student_id; 
			$page_data['payment_code'] = $payment_code;
			$page_data['payment_amount'] = $data->amount;
			$page_data['payment_date'] = $data->trans_date;
			$page_data['student_name'] = $data->payer_name;
			$page_data['payment_status'] = "F";
			$page_data['page_title'] = get_phrase('Student Account');
			$page_data['page_sub_heading'] ="Student Profile : Sync Results ";
			$this->load->view('backend/student_acct_print', $page_data);
		}	
		else{//Navigate to other tables on same site: Etz
			redirect(base_url()."index.php?student_acct/pro_sync_fee_etz/".$payment_code."/".$student_id);
		}	
	}
	function pro_sync_fee_etz($payment_code,$student_id){//Etz
		$data = $this->db->get_where("nekede_etranzact_payment",array("confirm_code"=>$payment_code))->row();
		if($data){
			$page_data['payment_session'] = $data->session;
			$page_data['payment_level'] = $data->level;
			$page_data['semester'] = "First";
			
			$desc = $data->description;
			if(strpos($desc, 'ACCEPTANCE') !== false){
				$page_data['payment_fee_type'] = 1;	
			}
			elseif(strpos($desc, 'SCH') !== false){
				$page_data['payment_fee_type'] = 2;	
			}
			
			elseif(strpos($desc, 'TEDC') !== false){
				$page_data['payment_fee_type'] = 3;	
			}
			elseif(strpos($desc, 'MICROSOFT') !== false){
				$page_data['payment_fee_type'] = 4;	
			}
			
			$page_data['OldRegNo'] = $data->portal_id;
			
			$page_data['page_name']  = 'syncInfo_fpno';
			$page_data['student_id'] = $student_id; 
			$page_data['payment_code'] = $payment_code;
			$page_data['payment_amount'] = $data->amount;
			$page_data['payment_date'] = $data->payment_confirmation_date;
			$page_data['student_name'] = $data->fullname;
			$page_data['payment_status'] = "E";
			
			$page_data['page_title'] = get_phrase('Student Account');
			$page_data['page_sub_heading'] ="Student Profile : Sync Results ";
			$this->load->view('backend/student_acct_print', $page_data);
		}	
		else{//Navigate to other tables on same site: Etz
		?>
        <script language="javascript">
		alert("No record");
		window.location.href="<?php echo base_url()."index.php?student_acct/studentProfile/".$student_id;?>";
		</script>
        <?php
		}	
	}
	function sch_feeSch(){
		$page_data['page_name']  = 'sch_feeSch'; 
		$page_data['page_title'] = get_phrase('Student Account');
		$page_data['page_sub_heading'] ="Student Account : School Fee Schedule ";
		$this->load->view('backend/student_acct_print', $page_data);
	}
	
	function terminate(){
		session_destroy();
		?>
           <script language="javascript">
		alert("Good bye!");
		window.location.href="<?php echo base_url();?>index.php?student_acct/index";
		</script>
            <?php	
	}
}


