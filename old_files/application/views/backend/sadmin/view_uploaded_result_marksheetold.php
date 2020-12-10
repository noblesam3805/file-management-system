<?php

$dept_id = $course_assigned_details->department_id;
$course_type_id = $course_assigned_details->course_type_id;

$dept = $this->db->query("select *  from department where deptID='$dept_id'")->row();
$school = $this->db->query("select *  from schools where schoolid='".$dept->schoolid."'")->row();
$course_type = $this->db->query("select *  from course_type where course_type_id='$course_type_id'")->row();
$deptsoptions=$course_assigned_details->dept_option_id;
if($deptsoptions=="0")
{
	$deptopt="NONE";
}
else
{
$deptopt = $this->db->query("select *  from dept_options where dept_option_id='".$deptsoptions."'")->row()->dept_option_name;
}
function getGrade($score)
{
	if($score>=0 && $score<=9)
		{
			return "F";
		}
	if($score>=10 && $score<=19)
		{
			return "E";
		}
	if($score>=20 && $score<=29)
		{
			return "D";
		}
		if($score>=30 && $score<=39)
		{
			return "CD";
		}
		if($score>=40 && $score<=49)
		{
			return "C";
		}
		if($score>=50 && $score<=59)
		{
			return "BC";
		}
		if($score>=60 && $score<=69)
		{
			return "B";
		}
		if($score>=70 && $score<=79)
		{
			return "AB";
		}
		if($score>=80 && $score<=100)
		{
			return "A";
		}
		if($score==111)
		{
			return "A";
		}
			
}

