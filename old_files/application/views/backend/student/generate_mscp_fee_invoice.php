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
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('student/processMscpInvoice', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="col-md-6 no-p">
			<?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?>
            <div class="form-group eduportal-form-group p20">
            <input type="hidden" name="portalID" value="<?php echo $my_data->portal_id;?>" />
                  <input type="hidden" name="department" value="<?php echo ucwords(strtolower($dept->deptName));?>" />
            <input type="hidden" name="school" value="<?php echo $school->schoolname;?>" />
            <input type="hidden" name="progtype" value="<?php echo $programme_type->programme_type_name;?>" />
            <input type="hidden" name="prog" value="<?php echo $programme->student_type_name;?>" />
               <input type="hidden" name="programme_type_id" value="14" />
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
			</div>
		
            <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Session</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="session" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
						<option value="2017/2018">2017/2018</option>
                        <option value="2016/2017">2016/2017</option>
                        	<option value="2018/2019">2018/2019</option>
				
					</select>
				</div>
			</div>
                      <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Semester</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="semester" required class="form-control eduportal-input">
						<option value="">Select An Option</option>
                        <option value="FIRST">FIRST</option>
                        <option value="SECOND">SECOND</option>
				
					</select>
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
                        <option value="ND II">ND II</option>
                        <?php } else {?>
                        <option value="HND I">HND I</option>
                        <option value="HND II">HND II</option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Payment Type</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="paymentType" required class="form-control eduportal-input">
						<option value="4">MSCP FEE</option>
					</select>
				</div>
			</div>
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Generate Invoice</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div><?php unset($_SESSION['fee_type']);?>
  