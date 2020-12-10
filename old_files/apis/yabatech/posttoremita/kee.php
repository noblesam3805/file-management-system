<?php
$serverName = "(local)";
//$connectionInfo = array( "Database"=>"yabatech_edu_por");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//$serverName = "MYHP-PC"; //serverName\instanceName
$connectionInfo = array( "Database"=>"yabatech_edu_por", "UID"=>"sa", "PWD"=>"365486@@GT%$7COl");
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