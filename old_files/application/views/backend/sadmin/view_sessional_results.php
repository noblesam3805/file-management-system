<?php $school = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");
$semester = $this->db->query("select *  from course_semester order by semester_name");
$session = $this->db->query("select *  from course_session order by sessionn_name");
$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");?> 

<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Achieved Results";?>

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
			
			<h3>View Sessional Results!</h3>
			<hr />
			
			<div style="margin-left:30px">
			  <p>Note Supported format **CSV </p>
			  <p>&nbsp;</p>
			  <p><span style="font-size:13px; color:#9d0000;">
			    <?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?>
			  </span> 
			
				
                 <form  method="post"   name="resultform" action='index.php?sadmin/process_view_sessional_results'>
                 
                 <p align="left">
                     <span style=" padding-right:40px;">Programme:</span>
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
                       <span style=" padding-right:65px;">School:</span>
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
                    <span style=" padding-right:40px;">  Department:</span>
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
                      
                     
                    
                     <p align="left">
                      <span style=" padding-right:15px;">Progamme Type: </span>
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
                       <span style=" padding-right:76px;">Level:</span>
                       <span id="levels">
                       <select  name="level" id="level" class="form-select required"><option value="" selected="selected" >- Select Level -</option>

 </select>
                    </span>  </p>
                      
                     
                      
                      <p align="left">
                     <span style=" padding-right:52px;">  Semester:</span>
                       <select  name="semester" id="semester" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>
<?php foreach($semester->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->semester_name;?>"><?php  echo $row->semester_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                      <p align="left">
                     <span style=" padding-right:58px;" >  Session:</span>
                       <select  name="session" id="session" class="form-select required" onChange="javascript: getCourseTitle(this.value,programme.value,school.value,depts.value,programme_type_id.value,level.value,semester.value);"><option value="" selected="selected" onChange="">- Select -</option>
<?php foreach($session->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->sessionn_name;?>"><?php  echo $row->sessionn_name;?></option>
<?php 
	}
	?>
 </select>
       <p align="left">
                       <span style=" padding-right:76px;">Course:</span>
                       <span id="courses">
                       <select  name="course" id="course" class="form-select required"><option value="" selected="selected" >- Select Course Title -</option>

 </select>
                    </span>  </p>                     

<p>

</p>
<p align="center">
                        <input type="submit" name="submit" id="submit" value="Proceed" style="height:25px; width:200px; color:#000">
                      </p>
  
</form>&nbsp;</p>
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

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>
<?php if(isset($_SESSION['duplicates'])){ unset($_SESSION['duplicates']);}?>

