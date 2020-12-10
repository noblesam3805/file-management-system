

<?php
include('../application/config/z.php');

$q = $_GET['dept_code'];   
$sql = "select * from sadmin a, erp_staff_designations b where a.desig_id=b.designation_id and a.dept_id = '$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
echo "<select   id='sid' onchange='filter_staff_email(this.value);' onclick='filter_staff_email(this.value);'   name='sid' class='form-control class='form-control eduportal-input' style='width: 300px' required>";
	echo "<option value=''>SELECT STAFF </option>";
	while($row = sqlsrv_fetch_array($r)){?>
		<option value='<?php echo $row['sadmin_id'];?>'><?php echo $row['name'];?> (<?php echo $row['designation_name'];?>)</option>
	    <?php }
?>
    </select>
    <?php sqlsrv_close($conn);
?>
