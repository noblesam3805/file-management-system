<div class="sidebar-menu">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>">
				<img src="assets/images/eduportal.png"  style="max-height:60px;"/>
				</a>
				<div style="text-align:center; margin-top:15px;">
					<a href="">
						<img src="assets/images/default.png" style="border-radius:100px; width:80px; height:80px;" />
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

			
			<?php if ($this->session->userdata('default_login') != 1){ ?>
			
           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?sadmin/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
           <?php if($this->session->userdata('level') == '3'  || $this->session->userdata('level') == '2'){?>
           <li class="">
				<a target="_blank" href="<?php echo base_url();?>index.php?sadmin/student_portal">
					<i class="entypo-doc-text-inv"></i>
					<span><?php echo get_phrase('_student_portal');?></span>
				</a>
			</li>
			<?php } ?>
            
            <!-- ADMISSIONS -->
			  <!-- ADMISSIONS -->
            <?php if($this->session->userdata('level') == '19' || $this->session->userdata('level') == '8'  ){?>
 		   <!-- TEACHER -->
            <li class="<?php if($page_name == 'upload_adm_list' ||
            						   $page_name == 'view_adm_list' ||
            						   $page_name == 'screen_students' ||
            						   $page_name == 'view_screened_students')
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-graduation-cap"></i>
 					<span><?php echo get_phrase('Admissions');?></span>
 				</a>
 				<ul>

                	
 					<li class="<?php if($page_name == 'upload_adm_list')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/upload_adm_list">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('upload admission list');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_adm_list')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/view_adm_list">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view admission list');?></span>
     				    </a>
                     </li>
				

                 

 				</ul>
 			</li>
			<li class="<?php if($page_name == 'view_applicants_report_by_department' ||
           						   $page_name == 'view_cbt_schedule' ||
           						   $page_name == 'add_institution' ||
           						   $page_name == 'view_institutions' ||
           						   $page_name == 'view_applicants_results_by_dept')
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('Application_Forms');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'view_cbt_schedule')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_cbt_schedule">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_cbt_schedule');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_applicants_results_by_dept')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_applicants_results_by_dept">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicants_results_by_dept');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_applicants_results_by_dept_two')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_applicants_results_by_dept_two">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicants__CBT_less_than_12');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_applicants_results_by_low_age')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_applicants_results_by_low_age">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicants_age_less_than_16');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'view_applicants_results_by_dept_change_of_course')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_applicants_results_by_dept_change_of_course">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicants_change_of_course');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_applicants_results_by_dept_corrections')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_applicants_results_by_dept_corrections">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicants_corrections_list');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_process_applicant_hnd')echo 'active';?> ">
    				     <a href="<?php echo base_url();?>index.php?sadmin/view_process_applicant_hnd">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_applicant_hnd');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_applicants_report_by_department')echo 'active';?> ">
    				    <a href="http://45.34.15.68/application/admissions/view_putme_hndscreening_applicants_page" target="_blank">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('View Applicants by Department');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_unadmitted_applicants_report_by_department')echo 'active';?> ">
    				    <a href="http://45.34.15.68/application/admissions/view_unadmitted_applicants_page" target="_blank">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('View Unadmitted Applicants by Department');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'add_institution')echo 'active';?> ">
    				   <a href="<?php echo base_url();?>index.php?sadmin/add_institution">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('add_institution');?></span>
    				    </a>
                    </li>
				
				
				<li class="<?php if($page_name == 'view_institutions')echo 'active';?> ">
    				   <a href="<?php echo base_url();?>index.php?sadmin/view_institutions">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_institutions');?></span>
    				    </a>
                    </li>
				
				

                 

				</ul>
			</li>
			<?php }?>
           <?php if($this->session->userdata('level') == '8' ){?>
		   <!-- TEACHER -->
         
			 <li class="<?php if($page_name == 'feesetup' || $page_name== 'manage_sch_fee_invoice'|| $page_name== 'manage_acp_fee_invoice'|| $page_name== 'manage_appform_fee_invoice')
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('School Fees');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'feesetup')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/feesetup">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('set_up_fee_schedule');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'manage_sch_fee_invoice')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/manage_sch_fee_invoice">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('manage_sch_fee_invoice');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'manage_acp_fee_invoice')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/manage_acp_fee_invoice">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('manage_acp_fee_invoice');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'manage_appform_fee_invoice')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/manage_appform_fee_invoice">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('manage_appform_fee_invoice');?></span>
    				    </a>
                    </li>

                 

				</ul>
			</li>
		
	
            <?php }?>
