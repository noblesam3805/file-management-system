<?php 
$school = $this->db->query("select *  from faculty order by faculty_name");
$designation = $this->db->query("select *  from erp_staff_designations order by designation_id");

$states = $this->db->get('states')->result_array();
$countries = $this->db->get('countries')->result_array();
$cadres = $this->db->get('cadres')->result_array();
	//	$schools = $this->db->get('faculty')->result_array();
?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Personell Account";?>

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
			
			
	
		<div class="col-md-12 no-p">
		<div class="col-md-6 no-p">
			
			  <p><div style="width:100%; height:100%" align="center">
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/create_user_account' >
                        
<p align="left">
							Sur-name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Enter surname" value=""  />
									</span>

							
</p>
<p align="left">
							Name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Enter name" value=""  />
									</span>

							
</p>
<p align="left">
							Other-name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name[]" required="required" class="form-control eduportal-input" placeholder="Enter other-name" value=""  />
									</span>

							
</p>
		<p align="left">
	
			Email: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="email" required="required" class="form-control eduportal-input" placeholder="Enter Email" value=""  />
									</span>
									
	</p>
        						
<p align="left">
								<tr>
								  <td>Telephone</td>
								  <td><span class="input-group input-group-lg eduportal-input-group">
								    <input type="text" name="phone"  class="form-control eduportal-input" placeholder="Enter Phone No" value="" />
								  </span></td>
							  </tr>                   
</p>
				 
                      
                          <p align="left">
                      MDA<span class="input-group input-group-lg eduportal-input-group">
                       <select  name="school" id="school" class="form-control eduportal-input required" style="width: 300px" required  onchange="javascript: populateDepartments(this.value,'1'); ">
					 	 
					   <option value=""  >- Select -</option>
<?php foreach($school->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->faculty_id;?>"><?php  echo $row->faculty_name;?></option>
<?php 
	}
	?>
 </select></span>
                      </p>
                      
                       <p align="left">
                      Department <span class="input-group input-group-lg eduportal-input-group">
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 300px">
					  
					  <option value=""  onChange="">- Select -</option>

 </select></span></span>
  <p align="left">
                     User Role <span class="input-group input-group-lg eduportal-input-group">
                       <span id="levels">
       <select  name="role" id="role" class="form-control eduportal-input required" required style="width: 300px">
	     
	   <option value=""  onChange="">- Select Position/Role-</option>