function getRemark($score)
{
	if($score>=0 && $score<=9)
		{
			return "WORTHLESS";
		}
	if($score>=10 && $score<=19)
		{
			return "FAIL";
		}
	if($score>=20 && $score<=29)
		{
			return "FAIL";
		}
		if($score>=30 && $score<=39)
		{
			return "FAIL";
		}
		if($score>=40 && $score<=49)
		{
			return "PASS";
		}
		if($score>=50 && $score<=59)
		{
			return "FAIRLY GOOD";
		}
		if($score>=60 && $score<=69)
		{
			return "GOOD";
		}
		if($score>=70 && $score<=79)
		{
			return "VERY GOOD";
		}
		if($score>=80 && $score<=100)
		{
			return "EXCELLENT";
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
<div class="print_page" style="width:1100px; border:0px;">
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;border:0px;">
				<div class="col-md-12 receipt-head" style="margin-top:10px;">
					<img src="images/neklogo.png"  />
					<p align="center"><h3><B>FEDERAL POLYTECHNIC NEKEDE, OWERRI</B></h3></p>
					<p align="center">OFFICIAL GRADE REPORT AND CLASS ROSTER											
</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
						  <hr />
						</div>
					  <div class="col-md-12 print-table">
						  <table width="120%" border="0" align="center" cellpadding="0" cellspacing="10" class="formtxt">
						    <!--DWLayoutTable-->
						    <tr>
						      <td width="13%" height="27"><span class="style65">SCHOOL: </span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $school->schoolname; ?>
						      </span></td>
						      <td width="17%"><span class="style65">DEPARTMENT: </span></td>
						      <td width="31%" ><span class="style65">
						        <?php  echo $dept->deptName; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="21"><span class="style65">
						        <label for="lname2">PROGRAMME:</label>
						        </span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->prog; ?>
						      </span></td>
						      <td width="17%" class="style65">PROGRAMME TYPE:</td>
						      <td width="31%" ><span class="style65">
						       <?php  echo $course_assigned_details->prog_type; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="20"><span class="style65">
						        <label for="dept2">SESSION:</label></span></td>
						      <td width="39%"><span class="style65">
						        <?php  echo $_SESSION["ses"]; ?>
						      </span></td>
						      <td width="17%" class="style65">YEAR OF STUDY:</td>
						      <td width="31%" ><span class="style65">
						        <?php  echo $course_assigned_details->level_of_study; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65"><span class="style65">
						        <label for="falc2">SEMESTER:</label>
                              </span></td>
						      <td><span class="style65">
						        <?php  echo $course_assigned_details->sem; ?>
						      </span></td>
						      <td class="style65">COURSE CODE:</td>
						      <td valign="top"><span class="style65">
						        <?php  echo $course_assigned_details->c_code; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19" class="style65">COURSE TITLE:</td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->c_title; ?>
						      </span></td>
						      <td width="17%" class="style65">COURSE TYPE:</td>
						      <td width="31%" valign="top"><span class="style65">
						        <?php  echo $course_type->course_type_name; ?>
						      </span></td>
					        </tr>
                            <tr>
						      <td height="19" class="style65">CREDIT HOURS:</td>
						      <td width="39%"><span class="style65">
						        <?php  echo $course_assigned_details->course_unit; ?>
						      </span></td>
						      <td width="17%" class="style65">DEPARTMENT OPTION</td>
						      <td width="31%" valign="top"><span class="style65">
						     <?php echo $deptopt;?>
						      </span></td>
					        </tr>
				        </table>
</div>
					
					<div class="col-md-12 no-p">
						<div class="col-md-12"></div>
						<div class="col-md-12 print-table">
						  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row"> <div id="sales2">
						      <p>&nbsp;</p>
						      <table width="100%"  class="" >
						          <thead>
						            <tr bgcolor="#ffffff"></tr>
						            <tr bgcolor="#ffffff">
						              <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
						              <th width="146"><div align="left" class="style6"><span class="style4">MATRIC NUMBER</span></div></th>
						              <th width="257"><div align="left" class="style6">STUDENTS NAME</div></th>
						              <th width="112"><div align="center" class="style6"><span class="style4">ASS.SCORE</span></div></th>
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
				foreach($result_details->result() as $row)
			  {
						?>
						            <tr  style="border-bottom:1px solid #000;">
						              <td><?php echo $id2;?></td>
						              <td>
						               <?php echo strtoupper($row->REGNO);?> &nbsp;</td>
						              <td><div align="left"><span class="style5">
						              
					                  </span><?php echo strtoupper($row->SURNAME.' '. $row->OTHERNAMES);?></div></td>
						              <td><div align="center"><?php echo $row->ASSCORE;?> </div></td>
						              <td><div align="center"> <?php echo $row->TESTSCORE;?>     </div></td>
						              <td align="center"><div align="center"><?php echo $row->EXAMSCORE;?> 
						              
						                </div></td>
						              <td align="center"><div align="center">
						         <?php echo $row->TOTALSCORE;?> 
						                </div></td>
						              <td align="center"><div align="center"><?php echo getGrade(number_format($row->TOTALSCORE));?>
						               
						                </div></td>
                                        
                                            <td align="center"><div align="center">
						      <?php echo getRemark(number_format($row->TOTALSCORE));?>
						                </div></td>
					                </tr>
                                  <?php 	  $id2 = $id2 +1;
				//$tcu= $tcu +$course_unit2;
				  
				  }?>  
					              </tbody>
						          <?php 
			
				    if($id2<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses Registered!</h3></td></tr>";
				  }
				
				  
				  ?>
					            </table>
						        <p>&nbsp;</p>
					             <p>&nbsp;</p>
						      </div></th>
					        </tr>
						
						
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>
							  <table>
							    <tr>
							  <td colspan="5"><b>Grading System: &nbsp;&nbsp;</b></td>
							 
							  </tr>
							  <tr>
							  <td>Grade &nbsp;&nbsp;</td>
							  <td>Min Score&nbsp;&nbsp;</td>
							  <td>Max Score&nbsp;&nbsp;</td>
							  <td>Points Weight&nbsp;&nbsp;</td>
							   <td>Rating &nbsp;&nbsp;</td>
							  </tr>
							   <tr>
							  <td>A</td>
							  <td>80</td>
							  <td>100</td>
							  <td>4</td>
							   <td>Distinction </td>
							  </tr>
							   <tr>
							  <td>AB</td>
							  <td>70</td>
							  <td>79</td>
							  <td>3.5</td>
							   <td>Very Good </td>
							  </tr>
							   <tr>
							  <td>B</td>
							  <td>60</td>
							  <td>69</td>
							  <td>3</td>
							   <td>Goo</td>
							  </tr>
							   <tr>
							  <td>BC</td>
							  <td>50</td>
							  <td>59</td>
							  <td>2.5</td>
							   <td>Fairly Good</td>
							  </tr>
							  							  





							   <tr>
							  <td>C</td>
							  <td>40</td>
							  <td>49</td>
							  <td>2</td>
							   <td>Pass</td>
							  </tr>
							   <tr>
							  <td>CD</td>
							  <td>30</td>
							  <td>39</td>
							  <td>1.5</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>D</td>
							  <td>20</td>
							  <td>29</td>
							  <td>1</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>E</td>
							  <td>10</td>
							  <td>19</td>
							  <td>0.5</td>
							   <td>Fail</td>
							  </tr>
							   <tr>
							  <td>F</td>
							  <td>0</td>
							  <td>9</td>
							  <td>0</td>
							   <td>Worthless</td>
							  </tr>
							  
							  </table>


</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">Signature of Lecturer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.............................................</th>
						      <th align="left"  class="style27" scope="row">Signature of Head of Department ................................................</th>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
						    <tr class="border">
						      <th width="46%" class="style27" scope="row" align="left">Signature of School Dean &nbsp;   ..............................................</th>
						      <td width="54%">&nbsp;</td>
					        </tr>
                                <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
                                <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
						
					      </table>
					  </div>
					</div>
				
				</div>
			</div>
		</div>
<?php 

?>
