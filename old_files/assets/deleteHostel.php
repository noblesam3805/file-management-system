<?php
include('../application/config/e.php');
if( $_REQUEST['id'] )
{
   $id = $_REQUEST['id'];
$query="delete from counter where id ='$id' ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

echo "Accomodation Record has been deleted";
}
?>