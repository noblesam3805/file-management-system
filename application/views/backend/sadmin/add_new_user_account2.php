<?php
$facultyDetails = $this->db->query("select *  from faculty");
$designation=$this->db->get('erp_staff_designations');

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
			
			  <p><div style="width:100%; height:100%" align="center">
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/create_user_account' onsubmit="" >
                        


				 
                      
                          <p align="left">
                      School/Unit
	<select  name="factId" id="factId" class="form-control eduportal-input required" style="width: 300px" onChange="filter_act_depts(this.value); ">
		<option value="" selected="selected" >- Select -</option>
					 	 
					   
<?php foreach($facultyDetails->result() as $row)
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
																						 <span id="dept_area">
			<select  name="dept_code" id="dept" class="form-control eduportal-input required" style="width: 300px" onchange="filter_staff(this.value);" onclick="filter_staff(this.value);">
		<option value="" selected="selected" >- Select -</option>
					 	 

 </select>
																							</span>
                      </p>
													
														<p align="left">
                      Staff
																						 	<span id="staff_area">
			<select  name="sid" id="sid" class="form-control eduportal-input required" style="width:300px">
		<option value="" selected="selected" >- Select -</option>
					 	 

 </select>
																							</span>
                      </p>										
                      
  <p align="left">
                     User Role
                       <span id="levels">
       <select  name="role" id="role" class="form-control eduportal-input required" required style="width: 300px">
	     
	   <option value=""  >- Select Role-</option>
					   
<?php foreach($designation->result() as $row_desig)
	{
		
	?>
 <option value="<?php  echo $row_desig->designation_id;?>"><?php  echo $row_desig->designation_name;?></option>
<?php 
	}
	?>
 </select>
                    </span>  </p>
		
				<p align="left">
	
			Email: 
<span class="input-group input-group-lg eduportal-input-group">
	      <span id="email_area">
									  <input type="text" name="email" required="required" class="form-control eduportal-input" placeholder="Enter Email" value=""  />
								</span>
									</span>
									
	</p>
        						
<p align="left">
								<tr>
								  <td>Telephone</td>
								  <td><span class="input-group input-group-lg eduportal-input-group">
										<span id="phone_area">
								    <input type="text" name="phone_num"  class="form-control eduportal-input" placeholder="Enter Phone No" value="" />
								 </span>
									 </span></td>
							  </tr>                   
</p>
     
				
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="Create Account" class="btn btn-primary"  >
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

</div>



