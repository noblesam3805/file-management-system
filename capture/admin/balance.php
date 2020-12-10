<?php

include_once("header.php");
include_once("sidebar.php");
 include_once "../config.php";
 db_connect();

?>

<!--PAGE CONTENT -->
        <div id="content">

            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Admin Dashboard </h1>
                    </div>
                </div>

<?php
    include_once "menu.php";
 ?>

<?php

$form = <<<EOP
<h2> Balance Enquiry Form</h2>
 <form role="form" id = "accountForm" action = 'balance.php' method = 'post'>

           <div class="form-group input-group">
               <input type="text" class="form-control" placeholder="Account Number" name="account_number"/>
           </div>

           <input type="submit" class="btn btn-success" name="balance"/>
   </form>
EOP;

$content = '';

if(isset($_POST['balance'])) {
 
  $account_number = $_POST['account_number'];
  //Deposit
  $balance = check_balance($account_number,$amount,"deposit");
  $content = '<h2>Balance</h2><h1>N'.$balance."</h1>";

}
else $content = $form;

$page = <<<EOP
                <div class="row">
                <div class="col-lg-3"></div>
                	<div class="col-lg-6">
                  $content
                   </div>
                   <div class="col-lg-3"></div>
                </div>

            </div>

        </div>
        <!--END PAGE CONTENT -->
EOP;

echo $page;


?>

<?php
include_once "rsidebar.php";
include_once "footer.php";
?>
