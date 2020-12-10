<?php 
$schools = $this->db->query("select *  from faculty order by faculty_name");
$dept = $this->db->query("select *  from department where deptID='$account_details->dept_id'")->row();
$cadres = $this->db->get('cadres')->result_array();
$school = $this->db->query("select *  from faculty where faculty_id='$account_details->unit_sch_id'")->row();
$designations = $this->db->query("select *  from erp_staff_designations order by designation_id");
$designation = $this->db->query("select *  from erp_staff_designations where designation_id='$account_details->desig_id'")->row();
?>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage User Account";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END-->
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			
	
			<div style="margin-left:30px">
			
			  <p><div style="width:100%; height:100%; margin-left:20%; margin-top:5%" align="center">
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/process_edituseraccount/<?php echo $account_id;?>' onsubmit="" >
	<p align="left">
	
			Email: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="email" required="required" readonly class="form-control eduportal-input" 
									  style="width: 500px" placeholder="email" value="<?php  echo $account_details->email; ?>"  />
									</span>
									
	</p>
                                
<p align="left">
							Surname: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Fullname" 
									  style="width: 500px" value="<?php  $name = explode(',',$account_details->name);
									  print_r($name[0]) ?>"  />
									</span>

							
</p>
<p align="left">
							Name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Fullname" 
									  style="width: 500px" value="<?php  
									  $name = explode(',',$account_details->name);
									  print_r($name[1]) ?>"  />
									  
									</span>

							
</p>
<p align="left">
							Other-name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Fullname" 
									  style="width: 500px" value="<?php  $name = explode(',',$account_details->name);
									  print_r($name[2]) ?>"  />
									</span>

							
</p>
<p align="left">
Active Status:
			 <span id="dept">
			 
			  <select  name="active_status" class="form-control eduportal-input" style="width: 500px">
			  
			   <option value="<?php  echo $account_details->active_status; ?>"><?php  echo $account_details->active_status; ?></option>
			   <option value="SICK PERMISSION">SICK PERMISSION</option>
			   <option value="RETIRED">RETIRED</option>
			   <option value="ANNUAL LEAVE">ANNUAL LEAVE</option>
			   <option value="DISCIPLINARY ACTION">DISCIPLINARY ACTION</option>
			 

</select></span></p>
							
	<p align="left">
								<tr>
								  <td>Telephone</td>
								  <td><span class="input-group input-group-lg eduportal-input-group">
								    <input type="text" name="phone"  class="form-control eduportal-input" style="width: 500px" placeholder="Enter Phone No" value="<?php  echo $account_details->phone; ?>" />
								  </span></td>
							  </tr>                   
</p>

<p align="left">
								<tr>
								  <td>Password</td>
								  <td><span class="input-group input-group-lg eduportal-input-group">
								   <?php  echo $account_details->password; ?>
								  </span></td>
							  </tr>                   
</p>

  <p align="left">
                      MDA
                       <select  name="school" id="school" class="form-control eduportal-input required" style="width: 500px" required  onchange="javascript: populateDepartments(this.value,'1'); ">

						 <option value="<?php					 	
						echo $school->faculty_id;
						?>" ><?php					 	
						echo $school->faculty_name;
						?></option>
					   <option value=""  >- Select -</option>
