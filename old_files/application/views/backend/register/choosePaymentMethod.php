<?php 
session_start();
$rrr=$_POST["rrr"];
$_SESSION['invoice_no']=$rrr;
$responseurl=$_POST["responseurl"];
$Orderid=$_POST["Orderid"];
if(isset($_SESSION["payment_name"]))
{
?>
    <div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-home"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                  <a href="#"></a>
                    </ul>
                    <h4>PAYMENT FOR <?php echo $_SESSION["payment_name"];?></h4>
                </div>
            </div><!-- media -->
        </div><!-- pageheader -->
                        <?php echo form_open('register/paymentInvoice' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?> 
        <div class="span12">
            <div class="span8 b themiddle hasheight" style="background-color:#FFF;">
                <div class="" style="border:none;">

                	<div class="wrapclass">
						<label class="span8">Choose Payment Method</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<select required  id="paymentopt" name="paymentopt">
									<option value="">Select An Option</option>
									<option value="Card">Card</option>
        <option value="Bank">Bank</option>
								</select>
							</div><br /><br />
						</div>
					</div>
					 <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
      
      <input name="responseurl" value="<?php echo $_SESSION["yabaurl"];?>" type="hidden"> 
      <input name="orderID" value="<?php echo $Orderid;?>" type="hidden"> 
				
					<div id="result">

					</div>
					<div class="form-group">
						<ul class="list-unstyled wizard">
	<li class="pull-right next myclass"><button style="height:40px; border-radius:2px;"  type="submit" class="btn btn-info pull-right">Proceed</button></li>
						</ul>
					</div>
                </div>
            </div>
        </div>

    </div><!-- mainpanel -->
</div><?php
}
else
{
	echo "Invalid Request";
}
?>