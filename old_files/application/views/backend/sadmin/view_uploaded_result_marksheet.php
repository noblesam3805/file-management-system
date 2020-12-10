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
			return "ABS";
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
		
		if($score==111)
		{
			return "ABSENT";
		}
}
?>
<style type="text/css">

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
<div class="print_page" style="width:100%; border:0px; font-family: Arial;">
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-content" style="padding:0px 0px;border:0px;">
				<div class="col-md-14 receipt-head" >
				
				
					
				<div class="col-md-14">
				
				
					
						  <table width="100%" border="0" align="" cellpadding="0" cellspacing="10" class="formtxt">
						    <!--DWLayoutTable-->
						   

						      
						
						   <tr>
						      <td width="10%">	<br/><img src="assets/images/ebsulogo2.png"  /></td>
						      <td width="70%" colspan='3' align="center">
					<p align="center"><h3><B>YABA COLLEGE OF TECHNOLOGY, LAGOS</B></h3></p>
					<p ><?php  echo strtoupper($school->schoolname); ?></p>
					<p >DEPARTMENT OF <?php  echo strtoupper($dept->deptName); ?></p>
					<p ><B>OFFICIAL GRADE REPORT SHEET</B></p>
						<span style="font-style: italic;font-size: 10px">(To be completed in quadruplicate)</span><br/>
						<span style="font-style: italic;font-size: 10px">(Original to be sent to Academic Registrar)</span><br/>
				<td width="10%"  align="center">
				</td>
			 </td>
						
					        </tr>
						</table>
				
							
						
				        </table>

					
				
						  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
						      <th height="43" colspan="2" class="sectionText" scope="row"> <div id="sales2">
						      <p>&nbsp;</p>
							  			 <table width="100%" border="1" align="left" cellpadding="0" cellspacing="10" class="formtxt" style="float: left;">
 <thead>						   
						   <tr>
						    
							  <td width="20%" align="left"><span class="style65">
						        <label for="lname2"><b>Student's Faculty:</b></label>
						        </span></td>
						      <td width="40%" colspan='2' align="left"><span class="style65">
						     <b>   <?php  echo $school->schoolname; ?></b>
						      </span></td>
						      <td width="20%" class="style65" ></td>
					
					        </tr>
							   <tr>
							 
						      <td width="20%" align="left"><span class="style65">
						        <label for="lname2"><b>Students Department:</b></label>
						        </span></td>
						      <td width="40%" colspan='2' align="left"><span class="style65">
						      <b>  <?php  echo $dept->deptName; ?>[<?php echo $deptopt;?>]</b>
						      </span></td>
						      <td width="20%" class="style65"></td>
					
					        </tr>
							 <tr>
             						     
							 <td height="20" align="left"><span class="style65">
						        <label for="lname2"><b>Title of Course:</b></label>
						        </span></td>
						      <td width="40%" colspan='2' align="left"><span class="style65">
						      <b>  <?php  echo $course_assigned_details->c_title; ?></b>
						      </span></td>
						      <td width="20%" class="style65"></td>
					
					        </tr>
							
							 <tr>
						
						      <td width="20%" align="left" align="left"><span class="style65">
						        <label for="lname2"><b>Course Code:</b></label>
						        </span></td>
						      <td width="20%"align="left"align="left" ><span class="style65">
						       <b> <?php  echo $course_assigned_details->c_code;; ?></b>
						      </span></td>
							  <td width="20%" align="left" align="left"><span class="style65">
						     <b>   Course Unit</b>
						      </span></td>
						      <td width="20%" class="style65" align="left"><b><?php   echo $course_assigned_details->course_unit; ?></b></td>
							
					
					        </tr>
							
							 <tr>
							 
						      <td width="20%" align="left"><span class="style65">
						        <label for="lname2"><b>Semester:</b></label>
						        </span></td>
						      <td width="20%"align="left" ><span class="style65">
						        <b><?php  echo $course_assigned_details->sem; ?></b>
						      </span></td>
							  <td width="20%" align="left"><span class="style65">
						     <b>   Session</b>
						      </span></td>
						      <td width="20%" class="style65" align="left"><b><?php  echo $_SESSION["ses"]; ?></b></td>
							
					
					        </tr>
							 </thead>
						
							</table>
						      <table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" style="font-size:12px">
						          <thead>
						            <tr bgcolor="#ffffff"></tr>
						            <tr bgcolor="#ffffff">
						              <th width="39"><div align="left" class="style6"><span class="style4">S/N</span></div></th>
						            
						              <th width="257"><div align="left" class="style6">STUDENT'S NAME</div></th>
									    <th width="146"><div align="center">REG NO</span></div></th>
						              <th width="112"><div align="center" class="style6"><span class="style4">IN COURSE 30%</span></div></th>
						            
						              <th width="140"><div align="center" class="style6"><span class="style4">EXAM 70%</span></div></th>
						              <th width="154" ><div align="center" class="style6"> TOTAL 100%</div></th>
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
						?><?php if($row->GRADE=='ABS'){?>
						            <tr  style="border-bottom:1px solid #000;">
						              <td><?php echo $id2;?></td>
    <td><div align="left"><span class="style5">
						              
					                  </span><?php echo strtoupper($row->SURNAME.' '. $row->OTHERNAMES);?></div></td>						             
									 <td align="center">
						               <?php echo strtoupper($row->REGNO);?> &nbsp;</td>
						          
						            
						              <td><div align="center">      </div></td>
						              <td align="center"><div align="center"> 
						              
						                </div></td>
						              <td align="center"><div align="center">
						        
						                </div></td>
						              <td align="center"><div align="center">
						               
						                </div></td>
                                        
                                            <td align="center"><div align="center">
						      ABS
						                </div></td>
					                </tr>
			  <?php }else {?>
									      <tr  style="border-bottom:1px solid #000;">
						              <td><?php echo $id2;?></td>
    <td><div align="left"><span class="style5">
						              
					                  </span><?php echo strtoupper($row->SURNAME.' '. $row->OTHERNAMES);?></div></td>						             
									 <td align="center">
						               <?php echo strtoupper($row->REGNO);?> &nbsp;</td>
						          
						            
						              <td><div align="center"> <?php echo number_format(($row->TESTSCORE+$row->ASSCORE),2);?>     </div></td>
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
			  </tr><?php }?>
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
						      <th class="style27" scope="row"> 
							  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="10" class="formtxt" >
						    <tr>
 <td  style="font-size:12px;" width="100%" colspan='9'>
						        SUMMARY OF GRADES</td>
