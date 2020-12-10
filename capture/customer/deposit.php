<?php

include_once("header.php");
include_once("sidebar.php");


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
<h2> Deposit Form</h2>
    <form role="form" id = "accountForm" method = "post" action = "deposit.php">
              <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Account Number" name="account_number"/>
              </div>
              <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Amount" name="amount"/>
              </div>
                   <input type="submit" class="btn btn-success" name="deposit" value="Deposit"/>
    </form>
EOP;

$content = '';

if(isset($_POST['deposit'])) {
  include_once "../config.php";
  $account_number = $_POST['account_number'];
  $amount = $_POST['amount'];
  //Deposit
  $deposit = transaction($account_number,$amount,"deposit");
  if(!$deposit) $content = '<h2>Deposit Not successful</h2>';
  else $content = '<h2>Deposit successful</h2>';

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
