
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
    
<form id="form1" name="form1" method="post" action="processDelta.php">
<table border="0" cellpadding="5" cellspacing="5" width="100%" style="background-color:#FFF" align="center">
 
  <tbody><tr>
    <td colspan="3" height="100px"><center><img src="images/logo.png" width="256" height="79"></center></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div class="social-auth-links text-center"><span style=" font-family:Tahoma, Geneva, sans-serif;">EDIT QRPV OTP</span></div></td>
    </tr>  
      
<center><font color="orangered"><?php if(isset($error)){ echo $error;}?></font></center>

<tr>
    <td colspan="3"><font color="#999999"><b>QRPV Tender Ref. *</b>:</font>
<div class="form-group has-feedback">
<input type="integer" name="vin" class="form-control" id="vin" placeholder="Enter 8-digit Ref." maxlength="13" />
</div></td></tr>

<tr>
    <td colspan="3"><font color="#999999"><b>Email Address *</b>:</font>
<div class="form-group has-feedback">
<input type="text" name="email" class="form-control" id="email" placeholder="yours@email.com" maxlength="11" />
</div></td></tr>

<tr>
    <td colspan="3"><font color="#999999"><b>Phone Number *</b>:</font>
<div class="form-group has-feedback">
<input type="integer" name="phone" class="form-control" id="phone" placeholder="080******35" maxlength="6" />
</div></td></tr>

<tr>
    <td colspan="3"><font color="#999999"><b>New QRPV OTP *</b>:</font>
<div class="form-group has-feedback">
<input type="password" name="vc-otp" class="form-control" id="vc-otp" placeholder="1234" maxlength="4" />
</div></td></tr>


<input name="rrr" value="250231004589" type="hidden"> 
   
   <input name="vlt" value="YCTPAY" type="hidden"> 
      
      <input name="responseurl" value="http://portal.yabatech.edu.ng/yctpay/PaymentFeedback.aspx" type="hidden"> 
      <input name="orderID" value="1502136" type="hidden">    </td>
    </tr>

  <tr>
    <td colspan="3"><div class="social-auth-links text-center">
        <script src="https://api.qrpurse.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
      <button type="button" class="btn btn-success " style="color:#FFF" onClick="payWithRemita()"> Proceed
      </button></div></td>
    </tr>
   
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><center><a href="loadqrpv.php">Load QRPV</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="generateqrpv.php">Generate QRPV</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="getwallet.php">Get a Wallet</a> </center></td>
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
<script>
    const API_publicKey = "";

    function payWithRemita() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "",
            amount: "",
            customer_phone: "",
            currency: "NGN",
            payment_method: "",
            txref: "",
            meta: [{
                metaname: "QRPurseRef",
                metavalue: ""
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect flwRef returned and pass to a server page to complete status check.
                console.log("Payment successful to YCTPAY Vault @ QRPurse", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    // redirect to a success page
                } else {
                    // redirect to a failure page.
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>


</div></body></html>