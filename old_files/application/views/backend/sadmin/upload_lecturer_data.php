<?php $school = $this->db->query("select *  from schools order by schoolname");

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

					<?php echo "Manage Lecturers Record";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/ajax_upload_lecturer_list' onsubmit="" >
                     
                      
                        <p align="left">
                      School
                       <select  name="school" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,1); "><option value="" selected="selected" >- Select -</option>
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
 

                    
          
   
                                        
                     
                      
                    
					   <p>
                        <input type="file" id="photoimglecturer" name="photoimglecturer" style="width: 228px" class="form-control eduportal-input required" />
                      </p>
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="View Lecturer Record" class="btn btn-primary" onclick=" return false;" >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
				<div id='preview'>
				          <table width="943"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
    
         
 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">SURNAME</span></div></th>
  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FIRSTNAME</span></div></th>
   <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MIDDLENAME</span></div></th>
	
           <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">DEPARTMENT</span></div></th>
            <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">FACULTY</span></div></th>
			 <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">EMAIL</span></div></th>
			  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">MOBILE NO</span></div></th>
		
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



