<?php
	session_start();

	if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url() . 'index.php?login/logout');
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

		$link = "http://www.fpno.edu.ng/eduportal/prehnd/index.php?putme/qr_check/" . $this->session->userdata('portal_id');

        $filename = 'temp/'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);



	$student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
	//var_dump($student);
	//var_dump($_SESSION['putmeID']);
	$origin = $this->db->get_where('prehnd_students', array("putme_id" => $_SESSION['putmeID']))->row();
	$origin = '';//$this->db->get_where('prehnd_student_origin', array("putme_id" => $_SESSION['putmeID']))->row();
	$course = '';//$this->db->get_where('prehnd_course_application', array("putme_id" => $_SESSION['putmeID']))->row();
	$registered_by = '';//$this->db->get_where('prehnd_users', array("user_id" => $student->registered_by))->row();
	$lastSchool = '';//$this->db->get_where('prehnd_previous_study', array("putme_id" => $_SESSION['putmeID']))->row();
	$session = '';//$this->db->get_where('prehnd_settings', array("settings" => 'session'))->row();
	$receipt_title = '';//$this->db->get_where('prehnd_settings', array("settings" => 'receipt_title'))->row();
	
	//$studPayeeID = $student->payee_id;
	$payDetails = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $payeeData))->row();
	//var_dump($payDetails);
	$prog_type = '';//$this->db->get_where('prehnd_payeeid_status', array("payee_id" => $_SESSION['payeeID']))->row();
	
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
					<img src="assets/images/eduportal.png" style="background-color: navy"/>
					<p><?php echo $session->value . ' ' . $receipt_title->value; ?></p>
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
										<td><p><?php echo $student->portal_id; ?></p></td>
									</tr>
									<tr>
										<td><p>PAYEE ID</p></td>
										<td><p><?php echo $payeeData; ?></p></td>
									</tr>
									<tr>
										<td><p>Full Name</p></td>
										<td><p><?php echo strtoupper($student->othername) . ' ' . strtoupper($student->name);//echo ucwords(strtolower($student->lastname) . ' ' . strtolower($student->firstname) . ' ' . strtolower($student->middlename)); ?></p></td>
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
										<td><p>Address</p></td>
										<td><p><?php echo $student->address; ?></p></td>
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
										</p></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-2 no-p">
							<div class="col-md-12 no-p receipt-image-div">
								<img src="<?php echo 'uploads/student_image/' . $student->student_id . '.jpg'; ?>" width="150px" height="150px" />
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
										<td><p><?php echo 'N'.$payDetails->amount; ?></p></td>
									</tr>
									<tr>
										<td><p>Purpose Of Payment</p></td>
										<td><p><?php echo $payDetails->description; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Payment</p></td>
										<td><p><?php echo $payDetails->payment_confirmation_date; ?></p></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<table>
							<tbody>
								<tr>
									<td>
										<h3>Additional Details</h3>
									</td>
								</tr>
							</tbody>
						</table>
						<hr />
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Department</p></td>
										<td><p><?php echo $student->dept; ?></p></td>
									</tr>
									<tr>
										<td><p>Faculty / School</p></td>
										<td><p><?php echo $student->school; ?></p></td>
									</tr>
									<tr>
										<td><p>Programme Type</p></td>
										<td><p><?php echo $student->prog_type; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Registration</p></td>
										<td><p><?php echo $payDetails->payment_confirmation_date; ?></p></td>
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
											<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Print this receipt and keep.</h5>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="javascript:window.close()">Close</a></p>
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