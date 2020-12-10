<?php
include('../application/config/z.php');
$p = $_GET['programme']; 
$pt = $_GET['programme_type_id'];  
 
$sql = "SELECT * FROM course_year_of_study where student_type_id ='$p''";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
?>
<select  name="level" id="level" class="form-select required"><option value="" selected="selected" >- Select Level -</option>

	
<?php 
while($row = sqlsrv_fetch_array($r))
{
$inst_name = $row['year_of_study_name'];
$inst_id = $row['year_of_study_id'];?>	
<?php	echo "<option value ='$inst_id'> $inst_name </option>";?>

	<?php
}
?>
 </select>

<?php

sqlsrv_close($conn);
?>