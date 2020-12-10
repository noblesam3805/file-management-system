<?php

	session_start();



	if(!isset($_SESSION['invoice_no'])){

		$_SESSION['err_msg'] = 'Start here please!';

	//	redirect(base_url()."index.php?student/generate_acp_fee_invoice");

	}

$rrr=$_POST["rrr"];
$responseurl=$_POST["responseurl"];
$Orderid=$_POST["orderID"];
$paymentopt=$_POST["paymentopt"];
if($paymentopt=="Card")
{
?>
<form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/payremitaonline.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $rrr;?>" type="hidden"> 
                  <input name="responseurl" value="https://erp.yabatech.edu.ng/portal/apis/yabatech/payonlineresponse.php" type="hidden"> 
                  <input name="Orderid" value="<?php echo $Orderid;?>" type="hidden">
                       </form>
                        <script type="text/javascript">        
  document.getElementById("SubmitRemitaForm1").submit();</script>
<?php }
else
{



	$applicationinvoice = $this->db->get_where('applicationinvoice_gen', array("rrr" => $_SESSION['invoice_no']))->row();

	//echo $_SESSION['invoice_no'];
//$dept = $this->db->get_where('department', array("deptID" => $applicationinvoice->dept_id))->row()->deptName;
//$sch = $this->db->get_where('department', array("deptID" => $applicationinvoice->dept_id))->row()->schoolid;
//$school = $this->db->get_where('schools', array("schoolid" =>$sch))->row()->schoolname;

	//$application_type = $this->db->get_where('application_type', array("application_typeid" => $applicationinvoice->application_type_id))->row();

	

	//$details = $this->db->get_where('eduportal_remita_temp_data', array("putme_id" => $_SESSION['portalID']))->row();

	

	

?>



<style type="text/css">

	.row{

		margin-left:0px !important;

		padding:10px 0px 0px 0px;

	}

	thead{

	}

	#nceLink, degreeLink{

		cursor:pointer;

	}

	.nav-tabs.bordered{

		margin:0px 15px !important;

	}

	.tab-content{

		padding:0px 15px !important;

		border:none !important;

	}

	.foreign-form{

		display:none;

	}

	.country-line{

		padding:5px;

		background:#DEDEDE;

		margin:20px 0 0 10px;

		border:1px solid #999999;

		box-shadow:1px 1px 1px #DEDEDE;

	}

	.country-line span{

		color:#CB4A18;

		font-size:19px;

		margin-left:10px;

	}

	.country-line h5{

		margin:5px 0;

	}

</style>



<div class="print_page">

	<div class="col-md-12">

		<div class="widget stacked">

			<div class="widget-content" style="padding:10px 20px;">

				<div class="col-md-12 receipt-head">

					<img src="images/neklogo.png" />

					<p> <?php echo ucwords($_SESSION["payment_name"]);?> INVOICE</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is just an invoice for bank payment. Payment should be made through Remita platform.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">
<form action="https://erp.yabatech.edu.ng/portal/apis/yabatech/payremitaonline.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $applicationinvoice->rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo "https://erp.yabatech.edu.ng/portal/apis/yabatech/payonlineresponse.php";?>" type="hidden"> 
                  <input name="Orderid" value="<?php echo $applicationinvoice->order_id;		 
				  ?>" type="hidden">
						<table class="table table-bordered table-striped table-hover">

							<tbody>

								<tr>

									<td><p>RRR </p></td>

									<td><p><?php echo $applicationinvoice->rrr; ?></p></td>

								</tr>

								<tr>
								  <td>Portal ID</td>
								  <td><?php echo $applicationinvoice->payerID; ?></td>
							  </tr>
								<tr>

									<td><p>Full Name</p></td>

									<td><p><?php echo  ucwords(strtolower($applicationinvoice->payername)); ?></p></td>

								</tr>

								<tr>

									<td><p>Email</p></td>

									<td><p><?php echo $applicationinvoice->payeremail; ?></p></td>

								</tr>
								
                              <tr>
								  <td>Programme</td>
								  <td><?php echo $applicationinvoice->programName; ?></td>
							  </tr>
                                <tr>
								  <td>Session</td>
								  <td><?php echo $applicationinvoice->acadsession; ?></td>
							  </tr>
								<tr>
								  <td>Payment For</td>
								  <td><?php echo $applicationinvoice->paymentName; ?></td>
							  </tr>
                              	<tr>
								  <td>Payment Description:</td>
								  <td><?php echo $applicationinvoice->paymentdescription; ?></td>
							  </tr>
								<tr>

									<td><p>Amount</p></td>

									<td><p>

										N<?php echo number_format($applicationinvoice->amt);?>

									</p></td>

								</tr>

							</tbody>

						</table>
						
           </form>
          </div>
		  <div class="col-md-12" style="text-align:center">

			<img src="assets/images/remitalogo.png" />

		</div>

					<div class="col-md-12 no-p">

						<div class="country-line">

							<h5>Thank you for choosing Yaba College of Technology, Lagos.</h5>

						</div>

						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="http://portal.yabatech.edu.ng/portalplus">Close</a></p>
						<p style="text-align:left;"><a href="javascript: document.getElementById('SubmitRemitaForm1').submit() ">Click here to Pay online with Credit/ATM Card.</a></p>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center"></div>

	</div>

</div><?php }?>