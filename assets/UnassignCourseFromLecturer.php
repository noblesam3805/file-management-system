<?php
include('../application/config/z.php');
$courseassignedid = $_GET['courseassignedid'];
sqlsrv_query($conn,"delete from course_assigned_to_lecturers where course_assigned_to_dept_id='$courseassignedid'") or die("Error5:".sqlsrv_errors());
sqlsrv_query($conn,"update course_assigned_to_department set lecturer_id='0' where id='$courseassignedid'") or die("Error5:".sqlsrv_errors());
echo '';
?>