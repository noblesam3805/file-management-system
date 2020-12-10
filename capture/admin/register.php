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
  <h2> Create Admin Account</h2>
    <form role="form" id = "accountForm" action="register.php" method="post">
              <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Admin Name" name="admin_name" required/>
              </div>
              <div class="form-group input-group">
                  <select name = "gender" required>
                    <option value = "gender">Gender</option>
                    <option value = "male">Male</option>
                    <option value="female">Female</option>
                  </select>
              </div>
              <div class="form-group input-group">
                  <input type="password" class="form-control" placeholder="Admin Password" name="psw1" required/>
              </div>
              <div class="form-group input-group">
                  <input type="password" class="form-control" placeholder="Re-type password" name="psw2" required/>
              </div>
			           <div class="form-group input-group">
                  <select name = "acct" required>
                    <option value = "0">Select Account Type</option>
                    <option value = "Teller">Teller</option>
                    <option value="Account Officer">Account Officer</option>
					<option value="Unit Admin">Unit Admin</option>
					<option value="Customer Service Agent">Customer Service Agent</option>
                  </select>
              </div>
              <input type="submit" class="btn btn-success" name="create" value="Create Admin"/>
      </form>
EOP;
$content = '';
if(isset($_POST['create'])) {
  $admin_name = $_POST['admin_name'];
  $gender = $_POST['gender'];
  $password1 = $_POST['psw1'];
  $password2 = $_POST['psw2'];
  $acct = $_POST['acct'];


  $stm = $db->prepare("INSERT INTO `$dbname`.`admin`(admin_name,gender,password,user_role,account_stats)
  VALUES('$admin_name','$gender','$password1','$acct','Active')");
  $stm->execute();

   $content = "<h2>Admin Registration Successful</h2>";
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
