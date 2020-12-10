<?php
$stuReg = $this->db->get_where('student', array("reg_no" => $_SESSION["regno"]))->row();
if($stuReg)
{
$student_id=$stuReg->student_id ;
$student_name= $stuReg->name. "  ". $stuReg->othername;
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
//$courses = $this->db->query("select *  from eduportal_courses order by course_code");
//$session =  $this->db->query("select *  from course_session where session_id='$session'");
//$levels =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level'");
//$course_types =    $this->db->query("select *  from course_type ");
//$credit_units =    $this->db->query("select *  from course_unit");
function getGP($score, $cr)
{
	if($score>=0 && $score<=39)
	{
			return 0 * $cr;
		}
		if($score>=40 && $score<=44)
		{
			return 1 * $cr;
		}
		if($score>=45 && $score<=49)
		{
			return 2* $cr;
		}
		if($score>=50 && $score<=59)
		{
			return 3* $cr;
		}
		if($score>=60 && $score<=69)
		{
			return 4* $cr;
		}
		if($score>=70 && $score<=100)
		{
			return 5 * $cr;
		}
			
}
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
function getGradeLevel($cgp)
{
	if($cgp<=5.00 && $cgp>=4.50)
		{
			return "DISTINCTION";
		}
		elseif($cgp<=4.49 && $cgp>=4.00)
		{
			return "CREDIT";
		}
		elseif($cgp<=3.99 && $cgp>=3.50)
		{
			return "MERIT";
		}
		elseif($cgp<=3.49  && $cgp>=3.00)
		{
			return "PASS";
		}
		elseif($cgp<=2.99 && $cgp>=2.50)
		{
			return "WEAK";
		}
		elseif($cgp<=2.49 && $cgp>=2.00)
		{
			return "VERY WEAK";
		}
		elseif($cgp<=1.99 && $cgp>=1.50)
		{
			return "POOR";
		}
		elseif($cgp<1.50)
		{
			return "FAIL";
		}
	
}

?>
<style type="text/css">
<!--
.style59 {font-family: Arial; color: #FFFFFF; }
.style60 {
	font-family: "Arial";
	color: #000000;
}

.style62 {color: #000000}
.style6 {color: #000000; font-size:13px}
.style63 {font-family: "Arial"}
.style64 {
	font-family: Arial;
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
<div class="print_page" style="width:1500px; border:0px;  " align="center">
	<div class="col-md-12" >
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;border:0px;">
			  <div class="col-md-12">
				  <div class="col-md-12 no-p">
					
					
					  <div class="col-md-10 print-table">
						  <table width="130%" border="0" align="center" cellpadding="0" cellspacing="2" class="formtxt">
						    <!--DWLayoutTable-->
						    <tr>
						      <td  colspan="4"><div class="col-md-12 receipt-head" style="margin-top:20px;">
						        <p align="center">ALVAN IKOKU FEDERAL COLLEGE OF EDUCATION OWERRI, NIGERIA.</p>
						        <p align="center">STUDENTS' RECORD CARD<hr /></p>
					          </div>						        <p>&nbsp;</p></td>
					        </tr>
						    <tr>
						      <td height="8" class="style65"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td class="style65"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td class="style65"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td rowspan="6"  valign="top"><table width="94%" border="0" align="right" style="">
						        <tr>
						          <td width="144" align="left">Registration No.</td>
						          <td width="267" align="left"><span style=" padding-right:30px;">
						            <?php  echo $stuReg->reg_no;?>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="left">Date of Admission:</td>
						          <td align="left"><span style=" padding-right:30px;">
						            <?php  echo $stuReg->adm_session;?>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="left">School:</td>
						          <td align="left"><span style=" padding-right:30px;">
						            <?php  echo $stuReg->school;?>
						            </span></td>
					            </tr>
						        <tr>
						          <td  align="left">Department:</td>
						          <td align="left"><span style=" padding-right:30px;">
						            <?php  echo $stuReg->dept;?>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="left">Marital Status:</td>
						          <td align="left"><span style=" padding-right:30px;">
						            <?php  echo $stuReg->marital_status;?>
						            </span></td>
					            </tr>
					          </table></td>
					        </tr>
						    <tr>
						      <td height="0" class="style65"> Name:</td>
						      <td class="style65"><?php  echo $student_name;?></td>
						      <td class="style65"><!--DWLayoutEmptyCell-->&nbsp;</td>
					        </tr>
						    <tr>
						      <td height="-5" class="style65">Permanent Address:</td>
						      <td class="style65"><span style=" padding-right:10px;">
						        <?php  echo $stuReg->address;?>
						      </span> Place of Birth: 
					          <span style=" padding-right:0px;">
					          <?php  echo $stuReg->marital_status;?>
					          </span></td>
						      <td class="style65">Date of Birth:
					          <?php  echo $stuReg->birthday?></td>
					        </tr>
						    <tr>
						      <td height="-6" class="style65">Nationality:</td>
						      <td class="style65"><span  style="padding-right:10px"><?php  echo $stuReg->nationality;?> </span>Tribe/State: <span style="padding-right:10px">
						        <?php  echo $stuReg->state;?>
						      </span></td>
						      <td class="style65">Religion: 
					          <?php  echo $stuReg->religion?></td>
					        </tr>
						    <tr>
						      <td height="27" class="style65">Parent's or Guidiance Name and Address</td>
						      <td colspan="2" class="style65"><span style="padding-right:10px">
						        <?php  echo $stuReg->parent_name.' ('.$stuReg->parent_address.')';?>
						      </span> Occupation: <span style="padding-right:10px">
						      <?php  echo '';?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="27" class="style65">Name and Address of Sponsor</td>
						      <td colspan="2" class="style65"><span style="padding-right:10px">
						        <?php  echo $stuReg->parent_name.' ('.$stuReg->parent_address.')';?>
						      </span>Award &amp; Date: <span style="padding-right:10px">
                              <?php  echo $stuReg->programme.' ('.date("d-M-Y").')';?>
                              </span></td>
					        </tr>
						    <tr>
						      <td width="13%" height="27"><span class="style65">Basis for Admission:</span></td>
						      <td width="34%"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td width="20%"><span class="style65">Last School Attended: </span></td>
						      <td width="33%" ><!--DWLayoutEmptyCell-->&nbsp;</td>
					        </tr>
						    <tr>
						      <td height="21"><span class="style65">
						        <label for="lname2">Entrance Deficiencies:</label>
						        </span></td>
						      <td width="34%"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td width="20%" class="style65">Removal of Entrance Deficiencies:</td>
						      <td width="33%" ><!--DWLayoutEmptyCell-->&nbsp;</td>
					        </tr>
				        </table>
</div>
					
					<div class="col-md-12 no-p">
						<div class="col-md-12"></div>
					  <div class="col-md-12 print-table">
                      <br />
						  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" style="">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row" valign="top"> <div id="sales2">
						      <p><br />
						      <b><h3><?php echo $stuReg->programme;?> STATEMENT OF RESULT</h3></b></p>
                                 <table width="200" border="0" cellpadding="5" cellspacing="5" align="left"></table>
                         <tr>
                           <td></td>
                          </tr>
                           <?php 
						  
						   foreach($tsessions->result() as $row)
						   {
							    $tgp=0;
								$tcr=0;
								$gdlevel="";
							   ?>
                            <tr>
                           <td><h4><?php echo  $row->course_type;
						   $ct= $row->course_type;
						   $res =$this->db->query("select* from student_sessional_results where regno='$regno' and course_type='$ct' order by course_type");
						   foreach($res->result() as $row1)
						   {
							  $gp=  getGP($row1->totalscore, $row1->course_unit) ;
							  $tgp = $tgp + $gp;
							  $cr = $row1->course_unit;
							  $tcr = $tcr +  $cr;
						   }
						   $cgp =number_format($tgp/$tcr,2);
						   $gdlevel= getGradeLevel($cgp);
						   $sub= 5.00-$cgp;
						   echo ' - '. $cgp.'-'.$gdlevel;
						   
						   ?></h4></td>
                          </tr>
                          <?php }?>
                           <td></td>
                          </tr>
                       </table>
				        <p align="left">  
                    </p>
					  </div></th>
					        </tr>
						
						 
						  
						
					      </table>
						  <p>&nbsp;</p>
                            <p>&nbsp;</p>
						  <table width="1000" border="0" cellpadding="8" cellspacing="0" align="left" style=" bottom:0px; height:">
						    <tr>
						      <td width="466"><span class="style27">.</span></td>
						      <td width="534">&nbsp;</td>
					        </tr>
						    <tr>
						      <td>&nbsp;</td>
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
