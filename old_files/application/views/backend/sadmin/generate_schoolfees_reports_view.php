<?php session_start();
 $school = $this->db->query("select *  from schools order by schoolname");
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
		<?php  echo form_open('sadmin/processSchoolFeesPayments', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
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
            </div><br /><br />
				<div class="form-group eduportal-form-group p20">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Program Level'); ?></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
								<select name='programme_level' class='form-control'>
								  <option value='1'>ND I</option>
								   <option value='2'>HND I</option>
								   <option value='3'>ND II</option>
								  <option value='4'>HND II</option>
								  <option value='5'>ND III</option>
								  <option value='6'>HND III</option>
								   <option value='7'>CERTIFICATE</option>
								  <option value='8'>BSC</option>
								  <option value='9'>ALL PROGRAM LEVEL</option>
								</select> 
                        </div>
                    </div>
            </div>
			
			<br /><br />
				<div class="form-group eduportal-form-group p20">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Program Type'); ?></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
								<select name='programme' class='form-control'>
								  <option value='1'>FULL TIME</option>
								  <option value='2'>PART TIME</option>
								  </select> 
                        </div>
                    </div>
            </div>
			 <!-- END OF SECTION FOR ACADEMIC SESSION YABATECH ERP -->	
			 
			<br/><br/>
			 <!-- BEGINNING OF JAVASCRIPT IMPLEMENTATION OF PROGRAM TYPE OPTION FOR ADMITTED STUDENTS -->	
			 
			   <!-- BEGINNING OF SECTION FOR PROGRAM TYPE YABATECH ERP -->		
			   
			   	<div class="form-group eduportal-form-group p20">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Report Option'); ?></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
								<select name='school_fees_optn_reprt' class='form-control' id="claims_type_id" required="required" onchange="chk_ctype(this.value);" onclick="chk_ctype(this.value);">
								  <option value='1'>SCHOOL FEES PAYMENT REPORT BASE ON LEVEL</option>
								  <option value='2'>SCHOOL FEES REPORT BASED ON SCHOOL/LEVEL</option>
								  <option value='3'>SCHOOL FEES REPORT FOR MONTHLY PAYMENT</option>
								  </select> 
                        </div>
                    </div>
            </div>
	
			 <!-- END OF SECTION FOR PROGRAM TYPE YABATECH ERP -->	
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
			
		
			
			</div>
				<!-- program type option for admitted students based on SCHOOLS-->		
			<div id="program_type_area3" style="display:none" >
		
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
  