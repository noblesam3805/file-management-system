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

 $form = <<<EOP
 <h2> Block Account</h2>
     <form role="form" id = "accountForm">

               <div class="form-group input-group">
                   <input type="text" class="form-control" placeholder="Account Number" name="account_num"/>
               </div>

               <div class="form-group input-group">
                   <input type="text" class="form-control" placeholder="Description" name="desc"/>
               </div>

               <input type="submit" class="btn btn-success" name="Block Account"/>
    </form>
EOP;

 $content = '';

 if(isset($_POST['balance'])) {
   //include_once "../config.php";
   $account_number = $_POST['account_number'];
   $description = $_POST['desc'];
   //Report to monitoring unit
   $stm = $db->prepare("INSERT INTO fraud(account_number,description) VALUES('$account_number','$description')");
   $stm->execute();
   $content = '<h2>Account '.$account_number .'Blocked</h2><h1>Monitoring tearm notified successfuly</h1>';

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
