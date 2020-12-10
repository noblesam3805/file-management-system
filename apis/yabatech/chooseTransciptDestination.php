<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include 'remita_constants.php';
include 'kee.php';
$payerID=$_POST["payerID"];
$payername=$_POST["payerName"];
$payerEmail=$_POST["payerEmail"];
$payerPhone=$_POST["payerPhone"];
$Orderid=$_POST["orderId"];
$paymentID=$_POST["paymentID"];
$paymentName=$_POST["paymentName"];
$responseurl="http://www.yabatech.edu.ng/UnifiedYCTPAY/PaymentFeedback.aspx";
$amt=$_POST["amt"];
$acadsession=$_POST["acadsession"];
$paymentdescription=$_POST["paymentdescription"];
$programName=$_POST["programName"];
$_SESSION["yabaurl"] =$responseurl;
$_SESSION["orderid"] =$Orderid;
$description= $paymentName." FOR ".$payername;
//$_SESSION["payment_name"] = $paymentName;
$_SESSION["payment_name"] = $paymentName;
if(isset($payerID))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<title>Select Transcript Destination</title>
</head>


<body style="background:#CCC"><br />
<div style="width: 50%;margin-left:30%;" >

  <!-- /.login-logo -->
  <div class="login-box-body" style=" border-radius: 25px; box-shadow: 10px 10px 5px #888888;">
    
<form id="form1" name="form1" method="post" action="processTranscriptDestination.php">
<table border="0"  cellpadding="5" cellspacing="5" style="width: 50%" style="background-color:#FFF" align="center" >
 
  <tr>
    <td colspan="2" height="100px"><img src="images/logo.png" width="256" height="79" /></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b><?php echo $_SESSION["payment_name"];?> APPLICATION</b></td>
    </tr>
  <tr>
    <td colspan="2"><div class="social-auth-links text-center"><span  style=" font-family:Tahoma, Geneva, sans-serif;">Complete Transcript Destination Details</span></div></td>
    </tr>
  <tr>
    <td colspan="2">
     <label >Courier Type:</label>
	 
         </td>
		 <td><select name="courieropt" id="courieropt" required>
        <option value="">Select your option</option>
    
      <option value="UPS">UPS</option>
        </select>
		
      &nbsp;
	  <br>
	  <!--<p><b>Optional: UPS Courier service is optional, choosing UPS as a dispatch method comes with additional charges to normal transcript fees for fast and efficient service delivery</b></p></td>-->
    </tr>
	 <tr>
    <td colspan="2" style="height: 20px">
     
         </td><td></td>
    </tr>
	  <tr>
    <td colspan="2">
   <label >Destination City/Country:</label>    
	
         
         </td><td><select name="city" id="city" required>
        <option value="">Select Destination City/Country</option>
		    <?php 
	if($paymentID==22){	
$query3= sqlsrv_query($conn,"select * from courier_rates where locality_type='1'") or die
(print_r( sqlsrv_errors(), true));
	}
	else
	{
		$query3= sqlsrv_query($conn,"select * from courier_rates where locality_type='2'") or die
(print_r( sqlsrv_errors(), true));
	}
						while(list($id,$destination)=sqlsrv_fetch_array($query3))
{

?> 
        <option value="<?php echo $id;?>"><?php echo $destination;?></option>
<?php }?>
        </select></td>
    </tr>
  <tr>
   <tr>
    <td colspan="2" style="height: 20px">
     
         </td><td></td>
    </tr>
    <td colspan="2">
     <label >Destination School Name:</label>
	
      &nbsp;
         </td><td><input type="text" name="schname"style="width: 250px" required /></td>
    </tr>
	 <tr>
    <td colspan="2" style="height: 20px">
     
         </td><td></td>
    </tr>
	    <td colspan="2">
     <label >Destination School Address:</label>

      &nbsp;
         </td>
		 <td>	<input type="text" name="schaddress" style="width: 250px" required /></td>
    </tr>
		
 <tr>
    <td colspan="2"><div class="social-auth-links text-center">
      </div>
      &nbsp;
         </td>
    </tr>
  <tr>
    <td colspan="2"><div class="social-auth-links text-center"><img src="images/courierlogo.jpg" width="256" height="100" />
	 <input type="hidden" name="payerID" id="payerID" value="<?php echo $payerID;?>" />
									<input type="hidden" name="payerName" id="payerName" value="<?php echo $payername;?>" />
										 <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail;?>" />
										 <input type="hidden" name="payerPhone" id="payerPhone" value="<?php echo $payerPhone;?>" />
										 <input type="hidden" name="orderId" id="orderId" value="<?php echo $Orderid;?>" />
										<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $paymentID;?>" />
										 <input type="hidden" name="paymentName" id="paymentName" value="<?php echo $paymentName;?>" />
										 <input type="hidden" name="responseurl" id="responseurl" />
										<input type="hidden" name="amt" id="amt" value="<?php echo $amt;?>" />
										<input type="hidden" name="acadsession" id="acadsession" value="<?php echo $acadsession;?>" />
										<input type="hidden" name="paymentdescription" id="paymentdescription" />
									<input type="hidden" name="programName" value="<?php echo $programName;?>" />
      <button type="submit" class="btn btn-success "  style="color:#FFF"> Proceed
      </button></div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
   
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
  </tr>
</table>

    </form>
</div><br />
 <div class="footer"  align="center" ><span style="  margin-bottom:10px; float:left  color:#000000;">Copyright <?php echo date("Y");?> Center for Information Technology and Management (CITM), Yaba College of Technology.</span></div>
</body>
</html>
<?php
}
else
{
	echo "Invalid Request";
}
?>