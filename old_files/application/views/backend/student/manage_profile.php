<?php session_start();
$faculty = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");

 foreach($edit_data as $row1){
$school = $this->db->get_where('schools', array("schoolid" => $row1['school']))->row();
$dept = $this->db->get_where('department', array("deptID" => $row1['dept']))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $row1['programme']))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $row1['prog_type']))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $row1['level']))->row();
$stype=$row1['programme'];
$levels = $this->db->query("select *  from course_year_of_study where student_type_id='$stype'");
 }
 $serverName = ".\SQLEXPRESS";
//$connectionInfo = array( "Database"=>"yabatech_edu_por");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//$serverName = "MYHP-PC"; //serverName\instanceName
$connectionInfo = array( "Database"=>"FPNO_Portal", "UID"=>"sa", "PWD"=>"12345");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>
<script type="text/javascript">
	function showNationality(a){
		if(a == "Nigerian"){
			document.getElementById("othernationality").style.display = "none";
			document.getElementById('lgas').style.display = "block";
			document.getElementById('state').style.display = "block";
		}else if(a == "Non-Nigerian"){
			document.getElementById("othernationality").style.display = "block";
			document.getElementById('lgas').style.display = "none";
			document.getElementById('state').style.display = "none";
		}
	}
</script>

<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['imgerror'])){echo $_SESSION['imgerror'];} ?></p>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>

<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">

			<?php if(isset($_SESSION['imgerror'])) {
                echo '<li>';
            }else{
                echo '<li class="active">';
            }
            ?>
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i>
					<?php echo get_phrase('manage_profile');?>
                    	</a></li>
            <?php if(isset($_SESSION['imgerror'])) {
                echo '<li class="active">';
                //echo 'ERROR!';
            }else{
                echo '<li>';
            }
            ?>
            	<a href="#add" data-toggle="tab"><i class="entypo-user"></i>
					<?php echo get_phrase('Upload_picture/Signature');?>
                    	</a></li>
           <li >
            	<a href="#password" data-toggle="tab"><i class="entypo-lock"></i>
					<?php echo get_phrase('change_password');?>
                    	</a></li>


		</ul>
    	<!------CONTROL TABS END------->


		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
            <?php if(isset($_SESSION['imgerror'])) {
                echo '<div class="tab-pane box " id="list" style="padding: 5px">';
            }else {
			echo '<div class="tab-pane box active" id="list" style="padding: 5px">';
            }
            ?>
                <div class="box-content">
					<?php

                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open('student/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_Title');?></label>
                                <div class="col-sm-5">
                                    <select type="text" class="form-control" name="title" required >
                                        <option selected="selected"><?php echo $row['title'];?></option>
                                        <option>Mr.</option>
                                        <option>Mrs.</option>
                                        <option>Miss</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Last_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" required />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Other_names');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="othername" value="<?php echo $row['othername'];?>" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Registration_No');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="reg_no" value="<?php echo $row['reg_no'];?>" required/>Enter your Matric Number if issued.
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date_of_Birth');?></label>
                                <div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2" required>
						</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_Sex');?></label>
                            <div class="col-sm-5">
      							<select type="text" name="sex" class="form-control" required>
                                    <option selected="selected"><?php echo $row['sex'];?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
						    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Marital_Status');?></label>
                            <div class="col-sm-5">
      							<select type="text" name="marital_status" class="form-control" required>
                                    <option value="<?php echo $row['marital_status'];?>"><?php echo $row['marital_status'];?></option>
                                    <option value="Single"><?php echo get_phrase('Single');?></option>
                                    <option value="Married"><?php echo get_phrase('Married');?></option>
                                    <option value="Divorced"><?php echo get_phrase('Divorced');?></option>
                                    <option value="Widowed"><?php echo get_phrase('Widowed');?></option>
                                  </select>
						    </div>
                            </div>
                            <div class="form-group">
						        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('_address');?></label>
  						    <div class="col-sm-5">
  							    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" required>
  						    </div>
					        </div>
                            <div class="form-group">
						        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone_no');?></label>
  						    <div class="col-sm-5">
  							    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" required >
  						    </div>
					        </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_nationality');?></label>
                            <div class="col-sm-5">
      						   <select name="nationality" onchange="showNationality(this.value);" class="form-control">
                                    <option value="Nigerian"><?php echo get_phrase('Nigerian');?></option>
                                    <option value="Non-Nigerian"><?php echo get_phrase('Non_Nigerian');?></option>
                                 </select>
					        </div>

                            </div>
							
							<div class="form-group" id="state">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('State');?></label>
                                <div class="col-sm-5">
      						   <select name="state" class="form-control" onChange="populateLGA(this.value)" required>
                               <option selected="selected"><?php echo $row['state'];?></option>
							   <option  value=''>Select a State</option>
                                    <?php  $sql = "select * from states"; 
									$r = sqlsrv_query($conn,$sql)or die
