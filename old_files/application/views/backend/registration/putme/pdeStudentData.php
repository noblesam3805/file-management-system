<?php session_start(); 

	if(!isset($_SESSION['desig']) && $_SESSION['desig'] == 'PDE'){
		redirect(base_url() . 'index.php?registration', 'refresh');
	}

	$states = $this->db->get('states')->result_array();
	$countries = $this->db->get('countries')->result_array();
?>
<style type="text/css">
	.foreign-form{
		display:none;
	}
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
</style>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="col-md-1 no-p">
				<div class="number">
					<p>02</p>
				</div>
			</div>
			<div class="col-md-11 no-p">
				<div class="page-title">
					<p>Student Information</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" style="margin-top:20px; margin-bottom:20px;">
			<div class="col-md-12 country-line">
				Student Nationality: &nbsp; 
				<label class="radio-inline">
					<input type="radio" name="country-radio" id="nigerian" value="Nigerian" checked /> Nigerian
				</label>
				<label class="radio-inline">
					<input type="radio" name="country-radio" id="foreign" value="Foreign" /> Foreign
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
			<?php echo form_open('student_registration/insertStudentInformation/nigerian', array('class' => 'form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'target'=>'_top')); ?>
			
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Personal Data</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Title</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="title" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Mr">MR</option>
										<option value="Mrs">MRS</option>
										<option value="Master">MASTER</option>
										<option value="Miss">MISS</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">First Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="firstname" required class="form-control eduportal-input" placeholder="First Name"/>
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Middle Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="middlename" required class="form-control eduportal-input" placeholder="Middle Name"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Surname</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="lastname" required class="form-control eduportal-input" placeholder="Last Name"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">PDE Reg.Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="regno" required class="form-control eduportal-input" placeholder="PDE Reg.Number"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Phone No</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="phone" required class="form-control eduportal-input" placeholder="Valid Number [ Eg: 08031234567 ]"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Password</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="password" name="password" id="pass1" required class="form-control eduportal-input" placeholder="Enter Password"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Repeat Password <span id="confirmMessage" class="confirmMessage" style="float:right;" ></span></label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="password" name="password_c" id="pass2" onkeyup="checkPass(); return false;" required class="form-control eduportal-input" placeholder="Repeat Password"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Sex</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="sex" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Male">MALE</option>
										<option value="Female">FEMALE</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Marital Status</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="marital" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Single">SINGLE</option>
										<option value="Married">MARRIED</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Date Of Birth</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="dob" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of Birth"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Address</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="address" required class="form-control eduportal-input" placeholder="Your Address"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">State Of Origin</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="state" id="states" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<?php
											foreach($states as $state => $val): ?>
												<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
											<?php endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">L.G.A</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="lga" id="lga" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Name Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="pname" required class="form-control eduportal-input" placeholder="Name Of Parent / Guardian"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Phone Number Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="pphone" required class="form-control eduportal-input" placeholder="Phone Number Of Parent / Guardian"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Address Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="paddr" required class="form-control eduportal-input" placeholder="Address Of Parent / Guardian"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Academic Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Department</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="dept" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										
											<option value="26">PDE DEPARTMENT</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Programme Type</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="prog_type" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="PDE REGULAR">PDE REGULAR</option>
										
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Current Level</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="clevel" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="PDE">PDE</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Current Semester</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="csemester" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="FIRST">FIRST</option>
										<option value="SECOND">SECOND</option>
									</select>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Admission Session</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="admsession" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="2016/2017">2016/2017</option>
										<option value="2015/2016">2015/2016</option>
										<option value="2014/2015">2014/2015</option>
										<option value="2013/2014">2013/2014</option>
                                        <option value="2012/2013">2012/2013</option>
                                        <option value="2011/2012">2011/2012</option>
									</select>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Upload Photo</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-3 photo">
							<label class="label-control">Passport</label>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" data-trigger="fileinput">
									<img src="<?php echo base_url() . 'images/default.png'; ?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 200px; height: 200px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" required name="passport" accept="image/*">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-p">
				<label>
					<input type="checkbox" required name="confirm" style="margin-top:-1px; width:12px; height:12px;" /> &nbsp; <span>I confirm that the details supplied above belongs to me and is void of errors</span>
				</label>
			</div>
			<hr />
			<div class="col-md-12">
				<div class="form-group eduportal-form-group p20" style="text-align:center;">
					<label>&nbsp;</label>
					<button type="submit" name="" style="width:300px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Submit Student Information</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
		
		<!-- ********************************* --
			END OF NIGERIAN FORM
		---- ********************************* -->
		
		<div class="foreign-form">
			<?php echo form_open('student_registration/insertStudentInformation/foreign', array('class' => 'form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'target'=>'_top')); ?>
			
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Personal Data</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Title</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="title" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Mr">MR</option>
										<option value="Mrs">MRS</option>
										<option value="Master">MASTER</option>
										<option value="Miss">MISS</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">First Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="firstname" required class="form-control eduportal-input" placeholder="First Name"/>
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Middle Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="middlename" required class="form-control eduportal-input" placeholder="Middle Name"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Surname</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="lastname" required class="form-control eduportal-input" placeholder="Last Name"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">PDE Reg.Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="regno" required class="form-control eduportal-input" placeholder="PDE Reg.Number"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Phone No</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="phone" required class="form-control eduportal-input" placeholder="Valid Number [ Eg: 08031234567 ]"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Password</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="password" name="password" id="pass1f" required class="form-control eduportal-input" placeholder="Enter Password"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Repeat Password <span id="confirmMessagef" class="confirmMessage" style="float:right;" ></span></label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="password" name="password_c" id="pass2f" onkeyup="checkPassf(); return false;" required class="form-control eduportal-input" placeholder="Repeat Password"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Nationality</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="country" id="states" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<?php
											foreach($countries as $country => $val): if($val['country'] == 'Nigeria'){ continue; }?>
												<option value="<?php echo $val['country']; ?>"><?php echo $val['country']; ?></option>
											<?php endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Sex</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="sex" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Male">MALE</option>
										<option value="Female">FEMALE</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Marital Status</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="marital" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="Single">SINGLE</option>
										<option value="Married">MARRIED</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Date Of Birth</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="dob" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of Birth"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Address</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="address" required class="form-control eduportal-input" placeholder="Your Address"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Name Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="pname" required class="form-control eduportal-input" placeholder="Name Of Parent / Guardian"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Phone Number Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="pphone" required class="form-control eduportal-input" placeholder="Phone Number Of Parent / Guardian"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Address Of Parent / Guardian</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="paddr" required class="form-control eduportal-input" placeholder="Address Of Parent / Guardian"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Academic Details</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Department</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="dept" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										
											<option value="136">PDE DEPARTMENT</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Programme Type</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="prog_type" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="PDE REGULAR">PDE REGULAR</option>
										
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Current Level</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="clevel" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="PDE">PDE</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Current Semester</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="csemester" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="FIRST">FIRST</option>
										<option value="SECOND">SECOND</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Upload Photo</h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12 no-p">
						<div class="col-md-3 photo">
							<label class="label-control">Passport</label>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" data-trigger="fileinput">
									<img src="<?php echo base_url() . 'images/default.png'; ?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 200px; height: 200px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" required name="passport" accept="image/*">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-p">
				<label>
					<input type="checkbox" required name="confirm" style="margin-top:-1px; width:12px; height:12px;" /> &nbsp; <span>I confirm that the details supplied above belongs to me and is void of errors</span>
				</label>
			</div>
			<hr />
			<div class="col-md-12">
				<div class="form-group eduportal-form-group p20" style="text-align:center;">
					<label>&nbsp;</label>
					<button type="submit" name="" style="width:300px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Submit Student Information</button>
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