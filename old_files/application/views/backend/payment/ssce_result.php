<?php session_start(); 

	if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url());
	}

	$subjects = $this->db->get('prehnd_ssce_subjects')->result_array();
	$grades = $this->db->get('prehnd_ssce_grades')->result_array();
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
	.foreign-form h3{
		float:left !important!;
	}
</style>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="col-md-1 no-p">
				<div class="number">
					<p>06</p>
				</div>
			</div>
			<div class="col-md-11 no-p">
				<div class="page-title">
					<p>SSCE Result(s)</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" style="margin-top:20px;">
			<div class="col-md-12 country-line">
				Number Of Sitings: &nbsp; 
				<label class="radio-inline">
					<input type="radio" name="country-radio" id="nigerian" value="Nigerian" checked /> One
				</label>
				<label class="radio-inline">
					<input type="radio" name="country-radio" id="foreign" value="Two" /> Two
				</label>
			</div>
		</div>
		<p style="font-size:14px; color:#820E29; text-align:center;margin-top:20px;">
			<?php 
				if(isset($_SESSION['error'])){
					echo $_SESSION['error'];
				}
			?>
		</p>
		<div class="nigerian-form">
			<?php echo form_open('putme/registerSsceResult/one', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
			<div class="col-md-12 no-p">
				<div class="col-md-6 no-p">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Examination Type</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="examtype" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<option value="WAEC">WAEC</option>
								<option value="NECO">NECO</option>
								<option value="NABTEB">NABTEB</option>
								<option value="TC2">TC2</option>
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
									<option value="">Choose</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
					<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>

		<div class="foreign-form">
			<?php echo form_open('putme/registerSsceResult/two', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
			<div class="col-md-12">
				<h3 style="float:left; width:100%;">Examination One</h3>
				<div class="col-md-6 no-p">
					<div class="form-group eduportal-form-group">
						<label class="label-control" for="course name">Examination One Type</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="examtype" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<option value="WAEC">WAEC</option>
								<option value="NECO">NECO</option>
								<option value="NABTEB">NABTEB</option>
								<option value="TC2">TC2</option>
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
									<option value="">Choose</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
									<option value="">Select An Option</option>
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
									<option value="">Choose</option>
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
				<h3 style="float:left; width:100%;">Examination Two</h3>
				<div class="col-md-6 no-p">
					<div class="form-group eduportal-form-group">
						<label class="label-control" for="course name">Examination Two Type</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<select name="examtype2" required class="form-control eduportal-input">
								<option value="">Select An Option</option>
								<option value="WAEC">WAEC</option>
								<option value="NECO">NECO</option>
								<option value="NABTEB">NABTEB</option>
								<option value="TC2">TC2</option>
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
								<select name="english2" required class="form-control eduportal-input">
									<option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 no-p">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Grade</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<select name="englishgrade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="maths2" required class="form-control eduportal-input">
									<option value="MATHEMATICS">MATHEMATICS</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 no-p">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Grade</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<select name="mathsgrade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj32" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj3grade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj42" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj4grade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj52" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj5grade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj62" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj6grade2" required class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj72" class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj7grade2" class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj82" class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj8grade2" class="form-control eduportal-input">
									<option value="">Choose</option>
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
								<select name="subj92" class="form-control eduportal-input">
									<option value="">Select An Option</option>
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
								<select name="subj9grade2" class="form-control eduportal-input">
									<option value="">Choose</option>
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
					<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
				</div>
			</div>
			<?php echo form_close(); ?>			
		</div>
	</div>
</div>
<?php
	if(isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
?>