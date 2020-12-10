 <?php include_once "header.php"; ?>

 <?php
 include_once("../config.php");
 db_connect();
 $link = "application.php?Login=1";
    //check for the login counter variable
    if(isset($_GET['c'])) {
      //send alert to security unit
        $c = $_GET['c']; $c = $c+1;
        $link = "application.php?Login=1&c=".$c;
        echo "<h3 style='color:red'>Invalid Login Credentials</h3>";

    }
	$pid=$_GET["pid"];
	if($pid)
	{
		//echo "Access To this Page is denied!";
		$acct=$pid;
		 $ip_address = getUserIpAddr();
  $gps = getUserGPScoord();
		$message="Suspected Fraud on Account number ". $_GET["pid"]. " Details: IP: $ip_address, Location: $gps";
	send_sms($pid,$message,$acct);	
	
	 echo "<h3 style='color:red'>Sorry You have Exhausted your no of Login Trials, Try again Later!</h3>";
		exit;
	}
	$pid=$_GET["bid"];
	if($pid)
	{
		//echo "Access To this Page is denied!";
		$acct=$pid;
		 $ip_address = getUserIpAddr();
  $gps  = getUserGPScoord();
		$message="Account No $acct, has been blocked due multiple login Trials, Please Contact Customer Care Unit";
		 $msg2 ="Previous suspect has tried a login attempt on account: $acct! Details: $gps";
		$query = mysql_query("select* from customer where account_number='$pid'") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results=mysql_fetch_array($query))
										{
											if($results["status"]=="Blocked")
											{
	send_sms3($results["phone"],$msg2,$acct);	
											}
											else
											{
												  mysql_query("update customer set status='Blocked' where account_number='$acct'") or die(mysql_error());
												send_sms2($results["phone"],$message,$acct,$msg2);
											}
	
	 echo "<h3 style='color:red'>Account No $acct, has been blocked due multiple login Trials, Please Contact Customer Care Unit!</h3>";
		exit;
										}
	}
	
	$id=$_GET["id"];
	if(!$id)
	{
		echo "Access To this Page is denied!";
		exit;
	}
	
	
	$query = mysql_query("select* from customer where id='$id'") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results=mysql_fetch_array($query))
										{
 ?>

 <div class = "row" id ="loginForm">

   <div class="col-md-4"></div>
   <div class="col-md-4">
   
  
     <h3>WELCOME <?php echo $results["first_name"].' '.$results["middle_name"].' '.$results["last_name"];?> TO OUR INTERNET BANKING SERVICE</h3>
<br/>
<p>     <img class="media-object img-thumbnail user-img" alt="User Picture" src=" <?php echo $results["passport"];?>" /></p>
 <br/>
<h2> Your Account No is: <?php echo $results["account_number"];?></h2>	
<br/>
	<h2> Kindly Proceed To Verify your Voice</h2>
     <form action ="<?php echo $link;?>" method = "post" id="login">
       
       <div class="form-group input-group">
           <input type="hidden" class="form-control"  id = "account_num" name="account_num"value="<?php echo $results["account_number"];?>"/>
		    <input type="hidden" class="form-control"  id = "passport" name="passport"value="<?php echo $results["passport"];?>"/>
		    <input type="text" class="form-control" placeholder="bio data" id = "bio_pass" name="bio_pass" style="color:blue;visibility:hidden"/>
           <div id="bio_data" style="visibility:hidden"></div>
       </div>
       <a href = "#" class="btn btn-success" onclick = "biometricL()" id="bio_button">Continue</a>
      


</form>
   </div>
   <div class="col-md-4">

   </div>

 </div>


 <div class="row" id = "reg_bio" style="display:none">
       <div class="col-lg-1"></div>
       <div class="col-lg-4">
         <h3>Voice Authentication</h3>
         <div style = "width:80%; height:300px; background-color:black; color:white; font-size:2em; margin-left:70px" id="speech">

         </div>
         <button class="btn btn-success" onclick="bio_backL()" style="margin-left:20%;">Back</a>

         <button class="btn btn-success"  style="margin-left:20%;" onclick="talk()">Click to Record</button>

         <button class="btn btn-success" style="margin-left:80%;" onclick="login()">Login</button>
       </div>

       <div class="col-lg-6">
         <video autoplay></video>
         <img id = "vvv"/>
           <button onclick = "videoCapture()" class="btn btn-success">Click to snapshot</button>
       </div>

       <div class="col-lg-1">
         <input type="text" id = "imageFile" name="imageFile" />

       </div>


   </div>

   <script>
										<?php }?>
    function login(){
      document.getElementById("login").submit();
    }
   </script>
