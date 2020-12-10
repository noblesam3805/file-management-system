<script>
function newDoc() {
    window.location.assign("<?php echo base_url();?>index.php?login/logout")
}
</script>
<?php
	session_start();

	/*if(!isset($_SESSION['rrr'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url() . 'index.php?login/logout');
	}*/

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

		$link = "http://http://94.249.188.157/nekede/index.php?fee/qr_check/" . $_SESSION['payeeID'];

        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


        //var_dump($_SESSION);
    $value = null;
    if(substr($_SESSION['portalID'], 0, 4) == 'PHND'){
    	$value = true;
		$student = $this->db->get_where('prehnd_students', array("putme_id" => $_SESSION['portalID']))->row();
		$origin = $this->db->get_where('prehnd_student_origin', array("putme_id" => $_SESSION['portalID']))->row();
	}
	//$session = $this->db->get_where('prehnd_settings', array("settings" => 'session'))->row();
	//$receipt_title = $this->db->get_where('prehnd_settings', array("settings" => 'receipt_title'))->row();
	
	//$studPayeeID = $student->payee_id;
	//$payDetails = $this->db->get_where('eduportal_remita_payment', array("rrr" => $_SESSION['rrr']))->row();
	$payDetails2 = $this->db->get_where('nekede_etranzact_payment', array("payee_id" => $_SESSION['payeeID']))->row();
	
	
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
					<p><?php echo $payDetails2->session." ". $payDetails2->programme." School Fee Payment Receipt";?></p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<h3>Personal Details</h3>
						<hr />
						<div class="col-md-10 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Portal ID/Reg NO</p></td>
										<td><p><?php echo $_SESSION['portalID']; ?></p></td>
									</tr>
									<tr>
										<td><p>Payee ID </p></td>
										<td><p><?php echo $payDetails2->payee_id; ?></p></td>
									</tr>
									<tr>
										<td><p>Confirmation Code</p></td>
										<td><p><?php echo $payDetails2->confirm_code; ?></p></td>
									</tr>
									<tr>
										<td><p>Full Name</p></td>
										<?php if($value){ ?>
										<td><p><?php echo ucwords(strtolower($student->lastname) . ' ' . strtolower($student->firstname) . ' ' . strtolower($student->middlename)); ?></p></td>
										<?php }else{ ?>
										<td><?=$payDetails2->fullname?></td>
										<?php } ?>
									</tr>
									<?php if($value){ ?>
									<tr>
										<td><p>Sex</p></td>
										<td><p><?php echo $student->sex; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Birth</p></td>
										<td><p><?php echo $student->date_of_birth; ?></p></td>
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
									<?php } ?>
									<tr>
									  <td>Department</td>
									  <td><?=$payDetails2->department?></td>
								  </tr>
									<tr>
										<td>Programme</td>
										<td><?=$payDetails2->programme?></td>
									</tr>
									
									
									<!--
									<tr>
										<td>Department</td>
										<td><?=$payDetails2->department?></td>
									</tr>	
									-->
									
									
									<tr>
										<td>Level</td>
										<td><?=$payDetails2->level?></td>
									</tr>
								</tbody>
							</table>
					  </div>
						<div class="col-md-2 no-p">
							<?php //if($value){ ?>
							<div class="col-md-12 no-p receipt-image-div">
								<img src="<?php /* echo 'http://94.249.188.157/eduportal/prehnd/uploads/student_image/' . $student->photo . '.jpg'; */?>" width="150px" height="150px" />
							</div>
							<?php  //} ?>
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
										<td><p><?php echo 'N'.number_format( (float) $payDetails2->amount, 2, '.', ','); ?></p></td>
									</tr>
									<tr>
										<td><p>Purpose Of Payment</p></td>
										<td><p><?php echo $payDetails2->session." ". $payDetails2->programme.' School Fees'; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Payment</p></td>
										<td><p><?php echo $payDetails2->payment_confirmation_date; ?></p></td>
									</tr>
									<tr>
										<td><p>Method Of Payment</p></td>
										<td><p><?php echo 'Etranzact (Bank)'; ?></p></td>
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
										<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a onclick="newDoc()">Exit</a></p>
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