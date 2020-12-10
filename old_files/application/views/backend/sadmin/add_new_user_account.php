<?php 
$school = $this->db->query("select *  from schools order by schoolname");
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
							Fullname: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="name" required="required" class="form-control eduportal-input" placeholder="Enter Fullname" value=""  />
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
                      School
                       <select  name="school" id="school" class="form-control eduportal-input required" style="width: 300px" required  onchange="javascript: populateDepartments(this.value,'1'); ">
					 	 
					   <option value=""  >- Select -</option>
<?php foreach($school->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                       <p align="left">
                      Department
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-select required">
					  
					  <option value=""  onChange="">- Select -</option>

 </select></span></p>
  <p align="left">
                     User Role
                       <span id="levels">
       <select  name="role" id="role" class="form-control eduportal-input required" required style="width: 300px">
	     
	   <option value=""  onChange="">- Select Role-</option>
<?php
if($this->session->userdata('level') == 8)
{
?>
<option value="1">Bursary</option>
<option value="6">Lecturer</option>
<option value="7">Class Adviser</option>

<option value="9">HOD</option>
<option value="10">Exams & Record</option>
<option value="11">Dean</option>
<option value="12">Screening Officer</option>
<option value="13">Medical Officer</option>
<option value="14">ID Card Officer</option>
<option value="15">ICT Staff</option>
<option value="16">MIS Staff</option>
<option value="17">Chief Medical Officer</option>
<option value="18">X-Ray HCP</option>
<option value="19">Admissions Officer</option>
<?php
}
elseif($this->session->userdata('level') == 10)
{?>
 <option value="6">Lecturer</option>
 <option value="9">HOD</option>
<option value="10">Database Staff</option>
<option value="11">Dean</option>
 <?php
}?>
 </select>
                    </span>  </p>
     
				
                      
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



