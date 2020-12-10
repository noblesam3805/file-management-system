<?php 

$styp = $this->db->query("select *  from student_type where student_type_id='".$admlist_details->student_type."'")->row()->student_type_name;
$sch = $this->db->query("select *  from schools where schoolid='".$admlist_details->school_id."'")->row()->schoolname;
$dept = $this->db->query("select *  from department where deptID='".$admlist_details->dept_id."'")->row()->deptName;
if($admlist_details->dept_option_id=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$admlist_details->dept_option_id."'")->row()->dept_option_name;
}

$prog = $this->db->query("select *  from programme_type where programme_type_id='".$admlist_details->programme_type_id."'")->row()->programme_type_name;

$student_type = $this->db->query("select *  from student_type order by student_type_name");

$school = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");
//$semester = $this->db->query("select *  from course_semester order by semester_name");
//$session = $this->db->query("select *  from course_session order by sessionn_name");
$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Admissions List";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/update_admissionlist/<?php echo $adm_list_id;?>' onsubmit="" >
	<p align="left">
	

									Jamb Regno: <p align="left"><?php echo $admlist_details->application_no; ?></p></p>
                                
<p align="left">
							Surname: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="surname" required="required" class="form-control eduportal-input" placeholder="Surname" value="<?php  echo $admlist_details->surname; ?>"  />
									</span>

							
</p>
							<p align="left">	Firstname: 

								<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="firstname" required="required" class="form-control eduportal-input" placeholder="First Name" value="<?php  echo $admlist_details->firstname; ?>"  />
									</span>

								</p>
<p align="left">
								<tr>
								  <td>Middlename</td>
								  <td><span class="input-group input-group-lg eduportal-input-group">
								    <input type="text" name="middlename"  class="form-control eduportal-input" placeholder="Middle Name" value="<?php  echo $admlist_details->middlename; ?>" />
								  </span></td>
							  </tr>                   
</p>
				   <p align="left">
                      Student Type
                        <select name="programme"  id="programme" class="form-select required" onChange="javascript: populateProgrammeTypes(this.value); ">
						 <option value="<?php  echo $admlist_details->student_type;?>" selected="selected"><?php  echo $styp;?></option>
						<option value=""  >- Select -</option>
<?php foreach($student_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->student_type_id;?>"><?php  echo $row->student_type_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                          <p align="left">
                      School
                       <select  name="school" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,programme.value); ">
					 	 <option value="<?php  echo $admlist_details->school_id;?>" selected="selected"><?php  echo $sch;?></option>  
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
					  <option value="<?php  echo $admlist_details->dept_id;?>" selected="selected"><?php  echo $dept;?></option>  
					  <option value=""  onChange="">- Select -</option>

 </select></span></p>
 
 <p align="left">
                      Department Options
                     <span id="deptopts">
                      <select  name="deptsoptions" id="deptsoptions" class="form-select required">
					  <option value="<?php  echo $admlist_details->dept_option_id;?>" selected="selected"><?php  echo $deptopt;?></option>
					  <option value=""  onChange="">- Select -</option>

 </select></span></p>
                      
                     
                    
                     <p align="left">
                     Progamme Type
                       <span  id="programmetypes">
                       <select  name="prog_type" id="prog_type" class="form-select required" ">
					     <option value="<?php  echo $admlist_details->programme_type_id;?>" selected="selected"><?php  echo $prog;?></option>
					   <option value="" >- Select Programme Type -</option>
                       <?php foreach($programme_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->programme_type_id;?>"><?php  echo $row->programme_type_name;?></option>
<?php 
	}
	?>

 </select>
                    </span>  </p>
                    
                      <p align="left">
                      Admission List Batch
                       <span id="levels">
       <select  name="batch" id="batch" class="form-select required">
	        <option value="<?php  echo $admlist_details->admissionlist_batch_id;?>" selected="selected"><?php  echo $admlist_details->admissionlist_batch_id;?></option>
	   <option value=""  onChange="">- Select Batch-</option>

 <option value="1">1</option>


 </select>
                    </span>  </p>
    <p align="left">
                      Admission Type
                       <span id="level">
       <select  name="ltype" id="ltype" >
	  <option value="<?php  echo $admlist_details->adm_type;?>" selected="selected"><?php if($admlist_details->adm_type=="1"){ echo "MERIT";}
	  elseif($admlist_details->adm_type=="2"){ echo "SUPPLEMENTARY";}
	   elseif($admlist_details->adm_type=="3"){ echo "DIRECT ENTRY";}
	  ?></option>  
	   <option value=""  onChange="">- Select Admission Type-</option>

 <option value="1">MERIT</option>
 <option value="2">SUPPLEMENTARY</option>
  <option value="3">DIRECT ENTRY</option>

 </select>
                    </span>  </p>
                                        
                     
                      
                      <p align="left">
                      Session
                       <select  name="session" id="session" class="form-select required">
   <option value="<?php  echo $admlist_details->session;?>" selected="selected"><?php  echo $admlist_details->session;?></option>
 <option value="2018/2019">2018/2019</option>

 </select>
                      </p>
				
                      
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

</div>



