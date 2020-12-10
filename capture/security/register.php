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
  <h2> Create Fraud Monitoring Team</h2>
    <form role="form" id = "accountForm" action="register.php" method="post">
              <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Unit Name" name="unit_name"/>
              </div>
              <div class="form-group input-group">
                  <input type="email" class="form-control" placeholder="Email" name="email"/>
              </div>

              <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Mobile Number" name="phone"/>
              </div>

              <input type="submit" class="btn btn-success" name="create" value="Create Team"/>
      </form>
EOP;
$content = '';
if(isset($_POST['create'])) {
  $unit_name = $_POST['unit_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  include_once("../config.php");
  $stm = $db->prepare("INSERT INTO `$dbname`.`monitoring_team`(unit_name,email,phone)
  VALUES('$unit_name','$email','$phone')");
  $stm->execute();

   $content = "<h2>Monitoring Team Created Successfully</h2>";
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
//include_once "rsidebar.php";
include_once "footer.php";
?>
