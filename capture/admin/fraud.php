<?php

include_once("header.php");
include_once("sidebar.php");
  include_once("../config.php");
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

 $units = fetchAssoc("monitoring_team","unit_name");
 $select = "<select name = 'unit'><option>Security Unit(s)</option>";
 for($i = 0; $i < count($units); $i++) {
   $select .= "<option value = '".$units[$i]['unit_name']."'>".$units[$i]['unit_name']."</option>";
 }
 $select .= "</select>";

$form = <<<EOP
  <h2> Fraud Notice Form</h2>
    <form role="form" id = "accountForm" action="fraud.php" method="post">
          <div class="form-group input-group">
              <input type="text" class="form-control" placeholder="Account Number" name="account_number"/>
            </div>
              <div class="form-group input-group">
                  $select
              </div>

              <div class="form-group input-group">
                  <textarea class="form-control" placeholder="Fraud Description" name="desc" rows='5' cols = '5'></textarea>
              </div>
              <input type="submit" class="btn btn-success" name="send" value="Send"/>
      </form>
EOP;
$content = '';
if(isset($_POST['send'])) {
  $unit = $_POST['unit'];
  $description = $_POST['desc'];
  $account_number = $_POST['account_number'];

  //include_once("../config.php");

  //write to db
  $stm = $db->prepare("INSERT INTO `$dbname`.`fraud`(account_number,description,unit_name)
  VALUES('$account_number','$description','$unit')");
  $stm->execute();

  //send sms/email notification to security unit

   $content = "<h2 style='color:green'>Fraud Notification sent successfuly</h2>";
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
