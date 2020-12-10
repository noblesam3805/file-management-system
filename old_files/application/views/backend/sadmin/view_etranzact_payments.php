<?php
session_start();
$id= $_SESSION["id"];
//include('application/config/kee.php');
?>
<div class="row">
    <div class="col-md-12">
		 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
<table width="98%"  class="table table-bordered datatable" id="table_export">
 <tr>

 
<tr>
 
    <td  colspan="23" align="center"></td>

  </tr> 
<tr>
 
    <td  colspan="23" align="center"></td>

  </tr> 
<?php 
	
$applicants = $this->db->query("select *  from etranzact_pay");

	$sn=1;

?><br>

<tr>
    <td  width="auto" align="left" valign="top" ><strong>S/NO</strong></td>
 
    <td width="auto" align="left" valign="top" ><strong>PAYMENT DATE.</strong></td>
    <td width="auto" align="left" valign="top" ><strong>PAYEE ID</strong></td>
    <td width="auto"  align="left" valign="top" ><strong>PAYEE NAME</strong></td>
    <td width="auto" align="left" valign="top"><strong>CONFIRMATION NO</strong></td>
  
    <td width="auto" align="left" valign="top" ><strong>AMOUNT</strong></td>
 <td width="auto" align="left" valign="top" ><strong>PAYMENT PURPOSE</strong></td>
 
   <!--  <td width="auto" align="left" valign="top" ><strong>NO OF SITTING_SCORE</strong></td>
      <td width="auto" align="left" valign="top" ><strong>SSCE SCORE</strong></td>
         <td width="auto" align="left" valign="top" ><strong>JAMB RESULT_SCORE</strong></td>
            <td width="auto" align="left" valign="top" ><strong>COURSE</strong></td>
               <td width="auto" align="left" valign="top" ><strong>COURSE CATEGORY</strong></td>
                 <td width="auto" align="left" valign="top" ><strong>SCREENED DATE</strong></td>-->
  </tr>
  <?php foreach($applicants->result() as $row2)

	{
		
		?>
  <tr>
    <td  width="auto" align="left" valign="top"><?php echo $sn;?></td>

    <td width="auto" align="left" valign="top"><?php echo $row2->date_reg;?></td>
	  <td width="auto" align="left" valign="top"><?php echo $row2->customer_id;?></td>
	    <td width="auto" align="left" valign="top"><?php echo $row2->fullname;?></td>
		  <td width="auto" align="left" valign="top"><?php echo $row2->confirm_code;?></td>
		    <td width="auto" align="left" valign="top"><?php echo $row2->amount;?></td>
			  <td width="auto" align="left" valign="top"><?php echo $row2->prog_type;?></td>
   
      
     
  </tr>
  <?php $sn++; }?>


</table>

        </div>
       </div>
	  </div> 
	</div>
</div>