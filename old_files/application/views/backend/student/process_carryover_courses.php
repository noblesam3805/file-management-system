<?php 
$stuReg = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$student_id=$stuReg->student_id ;
$student_name= $stuReg->name. " ". $stuReg->othername;
$reg_no=$stuReg->reg_no;
$portal_id=  $stuReg->portal_id;

$programme = $stuReg->programme;
$programme_type_id = $stuReg->prog_type;

$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'")->row();
$student_type_name=$student_type->student_type_name;

$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'")->row();
$programme_type_name=$programme_type->programme_type_name;

$student_type_id=$programme;


$dept =$stuReg->dept;

$dept_id =$this->db->get_where('department', array("deptID" => $dept))->row();
$deptname=$dept_id->deptName;

$deptid=$dept_id->deptID;

$deptsoptions=$stuReg->dept_option;
if($deptsoptions=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$deptsoptions."'")->row()->dept_option_name;
}

$schoolid = $stuReg->school;
$schools = $this->db->query("select *  from schools where schoolid='$schoolid'")->row();
$school_id=$schools->schoolid;
$school=$schools->schoolname;


$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");

$session =  $this->db->query("select *  from course_session");
$levelname =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level_id'")->row()->year_of_study_name;
//$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level_id'");





?> 
<p style="font-size:13px; color:#9d0000;">&nbsp;</p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Add Carry Over/Borrowed Courses";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?student/ajax_submit_carryover_coursereg' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Register  Courses !</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center"><p align="left">Programme: <?php  echo $student_type_name;?>
                      </p>
                      
                          <p align="left">
                            School: <?php echo $school;?>
                            
                        </p>
                      
                       <p align="left">
                      Department: <?php echo $deptname;?>
                     </p>
                     
                       <p align="left">
                      Programme Type: <?php echo $programme_type_name;?>
                     </p>
                      
                       <p align="left">
                      Level:
                      <?php 
					   echo $levelname; 
					   
					   $this->session->set_userdata(array('level'=>$levelname)); 
					  ?></p>
                      
                      <p align="left">
                      
                      Semester:  <?php foreach($semester1->result() as $row){ echo $row->semester_name; $this->session->set_userdata(array('semester'=>$row->semester_name)); }?>
                      
                      </p>
                       <p align="left">
                       
                      Session:  <?php foreach($session->result() as $row){ echo $row->sessionn_name;  }?>
                      </p>
                      <p align="left">&nbsp;</p>
                      
                </div><p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span></p>
           
                
                
                
              </p>
              
              <p align="left">
              <h3>Courses Available  !</h3>
              <table width="100%"  class="" >
                <thead>
                  <tr bgcolor="#ffffff">
                    <th width="5%"><div align="left" class="style6"><span class="style4">CH</span></div></th>
                    <th width="15%"><div align="left" class="style6"><span class="style4">COURSE CODE</span></div></th>
                    <th width="50%"><div align="left" class="style6"><span class="style4">COURSE TITLE </span></div></th>
                    <th width="15%"><div align="left" class="style6"><span class="style4">CREDIT UNIT</span></div></th>
                    <th width="20%"><div align="center" class="style6"><span class="style4">COURSE TYPE</span></div></th>
                    </tr>
                  </thead>
                <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	 $query1 =mysql_query("select* from course_assigned_to_department where semester_id='$semester' and student_type_id='$student_type_id' and department_id='$deptid' and dept_option_id='$deptsoptions' and year_of_study_id='$level_id' and programme_type_id='$programme_type_id'") or die(mysql_error());
								while(list($id1,$courseid,$course_unit,$course_type_id) = mysql_fetch_array($query1))
								{?>
                <tbody>
                  <tr bgcolor="#E2E2E2">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td><div align="left"><span class="style5">
                      <input name="course_assign_id[]" type="checkbox" value="<?php echo $id1;?>">
                      </span></div></td>
                    <td><div align="left"><span class="style5">
                      <?php $q1=mysql_query("select *  from eduportal_courses where course_id='$courseid'")or die (mysql_error());
		  
		  while(list($courseid1,$coursecode1,$course_title1)=mysql_fetch_array($q1))
		  {echo  $coursecode1;}?>
                      </span></div></td>
                    <td><div align="left"><span class="style5">
                      <?php $q2=mysql_query("select *  from eduportal_courses where course_id='$courseid'")or die (mysql_error());while(list($courseid2,$coursecode2,$course_title2)=mysql_fetch_array($q2))
		  {echo  $course_title2;}?>
                      </span></div></td>
                    <td><div align="left"><span class="style5"><?php echo $course_unit;?></span>
                      <input type="hidden" name="creditunit<?php echo $id1;?>" value="<?php echo $course_unit;?>"/>
                      </div></td>
                    <td><div align="center"><span class="style5">
                      <?php $q3=mysql_query("select *  from course_type
 where course_type_id='$course_type_id'")or die (mysql_error());while(list($course_type_id,$course_type_name)=mysql_fetch_array($q3))
		  {echo  $course_type_name;}?>
                      </span></div></td>
                    </tr>
                  </tbody>
                <?php 
				  $id = $id +1;
				
				  
				  }
				    if($id<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses have been assigned for this Selection!</h3></td></tr>";
				  }
				  ?>
              </table>
              <p align="left">
               <br> <input type="submit" name="submit" id="submit" value="  Register Selected Courses!   " height="35px">
                </p>
              <p align="left"> <a href="#" onClick="javascript: window.close();"> <h2 style="background-color:#CCC; width:100px; text-align:center"><strong><b>Close </b></strong></h2></a><br /><h3>&nbsp;</h3></p>
              <p align="left"><br>
              </p>
                  
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>
 <input type="hidden" name="school"  value="<?php echo $school_id;?>"/>
                <input type="hidden" name="programme" value="<?php echo $student_type_id;?>"/>
                <input type="hidden" name="depts" value="<?php echo $deptid;?>"/>
                <input type="hidden" name="studentid"  value="<?php echo $stuReg->student_id;?>"/>
                <input type="hidden" name="portal_id"  value="<?php echo $portal_id;?>"/>
                <input type="hidden" name="year_of_study"  value="<?php echo $level_id;?>"/>
                 <input type="hidden" name="session"  value="<?php echo $session_id;?>"/>
                 <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
                
                  <input type="hidden" name="programme_type_id"  value="<?php echo $programme_type_id;?>"/>
 <input type="hidden" name="sem" value="<?php foreach($semester1->result() as $row){ echo $row->semester_name;}?>"/>
<input type="hidden" name="level_of_study" value="<?php foreach($levels->result() as $row){ echo $row->year_of_study_name;}?>"/>
                  </form>
                  <?php //$this->session->set_userdata(array('session_id'=>$session_id));
				 // $this->session->set_userdata(array('sess'=>$session_id));
//$this->session->set_userdata(array('level_id'=>$level_id));
					//	$this->session->set_userdata(array('semester_id'=>$semester));
						//$this->session->set_userdata(array('programme'=>$programme));
						//$this->session->set_userdata(array('depts'=>$deptid));

				  ?>
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>


