<?php
	session_start();

	if(!isset($_SESSION['desig'])){
		redirect(base_url() . 'index.php?registration/logout');
	}

	//QR CODE =============

	/* $PNG_TEMP_DIR = base_url().'temp/';
    $PNG_WEB_DIR = 'temp/';

    include "QR/qrlib.php";

    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';

    if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];

    	$matrixPointSize = 4;

    if (isset($_REQUEST['size']))

        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

		$link = "https://iportal.ebsu.edu.ng/index.php?staff_registration/qr_check/" . $student->portal_id;

        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2); */
	
?>
<style type="text/css">
	.country-line{
		float:left;
		width:100%;
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
					<p><?php echo $this->crud_model->currentSession() . ' Student Registration Print Out'; ?></p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<table>
								<tbody>
									<tr>
										<td>
											<h3>Personal Details</h3> 
										</td>
									</tr>
								</tbody>
							</table>
							<hr />
						</div>
						<div class="col-md-10 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Portal ID</p></td>
										<td><p><?php echo $student->portal_id; ?></p></td>
									</tr>
									<tr>
										<td><p>Matric Number</p></td>
										<td><p><?php echo $student->reg_no; ?></p></td>
									</tr>
									<tr>
										<td><p>Full Name</p></td>
										<td><p><?php echo ucwords(strtolower($student->name) . ' ' . strtolower($student->othername)); ?></p></td>
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
												if($student->nationality == 'Nigeria' || $student->nationality == 'Nigerian'){
													echo $student->lga . ', &nbsp; ' . $student->state . ' State'; 
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
								<img src="<?php echo 'putme/uploads/student_image/' . $student->photo . '.jpg'; ?>" width="150px" height="150px" />
							</div>
							<div class="col-md-12 no-p receipt-qrcode-div">
								<img src="<?php echo $filename; ?>" width="150px" height="150px" />
								Scan Me
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<h3>Academic Details</h3>
						</div>
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Department Of Student</p></td>
										<td><p><?php echo $student->dept; ?></p></td>
									</tr>
									<tr>
										<td><p>Faculty / School</p></td>
										<td><p><?php echo $student->school; ?></p></td>
									</tr>
									<tr>
										<td><p>Programme</p></td>
										<td><p><?php echo $student->programme; ?></p></td>
									</tr>
									<tr>
										<td><p>Programme Type</p></td>
										<td><p><?php echo $student->prog_type; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Registration</p></td>
										<td><p><?php echo $student->date_reg; ?></p></td>
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
										<p style="text-align:right;">
											<button class="btn btn-default" onclick="javascript:window.location.href = '<?php echo base_url() . "index.php?registration"; ?>'">
												<i class="glyphicon glyphicon-remove"></i> &nbsp;Close
											</button>
										</p>
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
