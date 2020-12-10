<?php
include('../application/config/e.php');
if( $_REQUEST['id'] )
{
   $id = $_REQUEST['id'];
$query="delete from manual_etranzact where id ='$id' ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

echo "Payment Record has been deleted";
}
?>