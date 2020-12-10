<?php session_start();
 $school = $this->db->query("select *  from schools order by schoolname");
$program_type = $this->db->query("select *  from programme_type order by programme_type_id");
$admitted_students_optn = $this->db->query("select TOP 2 [admittd_student_optns_id]
      ,[admittd_student_optns_name]  from admitted_student_optn_report  
")->result_array();

	function get_dept_name($data)
	
	{
		
		$q= mysql_query("select dept_name from department where dept_id='$data'") or die(mysql_error());
		while(list($dept_name)=mysql_fetch_array($q))
		{
			echo strtoupper($dept_name);
		}
	
	}
	
	function get_school_name($data)
	
	{
		
		$q= mysql_query("select faculty_name from faculty where faculty_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	}
?>

<script language="javascript" type="text/javascript">
			

	
function chk_ctype(val){
	if(val <=1){
	document.getElementById("program_type_area1").style.display="block";	
	document.getElementById("program_type_area2").style.display="none";
	document.getElementById("program_type_area3").style.display="none";
	
	}
	if(val ==2){
	document.getElementById("program_type_area1").style.display="none";	
	document.getElementById("program_type_area2").style.display="block";
	document.getElementById("program_type_area3").style.display="none";
	
	}
	if(val ==3){
	document.getElementById("program_type_area1").style.display="none";	
	document.getElementById("program_type_area2").style.display="none";
	document.getElementById("program_type_area3").style.display="block";
	
	}
	
}
</script>

<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('sadmin/processAdmittedStudents', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
	
	        <!-- BEGINNING OF SECTION FOR ACADEMIC SESSION YABATECH ERP -->	
					
			<div class="form-group eduportal-form-group p20">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Academic Session'); ?></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
								<select name='academic_session' class='form-control'>
								  <option value='2019/2020'>2019/2020</option>
								  <option value='2018/2019'>2018/2019</option>
								  <option value='2017/2018'>2017/2018</option>
								</select> 
                        </div>
                    </div>
            </div>
			 <!-- END OF SECTION FOR ACADEMIC SESSION YABATECH ERP -->	
			<br/><br/>
				<div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Program Type'); ?></label>
                    <div class="col-sm-12">
					<div class="input-group">
                        <select  name="programmeType"  id="programme"  class="form-control" >
						<?php 
						foreach($program_type->result() as $programe)
						{
						?>	
							<option value="<?php  echo $programe->programme_type_id;?>"><?php  echo $programe->programme_type_name;?></option>
						<?php 
						}
						?>
						<option value="ALL" >ALL PROGRAM</option> 
						</select>
                      
					</div>						  
                    </div>
			</div><br/>
			
           <!-- BEGINNING OF SECTION FOR PROGRAM TYPE YABATECH ERP -->		
            <div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Report Option'); ?></label>
                    <div class="col-sm-12">
					<div class="input-group">
						<select name="reportOptn" class="form-control"   id="claims_type_id" required="required" onchange="chk_ctype(this.value);" onclick="chk_ctype(this.value);">
					        <?php 
							        foreach($admitted_students_optn as $row){
							        ?>
                                <option value="<?php echo $row['admittd_student_optns_id']?>"><?php echo get_phrase($row['admittd_student_optns_name']); ?></option>
							<?php  
							}?>
											            
						</select>
					</div>
                    </div>
            </div>
			 <!-- END OF SECTION FOR PROGRAM TYPE YABATECH ERP -->	
			<br />
				
			 <!-- BEGINNING OF JAVASCRIPT IMPLEMENTATION OF PROGRAM TYPE OPTION FOR ADMITTED STUDENTS -->	
			 <!-- program type option for all admitted students-->
			<div id="program_type_area1" style="display:none">
	
		
			</div	
				<!-- program type option for admitted students based on departments-->			
			<div id="program_type_area2" style="display:none" >
			<div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('School'); ?></label>
                    <div class="col-sm-12">
					<div class="input-group">
						<select class="form-control"   name="schoolID" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,programme.value); "><option value="" selected="selected" >- Select -</option>
							<?php 
							foreach($school->result() as $row)
							{
							?>
								<option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
							<?php 
							}
							?>
						</select>
                    </div>
					</div>
			</div>
			
			<div class="form-group">
			<label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Department'); ?></label>
            <div class="col-sm-12">
				<div class="input-group">
					<span id="dept">
					<select class="form-control"   name="deptID" id="depts" class="form-select required"><option value="" selected="selected">- Select -</option>
                        
						</select></span>
				</div>
			</div>
			</div>
			
			</div>
				<!-- program type option for admitted students based on SCHOOLS-->		
			<div id="program_type_area3" style="display:none" >
			<div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('School'); ?></label>
                    <div class="col-sm-12">
					    <div class="input-group">
							<select class="form-control"   name="schoolID" id="school" class="form-select required"  "><option value="" selected="selected" >- Select -</option>
								<?php 
									foreach($school->result() as $row)
								{
								?>
										<option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
								<?php 
								}
								?>
							</select>
                       </div>
					</div>
			</div>
			</div>
			 <!-- END OF JAVASCRIPT IMPLEMENTATION OF PROGRAM TYPE OPTION FOR ADMITTED STUDENTS -->	
			 
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Generate Report</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div>

<?php unset($_SESSION['fee_type']);?>
  