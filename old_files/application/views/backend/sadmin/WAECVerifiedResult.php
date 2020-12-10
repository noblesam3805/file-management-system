<?php

	session_start();



if(!isset($_SESSION['CandNo'])){

		$_SESSION['app_Error'] = 'Sorry Invalid Result Details!';

		redirect(base_url() . 'index.php?sadmin/verify_olevel_result');

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



		$link = "http://45.34.15.68/portal/index.php?payment/qr_check/". $_SESSION['payeeID'];



        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);







	//$student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
	//$account_status=$student->status;

	//$origin = $this->db->get_where('prehnd_student_origin', array("putme_id" => $_SESSION['portalID']))->row();

	//$session = $this->db->get_where('prehnd_settings', array("settings" => 'session'))->row();

	//$receipt_title = $this->db->get_where('prehnd_settings', array("settings" => 'receipt_title'))->row();

	

	//$studPayeeID = $student->payee_id;

	//$payDetails = $this->db->get_where('eduportal_remita_payment', array("rrr" => $_SESSION['payeeID']))->row();

	//$payDetails2 = $this->db->get_where('eduportal_remita_accp_temp_data', array("rrr" => $_SESSION['payeeID']))->row();

	//$payDetails3 = $this->db->get_where('eduportal_fees_payment_log', array("payment_code" => $_SESSION['payeeID']))->row();

	

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

					<p>WASSCE VERIFIED O'LEVEL RESULT</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p">

						<h3>Candidate Exam Details</h3>

						<hr />

						<div class="col-md-10 print-table">
<?php foreach($result['Candidate'] as $item2) { ?>
							<table class="table table-bordered table-striped table-hover">

								<tbody>

									<tr>

									<td><p>Candidate No</p></td>

									<td><p><?php echo $item2["CandNo"]; ?></p></td>

								</tr>

								<tr>

									<td><p>Form No.</p></td>

									<td><p><?php echo $item2["FormNo"]; ?></p></td>

								</tr>

									

									<tr>

										<td><p>Full Name</p></td>

										<td><p><?php echo ucwords(strtolower($item2["Surname"]) . ' ' . strtolower($item2["FirstName"]). ' ' . strtolower($item2["OtherNames"]) ); ?></p></td>

									</tr>

									<tr>

										<td><p>Sex</p></td>

										<td><p><?php echo $item2["Sex"]; ?></p></td>

									</tr>

									<tr>

										<td><p>Date Of Birth</p></td>

										<td><p><?php echo $item2["DateOfBirth"]; ?></p></td>

									</tr>
									<tr>

										<td><p>ExamCode</p></td>

										<td><p><?php echo $item2["ExamCode"]; ?></p></td>

									</tr>
									

<?php }?>

								</tbody>

							</table>

						</div>

						<div class="col-md-2 no-p">

							<div class="col-md-12 no-p receipt-image-div">

								<img src="<?php //echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; ?>" width="150px" height="150px" />
Passport
							</div>

							

						</div>

					</div>

					<div class="col-md-12 no-p">

						<table>

							<tbody>

								<tr>

									<td>

										<h3>Result Details</h3>

									</td>

								</tr>

							</tbody>

						</table>

						<hr />

						<div class="col-md-12 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>
<?php foreach($result['CandidateResult'] as $item3) {?>
									<tr>

										<td><p><?php echo $item3["Subject"];?></p></td>

										<td><p><?php echo $item3["Grade"]; ?></p></td>

									</tr>
			<?php }?>
			<?php foreach($result['CandidateCentre'] as $item4) {?>
									<tr>

										<td><p>Center Details</p></td>

										<td><p></p></td>

									</tr>
									<tr>

										<td><p>Center Code</p></td>

										<td><p><?php echo $item4["CentreCode"]; ?></p></td>

									</tr>

									<tr>

										<td><p>Center Name</p></td>

										<td><p><?php echo $item4["CentreName"]; ?></p></td>

									</tr>

					<?php }?>				


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

											<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; <?php foreach($result['ErrorInfo'] as $item5) {?>
											
											ErrorInfo: <?php echo $item5["Info"]; ?></h5>
	<?php }?>
										</div>

									</td>

								</tr>

								<tr>

									<td>

										<p style="text-align:right;"> <a href="<?php echo base_url();?>index.php?sadmin/dashboard">Close</a></p>

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