<?php if($this->session->userdata('level') == '8' ){?>
			<!-- STUDENT -->			
			<li class="<?php if($page_name == 'student_add' ||
				$page_name == 'student_bulk_add' ||
					$page_name == 'student_information' ||
					  $page_name == 'student_report' ||
					  $page_name == 'student_data' ||
					  $page_name == 'student_report_prog' ||
					  $page_name == 'login_details' ||
					  $page_name == 'nce_students' ||
					  $page_name == 'update_record' ||
					  $page_name == 'export_student' ||
					   $page_name == 'degree_students' ||
					   $page_name == 'send_bulk_sms' || $page_name == 'view_student_database_default' ||
						$page_name == 'upload_students_norminal_role')
							echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="fa fa-group"></i>
					<span>&nbsp; <?php echo get_phrase('student Report');?></span>
				</a>
				<ul>
                	<!-- STUDENT ADMISSION >
					<li class="<?php if($page_name == 'student_add')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/student_add">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student');?></span>
						</a>
					</li-->

                	<!-- STUDENT BULK ADMISSION -->
					

               
				

                
                   

                 
					
				
					
                    <li class="<?php if($page_name == 'login_details')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/login_details">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Student_login_details');?></span>
						</a>
					</li>
					
					   <li class="<?php if($page_name == 'view_student_database_default')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_student_database_default">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View_Students_Record');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'export_student')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/export_student">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Export Student Data');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'send_bulk_sms')echo 'send_bulk_sms';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/send_bulk_sms">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('send_bulk_sms');?></span>
						</a>
					</li>
				

                    

				</ul>
			</li>	<?php } ?>
            
           <!-- STAFF -->
           <?php if($this->session->userdata('level') == '8' ){?>
		   <!-- TEACHER -->
         
			
			<!-- STAFF -->
        
		   <!-- TEACHER -->
           <li class="<?php if($page_name == 'view_lecturer_list' ||
           						   $page_name == 'upload_lecturer_data' ||
           						     $page_name == 'teacher' ||
           						       $page_name == 'degree_staff' ||
									     $page_name == 'nce_staff')
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('Lecturer');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'view_lecturer_list')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_lecturer_list">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('View All Lecturers');?></span>
    				    </a>
                    </li>
					
						<li class="<?php if($page_name == 'upload_lecturer_data')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/upload_lecturer_data">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Upload Lecturer Records');?></span>
    				    </a>
                    </li>
					

				</ul>
			</li>

           <!-- USERS -->
           <!--li class="<?php if($page_name == 'users' )echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?sadmin/users">
					<i class="entypo-user"></i>
					<span><?php echo get_phrase('Users');?></span>
				</a>
           </li-->
           <?php } ?>
		   
		   <!-- Academics -->
		   <?php //if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
		   
		   <?php if($this->session->userdata('hostel_allocation') ==2){ ?>
			<li class="<?php if($page_name == 'grading_system' ||
           						   $page_name == 'student_reg' ||
           						   $page_name == 'add_grade' ||
									$page_name == 'credit_load' ||
									$page_name == 'courses')
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('Academics');?></span>
				</a>
				<ul>

                	<!-- Grading System -->
                	<?php if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
					<li class="<?php if($page_name == 'grading_system')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/grading">
							<span><i class="entypo-dot"></i><?php echo get_phrase('_view_grades');?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'add_grade')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/gradeOptions/add">
							<span><i class="entypo-dot"></i><?php echo get_phrase('_add_grade');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'credit_load')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/credit_load">
							<span><i class="entypo-dot"></i><?php echo get_phrase('_credit_load');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'student_reg')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/student_reg">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Student Reg');?></span>
						</a>
					</li>
					<?php } ?>
					<li class="<?php if($page_name == 'courses')echo 'active';?> ">
						<a target="_blank" href="<?php echo base_url();?>index.php?sadmin/course_management">
							<i class="entypo-dot"></i>
							<span><?php echo get_phrase('_course_management');?></span>
						</a>
				   </li>
                    

				</ul>
			</li>
		   <?php } ?>
		   
			<!-- PUTME -->
			<?php if($this->session->userdata('level') == '3'){ ?>
		   <li class="<?php if($page_name == 'putme_registration_details' ||
           						   $page_name == 'putme_student_details' ||
								   $page_name == 'putme_student_album')
								echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-bell"></i>
					<span><?php echo get_phrase('Post Utme');?></span>
				</a>
				<ul>
					<li class="">
						<a href="">
							<span><i class="entypo-dot"></i><?php echo get_phrase('Start Registration');?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'putme_registration_details')echo 'active';?> ">
						<a href="<?php echo base_url() . 'index.php?sadmin/putme_registration_details'; ?>">
							<span><i class="entypo-dot"></i><?php echo get_phrase('Registration Details');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'putme_student_details')echo 'active';?> ">
						<a href="<?php echo base_url() . 'index.php?sadmin/putme_student_details' ?>">
							<span><i class="entypo-dot"></i><?php echo get_phrase('Student Details');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'putme_student_album')echo 'active';?> ">
						<a href="<?php echo base_url() . 'index.php?sadmin/putme_student_album' ?>">
							<span><i class="entypo-dot"></i><?php echo get_phrase('Student Album');?></span>
						</a>
					</li>
				</ul>
			</li>
			<?php } ?>
		   

			
            
            
            <!-- Course Registration -->
            		<?php if($this->session->userdata('level') == '5' || $this->session->userdata('level') == '8' ){?>
		   <li class="<?php if($page_name == 'upload_courses' ||
           						   $page_name == 'edit_courses' ||
									$page_name == 'assign_course_to_dept' ||
									$page_name == 'assign_credit_load' ||
									$page_name == 'assign_course_to_lecturer' ||
									$page_name == 'approve_registered_courses' ||
									$page_name == 'courses_assignment_report'
									||
								
																		$page_name == 'approve_stduent_courses'||
								
																		$page_name == 'courses_registration_status'||
								
																		$page_name == 'courses_registration_backend'
																		|| $page_name == 'view_courses_registered' 
									)
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Course Reg.');?></span>
				</a>
				<ul>

                	<!-- Live Etranzact -->
					<li class="<?php if($page_name == 'upload_courses')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/upload_courses">
    				    	<span><i class="entypo-dot"></i><?php echo "Upload Courses";?></span>
    				    </a>
                    </li>
                    
                    
                	
                    <li class="<?php if($page_name == 'assign_course_to_dept')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_dept">
							<span><i class="entypo-dot"></i> <?php echo "Assign Course To Dept.";?></span>
						</a>
					</li>
                    
                       <li class="<?php if($page_name == 'assign_credit_load')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_credit_load">
							<span><i class="entypo-dot"></i> <?php echo "Assign  Credit Load";?></span>
						</a>
					</li>
                    
                     <li class="<?php if($page_name == 'assign_course_to_lecturer')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_lecturer">
							<span><i class="entypo-dot"></i> <?php echo "Assign Course To Lecturer";?></span>
						</a>
					</li>
                    
                     <li class="<?php if($page_name == 'approve_registered_courses')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_registered_courses">
							<span><i class="entypo-dot"></i> <?php echo "Approve Registered Courses";?></span>
						</a>
					</li>
					 <li class="<?php if($page_name == 'approve_stduent_courses')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_stduent_courses">
							<span><i class="entypo-dot"></i> <?php echo "Bulk Approve Registered Courses";?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'view_courses_registered')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_courses_registered">
							<span><i class="entypo-dot"></i> <?php echo "View Student's Course Registration";?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'courses_registration_status')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/courses_registration_status/1">
							<span><i class="entypo-dot"></i> <?php echo "Course Registration Status";?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'courses_registration_backend')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/courses_registration_backend">
							<span><i class="entypo-dot"></i> <?php echo "Backend Course Registration";?></span>
						</a>
					</li>
					<!--<li class="<?php if($page_name == 'courses_assignment_report')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/courses_assignment_report">
							<span><i class="entypo-dot"></i> <?php echo "Course Assignment Report";?></span>
						</a>
					</li>-->
                    
            

				</ul>
			</li>
			<?php } ?>
            
             <!-- Course Registration -->
            		<?php if($this->session->userdata('level') == '7' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'assign_course_to_dept' ||
									$page_name == 'assign_credit_load' ||
								
									$page_name == 'approve_registered_courses')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Courses');?></span>
				</a>
				<ul>

        
                    
                    
                	
                    <li class="<?php if($page_name == 'assign_course_to_dept')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_dept">
							<span><i class="entypo-dot"></i> <?php echo "Assign Course To Dept.";?></span>
						</a>
					</li>
                    
                      
                    
                  
                    
                     <li class="<?php if($page_name == 'approve_registered_courses')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_registered_courses">
							<span><i class="entypo-dot"></i> <?php echo "Approve Registered Courses";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			<?php } ?>
			
			     <!-- Admissions Screening -->
				 	<?php if($this->session->userdata('level') == '8' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'screen_students' ||
									$page_name == 'view_screened_students' ||
								
									$page_name == 'view_screened_succesful_students')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Screening Options');?></span>
				</a>
				<ul>

        
                    
                    
                
                    
                      
                    
                  
                    
                     <li class="<?php if($page_name == 'view_screened_students')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_screened_students">
							<span><i class="entypo-dot"></i> <?php echo "View Screened Applicants";?></span>
						</a>
					</li>
                     <li class="<?php if($page_name == 'view_screened_succesful_students')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_screened_succesful_students">
							<span><i class="entypo-dot"></i> <?php echo "View Successful Applicants";?></span>
						</a>
					</li>
					
					 <li class="<?php if($page_name == 'verify_olevel_result')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/verify_olevel_result">
							<span><i class="entypo-dot"></i> <?php echo "Verify O'Level Results";?></span>
						</a>
					</li>
                 

				</ul>
			</li>
			<?php } ?>
            		<?php if($this->session->userdata('level') == '12' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'screen_applicants' ||
									$page_name == 'view_screened_applicants' ||
								
									$page_name == 'view_invoice_applicants_info' ||
								
									$page_name == 'view_screened_applicants_failed' ||
								
									$page_name == 'verify_olevel_result' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Screening Options');?></span>
				</a>
				<ul>

        
                    
                    
                	
                    <li class="<?php if($page_name == 'screen_applicants')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/screen_applicants">
							<span><i class="entypo-dot"></i> <?php echo "Screen Applicants";?></span>
						</a>
					</li>
                    
                      
                    
                  
                    
                     <li class="<?php if($page_name == 'view_screened_applicants')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_screened_applicants">
							<span><i class="entypo-dot"></i> <?php echo "View Screened Applicants";?></span>
						</a>
					</li>
					 <li class="<?php if($page_name == 'view_screened_applicants_failed')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_screened_applicants_failed">
							<span><i class="entypo-dot"></i> <?php echo "View Failed Applicants";?></span>
						</a>
					</li>
                   <!--  <li class="<?php if($page_name == 'view_screened_succesful_students')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_screened_succesful_students">
							<span><i class="entypo-dot"></i> <?php echo "View Successful Applicants";?></span>
						</a>
					</li>-->
                 
 <li class="<?php if($page_name == 'verify_olevel_result')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/verify_olevel_result">
							<span><i class="entypo-dot"></i> <?php echo "Verify O'Level Results";?></span>
						</a>
					</li>
					 <li class="<?php if($page_name == 'view_invoice_applicants_info')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_invoice_applicants_info">
							<span><i class="entypo-dot"></i> <?php echo "View Applicants Invoice";?></span>
						</a>
					</li>
				
				</ul>
			</li>
			
			<?php } ?>
			
			<!--- Medical-->
			    		<?php if($this->session->userdata('level') == '13' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'assign_students_for_medical' ||
									$page_name == 'view_assigned_students_medical_default')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Medical');?></span>
				</a>
				<ul>

        
                    
                    
                	
                    <li class="<?php if($page_name == 'assign_students_for_medical')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_students_for_medical">
							<span><i class="entypo-dot"></i> <?php echo "Assign Students to Medical Facilty";?></span>
						</a>
					</li>
                    
                      
                    
                  
                    
                     <li class="<?php if($page_name == 'view_assigned_students_medical_default')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_assigned_students_medical_default">
							<span><i class="entypo-dot"></i> <?php echo "View Assigned Students";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			<?php } ?>
			
				    		<?php if($this->session->userdata('level') == '8' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'assign_students_for_medical' ||
									$page_name == 'view_assigned_students_medical_default')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Medical');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                     <li class="<?php if($page_name == 'view_assigned_students_medical_default')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_assigned_students_medical_default">
							<span><i class="entypo-dot"></i> <?php echo "View Assigned Students";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			--
			<?php } ?>
			<?php if($this->session->userdata('level') == '18' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'view_assigned_students_medical_xray' ||
									$page_name == 'view_assigned_students_medical')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Medical');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                     <li class="<?php if($page_name == 'view_assigned_students_medical_xray')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_assigned_students_medical_xray">
							<span><i class="entypo-dot"></i> <?php echo "View Assigned Students";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			<?php } ?>
			
			<?php if($this->session->userdata('level') == '17' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'view_assigned_students_medical_xray' ||
									$page_name == 'view_assigned_students_medical')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Medical');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                     <li class="<?php if($page_name == 'view_students_medical_xray_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_students_medical_xray_reports">
							<span><i class="entypo-dot"></i> <?php echo "View Student X-Ray Reports";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			<?php } ?>
			
			<!-- TIME TABLE -->
			   		<?php if($this->session->userdata('level') == '8' ){?>
		   <li class="<?php if(
           						  
									$page_name == '' ||
									$page_name == '')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Time Table');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                     <li class="<?php if($page_name == 'view_assigned_students')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/#">
							<span><i class="entypo-dot"></i> <?php echo "Assign Students Time Table";?></span>
						</a>
					</li>
                    
                 

				</ul>
			</li>
			<?php } ?>
			
	     <!-- MIS-->
	<?php if($this->session->userdata('level') == '16' ){?>
		   	<li class="<?php if($page_name == 'student_add' ||
				$page_name == 'student_bulk_add' ||
					$page_name == 'student_information' ||
					  $page_name == 'student_report' ||
					  $page_name == 'student_data' ||
					  $page_name == 'student_report_prog' ||
					  $page_name == 'login_details' ||
					  $page_name == 'nce_students' ||
					  $page_name == 'update_record' ||
					  $page_name == 'export_student' ||
					   $page_name == 'degree_students' ||
					   $page_name == 'send_bulk_sms' || $page_name == 'view_student_database_default' ||
						$page_name == 'upload_students_norminal_role')
							echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="fa fa-group"></i>
					<span>&nbsp; <?php echo get_phrase('student Report');?></span>
				</a>
				<ul>
                	<!-- STUDENT ADMISSION >
					<li class="<?php if($page_name == 'student_add')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/student_add">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student');?></span>
						</a>
					</li-->

                	<!-- STUDENT BULK ADMISSION -->
					

               
				

                
                   

                 
					
				  <li class="<?php if($page_name == 'assign_matric_no')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_matric_no">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('assign_matric_no');?></span>
						</a>
					</li>
					
                    <li class="<?php if($page_name == 'login_details')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/login_details">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Student_login_details');?></span>
						</a>
					</li>
					
					   <li class="<?php if($page_name == 'view_student_database_default')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_student_database_default">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View_Students_Record');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'export_student')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/export_student">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Export Student Data');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'send_bulk_sms')echo 'send_bulk_sms';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/send_bulk_sms">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('send_bulk_sms');?></span>
						</a>
					</li>
				

                    

				</ul>
			</li>
			<?php } ?>		
			
        <!-- ID CARD-->
	<?php if($this->session->userdata('level') == '14' ){?>
		   <li class="<?php if(
           						  
									
									$page_name == 'issue_id_cards')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('ID Card Management');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                     <li class="<?php if($page_name == 'issue_id_cards')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/issue_id_cards">
							<span><i class="entypo-dot"></i> <?php echo "Issue ID Cards";?></span>
						</a>
					</li>
                     <li class="<?php if($page_name == 'view_assigned_students_medical_id_card')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_assigned_students_medical_id_card">
							<span><i class="entypo-dot"></i> <?php echo "Cards Issued";?></span>
						</a>
					</li>
                 

				</ul>
			</li>
			<?php } ?>


