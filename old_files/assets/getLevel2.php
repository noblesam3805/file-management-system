<?php
include('../application/config/z.php');
	
	$progtype = $_REQUEST['progtype'];
	//echo $prog;
	
	$sql = "select distinct level from programmes where prog_type = '$progtype'";
	$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());
	
	echo "<select id='level' name='level'  class='form-control'>";
	
	echo "<option value=''>SELECT YOUR CURRENT LEVEL</option>";
	while($row = sqlsrv_fetch_array($r)){
		echo "<option value='" . $row['level'] . "'>" . $row['level'] . "</option>";
	}
	echo "</select>";
?>
    <?php sqlsrv_close($conn);//unset($_SESSION["stu_typ"]);?>