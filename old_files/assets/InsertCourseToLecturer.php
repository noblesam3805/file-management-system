<?php
include('../application/config/z.php');
$lecturer = $_GET['lecturer']; 
$courseassignedid = $_GET['courseassignedid']; 
$sessionid = $_GET['sessionid']; 
$semester = $_GET['semester']; 


 $query17 =sqlsrv_query($conn,"select sadmin_id,name,dept_id from sadmin where sadmin_id='$lecturer'") or die("Error5:".sqlsrv_errors());
		 // $res = mysql_result($query15,0);
		  while(list($sadminid,$lname,$dept_id)=sqlsrv_fetch_array($query17))
		  {
			  
 $query18=sqlsrv_query($conn,"select* from department where deptID='$dept_id'") or die("Error5:".sqlsrv_errors());
		 // $res = mysql_result($query15,0);
		
		  while(list($deptid,$deptName)=sqlsrv_fetch_array($query18))
		  {
			  
			  sqlsrv_query($conn,"insert into course_assigned_to_lecturers (course_assigned_to_dept_id,lecturer_dept_id,lecturer_department_name,lecturer_id,session,semester) values ('$courseassignedid','$deptid','$deptName','$lecturer','$sessionid','$semester')") or die("Error5:".sqlsrv_errors());		
sqlsrv_query($conn,"update course_assigned_to_department set lecturer_id='$lecturer' where id='$courseassignedid'") or die("Error5:".sqlsrv_errors());
			  ?>
              
<?php echo $lname. ' - '.$deptName;?> </option>
       <?php
		  }
		  }

?>