<?php foreach($schools->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->faculty_id;?>"><?php  echo $row->faculty_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                       <p align="left">
                      Department
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 500px">
					   <option value="<?php					 	
						echo $dept->deptID;
						?>" ><?php					 	
						echo $dept->deptName;
						?></option>
					 

 </select></span></p>
  <p align="left">
                     User Role
                       <span id="levels">
       <select  name="role" id="role" class="form-control eduportal-input required" required style="width: 500px">
	     
  <option value="<?php	
											 	
						echo $account_details->level;
						?>" ><?php					 	
					
							echo $designation->designation_name;
							
						?></option>
<?php foreach($designations->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->designation_id;?>"><?php  echo $row->designation_name;?></option>
<?php 
	}
	?>
 </select>
                    </span>  </p>			  
				
                          <p align="left">
                     Address
                       <span id="levels">
				 <textarea type="text" name="address" class="form-control eduportal-input" id="field-1"  style="width: 500px" ><?php	
											 	
						echo $account_details->address;
						?></textarea>
                      </span>  </p>
					  






					  <p align="left">
	
					  Rank on first Appointment: 
<span class="input-group input-group-lg eduportal-input-group">
							  <input type="text" name="r_o_f_appointment" required="required" class="form-control eduportal-input"
							  style="width: 500px" placeholder="email" value="<?php  echo $account_details->r_o_f_appointment; ?>"  />
							</span>
							
</p>
						
<p align="left">
Salary Step: 
<span class="input-group input-group-lg eduportal-input-group">
							  <input type="text" name="salary_step" required="required"
							   class="form-control eduportal-input" style="width: 500px" placeholder="Fullname"
							    value="<?php  echo $account_details->salary_step; ?>"  />
							</span>

					
</p>
					
<p align="left">
						<tr>
						  <td>Present Rank date: </td> 
						  <td><span class="input-group input-group-lg eduportal-input-group">
							<input type="text" name="p_r_date" style="width: 500px" class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Enter Phone No" value="<?php  echo $account_details->p_r_date; ?>" />
						  </span></td>
					  </tr>                   
</p>

<p align="left">
						<tr>
						  <td>Publication File : <a href="<?php echo base_url().'uploads/staff_images/'. $account_details->publication_file; ?>">
						  <?php echo $account_details->publication_file; ?>
						  </a></td>
						  <td><span class="input-group input-group-lg eduportal-input-group">
						   <input type="file" name="publication_file" class="form-control" style="width: 500px">
						   
						   
						  </span></td>
					  </tr>                   
</p>

<p align="left">
Title 	 
<select name="title" class="form-control" style="width:500px">
<option value="<?php  echo $account_details->title; ?>	"><?php  echo $account_details->title; ?></option>
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
			  </p>
			  
			   <p align="left">
			  Sex:
			 <span id="dept">
			 
			  <select  name="sex"  class="form-control eduportal-input" style="width: 500px">
			  
			   <option value="<?php  echo $account_details->sex; ?>"><?php  echo $account_details->sex; ?></option>
			   <option value="male">Male</option>
			   <option value="female">Female</option>
			 

</select></span></p>

<p align="left">
Date of Birth : 
				
			   <span id="levels">
<input type="text" name="dob" style="width:500px;" class="form-control datepicker" data-start-view="2" value="<?php echo $account_details->dob;?>">
			</span>  </p>			  
		
				  <p align="left">
				  File No
			   <span id="levels">
		 <input type="text" name="file_no" class="form-control eduportal-input" id="field-1"  style="width: 500px" value="<?php	echo $account_details->file_no;?>">
			  </span>  </p>

			  <p align="left">

				  State:  <?php $s_name= $this->db->query('select name from states where id =' .$account_details->state)->row();
				   // echo json_encode($s_name[0]);
				  // print_r($s_name[0]);
				    // echo $s_name->name; ?>
			   <span id="levels">
			   <select  name="state" class="form-control eduportal-input" style="width: 500px">
			  
			  <option value="<?php  echo $account_details->state; ?>"><?php echo $s_name->name;?></option>
			  <?php
											foreach($states as $state => $val): ?>
												<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
											<?php endforeach;
										?>		

</select>
			  </span>  </p>
			  <p align="left">
			  LGA:
			 <span id="dept">
			 
			  <select  name="lga" class="form-control eduportal-input" style="width: 500px">
			  <?php $l_name= $this->db->query('select name from lga where id =' .$account_details->lga)->row(); ?>
			  <option value="<?php echo $l_name->name; ?>"> <?php echo $l_name->name; ?></option>
										<?php
											foreach($lgas as $lga => $val): ?>
												<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
											<?php endforeach;
										?>

</select></span></p>
<p align="left">
Cadre:
			 <span id="dept">
			 
			  <select  name="cadre" class="form-control eduportal-input" style="width: 500px">
			  <?php $c_name = $this->db->query('select Name from cadres where ID ='. $account_details->cadre)->row(); ?>
			  <option value="<?php  echo $account_details->cadre; ?>"><?php  echo $c_name->Name; ?></option>
										<?php
											foreach($cadres as $cadre => $val): ?>
												<option value="<?php echo $val['ID']; ?>"><?php echo $val['Name']; ?></option>
											<?php endforeach;
										?>

</select></span></p>
<p align="left">
Employment type:
			 <span id="dept">
			 
			  <select  name="employment_type" class="form-control eduportal-input" style="width: 500px">
			  <option value="<?php  echo $account_details->employment_type; ?>"><?php  echo $account_details->employment_type; ?></option>
			  <option value="Civil servant">Civil servant</option>
			  <option value="Public servant">Public servant</option>

</select></span></p>

<p align="left">
			  Date Of First Employment:
			 <span id="dept">
			  <input type="text"  name="d_o_f_employment" value="<?php  echo $account_details->d_o_f_employment; ?>" class="form-control eduportal-input datepicker" data-start-view="2" style="width: 500px">
			</span></p>
			<p align="left">
			  Salary Grade Level:
			 <span id="dept">
			 
			  <select  name="s_g_level" class="form-control eduportal-input" style="width: 500px">
			  <option value="<?php  echo $account_details->s_g_level; ?>"><?php  echo $account_details->s_g_level; ?></option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
</select></span></p>
<p align="left">
Present rank:
			 <span id="dept">
			  <input type="text"  name="present_rank" value="<?php  echo $account_details->present_rank; ?>" class="form-control eduportal-input" style="width: 500px">
			</span></p>
			<p align="left">
			Entry Qualifications:
			 <span id="dept">
			  <input type="text"  name="entry_qualifications" value="<?php  echo $account_details->entry_qualifications; ?>" class="form-control eduportal-input" style="width: 500px">
			</span></p>
			<p align="left">
			Publications:
			 <span id="dept">
			  <input type="text"  name="publications" value="<?php  echo $account_details->publications; ?>" class="form-control eduportal-input datepicker" data-start-view="2" style="width: 500px">
			</span></p>
			<p align="left">
			Passport:<br>
			 <span id="dept">
			 <img style="width:200px;" src="<?php  echo base_url().'uploads/staff_images/'.$account_details->passport; ?>" />
			  <input type="file"  name="passport" value="<?php  echo $account_details->passport; ?>" class="form-control eduportal-input" style="width: 500px">
			</span></p>
			  
                      <p align="left">
                        <input type="submit" name="view" id="view" value="Update Details" class="btn btn-primary"  >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
				<div id='preview'>
				          
				</div>&nbsp;</p>
			  <p>&nbsp;</p>
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>

	</div>




