<?php
session_start();
$id= $_SESSION["deptid"];
$progid= $_SESSION["progid"];
include('application/config/kee.php');
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
		
		$q= mysql_query("select passport_url from applicants_form where application_no='$data'") or die(mysql_error());
		while(list($pic_name)=mysql_fetch_array($q))
		{
			echo "http://www.epu.edu.ng/admissions/files/".$pic_name;
		}
	
	}
	
	function get_sex($data)
	
	{
		
		$q= mysql_query("select sex from applicants_form where application_no='$data'") or die(mysql_error());
		while(list($sex)=mysql_fetch_array($q))
		{
			echo $sex;
		}
	
	}
?>
<table width="85%" border="1" align="center"   style="background-color:#fff;margin-left: 10px;" class="table datatable-basic">

<?php
$applicant = $this->db->query("select *  from applicants_form where dept_id='$id' limit 1");
{
?>
  <?php foreach($applicant->result() as $row)

	{
		?>
  <tr>
  <td colspan="14" ><table width="90%">
      <tr>
        <td colspan="2"  valign="top"></td>
        </tr>
      <tr>
        <td width="16%" valign="top">&nbsp;</td>
        <td width="84%" valign="top">&nbsp;</td>
      </tr>
  <tr>
    <td colspan="14" >
      <tr>
        <td colspan="2"  ><h4>2018/2019 <?php if($progid=="DEG"){ echo "PUTME "; } else {echo "DIRECT ENTRY ";}?> APPLICANTS</h4></td>
        </tr>
      <tr>
        <td width="16%" valign="top">&nbsp;</td>
        <td width="64%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">DEPARTMENT</td>
        <td valign="top"><?php get_dept_name($row->dept_id);?></td>
      </tr>
      <tr>
        <td valign="top">SCHOOL</td>
        <td valign="top"><?php get_school_name($row->faculty_id);?></td>
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
$applicants = $this->db->query("select *  from applicants_form where dept_id='$id' and program_code='$progid'");
	$sn=1;

?><br>


<tr>
    <td align="left" valign="top" >sn</td>
  <td align="left" valign="top" >JAMB NO</td>
    <td align="left" valign="top" >APP NO</td>
    <td align="left" valign="top"  >FULLNAME</td>
	
    <td align="left" valign="top" >SEX</td>

 

   <td align="left" valign="top" style="width: 130px;">PHOTO</td>
 
  </tr>
  <?php foreach($applicants->result() as $row2)

	{
		
	
		
		
		?>
  <tr>
    <td align="left" valign="top"><?php echo $sn;?></td>
<td align="left" valign="top"><?php echo $row2->application_no;?> </td>
<td align="left" valign="top"><?php echo $row2->app_no;?> </td>
   <td align="left" valign="top"><?php echo strtoupper($row2->surname).' '.strtoupper($row2->firstname).' '.strtoupper($row2->middlename);?></td>

 
    <td align="left" valign="top"><?php echo strtoupper($row2->sex) ; ?></td>

  
   

	
	
    <td align="left" valign="top"><img src="<?php echo get_picture_name($row2->application_no);?>" style="height: 120px; width:120px; padding:5px;"/></td>
  </tr>
  <?php  $sn++; }?>


</table>

