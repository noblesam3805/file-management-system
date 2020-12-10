<?php
include('../application/config/z.php');
	
	$prog = $_REQUEST['prog'];
	//echo $prog;
	
	$sql = "select distinct prog_type from programmes where programme = '$prog'";
	$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
	echo "<select onChange='getLevel2(this.value)' id='progresult' required name='prog_type' class='form-control'>";
	echo "<option value=''>SELECT YOUR PROGRAMME TYPE</option>";
	while($row = sqlsrv_fetch_array($r)){
		echo "<option>" . $row['prog_type'] . "</option>";
	}
	echo "</select>";
?>
 <?php sqlsrv_close($conn);//unset($_SESSION["stu_typ"]);?>