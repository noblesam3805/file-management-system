<?php 
session_start();
include 'kee.php';
$rrr=$_POST["rrr"];
$payid=0;
//$responseurl=$_POST["responseurl"];
//$Orderid=$_POST["Orderid"];

							$query2= sqlsrv_query($conn,"select channel,trans_date,date_sent from eduportal_remita_payment where rrr = '$rrr'") or die
(print_r( sqlsrv_errors(), true));
					while(list($channel,$transdate,$date_sent)=sqlsrv_fetch_array($query2))
					{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Receipt</title>
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
	$query3= sqlsrv_query($conn,"select * from applicationinvoice_gen where rrr='$rrr'") or die
(print_r( sqlsrv_errors(), true));
						while(list($id,$payername,$payeremail,
					
$payerphone,$orderid1,$paymentid,$amt,$acadsession,$paymentdescription,$paymentName,$rem,$dategenerated,$status,$sid,$payerID)=sqlsrv_fetch_array($query3))
{
$payid= $paymentid;
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
          <b>Session:</b> <?php echo $acadsession;?><br>
		  <b>Date Generated RRR:</b> <?php echo $dategenerated;?>
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
                  <td><?php echo $paymentName." FOR ".$payername;?></td>
                  <td><?php echo $date_sent;?></td>
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
        
          
      		<p class="lead"style="margin-top:20px; text-align:right; margin-right:20px; font-size:28px;">Total: NGN<?php echo number_format($amt);?></p>

        

      
        </div>        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
 <?php }}?>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#"  onclick="javascript: window.print();" class="btn btn-default"><i class="fa fa-print"></i>Print</a>
<?php if($payid=="22" || $payid=="23")
{?>	
	 <a href="http://45.34.15.68:8000/ytranscript/site/start_application" style="color:#fff; background-color: red; padding:7px">Click here to Complete Transcript Application Form</a>
      
<?php }
else
{
	
?>
<button type="button" class="btn btn-danger pull-right"><i class="fa fa-credit-card"></i> <a href="http://www.yabatech.edu.ng" style="color:#FFF">Close</a>
          </button>	

	  
<?php }?>
       
        </div>
      </div>
    </section>
</body>
</html><?php 



?>