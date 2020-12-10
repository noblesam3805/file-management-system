<?php
session_start();
$id= $_SESSION["id"];
include('application/config/z.php');
	function get_dept_name($data)
	
	{
		
		$q= mysql_query("select dept_name from department where dept_id='$data'") or die(mysql_error());
		while(list($dept_name)=mysql_fetch_array($q))
		{
			echo strtoupper($dept_name);
		}
	
	}
	function get_school_name($data)
	
	{
		
		$q= mysql_query("select faculty_name from faculty where faculty_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	}
	
		function get_picture_name($data)
	
	{
		
		$q= mysql_query("select passport_url from hnd_applicants_form where application_no='$data'") or die(mysql_error());
		while(list($pic_name)=mysql_fetch_array($q))
		{
			echo "http://portal.fpno.edu.ng/portal2017/files/".$pic_name;
		}
	
	}
	
	function get_sex($data)
	
	{
		
		$q= mysql_query("select sex from hnd_applicants_form where application_no='$data'") or die(mysql_error());
		while(list($sex)=mysql_fetch_array($q))
		{
			echo $sex;
		}
	
	}
?>
<table width="95%" border="1" align="center"   style="background-color:#fff;margin-left: 20px;">

<?php

$applicant = $this->db->query("select* from student a,department b,schools c,student_type d, programme_type e where  a.dept=b.deptID and a.school=c.id and a.programme=d.student_type_id and a.prog_type=e.programme_type_id and b.deptID='$department' limit 1");
{
?>
  <?php foreach($applicant->result() as $row)

	{
		?>
  <tr>
  <td colspan="14" ><table width="100%">
      <tr>
        <td colspan="2"  valign="top">	<img src="assets/images/logo1.jpg" /></td>
        </tr>
      <tr>
        <td width="16%" valign="top">&nbsp;</td>
        <td width="84%" valign="top">&nbsp;</td>
      </tr>
  <tr>
    <td colspan="14" >
      <tr>
        <td colspan="2"  ><h4><?php echo strtoupper($row->deptName). " STUDENTS PHOTOCARD";?> </h4></td>
        </tr>
      <tr>
        <td width="16%" valign="top">&nbsp;</td>
        <td width="64%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">DEPARTMENT</td>
        <td valign="top"><?php echo $row->deptName;?></td>
      </tr>
      <tr>
        <td valign="top">SCHOOL</td>
        <td valign="top"><?php echo $row->schoolname;?></td>
      </tr>
    </table></td>
  </tr>
 
<tr>
 
    <td  colspan="14" align="center"></td>

  </tr> 
<tr>
 
    <td  colspan="14" align="center"></td>

  </tr> 
<?php 
}
}	
//$applicants = $this->db->query("select *  from putme_applicants where dept='$id'");
	$sn=1;

?><br>

<tr>
    <td align="left" valign="top" >S/N</td>
 
    <td align="left" valign="top" >PORTAL_ID</td>
    <td align="left" valign="top" >FULLNAME</td>
    <td align="left" valign="top" >SEX</td>

  
    <td align="left" valign="top" >SESSION</td>

  <td align="left" valign="top" >FEE STATUS</td>
   <td align="left" valign="top" >PHOTO</td>
 
  </tr>
 <?php 
 $id=1;
 foreach($student_data->result() as $row2)

	{
		?>

  <tr>
    <td align="left" valign="top"><?php echo $id;?></td>

    <td width="auto" align="left" valign="top"><?php echo $row2->portal_id; ?></td>
    <td align="left" valign="top"><?php echo $row2->name." ".$row2->othername;?></td>
    <td align="left" valign="top"><?php echo strtoupper($row2->sex) ; ?></td>

  
   
    <td align="left" valign="top"><?php echo $session;?> </td>
    <td align="left" valign="top"><?php 	
	$payDetails2 = $this->db->get_where('invoice_gen', array("portal_id" =>$row2->portal_id,"session_id"=>$session))->row();
if($payDetails2->status=="Approved")
{
	echo "Paid";
}
else{
	echo "Not Paid";
}?></td>
	  <td align="left" valign="top"><img src="<?php echo "http://localhost:8000/nekede/uploads/student_image/$row2->student_id".'.jpg';?>" width="150px" height="150px"></td>
    
  </tr>
	<?php $id++;}?>


</table>

