<?php
include('../application/config/z.php');
$coursetitle = $_GET['coursetitle']; 
$courseid = $_GET['courseid']; 
sqlsrv_query($conn,"update eduportal_courses set course_title='$coursetitle' where course_id='$courseid'") or die ("Error");
echo $coursetitle;
?>