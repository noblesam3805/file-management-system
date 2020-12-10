<div class="sidebar-menu"><div class="sidebar-menu-inner">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="">
				
				<div style="text-align:center; margin-top:15px;">
					<a href="<?php echo base_url();?>">
						<img src="homepage/public/landingAssets/images/logo.png" style="border-radius:100px; width:80px; height:80px;" />
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
           <li class="<?php if($page_name == 'dashboard')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?sadmin/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
	   	    <!--Memomo Activities -->
	     <li class="<?php if($page_name == 'send_memo_page' ||
            						   $page_name == 'view_pending_memo' ||
            						   $page_name == 'view_all_memo' ||
            						   $page_name == 'view_all_sent_memo')
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-newspaper"></i>
 					<span><?php echo get_phrase('Memo Activities');?></span>
 				</a>
 				<ul>

                	
 					
				
			
					
					
					
					<li class="<?php if($page_name == 'send_memo_page')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/memos/SEND_MEMO">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('create new memo');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_pending_memo')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/memos/VIEW_PENDING_MEMO">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('receive memos');?></span>
     				    </a>
					</li>
					
					<li class="<?php if($page_name == 'view_pending_memo')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/memos/PROCESS_VIEW_ALL_MEMO/0/0/ALL_DRAFT_MEMO">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('draft memos');?></span>
     				    </a>
					</li>
					<li class="<?php if($page_name == 'view_all_memo')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/memos/VIEW_ALL_MEMO_OPTION">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view all memos');?></span>
     				    </a>
					</li>
						
					<li class="<?php if($page_name == 'view_all_sent_memo')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/send_all_memo">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view all sent memo');?></span>
     				    </a>
					</li>
					
						<li class="<?php if($page_name == 'view_pending_memo')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/memos/VIEW_PENDING_MEMO">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('trash memos');?></span>
     				    </a>
					</li>
					
					<li class="<?php if($page_name == 'memos/VIEW_PENDING_MEMO')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/memos/VIEW_COPIED_MEMO">
     				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Copied memos');?></span>
     				    </a>
					</li>

 				</ul>
 			</li>
	    <!--End of Memo Activities-->
		
		
			<li >
				<a href="<?php echo base_url();?>index.php?sadmin/message">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Private Messaging');?></span>
				</a>
			
			</li>
	    <!--End of Mail Activities-->

          
			
			<!-- ADMIN -->
			    <?php if($this->session->userdata('level') == '8'){?>
		   <li class="<?php if(
           						   $page_name == 'add_new_user_account' || $page_name == 'view_user_accounts' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('HR Functions');?></span>
				</a>
				<ul>
        
                    
                
                    
                      <li class="<?php if($page_name == 'add_new_user_account')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/add_new_user_account">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("add_new_staff");?></span>
						</a>
					</li>
					
					 <li class="<?php if($page_name == 'view_user_accounts')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_user_accounts">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("view_staff_accounts");?></span>
						</a>
					</li>

				</ul>
			</li>
			
			
			<li class="<?php if(
           						   $page_name == 'report_lga' || $page_name == 'view_user_accounts' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Norminal Role');?></span>
				</a>
				<ul>
        
                    
                
                    
                      <li class="<?php if($page_name == 'add_new_user_account')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/report_lga">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("norminal_role_reports");?></span>
						</a>
					</li>
					
					

				</ul>
			</li>
			
			<li class="<?php if(
           						   $page_name == 'view_statistical_reports' || $page_name == 'view_user_accounts' )
												echo 'opened active has-sub';?> ">
				<a href="#">
					&nbsp; <i class="entypo-doc-text-inv"></i>
					<span>&nbsp;<?php echo get_phrase('Statistical Records');?></span>
				</a>
				<ul>
        
                    
                
                    
                      <li class="<?php if($page_name == 'view_statistical_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/view_statistical_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase("view_statistical_reports");?></span>
						</a>
					</li>
					
					

				</ul>
			</li>
			
			   <!--Settings -->
	     <li class="<?php if($page_name == 'add_mda_form' ||
            						   $page_name == 'view_mda' )
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-doc-text-inv"></i>
 					<span><?php echo get_phrase('MDA');?></span>
 				</a>
 				<ul>

                	
 					<li class="<?php if($page_name == 'add_mda_form')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/add_mda_form">
     				    	<span><i class="entypo-inbox"></i><?php echo get_phrase('Add MDA');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_mda')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/view_mda">
     				    	<span><i class="entypo-pencil"></i><?php echo get_phrase('View MDAs');?></span>
     				    </a>
					</li>
					
					
						
					

 				</ul>
 			</li>
			
			 <li class="<?php if($page_name == 'add_dept_form' ||
            						   $page_name == 'view_dept' )
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-doc-text-inv"></i>
 					<span><?php echo get_phrase('Unit/Departments');?></span>
 				</a>
 				<ul>

                	
 					<li class="<?php if($page_name == 'add_dept_form')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/add_dept_form">
     				    	<span><i class="entypo-inbox"></i><?php echo get_phrase('Add Unit/Department');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_dept')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/view_dept">
     				    	<span><i class="entypo-pencil"></i><?php echo get_phrase('View Unit&Departments');?></span>
     				    </a>
					</li>
					

 				</ul>
 			</li>
			
			 <li class="<?php if($page_name == 'add_des' ||
            						   $page_name == 'view_des' )
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-doc-text-inv"></i>
 					<span><?php echo get_phrase('Designations');?></span>
 				</a>
 				<ul>

                	
 					<li class="<?php if($page_name == 'add_des_form')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/add_des_form">
     				    	<span><i class="entypo-inbox"></i><?php echo get_phrase('Add Designation');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_des')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/view_des">
     				    	<span><i class="entypo-pencil"></i><?php echo get_phrase('View Designations');?></span>
     				    </a>
					</li>
					

 				</ul>
 			</li>
			
			 <li class="<?php if($page_name == 'add_cadre_form' ||
            						   $page_name == 'view_cadre' )
 												echo 'opened active has-sub';?> ">
 				<a href="#">
 					<i class="entypo-doc-text-inv"></i>
 					<span><?php echo get_phrase('Cadre');?></span>
 				</a>
 				<ul>

                	
 					<li class="<?php if($page_name == 'add_cadre_form')echo 'active';?> ">
     				    <a href="<?php echo base_url();?>index.php?sadmin/add_cadre_form">
     				    	<span><i class="entypo-inbox"></i><?php echo get_phrase('add_cadre');?></span>
     				    </a>
                     </li>
 					<li class="<?php if($page_name == 'view_cadre')echo 'active';?> ">
     				   <a href="<?php echo base_url();?>index.php?sadmin/view_cadre">
     				    	<span><i class="entypo-pencil"></i><?php echo get_phrase('view_cadre');?></span>
     				    </a>
					</li>
					

 				</ul>
 			</li>
			<?php } ?>
              <!-- Meeting SECTION -->
           <?php //if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '8'){?>
		    <li class="<?php if($page_name == 'schedule_meeting' ||
								$page_name == 'view_meetings'||
								$page_name == 'view_students_report_by_student'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-users"></i> 
					<span><?php echo get_phrase('Meetings');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'schedule_meeting')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/schedule_meeting">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Schedule_meeting');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'view_meetings')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_meetings">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view_meetings');?></span>
    				    </a>
                    </li>
			          
				</ul>
			</li>
			
			
			      <!-- Document management Section -->
           <?php //if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '8'){?>
		    <li class="<?php if($page_name == 'view_track_files' ||
								$page_name == 'add_new_file'||
								$page_name == 'view_untreated_files'
								||
								$page_name == 'view_treated_files'||
								$page_name == 'view_all_files'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-users"></i> 
					<span><?php echo get_phrase('Files');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'add_new_file')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/add_new_file">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('add_new_file');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'view_untreated_files')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_untreated_files">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('untreated_files');?></span>
    				    </a>
                    </li>
					<li class="<?php if($page_name == 'view_treated_files')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_treated_files">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('treated_files');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'view_all_files')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_all_files">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view/All_files');?></span>
    				    </a>
                    </li>
			          
				</ul>
			</li>
			 <?php	//}?>
			
			<!-- Document management Section -->
           <?php //if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '8'){?>
		    <li class="<?php if($page_name == 'new_procurement' ||
								$page_name == 'view_track_procurements'||
								$page_name == 'view_students_report_by_student'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-users"></i> 
					<span><?php echo get_phrase('Procurements');?></span>
				</a>
				<ul>

                	
					<li class="<?php if($page_name == 'add_new_file')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/add_new_file">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('new_procurement');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'view_track_procurements')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/view_track_procurements">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('view/Track_procuremnts');?></span>
    				    </a>
                    </li>
			          
				</ul>
			</li>
		   <?php	//}?>

		 <li class="<?php if($page_name == 'remita' ||
								$page_name == 'generate_payment_reports'||
								$page_name == 'view_students_report_by_student'
								
								 )
												echo 'opened active has-sub';?> ">
				<a href="#">
					<i class="entypo-chart-bar"></i>
					<span><?php echo get_phrase('Activity Report');?></span>
				</a>
				<ul>

                	<!-- SCHOOL FEES PAYMENT REPORT-->
	<li class="<?php if($page_name == 'school_fees_report')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/school_fees_report">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Track_file_movements');?></span>
    				    </a>
                    </li>
					
                  <li class="<?php if($page_name == 'generate_acceptance_payment_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/generate_acceptance_payment_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Track_Memo_activities');?></span>
						</a>
					</li>
					
					<li class="<?php if($page_name == 'generate_acceptance_payment_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/generate_acceptance_payment_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Track_Procurements');?></span>
						</a>
					</li>
		   <li class="<?php if($page_name == 'generate_other_payment_reports')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?sadmin/generate_other_payment_reports">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('System_Audit_Trail');?></span>
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
					<span><?php echo get_phrase('Time Attendance');?></span>
				</a>
				<ul>

                	<!-- SCHOOL FEES PAYMENT REPORT-->
	<li class="<?php if($page_name == 'school_fees_report')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/school_fees_report">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Upload_Data_from_Time_Attendance_Machine');?></span>
    				    </a>
                    </li>
					
					<li class="<?php if($page_name == 'school_fees_report')echo 'active';?> ">
    				    <a href="<?php echo base_url();?>index.php?sadmin/school_fees_report">
    				    	<span><i class="entypo-dot"></i><?php echo get_phrase('Track_Staff_Time');?></span>
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
            
		   <?php  ?>
           
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
       		
</div></div>