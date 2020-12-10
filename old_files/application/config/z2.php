<?php

$serverName = "(local)";
//$connectionInfo = array( "Database"=>"yabatech_edu_por");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//$serverName = "MYHP-PC"; //serverName\instanceName
$connectionInfo = array( "Database"=>"yabatech_application_portal", "UID"=>"sa", "PWD"=>"m3AeFRPQ(64327)MR");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn )
{
  // echo "Connection established.\n";
}
else
{
     echo "Connection could not be established.\n";
     die( print_r( sqlsrv_errors(), true));
}
	
	
?>