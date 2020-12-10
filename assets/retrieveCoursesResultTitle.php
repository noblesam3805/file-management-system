<?php
include('../application/config/z.php');
$student_type_id = $_GET['programme']; 
$programme_type_id = $_GET['programme_type_id']; 
$semester_id = $_GET['semester']; 
$department_id = $_GET['depts']; 
$year_of_study_id = $_GET['level']; 
$session = $_GET['session']; 
$school = $_GET['school']; 

if($student_type_id=="1")
{
	$sql1 = mysql_query("select *  from department where deptID='$department_id'") or die (mysql_error());;
	while($row = mysql_fetch_array($sql1))
{
$dept = $row['deptName'];
}
}
else
{

		$sql1 = mysql_query("select *  from putme_nce_dept where deptID='$department_id'") or die (mysql_error());;
	while($row = mysql_fetch_array($sql1))
{
$dept = $row['deptName'];
}
}
  
$sql2 = mysql_query("select *  from schools where schoolid='$school'") or die (mysql_error());;
	while($row = mysql_fetch_array($sql2))
{
$school1 = $row['schoolname'];
}

$sql3 = mysql_query("select *  from student_type where student_type_id='$student_type_id'") or die (mysql_error());;
	while($row = mysql_fetch_array($sql3))
{
$student_type = $row['student_type_name'];
}
//$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester_id'")->row()->semester_name;
//$programme_type_id = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
$sql4 = mysql_query("select *  from programme_type where programme_type_id='$programme_type_id'") or die (mysql_error());;

while($row = mysql_fetch_array($sql4))
{
$programme_type = $row['programme_type_name'];
}
//$courses = $this->db->query("select *  from eduportal_courses order by course_code")->row()->;
//$session =  $this->db->query("select *  from course_session where session_id='$session'");
$sql5 = mysql_query("select *  from course_year_of_study where year_of_study_id='$year_of_study_id'") or die (mysql_error());;
while($row = mysql_fetch_array($sql5))
{
$levels = $row['year_of_study_name'];
}


$sql = "select distinct course_title from student_sessional_results where  semester='$semester_id' and session='$session' and department='$dept' and school='$school1' and level='$levels' and programme='$student_type' and programme_type='$programme_type'";
$r = mysql_query($sql) or die (mysql_error());
//echo $dept.'-'.$semester_id.'-'.$session.'-'.$programme_type.'-'.$school1.'-'.$levels.'-'.$programme_type_id;
?>
<select  name="course" id="course" class="form-select required"><option value="" selected="selected" >- Select Course Title -</option>

	
<?php 
while($row = mysql_fetch_array($r))
{
$course_title = $row['course_title'];
//$inst_id = $row['year_of_study_id'];?>	
<?php	echo "<option value ='$course_title'> $course_title </option>";?>

	<?php
}
?>
 </select>

<?php

mysql_close();
?>