</tr>								
						  
							  
							  <td width="10%" align="center" >A </td>
							  <td width="10%" align="center" >B </td>
							  <td width="10%" align="center" > C</td>
						      <td width="10%" align="center" > D</td>
							
					          <td width="10%" align="center"> E </td>
							  <td width="10%" align="center"> F </td>
							  <td width="10%" align="center"> AB </td>
							  <td width="10%" align="center"> BC </td>
							  <td width="20%" align="center"> CD </td>
					        </tr>
							<tr>
						  
							  <?php $cids= $course_assigned_details->id;
							$a=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='A' and session='$_SESSION[ses]'")->row()->expx;
							$b=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='B' and session='$_SESSION[ses]'")->row()->expx;
							$c=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='C' and session='$_SESSION[ses]'")->row()->expx;
							$d=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='D' and session='$_SESSION[ses]'")->row()->expx;
							$e=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='E' and session='$_SESSION[ses]'")->row()->expx;
							$f=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='F' and session='$_SESSION[ses]'")->row()->expx;
							$ab=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='AB' and session='$_SESSION[ses]'")->row()->expx;
							$bc=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='BC' and session='$_SESSION[ses]'")->row()->expx;
							$cd=  $this->db->query("select count(*) as expx  from courses_registered where course_assign_to_dept_id='$cids' and grade='CD' and session='$_SESSION[ses]'")->row()->expx;
							
							
							$total =$a + $b +$c +$d  + $e + $f + $ab + $bc+ $cd;
							?>
							  <td width="10%" align="center" ><?php echo $a;?> </td>
							  <td width="10%" align="center" ><?php echo $b;?> </td>
							  <td width="10%" align="center" ><?php echo $c;?> </td>
						      <td width="10%" align="center" ><?php echo $d;?> </td>
							  <td width="10%" align="center" ><?php echo $e;?> </td>
							 
					          <td width="10%" align="center"> <?php echo $f;?> </td>
							   <td width="10%" align="center"> <?php echo $ab;?> </td>
							    <td width="10%" align="center"> <?php echo $bc;?> </td>
								<td width="20%" align="center"> <?php echo $cd;?> </td>
					        </tr>
							<tr height="30px;">
						  
							  
							  <td width="60%" class="style65" colspan='6'align="center" >TOTAL </td>
							 
						      <td width="40%" class="style65" colspan='3' align="center"> <?php echo $total;?></td>
							  
					        
					        </tr>
							   </table></th>
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
						      <th class="style27" scope="row" align="left">NAME OF EXAMINER: ................................................</th>
						      <th align="left"  class="style27" scope="row">SIGN: ....................................  &nbsp;&nbsp;&nbsp;   DATE: ..............................</th>
					
					        </tr>
							<tr class="border">
						      <th class="style27" scope="row" align="left" height="20px"></th>
						      <th align="left"  class="style27" scope="row"height="20px"></th>
					
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left">NAME OF H.O.D: .........................................................</th>
						      <th align="left"  class="style27" scope="row">SIGN: ....................................  &nbsp;&nbsp;&nbsp;   DATE: ..............................</th>
					
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left" height="20px"></th>
						      <th align="left"  class="style27" scope="row"height="20px"></th>
				
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left">NAME OF DEAN: ........................................................</th>
						      <th align="left"  class="style27" scope="row">SIGN: ....................................  &nbsp;&nbsp;&nbsp;   DATE: ..............................</th>
					
					        </tr>
							 <tr class="border">
						      <th class="style27" scope="row" align="left" height="10px"></th>
						      <th align="left"  class="style27" scope="row"height="10px"></th>
				
					        </tr>
						    <tr class="border">
						      <th class="style27" scope="row" align="left" colspan='2'>	A =70-100% B = 60-69% C = 50-59% D = 45-49% F= 0-44%</th>
						   
					        </tr>
						   
					      </table>
					  
<?php 

?>