<?php if($this->session->userdata('level') == '8' ){?>
		   <li class="<?php if(
           						  
									
									$page_name == 'view_assigned_students_medical_id_card')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('ID Card Management');?></span>
				</a>
				<ul>

        
                    
                   
                    
                  
                    
                    
                     <li class="<?php if($page_name == 'view_assigned_students_medical_id_card')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_assigned_students_medical_id_card">
							<span><i class="entypo-dot"></i> <?php echo "ID Cards Issued";?></span>
						</a>
					</li>
                 

				</ul>
			</li>
			<?php } ?>

		
				<?php if($this->session->userdata('level') == '10' ){?>
		   <li class="<?php if(
           						  
									$page_name == 'view_courses_registered' ||
									$page_name == 'upload_students_norminal_role' ||
									$page_name == 'assign_course_to_lecturer' ||
								
									$page_name == 'approve_stduent_courses'||
								
									$page_name == 'courses_registration_status'||
								
									$page_name == 'courses_registration_backend')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Courses');?></span>
				</a>
				<ul>

                    
                	 <li class="<?php if($page_name == 'approve_stduent_courses')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_stduent_courses">
							<span><i class="entypo-dot"></i> <?php echo "Bulk Approve Registered Courses";?></span>
						</a>
					</li>
                   	<li class="<?php if($page_name == 'upload_students_norminal_role')echo 'send_bulk_sms';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/upload_students_norminal_role">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('upload_students_norminal_role');?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'assign_course_to_lecturer')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_lecturer">
							<span><i class="entypo-dot"></i> <?php echo "Assign Course To Lecturer";?></span>
						</a>
					</li>
					
                    <li class="<?php if($page_name == 'view_courses_registered')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_courses_registered">
							<span><i class="entypo-dot"></i> <?php echo "View Student's Course Registration";?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'courses_registration_status')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/courses_registration_status">
							<span><i class="entypo-dot"></i> <?php echo "Course Registration Status";?></span>
						</a>
					</li>
                    <li class="<?php if($page_name == 'courses_registration_backend')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/courses_registration_backend">
							<span><i class="entypo-dot"></i> <?php echo "Backend Course Registration";?></span>
						</a>
					</li>

				</ul>
			</li>
			
			 <li class="<?php if($page_name == 'view_lecturer_list' ||
           						   $page_name == 'upload_lecturer_data' ||
           						     $page_name == 'teacher' ||
           						       $page_name == 'degree_staff' ||
									     $page_name == 'nce_staff')
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('User_Accounts');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'view_lecturer_list')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_lecturer_list">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('View All Users');?></span>
    				    </a>
                    </li>
					
						<li class="<?php if($page_name == 'upload_lecturer_data')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/upload_lecturer_data">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Upload Lecturer Records');?></span>
    				    </a>
                    </li>
					
					
					<li class="<?php if($page_name == 'add_new_user_account')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/add_new_user_account">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("create_new_user_account");?></span>
						</a>
					</li>
					
			
                    
                  
					

				</ul>
			</li>
			<?php } ?>
            
              <!-- Course Registration -->
            		<?php if($this->session->userdata('level') == '4'){?>
		   <li class="<?php if($page_name == 'download_class_sheet' ||
           						   $page_name == 'download_score_sheet')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Results');?></span>
				</a>
				<ul>

                	               
                     <li class="<?php if($page_name == 'download_class_sheet')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_lecturer">
							<span><i class="entypo-dot"></i> <?php echo "Download Class Sheet";?></span>
						</a>
					</li>
                    
                      <li class="<?php if($page_name == 'download_score_sheet')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_lecturer">
							<span><i class="entypo-dot"></i> <?php echo "Download Marks/Score Sheet";?></span>
						</a>
					</li>
                    
                      <li class="<?php if($page_name == 'upload_score_sheet')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/assign_course_to_lecturer">
							<span><i class="entypo-dot"></i> <?php echo "Upload Result Sheet";?></span>
						</a>
					</li>

				</ul>
			</li>
			<?php } ?>
            	<?php if($this->session->userdata('level') == '6'){?>
		   <li class="<?php if(
           						   $page_name == 'manage_lecturer_results' || $page_name == 'manage_lecturer_results'  )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Results');?></span>
				</a>
				<ul>

               
                    
                
                    
                      <li class="<?php if($page_name == 'manage_lecturer_results')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/manage_lecturer_results">
							<span><i class="entypo-dot"></i> <?php echo "Courses/Result Panel";?></span>
						</a>
					</li> 
					<li class="<?php if($page_name == '')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/#">
							<span><i class="entypo-dot"></i> <?php echo "Manage Assignments";?></span>
						</a>
					</li>
					<li class="<?php if($page_name == '')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/#">
							<span><i class="entypo-dot"></i> <?php echo "Manage Course Materials";?></span>
						</a>
					</li>
					

				</ul>
			</li>
			<?php } ?>
			<!-- HOD -->
			    <?php if($this->session->userdata('level') == '9'){?>
		   <li class="<?php if(
           						   $page_name == 'approve_lecturer_results' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Results');?></span>
				</a>
				<ul>

               
                    
                
                    
                      <li class="<?php if($page_name == 'approve_lecturer_results')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_lecturer_results">
							<span><i class="entypo-dot"></i> <?php echo "Approve Results";?></span>
						</a>
					</li>

				</ul>
			</li>
			
			<?php } ?>
