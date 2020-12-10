<?php
if( isset( $_GET['orderID'] )) {
$orderID = $_GET["orderID"];
header("Location: http://erp.yabatech.edu.ng/portal/apis/payonlineresponse.php?orderID=$orderID");
exit;
}

?>