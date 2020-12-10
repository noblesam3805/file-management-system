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

					<?php echo "View All Departments";?>

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
                  <!-- <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/ajax_procees_view_student_database' onsubmit="" >
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
                       <?php 
					   foreach($programme_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->programme_type_id;?>"><?php  echo $row->programme_type_name;?></option>
<?php 
	}
	?>

 </select>
                    </span>  </p>
                    
          
     
                     
                      
                    
					  
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="View Students Record" class="btn btn-primary"  >
                      </p>
                  </form> -->
                  
                </div>
				
                  
                </div>
				<div id='preview'>
				          <table width="943" align="center"  class="" style="margin-top:50px">
      <thead style="margin-bottom:50px;">
        <tr bgcolor="#FFFFFF">
          
    
          <th width="61"><div align="left" class="style6"><span class="style4" style="color:#000">Ministry Name</span></div></th>
          <th width="61"><div align="left" ><span  style="color:#000">Department Name</span></div></th>
 <th width="61" align=""><div align="" class="style6"><span class="style4" style="color:#000">Department Code</span></div></th>		
 <th width="61" align=""><div align="" class="style6"><span class="style4" style="color:#000">Action</span></div></th>		

        </tr>
      </thead>
      <tbody>
      <?php foreach($departments as $department){ ?>
      <tr>
      
      <td><?php echo $department['faculty_name']; ?></td>
      <td><?php echo $department['deptName']; ?></td>
      <td><?php echo $department['dept_code']; ?></td>
      <td><button
       data-toggle="modal" data-target="#<?php echo $department['deptID']; ?>"
       class="btn btn-warning" style="margin-top:10px">Edit</button>
      <a href="index.php?sadmin/d_dept/<?php echo $department['deptID']; ?>" class="btn btn-danger" style="margin-top:10px">Delete</a>
      </td>
      </tr>
      <!-- Modal -->
<div id="<?php echo $department['deptID']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Selected Department</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="index.php?sadmin/u_dept/<?php echo $department['deptID']; ?>">
            <label > Change Department Name</label>
            <input type="text" class="form-control" value="<?php echo $department['deptName']; ?>" name="dept" placeholder="<?php echo $department['deptname']; ?>">
            <label style="margin-top:10px"> Ministry </label>
            <select class="form-control" name="ministry">
                <option value="<?php echo $department['faculty_id'] ?>"><?php echo $department['faculty_name']; ?></option>
                <?php foreach($faculties as $faculty){?>
                    <option value="<?php echo $faculty['faculty_id'] ?>"><?php echo $faculty['faculty_name'] ?></option>
                <?php } ?>
            </select>
            <label style="margin-top:10px"> Department Code</label>
            <input type="text" class="form-control" value="<?php echo $department['dept_code']; ?>" name="dept_code" placeholder="<?php echo $department['dept_code']; ?>">
            <input style="margin-top:15px" type="submit" class="btn btn-primary" value="Update">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
      <?php }?>
      
      </tbody>
	  </table >
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