<!-- HOD -->
			    <?php if($this->session->userdata('level') == '11'){?>
		   <li class="<?php if(
           						   $page_name == 'approve_lecturer_results' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage Results');?></span>
				</a>
				<ul>

               
                    
                
                    
                      <li class="<?php if($page_name == 'approve_lecturer_results')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/approve_lecturer_results_hod">
							<span><i class="entypo-dot"></i> <?php echo "Approve HOD/Lecturers Results";?></span>
						</a>
					</li>

				</ul>
			</li>
			
			<?php } ?>
			
			<!-- ADMIN -->
			    <?php if($this->session->userdata('level') == '8'){?>
		   <li class="<?php if(
           						   $page_name == 'add_new_user_account' || $page_name == 'view_user_accounts' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase(' Manage User Accts');?></span>
				</a>
				<ul>
        
                    
                
                    
                      <li class="<?php if($page_name == 'add_new_user_account')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/add_new_user_account">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("add_new_user_account");?></span>
						</a>
					</li>
					
					 <li class="<?php if($page_name == 'view_user_accounts')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_user_accounts">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("view_user_accounts");?></span>
						</a>
					</li>

				</ul>
			</li>
			<?php } ?>
           <!-- Payment Report BURSARY SECTION -->
           <?php if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '8'){?>
		    <li class="<?php if($page_name == 'remita' ||
								$page_name == 'generate_payment_reports'||
								$page_name == 'view_students_report_by_student'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-users"></i> 
					<span><?php echo get_phrase('Admitted Students');?></span>
				</a>
				<ul>

                	<!-- Live Remita -->
					<li class="<?php if($page_name == 'remita')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/admitted_student_view">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('View_Admitted_Students');?></span>
    				    </a>
                    </li>
			          
				</ul>
			</li>

		 <li class="<?php if($page_name == 'remita' ||
								$page_name == 'generate_payment_reports'||
								$page_name == 'view_students_report_by_student'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-chart-bar"></i>
					<span><?php echo get_phrase('Payment Report');?></span>
				</a>
				<ul>

                	<!-- SCHOOL FEES PAYMENT REPORT-->
					<li class="<?php if($page_name == 'school_fees_report')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/school_fees_report">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('School_Fees_Report');?></span>
    				    </a>
                    </li>
					
                  <li class="<?php if($page_name == 'generate_acceptance_payment_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/generate_acceptance_payment_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Acceptance Fees Payment Reports');?></span>
						</a>
					</li>
		   <li class="<?php if($page_name == 'generate_other_payment_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/generate_other_payment_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Other Payment Reports');?></span>
						</a>
					</li>
				<li class="<?php if($page_name == 'view_students_report_by_student')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_students_report_by_student">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('View Payment Reports By Students');?></span>
						</a>
					</li>

                    
				</ul>
			</li>
			
			
			<?php } ?>
            
           

           <!-- DORMITORY -->


           <!--ACCOMODATION-->
           <?php if($this->session->userdata('level') == '5'){?>
		   <li class="<?php if($page_name == 'accomodation_pins' ||
									$page_name == 'dormitory')
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="fa fa-home"></i>
					<span><?php echo get_phrase('Accomodation');?></span>
				</a>
				<ul>

                	<!-- Live Etranzact -->
					<li class="<?php if($page_name == 'accomodation_pins')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/pin_info">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Scratch_card_info');?></span>
    				    </a>
                    </li>

                    <li class="<?php if($page_name == 'dormitory')echo 'active';?> ">
				    <!--a href="<?php echo base_url();?>index.php?sadmin/dormitory"-->
				    <a href="#">
					    <span><i class="entypo-dot"></i><?php echo get_phrase('dormitory');?></span>
				    </a>
           </li>

				</ul>
			</li>
			<?php } ?>
            
           <!-- NOTICEBOARD >
           <li class="<?php if($page_name == 'noticeboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?sadmin/noticeboard">
					<i class="entypo-doc-text-inv"></i>
					<span><?php echo get_phrase('noticeboard');?></span>
				</a>
           </li-->
            
			<?php if($this->session->userdata('level') == '5'){ ?>
			<li class="<?php 
				if($page_name == 'reservedRooms' || $page_name == 'hostel_i')echo 'opened active has-sub';
				?> ">
				<a href="#">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('Hostel Allocation');?></span>
				</a>
				<ul>
					<li class="<?php if($page_name == 'reservedRooms')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/hostelAllocation/reservedRooms">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Reserved Rooms');?></span>
    				    </a>
                    </li>
                    <li class="<?php if($page_name == 'hostel_i')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/hostelAllocation/hostel_i">
							<span><i class="entypo-dot"></i><?php echo get_phrase('Hostel I');?></span>
						</a>
					</li>

				</ul>
			</li>
			<?php } ?>   <?php } ?>
           
           <!-- ACCOUNT -->
		   <?php if($this->session->userdata('hostel_allocation') != 1){ ?>
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?sadmin/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('account');?></span>
				</a>
           </li>   
		   <?php } ?>
		</ul>
       		
</div>