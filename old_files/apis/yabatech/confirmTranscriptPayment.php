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
$_SESSION["payment_name"] = $paymentName;
$courieropt=$_POST["courieropt"];
$city=$_POST["city"];
$schname=$_POST["schname"];
$schaddress=$_POST["schaddress"];
$tamt=$_POST["tamt"];
$rate=$_POST["rate"];
$destination=$_POST["destination"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transcript Payment Confirmation</title>
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>

<body>
 
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <img src="images/logo.png" width="256" height="79" /><br /><small class="pull-right"><?php echo date("d M Y");?></small><br />
            <i class="fa fa-globe"></i><div align="center" style=" font-size:25px; font-family:'Arial', Gadget, sans-serif"><?php echo  ucwords(strtolower($paymentName));?> Payment Confirmation</div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
  
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Payment Made To
            <address>
            <strong>Yaba College of Technology.</strong><br>
            Yaba, Lagos<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">From
          <address>
          <strong><?php echo $payername;?></strong><br>
            <?php echo $payerID;?><br>
            Email: <?php echo $payerEmail;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
          <b>Order ID:</b> <?php echo $Orderid;?><br>
          <b>Amount:</b> <?php echo $amt;?><br>
          <b>Session:</b> <?php echo $acadsession;?>
        </div>
        <!-- /.col -->
      </div>
     <!-- /.row -->

      <!-- Table row -->
    <div class="row">
          <div class="col-xs-12 table-responsive">
          <br />
          <br />
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Payment Description</th>
                 
                
				   <th>Amount</th>
                
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><?php echo $paymentName;?></td>
           
                  <td><?php echo $amt;?></td>

               
                </tr>
				   <tr>
                  <td>2</td>
                  <td><?php echo $courieropt." DELIVERY RATE FOR ".strtoupper($destination);?></td>
                  
                  <td><?php echo  $rate;?></td>

               
                </tr>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
         
        

      
        </div>
         <div class="col-xs-6">
        
          
      		<p class="lead"style="margin-top:20px; text-align:right; margin-right:20px; font-size:28px;">Total: NGN<?php echo number_format($amt + $rate);?></p>

        

      
        </div>        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
         <form action="getappformdata_transcript.php" name="SubmitRemitaForm5" id="SubmitRemitaForm5" method="POST"> 
                  
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
										<input type="hidden" name="courieropt" value="<?php echo $courieropt;?>" />
										<input type="hidden" name="city" value="<?php echo $city;?>" />
										<input type="hidden" name="schname" value="<?php echo $schname;?>" />
										<input type="hidden" name="schaddress" value="<?php echo $schaddress;?>" />
										<input type="hidden" name="tamt" value="<?php echo ($amt+$rate);?>" />
										<input type="hidden" name="rate" value="<?php echo $rate;?>" />
										<input type="hidden" name="destination" value="<?php echo $destination;?>" />
										<input type="hidden" name="courier" value="<?php echo $courieropt;?>" />

          
         <button type="submit" class="btn btn-success "  style="color:#FFF">Proceed to Make Payment
          </button>
          </form>
        </div>
      </div>
    </section>
</body>
</html>