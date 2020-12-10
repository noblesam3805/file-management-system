<?php
	session_start();

	if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url());
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

		$link = "http://www.alvanportal.edu.ng/eduportal/putme/index.php?putme/qr_check/" . $_SESSION['putmeID'];

        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

	$designation = $this->db->get_where('putme_student_designation', array("putme_id" => $_SESSION['putmeID']))->row();

	$student = $this->db->get_where('putme_students', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$card = $this->db->get_where('putme_card_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$scratchcard = $this->db->get_where('putme_scratch_cards', array("used_by" => $_SESSION['putmeID'], "serial" => $card->serial))->row();
	
	$origin = $this->db->get_where('putme_student_origin', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$course = $this->db->get_where('putme_course_application', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$session = $this->db->get_where('putme_settings', array("settings" => 'session'))->row();
	$receipt_title = $this->db->get_where('putme_settings', array("settings" => 'receipt_title'))->row();
	
	$jamb = $this->db->get_where('putme_jamb_results', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$registered_by = $this->db->get_where('putme_users', array("user_id" => $student->registered_by))->row();
	
	$directEntry = $this->db->get_where('putme_direct_entry_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$score = $this->db->get_where('putme_final_apt_test_result', array("putme_id" => $_SESSION['putmeID']))->row();
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
					<p><?php
							if($designation->designation == 'Direct'){
								echo $session->value . ' Direct Entry Registration PrintOut';
							}elseif($designation->designation == 'Nce'){
								echo $session->value . ' NCE ' . $receipt_title->value;
							}else{
								echo $session->value . ' ' . $receipt_title->value; 
							}
						?>
					</p>
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
										<td><p><?php echo $_SESSION['putmeID']; ?></p></td>
									</tr>
									<tr>
										<td><p>
											<?php
												if($designation->designation == 'Direct'){
													echo 'Matric No';
												}else{
													echo 'Jamb Reg No';
												}
											?>
										</p></td>
										<td><p><?php echo $card->jamb; ?></p></td>
									</tr>
									<tr>
										<td><p>Full Name</p></td>
										<td><p><?php echo ucwords(strtolower($student->lastname) . ' ' . strtolower($student->firstname) . ' ' . strtolower($student->middlename)); ?></p></td>
									</tr>
									<tr>
										<td><p>Sex</p></td>
										<td><p><?php echo $student->sex; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Birth</p></td>
										<td><p><?php echo $student->date_of_birth; ?></p></td>
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
								<img src="<?php echo 'uploads/student_image/' . $student->photo . '.jpg'; ?>" width="150px" height="150px" />
							</div>
							<div class="col-md-12 no-p receipt-qrcode-div">
								<img src="<?php echo $filename; ?>" width="150px" height="150px" />
								Scan Me
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<?php if($designation->designation == 'Jamb' || $designation->designation == 'Nce'){ ?>
						<div class="col-md-12">
							<h3 style="float:left;">JAMB Details</h3>
						</div>
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p><?php echo $jamb->english; ?></p></td>
										<td><p><?php echo $jamb->englishscore ?></p></td>
									</tr>
									<tr>
										<td><p><?php echo $jamb->subj2; ?></p></td>
										<td><p><?php echo $jamb->subj2score; ?></p></td>
									</tr>
									<tr>
										<td><p><?php echo $jamb->subj3; ?></p></td>
										<td><p><?php echo $jamb->subj3score; ?></p></td>
									</tr>
									<tr>
										<td><p><?php echo $jamb->subj4; ?></p></td>
										<td><p><?php echo $jamb->subj4score; ?></p></td>
									</tr>
									<tr>
										<td><p><?php echo 'Total Score'; ?></p></td>
										<td><p><?php echo $jamb->total_score; ?></p></td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php }else if($designation->designation == 'Direct'){ ?>
						<div class="col-md-12">
							<h3 style="float:left;">Previous Study Details</h3>
						</div>
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Institutiton</p></td>
										<td><p><?php echo $directEntry->institution; ?></p></td>
									</tr>
									<tr>
										<td><p>Discipline</p></td>
										<td><p><?php echo $directEntry->discipline; ?></p></td>
									</tr>
									<tr>
										<td><p>Class Of Graduation</p></td>
										<td><p><?php echo $directEntry->class_of_graduation; ?></p></td>
									</tr>
									<tr>
										<td><p>Year Of Graduation</p></td>
										<td><p><?php echo $directEntry->year_of_graduation; ?></p></td>
									</tr>
									<tr>
										<td><p>CGPA</p></td>
										<td><p><?php $cgpa = $directEntry->cgpa == '' || $directEntry->cgpa == NULL || empty($directEntry->cgpa) ? 'N/A' : $directEntry->cgpa; echo $cgpa; ?></p></td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<h3>Additional Details</h3>
						</div>
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Course Applied For</p></td>
										<td><p><?php echo $course->department; ?></p></td>
									</tr>
									<tr>
										<td><p>Faculty / School</p></td>
										<td><p><?php echo $course->school; ?></p></td>
									</tr>
									<tr>
										<td><p>Aptitude Test Score</p></td>
										<td><p><?php echo $score->average; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Print</p></td>
										<td><p><?php echo date('jS F Y'); ?></p></td>
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
											<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Thank you for choosing Alvan Ikoku University Of Education</h5>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="<?php echo base_url() . 'index.php?putme/logoutRegistration'; ?>">Close</a></p>
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
