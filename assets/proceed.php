<?php
include('../application/config/z.php');
$data = json_decode(file_get_contents("php://input"));
//$fstname = mysql_real_escape_string($data->fstname);
//$lstname = mysql_real_escape_string($data->lstname);
$fstname = $data->fstname;
$lstname = $data->lstname;
$fullname = $lstname.",".$fstname;
$conf    = $data->conf;
$regn 	 = $data->regn;
$prog_type = $data->prog_type;
$phone    = $data->phone;
$address = $data->address;
$dept 	 = $data->dept;
$level   = $data->level;
$date    = date("Y-m-d");

if($conf != ''){

$query = "UPDATE `etranzact_payment` 
          SET `customer_id` = '$regn',
          	  `prog_type`  =  '$prog_type',
          	  `fullname`  = '$fullname',
          	  `phone`   = '$phone',
          	  `level`    = '$level',
          	  `dept`   = '$dept',
          	  `cust_add` ='$address',
          	  `used_by`  = '$regn',
          	  `payment_date` = '$date',
          	  `status` = 'Paid'

          WHERE `confirm_code` = '$conf';";

// Execute the query
$result = mysql_query($query) or die("could not connect");
//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);


// Check for errors
if (mysql_affected_rows() == 0) {
//if (!$result) {
  
  echo "Update record failed: Confirmation code ".$conf." is not valid";

} else {

// Print the table
  echo "School fees where paid successfully";

}
}
else
	echo "please enter a confirmation number";

//echo $conf."".$fstname."".$lstname."".$prog_type;
?>