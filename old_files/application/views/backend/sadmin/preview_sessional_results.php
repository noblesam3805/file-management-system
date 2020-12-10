<?php 
$school1 = $this->db->query("select *  from schools where schoolid='$school'");
$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'");
foreach($student_type->result() as $row1)
{

if($row1->student_type_id=="1")
{
	$dept = $this->db->query("select *  from department where deptID='$department'");
}
else
{
	$dept = $this->db->query("select *  from putme_nce_dept where deptID='$department'");
}


}

//$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");
//$programme_type_id = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'");
$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type'");
//$courses = $this->db->query("select *  from eduportal_courses order by course_code");
//$session =  $this->db->query("select *  from course_session where session_id='$session'");
$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level'");
$course_types =    $this->db->query("select *  from course_type ");
$credit_units =    $this->db->query("select *  from course_unit");
?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Courses";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/view_uploaded_sessional_results_marksheet' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Results Uploaded!</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center">
                  
                      <p align="left">
                      Programme: <?php  foreach($student_type->result() as $row) 
	{echo $row->student_type_name;}?>
                      </p>
                      
                          <p align="left">
                      School: <?php foreach($school1->result() as $row){ echo $row->schoolname;}?>

                      </p>
                      
                       <p align="left">
                      Department: <?php foreach($dept->result() as $row){ echo $row->deptName;}?>
                     </p>
                     
                        <p align="left">Programme Type:
                      <?php foreach($programme_type->result() as $row){ echo $row->programme_type_name;}?>
                         </p>
                      
                       <p align="left">
                      Level:
                      <?php foreach($levels->result() as $row){ echo $row->year_of_study_name;}?>
                         </p>
                       
                  
                      
                      <p align="left">
                      Semester: <?php echo $semester;?>
                      
                      </p>
                      <p align="left">
                      Session: <?php echo $session;?>
                      
                      </p>
                        <p align="left">
                      Course Title: <?php echo $course_title;?>
                      
                      </p>
                      
                      
                <p></p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span>
                <br />
				<div id='preview'> 
                  
                  <div style=" overflow-y:scroll; height:300px; "></p></p></p></p>
                <table width="100%"  class="" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="28"><div align="left" ><span  style="color:#000">ID</span></div></th>
          <th width="89"><div align="left" class="style6"><span class="style4" style="color:#000">REGNO</span></div></th>
          <th width="204"><div align="left" class="style6"><span class="style4" style="color:#000">STUDENT'S NAME </span></div></th>
          <th width="82"><div align="center" class="style6"><span class="style4" style="color:#000">TEST SCORE</span></div></th>
		  <th width="74" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">EXAMS SCORE</span></div></th>
          
            <th width="73" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">TOTAL</span></div></th>
            <th width="46" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">CU</span></div></th>
            <th width="79" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">C. CODE</span></div></th>
            <th width="148" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">COURSE TITLE</span></div></th>
            <th width="66" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">LEVEL</span></div></th>
            <th width="74" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">ACTION</span></div></th>
           
 
        
        </tr>
      </thead>
    
	  <?php 
	  $id=1;
	foreach($result_data->result() as $row)
{
	

								?>
         <tbody> 
           <tr bgcolor="#E2E2E2">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
              <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             
           </tr>
           <tr>
          <td><div align="left"><span class="style5"><?php echo $id;?></span></div></td>
          <td><div align="left"><span class="style5"><?php echo $row->regno; ?></span></div></td>
           <td><div align="left"><span class="style5"><?php echo $row->students_name; ?></span></div></td>
              <td><div align="left"><span class="style5"><?php echo $row->testscore; ?></span></div></td>
                <td><div align="left"><span class="style5"><?php echo $row->examscore; ?></span></div></td>
                <td><div align="left"><span class="style5"><?php echo $row->totalscore; ?></span></div></td>
                   <td><div align="left"><span class="style5"><?php echo $row->course_unit; ?></span></div></td>
                      <td><div align="center"><span class="style5"><?php echo $row->course_code; ?></span></div></td>
                         <td><div align="center"><span class="style5"><?php echo $row->course_title; ?></span></div></td>
                            <td><div align="center"><span class="style5"><?php echo $row->level; ?></span></div></td>
                               <td><div align="left"><a href="<?php echo base_url().'index.php?sadmin/edit_sessional_results/'.$row->id;?>">Edit Details</a></div></td>  


        </tr></tbody>
				  <?php 
				  $id = $id +1;}?>
</table>

  
</div>
              
              </p><p>
              <p>
              <?php  
			  $userlevel =$this->session->userdata('level');
			  $sadmin_id =$this->session->userdata('sadmin_id');
			  $sadmin_details = $this->db->get_where('sadmin', array('sadmin_id'=> $sadmin_id))->row();
	//		  $sesdata = array(
//                   'school'  => $school,
//                   'programme'     => $programme,
//                   'depts' => $depts,
//				   'levels' => $level,
//				   'modeofentry' => $modeofentry,
//				   'semester' => $semester,
//				   'programme_type_id' => $programme_type_id,
//				   'sadmin_login'=> '1'
//				   
//               );

//$this->session->set_userdata($sesdata);
			 					 
					
			  ?>
              
              <input type="hidden" name="school"  value="<?php echo $school;?>"/>
              <input type="hidden" name="programme" value="<?php echo $programme;?>"/>
              <input type="hidden" name="depts" value="<?php echo $department;?>"/>
              <input type="hidden" name="level" value="<?php echo $level;?>"/>
            
              <input type="hidden" name="semester" value="<?php echo $semester;?>"/>
       
			
			  <input type="hidden" name="prog" value="<?php  foreach($student_type->result() as $row) 
	{echo $row->student_type_name;}?>"/>
			  <input type="hidden" name="departmt" value="<?php  echo $department;?>"/>
			  <input type="hidden" name="level_of_study" value="<?php foreach($levels->result() as $row){ echo $row->year_of_study_name;}?>"/>
			  <input type="hidden" name="sadmin_name" value="<?php echo $sadmin_details->name;?>"/>
			  <input type="hidden" name="prog_type" value=" <?php foreach($programme_type->result() as $row){ echo $row->programme_type_name;}?>"/>
        
			  
              
             <p align="center"><br>
                        <input type="submit" name="submit" id="submit" value="Print Mark Sheet" height="35px">|
                      <a href="<?php echo base_url().'index.php?sadmin/view_sessional_results';?>">Close</a>
                      </p>
                  
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>
 
                  </form>
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

