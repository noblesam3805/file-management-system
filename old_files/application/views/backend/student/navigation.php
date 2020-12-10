<?php $student= $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$account_status=$student->status;

?>
<script type="text/javascript">
	/*function acc(){
		alert('Accommodation have been disabled for now. Please Check Later.');
	}*/
	$(document).ready(function(){
	    //$('[data-toggle="tooltip"]').tooltip(); 
	});
</script>

<div class="sidebar-menu">
		<header class="logo-env" style="padding-bottom:10px;">
			
            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>">
					<img src="assets/images/eduportal.png"  style="max-height:60px;"/>
				</a>
				<div style="text-align:center; margin-top:15px;">
					<a href="<?php echo base_url();?>">
                    
						<img src="<?php 
						if($account_status=="2")
						{
						echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; 
						}
						else
						{
							echo 'uploads/user.jpg'; 
						}
						?>" style="border-radius:50px; padding:2px; width:50px; height:50px; float:left; margin-right:7px; margin-left:20px;" />
						<span style="color:#e5e5e5; text-align:left; float:left; margin-top:3px; font-size:15px;"><b>
							<?php
								echo ucwords(strtolower($this->session->userdata('oname')));
							?></b><br />
							<?php 
						if($account_status=="2")
						{?>
                            Student
                            <?php } else {?> Guest Account<?php }?>
							
						</span>
					</a>
					
				</div>
				
			</div>
            
			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
                
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		
		<div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            
           
           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('Dashboard');?></span>
				</a>
           </li>
           
           
            
           <!-- TEACHER ->
           <li class="<?php if($page_name == 'teacher' )echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/teacher_list">
					<i class="entypo-users"></i>
					<span><?php echo get_phrase('_course_lecturer');?></span>
				</a>
           </li-->
            
           
            
           <!-- SUBJECT -->
           <?php if($check){ ?>
           <!-- <li class="<?php if($page_name == 'add_courses' ||
		   								$page_name == 'print_courses')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-docs"></i>
					<span><?php echo get_phrase('Course Management');?></span>
				</a>
                <ul>

					<!--li class="<?php if($page_name == 'add_courses')echo 'active';?> ">
				        <a target="_blank" href="<?php if($status == '0'){
				        	echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile
				        	<?php }
				        	else{echo base_url();?>index.php?<?php echo $account_type;?>/course_management <?php } ?>" 
				        	data-toggle="tooltip" data-placement="top" title="Available for only first year students">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Add Courses');?></span>
						</a>
					</li-->

					<li class="<?php if($page_name == 'manage_courses')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_courses">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Manage Courses');?></span>
						</a>
					</li>

                    <!--li class="<?php if($page_name == 'print_courses')echo 'active';?> ">
				        <a href="#">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Reprint Courses');?></span>
						</a>
					</li-->
                </ul>
           </li> -->
           <?php }?>
           
            
           <!-- CLASS ROUTINE >
           <li class="<?php if($page_name == 'class_routine')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/class_routine">
					<i class="entypo-target"></i>
					<span><?php echo get_phrase('class_routine');?></span>
				</a>
           </li-->
            
           <!-- EXAMS ->
           <li class="<?php if($page_name == 'exam' ||
		   								$page_name == 'grade' ||
												$page_name == 'marks')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('exam');?></span>
				</a>
                <ul>

					<li class="<?php if($page_name == 'marks')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/marks">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks');?></span>
						</a>
					</li>
                </ul>
           </li-->
           
           <!-- PAYMENT -->
           <?php 
						if($account_status=="2")
						{?>
                        
           
        
           <!-- ADMISSIONS FEE PAYMENT -->             
           <li class="<?php if($page_name == 'print_admissions_letter')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('Admissions');?></span>
				</a>
                <ul>

					

					<li class="<?php if($page_name == 'print_admissions_letter')echo 'active';?> ">
				        <a href="#">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Reprint Admission Letter');?></span>
						</a>
					</li>

                </ul>
           </li>
           <!-- Acceptance FEE PAYMENT -->             
           <li class="<?php if($page_name == 'generate_acp_fee_invoice' ||
		   							$page_name == 'pay_acp_fees')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('Acceptance_Fees');?></span>
				</a>
                <ul>

					<!--<li class="<?php if($page_name == 'generate_acp_fee_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/generate_acp_fee_invoice">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Get Acceptance Invoice');?></span>
						</a>
					</li>
