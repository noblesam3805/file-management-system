<?php $school = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");
$semester = $this->db->query("select *  from course_semester order by semester_name");
$session = $this->db->query("select *  from course_session order by sessionn_name");
$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");
?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Courses";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END-->
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center">
                  <form id="imageform" name="imageform" method="post"  action='index.php?sadmin/view_student_course_registration' >
                   <p align="left">
                      Programme
                       <select name="programme"  id="programme" class="form-select required" onChange="javascript: populateProgrammeTypes(this.value); "><option value="" selected="selected" >- Select -</option>
<?php foreach($student_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->student_type_id;?>"><?php  echo $row->student_type_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                          <p align="left">
                      School
                       <select  name="school" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,programme.value); "><option value="" selected="selected" >- Select -</option>
<?php foreach($school->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                       <p align="left">
                      Department
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
  <p align="left">
                      Department Options
                     <span id="deptopts">
                      <select  name="deptsoptions" id="deptsoptions" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
                       <p align="left">
                     Progamme Type
                       <span  id="programmetypes">
                       <select  name="programme_type_id" id="programme_type_id" class="form-select required" onChange="javascript: populateLevels(this.value,programme.value);"><option value="" selected="selected" >- Select Programme Type -</option>
                       <?php foreach($programme_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->programme_type_id;?>"><?php  echo $row->programme_type_name;?></option>
<?php 
	}
	?>

 </select>
                    </span>  </p>
                      
                       <p align="left">
                      Level
                       <span id="levels">
                       <select  name="level" id="level" class="form-select required"><option value="" selected="selected" >- Select Level -</option>

 </select>
                    </span>  </p>
                      
                     
                      
                      <p align="left">
                      Semester
                       <select  name="semester" id="semester" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>
<?php foreach($semester->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->semester_id;?>"><?php  echo $row->semester_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                       <p align="left">
                     <span style=" padding-right:58px;" >  Session:</span>
                       <select  name="session" id="session" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>
<?php foreach($session->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->sessionn_name;?>"><?php  echo $row->sessionn_name;?></option>
<?php 
	}
	?>
 </select>
 </p>
                      
                      <p align="left">
                        <input type="submit" name="submit" id="submit" value="Proceed">
                      </p>
                  </form>
                  
                </div>
				<div id='preview'></div>&nbsp;</p>
			  <p>&nbsp;</p>
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>

	</div>

</div>