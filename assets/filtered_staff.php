

<?php
include('../application/config/z.php');

$q = $_GET['dept_code'];   
$sql = "select * from erp_staff where dept_code = '$q' ";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
echo "<select   id='sid'  name='sid' class='form-control' required>";
	echo "<option value=''>SELECT STAFF </option>";
	while($row = sqlsrv_fetch_array($r)){?>
		<option value='<?php echo $row['sid'];?>'><?php echo $row['FULL_NAME'];?></option>
	    <?php }
?>
    </select>
    <?php sqlsrv_close($conn);
?>
