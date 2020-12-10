<?php
session_start();
include('application/config/z.php');
	function get_dept_name($data)
	
	{
		
		$q= mysql_query("select deptName from department where deptID='$data'") or die(mysql_error());
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
	
		function get_programme_name($data)
	
	{
		
		$q= mysql_query("select student_type_name from student_type where student_type_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	
	}
	
		function get_programmetype_name($data)
	
	{
		
		$q= mysql_query("select programme_type_name from programme_type where programme_type_id='$data'") or die(mysql_error());
		while(list($programme_type_name)=mysql_fetch_array($q))
		{
			echo strtoupper($programme_type_name);
		}
	
	
	}
	
	function get_level_name($data)
	
	{
		
		$q= mysql_query("select year_of_study_name from course_year_of_study where year_of_study_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	
	}
	
$applicants = $this->db->query("select *  from student where prog_type ='$id' order by dept");
{
	$sn=1;

?><br>
<table width="100%" border="1" bgcolor="#FFFFFF" style="background-color:#FFF">
<tr>
    <td width="25" colspan="8">STUDENTS INFORMATION</td>
 
    
  </tr>
  <tr>
    <td width="25" colspan="8">PROGRAMME: <?php get_programmetype_name($id);?></td>
 
    
  </tr>
  
  <tr>
    <td width="25">SN</td>
    <td width="100">FULLNAME</td>
    <td width="152">DEPARTMENT</td>
    <td width="152">SCHOOL</td>
    <td width="79">PROGRAMME</td>
    <td width="63">LEVEL</td>
    <td width="124">EMAIL</td>
    <td width="124">PHONE NO</td>
    
  </tr>
  <?php foreach($applicants->result() as $row2)

	{
		?>
  <tr>
    <td><?php echo $sn;?></td>
    <td><?php echo strtoupper($row2->othername." ". $row2->name);?></td>
    <td><?php echo get_dept_name($row2->dept);?></td>
    <td><?php echo get_school_name($row2->school);?></td>
    <td><?php get_programmetype_name($id);?></td>
    <td><?php get_level_name($row2->level);?></td>
    <td><?php $onames= explode(' ',$row2->othername) ;
	$fname=$onames[0];
	$shortfname= substr($fname,0,1);
	echo trim(strtolower($shortfname)).trim(strtolower($row2->name)).'@stu.fpno.edu.ng';
	?></td>
     <td><?php echo $row2->phone;?></td>
   
  </tr>
  <?php  $sn++; }?>
</table>
<?php }?>