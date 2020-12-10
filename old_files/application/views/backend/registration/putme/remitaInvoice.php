<?php

	session_start();



	if(!isset($_SESSION['portalID'])){

		$_SESSION['app_Error'] = 'Start here please!';

		redirect(base_url() . 'index.php?student/generateRemitaRRR');

	}



$details = $this->db->get_where('eduportalremitainvoice_gen', array("portal_ID" => $_SESSION['portalID'],"paymentName" => $_SESSION['paymentName'],"acadsession" => $_SESSION['acadsession'],"year" => $_SESSION['year']))->row();

	$student = $this->db->get_where('student', array("portal_id" => $_SESSION['portalID']))->row();

	//$school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
//$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
//$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
//$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();

	//$amount = $this->db->get_where('eduportal_remita_details', array("type" => 'new_acceptance_fee_amount'))->row();

	

	//$details = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $_SESSION['portalID']))->row();

	

	

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

					<img src="images/alvan-logo.png" />

					<p><?php echo ucwords(strtolower($_SESSION['paymentName'])); ?> Payment Invoice</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is just an invoice for bank payment.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">
<form action="payremitaonline.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $details->rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo $responseurl;?>" type="hidden"> 
                  <input name="Orderid" value="<?php echo $details->orderid;?>" type="hidden">
						<table class="table table-bordered table-striped table-hover">

							<tbody>

								<tr>

									<td><p>Portal ID</p></td>

									<td><p><?php echo $_SESSION['portalID']; ?></p></td>

								</tr>

								<tr>

									<td><p>Invoice No (RRR)</p></td>

									<td><p><?php echo $details->rrr; ?></p></td>

								</tr>

								<tr>

									<td><p>Full Name</p></td>

									<td><p><?php echo ucwords(strtolower($student->title)) . ' ' . ucwords(strtolower($student->othername) . ' ' . strtolower($student->name)); ?></p></td>

								</tr>

								<tr>

									<td><p>Email</p></td>

									<td><p><?php echo $student->email; ?></p></td>

								</tr>

								<tr>
								  <td>Programme</td>
								  <td><?php echo $student->programme."(".$student->prog_type.")";?></td>
							  </tr>
								<tr>
								  <td>School</td>
								  <td><?php echo $student->school;?>&nbsp;</td>
							  </tr>
								<tr>
								  <td>Department</td>
								  <td><?php echo ucwords(strtolower($student->dept));?></td>
							  </tr>
								<tr>

									<td><p>Amount</p></td>

									<td><p>

										N<?php echo number_format($details->amt);?>

									</p></td>

								</tr>
                                <tr>

									<td><p>Description</p></td>

									<td><p>

										<?php echo $details->paymentdescription;?>

									</p></td>

								</tr>

							</tbody>

						</table>
</form>
					</div>

					<div class="col-md-12 no-p">

						<div class="country-line">

							<h5>Thank you for choosing Alvan Ikoku Federal College of Education</h5>

						</div>

						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <  href="<?php echo base_url();?>index.php?student/dashboard">Close</a></p>
                        
                        <p style="text-align:left;"><a href="javascript: document.getElementById('SubmitRemitaForm1').submit();">Click here to Pay Online with Credit/ATM Card.</a> </p>
                       

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center">

			<img src="assets/images/remitalogo.png" />

		</div>

	</div>

</div>