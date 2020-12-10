<?php
	session_start();

	if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url());
	}

	$putmeID = $_SESSION['putmeID'];
	
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
	
	$sscedetails = $this->db->get_where('putme_ssce_result_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$ssce1 = $this->db->get_where('putme_ssce_sitting_one', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$ssce2 = $this->db->get_where('putme_ssce_sitting_two', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$directEntry = $this->db->get_where('putme_direct_entry_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
?>
<style type="text/css">
	.td-title{
		
		font-family:'Roboto-Regular' !important;
	}
</style>
</div>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="col-md-1 no-p">
				<div class="number">
					<p>08</p>
				</div>
			</div>
			<div class="col-md-11 no-p">
				<div class="page-title">
					<p>Preview Details</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 no-p" style="margin-top:0px;">
		<?php echo form_open('putme/processPreviewDetails', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="col-md-12" style="margin-top:20px;">
			<div class="pull-right no-p receipt-image-div">
				<img src="<?php echo 'uploads/student_image/' . $student->photo . '.jpg'; ?>" width="150px" height="150px" />
			</div>
		</div>
		<div class="col-md-12 middle no-p">
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Personal Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td class="td-title">Portal ID</td>
								<td><?php echo $_SESSION['putmeID']; ?></td>
								<td class="td-title">JAMB Reg No / Matric No</td>
								<td><?php echo $card->jamb; ?></td>
							</tr>
							<tr>
								<td class="td-title">Firstname</td>
								<td><?php echo $student->firstname; ?></td>
								<td class="td-title">Middlename</td>
								<td><?php echo $student->middlename; ?></td>
							</tr>
							<tr>
								<td class="td-title">Surname</td>
								<td><?php echo $student->lastname; ?></td>
								<td class="td-title">Sex</td>
								<td><?php echo $student->sex; ?></td>
							</tr>
							<tr>
								<td class="td-title">Date Of Birth</td>
								<td><?php echo $student->date_of_birth; ?></td>
								<td class="td-title">State Of Origin</td>
								<td><?php echo $origin->state; ?></td>
							</tr>
							<tr>
								<td class="td-title">LGA Of Origin</td>
								<td><?php echo $origin->lga; ?></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 middle no-p">
			<?php if($designation->designation == 'Jamb'){ ?>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>JAMB Result Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td class="td-title"><?php echo $jamb->english; ?></td>
								<td><?php echo $jamb->englishscore; ?></td>
								<td class="td-title"><?php echo $jamb->subj2; ?></td>
								<td><?php echo $jamb->subj2score; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $jamb->subj3; ?></td>
								<td><?php echo $jamb->subj3score; ?></td>
								<td class="td-title"><?php echo $jamb->subj4; ?></td>
								<td><?php echo $jamb->subj4score; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo 'Total Score'; ?></td>
								<td><?php echo $jamb->total_score; ?></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php }else if($designation->designation == 'Direct'){ ?>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Previous Study Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td class="td-title">Institution</td>
								<td><?php echo $directEntry->institution; ?></td>
								<td class="td-title">Discipline</td>
								<td><?php echo $directEntry->discipline; ?></td>
							</tr>
							<tr>
								<td class="td-title">Class Of Graduation</td>
								<td><?php echo $directEntry->class_of_graduation; ?></td>
								<td class="td-title">Year Of Graduation</td>
								<td><?php echo $directEntry->year_of_graduation; ?></td>
							</tr>
							<tr>
								<td class="td-title">CGPA</td>
								<td><?php $cgpa = $directEntry->cgpa == '' || $directEntry->cgpa == NULL || empty($directEntry->cgpa) ? 'N/A' : $directEntry->cgpa; ?></td>
								<td class="td-title"></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="col-md-12 middle no-p">
			<div class="widget stacked">
				<div class="widget-header">
					<h3 style="width:95% !important;">SSCE Results Details
						<span class="pull-right" style="float:right">
							No Of Sittings: <?php echo $sscedetails->no_of_sittings; ?>
						</span>
					</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td class="td-title">Examination Type</td>
								<td><?php echo $ssce1->examtype; ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->english; ?></td>
								<td><?php echo $ssce1->englishgrade; ?></td>
								<td class="td-title"><?php echo $ssce1->maths; ?></td>
								<td><?php echo $ssce1->mathsgrade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->subj3; ?></td>
								<td><?php echo $ssce1->subj3grade; ?></td>
								<td class="td-title"><?php echo $ssce1->subj4; ?></td>
								<td><?php echo $ssce1->subj4grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->subj5; ?></td>
								<td><?php echo $ssce1->subj5grade; ?></td>
								<td class="td-title"><?php echo $ssce1->subj6; ?></td>
								<td><?php echo $ssce1->subj6grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->subj7; ?></td>
								<td><?php echo $ssce1->subj7grade; ?></td>
								<td class="td-title"><?php echo $ssce1->subj8; ?></td>
								<td><?php echo $ssce1->subj8grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->subj9; ?></td>
								<td><?php echo $ssce1->subj9grade; ?></td>
								<td></td>
								<td></td>
							</tr>
							<?php if($sscedetails->no_of_sittings == '2' || $sscedetails->no_of_sittings == 2){ ?>
							<tr>
								<td class="td-title">Examination Type</td>
								<td><?php echo $ssce2->examtype; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce2->english; ?></td>
								<td><?php echo $ssce2->englishgrade; ?></td>
								<td class="td-title"><?php echo $ssce2->maths; ?></td>
								<td><?php echo $ssce2->mathsgrade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce2->subj3; ?></td>
								<td><?php echo $ssce2->subj3grade; ?></td>
								<td class="td-title"><?php echo $ssce2->subj4; ?></td>
								<td><?php echo $ssce2->subj4grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce1->subj5; ?></td>
								<td><?php echo $ssce1->subj5grade; ?></td>
								<td class="td-title"><?php echo $ssce1->subj6; ?></td>
								<td><?php echo $ssce1->subj6grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce2->subj7; ?></td>
								<td><?php echo $ssce2->subj7grade; ?></td>
								<td class="td-title"><?php echo $ssce2->subj8; ?></td>
								<td><?php echo $ssce2->subj8grade; ?></td>
							</tr>
							<tr>
								<td class="td-title"><?php echo $ssce2->subj9; ?></td>
								<td><?php echo $ssce2->subj9grade; ?></td>
								<td></td>
								<td></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 middle no-p">
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Course Application Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td class="td-title">Course Applied For</td>
								<td><?php echo $course->department; ?></td>
								<td class="td-title">Faculty / School</td>
								<td><?php echo $course->school; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 no-p">
			<label>
				<input type="checkbox" required name="confirm" style="margin-top:-1px; width:12px; height:12px;" /> &nbsp; <span>I confirm that the information displayed above is correct and void of errors</span>
			</label>
		</div>
		<div class="col-md-12">
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<a href="<?php echo base_url() . 'index.php?putme/editStudentDetails'; ?>">
					<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger">
						<i class="glyphicon glyphicon-edit"></i> &nbsp; Edit
					</div>
				<button type="submit" style="padding:10px; 15px" class="btn btn-info">
					<i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue
				</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>