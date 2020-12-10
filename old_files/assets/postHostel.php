<?php
include('../application/config/z.php');
$data = json_decode(file_get_contents("php://input"));
//$fstname = mysql_real_escape_string($data->fstname);
//$lstname = mysql_real_escape_string($data->lstname);
$idno = $data->idno;
$serial = $data->serial;
$id = $data->id;
$pin    = $data->pin;
$hostel   = $data->hostel;
$room 	 = $data->room;
$space 	 = $data->space;
$edate   = $data->edate;
$author   = $data->author;
$date    = date("Y-m-d");

//print_r($data);


if($serial != '' && $id != ''){

$query = "UPDATE `counter` 
          SET `idno` = '$idno',
          	  `serial`  =  '$serial',
          	  `pin`  = '$pin',
          	  `hostel_name`   = '$hostel',
			        `room_no` = '$room',
              `space` = '$space',
              `edit_date`   = '$edate',
              `edited_by` ='$author'

          WHERE `id` = '$id';";

// Execute the query
          //print_r($query);
$result = mysql_query($query) or die(mysql_error());
//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);


// Check for errors
if (mysql_affected_rows() == 0) {
//if (!$result) {
  
  echo "Update record failed";

} else {

// Print the table
  echo "Accommodation records were edited successfully";

}
}
else
	echo "please enter a serial number";

//echo $conf."".$fstname."".$lstname."".$prog_type;
?>