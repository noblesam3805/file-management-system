<?php
include('../application/config/z.php');
$data = json_decode(file_get_contents("php://input"));
//$fstname = mysql_real_escape_string($data->fstname);
//$lstname = mysql_real_escape_string($data->lstname);
$fullname = $data->fullname;
$conf = $data->conf;
$id = $data->id;
$regn    = $data->regn;
$descr   = $data->descr;
$receipt 	 = $data->receipt_no;
$session 	 = $data->session;
$prog_type = $data->prog_type;
$phone    = $data->phone;
$address = $data->address;
$dept 	 = $data->dept;
$level   = $data->level;
$edate   = $data->edate;
$author   = $data->author;
$date    = date("Y-m-d");

//print_r($data);


if($conf != '' && $id != ''){

$query = "UPDATE `manual_etranzact` 
          SET `customer_id` = '$regn',
          	  `prog_type`  =  '$prog_type',
          	  `fullname`  = '$fullname',
          	  `phone`   = '$phone',
			        `session` = '$session',
              `confirm_code` = '$conf',
              `receipt_no` = '$receipt',
              `description` = '$descr',
          	  `level`    = '$level',
          	  `dept`   = '$dept',
          	  `cust_add` ='$address',
              `edit_date`   = '$edate',
              `edited_by` ='$author',
          	  `used_by`  = '$regn',
          	  `payment_date` = '$date',
          	  `status` = 'Paid'

          WHERE `id` = '$id';";

// Execute the query
$result = mysql_query($query) or die("could not connect");
//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);


// Check for errors
if (mysql_affected_rows() == 0) {
//if (!$result) {
  
  echo "Update record failed";

} else {

// Print the table
  echo "Manual fees where paid successfully";

}
}
else
	echo "please enter a confirmation number";

//echo $conf."".$fstname."".$lstname."".$prog_type;
?>