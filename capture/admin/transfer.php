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

                <div class="row">
                <div class="col-lg-3"></div>
                	<div class="col-lg-6">
                	<h2> Fund Transfer Form</h2>
                			<form role="form" id = "accountForm">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Sender Account Number" name="sender_account"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Amount" name="amount"/>
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Receiver Account Number" name="receiver_account"/>
                                </div>

                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Bank Name" name="bank_name"/>
                                </div>

                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Account Name" name="account_name"/>
                                </div>
                                
                                <div class="form-group input-group">
                                   	<select name = "account_type">
                                   		<option value = "account_type">Account Type</option>
                                   		<option value = "savings">Savings</option>
                                   		<option value="current">Current</option>
                                   	</select>
                                </div>
                                     <input type="submit" class="btn btn-success" name="transfer" value="Transfer"/>
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