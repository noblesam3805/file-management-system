<?php
include('../application/config/z.php');
$q = $_GET['dept'];
 

$sql = "SELECT * FROM dept_options where dept_id ='$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
?>
<select  name="deptsoptions" id="deptsoptions" class="form-select required"><option value="" selected="selected" >- Select Department Option -</option>

	
<?php 
while($row = sqlsrv_fetch_array($r))
{
$inst_name = $row['dept_option_name'];
$inst_id = $row['dept_option_id'];?>
<?php	echo "<option value ='$inst_id '> $inst_name </option>";

}
if(sqlsrv_num_rows($r)<1)
{
	echo "<option value ='0'> NONE </option>";
}
?>


 </select>
 <?php



sqlsrv_close($conn);
?>