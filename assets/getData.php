<?php
include('../application/config/e.php');

if( $_REQUEST['student'] == 'a'){
$query="select * from student";
//$query="select * from etranzact_paymen";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = $result->num_rows;

echo $arr;
}
else if( $_REQUEST['etz'] == 'b'){
$query="select * from etranzact_payment";
//$query="select * from etranzact_paymen";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arrw = $result->num_rows;

echo $arrw;
}
else if( $_REQUEST['hostel'] == 'c'){
$query="select * from counter";
//$query="select * from etranzact_paymen";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arrs = $result->num_rows;

echo $arrs;
}
?>