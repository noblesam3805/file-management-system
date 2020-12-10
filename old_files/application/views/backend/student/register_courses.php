<?php 


$stuReg = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$student_name= $stuReg->name. " ". $stuReg->othername;
$reg_no=$stuReg->reg_no;
$portal_id=  $stuReg->portal_id;

$programme = $stuReg->programme;
$programme_type_id = $stuReg->prog_type;

$student_type = $this->db->query("select *  from student_type where student_type_id='$programme'")->row();
$student_type_name=$student_type->student_type_name;

$programme_type = $this->db->query("select *  from programme_type where programme_type_id='$programme_type_id'")->row();
$programme_type_name=$programme_type->programme_type_name;

$student_type_id=$programme;
$status = $this->db->query("select status from course_status")->row();
if($status->status=="off" ){
$_SESSION["error"]="Sorry Course Registration Has Ended for this session!";	
}

$dept =$stuReg->dept;

$dept_id =$this->db->get_where('department', array("deptID" => $dept))->row();
$deptname=$dept_id->deptName;

$deptid=$dept_id->deptID;

$deptsoptions=$stuReg->dept_option;
if($deptsoptions=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$deptsoptions."'")->row()->dept_option_name;
}

$schoolid = $stuReg->school;
$schools = $this->db->query("select *  from schools where schoolid='$schoolid'")->row();
$school_id=$schools->schoolid;
$school=$schools->schoolname;


$semester1 = $this->db->query("select *  from course_semester");

$session =  $this->db->query("select *  from course_session where activated='1'");
$levels =    $this->db->query("select *  from course_year_of_study where student_type_id='$student_type_id' and programme_type_id='$programme_type_id'");

//$status = $this->db->query("select* from medical_screening where regno='$reg_no'")->row();
//if(!$status){
//$_SESSION["error"]="Sorry You have not yet done your Medicals!";	
//}

$data = array(
   
   'student_id'=> $this->session->userdata('student_id'),
   'payment_session'=> '2019/2020',
   'payment_fee_type'=> '2'
   );
  

   
    $detailsexit = $this->db->get_where('eduportal_fees_payment_log',$data);
	if($detailsexit->num_rows() <= 0)
	{
		$_SESSION["error"]="Sorry You have not yet Pay your school Fee for this session!";
	}
?> 
<p style="font-size:13px; color:#9d0000;"><?php if($_SESSION['err_msg']){echo $_SESSION['err_msg'];} ?></p>
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

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?student/ajax_verify_pin_coursereg' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Register Semster Courses ! </h3> <span style="color:#FF0000; font-size:18px"></span>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center">
				  <p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span></p>
                  <?php
                  	
					if(!$detailsexit){
$_SESSION["error"]="Sorry You have not yet made School Fee Payment For this session!";	
}
					else{
                  ?>
                      <p align="left">
                      Full Name: <?php  echo $student_name;?>
                      </p>
                      <p align="left">
                      Matric No: <?php  echo $reg_no;?>
                      </p>
                       <p align="left">
                      Portal ID: <?php  echo $portal_id;?>
                      </p>
                      <p align="left">
                      Programme: <?php  echo $student_type_name;?>
                      </p>
                      
                          <p align="left">
                      School/Faculty: <?php echo $school;?>

                      </p>
                      
                       <p align="left">
                      Department: <?php echo $deptname;?>
                     </p>
					  <p align="left">
                      Department Option: <?php echo $deptopt;?>
                     </p>
                     
                      <p align="left">
                      Programme Type: <?php echo $programme_type_name;?>
                     </p>
                      
                       <p align="left">
                      Level:
                      <select  name="level" id="level" class="form-select required"><option value="" selected="selected" >- Select Level -</option>
				
					  <?php foreach($levels->result() as $row){ ?>
                        
                      
<option value ="<?php echo $row->year_of_study_id;?>"> <?php echo $row->year_of_study_name;?> </option>

                  <?php }?> </select></p>
                      
                      <p align="left">
                      
                      Semester:  <select  name="semester" id="semester" class="form-select required"><option value="" selected="selected" >- Select Semester -</option><?php foreach($semester1->result() as $row){ ?>
                         
                      
<option value ="<?php echo $row->semester_id;?>"> <?php echo $row->semester_name;?> </option>                  <?php }?></select>
                      
                      </p>
                       <p align="left">
                       
                      Session:  <select name="session" id="session" class="form-select required"><option value="" selected="selected" >- Select Session -</option><?php foreach($session->result() as $row){ ?>
                         
                      
<option value ="<?php echo "$row->sessionn_name";?>"> <?php echo "$row->sessionn_name";?> </option>

                  <?php }?>
                      </select>
                      </p>
                     
                      
                </div>
           
                <input type="hidden" name="school"  value="<?php echo $school_id;?>"/>
                <input type="hidden" name="programme" value="<?php echo $student_type_id;?>"/>
                <input type="hidden" name="depts" value="<?php echo $deptid;?>"/>
				<input type="hidden" name="deptsoptions" value="<?php echo $deptsoptions;?>"/>
                <input type="hidden" name="studentid"  value="<?php echo $stuReg->student_id;?>"/>
                <input type="hidden" name="portal_id"  value="<?php echo $portal_id;?>"/>
                 <input type="hidden" name="programme_type_id" value="<?php echo $programme_type_id;?>"/>
                
                
              </p>
              
             <p align="left"><br>
                        <input type="submit" name="submit" id="submit" value="  Proceed   " height="35px">
                      </p>
                 <?php } ?> 
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

