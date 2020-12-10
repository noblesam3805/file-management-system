<?php
$courses = $this->db->query("select *  from eduportal_courses order by course_code");
//$session =  $this->db->query("select *  from course_session where session_id='$session'");

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

					<?php echo "Lecturer Courses/Results Panel";?>

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
			
		<h3>Courses Assigned To Lecturer !</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p>
			  <div style="width:100%; height:100%" align="center">
			
                       
                  
                      
                      <p align="left">
                      Semester: <?php echo $semester;?>
                      
                      </p>
                      
                         <p align="left">
                      Session: <?php echo $session;?>
                      
                      </p>
                      
                   <p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];} ?></p>   
                </div><br />
			  
				<div id='preview'><table width="934"  class="" >
      <thead>
        <tr bgcolor="#ffffff">
          <th width="68"><div align="left" class="style6"><span class="style4">ID</span></div></th>
          <th width="158"><div align="left" class="style6"><span class="style4">LECTURER NAME</span></div></th>
          <th width="132"><div align="left" class="style6"><span class="style4">DEPARTMENT </span></div></th>
          <th width="202"><div align="left" class="style6"><span class="style4">COURSE COURSE </span></div></th>
          <th width="91"><div align="left" class="style6"><span class="style4">CR.HRS</span></div></th>
          <th width="110"><div align="center" class="style6"><span class="style4">CLASS LIST</span></div></th>
		  <th width="141"><div align="center" class="style6">ACTION</div></th>
 
        
        </tr>
      </thead>
    
	  <?php 
	  $id=1;
	  $hod_id=$this->session->userdata('sadmin_id');
	  $hod_dept = $this->db->query("select* from sadmin where sadmin_id='$hod_id'")->row()->dept_id;
	$query =sqlsrv_query($conn,"select lecturer_id, course_assigned_to_dept_id from course_assigned_to_lecturers where lecturer_dept_id = '$hod_dept' and session='$session' and semester='$semester'") or die("1");
	while(list($lect_id,$cid) = sqlsrv_fetch_array($query))
								{
									$lecturer_name = $this->db->query("select* from sadmin where sadmin_id='$lect_id'")->row()->name;
	 $query1 =sqlsrv_query($conn,"select id,course_id,course_unit,course_type_id,departmt from course_assigned_to_department where id='$cid'") or die();
								while(list($id1,$courseid,$course_unit,$course_type_id,$departmt) = sqlsrv_fetch_array($query1))
								{?>
         <tbody> 
           <tr bgcolor="#E2E2E2">
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
          <td><div align="left"><span class="style5"><?php echo $lecturer_name;?></span></div></td>
          <td><div align="left"><span class="style5"><?php echo $departmt;?></span></div></td>
         
          <td><div align="left"><span class="style5">
            <?php $q1=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid'")or die ();
		  
		  while(list($courseid1,$coursecode1,$course_title1)=sqlsrv_fetch_array($q1))
		  {echo  $coursecode1;}?>
            (<?php $q2=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid'")or die ();while(list($courseid2,$coursecode2,$course_title2)=sqlsrv_fetch_array($q2))
		  {echo  $course_title2;}?>)</span></div></td>
		 
          <td><div align="left"><span class="style5"><?php echo $course_unit;?></span></div></td>
      
           <td>
           
           <div align="center"> <a href="<?php echo base_url().'index.php?sadmin/download_registeredcourses_classlist/'.$id1;?>" target="_blank">Download Class List</a><span class="style5" id="courseHint<?php echo $id1;?>"></span><span class="style5" id="courseinput<?php echo $id1;?>" style="display:none;">
     
       </span><span id="commload<?php echo $id1;?>"></span></div>
    <span id="myText<?php echo $id1;?>"></span>
         </div></td>
          <td align="center">
       
            <?php
			$query33 =sqlsrv_query($conn,"select has_result from course_assigned_to_department where id = '$id1'") or die("1");
	while(list($has_result) = sqlsrv_fetch_array($query33))
								{
			 if($has_result==1)
			{
				?>
                
                  <a href="<?php echo base_url().'index.php?sadmin/download_uploaded_results_marksheets/'.$id1;?>"  target="_blank">View/Print Mark Sheet</a>
				     <form id="imageform<?php echo $id1;?>" name="imageform<?php echo $id1;?>" method="post" action='index.php?sadmin/ajax_approve_lecturer_results/<?php echo $id1;?>'. >
                      <p>
                       
                        <input type="hidden" id="cid<?php echo $id1;?>" name="photoimg<?php echo $id1;?>" style="width: 228px" class="" value="<?php echo $id1;?>" />
                        
                        
                        
                      </p>
                      <p>
                        <input type="submit" name="submit<?php echo $id1;?>" id="submit<?php echo $id1;?>" value="Approve Result">
                      </p>
                  </form>
				  <?php
			}
			else
			{?>
            
          <?php }
								}
		  ?>
          </td>
     </tr>
				 </tbody> <?php 
				  $id = $id +1;
		  
				  
								}}
				    if($id<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses have been assigned for this Semester </h3></td></tr>";
				  }
				  ?>
</table></div>&nbsp;</p>
			
         
			 					 
			
              
        
              
            
              </p>
              
             <p align="center"><br>
                       <a href="#">Close</a>
                      </p>
                  
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

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

