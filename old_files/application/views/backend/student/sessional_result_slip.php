<?php
$stuReg = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
$student_id=$stuReg->student_id ;
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


$semester1 = $this->db->query("select *  from course_semester where semester_id='$semester'");

$session =  $this->db->query("select *  from course_session");
$levelname =    $this->db->query("select *  from course_year_of_study where year_of_study_id='$level_id'")->row()->year_of_study_name;



$courses_registered = $this->db->query("select *  from courses_registered where semester='1' and session='".$this->session->userdata('sess')."' and year_of_study='".$this->session->userdata('level_id')."' and student_id='".$student_id."' and result_approved='1'") ;

$courses_registered2 = $this->db->query("select *  from courses_registered where semester='2' and session='".$this->session->userdata('sess')."' and year_of_study='".$this->session->userdata('level_id')."' and student_id='".$student_id."' and result_approved='1'") ;
$courses_registereddetails2=$courses_registered2->row();
	$PNG_TEMP_DIR = base_url().'scan/';
    $PNG_WEB_DIR = 'scan/';

    include "QR/qrlib.php";

    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';

    if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];

    	$matrixPointSize = 4;

    if (isset($_REQUEST['size']))

        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

		$link = "http://portal.fpno.edu.ng/nekede/index.php?student/qrCheckResults/".$student_id."/".$this->session->userdata('semester_id')."/".$this->session->userdata('sess')."/".$this->session->userdata('level_id');

        $filename = 'scan/'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		
		
		function getGP($score)
{
	if($score>=0 && $score<=9)
		{
			return "0.0";
		}
	if($score>=10 && $score<=19)
		{
			return "0.5";
		}
	if($score>=20 && $score<=29)
		{
			return "1.0";
		}
		if($score>=30 && $score<=39)
		{
			return "1.5";
		}
		if($score>=40 && $score<=49)
		{
			return "2.0";
		}
		if($score>=50 && $score<=59)
		{
			return "2.5";
		}
		if($score>=60 && $score<=69)
		{
			return "3.0";
		}
		if($score>=70 && $score<=79)
		{
			return "3.5";
		}
		if($score>=80 && $score<=100)
		{
			return "4.0";
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
<div class="print_page">
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;">
				<div class="col-md-12 receipt-head" style="margin-top:10px;">
			<img src="images/logo.png" />
					<p><h2><b>Semester Results</b></h2>
					</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<table>
								<tbody>
									<tr>
										<td>
											<h3>Personal Details</h3>
										</td>
									</tr>
								</tbody>
							</table>
							
						</div>
					  <div class="col-md-12 print-table">
						  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="10" class="formtxt">
						    <!--DWLayoutTable-->
						    <tr>
						      <td width="31%" height="33"><span class="style65">Reg. Number: </span></td>
						      <td width="46%"><span class="style65">
						        <?php  echo $reg_no; ?>
						      </span></td>
						      <td width="23%" rowspan="12" valign="top"><img src="<?php 
									//get the student photo
							
									$photo = ($stuReg->photo == NULL || empty($stuReg->photo)) ? 'uploads/student_image/' . $stuReg->student_id . '.jpg' : 'putme/uploads/student_image/' . $stuReg->photo . '.jpg';
								
									echo $photo; ?>" style="width:120px ;height:120px" /><img src="<?php echo $filename;?>" style="width:120px ;height:120px" /></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">
						        <label for="lname2">Student Name:</label>
						        </span></td>
						      <td width="46%"><span class="style65">
						        <?php  echo $student_name; ?>
						      </span></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">
						        <label for="dept2">Department:</label>
						        </span></td>
						      <td width="46%"><span class="style65"><?php echo  $deptname; ?></span></td>
					        </tr>
							  <tr>
						      <td height="19"><span class="style65">
						        <label for="dept2">Department Option:</label>
						        </span></td>
						      <td width="46%"><span class="style65"><?php echo $deptopt;?></span></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">
						        <label for="falc2">Faculty/School:</label>
						        </span></td>
						      <td width="46%"><span class="style65"><?php echo $school; ?></span></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">Programme</span>:</td>
						      <td><span class="style65"><?php  echo $student_type_name;?></span></td>
					        </tr>
						    <tr>
						      <td height="19">Programme Type</td>
						      <td> <?php echo $programme_type_name;?></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">
						        <label for="falc2">Session:</label>
						        </span></td>
						      <td width="46%"><span class="style65"><?php echo $this->session->userdata('session'); ?></span></td>
					        </tr>
						    <tr>
						      <td height="19"><span class="style65">
						        <label for="falc2">Year of Study:</label>
						        </span></td>
						      <td width="46%"><span class="style65"><?php echo $this->session->userdata('level'); ?></span></td>
					        </tr>
						    <tr>
						      <td height="19"><!--DWLayoutEmptyCell-->&nbsp;</td>
						      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
					        </tr>
						 
						    <tr>
						      <td height="19" colspan="2"><h3>First Semester Result Details</h3></td>
					        </tr>
					      </table>
</div>
						<p></p>
					<div class="col-md-12 no-p">
						<div class="col-md-12">
						  <hr />
						 
						</div>
						<div class="col-md-12 print-table">
						  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row"> <div id="sales2"><table width="96%"  class="" >
                <thead>
                 
                  <tr bgcolor="#ffffff">
                    <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
                    <th width="136"><div align="left" class="style6"><span class="style4">COURSE CODE </span></div></th>
                    <th width="257"><div align="left" class="style6"><span class="style4">COURSE TITLE</span></div></th>
                    <th width="129"><div align="center" class="style6"><span class="style4">CREDIT UNIT</span></div></th>
                    <th width="154"><div align="center" class="style6"><span class="style4">GRADE </span></div></th>
					<th width="154"><div align="center" class="style6"><span class="style4">REMARK </span></div></th>
             <th width="154"><div align="center" class="style6"><span class="style4">GP </span></div></th>
                  </tr>
                </thead>
                <?php $id2=1; 
				$tcu = 0;
				$tgp=0;
				foreach($courses_registered->result() as $row)
			  {
				 $course_assigned_id= $row->course_assign_to_dept_id;
				  $query4 =sqlsrv_query($conn,"select* from course_assigned_to_department where id='$course_assigned_id'");
								while(list($id3,$courseid2,$course_unit2,$course_type_id2) = sqlsrv_fetch_array($query4))
								{?>
			
                <tbody>
                  <tr  style="">
                    <td colspan="7" style="border-top:1px solid #000;" ></td>
                    </tr>
                  <tr  style="border-bottom:1px solid #000;">
                    <td><?php echo $id2;?></td>
                    <td> <?php $q4=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid2'")or die ();
		  
		  while(list($courseid1,$coursecode1,$course_title1)=sqlsrv_fetch_array($q4))
		  {echo  $coursecode1;}?>&nbsp;</td>
                    <td><div align="left"><span class="style5"><?php $q2=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid2'")or die ();while(list($courseid2,$coursecode2,$course_title2)=sqlsrv_fetch_array($q2))
		  {echo  $course_title2;}?></span></div></td>
                    <td><div align="center"><?php echo $course_unit2;?></div></td>
                    <td><div align="center">
                      <?php echo $row->grade; ?>
                    </div></td>
					   <td><div align="center">
                      <?php echo getRemark($row->total_score); ?>
                    </div></td>
                     <td><div align="center">
                      <?php $gp =getGP($row->total_score)*$course_unit2;
$tgp = $tgp+ $gp;				echo number_format($gp,2);	  ?>
                    </div></td>
				    <?php 
				  $id2 = $id2 +1;
				$tcu= $tcu +$course_unit2;
				  
				  }}
				    if($id2<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses Registered!</h3></td></tr>";
				  }
				
				  
				  ?>
				 
		
				    <td><div align="center"></div></td>
					 <td><div align="center"></div></td>
                    </tr>
					  <tr  style="">
                    <td colspan="7" style="" ></td>
                    </tr>
                  <tr  style="">
                    <td></td>
                    <td> </td>
                    <td><div align="center"></div></td>
                    <td><div align="left">
                 
                    </div></td><td><div align="center"></div></td>
                     <td><div align="right">
                     Total CU
                    </div></td>
				  
				 
		
				    <td><div align="center"><?php echo number_format($tcu,2);?></div></td>
					 <td><div align="center"></div></td>
                    </tr>
					
					<tr  style="">
                    <td colspan="7" style="" ></td>
                    </tr>
                  <tr  style="">
                    <td></td>
                    <td> </td>
                    <td><div align="center"></div></td>
                    <td><div align="left">
                 
                    </div></td><td><div align="center"></div></td>
                     <td><div align="right">
                     Total GP:
                    </div></td>
				  
				    <td><div align="center"><?php echo number_format($tgp,2);?></div></td>
					 <td><div align="center"></div></td>
                    </tr>
						
					<tr  style="">
                    <td colspan="7" style="border-bottom:1px solid #000;" ></td>
                    </tr>
                  <tr  style="border-bottom:1px solid #000;">
                    <td></td>
                    <td> </td>
                    <td><div align="center"></div></td>
                    <td><div align="left">
                 
                    </div></td><td><div align="center"></div></td>
                     <td><div align="right">
                     Semester GPA:
                    </div></td>
				  
				    <td><div align="center"><?php echo number_format($tgp/$tcu,2);?></div></td>
					 <td><div align="center"></div></td>
                    </tr>
                </tbody>
              
              </table>
						        
						         <?php if(isset($courses_registereddetails2->course_registered_id)){?>
                                  <table width="96%"  class="" >
						            <thead>
						              <tr bgcolor="#ffffff">
						                <th height="27" colspan="6" align="left"><h4>Second Semester</h4></th>
					                  </tr>
						              <tr bgcolor="#ffffff">
						                <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
						                <th width="136"><div align="left" class="style6"><span class="style4">COURSE CODE </span></div></th>
						                <th width="280"><div align="left" class="style6"><span class="style4">COURSE TITLE</span></div></th>
						                <th width="129"><div align="left" class="style6"><span class="style4">CREDIT UNIT</span></div></th>
						                <th width="154"><div align="left" class="style6"><span class="style4">COURSE TYPE </span></div></th>
						                <th width="112"><div align="center" class="style6">APPROVED</div></th>
					                  </tr>
					                </thead>
						            <?php $id2=1; 
				$tcu2 = 0;
				foreach($courses_registered2->result() as $row)
			  {
				 $course_assigned_id= $row->course_assign_to_dept_id;
				  $query4 =sqlsrv_query($conn,"select* from course_assigned_to_department where id='$course_assigned_id'") or die();
								while(list($id3,$courseid2,$course_unit2,$course_type_id2) = sqlsrv_fetch_array($query4))
								{?>
						            <tbody>
						              <tr  style="">
						                <td colspan="6" style="border-bottom:1px solid #000;" ></td>
					                  </tr>
						              <tr  style="border-bottom:1px solid #000;">
						                <td><?php echo $id2;?></td>
						                <td><?php $q4=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid2'")or die ();
		  
		  while(list($courseid1,$coursecode1,$course_title1)=sqlsrv_fetch_array($q4))
		  {echo  $coursecode1;}?>
						                  &nbsp;</td>
						                <td><div align="left"><span class="style5">
						                  <?php $q2=sqlsrv_query($conn,"select *  from eduportal_courses where course_id='$courseid2'")or die ();while(list($courseid2,$coursecode2,$course_title2)=sqlsrv_fetch_array($q2))
		  {echo  $course_title2;}?>
						                  </span></div></td>
						                <td><div align="center"><?php echo $course_unit2;?></div></td>
						                <td><div align="left">
						                  <?php $q3=sqlsrv_query($conn,"select *  from course_type
 where course_type_id='$course_type_id2'")or die ();while(list($course_type_id2,$course_type_name2)=sqlsrv_fetch_array($q3))
		  {echo  $course_type_name2;}?>
						                  </div></td>
						                <td align="center"><?php if($row->approved){?>
						                  <img src="images/ok.png" alt="" />
						                  <?php } else {?>
						                  <img src="images/error.png" alt="" />
						                  <?php }?></td>
					                  </tr>
					                </tbody>
						            <?php 
				  $id2 = $id2 +1;
				$tcu2= $tcu2 +$course_unit2;
				  
				  }}
				    if($id2<2)
				  {
					  echo "<tr> <td colspan='5' align='center'><h3>No Courses Registered!</h3></td></tr>";
				  }
				
				  
				  ?>
					            </table>
						          <p>Second Semester Total Credit Units:
                                    <?php echo  $tcu2;?>                                  </p><?php }?>
</div></th>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">&nbsp;</th>
						      <td>&nbsp;</td>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row">							  <table>
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


</td></th>
						      <td>&nbsp;</td>
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left"></th>
						      <th align="left"  class="style27" scope="row"></th>
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left"></th>
						      <th align="left"  class="style27" scope="row"></th>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">Signature/Date of Class Adviser ............................................</th>
						      <th align="left"  class="style27" scope="row">Signature/Date of Head of Department ...............................................</th>
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left">&nbsp;</th>
						      <th>&nbsp;</th>
					        </tr>
						    <tr class="border">
						      <th width="46%" class="style27" scope="row" align="left">Signature/Date of Faculty Dean   .............................................</th>
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
					
					<div class="col-md-12 no-p">
						<table class="table">
							<tbody>
							
								<tr>
									<td>
										<p style="text-align:right;">
											<button class="btn btn-default" onclick="javascript:print()"><i class="glyphicon glyphicon-print"></i> &nbsp;Print</button> &nbsp; 
											
											<button class="btn btn-default" onclick="javascript:window.location.href = '<?php echo base_url(); ?>'"><i class="glyphicon glyphicon-send"></i> &nbsp;Close</button>
										</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
<?php 

?>
