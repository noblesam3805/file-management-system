<?php //$school1 = $this->db->query("select *  from schools where schoolid='$school'");
//$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'");
//foreach($student_type->result() as $row1)
//{
//if($row1->student_type_id=="1")
//{
//	$dept = $this->db->query("select *  from department where deptID='$depts'");
//}
//else
//{
//	$dept = $this->db->query("select *  from putme_nce_dept where deptID='$depts'");
//}
//}
//
//$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");
////$programme_type_id = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
//$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
//$courses = $this->db->query("select *  from eduportal_courses order by course_code");
////$session =  $this->db->query("select *  from course_session where session_id='$session'");
//$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level'");
//$course_types =    $this->db->query("select *  from course_type ");
//$credit_units =    $this->db->query("select *  from course_unit");
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
							 <div id="table-content"  style="width:100%; overflow:scroll; margin:20px;">
			
			<h3>Course Assignment Report! </h3>
			<hr />
	
			
				<div id='preview'><table width="1450"  class="" >
      <thead>
        <tr bgcolor="#ffffff" style="border-bottom:1px solid #000000;">
          <th width="33"><div align="left" class="style6"><span class="style4">ID</span></div></th>
          <th width="206"><div align="left" class="style6">
            <div align="left"><span class="style4"> NAME  </span></div>
          </div></th>
          <th width="112"><div align="left" class="style6">
            <div align="left"><span class="style4">EMAIL</span></div>
          </div></th>
          <th width="153"><div align="left" class="style6">
            <div align="left"><span class="style4">DEPARTMENT</span></div>
          </div></th>
          <th width="485" align="left"><div class="style6">
            <div >
              <div align="center"><span class="style4" align="center">COURSES ASSIGNED </span>
              </div>
              <table width="482" border="0">
                <tr>
                  <td width="56"><strong>NCE1</strong></td>
                  <td width="56"><strong>NCE2</strong></td>
                  <td width="56"><strong>NCE3</strong></td>
                  <td width="56"><strong>DEG1</strong></td>
                  <td width="56"><strong>DEG2</strong></td>
                  <td width="56"><strong>DEG3</strong></td>
                  <td width="56"><strong>DEG4</strong></td>
                  <td width="56"><strong>DEG5</strong></td>
                </tr>
              </table>
            </div>
          </div></th>
          <th width="433"><div align="center" class="style6"><span class="style4">MAXIMUM AND MINIMUM UNIT  LOAD ASSIGNED </span>
              <table width="482" border="0">
              <tr>
                <td width="56"><strong>NCE1</strong></td>
                <td width="56"><strong>NCE2</strong></td>
                <td width="56"><strong>NCE3</strong></td>
                <td width="56"><strong>DEG1</strong></td>
                <td width="56"><strong>DEG2</strong></td>
                <td width="56"><strong>DEG3</strong></td>
                <td width="56"><strong>DEG4</strong></td>
                <td width="56"><strong>DEG5</strong></td>
              </tr>
            </table>
          </div></th>
		  </tr>
      </thead>
    
	  <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	 $query =mysql_query("SELECT sadmin_id, name, email,deptName FROM `sadmin` a, `department` b WHERE  a.level=4 and a.dept_id=b.deptid") or die (mysql_error());
while(list($sid,$sname,$semail,$deptname) = mysql_fetch_array($query))

	// $query1 =mysql_query("select* from course_assigned_to_department where semester_id='$semester' and student_type_id='$programme' and department_id='$depts' and year_of_study_id='$level' and programme_type_id='$programme_type_id'") or die(mysql_error());
//								while(list($id1,$courseid,$course_unit,$course_type_id) = mysql_fetch_array($query1))
							{?>
         <tbody> 
          <tr style="border-bottom:1px solid #000000;"><td height="39" ><div align="left"><?php echo $id;?></div></td>
          <td><div align="left"><?php echo $sname;?></div></td>
         
          <td><div align="left"><?php echo $semail;?></div></td>
          <td><div align="left"><?php echo $deptname;?></div></td>
		 
          <td><div align="left">
            <table width="482" border="0">

              <tr>
                <td width="55">
                  <div align="center">
                    <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='2' OR f.year_of_study_id='5')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                  </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='3' OR f.year_of_study_id='6')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='4' OR f.year_of_study_id='8')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='9' OR f.year_of_study_id='13')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='10' OR f.year_of_study_id='14' OR f.year_of_study_id='18')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='11' OR f.year_of_study_id='15' OR f.year_of_study_id='19')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='12' OR f.year_of_study_id='16'  OR f.year_of_study_id='20')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
				  <td width="56"><div align="center">
                  <?php	 $query1 =mysql_query(" SELECT sadmin_id,name, student_type_name as PROGRAMME, programme_type_name as PROGRAMME_TYPE, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER,course_code as 

COURSE_CODE,course_title as COURSE_TITLE,course_unit as CREDIT_UNIT FROM 

`course_assigned_to_department` a, eduportal_courses b, course_semester c, student_type d, 

course_year_of_study f, department g, programme_type h, sadmin i where a.course_id=b.course_id and 

a.semester_id=c.semester_id and a.student_type_id= d.student_type_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID and 

a.`programme_type_id` = h.programme_type_id and a.user_id =i.sadmin_id and a.user_id=$sid and (f.year_of_study_id='17' OR f.year_of_study_id='21')") or die(mysql_error());
while(list($sid2,$sname2,$st2,$prt2,$dept2,$yr2,$sem2,$code2,$ct2) = mysql_fetch_array($query1))
{
echo $code2.", ";
}
?>
                </div></td>
              </tr>
            </table>
          </div></td>
          <td><div align="center">
            <table width="482" border="0">
              <tr>
                <td width="55"><div align="center">
                    <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='2' OR f.year_of_study_id='5')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='3' OR f.year_of_study_id='6')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='4' OR f.year_of_study_id='8')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='9' OR f.year_of_study_id='13')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='10' OR f.year_of_study_id='14' OR f.year_of_study_id='18')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='11' OR f.year_of_study_id='15' OR f.year_of_study_id='19')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='12' OR f.year_of_study_id='16'  OR f.year_of_study_id='20')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
                <td width="56"><div align="center">
                  <?php	 $query9 =mysql_query("SELECT sadmin_id,name, maximum_unit,minimum_unit, deptName as 

DEPARTMENT,year_of_study_name as LEVEL,semester_name as SEMESTER FROM 

`course_unit_load` a,  course_semester c,  

course_year_of_study f, department g,  sadmin i where  

a.semester_id=c.semester_id and 

a.`year_of_study_id`=f.year_of_study_id and a.`department_id`=g.deptID  and a.user_id =i.sadmin_id and a.user_id='$sid' and (f.year_of_study_id='17' OR f.year_of_study_id='21')") or die(mysql_error());
while(list($sid3,$sname3,$max2,$min2,$dept2) = mysql_fetch_array($query9))
{
echo "MAX: ".$max2." - MIN: ".$min2.", ";
}
?>
                </div></td>
              </tr>
            </table>
          </div></td>
          </tr>
				 </tbody> <?php 
		  $id = $id +1;
//				
//				  
		  }
				    if($id<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Course Adviser Record Available!</h3></td></tr>";
			  }
				  ?>
</table>
				</div> </p>
			  <p><h4>&nbsp;</h4><p align="center"><br>
                        <input type="submit" name="submit" id="submit" value="  Assign Courses  " height="35px">
                      </p>
			</div>
			</ul>						
                  </div>
              </div>
		  </div>
		  </div>
		</form>
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

