<?php $student= $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$account_status=$student->status;

?>
<style type="text/css">
	
</style>
<div class="row">
	<div class="eduportal-topbar-wrap">
		<div class="col-md-9" style="padding-top:10px;">
			<h3 style="font-weight:normal; margin:0px;"><?php echo $system_name;?></h3>
		</div>
		<!-- Raw Links -->
		<div class="col-md-3 user-detail" style="padding-top:7px;">
			
			<ul class="list-inline">
			<!-- Language Selector -->			
			   <li class="dropdown language-selector">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<img src="<?php if($this->session->userdata('login_type') == 'student'){
								
						if($account_status=="2")
						{
						echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; 
						}
						else
						{
							echo 'uploads/user.jpg'; 
						}
					
								}else{echo 'assets/images/default.png';} ?>" style="width:30px; height:30px; border-radius:50px;" /> <?php 
								//if($this->session->userdata('login_type') == 'student'){

								//}
								//echo $this->session->userdata('login_type');
								if($this->session->userdata('login_type') == 'student'){
									echo ' &nbsp; ' . ucwords(strtolower($this->session->userdata('name')));
								}
								if($this->session->userdata('login_type') == 'admin'){
									echo ' &nbsp; Super Admin';
								}
								if($this->session->userdata('login_type') == 'sadmin'){
									echo ucwords($this->session->userdata('name'));
								}

								?>
						</a>
					
					<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
						<?php if($this->session->userdata('login_type') == 'student'){ ?>
							<li>
								<a href="<?php echo base_url();?>index.php?student/my_profile">
									<i class="entypo-user"></i>
									<span><?php echo get_phrase('my_profile');?></span>
								</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
								<i class="entypo-info"></i>
								<span><?php echo get_phrase('edit_profile');?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
								<i class="entypo-key"></i>
								<span><?php echo get_phrase('change_password');?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php?login/logout">
								<i class="entypo-logout right"></i>
								<span><?php echo get_phrase('log_out'); ?></span> 
							</a>
						</li>
					</ul>
				
			</ul>
			
			
			<ul class="list-inline pull-right">
				
			
			
		</ul>
		</div>
		
	</div>
</div>