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

$content = '';
if(isset($_GET['data'])) {
  include_once("../config.php");
  $data = $_GET['data'];
  if($data == 'frauds')
    $content = list_data("frauds",array('id','unit_name','description'));
  else if($data == "teams") $content = list_data('monitoring_team',array('id','unit_name','email','phone'));
  else if($data == "logs") $content = list_data('login',array('id','account_number','login_time','gps',"ip_address"));
  else $content = list_data('customer',array('id','first_name','last_name','phone','account_number'));

}

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
include_once "footer.php";
?>
