<?php 
$school1 = $this->db->query("select *  from schools where schoolid='$school'");
$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'");
foreach($student_type->result() as $row1)
{

	$dept = $this->db->query("select *  from department where deptID='$depts'");

}

$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");
$courses = $this->db->query("select *  from eduportal_courses");
//$session =  $this->db->query("select *  from course_session where session_id='$session'");
$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level'");
$course_types =    $this->db->query("select *  from course_type ");
$credit_units =    $this->db->query("select *  from course_unit");

  $data2 = array(
  
   'semester_id'=> $semester,
   'student_type_id'=> $programme,
   'department_id'=>$depts,
   'year_of_study_id'=> $level
   );
   $details = $this->db->get_where('course_unit_load', $data2)->row();
   
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

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_update_unitload_of_dept' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Assign Unit Load!</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center">
                  
                      <p align="left">
                      Programme: <?php  foreach($student_type->result() as $row) 
	{echo $row->student_type_name;}?>
                      </p>
                      
                          <p align="left">
                      School: <?php foreach($school1->result() as $row){ echo $row->schoolname;}?>

                      </p>
                      
                       <p align="left">
                      Department: <?php foreach($dept->result() as $row){ echo $row->deptName;}?>
                     </p>
                     
                        <p align="left">Programme Type:
                      <?php foreach($programme_type->result() as $row){ echo $row->programme_type_name;}?>
                         </p>
                      
                       <p align="left">
                      Level:
                      <?php foreach($levels->result() as $row){ echo $row->year_of_study_name;}?>
                         </p>
                      
                  
                      
                      <p align="left">
                      Semester: <?php foreach($semester1->result() as $row){ echo $row->semester_name;}?>
                      
                      </p>
                      
                      
                </div>
			  <h3>Unit Loads !</h3>
				<div id='preview'><p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span></p>
				  <table width="387"  cellpadding="10" cellspacing="10">
				    <tr>
				      <td width="123">Maximum Unit</td>
				      <td width="192"><input name="maximum_unit" type="text" value="<?php  if(isset($details->maximum_unit)){ echo $details->maximum_unit;} else {echo "0";}?>"></td>
				      </tr>
				    <tr>
				      <td>Minimum Unit</td>
				      <td><input name="minimum_unit" type="text"  value="<?php  if(isset($details->minimum_unit)){ echo $details->minimum_unit;} else {echo "0";}?>"></td>
				      </tr>
				    <tr>
				      <td>Maximum Elective</td>
				      <td><input name="maximum_elective" type="text" value="<?php  if(isset($details->maximum_elective)){ echo $details->maximum_elective;} else {echo "0";}?>"></td>
				      </tr>
				    </table>
				</div>&nbsp;</p>
				<input type="hidden" name="school"  value="<?php echo $school;?>"/>
				  <input type="hidden" name="programme" value="<?php echo $programme;?>"/>
				  <input type="hidden" name="depts" value="<?php echo $depts;?>"/>
				  <input type="hidden" name="level" value="<?php echo $level;?>"/>
				  <input type="hidden" name="semester" value="<?php echo $semester;?>"/>
                   <input type="hidden" name="programme_type_id" value="<?php echo $programme_type_id;?>"/>
				  
				  
                  <p align="left"><br>
                    <input type="submit" name="submit" id="submit" value="  Update Unit Load " height="35px">
                  </p>
                  
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>
 
                  </form>
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

