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