-->
					<li class="<?php if($page_name == 'pay_acp_fees')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/pay_acp_fees">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Print Acceptance Fee Receipt');?></span>
						</a>
					</li>

                  
                </ul>
           </li>
           <!-- SCHOOL FEE PAYMENT -->             
           <li class="<?php if($page_name == 'generate_sch_fee_invoice' ||
		   							$page_name == 'pay_sch_fee' ||
		   								$page_name == 'generate_pid')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('School_Fees');?></span>
				</a>
                <ul>

					<li class="<?php if($page_name == 'generate_sch_fee_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/generate_sch_fee_invoice">
							<span><i class="entypo-dot"></i> <?php echo  get_phrase('Get School Fee Invoice');?></span>
						</a>
					</li>

				<li class="<?php if($page_name == 'pay_fees')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/pay_fees">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Pay School Fee');?></span>
						</a>
					</li>

                    <!--li class="<?php if($page_name == 'm_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/m_invoice">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('old_etranzact');?></span>
						</a>
					</li-->
                </ul>
           </li>
           


           
           <?php }
		   // OTHER INCOME FEES
		   ?>
		   
		    <li class="<?php if($page_name == 'other_income_fee_invoice' ||
		   							$page_name == 'pay_other_income_fee_invoice' ||
		   								$page_name == 'generate_other_fees_invoice')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('Other_Fees');?></span>
				</a>
                <ul>

					<li class="<?php if($page_name == 'generate_other_fees_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/generate_other_fees_invoice">
							<span><i class="entypo-dot"></i> <?php echo  get_phrase('Get Invoice');?></span>
						</a>
					</li>

				<li class="<?php if($page_name == 'pay_other_income_fee_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/pay_other_income_fee_invoice">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Pay_Other_Fees');?></span>
						</a>
					</li>

                    <!--li class="<?php if($page_name == 'm_invoice')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/m_invoice">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('old_etranzact');?></span>
						</a>
					</li-->
                </ul>
           </li>
		   
		   
           <!--li class="<?php if($page_name == 'invoice')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/invoice">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('Manage_payment');?></span>
				</a>
           </li-->

           <!-- ACCOMMODATION -->
           <?php if($check){ ?>
         <!--  <li class="<?php if($page_name == 'accommodation')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/hostel">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('accommodation');?></span>
				</a>
           </li>-->
           <?php }?>
		   
		   
            
           <!-- LIBRARY>
           <li class="<?php if($page_name == 'book')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/book">
					<i class="entypo-book"></i>
					<span><?php echo get_phrase('library');?></span>
				</a>
           </li-->
            
           <!-- TRANSPORT >
           <li class="<?php if($page_name == 'transport')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/transport">
					<i class="entypo-location"></i>
					<span><?php echo get_phrase('transport');?></span>
				</a>
           </li-->
            
           <!-- NOTICEBOARD >
           <li class="<?php if($page_name == 'noticeboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/noticeboard">
					<i class="entypo-doc-text-inv"></i>
					<span><?php echo get_phrase('noticeboard');?></span>
				</a>
           </li-->
            
            <li class="<?php if($page_name == 'add_courses' ||
		   								$page_name == 'reprint_courses'||
										$page_name == 'manage_courses'
										
										)echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-docs"></i>
					<span><?php echo get_phrase('Course Management');?></span>
				</a>
                <ul>

					<!--li class="<?php if($page_name == 'add_courses')echo 'active';?> ">
				        <a target="_blank" href="<?php if($status == '0'){
				        	echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile
				        	<?php }
				        	else{echo base_url();?>index.php?<?php echo $account_type;?>/course_management <?php } ?>" 
				        	data-toggle="tooltip" data-placement="top" title="Available for only first year students">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Add Courses');?></span>
						</a>
					</li-->

					<!--li class="<?php if($page_name == 'manage_courses')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_courses">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Manage Courses');?></span>
						</a>
					</li-->
                    	<li class="<?php if($page_name == 'register_courses')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/register_courses">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Register Courses');?></span>
						</a>
					</li>

                    <li class="<?php if($page_name == 'reprint_courses')echo 'active';?> ">
				           <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/reprint_courses">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Reprint Registration Slip');?></span>
						</a>
					</li>
                </ul>
           </li>
		     <li class="<?php if($page_name == 'check_sessional_result')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-docs"></i>
					<span><?php echo get_phrase('Results');?></span>
				</a>
                <ul>

			

					<li class="<?php if($page_name == 'check_sessional_result')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/check_sessional_result">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Check Sessional Result');?></span>
						</a>
					</li>
                    	
                </ul>
           </li>
		   <!-- Time Table -->
		        <li class="<?php if($page_name == '')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-docs"></i>
					<span><?php echo get_phrase('Time Table');?></span>
				</a>
                <ul>

			

					<li class="<?php if($page_name == 'check_sessional_result')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/#">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View Lecture Time-Table');?></span>
						</a>
					</li>
                    	
                </ul>
           </li>
		     <!-- Time Table -->
		        <li class="<?php if($page_name == '')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-docs"></i>
					<span><?php echo get_phrase('Assignments');?></span>
				</a>
                <ul>

			

					<li class="<?php if($page_name == 'check_sessional_result')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/#">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View Lecture Assigments');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'check_sessional_result')echo 'active';?> ">
				        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/#">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View Course Materials');?></span>
						</a>
					</li>
                    	
                </ul>
           </li>
		   <!-- View all payments -->
           <li class="<?php if($page_name == 'viewAllPayments')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/viewAllPayments/<?php echo $this->session->userdata('student_id'); ?>">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('View All Payments');?></span>
				</a>
           </li>
           <!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('account');?></span>
				</a>
           </li>

           
           
		</ul>
        		
</div>
<script type="text/javascript">
	/*function acc(){
		alert('Accommodation have been disabled for now. Please Check Later.');
	}*/
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip(); 
	});
</script>