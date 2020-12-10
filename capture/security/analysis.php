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
  <h2> Fraud Analysis</h2>
    <form role="form" id = "accountForm" action="analysis.php" method="post">
              <div class="form-group input-group">
                  <input type="date" class="form-control" placeholder="Date" name="date"/>
              </div>
              <div class="form-group input-group">
                  <textarea class="form-control" placeholder="Description" name="desc" rows="5" cols="5"></textarea>
              </div>

              <div class="form-group input-group">
                  <textarea class="form-control" placeholder="Progress Report" name="report" rows="5" cols="5"></textarea>
              </div>

              <input type="submit" class="btn btn-success" name="create" value="Save"/>
      </form>
EOP;
$content = '';
if(isset($_POST['create'])) {
  $date = $_POST['date'];
  $desc = $_POST['desc'];
  $report = $_POST['report'];

  include_once("../config.php");
  $stm = $db->prepare("INSERT INTO `$dbname`.`fraud_analysis`(fraud_date,description,report)
  VALUES('$date','$desc','$report')");
  $stm->execute();

   $content = "<h2>Fraud Analysis Saved Successfully</h2>";
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
