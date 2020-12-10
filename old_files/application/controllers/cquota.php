<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
     session_start();
/*
 *  @author : Emmanuel Etti
 *  @contributor : Sunday Okoi
 *  18th January, 2015
 *  Eduportal
 *  www.autopathgrp.com
 *
 */


class Cquota extends CI_Controller
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
    public function begin()  {
		$this->load->model("site_model");
		session_start();
		if(isset($_SESSION['cafeUser'])){
		redirect(base_url()."index.php?cquota/verified");
		
     }
	 else{
		$page_data['page_name']  = 'auth'; 
	
		$page_data['page_title'] = get_phrase('QUOTA: Login');
		$page_data['page_sub_heading'] ="QUOTA: Login";
		$this->load->view('backend/cquota_print', $page_data); 
	}
		

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
		window.location.href="<?php echo base_url();?>index.php?cquota/begin";
		</script>
            <?php
			}
			else{
				$password = md5($pword).sha1($pword);
				$valid1 = "SELECT * from quota_users where auth_one =? and auth_two =?";
				//$valid2 = "SELECT * from admin_users where auth_two =?";
				$q1 = $this->db->query($valid1,array($uname,$password));	
				
				if($q1->num_rows()>0){
					session_start();
				
					foreach($q1->result() as $info){
						if($info->status==0){
							?>
								   <script language="javascript">
                                alert("Your account is blocked. Contact the system Admin.");
                                window.location.href="<?php echo base_url();?>index.php?cquota/begin";
                                </script>
            <?php
						}
						else{
							$_SESSION['cafeUserCat'] = $info->cat;	//Category
							$_SESSION['cafeUser']= $info->auth_one;//User Name
							$_SESSION['cafeUserQid'] = $info->qid;//User ID
							$_SESSION["cafeQuota"] = $info->quotaNo;//Default quota
							//Redirects to Account status check
							redirect(base_url()."index.php?cquota/verified");
						}
					}
					
		
    		 	}
				else{
				?>
           <script language="javascript">
		alert("Invalid account combinations");
		window.location.href="<?php echo base_url();?>index.php?cquota/begin";
		</script>
            <?php	
				}
			}
		
			
	}
	
	function verified(){
		$page_data['page_name']  = 'cquota'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="Welcome ";
		$this->load->view('backend/cquota_print', $page_data); 
		
	}
	
	
	function pro_new_record(){
		$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	session_start();
	if(isset($_SESSION['cafeUser'])){
	$DefaultQuota = $this->db->get_where("quota_users",array("qid"=>$_SESSION['cafeUserQid']))->row()->quotaNo;
			//Check Available Quota
			$quotaRec = $this->db->where("qid",$_SESSION['cafeUserQid'])
							->where("status",0)
							->get("quota_users_actv");
			$quota = $quotaRec->num_rows();
			$quota = $DefaultQuota - $quota;
			if($quota==0 || $quota<0){
				?>
			   <script language="javascript">
			alert("You have exhausted your quota! Contact the Admin ");
			window.location.href="<?php echo base_url();?>index.php?cquota/begin";
			</script>
				<?php
			}
			else{
				
				$this->form_validation->set_rules('regno', 'Registration Number', 'required');
				$this->form_validation->set_rules('surname', 'Surname', 'required');
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('middlename', 'Middle Name', 'required');
				$this->form_validation->set_rules('dept_id', 'Department', 'required');
				$this->form_validation->set_rules('school_id', 'School', 'required');
				$this->form_validation->set_rules('student_type_id', 'Student Type', 'required');
				$this->form_validation->set_rules('programme_type_id', 'Progam', 'required');
				$this->form_validation->set_rules('level', 'Level', 'required');
				
				if ($this->form_validation->run() == FALSE){
				?>
			   <script language="javascript">
			alert("All fields are compulsory. Amend and continue");
			window.location.href="<?php echo base_url();?>index.php?cquota/begin";
			</script>
				<?php
				}
				else{
					$regno = $this->input->post('regno');
					$surname = $this->input->post('surname');
					$firstname = $this->input->post('firstname');
					$middlename = $this->input->post('middlename');
					$dept_id = $this->input->post('dept_id');
					$school_id = $this->input->post('school_id');
					$student_type_id = $this->input->post('student_type_id');
					$programme_type_id = $this->input->post('programme_type_id');
					$level = $this->input->post('level');
					
					$dept = $this->db->get_where("department",array("deptID"=>$dept_id))->row()->deptName;
					$school = $this->db->get_where("faculty",array("faculty_id"=>$school_id))->row()->faculty_name;
					session_start();
						$_SESSION["targetReg"] = $regno;
						
					//Check for existing record
					//eduportal_students_record
					$check = $this->db->get_where("eduportal_students_record",array("regno"=>$regno))->row();
					
					//Nek fee adm fee tab
					 $feeAdm = $this->db->get_where("eduportal_admission_list",array("application_no"=>$regno))->row();
					if(!$check){
						$data['regno']= $regno;
						$data['surname']= $surname;
						$data['firstname']= $firstname;
						$data['middlename']= $middlename;
						$data['dept_id']= $dept_id;
						$data['school_id']= $school_id;
						$data['student_type_id']= $student_type_id;
						$data['programme_type_id']= $programme_type_id;
						$data['dept']= $dept;
						$data['school']= $school;
						$data['level']= $level;	
						
						$user['qid'] = $_SESSION['cafeUserQid'];
						$user['tag_data'] = $regno;
						$user['dy'] = date('d');
						$user['mt'] = date('m');
						$user['yr'] = date('Y');
						$user['trans_date'] = date("D, M d Y");
						$this->db->insert("eduportal_students_record",$data);
						$this->db->insert("quota_users_actv",$user);
					
					}
					if(!$feeAdm){
						if($student_type_id=1 and $level=="ND I"){
							$adm=array('application_no'=>$regno, 'surname'=>$surname, 'firstname'=>$firstname, 'middlename'=>$middlename, 'dept_id'=>$dept_id, 'school_id'=>$school_id, 'dept_option_id'=>0, 'student_type'=>$student_type_id, 'programme_type_id'=>$programme_type_id, 'session'=>"2017/2018", 'admissionlist_batch_id'=>1, 'activated'=>1, 'user_id'=>1, 'adm_type'=>1);
							$this->db->insert("eduportal_admission_list",$adm);
						}
					}
					redirect(base_url().'index.php?cquota/accDet');
				}
			}
		}
		else{
			?>
			   <script language="javascript">
			alert("Session Not Initialized!");
			window.location.href="<?php echo base_url();?>index.php?cquota/begin";
			</script>
				<?php
		}
	}
	
	function accDet(){
		$page_data['page_name']  = 'cquotaDet'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : Details ";
		$this->load->view('backend/cquota_print', $page_data); 	
	}
	function cquotaUsers(){
		$page_data['page_name']  = 'cquotaUsers'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : Users ";
		$this->load->view('backend/cquota_print', $page_data);
	}
	function cquotaUsers2(){
		$page_data['page_name']  = 'cquotaUsers2'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : Users ";
		$this->load->view('backend/cquota_print', $page_data);
	}
	function reports(){
		$page_data['page_name']  = 'reports'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : report ";
		$this->load->view('backend/cquota_print', $page_data);
	}
	function reports2(){
		$page_data['page_name']  = 'reports2'; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : report ";
		$this->load->view('backend/cquota_print', $page_data);
	}
	
	function accountStatus($status,$qid){
		$upd["status"] = $status;
		$this->db->where("qid",$qid)->update("quota_users",$upd);
		redirect(base_url().'index.php?cquota/cquotaUsers');
	}
	function remittance($qid){
		$page_data['page_name']  = 'remittance';
		$page_data['qid'] = $qid; 
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : Remittance ";
		$this->load->view('backend/cquota_print', $page_data);
	}
	function pro_remit($qid,$trans_dateID,$number){
		//getting date if trans_dateID
		$trans_date = $this->db->get_where("quota_users_actv",array("aid"=>$trans_dateID))->row()->trans_date;
		$row = " rows";
		$Rec2 = $this->db->where("qid",$qid)
						->where("status",0)
						->where("trans_date",$trans_date)
						->order_by("aid")
						->limit($number)
						->get("quota_users_actv");
		foreach($Rec2->result() as $data){
			$upd["status"] = 1;
			$this->db->where("aid",$data->aid)
			->update("quota_users_actv",$upd);	
		}
		if($number==1){
			$row = " row";	
		}
		echo $number.$row." affected. Refresh to get accurate report.";
	}
	
	function newUser(){
		if($_SESSION['cafeUserCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?cquota/terminate";
		</script>
            <?php	
		}
		$page_data['page_name']  = 'newUser';
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : New User ";
		$this->load->view('backend/cquota_print', $page_data);	
	}
	
	function newUser2(){
		if($_SESSION['cafeUserCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?cquota/terminate";
		</script>
            <?php	
		}
		$page_data['page_name']  = 'newUser2';
		$page_data['page_title'] = get_phrase('QUOTA');
		$page_data['page_sub_heading'] ="QUOTA : New User ";
		$this->load->view('backend/cquota_print', $page_data);	
	}
	
	function pro_newUser(){
		if($_SESSION['cafeUserCat']!=3){
			?>
           <script language="javascript">
		alert("Unauthorized!");
		window.location.href="<?php echo base_url();?>index.php?cquota/terminate";
		</script>
            <?php	
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('auth_one', 'User Name', 'required');
		$this->form_validation->set_rules('auth_two', 'Pass word', 'required');
		$this->form_validation->set_rules('quotaNo', 'Quota number', 'required');
		if ($this->form_validation->run() == FALSE){
			?>
           <script language="javascript">
		alert("All fields are compulsory. Amend and continue");
		window.location.href="<?php echo base_url();?>index.php?cquota/newUser";
		</script>
            <?php
			}
			else{
				$auth_one = $this->input->post('auth_one');
				$auth_two = $this->input->post('auth_two');
				$quotaNo = $this->input->post('quotaNo');
				$report = $this->input->post('report');
				if($report==1){
					$show = 2;	
				}
				else{
					$show = 1;	
				}
				$password = md5($auth_two).sha1($auth_two);
				//check for existing user
				$check = $this->db->get_where("quota_users",array("auth_one"=>$auth_one))->row();
				if($check){
					?>
           <script language="javascript">
		alert("User already exist");
		window.location.href="<?php echo base_url();?>index.php?cquota/newUser";
		</script>
            <?php
					
				}
				else{
					$data=array('auth_one'=>$auth_one, 'auth_two'=>$password,'quotaNo'=>$quotaNo, 'report'=>$report, 'shw'=>$show);
					$this->db->insert("quota_users",$data);
					$qid = $this->db->get_where("quota_users",array("auth_one"=>$auth_one))->row()->qid;
					
					?>
           <script language="javascript">
		alert("New User Created!");
		window.location.href="<?php echo base_url();?>index.php?cquota/cquotaUsers#<?php echo $qid;?>";
		</script>
            <?php	
				}
			}
		
	}
	
	//Increase quota
	function increaseQuota($qid,$quotaNo){
		$upd["quotaNo"] = $quotaNo + 1;
		$this->db->where("qid",$qid)
		->update("quota_users",$upd);
		$Tquota = $this->db->get_where("quota_users",array("qid"=>$qid))->row()->quotaNo;
		//Quota info
							$quotaRec = $this->db->where("qid",$qid)
						->where("status",0)
						->get("quota_users_actv");
		$quota = $quotaRec->num_rows();
		$Aquota = ($quotaNo + 1) - $quota."/".($quotaNo + 1);
		
		?>
        <table width="100%">
					        <tr>
					          <td width="49%" valign="top"><?php echo $Aquota;?></td>
					          <td width="51%" align="right" valign="top"><input type="submit" name="add" id="<?php echo $qid;?>" value="+" onclick="incrQuota(this.id);" />
					            <input type="submit" name="decr" id="<?php echo $qid;?>" value="-" onclick="decrQuota(this.id);"/>
<input name="hiddenField" type="hidden" id="quotaNo<?php echo $qid;?>" value="<?php echo $Tquota;?>" /></td>
				            </tr>
					        </table>
        
        <?php
		
	}
	
	//Decrease quota
	 	function decreaseQuota($qid,$quotaNo){
		$upd["quotaNo"] = $quotaNo - 1;
		$this->db->where("qid",$qid)
		->update("quota_users",$upd);
		$Tquota = $this->db->get_where("quota_users",array("qid"=>$qid))->row()->quotaNo;
		//Quota info
							$quotaRec = $this->db->where("qid",$qid)
						->where("status",0)
						->get("quota_users_actv");
		$quota = $quotaRec->num_rows();
		$Aquota = $Tquota - $quota."/".$Tquota;
		
		?>
        <table width="100%">
					        <tr>
					          <td width="49%" valign="top"><?php echo $Aquota;?></td>
					          <td width="51%" align="right" valign="top"><input type="submit" name="add" id="<?php echo $qid;?>" value="+" onclick="incrQuota(this.id);" />
					            <input type="submit" name="decr" id="<?php echo $qid;?>" value="-" onclick="decrQuota(this.id);"/>
<input name="hiddenField" type="hidden" id="quotaNo<?php echo $qid;?>" value="<?php echo $Tquota;?>" /></td>
				            </tr>
					        </table>
        <?php
		
	}

	function terminate(){
		session_destroy();
		?>
           <script language="javascript">
		alert("Good bye!");
		window.location.href="<?php echo base_url();?>index.php?cquota/begin";
		</script>
            <?php	
	}
}


