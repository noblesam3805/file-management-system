<?php
define("MERCHANTID", "532776942");
define("SERVICETYPEID", "533711204");
define("APIKEY", "587460");
define("GATEWAYURL", "https://login.remita.net/remita/ecomm/split/init.reg");
define("GATEWAYRRRPAYMENTURL", "https://login.remita.net/remita/ecomm/finalize.reg");
define("CHECKSTATUSURL", "https://login.remita.net/remita/ecomm/merchantId/OrderId/hash/orderstatus.reg");
define("PATH", 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
?>