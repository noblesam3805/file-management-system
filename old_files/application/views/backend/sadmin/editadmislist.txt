<?php $school = $this->db->query("select *  from schools order by schoolname");
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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/ajax_upload_admissionlist' onsubmit="" >
                      <p align="left">
                      Student Type
                        <select name="programme"  id="programme" class="form-select required" onChange="javascript: populateProgrammeTypes(this.value); "><option value="" selected="selected" >- Select -</option>
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
                       <select  name="school" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,programme.value); "><option value="" selected="selected" >- Select -</option>
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
                      <select  name="depts" id="depts" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
 
 <p align="left">
                      Department Options
                     <span id="deptopts">
                      <select  name="deptsoptions" id="deptsoptions" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
                      
                     
                    
                     <p align="left">
                     Progamme Type
                       <span  id="programmetypes">
                       <select  name="prog_type" id="prog_type" class="form-select required" "><option value="" selected="selected" >- Select Programme Type -</option>
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
	   <option value="" selected="selected" onChange="">- Select Batch-</option>

 <option value="1">1</option>


 </select>
                    </span>  </p>
    <p align="left">
                      Admission Type
                       <span id="level">
       <select  name="ltype" id="ltype" ><option value="" selected="selected" onChange="">- Select Admission Type-</option>

 <option value="1">MERIT</option>
 <option value="2">SUPPLEMENTARY</option>
  <option value="3">DIRECT ENTRY</option>

 </select>
                    </span>  </p>
                                        
                     
                      
                      <p align="left">
                      Session
                       <select  name="session" id="session" class="form-select required"><option value="" selected="selected" onChange="">- Select Session-</option>

 <option value="2018/2019">2018/2019</option>

 </select>
                      </p>
					   <p>
                        <input type="file" id="photoimg" name="photoimg" style="width: 228px" class="form-control eduportal-input required" />
                      </p>
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="View Admissions List" class="btn btn-primary" onclick="viewadmissionslist(); return false;" >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
				<div id='preview'>
				          <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">JAMB NO </span></div></th>
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	
           <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">DEPARTMENT</span></div></th>
            <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FACULTY</span></div></th>
			 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">ADM-TYPE</span></div></th>
             <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">BATCH </span></div></th>
 
                  <th width="113"><div align="center" class="style6"><span class="style4" style="color:#000">SESSION</span></div></th>
        </tr>
      </thead>
	  </table>
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



