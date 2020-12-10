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

function getGrade($score)
{
	if($score>=0 && $score<=39)
		{
			return "F";
		}
		if($score>=40 && $score<=44)
		{
			return "E";
		}
		if($score>=45 && $score<=49)
		{
			return "E";
		}
		if($score>=50 && $score<=59)
		{
			return "C";
		}
		if($score>=60 && $score<=69)
		{
			return "B";
		}
		if($score>=70 && $score<=100)
		{
			return "A";
		}
			
}

function getRemark($score)
{
	if($score<=39)
		{
			return "FAIL";
		}
	else
	{
			return "PASS";
		}
}
?>
<style type="text/css">
<!--
.style59 {font-family: Georgia, "Times New Roman", Times, serif; color: #FFFFFF; }
.style60 {
	font-family: "Arial Unicode MS";
	color: #000000;
}

.style62 {color: #000000}
.style6 {color: #000000; font-size:13px}
.style63 {font-family: "Arial Unicode MS"}
.style64 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style65 {font-size: 14px}
.style66 {
	font-size: 13px;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
	.country-line{
		float:left;
		width:100%;
		padding:5px;
		background:#DEDEDE;
		margin:20px 0 0 10px;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line span{
		color:#CB4A18;
		font-size:19px;
		margin-left:10px;
	}
	.country-line h5{
		margin:5px 0;
	}
</style>
<div class="print_page" style="width:1100px; border:0px;  ">
	<div class="col-md-12" >
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;border:0px;">
				<div class="col-md-12 receipt-head" style="margin-top:10px;">
					<img src="images/alvan-logo.png"  />
					<p align="center">CLASS MARK SHEET</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
						  <hr />
						</div>
					  <div class="col-md-10 print-table">
						  <table width="120%" border="0" align="center" cellpadding="0" cellspacing="10" class="formtxt">
						    <!--DWLayoutTable-->
						    <tr>
						      <td width="13%" height="27"><span class="style65">SCHOOL: </span></td>
						      <td width="39%"><span class="style65">
						        <?php  foreach($school1->result() as $row){ echo $row->schoolname;} ?>
						      </span></td>
						      <td width="17%"><span class="style65">DEPARTMENT: </span></td>
						      <td width="31%" ><span class="style65">
						        <?php  foreach($dept->result() as $row){ echo $row->deptName;} ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="21"><span class="style65">
						        <label for="lname2">PROGRAMME:</label>
						        </span></td>
						      <td width="39%"><span class="style65">
						     <?php foreach($student_type->result() as $row) 
	{echo $row->student_type_name;}?>
						      </span></td>
						      <td width="17%" class="style65">PROGRAMME TYPE:</td>
						      <td width="31%" ><?php foreach($programme_type->result() as $row){ echo $row->programme_type_name;}?></td>
					        </tr>
						    <tr>
						      <td height="20"><span class="style65">
						        <label for="dept2">SESSION:</label></span></td>
						      <td width="39%"><span class="style65">
						       <?php echo $session;?>
						      </span></td>
						      <td width="17%" class="style65">YEAR OF STUDY:</td>
						      <td width="31%" ><?php foreach($levels->result() as $row){ echo $row->year_of_study_name;}?></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65"><span class="style65">
						        <label for="falc2">SEMESTER:</label>
                              </span></td>
						      <td><span class="style65">
						       <?php echo $semester;?>
						      </span></td>
						      <td class="style65">COURSE CODE:</td>
						      <td valign="top"><span class="style65">
						        <?php 
																
								echo $result_data2->course_code; 
?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65">COURSE TITLE:</td>
						      <td width="39%"><?php echo $course_title;?></td>
						      <td width="17%" class="style65">COURSE TYPE:</td>
						      <td width="31%" valign="top"><span class="style65">
						        <?php  
									
								echo $result_data2->course_type; 
?>
						      </span></td>
					        </tr>
                            <tr>
						      <td height="19" class="style65">CREDIT HOURS:</td>
						      <td width="39%"><span class="style65">
						        <?php 
																	
								echo $result_data2->course_unit; 
?>
								
						      </span></td>
						      <td width="17%" class="style65"></td>
						      <td width="31%" valign="top"><span class="style65">
						     
						      </span></td>
					        </tr>
				        </table>
</div>
					
					<div class="col-md-12 no-p">
						<div class="col-md-12"></div>
						<div class="col-md-12 print-table">
						  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row"> <div id="sales2">
						      <p>&nbsp;</p>
						      <table width="100%"  class=""  >
						          <thead>
						            <tr bgcolor="#ffffff"></tr>
						            <tr bgcolor="#ffffff">
						              <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
						              <th width="146"><div align="left" class="style6"><span class="style4">MATRIC NUMBER</span></div></th>
						              <th width="257"><div align="left" class="style6">STUDENTS NAME</div></th>
						           
						              <th width="129"><div align="center" class="style6"><span class="style4">TEST.SCORE</span></div></th>
						              <th width="140"><div align="center" class="style6"><span class="style4">EXAMS SCORE</span></div></th>
						              <th width="154" ><div align="center" class="style6"> TOTAL SCORE</div></th>
						              <th width="112"><div align="center" class="style6">GRADE</div></th>
                                          <th width="112"><div align="center" class="style6">REMARK</div></th>
					                </tr>
				                </thead>
			
						          <tbody>
						            <tr  style="" >
						              <td colspan="9" style="border-bottom:1px solid #000;" ></td>
					                </tr>
                                    			          <?php $id2=1; 
				$tcu = 0;
				foreach($result_data->result() as $row)
			  {
						?>
						            <tr  style="border-bottom:1px solid #000;">
						              <td><?php echo $id2;?></td>
						              <td>
						               <?php echo strtoupper($row->regno);?> &nbsp;</td>
						              <td><div align="left"><span class="style5">
						              
					                  </span><?php echo strtoupper($row->students_name);?></div></td>
						       
						              <td><div align="center"> <?php echo number_format($row->testscore,2);?>     </div></td>
						              <td align="center"><div align="center"><?php echo number_format($row->examscore,2);?> 
						              
						                </div></td>
						              <td align="center"><div align="center">
						         <?php echo number_format($row->totalscore);?> 
						                </div></td>
						              <td align="center"><div align="center"><?php echo getGrade(number_format($row->totalscore));?>
						               
						                </div></td>
                                        
                                            <td align="center"><div align="center">
						      <?php echo getRemark(number_format($row->totalscore));?>
						                </div></td>
					                </tr>
                                  <?php 	  $id2 = $id2 +1;
				//$tcu= $tcu +$course_unit2;
				  
				  }?>  
					              </tbody>
						          <?php 
			
				    if($id2<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Result Details Available!</h3></td></tr>";
				  }
				
				  
				  ?>
					            </table>
						        <p>&nbsp;</p>
						        <p>&nbsp;</p>
						      </div></th>
					        </tr>
						
						 
						  
						
					      </table>
						  <p>&nbsp;</p>
                            <p>&nbsp;</p>
						  <table width="1000" border="0" cellpadding="8" cellspacing="0" align="left" style=" bottom:0px; height:">
						    <tr>
						      <td width="466"><span class="style27">Signature of Lecturer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.............................................</span></td>
						      <td width="534"><span class="style27">Signature of Head of Department ................................................</span></td>
					        </tr>
						    <tr>
						      <td><span class="style27">Signature of Faculty Dean &nbsp;   ..............................................</span></td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>
						  <p>&nbsp;</p>
				      </div>
					</div>
				
				</div>
			</div>
		</div>
<?php 

?>
