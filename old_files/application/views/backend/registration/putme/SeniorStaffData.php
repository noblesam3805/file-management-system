<?php session_start(); 

	if(!isset($_SESSION['desig']) && $_SESSION['desig'] == 'SENIOR'){
		redirect(base_url() . 'index.php?registration', 'refresh');
	}

	$states = $this->db->get('states')->result_array();
	$countries = $this->db->get('countries')->result_array();
		$schools = $this->db->get('schools_staff')->result_array();
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
					<p>Senior Staff Information (Welcome <?php echo $staff_info->firstname;?>)</p></p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" style="margin-top:20px; margin-bottom:20px;">
			<div class="col-md-12 country-line">
				Staff Nationality: &nbsp; 
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
			<?php echo form_open('staff_registration/insertStaffInformation/nigerian', array('class' => 'form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'target'=>'_top')); ?>
			
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
								<select name="title" required="" class="form-control eduportal-input">
										<option value="">Select An Option</option>
								<option value="Mr.">Mr</option>
										<option value="Mrs.">Mrs</option>
										<option value="Ms.">Ms</option>
										<option value="Miss">Miss</option>
                                        <option value="Engr">Engr</option>
                                         <option value="Chief">Chief</option>
                                         <option value="Dr.">Dr</option>
										 <option value="Prof.">Prof</option>
										 <option value="Arc.">Arc</option>
										 <option value="Suv.">Suv</option>
										 <option value="Sister.">Sister</option>
										 <option value="Rev.Fr.">Rev. Father</option>
										 <option value="Pst.">Pastor</option>
										  <option value="Cde.">Comrade</option>
										   <option value="Rev.">Rev.</option>
									</select>
								</div>
							</div>
						</div>
                              <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Surname</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="surname" required class="form-control eduportal-input" placeholder="Last Name" value="<?php echo $staff_info->surname;?>"/>
								</div>
							</div>
						</div>
												
					</div>
					<div class="col-md-12 no-p">
                    
                    <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">First Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="firstname" required class="form-control eduportal-input" placeholder="First Name" value="<?php echo $staff_info->firstname;?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Middle Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="middlename"  class="form-control eduportal-input" placeholder="Middle Name" value="<?php echo $staff_info->middlename;?>"/>
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
								<label class="label-control" for="course name">Phone Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="phone" required class="form-control eduportal-input" placeholder="Phone Number"/>
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
								<label class="label-control" for="course name">File Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="fileno" required class="form-control eduportal-input" placeholder="File Number" value="<?php echo $_SESSION['reg'];?>"/>
								</div>
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
								<label class="label-control" for="course name">Date Of First Appointment</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="date_first_employment" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of First Appointment"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Rank On First Appointment</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="rank_on_appointment" id="rank_on_appointment" required class="form-control eduportal-input" />
										
								</div>
							</div>
						</div>
					</div>
                    
                     <div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Salary Grade Level</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="salary_grade" id="salary_grade" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Salary Step</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="salary_step" required class="form-control eduportal-input" placeholder=""/>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-md-12 no-p">
						
						
                        <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Present Rank</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="present_rank" required class="form-control eduportal-input" placeholder=""/>
                                </div>
                            </div>
                        </div>	
                        
                         <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Present Rank Date</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="present_rank_date" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Present Rank Date"/>
								</div>
							</div>
						</div>		
					</div>
                    
                                             
                    
					<div class="col-md-12 no-p">
				<div class="col-md-6 no-p">
                
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name"> Qualification With Date</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="entry_qualification" required class="form-control eduportal-input" placeholder="Entry Qualification With Date"/>
								</div>
							</div>
						</div>
                        <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">School</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="staff_school" required class="form-control eduportal-input"  id="staff_school">
										<option value="">Select An Option</option>
                                  
                                     <?php foreach($schools as $d => $val): ?>
											<option value="<?php echo $val['schoolname']; ?>"><?php echo $val['schoolname']; ?></option>
										<?php endforeach; ?>
										
									</select>
								</div>
							</div>
						</div>
                        <div class="col-md-12 no-p">
                      <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Department/Unit</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="staff_dept"  id="staff_dept" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										
									</select>
								</div>
							</div>
						</div>
                       <div class="col-md-6 no-p">
                
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Publications With Dates</label>
                                 	<div class="input-group input-group-lg eduportal-input-group">
                                              <input type="file" required name="publicationfile" placeholder="(Publication File)" >
                                              </div>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									
                      <input name="publications"  required="required" class="form-control eduportal-input" placeholder="(Publication Date)"/>
								</div>
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
                        <div class="col-md-3 photo" >
					                    
											<label class="label-control">Signature</label>

										
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
														<img src="<?php echo 'images/sign.jpg '; ?>"  width="100" />
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="max-width: 200px; height: 200px"></div>
													<div>
														<span class="btn btn-white btn-file">
															<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="usersign" accept="image/*">
														</span>
														<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
												</div>
											</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-p" style="background-color:#fff; padding:20px" >
				<label>
					<input type="checkbox" required name="confirm" style="margin-top:-1px; width:12px; height:12px;" /> &nbsp; <span>Declaration: I hereby declare that the information supplied above is to the best of my knowledge true and correct.</span>
				</label>
			</div>
			<hr />
			<div class="col-md-12">
				<div class="form-group eduportal-form-group p20" style="text-align:center;">
					<label>&nbsp;</label>
					<button type="submit" name="" style="width:300px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Submit Staff Information</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
		
		<!-- ********************************* --
			END OF NIGERIAN FORM
		---- ********************************* -->
		
		<div class="foreign-form">
			<?php echo form_open('student_registration/insertStaffInformation/nigerian', array('class' => 'form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'target'=>'_top')); ?>
			
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
                                        <option value="Eng">Engr</option>
                                         <option value="Chief">Chief</option>
                                         <option value="Dr">Dr</option>
									</select>
								</div>
							</div>
						</div>
       <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Surname</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="surname" required class="form-control eduportal-input" placeholder="Last Name" value="<?php echo $staff_info->surname;?>"/>
								</div>
							</div>
						</div>
												
					</div>
					<div class="col-md-12 no-p">
                    
                    <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">First Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="firstname" required class="form-control eduportal-input" placeholder="First Name" value="<?php echo $staff_info->firstname;?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Middle Name</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="middlename"  class="form-control eduportal-input" placeholder="Middle Name" value="<?php echo $staff_info->middlename;?>"/>
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
								<label class="label-control" for="course name">Phone Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="phone" required class="form-control eduportal-input" placeholder="Phone Number"/>
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
								<label class="label-control" for="course name">File Number</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="fileno" required class="form-control eduportal-input" placeholder="File Number" value="<?php echo $_SESSION['reg'];?>"/>
								</div>
							</div>
						</div>            
                        
					</div>
                                  
					</div>
                    <div class="col-md-12 no-p">
								<div class="col-md-6 no-p">
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
                           <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Contendiss/Conpcass</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="staff_category" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="CONTENDISS">CONTENDISS</option>
										<option value="CONPCASS">CONPCASS</option>
									</select>
                                </div>
                            </div>
                        </div>
					</div>
                    
                   <div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Date Of First Appointment</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="date_first_employment" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of First Appointment"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Rank On First Appointment</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="rank_on_appointment" id="rank_on_appointment" required class="form-control eduportal-input" />
								</div>
							</div>
						</div>
					</div>
                     <div class="col-md-12 no-p">
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Salary Grade Level</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="salary_grade" id="salary_grade" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
                                              <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Salary Step</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="salary_step" id="salary_step" required class="form-control eduportal-input" />
								</div>
							</div>
						</div>
					</div>
                    <div class="col-md-12 no-p">
						
						
                        <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Present Rank With Date</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="present_rank_date" required class="form-control eduportal-input" placeholder=""/>
                                    </div>
                                    </div>
                                    </div>	
                                    <div class="col-md-6 no-p">
                
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Qualification With Date</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="entry_qualification" required class="form-control eduportal-input" placeholder=" Qualification With Date"/>
								</div>
							</div>
						</div>	
					</div>
                    
                                             
                    
					<div class="col-md-12 no-p">
				
                       <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">School</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="staff_school" required class="form-control eduportal-input"  id="staff_school2">
										<option value="">Select An Option</option>
                                  
                                     <?php foreach($schools as $d => $val): ?>
											<option value="<?php echo $val['schoolname']; ?>"><?php echo $val['schoolname']; ?></option>
										<?php endforeach; ?>
										
									</select>
								</div>
							</div>
						</div>
                        <div class="col-md-6 no-p">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Department/Unit</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="staff_dept"  id="staff_dept2" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										
									</select>
								</div>
							</div>
						</div>
                        
                        <div class="col-md-12 no-p">
                     
                         <div class="col-md-6 no-p">
                
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Publications With Dates</label>
                                 	<div class="input-group input-group-lg eduportal-input-group">
                                              <input type="file" required name="publicationfile" placeholder="(Publication File)" >
                                              </div>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									
                      <input name="publications"  required="required" class="form-control eduportal-input" placeholder="(Publication Date)"/>
								</div>
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
									<img src="<?php echo base_url() . 'images/default.jpg'; ?>" alt="...">
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
                        <div class="col-md-3 photo" >
					                    
											<label class="label-control">Signature</label>

										
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
														<img src="<?php echo 'images/sign.jpg '; ?>"  width="100" />
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="max-width: 200px; height: 200px"></div>
													<div>
														<span class="btn btn-white btn-file">
															<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="usersign" accept="image/*">
														</span>
														<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
												</div>
											</div>
					</div>
				</div>
			</div>
				<div class="col-md-12 no-p" style="background-color:#fff; padding:20px" >
				<label>
					<input type="checkbox" required name="confirm" style="margin-top:-1px; width:12px; height:12px;" /> &nbsp; <span>Declaration: I hereby declare that the information supplied above is to the best of my knowledge true and correct.</span>
				</label>
			</div>
			<hr />
			<div class="col-md-12">
				<div class="form-group eduportal-form-group p20" style="text-align:center;">
					<label>&nbsp;</label>
					<button type="submit" name="" style="width:300px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Submit Staff Information</button>
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