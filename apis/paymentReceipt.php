<?php 
session_start();
include 'kee.php';
$rrr=$_POST["rrr"];
//$responseurl=$_POST["responseurl"];
//$Orderid=$_POST["Orderid"];

$query= mysql_query("select * from eduportal_remita_payment where rrr = '$rrr'") or die(mysql_error());
						if(mysql_num_rows($query) > 0){
							$query2= mysql_query("select channel, from eduportal_remita_payment where rrr = '$rrr'") or die(mysql_error());
					while(list($channel,$transdate)=mysql_fetch_array($query2))
					{
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Invoice</title>
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
    <?php 
	$query2= mysql_query("select * from applicationinvoice_gen where rrr='$rrr' limit 1") or die

(mysql_error());
						while(list($id,$payername,$payeremail,
					
$payerphone,$orderid1,$paymentid,$amt,$acadsession,$paymentdescription,$paymentName,$rem,$dategenerated,$status,$sid,$payerID)=mysql_fetch_array($query2))
{

?>
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <img src="images/logo.png" width="256" height="79" /><br /><small class="pull-right"><?php echo date("d M Y");?></small><br />
            <i class="fa fa-globe"></i><div align="center" style=" font-size:25px; font-family:'Arial', Gadget, sans-serif"><?php echo  ucwords(strtolower($paymentName));?> Receipt Printout</div>
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
            Email: <?php echo $payeremail;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice ID: <?php echo $orderid1;?></b><br>
          <br>
          <b>Order ID:</b> <?php echo $sid;?><br>
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
                  <th>Payment Type</th>
                  <th>RRR Number</th>
                  <th>Description</th>
                  <th>Transaction Date</th>
                  <th>Payment Method</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $sid;?></td>
                  <td><?php echo $paymentName;?></td>
                  <td><?php echo $rrr;?></td>
                  <td><?php echo $paymentdescription;?></td>
                  <td><?php echo $dategenerated;?></td>
                  <td><?php echo $channel;?></td>
                  <td><?php if($status=="Approved")
				  {
					  echo "PAID";
				  }
				  else
				  
				  {
					   echo $status;
				  }?></td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->

      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead" style="margin-top:20px;">&nbsp;</p>
        </div>
         <div class="col-xs-6">
        
          
      		<p class="lead"style="margin-top:20px; text-align:right; margin-right:20px; font-size:28px;">Total: NGN<?php echo $amt;?></p>

        

      
        </div>        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
 <?php }}?>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#"  onclick="javascript: window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <a href="http://www.yabatech.edu.ng" style="color:#FFF">Close</a>
          </button>
        
        </div>
      </div>
    </section>
</body>
</html><?php 

}
else
{
?>
 <form action="http://www.yabatech.edu.ng/UnifiedYCTPAY/PaymentFeedback.aspx" name="SubmitRemitaForm2" id="SubmitRemitaForm2" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="status" value="Not Approved" type="hidden"> 
                  <input name="orderid" value="<?php echo $yabaorderID;?>" type="hidden">
                       </form>
 <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm2").submit();</script>
<?php }


?>