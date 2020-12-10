<?php

	session_start();



	if(!isset($_SESSION['invoice_no'])){

		$_SESSION['err_msg'] = 'Start here please!';

	//	redirect(base_url()."index.php?student/generate_acp_fee_invoice");

	}





	$applicationinvoice = $this->db->get_where('invoice_gen', array("invoice_no" => $_SESSION['invoice_no']))->row();

	
$dept = $this->db->get_where('department', array("deptID" => $applicationinvoice->dept_id))->row()->deptName;
$sch = $this->db->get_where('department', array("deptID" => $applicationinvoice->dept_id))->row()->schoolid;
$school = $this->db->get_where('schools', array("schoolid" =>$sch))->row()->schoolname;

	$application_type = $this->db->get_where('application_type', array("application_typeid" => $applicationinvoice->application_type_id))->row();

	

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

					<p><?php echo $applicationinvoice->session_id;?> HND Acceptance Fee Invoice</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is just an invoice for bank payment.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">

						<table class="table table-bordered table-striped table-hover">

							<tbody>

								<tr>

									<td><p>Invoice No </p></td>

									<td><p><?php echo $applicationinvoice->invoice_no; ?></p></td>

								</tr>

								<tr>
								  <td>Portal ID</td>
								  <td><?php echo $applicationinvoice->portal_id; ?></td>
							  </tr>
								<tr>

									<td><p>Full Name</p></td>

									<td><p><?php echo  ucwords(strtolower($applicationinvoice->firstname) . ' ' . strtolower($applicationinvoice->middlename) . ' ' . strtolower($applicationinvoice->surname)); ?></p></td>

								</tr>

								<tr>

									<td><p>Email</p></td>

									<td><p><?php echo $applicationinvoice->email; ?></p></td>

								</tr>
								<tr>
								  <td>Department</td>
								  <td><?php echo $dept; ?></td>
							  </tr>
                              <tr>
								  <td>School</td>
								  <td><?php echo $school; ?></td>
							  </tr>
                                <tr>
								  <td>Session</td>
								  <td><?php echo $applicationinvoice->session_id; ?></td>
							  </tr>
								<tr>
								  <td>Payment For</td>
								  <td><?php echo $application_type->application_type; ?></td>
							  </tr>
								<tr>

									<td><p>Amount</p></td>

									<td><p>

										N<?php echo number_format($applicationinvoice->amount);?>

									</p></td>

								</tr>

							</tbody>

						</table>

          </div>

					<div class="col-md-12 no-p">

						<div class="country-line">

							<h5>Thank you for choosing Federal Polytechnic Nekede</h5>

						</div>

						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="<?php echo base_url();?>">Close</a></p>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center"></div>

	</div>

</div>