("Error5:".sqlsrv_errors());
 while ($row = sqlsrv_fetch_array($r)){ $id = $row['id']; $state_name = $row['name']; echo "<option value ='$state_name'> $state_name </option>"; }?>
 
                                    </select>
					        </div>
                            </div>
							
							<div class="form-group" id="othernationality" style="display:none;">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Country');?></label>
                                <div class="col-sm-5">
      						   <select name="country" class="form-control">
                               <option value=''>Select A Country</option>
                                    <option value="<?php echo $row['country'];?>" selected="selected"><?php echo $row['country'];?></option>
                                    <?php  $sql = "select * from countries"; 
									$r = sqlsrv_query($conn,$sql); 
									while ($row = sqlsrv_fetch_array($r)){ $id = $row['id']; $country = $row['country']; echo "<option value ='$country'> $country </option>"; }?>

                                    </select>
					        </div>
							
                            </div>
                            
                            <?php
                            endforeach;
                    foreach($edit_data as $row):
                        ?>

                            <div class="form-group" id="lgas">   <div id="val"></div>
                                <label class="col-sm-3 control-label"><?php echo get_phrase('L_ G_ A');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="lga" name="lga" required>
                                        <option value="<?php echo $row['lga'];?>"><?php echo $row['lga'];?></option>
                                        <option value="">Select a L.G.A</option>
                                    </select>
                                </div>
                                </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_school');?></label>
                                <div class="col-sm-5">
									<select class="form-control" id="school" name="school" required  onChange="checkInstitution(this.value)">
										<option value="<?php echo $row['school'];?>"><?php echo $school->schoolname;?></option>
										<option value="">SELECT YOUR SCHOOL</option>
										<?php foreach($faculty->result() as $row3)
	{
		
	?>
 <option value="<?php  echo $row3->schoolid;?>"><?php  echo $row3->schoolname;?></option>
<?php 
	} 
	?> 
									</select>
                                </div>
                                <?php
                            endforeach;
                    foreach($edit_data as $row):
                        ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_department');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="dept" name="dept" required>
                                        <option value="<?php echo $row['dept'];?>"><?php echo $dept->deptName;?></option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_programme');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="programme" onChange="showProgramme(this.value)" required>
										<option value="<?php echo $row['programme'];?>" selected="selected"><?php echo $programme->student_type_name;?></option>
										<option value="" >Select Your programme</option>
																			<?php foreach($student_type->result() as $row3)
	{
		
	?>
 <option value="<?php  echo $row3->student_type_id;?>"><?php  echo $row3->student_type_name;?></option>
<?php 
	} 
	?> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('programme_type');?></label>
                                <div class="col-sm-5" id="progresult">
                                    <select id="prog_type" name="prog_type" class="form-control" required>
                                        <option value="<?php echo $row['prog_type'];?>" selected="selected"><?php echo $programme_type->programme_type_name;?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_level');?></label>
                                <div class="col-sm-5" id="result2">
                                    <select id="level" name="level"  class="form-control" required>
                                        <option value="<?php echo $row['level'];?>" selected="selected"><?php echo $yr->year_of_study_name;?></option>
                                           <option>Select Your Current Level</option>
                                       <?php foreach($levels->result() as $row3)
	{
		
	?>
 <option value="<?php  echo $row3->year_of_study_id;?>"><?php  echo $row3->year_of_study_name;?></option>
<?php 
	} 
	?> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_semester');?></label>
                                <div class="col-sm-5">
                                    <select id="semester" name="semester" reqired="required" class="form-control">
                                        <option value="<?php echo $row['semester'];?>" selected="selected"><?php echo $row['semester'];?></option>
                                        <option>Select Current Semester</option>
                                        <option>First </option>
                                        <option>Second </option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name_of_parent_/Guardian');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="parent_name" value="<?php echo $row['parent_name'];?>" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone_no of_parent');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="parent_phone" value="<?php echo $row['parent_phone'];?>" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address_of_parent');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="parent_address" value="<?php echo $row['parent_address'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS--->

            <!----CREATION FORM STARTS---->
            <?php if(isset($_SESSION['imgerror'])) {
			echo '<div class="tab-pane box active" id="add" style="padding: 5px">';
            }else{
                echo '<div class="tab-pane box" id="add" style="padding: 5px">';
            }
            ?>
                <div class="box-content">
                    

                	<?php echo form_open('student/manage_profile/change_picture' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                        <div class="padded">

                            <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('_passport');?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student',$this->session->userdata('student_id')); $this->crud_model->clear_cache(); ?>" class="img-circle" width="100" />
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>


                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('_signature');?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_sign_url('student',$this->session->userdata('student_id')); $this->crud_model->clear_cache();?>"  width="100" />
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="usersign" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>


                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload_images');?></button>
                              </div>
						   </div>
                    </form>
                </div>
			</div>

            <div class="tab-pane box" id="password" style="padding: 5px">
                <div class="box-content padded">
					<?php
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open('student/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    //session_unset($_SESSION['imgerror']);
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS--->

		</div>
	</div>
</div>
<?php unset($_SESSION["err_msg"]);
unset($_SESSION["imgerror"]);
?>