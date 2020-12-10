<?php 
$student_exist = $this->db->get_where('student', array("portal_id" => $admlist_details->application_no))->row();
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

					<?php echo "Assign Medical Facility ";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/save_assign_medical_facility/<?php echo $admlist_details->id;?>' onsubmit="" >
	<p>
		<div class="col-md-12 no-p receipt-image-div">

								<img src="<?php echo 'uploads/student_image/' . $student_exist->student_id. '.jpg'; ?>" width="150px" height="150px" />

							</div>
	</p>
	<p align="left">
	

									Application No: <?php echo $admlist_details->application_no; ?></p><br/>
									
									
                                
<p align="left">
							Fullname: <?php  echo $admlist_details->surname; ?> <?php  echo $admlist_details->firstname; ?> <?php  echo $admlist_details->middlename; ?>


							
</p><br/>
<p align="left">
Programme: <?php echo $prog; ?></p><br/>
			 
    <p align="left">
                      Medical Facility
                       <span id="level">
       <select  name="facility" id="facility" >
	   <?php if($admlist_details->programme_type_id=='2' || $admlist_details->programme_type_id=='3' || $admlist_details->programme_type_id=='5' || $admlist_details->programme_type_id=='6')
	   {?>
	<option value="Arubah X-Ray">Arubah X-Ray</option>
	   <?php } else {?>
	   <option value=""  onChange="">- Select Facility-</option>


 <option value="FPN Medical Center">FPN Medical Center</option>
  <option value="Amara Diagnostic Center">Amara Diagnostic Center</option>
	   <?php }?>
 </select>
                    </span>  </p>
                                        
  
				
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="Assign Details" class="btn btn-primary"  >
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



