<?php 
//$stuReg = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
//$student_name= $stuReg->name. " ". $stuReg->othername;
//$reg_no=$stuReg->reg_no;
//$portal_id=  $stuReg->portal_id;

//$programme = $stuReg->programme;
//$programme_type_name = $stuReg->prog_type;
//$student_type = $this->db->query("select *  from student_type where student_type_name='$programme'")->row();
//$student_type_id=$student_type->student_type_id;

//$programme_type = $this->db->query("select *  from programme_type where programme_type_name='$programme_type_name'")->row();
//$programme_type_id=$programme_type->programme_type_id;


$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");
$student_type = $this->db->query("select *  from student_type order by student_type_name");

$semester1 = $this->db->query("select *  from course_semester");

$session =  $this->db->query("select *  from course_session");
//$levels =    $this->db->query("select *  from course_year_of_study where student_type_id='$student_type_id' and programme_type_id='$programme_type_id'");



?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Course Registration Approval";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_view_student_coursereg' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Approve Student Registered  Courses !</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p><div style="width:100%; height:100%" align="center">
                        <p align="left">Matric / Reg No:
                        <input name="regno" type="text" id="regno" style="width:250px; height:25px;"></p>
                        
                            <p align="left">
                      Programme
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
                     Progamme Type
                       <span  id="programmetypes">
                       <select  name="programme_type_id" id="programme_type_id" class="form-select required" onChange="javascript: populateLevels(this.value,programme.value);"><option value="" selected="selected" >- Select Programme Type -</option>
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
                      Level
                       <span id="levels">
                       <select  name="level" id="level" class="form-select required"><option value="" selected="selected" >- Select Level -</option>

 </select>
                    </span>  </p>
                      
                      <p align="left">
                      
                      Semester:  <select  name="semester" id="semester" class="form-select required"><option value="" selected="selected" >- Select Semester -</option><?php foreach($semester1->result() as $row){ ?>
                         
                      
<option value ="<?php echo $row->semester_id;?>"> <?php echo $row->semester_name;?> </option>                  <?php }?></select>
                      
                      </p>
                       <p align="left">
                       
                      Session:  <select name="session" id="session" class="form-select required"><option value="" selected="selected" >- Select Session -</option><?php foreach($session->result() as $row){ ?>
                         
                      
<option value ="<?php echo "$row->session_id";?>"> <?php echo "$row->sessionn_name";?> </option>

                  <?php }?>
                      </select>
                      </p>
                    
                      
                </div><p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span></p>
           
               
                
                
              </p>
              
             <p align="left"><br>
                        <input type="submit" name="submit" id="submit" value="  Proceed   " height="35px">
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

