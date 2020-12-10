<?php   session_start(); ?>

<?php
$balance_form = <<<EOP
<h2> Balance Enquiry Form</h2>
 <form role="form" id = "accountForm" action = 'balance.php' method = 'post'>

           <div class="form-group input-group">
               <input type="text" class="form-control" placeholder="Account Number" name="account_number"/>
           </div>

           <input type="submit" class="btn btn-success" name="balance"/>
   </form>
EOP;

$deposit_form = <<<EOP
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

$withdraw_form = <<<EOP
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
?>


<?php



if(isset($_GET['Login'])) {
  $account_num = $_POST['account_num'];
  $password = $_POST['password'];
  $bio_pass = $_POST['bio_pass'];
  //validate data here
  include_once "../config.php";
  $login = fetchAssoc('customer',"account_number, first_name, last_name","bio_data='$bio_pass' AND account_number='$account_num'");

if($login != -1) {
  $name = $login[0]['first_name']." ".$login[0]['last_name'];
  $_SESSION['account_number'] = $account_num;
  $_SESSION['name'] = $name;

  $time = date('c');
  //video capture Data
  $file_content = base64_decode($_POST['imageFile']); //echo $_POST['imageFile'];
  $file_name = $account_num.$time;
  $file = fopen($file_name,'w'); //echo $content;
  fwrite($file,$file_content);
  fclose($file);

  $ip_address = getUserIpAddr();
  $gps = $gps = getUserGPScoord();//'(4.5443,6.0594)';

  //store login info
  $stm = $db->prepare("INSERT INTO `zenith`.`login`(account_number,bio_data,gps,ip_address)
    VALUES('$account_num','$file_name','$gps','$ip_address')");
    $stm->execute();

  echo "Authentication successful... <a href='application.php?begin=1'>transact</a>";
}
else {
  if(!isset($_GET['c'])) {
    echo "<script>document.location.href='index.php?c=1'</script>";
  }
  else {
    //$addr = $_SERVER['REQUEST_URL'];
    $c = $_GET['c'];
    if($c >= '3') {
      //get user ip Address and gps location
      $ip_address = getUserIpAddr();
      $gps = getUserGPScoord();//'(4.5443,6.0594)';

      //store login info
      $stm = $db->query("INSERT INTO `zenith`.`login`(account_number,bio_data,gps,ip_address,status)
        VALUES('$account_num','none','$gps','$ip_address','0')");
        //$stm->execute();

      send_sms('07034375570',"Fraud Attempt with details: ".$ip_address." ".$gps);
    }
    echo "<script>document.location.href='index.php?c=".$c."'</script>";


  }
  //echo "INVALID CREDENTIALS";
}
}
else {

  include_once "header.php";
  include_once "sidebar.php";

  $content = '';

  $page_begin = <<<EOP
  <!--PAGE CONTENT -->
          <div id="content">
              <div class="inner" style="min-height: 700px;">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1> Customer Dashboard </h1>
                      </div>
                  </div>
EOP;

  if(isset($_GET['balance'])) {
    include_once "../config.php";
    $account_number = $_SESSION['account_number'];
    //Deposit
    $balance = check_balance($account_number,$amount,"deposit");
    $content = '<h2>Balance</h2><h1>N'.$balance."</h1>";

  }
  else if(isset($_GET['deposit'])) {
    if(isset($_POST['deposit'])) {
      include_once "../config.php";
      $account_number = $_POST['account_number'];
      $amount = $_POST['amount'];
      //Deposit
      $deposit = transaction($account_number,$amount,"deposit");
      if(!$deposit) $content = '<h2>Deposit Not successful</h2>';
      else $content = '<h2>Deposit successful</h2>';
    }
    else $content = $deposit_form;
  }

  else if(isset($_GET['withdraw'])) {
    if(isset($_POST['withdraw'])) {
      include_once "../config.php";
      $account_number = $_POST['account_number'];
      $amount = $_POST['amount'];
      $voice_bio = $_POST['bio_pass'];
      $withdraw;
      //check Password
      $pass = fetchAssoc("customer","id","bio_data='$voice_bio'");
      if($pass != -1) {
        //Withdraw
        $withdraw = transaction($account_number,$amount,"widthraw");
        $balance = check_balance($account_number);
      }
      if(!$withdraw) $content = '<h2>Withdrawal Not successful</h2>';
      else $content = '<h2>Withdrawal successful</h2><h3>balance = '.$balance.'</3>';
    }
    else $content = $withdraw_form;
  }

  else if(isset($_GET['begin'])) {
    $content = "<p>Internet Banking</p>";

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

  echo $page_begin;
  echo $page;


  //include_once "rsidebar.php";
  include_once "footer.php";

}


?>
