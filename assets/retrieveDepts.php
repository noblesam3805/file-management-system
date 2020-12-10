<?php
include('../application/config/z.php');
$q = $_GET['school'];
$p = $_GET['programme'];  

$sql = "SELECT * FROM department where schoolid ='$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
?>
<select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 300px" onChange="javascript: filter_act_staff(this.value); "><option value="" selected="selected" >- Select Department -</option>

	
<?php 
while($row = sqlsrv_fetch_array($r))
{
$inst_name = $row['deptName'];
$inst_id = $row['deptID'];?>
<?php	echo "<option value ='$inst_id '> $inst_name </option>";

}
?>


 </select>
 <?php



sqlsrv_close($conn);
?>