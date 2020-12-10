<?php
session_start();
include('application/config/z.php');
	function get_dept_name($data)
	
	{
		
		$q= mysql_query("select deptName from department where deptID='$data'") or die(mysql_error());
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
	
		function get_programme_name($data)
	
	{
		
		$q= mysql_query("select student_type_name from student_type where student_type_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	
	}
	
		function get_programmetype_name($data)
	
	{
		
		$q= mysql_query("select  application_type from  application_type where application_typeid='$data'") or die(mysql_error());
		while(list($application_type)=mysql_fetch_array($q))
		{
			echo strtoupper($application_type);
		}
	
	
	}
	
	function get_level_name($data)
	
	{
		
		$q= mysql_query("select year_of_study_name from course_year_of_study where year_of_study_id='$data'") or die(mysql_error());
		while(list($faculty_name)=mysql_fetch_array($q))
		{
			echo strtoupper($faculty_name);
		}
	
	
	}
	
$payments = $this->db->query("select *  from invoice_gen where application_type_id ='$id' and session_id='$session'");

	$sn=1;
	$total =0;

?><br>
<table width="100%" border="1" bgcolor="#FFFFFF" style="background-color:#FFF">
<tr>
    <td width="25" colspan="8" align="Left"><img src="<?php base_url().'images/admlogo.png';?>"></td>
 
    
  </tr>
<tr>
    <td width="25" colspan="8">FEE PAYMENT</td>
 
    
  </tr>
  <tr>
    <td width="25" colspan="8">PROGRAMME: <?php get_programmetype_name($id);?></td>
 
    
  </tr>
  
  <tr>
    <td width="25">SN</td>
    <td width="100">FULLNAME</td>
	<td width="50">PORTAL ID/REGNO</td>
    <td width="152">DEPARTMENT</td>
    
   
    <td width="40">LEVEL</td>
	<td width="30">CHANNEL</td>
    <td width="40">AMOUNT</td>
    <td width="40">CONFIRMATION CODE</td>
	<td width="40">PAYMENT DATE</td>
    
  </tr>
  <?php foreach($payments->result() as $row2)

	{
		$invoice_no= $row2->invoice_no;
		$q= mysql_query("select amount,payment_confirmation_date,confirm_code from nekede_etranzact_payment where payee_id = '$invoice_no'") or die(mysql_error());
		while(list($amount,$trans_date,$confirm_code)=mysql_fetch_array($q))
		{
		
		?>
  <tr>
    <td><?php echo $sn;?></td>
    <td><?php echo strtoupper($row2->surname." ". $row2->firstname." ".$row2->middlename);?></td>
    <td><?php echo $row2->portal_id;?></td>
    <td><?php echo get_dept_name($row2->dept_id);?></td>
    <td><?php echo $row2->level;?></td>
    <td><?php echo 'BANK BRANCH';?></td>
    <td><?php echo number_format($amount,2);?></td>
    <td><?php echo $confirm_code;	?></td>
     <td><?php echo $trans_date;?></td>
   
  </tr>
		<?php 
		$total = $total +  $row2->amount;
	$sn++;	}  
		
		}?>
		  <tr>
    <td width="25" colspan="8">TOTAL AMOUNT: <?php echo number_format($total,2);?></td>
 
    
  </tr>
</table>
