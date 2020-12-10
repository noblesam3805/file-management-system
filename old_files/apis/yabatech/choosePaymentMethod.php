<?php 
session_start();
$rrr=$_POST["rrr"];
$responseurl=$_POST["responseurl"];
$Orderid=$_POST["Orderid"];
if(isset($_SESSION["payment_name"]))
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
<title>Select Payment Method</title>
</head>


<body style="background:#CCC"><br />
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body" style=" border-radius: 25px; box-shadow: 10px 10px 5px #888888;">
    
<form id="form1" name="form1" method="post" action="paymentInvoice.php">
<table border="0"  cellpadding="5" cellspacing="5" width="100%" style="background-color:#FFF" align="center" >
 
  <tr>
    <td colspan="3" height="100px"><img src="images/logo.png" width="256" height="79" /></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><b>PAYMENT FOR <?php echo $_SESSION["payment_name"];?></b></td>
    </tr>
  <tr>
    <td colspan="3"><div class="social-auth-links text-center"><span  style=" font-family:Tahoma, Geneva, sans-serif;">Select Payment Method</span></div></td>
    </tr>
  <tr>
    <td colspan="3"><div class="social-auth-links text-center">
      <select name="paymentopt" id="paymentopt">
        <option value="">Select your option</option>
        <option value="Card">Card</option>
        <option value="Bank">Bank</option>
        </select></div>
      &nbsp;
      <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
      
      <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
      <input name="orderID" value="<?php echo $Orderid;?>" type="hidden">    </td>
    </tr>

  <tr>
    <td colspan="3"><div class="social-auth-links text-center">
      <button type="submit" class="btn btn-success "  style="color:#FFF"> Proceed
      </button></div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
    </form>
</div><br /><br /><br /><br />
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