

<?php
include('../application/config/z.php');

$q = $_GET['faculty_id'];   
$sql = "select * from erp_depts where faculty_id = '$q' ";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
echo "<select onchange='filter_act_staff(this.value);' onclick='filter_act_staff(this.value);' id='dept_code'  name='dept_code' class='form-control eduportal-input' style='width: 300px' required>";
	echo "<option value=''>SELECT  UNIT/SCHOOL </option>";
	while($row = sqlsrv_fetch_array($r)){?>
		<option value='<?php echo $row['dept_code'];?>'><?php echo $row['dept_name'];?></option>
	    <?php }
?>
    </select>
    <?php sqlsrv_close($conn);
?>
