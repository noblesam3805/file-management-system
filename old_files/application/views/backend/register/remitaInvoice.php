<?php

	session_start();


	if(!isset($_SESSION['portalID'])){

		$_SESSION['app_Error'] = 'Start here please!';

		redirect(base_url() . 'index.php?student/generate_acp_fee_invoice');

	}




	$student = $this->db->get_where('student', array("portal_id" => $_SESSION['portalID']))->row();

	$school = $this->db->get_where('schools', array("schoolid" => $student->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $student->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $student->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $student->prog_type))->row();
$programme_details = $this->db->get_where('program_detailed', array("program_id" => $student->program_id))->row();

    $details = $this->db->get_where('eduportal_remita_accp_temp_data', array("putme_id" => $_SESSION['portalID']))->row();
	$amount = $details->amount;

	
$_SESSION["orderid"]= $details->order_id;
$_SESSION["ptype"]= '1';
$_SESSION["regno"]= $_SESSION['portalID'];
$_SESSION["sess"]= $details->session;
$_SESSION["plevel"]= 'HND I';
$_SESSION["amount"]= $details->amount;
$_SESSION["stud_id"]= $student->student_id;
$_SESSION["semester"]= 'FIRST';


	

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

					<p><?php echo $details->session;?> Acceptance Fee Invoice</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is just an invoice for bank payment.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">
                    <form action="http://erp.yabatech.edu.ng/portal/apis/payremitaonline.php" name="SubmitRemitaForm1" id="SubmitRemitaForm1" method="POST"> 
                  
                  <input name="rrr" value="<?php echo $details->rrr;?>" type="hidden"> 
                  <input name="responseurl" value="<?php echo "http://erp.yabatech.edu.ng/portal/apis/payonlineresponse.php";?>" type="hidden"> 
                  <input name="Orderid" value="<?php echo $details->order_id;?>" type="hidden">

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

									<td><p><?php echo $student->title . ' ' . ucwords(strtolower($student->othername) . ' ' . strtolower($student->name)); ?></p></td>

								</tr>

							

								<tr>
								  <td>Programme</td>
								  <td><?php echo $programme_details->program_name;?></td>
							  </tr>
								<tr>
								  <td>School</td>
								  <td><?php echo $school->schoolname;?>&nbsp;</td>
							  </tr>
								<tr>
								  <td>Department</td>
								  <td><?php echo ucwords(strtolower($dept->deptName));?></td>
							  </tr>
								<tr>

									<td><p>Amount</p></td>

									<td><p>

										<?php echo $amount; ?>

									</p></td>

								</tr>
<tr>
		<td><p>Session</p></td>							  
		<td><?php echo $details->session;?>&nbsp;</td>
							  </tr>
							</tbody>

						</table>
</form>
					</div>

					<div class="col-md-12 no-p">

						<div class="country-line">

							<h5>Thank you for choosing Yaba College of Technology, Lagos.</h5>

						</div>

						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="<?php echo base_url();?>index.php?student/dashboard">Close</a></p>
                          <p style="text-align:left;"><a href="javascript: document.getElementById('SubmitRemitaForm1').submit() ">Click here to Pay online with Credit/ATM Card.</a></p>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center">

			<img src="assets/images/remitalogo.png" />

		</div>

	</div>

</div>