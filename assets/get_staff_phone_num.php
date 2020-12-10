

<?php
include('../application/config/z.php');

$q = $_GET['email'];   
$sql = "select * from erp_staff where email = '$q'";
$r = sqlsrv_query($conn,$sql)or die("Error5:".sqlsrv_errors());

	$row = sqlsrv_fetch_array($r);
	?>
		
		  <input type="text" name="email" id="email" required="required"  class="form-control eduportal-input" style="width:300px"  value="<?php echo $row['mobile'];?>"  />
	   

  
    <?php sqlsrv_close($conn);
?>
