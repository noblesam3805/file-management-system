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
 <h2> WithDrawal Form</h2>
     <form role="form" id = "accountForm" action ="withdraw.php" method ="post">

               <div class="form-group input-group">
                   <input type="text" class="form-control" placeholder="Account Number" name="account_number"/>
               </div>

               <div class="form-group input-group">
                   <input type="text" class="form-control" placeholder="Amount" name="amount"/>
               </div>

               <div class="form-group input-group">
                   <input type="password" readonly class="form-control" placeholder="Voice Password" id = "bio_pass" name="bio_pass" style="color:blue;"/>
                   <div id="bio_data"></div>
               </div>
               <a href="#" onclick ="talk()" class="btn btn-primary">Voice Password</a>

               <input type="submit" class="btn btn-success" name="withdraw"/>
       </form>
EOP;

 $content = '';

 if(isset($_POST['withdraw'])) {
   include_once "../config.php";
   $account_number = $_POST['account_number'];
   $amount = $_POST['amount'];
   $voice_bio = $_POST['bio_pass'];
   $withdraw;
   //check Password
   $pass = fetchAssoc("customer","id","bio_data='$voice_bio'");
   if($pass != -1)
   {
     //Withdraw
     $withdraw = transaction($account_number,$amount,"widthraw");
     $balance = check_balance($account_number);
   }
   if(!$withdraw) $content = '<h2>Withdrawal Not successful</h2>';
   else $content = '<h2>Withdrawal successful</h2><h3>balance = '.$balance.'</3>';

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

                <div class="row">
                <div class="col-lg-3"></div>
                	<div class="col-lg-6">

                   </div>
                   <div class="col-lg-3"></div>
                </div>

            </div>



        </div>
        <!--END PAGE CONTENT -->

<?php
include_once "rsidebar.php";
include_once "footer.php";
?>
