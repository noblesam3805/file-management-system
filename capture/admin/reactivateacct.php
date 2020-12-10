<?php
include_once("../config.php");
  db_connect();
  $acct = $_GET['acct'];
    mysql_query("delete from attempts where account_no='$acct'") or die(mysql_error());
  mysql_query("update customer set status='Active' where account_number='$acct'") or die(mysql_error());
  header("Location: list.php?data=customers");
?>

