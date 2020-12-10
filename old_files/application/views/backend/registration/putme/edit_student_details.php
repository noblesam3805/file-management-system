<?php
	session_start();

	$student = $this->db->get_where('putme_students', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$card = $this->db->get_where('putme_card_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$study = $this->db->get_where('putme_direct_entry_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$appcourse = $this->db->get_where('putme_course_application', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$designation = $this->db->get_where('putme_student_designation', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$details = $this->db->get_where('putme_card_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$jamb = $this->db->get_where('putme_jamb_results', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$sscedetails = $this->db->get_where('putme_ssce_result_details', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$ssce1 = $this->db->get_where('putme_ssce_sitting_one', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$ssce2 = $this->db->get_where('putme_ssce_sitting_two', array("putme_id" => $_SESSION['putmeID']))->row();
	
	$origin = $this->db->get_where('putme_student_origin', array("putme_id" => $_SESSION['putmeID']))->row();
	
	
	$institutions = $this->db->get('putme_institutions')->result_array();
	
	$discipline = $this->db->get('putme_discipline')->result_array();
	
	$class = $this->db->get('eduportal_class_of_graduation')->result_array();
	
	$points = $this->db->get('putme_credit_points')->result_array();
	
	if(isset($_SESSION['desig']) && $_SESSION['desig'] == 'Nce'){
		$departments = $this->db->get('putme_nce_dept')->result_array();
	}else{
		$departments = $this->db->get('putme_department')->result_array();
	} 
	
	$states = $this->db->get('states')->result_array();
	
	$countries = $this->db->get('countries')->result_array();
	
	$subjects = $this->db->get('putme_ssce_subjects')->result_array();
	
	$subjects = $this->db->get('putme_ssce_subjects')->result_array();
	
	$grades = $this->db->get('putme_ssce_grades')->result_array();
?>
<style type="text/css">
	.foreign-form{
		display:none;
	}
	.country-line{
		float:left;
		width:100%;
		padding:10px;
		background:#DEDEDE;
		margin:20px 0 0 0;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line input[type=radio]{
		background-image :    -moz-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :     -ms-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :      -o-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image : -webkit-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :         linear-gradient(rgb(224,224,224),rgb(240,240,240));
		width:20px;
		height:20px;
		font-size:22px;
	}
	.input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn{
		font-size:13px;
		padding:10px;
	}
</style>
<div class="col-md-10 no-p middle">
	<div class="col-md-12 no-p">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Edit Student Details</h3>
			</div> 
			
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['editReport'])){ echo $_SESSION['editReport']; } ?>
				<p style="font-size:14px; color:#820E29; text-align:center;margin-top:20px;">
					<?php 
						if(isset($_SESSION['imgerror'])){
							echo $_SESSION['imgerror'];
						}
					?>
				</p>
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>Personal Details</h3>
						<hr />
						<?php if($student->nationality == 'Nigeria'){ ?>
						<?php echo form_open('putme/updateStudentDetails/personal/nigerian', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">First Name</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="firstname" id="fn" class="form-control eduportal-input" value="<?php echo $student->firstname; ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Middle Name</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="middlename" id="mn" class="form-control eduportal-input" value="<?php echo $student->middlename; ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Last Name</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="lastname" id="ln" class="form-control eduportal-input" value="<?php echo $student->lastname; ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Sex</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select class="form-control eduportal-input" id="sex" name="sex">
											<option value="<?php echo $student->sex; ?>"><?php echo $student->sex; ?></option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Phone Number</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="phone" id="ph" class="form-control eduportal-input" value="<?php echo $details->phone; ?>" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Date Of Birth</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="dob" id="dob" class="form-control eduportal-input" value="<?php echo $student->date_of_birth; ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">State Of Origin</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="state" id="states" required class="form-control eduportal-input">
											<option value="<?php echo $origin->state; ?>"><?php echo $origin->state; ?></option>
											<?php
												foreach($states as $state => $val): ?>
													<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
												<?php endforeach;
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">L.G.A</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="lga" id="lga" required class="form-control eduportal-input">
											<option value="<?php echo $origin->lga; ?>"><?php echo $origin->lga; ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Address</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="address" value="<?php echo $student->address; ?>" required class="form-control eduportal-input" placeholder="Your Address"/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Jamb Reg No / Matric No</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="jamb" value="<?php echo $card->jamb; ?>" required class="form-control eduportal-input" placeholder="Your Address"/>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20" style="text-align:center;">
								<label>&nbsp;</label>
								<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
								<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<?php }else{ ?>
				<?php echo form_open('putme/updateStudentDetails/personal/foreign', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="col-md-12 no-p">
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">First Name</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="firstname" id="fn" class="form-control eduportal-input" value="<?php echo $student->firstname; ?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Middle Name</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="middlename" id="mn" class="form-control eduportal-input" value="<?php echo $student->middlename; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 no-p">
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Last Name</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="lastname" id="ln" class="form-control eduportal-input" value="<?php echo $student->lastname; ?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Sex</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select class="form-control eduportal-input" id="sex" name="sex">
									<option value="<?php echo $student->sex; ?>"><?php echo $student->sex; ?></option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 no-p">
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Phone Number</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="phone" id="ph" class="form-control eduportal-input" value="<?php echo $details->phone; ?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Date Of Birth</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="dateofbirth" id="dob" class="form-control eduportal-input" value="<?php echo $student->date_of_birth; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 no-p">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Country Of Origin</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select class="form-control eduportal-input" name="country">
								<option value="<?php echo $student->nationality; ?>"><?php echo $student->nationality; ?></option>
								<?php
									foreach($countries as $country => $val): if($val['country'] == 'Nigeria'){ continue; }?>
										<option value="<?php echo $val['country']; ?>"><?php echo $val['country']; ?></option>
									<?php endforeach;
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group eduportal-form-group p20" style="text-align:center;">
						<label>&nbsp;</label>
						<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
						<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<?php } ?>
				
				
				<?php if($designation->designation == 'Jamb' || $designation->designation == 'Nce'){ ?>
				
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>Jamb Result Details</h3>
						<hr />
						<?php echo form_open('putme/updateStudentDetails/jamb', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
						<div class="col-md-12 no-p">
							<div class="col-md-12 no-p">
								<div class="col-md-6 no-p">
									<div class="col-md-8 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">English Language</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
												<select name="english" required class="form-control eduportal-input">
													<option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Score</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<select name="englishscore" required id="eng" class="form-control eduportal-input jambscore">
													<option value="<?php echo $jamb->englishscore; ?>"><?php echo $jamb->englishscore; ?></option>
													<?php for($i = 0; $i <= 100;){ ?>
														<option value="<?php echo $i ?>"><?php echo $i; ?></option>
													<?php $i++; } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 no-p">
									<div class="col-md-8 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Subject 2</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
												<select name="subj2" class="form-control eduportal-input">
													<option value="<?php echo $jamb->subj2; ?>" selected ><?php echo $jamb->subj2; ?></option>
													<?php
														foreach($subjects as $subj => $val): 
															if($val['subject'] == 'ENGLISH LANGUAGE'){
																continue;
															}
														?>
														<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Score</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<select name="subj2score" id="subj1" required class="form-control eduportal-input jambscore">
													<option value="<?php echo $jamb->subj2score; ?>"><?php echo $jamb->subj2score; ?></option>
													<?php for($i = 0; $i <= 100;){ ?>
														<option value="<?php echo $i ?>"><?php echo $i; ?></option>
													<?php $i++; } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 no-p">
								<div class="col-md-6 no-p">
									<div class="col-md-8 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Subject 3</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
												<select name="subj3" class="form-control eduportal-input">
													<option value="<?php echo $jamb->subj3; ?>" selected ><?php echo $jamb->subj3; ?></option>
													<?php
														foreach($subjects as $subj => $val): 
															if($val['subject'] == 'ENGLISH LANGUAGE'){
																continue;
															}
														?>
														<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Score</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<select name="subj3score" id="subj2" required class="form-control eduportal-input jambscore">
													<option value="<?php echo $jamb->subj3score; ?>"><?php echo $jamb->subj3score; ?></option>
													<?php for($i = 0; $i <= 100;){ ?>
														<option value="<?php echo $i ?>"><?php echo $i; ?></option>
													<?php $i++; } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 no-p">
									<div class="col-md-8 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Subject 4</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
												<select name="subj4" class="form-control eduportal-input">
													<option value="<?php echo $jamb->subj4; ?>" selected ><?php echo $jamb->subj4; ?></option>
													<?php
														foreach($subjects as $subj => $val): 
															if($val['subject'] == 'ENGLISH LANGUAGE'){
																continue;
															}
														?>
														<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4 no-p">
										<div class="form-group eduportal-form-group p20">
											<label class="label-control" for="course name">Score</label>
											<div class="input-group input-group-lg eduportal-input-group">
												<select name="subj4score" id="subj3" required class="form-control eduportal-input jambscore">
													<option value="<?php echo $jamb->subj4score; ?>"><?php echo $jamb->subj4score; ?></option>
													<?php for($i = 0; $i <= 100;){ ?>
														<option value="<?php echo $i ?>"><?php echo $i; ?></option>
													<?php $i++; } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12" style="margin-top:20px; text-align:center;">
									<div class="col-md-12 country-line">
										<span id="jambresult">Total Score: <?php echo $jamb->total_score; ?></span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group eduportal-form-group p20" style="text-align:center;">
									<label>&nbsp;</label>
									<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
									<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				
				<?php }elseif($designation->designation == 'Direct'){ ?>
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>Previous Study Details</h3>
						<hr />
						<?php echo form_open('putme/updateStudentDetails/direct', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Previous Institution</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="institution" id="inst" required class="form-control eduportal-input">
											<option value="<?php echo $study->institution; ?>"><?php echo $study->institution; ?></option>
											<?php
												foreach($institutions as $inst => $val): ?>
													<option value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></option>
												<?php endforeach; 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Previous Discipline</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="discipline" id="disc" required class="form-control eduportal-input">
											<option value="<?php echo $study->discipline; ?>"><?php echo $study->discipline; ?></option>
											<?php
												foreach($discipline as $disc => $val): ?>
													<option value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></option>
												<?php endforeach;
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Graduation Year</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="grad_year" id="gradyr" required class="form-control eduportal-input">
											<option value="<?php echo $study->year_of_graduation; ?>"><?php echo $study->year_of_graduation; ?></option>
											<?php
												for($i = Date('Y'); $i > 1960; $i--){ ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php }
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Class Of Graduation</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="grad_class" id="gradclass" required class="form-control eduportal-input">
											<option value="<?php echo $study->class_of_graduation; ?>"><?php echo $study->class_of_graduation; ?></option>
											<?php
												foreach($class as $cls => $val): ?>
													<option value="<?php echo $val['class']; ?>"><?php echo $val['class']; ?></option>
												<?php endforeach;
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Credit Points</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="creditpoint" required class="form-control eduportal-input">
											<option value="<?php echo $study->cgpa; ?>"><?php echo $study->cgpa; ?></option>
											<?php foreach($points as $point => $val): ?>
												<option value="<?php echo $val['credit_point']; ?>"><?php echo $val['credit_point']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control">Certification Type</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="cert_type" required class="form-control eduportal-input">
											<option value="<?php echo $study->certification_type; ?>"><?php echo $study->certification_type; ?></option>
											<option value="NCE">NCE</option>
											<option value="OND">OND</option>
											<option value="HND">HND</option>
											<option value="BSC">BSC</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20" style="text-align:center;">
								<label>&nbsp;</label>
								<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
								<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<?php } ?>
				
				<?php if($sscedetails->no_of_sittings == '1' || $sscedetails->no_of_sittings == 1){ ?>
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>SSCE Results
							<span class="pull-right" style="float:right">
								No Of Sittings: <?php echo $sscedetails->no_of_sittings; ?>
							</span>
						</h3>
						<hr />
						<?php echo form_open('putme/updateStudentDetails/ssce/one', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Examination Type</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="examtype" required class="form-control eduportal-input">
											<option value="<?php echo $ssce1->examtype; ?>"><?php echo $ssce1->examtype; ?></option>
											<option value="WAEC">WAEC</option>
											<option value="NECO">NECO</option>
											<option value="NABTEB">NABTEB</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">English Language</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="english" required class="form-control eduportal-input">
												<option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="englishgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->englishgrade; ?>"><?php echo $ssce1->englishgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">MATHEMATICS</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="maths" required class="form-control eduportal-input">
												<option value="MATHEMATICS">MATHEMATICS</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="mathsgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->mathsgrade; ?>"><?php echo $ssce1->mathsgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 3</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj3" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj3; ?>"><?php echo $ssce1->subj3; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj3grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj3grade; ?>"><?php echo $ssce1->subj3grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 4</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj4" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj4; ?>"><?php echo $ssce1->subj4; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj4grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj4grade; ?>"><?php echo $ssce1->subj4grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 5</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj5" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj5; ?>"><?php echo $ssce1->subj5; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj5grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj5grade; ?>"><?php echo $ssce1->subj5grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 6</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj6" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj6; ?>"><?php echo $ssce1->subj6; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj6grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj6grade; ?>"><?php echo $ssce1->subj6grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 7</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj7" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj7; ?>"><?php echo $ssce1->subj7; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj7grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj7grade; ?>"><?php echo $ssce1->subj7grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 8</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj8" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj8; ?>"><?php echo $ssce1->subj8; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj8grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj8grade; ?>"><?php echo $ssce1->subj8grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 9</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj9" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj9; ?>"><?php echo $ssce1->subj9; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>	
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj9grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj9grade; ?>"><?php echo $ssce1->subj9grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20" style="text-align:center;">
								<label>&nbsp;</label>
								<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
								<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
				
				<?php }elseif($sscedetails->no_of_sittings == '2' || $sscedetails->no_of_sittings == 2){ ?>
				
				<?php echo form_open('putme/updateStudentDetails/ssce/two', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>SSCE Results
							<span class="pull-right" style="float:right">
								No Of Sittings: <?php echo $sscedetails->no_of_sittings; ?>
							</span>
						</h3>
						<hr />
						<h5>Examination One</h5>
						<?php echo form_open('putme/updateStudentDetails/ssce/one', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Examination Type</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="examtype" required class="form-control eduportal-input">
											<option value="<?php echo $ssce1->examtype; ?>"><?php echo $ssce1->examtype; ?></option>
											<option value="WAEC">WAEC</option>
											<option value="NECO">NECO</option>
											<option value="NABTEB">NABTEB</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">English Language</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="english" required class="form-control eduportal-input">
												<option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="englishgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->englishgrade; ?>"><?php echo $ssce1->englishgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">MATHEMATICS</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="maths" required class="form-control eduportal-input">
												<option value="MATHEMATICS">MATHEMATICS</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="mathsgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->mathsgrade; ?>"><?php echo $ssce1->mathsgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 3</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj3" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj3; ?>"><?php echo $ssce1->subj3; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj3grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj3grade; ?>"><?php echo $ssce1->subj3grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 4</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj4" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj4; ?>"><?php echo $ssce1->subj4; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj4grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj4grade; ?>"><?php echo $ssce1->subj4grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 5</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj5" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj5; ?>"><?php echo $ssce1->subj5; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj5grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj5grade; ?>"><?php echo $ssce1->subj5grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 6</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj6" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj6; ?>"><?php echo $ssce1->subj6; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj6grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj6grade; ?>"><?php echo $ssce1->subj6grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 7</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj7" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj7; ?>"><?php echo $ssce1->subj7; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj7grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj7grade; ?>"><?php echo $ssce1->subj7grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 8</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj8" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj8; ?>"><?php echo $ssce1->subj8; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj8grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj8grade; ?>"><?php echo $ssce1->subj8grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 9</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj9" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj9; ?>"><?php echo $ssce1->subj9; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>	
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj9grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce1->subj9grade; ?>"><?php echo $ssce1->subj9grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h5>Examination Two</h5>
						<hr />
						
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="form-group eduportal-form-group p20">
									<label class="label-control" for="course name">Examination Type</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="examtype" required class="form-control eduportal-input">
											<option value="<?php echo $ssce2->examtype; ?>"><?php echo $ssce2->examtype; ?></option>
											<option value="WAEC">WAEC</option>
											<option value="NECO">NECO</option>
											<option value="NABTEB">NABTEB</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">English Language</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="english" required class="form-control eduportal-input">
												<option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="englishgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->englishgrade; ?>"><?php echo $ssce2->englishgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">MATHEMATICS</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="maths" required class="form-control eduportal-input">
												<option value="MATHEMATICS">MATHEMATICS</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="mathsgrade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->mathsgrade; ?>"><?php echo $ssce2->mathsgrade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 3</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj3" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj3; ?>"><?php echo $ssce2->subj3; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj3grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj3grade; ?>"><?php echo $ssce2->subj3grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 4</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj4" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj4; ?>"><?php echo $ssce2->subj4; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj4grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj4grade; ?>"><?php echo $ssce2->subj4grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 5</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj5" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj5; ?>"><?php echo $ssce2->subj5; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj5grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj5grade; ?>"><?php echo $ssce2->subj5grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 6</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj6" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj6; ?>"><?php echo $ssce2->subj6; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj6grade" required class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj6grade; ?>"><?php echo $ssce2->subj6grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 7</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj7" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj7; ?>"><?php echo $ssce2->subj7; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj7grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj7grade; ?>"><?php echo $ssce2->subj7grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 8</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj8" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj8; ?>"><?php echo $ssce2->subj8; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj8grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj8grade; ?>"><?php echo $ssce2->subj8grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 no-p">
							<div class="col-md-6 no-p">
								<div class="col-md-8 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Subject 9</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="subj9" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj9; ?>"><?php echo $ssce2->subj9; ?></option>
												<?php
													foreach($subjects as $subj => $val): 
														if($val['subject'] == 'ENGLISH LANGUAGE' || $val['subject'] == 'MATHEMATICS'){
															continue;
														}
													?>
													<option value="<?php echo $val['subject']; ?>"><?php echo $val['subject']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>	
								<div class="col-md-4 no-p">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Grade</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<select name="subj9grade" class="form-control eduportal-input">
												<option value="<?php echo $ssce2->subj9grade; ?>"><?php echo $ssce2->subj9grade; ?></option>
												<?php foreach($grades as $grade => $val): ?>
													<option value="<?php echo $val['grade']; ?>"><?php echo $val['grade']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group eduportal-form-group p20" style="text-align:center;">
						<label>&nbsp;</label>
						<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
						<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
					</div>
				</div>
				<?php echo form_close(); } ?>
				
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>Course Application</h3>
						<hr />
						<?php echo form_open('putme/updateStudentDetails/course', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						
						<div class="col-md-12 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control">Department</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="dept" required class="form-control eduportal-input">
										<option value="<?php echo $appcourse->department; ?>"><?php echo $appcourse->department; ?></option>
										<?php
											foreach($departments as $dept => $val):
											if($_SESSION['desig'] == 'Jamb' && $val['deptName'] == 'GUIDIANCE AND COUNSELLING'){
												continue;
											}
											if($_SESSION['desig'] == 'Jamb' && $val['deptName'] == 'PRIMARY EDUCATION'){
												continue;
											}
										?>
												<option value="<?php echo $val['deptName']; ?>"><?php echo $val['deptName']; ?></option>
											<?php endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20" style="text-align:center;">
								<label>&nbsp;</label>
								<button type="submit" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
								<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				
				<div class="widget stacked">
					<div class="widget-content" style="padding:10px 20px;">
						<h3>Change Passport</h3>
						<hr />
						<?php echo form_open('putme/updateStudentDetails/pix', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
						
						<div class="col-md-12 no-p">
							<div class="col-md-3">
								<label class="label-control">Passport</label>
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" data-trigger="fileinput">
										<img src="<?php if($student->photo == '' || $student->photo == NULL || empty($student->photo)){ echo base_url() . 'images/default.png'; }else{ echo base_url() . 'uploads/student_image/' . $student->photo . '.jpg'; } ?>" width="200px" height="200px" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 200px; height: 200px"></div>
									<div>
										<span class="btn btn-info btn-file">
											<span class="fileinput-new">Select image</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" required name="userfile" accept="image/*">
										</span>
										<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20" style="text-align:center;">
								<label>&nbsp;</label>
								<button type="submit" name="updateCourseOnly" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Save And Update Details</button>
								<div style="padding:10px; 15px" onclick="clearEdit();" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp; Cancel</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<a href="<?php echo base_url() . 'index.php?putme/receipt'; ?>" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-share-alt"></i> &nbsp; Proceed To PrintOut</a>
				<label>&nbsp;</label>
			</div>
		</div>
	</div>
</div>
<?php
	if(isset($_SESSION['editReport'])){
		unset($_SESSION['editReport']);
	}
	if(isset($_SESSION['imgerror'])){
		unset($_SESSION['imgerror']);
	}
?>