<?php foreach($designation->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->designation_id;?>"><?php  echo $row->designation_name;?></option>
<?php 
	}
	?>
 </select>
                    </span> </span> </p>
					
			
						
							
       <p align="left">
                     Address
              
				<span class="input-group input-group-lg eduportal-input-group"> <textarea type="text" name="address" class="form-control eduportal-input" id="field-1"  style="width: 300px" ></textarea>
           	</span>	     </p>
			<br/>
			 <p align="left"> 
			 Rank on first Appointment
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="rank_on_appointment" id="rank_on_appointment" required class="form-control eduportal-input" />
								
						 </span>	
						 	</p>
                    
                  <p align="left">
				  Salary Step
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="salary_step" required class="form-control eduportal-input" placeholder=""/>
						 </span>	
						 	<p/>
							
					<p align="left">
					Present Rank date
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="present_rank_date" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Present Rank Date"/>
								
						 </span>	
						 	<p/>
							
							
							<p align="left">Publication File
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="file" class="form-control" required name="publicationfile" placeholder="(Publication File)" >

						 </span>	
						 	<p/>
							
							<p align="left">
						 <span class="input-group input-group-lg eduportal-input-group">
						 
						 </span>	
						 	<p/>
                </div>
				 </div>
              	<div class="col-md-6 no-p">
 <p align="left">
                     Title
								
							<span class="input-group input-group-lg eduportal-input-group">	<select name="title" required="" class="form-control eduportal-input required" style="width: 300px">
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
							   	</span>	
						</p>
						
						 <p align="left">
						Sex
										<span class="input-group input-group-lg eduportal-input-group"><select name="sex" required class="form-control eduportal-input" style="width: 300px">
										<option value="">Select An Option</option>
										<option value="Male">MALE</option>
										<option value="Female">FEMALE</option>
									</select>
						 	<p/>
						
						 <p align="left">
						 Date of Birth
							<span class="input-group input-group-lg eduportal-input-group">
									<input type="text" name="dob" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of Birth" style="width: 300px"/>
								</span>	
						 	<p/>
							
						 <p align="left">
						 File No
							<span class="input-group input-group-lg eduportal-input-group"> <input type="text" name="fileno" required class="form-control eduportal-input" placeholder="File Number" value="" style="width: 300px"/>
						 	</span>		<p/>
					 <p align="left">
						 <span class="input-group input-group-lg eduportal-input-group">
						 
						 </span>	
						 	<p/>
						
 <p align="left">
						 <span class="input-group input-group-lg eduportal-input-group" style="width: 300px"> State
						 <select name="state" id="states" required class="form-control eduportal-input" onChange="populateLGA(this.value);">
										<option value="">Select An Option</option>
										<?php
											foreach($states as $state => $val): ?>
												<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
											<?php endforeach;
										?>
									</select>
						 </span>	
						 	<p/>
 <p align="left">LGA
						 <span class="input-group input-group-lg eduportal-input-group" style="width: 300px" >
						<select name="lga" id="lga" required class="form-control eduportal-input" id="lga">
										<option value="">Select An Option</option>
                                    
									</select> 
						 </span>	
						 	<p/>
							 <p align="left">
						 <span class="input-group input-group-lg eduportal-input-group" 
						 style="width: 300px"> Employment type
						 <select name="employment_type" id="states" required class="form-control eduportal-input">
										<option value="Civil servant">Civil servant</option>
										<option value="Public servant">Public servant</option>
									</select>
						 </span>	
						 	<p/>

							 <p align="left">
						 <span class="input-group input-group-lg eduportal-input-group" style="width: 300px"> Cadre
						 <select name="cadre" id="" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<?php
											foreach($cadres as $cadre => $val): ?>
												<option value="<?php echo $val['ID']; ?>"><?php echo $val['Name']; ?></option>
											<?php endforeach;
										?>
									</select>
						 </span>	
						 	<p/>
							 
 <p align="left">Date of First Employment
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="date_first_employment" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Date Of First Appointment"/>
					
						 </span>	
						 	<p/>
 <p align="left">Salary Grade Level
						 <span class="input-group input-group-lg eduportal-input-group">
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
						 </span>	
						 	</p>
 <p align="left">
 Present rank
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="present_rank" required class="form-control eduportal-input" placeholder=""/>
						 </span>	
						 	<p/>
<p align="left">Entry Qualifications
						 <span class="input-group input-group-lg eduportal-input-group">
						 <input type="text" name="entry_qualification" required class="form-control eduportal-input" placeholder="Entry Qualification With Date"/>
						 </span>	
						 	<p/>

<p align="left">Publications
						 <span class="input-group input-group-lg eduportal-input-group">
						  <input type="text" name="publications"  required="required" class="form-control eduportal-input datepicker" data-start-view="2" placeholder="(Publication Date)"/>
						 </span>	
						 	<p/>


<p align="left">
						 <span class="input-group input-group-lg eduportal-input-group">
						
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
						 </span>	
						 	<p/>

							
					 <p align="left">
						 
						 	<p/>
					 

                 	
						 
				</div>
				
                </div>
				<br/>	<br/>	<br/>
				 <p align="left" style="margin-left: 25px;">
                        <input type="submit" style="margin-top:0" name="view" id="view" value="Create Account" class="btn btn-primary"  >
                      </p>
				<div id='preview'>
				          
				</div>&nbsp;</p>
				 </form>	
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

</div>



