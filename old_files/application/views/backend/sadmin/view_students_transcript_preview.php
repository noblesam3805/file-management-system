<?php 
$stuReg = $this->db->get_where('student', array("reg_no" => $regno))->row();
if($stuReg)
{
$student_id=$stuReg->student_id ;
$student_name= $stuReg->name. " ". $stuReg->othername;
$reg_no=$stuReg->reg_no;
$portal_id=  $stuReg->portal_id;
$programme_type_name = $stuReg->prog_type;
$programme = $stuReg->programme;
$student_type = $this->db->query("select *  from student_type where student_type_name='$programme'")->row();
$student_type_id=$student_type->student_type_id;


$programme_type = $this->db->query("select *  from programme_type where programme_type_name='$programme_type_name'")->row();
$programme_type_id=$programme_type->programme_type_id;

$deptname =$stuReg->dept;
if($student_type_id=="1")
{
$dept_id =$this->db->get_where('department', array("deptName" => $stuReg->dept))->row();
$deptid=$dept_id->deptID;
}
else
{
$dept_id =$this->db->get_where('department', array("deptName" => $stuReg->dept))->row();
$deptid=$dept_id->deptID;
}


$school = $stuReg->school;
$schoolid = $this->db->query("select *  from schools where schoolname='$school'")->row();
$school_id=$schoolid->schoolid;
}
?>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Students Transcript";?>

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
			
			<h3>View Students Transcript!</h3>
			<hr />
	
			<div style="margin-left:40px">
			  <p> <div style="width:100%; height:100%" align="center">
                  <form id="imageform" name="imageform" method="post"  action='index.php?sadmin/process_view_students_transcript' >
                  
                      
                       <p align="left">
                        <span style=" padding-right:30px;" >  Matric Number:
                        <?php  echo $regno;?>
                        </span></p>
                        <?php
						//$stuReg = $this->db->get_where('student', array("reg_no" => $regno))->row();
if($stuReg)
{
            ?>           <p align="left">Students Name:
                         <?php  echo $student_name;?>
                       </p>
                       <p align="left">Programme:
                         <?php  echo $programme;?>
                       </p>
                       <p align="left"> School: <?php echo $school;?> </p>
                       <p align="left"> Department: <?php echo $deptname;?> </p>
                       <p align="left"> Programme Type: <?php echo $programme_type_name;?></p>
                       <?php } else {?><p align="left"><?php echo 'Student Profile Not Available. ';?> <a href="<?php echo base_url().'index.php?student_registration/pre_registration';?>" target="_blank">Click Here to Create Profile</a></p><?php }?>
                       <p align="left">&nbsp;</p>
                       
                      <p align="left">  
                       <table width="200" border="0" cellpadding="5" cellspacing="5" align="left"></table>
                         <tr>
                           <td><h2>AVailable Sessional Transcript Results: </h2><br /></td>
                          </tr>
                           <?php foreach($tsessions->result() as $row)
						   {?>
                            <tr>
                           <td><h4>View <a href="<?php echo base_url().'index.php?sadmin/display_transcript/'.$row->session;?>" target="_blank"> <?php echo $row->session;?></a></h4><br /></td>
                          </tr>
                          <?php }?>
                           <td><h4><a href="<?php echo base_url().'index.php?sadmin/display_result_statement';?>" target="_blank">View Statement of Result</a></h4><br /></td>
                          </tr>
                       </table>
                   
                       </p>
                  </form>
                  
                </div>
				<div id='preview'></div>&nbsp;</p>
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

<?php if(isset($_SESSION["error"]))
{
	unset( $_SESSION["error"]);
}?>

