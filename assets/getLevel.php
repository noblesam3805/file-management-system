<?php
session_start();
include('../application/config/z.php');
	
	$progtype = $_REQUEST['progtype'];

	$sql = "select year_of_study_id,year_of_study_name from course_year_of_study where programme_type_id = '$progtype'";
	$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
	echo "<select id='level' name='level'  class='form-select required' required>";
	echo "<option value=''>SELECT YOUR CURRENT LEVEL</option>";
while($row = sqlsrv_fetch_array($r)){?>
		<option value='<?php echo $row['year_of_study_id'];?>'><?php echo $row['year_of_study_name'];?></option>
	    <?php }
		
?>
    </select>
   