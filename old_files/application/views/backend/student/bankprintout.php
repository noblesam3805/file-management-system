<?php
	//session_start();

	if($this->session->userdata('pid') == '' ){
		$_SESSION['serror'] = 'Start here please!';
		//redirect(base_url()."index.php?student/pay_fees");
	}

	//QR CODE =============
	$pid = $this->session->userdata('pid');
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

		$link = "http://www.fpno.edu.ng/eduportal/prehnd/index.php?putme/qr_check/" . $pid;

        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


    $portal_id = $this->session->userdata('portal_id') != null ? $this->session->userdata('portal_id') : $printout->portal_id;
    $payee_id = $this->session->userdata('pid') != null ? $this->session->userdata('pid') : $printout->payee_id;
    $fullname=$this->session->userdata('fullname');
    $email = $this->session->userdata('email');
    $phone = $this->session->userdata('phone');
    $session = $this->session->userdata('session') ? $this->session->userdata('session') : $printout->session;
    $pop = '2015/2016 School Fees';//purpose of payment
    $amt = 'N24,000';//amount
	/*$student = $this->db->get_where('prehnd_students', array("putme_id" => $_SESSION['putmeID']))->row();
	$origin = $this->db->get_where('prehnd_student_origin', array("putme_id" => $_SESSION['putmeID']))->row();
	$course = $this->db->get_where('prehnd_course_application', array("putme_id" => $_SESSION['putmeID']))->row();
	$registered_by = $this->db->get_where('prehnd_users', array("user_id" => $student->registered_by))->row();
	$lastSchool = $this->db->get_where('prehnd_previous_study', array("putme_id" => $_SESSION['putmeID']))->row();
	$payPurpose = $this->db->get_where('prehnd_settings', array("settings" => 'paymenttype'))->row();
	$aptpayPurpose = $this->db->get_where('prehnd_settings', array("settings" => 'aptitude_test_desc'))->row();
	$amount = $this->db->get_where('prehnd_settings', array("settings" => 'amount'))->row();
	$aptamt = $this->db->get_where('prehnd_settings', array("settings" => 'aptitute_test_amount'))->row();*/
	
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
					<p>2015/2016 HND Printout For Bank Payment</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p" style="margin-bottom:20px;">
						<div class="country-line">
							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is just an invoice for bank payment. After payment, return back to the portal and confirm your payment to get your payment receipt.</h5>
						</div>
					</div>
					<div class="col-md-12 print-table">
						<table class="table table-bordered table-striped table-hover">
							<tbody>
								<tr>
									<td><p>Portal ID</p></td>
									<td><p><?=$portal_id?></p></td>
								</tr>
								<tr>
									<td><p>PAYEE ID</p></td>
									<td><p><?=$payee_id?></p></td>
								</tr>
								<tr>
									<td><p>Full Name</p></td>
									<td><p><?=$fullname?></p></td>
								</tr>
								<tr>
									<td><p>Email</p></td>
									<td><p><?=$email?></p></td>
								</tr>
								<tr>
									<td><p>Phone</p></td>
									<td><p><?=$phone?></p></td>
								</tr>
								<tr>
									<td><p>Purpose Of Payment</p></td>
									<td><p><?=$pop?></p></td>
								</tr>
								<tr>
									<td><p>Academic Session</p></td>
									<td><p><?=$session?></p></td>
								</tr>
								<tr>
									<td><p>Amount</p></td>
									<td><p><?=$amt?></p></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12 no-p">
						<div class="country-line">
							<h5>Thank you for registering at Federal Polytechnic Nekede</h5>
						</div>
						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="javascript:window.close()">Close</a> | <a href="<?php echo base_url();?>index.php?login/logout">Logout</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>