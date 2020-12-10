<?php
session_start();
$id= $_SESSION["id"];
//include('application/config/kee.php');
?>
<table width="98%" border="1" align="center" cellpadding="5" style="margin-left: 5px;">
 <tr>
 
    <td  colspan="23" ><img src="images/logo.png" /></td>

  </tr> 

  <tr>
    <td colspan="23" ><table width="100%">
      <tr>
        <td colspan="2" align="left" valign="top"><h4><strong>2017/2018 JAMB UTME APPLICANTS</strong></h4></td>
        </tr>
      <tr>
        <td width="16%" valign="top">&nbsp;</td>
        <td width="84%" valign="top">&nbsp;</td>
      </tr>
     
    </table></td>
  </tr>
 
<tr>
 
    <td  colspan="23" align="center"></td>

  </tr> 
<tr>
 
    <td  colspan="23" align="center"></td>

  </tr> 
<?php 
	
$applicants = $this->db->query("select *  from jamb_students");

	$sn=1;

?><br>

<tr>
    <td  width="auto" align="left" valign="top" ><strong>S/NO</strong></td>
 
    <td width="auto" align="left" valign="top" ><strong>JAMBREGNO.</strong></td>
    <td width="auto" align="left" valign="top" ><strong>PORTAL ID</strong></td>
    <td width="auto"  align="left" valign="top" ><strong>LASTNAME</strong></td>
    <td width="auto" align="left" valign="top"><strong>FIRSTNAME</strong></td>
  
    <td width="auto" align="left" valign="top" ><strong>MIDDLENAME</strong></td>
 <td width="auto" align="left" valign="top" ><strong>SEX</strong></td>
 <td width="auto" align="left" valign="top" ><strong>DATE OF BIRTH</strong></td>
 <td width="auto" align="left" valign="top" ><strong>STATE</strong></td>
 <td width="auto" align="left" valign="top" ><strong>LGA</strong></td>
 <td width="auto" align="left" valign="top" ><strong>PHONE</strong></td>
 <td width="auto" align="left" valign="top" ><strong>NATIONALITY</strong></td>
 <td width="auto" align="left" valign="top" ><strong>SESSION</strong></td>
 <td width="auto" align="left" valign="top" ><strong>JAMB SCORE</strong></td>
  <td width="auto" align="left" valign="top" ><strong>DEPARTMENT</strong></td>
   <td width="auto" align="left" valign="top" ><strong>FACULTY</strong></td>
    <td width="auto" align="left" valign="top" ><strong>PROGRAMME</strong></td>
   <!--  <td width="auto" align="left" valign="top" ><strong>NO OF SITTING_SCORE</strong></td>
      <td width="auto" align="left" valign="top" ><strong>SSCE SCORE</strong></td>
         <td width="auto" align="left" valign="top" ><strong>JAMB RESULT_SCORE</strong></td>
            <td width="auto" align="left" valign="top" ><strong>COURSE</strong></td>
               <td width="auto" align="left" valign="top" ><strong>COURSE CATEGORY</strong></td>
                 <td width="auto" align="left" valign="top" ><strong>SCREENED DATE</strong></td>-->
  </tr>
  <?php foreach($applicants->result() as $row2)

	{
		$screening_no=$row2->screening_no;
		$jamb_students = $this->db->query("select*  from jamb_students where screening_no='$screening_no'")->row();
		$jamb_regno=$jamb_students->jamb_regno;
		$jamb_designation = $this->db->query("select *  from  jamb_student_designation where jamb_regno='$jamb_regno'")->row();
		$origin = $this->db->query("select *  from  jamb_student_origin where jamb_regno='$jamb_regno'")->row();
		$jambresult = $this->db->query("select *  from  jamb_results where jamb_regno='$jamb_regno'")->row();
		$jambcourseapplication = $this->db->query("select *  from   jamb_course_application where jamb_regno='$jamb_regno'")->row();
		$jambsscedetails = $this->db->query("select *  from   jamb_ssce_result_details where jamb_regno='$jamb_regno'")->row();
		$designation=$jamb_designation->designation;
	//echo $jamb_regno;
		if($designation=="Jamb")
		{
		
		?>
  <tr>
    <td  width="auto" align="left" valign="top"><?php echo $sn;?></td>

    <td width="auto" align="left" valign="top"><?php echo $jamb_regno; ?></td>
    <td width="auto" align="left" valign="top"><?php echo $screening_no;?></td>
    <td width="auto" align="left" valign="top"><?php echo strtoupper($jamb_students->lastname); ?></td>
    <td width="auto" align="left" valign="top"><?php echo strtoupper($jamb_students->firstname); ?></td>
  
    <td width="auto" align="left" valign="top"><?php echo strtoupper($jamb_students->middlename); ?></td>
    <td width="auto" align="left" valign="top"><?php echo $jamb_students->sex;?> </td>
    <td width="auto" align="left" valign="top"><?php echo $jamb_students->date_of_birth;?> </td>
    <td width="auto" align="left" valign="top"><?php echo $origin->state;?></td>
    <td width="auto" align="left" valign="top"><?php echo $origin->lga;?></td>
    <td width="auto" align="left" valign="top"><?php echo $jamb_students->phone;?></td>
    <td width="auto" align="left" valign="top"><?php echo $jamb_students->nationality;?></td>
    <td width="auto" align="left" valign="top"><?php echo "2017/2018";?></td>
    <td width="auto" align="left" valign="top"><?php echo $jambresult->total_score;?></td>
    <td width="auto" align="left" valign="top"><?php echo $jambcourseapplication->department;?></td>
    <td width="auto" align="left" valign="top"><?php echo $jambcourseapplication->school;?></td>
    <td width="auto" align="left" valign="top"><?php echo $jamb_designation->designation;?></td>
   <!-- <td width="auto" align="left" valign="top"><?php echo $row2->no_of_sittings_score;?></td>
      <td width="auto" align="left" valign="top"><?php echo $row2->ssce_score;?></td>
          <td width="auto" align="left" valign="top"><?php echo $row2->jamb_result_score;?></td>
              <td width="auto" align="left" valign="top"><?php echo $row2->course;?></td>
                  <td width="auto" align="left" valign="top"><?php echo $row2->course_category;?></td>
                      <td width="auto" align="left" valign="top"><?php echo $row2->screening_date;?></td>-->
      
     
  </tr>
  <?php $sn++; }else{}  }?>


</table>