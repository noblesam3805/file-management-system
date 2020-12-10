<?php $school1 = $this->db->query("select *  from schools where schoolid='$school'");
$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'");
foreach($student_type->result() as $row1)
{
if($row1->student_type_id=="1")
{
	$dept = $this->db->query("select *  from department where deptID='$depts'");
}

else
{
	$dept = $this->db->query("select *  from department where deptID='$depts'");
}
}
$deptsoptions=$dept_option_id;
if($deptsoptions=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$deptsoptions."'")->row()->dept_option_name;
}
$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");
//$programme_type_id = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
$courses = $this->db->query("select *  from eduportal_courses order by course_code");
//$session =  $this->db->query("select *  from course_session where session_id='$session'");
$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level'");
$course_types =    $this->db->query("select *  from course_type ");
$credit_units =    $this->db->query("select *  from course_unit");
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

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_assign_course_to_dept' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Assign Course To Department ! </h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p>
			  <div style="width:100%; height:100%" align="center">
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
					  <p align="left">
                      Department Option: <?php echo $deptopt;?>
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
                      
                         <p align="left">
                      Session: <?php echo $session;?>
                      
                      </p>
                      
                      
                </div><h3>Courses Assigned To Department !</h3>
				<div id='preview'><table width="896"  class="" >
      <thead>
        <tr bgcolor="#ffffff">
          <th width="61"><div align="left" class="style6"><span class="style4">ID</span></div></th>
          <th width="133"><div align="left" class="style6"><span class="style4">COURSE CODE</span></div></th>
          <th width="263"><div align="left" class="style6"><span class="style4">COURSE TITLE </span></div></th>
          <th width="111"><div align="left" class="style6"><span class="style4">CREDIT UNIT</span></div></th>
          <th width="159"><div align="center" class="style6"><span class="style4"> LECTURER</span></div></th>
		  <th width="141"><div align="center" class="style6">ACTION</div></th>
 
        
        </tr>
      </thead>
    
	  <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	 $query1 =sqlsrv_query($conn,"select* from course_assigned_to_department where semester_id='$semester' and student_type_id='$programme' and department_id='$depts' and dept_option_id='$dept_option_id' and year_of_study_id='$level' and programme_type_id='$programme_type_id'") or die();
								while(list($id1,$courseid,$course_unit,$course_type_id) = sqlsrv_fetch_array($query1))
								{?>
         <tbody> 
           <tr bgcolor="#E2E2E2">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             
           </tr>
           <tr>
          <td><div align="left"><span class="style5"><?php echo $id;?></span></div></td>
          <td><div align="left"><span class="style5"><?php $q1=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid'")or die (mysql_error());
		  
		  while(list($courseid1,$coursecode1,$course_title1)=sqlsrv_fetch_array($q1))
		  {echo  $coursecode1;}?></span></div></td>
         
          <td><div align="left"><span class="style5"><?php $q2=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid'")or die (mysql_error());while(list($courseid2,$coursecode2,$course_title2)=sqlsrv_fetch_array($q2))
		  {echo  $course_title2;}?></span></div></td>
		 
          <td><div align="left"><span class="style5"><?php echo $course_unit;?></span></div></td>
      
           <td>
           
           <div align="center"><span class="style5" id="courseHint<?php echo $id1;?>"></span><span class="style5" id="courseinput<?php echo $id1;?>" style="display:none;">
       <select  name="lecturer<?php echo $id1;?>" id="lecturer<?php echo $id1;?>" class="form-select required" >
         <option value="" selected="selected" >- Select Lecturer -</option>
       	<?php 
		  $query17 =sqlsrv_query($conn,"select sadmin_id,name,dept_id from sadmin where level='6'") or die (mysql_error());
		 // $res = mysql_result($query15,0);
		  while(list($sadminid,$lname,$dept_id)=sqlsrv_fetch_array($query17))
		  {
			   $query18=sqlsrv_query($conn,"select* from department where deptID='$dept_id'") or die (mysql_error());
		 // $res = mysql_result($query15,0);
		  while(list($deptid,$deptName)=sqlsrv_fetch_array($query18))
		  {
			  ?>
          
       <option value="<?php echo $sadminid;?>"  ><?php echo $lname. ' - '.$deptName;?> </option>
       <?php
		  }
		  }
	   
	?>
 </select>  <input type="submit" name="submit<?php echo $id1;?>" id="submit<?php echo $id1;?>" value="  Assign   " height="35px" onclick="saveAssignedLecturer(lecturer<?php echo $id1;?>.value,'<?php echo $session;?>',<?php echo $id1;?>,'<?php foreach($semester1->result() as $row){ echo $row->semester_name;}?>'); return false;"></span><span id="commload<?php echo $id1;?>"></span></div>
    <span id="myText<?php echo $id1;?>">   <?php 
	   $query15 =sqlsrv_query($conn,"select lecturer_id from course_assigned_to_lecturers where course_assigned_to_dept_id='$id1' and session='$session'") or die (mysql_error());
		 // $res = mysql_result($query15,0);
       while(list($liid)=sqlsrv_fetch_array($query15))
		  {
			  
			  $query16 =sqlsrv_query($conn,"select name,dept_id from sadmin where sadmin_id='$liid'") or die (mysql_error());
		 // $res = mysql_result($query15,0);
		  while(list($lname,$dept_id)=sqlsrv_fetch_array($query16))
		  {
$query18=sqlsrv_query($conn,"select* from department where deptID='$dept_id'") or die (mysql_error());
		 // $res = mysql_result($query15,0);
		
		  while(list($deptid,$deptName)=sqlsrv_fetch_array($query18))
		  {
		echo $lname. ' - '.$deptName;
			  
		  }
		  }
			  
		  }
		  ?></span>
         </div></td>
          <td align="center"><span id="myAction<?php echo $id1;?>"><?php 
		  $query15 =$this->db->query("select* from course_assigned_to_lecturers where course_assigned_to_dept_id='$id1' and session='$session'")->row();
		  //$res =sqlsrv_num_rows($query15);
	
		  if($query15)
		  {
			  ?>
              <a href="#" onclick="javascript: UnAssignCourseFromLecturer(<?php echo $id1;?>);">Unassign Lecturer</a>
              <?php
		  }
		  else
		  {?>
		  <a href="#" onclick="javascript: OpenEditAssignCourse(<?php echo $id1;?>);">Assign Lecturer</a><?php }?>  </span> | 
		  <a href="<?php echo base_url().'index.php?sadmin/download_registeredcourses_classlist_photoalbum/'.$id1;?>" target="_blank">Download Class List</a>
		  </td>
   

	 </tr>
				 </tbody> <?php 
				  $id = $id +1;
		  
				  
				  }
				    if($id<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses have been assigned for this Selection!</h3></td></tr>";
				  }
				  ?>
</table></div>&nbsp;</p>
			
              <?php  
			  $userlevel =$this->session->userdata('level');
			  $sesdata = array(
                   'school'  => $school,
                   'programme'     => $programme,
                   'depts' => $depts,
				   'levels' => $level,
				   'modeofentry' => $modeofentry,
				   'semester' => $semester,
				   'programme_type_id' => $programme_type_id,
				   'sadmin_login'=> '1'
				   
               );

$this->session->set_userdata($sesdata);
			 					 
					
			  ?>
              
              <input type="hidden" name="school"  value="<?php echo $school;?>"/>
              <input type="hidden" name="programme" value="<?php echo $programme;?>"/>
              <input type="hidden" name="depts" value="<?php echo $depts;?>"/>
              <input type="hidden" name="level" value="<?php echo $level;?>"/>
              <input type="hidden" name="modeofentry" value="<?php echo $modeofentry;?>"/>
              <input type="hidden" name="semester" value="<?php echo $semester;?>"/>
             <input type="hidden" name="programme_type_id" value="<?php echo $programme_type_id;?>"/>
              </p>
              
             <p align="center"><br>
                        <a href="<?php echo base_url().'index.php?sadmin/assign_course_to_lecturer';?>">Return</a>
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

