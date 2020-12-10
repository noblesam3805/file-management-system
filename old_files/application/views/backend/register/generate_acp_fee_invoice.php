<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");

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
 <div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-home"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                     
                       <li><a href="<?php echo base_url().'index.php?login';?>">Return Home</a></li>
                    </ul>
                    <h4>Step 1: Generate Acceptance Fee Invoice </h4>
                </div>
            </div><!-- media -->
        </div>
	  <div class="span12">
            <div class="span8 b themiddle hasheight" style="background-color:#FFF;">
                <div class="" style="border:none;">
		<?php if($stu_prog==4){ echo form_open('register/processRemitaAcceptanceInvoice', array('class' => 'form-groups-bordered validate','target'=>'_top')); }else {echo form_open('register/processRemitaAcceptanceInvoice', array('class' => 'form-groups-bordered validate','target'=>'_top'));} ?>
		<div class="col-md-12 no-p">
			<?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?>
            <div>
            <input type="hidden" name="portalID" value="<?php echo $my_data->portal_id;?>" />
			
			 <input type="hidden" name="programTpeID" value="<?php echo  $stu_prog;?>" />
			
			<label class="label-control" for="course name">Full Name:  <?php echo $my_data->name.' '.$my_data->othername;?></label><br/>
			<label class="label-control" for="course name">Application No:  <?php echo $my_data->portal_id;?></label><br/>
            </div>
              <input type="hidden" name="programme_type_id" value="<?php if($stu_prog==4){echo '1';} if($stu_prog==5){echo '5';} if($stu_prog==6){echo '6';}?>" />
				<label class="label-control" for="course name">Programme:  <?php echo $programme->student_type_name."(".$programme_type->programme_type_name.")";?></label>
			</div>
                <div ><br/>
				<label class="label-control" for="course name">School:  <?php echo $school->schoolname;?></label>
				<div class="input-group input-group-lg eduportal-input-group">
			

				</div>
            </div>
               <div ><br/>
				<label class="label-control" for="course name">Department:   <?php echo ucwords(strtolower($dept->deptName));?></label>
				<div class="input-group input-group-lg eduportal-input-group">
			
					
				</div>
			</div>
		
            <div >
				<label class="label-control" for="course name">Session</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="session" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
						<option value="2019/2020">2019/2020</option>
						
						
					</select>
				</div>
			</div>
			<div >
				<label class="label-control" for="course name">Year</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="year" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
					<?php if($my_data->programme==1)
						{?>
                        <option value="ND I">ND I</option>
                     
                        <?php } 
						if($my_data->programme==2) {?>
                        <option value="HND I">HND I</option>
                    
						<?php }?>
						
						 <?php  if($my_data->programme==4) {?>
                        <option value="BSC I">BSC I</option>
						<option value="BSC II">BSC II</option>
                    
						<?php }?>
						
						
					</select>
				</div>
			</div>
			<div>
				<label class="label-control" for="course name">Payment Type</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="paymentType" required class="form-control eduportal-input">
						<option value="1">ACCEPTANCE FEES</option>
					</select>
				</div>
			</div>
			<div  style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Generate Invoice</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div></div></div></div></div><?php unset($_SESSION['fee_type']);?>
  