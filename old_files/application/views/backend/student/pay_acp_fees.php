<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");

 $receipts=  $this->db->query("select* from eduportal_fees_payment_log where student_id='".$this->session->userdata('student_id')."' and payment_fee_type='1'");
 foreach($my_data as $row1){
$school = $this->db->get_where('schools', array("schoolid" => $my_data->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $my_data->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $my_data->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $my_data->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $my_data->level))->row();
//$stype=$row1['programme'];
//$levels = $this->db->query("select *  from course_year_of_study where student_type_id='$stype'");
 }
 $stu_prog=$my_data->prog_type;
?>
<div class="row">

	<div class="col-md-12">
			<ul class="nav nav-tabs bordered">

	

          	<!--li>
        		<a href="#add" data-toggle="tab"><i class="entypo-credit-card"></i>
            	<?php echo get_phrase('school_Fee_payment_form');?>
             	</a>
            </li-->
            <li class="active">
		        <a href="#pid" data-toggle="tab"><i class="entypo-credit-card"></i>
	            <?php echo 'Acceptance Fee Confirmation Form';?>
                </a>
            </li>
            
            		<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('Acceptance_Fee_Payment_History');?>
                </a>
            </li>



		</ul>
		
			<div class="widget stacked widget-table">
				<div class="widget-content">
					<div class="tab-content">

				<!--TABLE LISTING STARTS-->

				<div class="tab-pane box " id="list">



					<table  class="table table-bordered datatable" id="table_export">
						<thead>
							<tr>
							<th><div>S/N</div></th>
							<th><div>Portal ID</div></th>
							<th><div>Semester</div></th>
							<th><div>Level</div></th>
							<th><div>Amount (₦)</div></th>
							<th><div>Session</div></th>
							<th><div>Payment Code</div></th>
							<th><div>Date</div></th>
                            <th><div>Action</div></th>
							</tr>
						</thead>
						<tbody><?php $i =1; ?>
							<?php foreach($receipts->result() as $row){?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->regno;?></td>
								<td><?php echo $row->semester;?></td>
								<td><?php echo $row->payment_level;?></td>
								<td>₦ <?php echo $row->payment_amount;?></td>
								<td><?php echo $row->payment_session;?></td>
								<td><?php echo $row->payment_code;?></td>
								<td><?php echo $row->payment_date;?></td>
								<td> 
								<a target ="_blank" href="<?php echo base_url();?>index.php?student/receiptprintout/<?php echo $row->payment_code;?>">
									<button type="submit" class="btn btn-info"><i class="entypo-credit"></i> View Receipt</button>
								</a>
								</td>
							</tr><?php $i++;?>
							<?php }?>
						</tbody>
					</table>

				</div>
	
                <div class="tab-pane box active" id="pid" style="padding: 5px">
			<?php if($stu_prog==4){ echo form_open('student/processRemitaAcceptancePayment', array('class' => 'form-groups-bordered validate','target'=>'_top')); }else {echo form_open('student/processRemitaAcceptancePayment', array('class' => 'form-groups-bordered validate','target'=>'_top'));} ?>
		<div class="col-md-6 no-p">
			<?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?>
            <div class="form-group eduportal-form-group p20">
            <input type="hidden" name="portalID" value="<?php echo $my_data->portal_id;?>" />
              <input type="hidden" name="programme_type_id" value="<?php if($stu_prog==4){echo '1';} if($stu_prog==5){echo '5';} if($stu_prog==6){echo '6';}?>" />
				<label class="label-control" for="course name">Programme:  <?php echo $programme->student_type_name."(".$programme_type->programme_type_name.")";?></label>
			</div>
                <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">School:  <?php echo $school->schoolname;?></label>
				<div class="input-group input-group-lg eduportal-input-group">
			

				</div>
            </div>
               <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Department:   <?php echo ucwords(strtolower($dept->deptName));?></label>
				<div class="input-group input-group-lg eduportal-input-group">
			
					
				</div>
                  <div class="form-group eduportal-form-group p20">
				<label class="label-control" for=" name"><a href="<?php echo base_url().'index.php?student/pay_acp_fees_morning_etransact';?>" >Please Click Here if you are a Morning Student who paid through E-transact Platform</a></label>
				<div class="input-group input-group-lg eduportal-input-group">
			
					
				</div>
			</div>
		
            <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">RRR / Confirmation Code</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<input type="text"  name="confirmcode" class="form-control eduportal-input" required="required" />
				</div>
			</div>
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Year</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="year" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
					<?php if($my_data->programme==1)
						{?>
                        <option value="ND I">ND I</option>
                     
                        <?php } else {?>
                        <option value="HND I">HND I</option>
                    
						<?php }?>
						
					</select>
				</div>
			</div>
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Payment Type</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="paymentType" required class="form-control eduportal-input">
						<option value="1">ACCEPTANCE FEES</option>
					</select>
				</div>
			</div>
			 <div class="form-group eduportal-form-group p20 ">
				<label class="label-control" for="course name">Payment Platform</label>
			<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="pmode" required class="form-control eduportal-input">
						<option value="0">Select An Option</option>
                        <option value="1">Etranzact</option>
                        <option value="2">Remita</option>
				
					</select>
				</div>
			</div>
            
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Proceed</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>	</div>
</div></div></div></div></div>