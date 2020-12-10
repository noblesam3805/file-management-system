<?php
session_start();
include('../application/config/z.php');
	$prog = $_REQUEST['programme'];
	//echo $prog;
	//unset($_SESSION["stu_typ"]);
	$_SESSION["stu_typ"]=$prog;
	$sql = "select programme_type_id, programme_type_name from programme_type where student_type_id = '$prog'";
    $r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
	echo "<select onChange='getLevel(this.value)' id='prog_type'  name='prog_type' class=' required '>";
	echo "<option value=''>SELECT YOUR PROGRAMME TYPE</option>";
	while($row = sqlsrv_fetch_array($r)){?>
		<option value='<?php echo $row['programme_type_id'];?>'><?php echo $row['programme_type_name'];?></option>
	    <?php }
?>
    </select>
    <?php sqlsrv_close($conn);//unset($_SESSION["stu_typ"]);?>
