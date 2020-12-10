<?php

	session_start();



	if(!isset($_SESSION['payeeID'])){

		$_SESSION['err_msg'] = 'Start here please!';

		redirect(base_url() . 'index.php?student/pay_acp_fees');

	}



	//QR CODE =============



	$PNG_TEMP_DIR = base_url().'temp/';

    $PNG_WEB_DIR = 'temp/';



    include "QR/qrlib.php";



    //remember to sanitize user input in real-life solution !!!

    $errorCorrectionLevel = 'L';



    if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))

        $errorCorrectionLevel = $_REQUEST['level'];



    	$matrixPointSize = 4;



    if (isset($_REQUEST['size']))



        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);



		$link = "http://162.144.134.70/nekede/index.php?payment/qr_check/". $_SESSION['payeeID'];



        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);







	$student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
	//$account_status=$student->status;

	//$origin = $this->db->get_where('prehnd_student_origin', array("putme_id" => $_SESSION['portalID']))->row();

	$session = $this->db->get_where('prehnd_settings', array("settings" => 'session'))->row();

	$receipt_title = $this->db->get_where('prehnd_settings', array("settings" => 'receipt_title'))->row();

	

	//$studPayeeID = $student->payee_id;

	$payDetails = $this->db->get_where('nekede_etranzact_payment', array("confirm_code" => $_SESSION['payeeID']))->row();

	$payDetails2 = $this->db->get_where('invoice_gen', array("invoice_no" => $payDetails->payee_id))->row();

	

	

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

					<p><?php echo ucwords(strtolower($payDetails2->paymentName));?> Payment Receipt</p>

			  </div>

				<div class="col-md-12">

					<div class="col-md-12 no-p">

						<h3>Personal Details</h3>

						<hr />

						<div class="col-md-10 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>

									<tr>

										<td><p>Portal ID</p></td>

										<td><p><?php echo $payDetails->portal_id; ?></p></td>

									</tr>

									<tr>

										<td><p>Confirmation Code</p></td>

										<td><p><?php echo $payDetails->confirm_code; ?></p></td>

									</tr>

									<tr>

										<td><p>Payee ID</p></td>

										<td><p><?php echo $payDetails->payee_id; ?></p></td>

									</tr>

									<tr>

										<td><p>Full Name</p></td>

										<td><p><?php echo ucwords(strtolower($student->name) . ' ' . strtolower($student->othername) ); ?></p></td>

									</tr>

									<tr>

										<td><p>Sex</p></td>

										<td><p><?php echo $student->sex; ?></p></td>

									</tr>

									<tr>

										<td><p>Date Of Birth</p></td>

										<td><p><?php echo $student->birthday; ?></p></td>

									</tr>

									<tr>

										<td><p>Place Of Origin</p></td>

										<td><p>

											<?php 

												if($student->nationality == 'Nigeria'){

													echo $origin->lga . ', &nbsp; ' . $origin->state . ' State'; 

												}else{

													echo $student->nationality;

												}

											?>

										</

								</tbody>

							</table>

						</div>

						<div class="col-md-2 no-p">

							<div class="col-md-12 no-p receipt-image-div">

								<img src="<?php echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; ?>" width="150px" height="150px" />
Passport
							</div>

							<div class="col-md-12 no-p receipt-qrcode-div">

								<img src="<?php echo $filename; ?>" width="150px" height="150px" />

								Scan Me

							</div>

						</div>

					</div>

					<div class="col-md-12 no-p">

						<table>

							<tbody>

								<tr>

									<td>

										<h3>Payment Details</h3>

									</td>

								</tr>

							</tbody>

						</table>

						<hr />

						<div class="col-md-12 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>

									<tr>

										<td><p>Amount Paid</p></td>

										<td><p><?php echo $payDetails->amount; ?></p></td>

									</tr>

								 <tr>
						        <td><p>Purpose Of Payment</p></td>
						        <td><p><?php echo $payDetails2->fee_description; ?></p></td>
					          </tr>
						      <tr>
						        <td><p>Level</p></td>
						        <td><p><?php echo $payDetails2->level; ?></p></td>
					          </tr>
						      <tr>
						        <td><p>Session</p></td>
						        <td><p><?php echo $payDetails->session; ?></p></td>
					          </tr>

									<tr>

										<td><p>Date Of Payment</p></td>

										<td><p><?php echo $payDetails->payment_confirmation_date; ?></p></td>

									</tr>

									<tr>

										<td><p>Method Of Payment</p></td>

										<td><p><?php echo 'Bank'; ?></p></td>

									</tr>

								</tbody>

							</table>

						</div>

					</div>

					<div class="col-md-12 no-p">

						<table class="table">

							<tbody>

								<tr>

									<td>

										<div class="country-line">

											<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Thank you for choosing Federal Polytechnic Nekede</h5>

										</div>

									</td>

								</tr>

								<tr>

									<td>

										<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="<?php echo base_url();?>index.php?student/dashboard">Close</a></p>

									</td>

								</tr>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>