
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<title>Load QRPV</title>
</head>


<body style="background:#CCC"><br>
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body" style=" border-radius: 25px; box-shadow: 10px 10px 5px #888888;">
    
<form id="form1" name="form1" method="post" action="processQrp.php">
<table border="0" cellpadding="5" cellspacing="5" width="100%" style="background-color:#FFF" align="center">
 
  <tbody><tr>
    <td colspan="3" height="100px"><center><img src="images/logo.png" width="256" height="79"></center></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><center><b>PAYMENT FOR PERSONAL PAYMENTS</b></center></td>
    </tr>
  <tr>
    <td colspan="3"><div class="social-auth-links text-center"><span style=" font-family:Tahoma, Geneva, sans-serif;">QRPV LOADER</span></div></td>
    </tr>  
      
<center><font color="orangered"><?php if(isset($error)){ echo $error;}?></font></center>

<tr>
    <td colspan="3"><font color="#999999">Voucher PIN*:</font>
<div class="form-group has-feedback">
<input type="integer" name="card_number" class="form-control" id="card_number" value="" placeholder="Enter 13-digit PIN" maxlength="13" />

</div></td></tr>
<tr>
    <td colspan="3"><font color="#999999">OTP*:</font>
<div class="form-group has-feedback">
<input type="password" name="cv_otp" class="form-control" id="cv_otp" value="" placeholder="Enter 4-digit OTP" maxlength="4" />

</div></td></tr>
<input name="rrr" value="250231004589" type="hidden"> 
      
      <input name="responseurl" value="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx" type="hidden"> 
      <input name="orderID" value="1502136" type="hidden">    </td>
    </tr>

  <tr>
    <td colspan="3"><div class="social-auth-links text-center">
      <button type="submit" class="btn btn-success " style="color:#FFF"> Proceed
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
</tbody></table>
    </form>
</div><br><br><br><br>
 <div class="footer" align="center"><span style="  margin-bottom:10px; float:left  color:#000000;">Copyright 2018 Center for Information Technology and Management (CITM), Yaba College of Technology.</span></div>


</div></body></html>