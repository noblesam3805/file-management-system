<?php
//$serverName = "MYHP-PC"; //serverName\instanceName
//$connectionInfo = array( "Database"=>"APPINVOICE", "UID"=>"sa", "PWD"=>"junior");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//
//if( $conn ) {
//     echo "Connection established.<br />";
//}else{
//     echo "Connection could not be established.<br />";
//     die( print_r( sqlsrv_errors(), true));
//}
//echo "Hello";
$server = 'MYHP-PC';

// Connect to MSSQL
$link = mssql_connect($server, 'sa', 'm3AeFRPQ(3RHBx5)PK');

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}
?>
