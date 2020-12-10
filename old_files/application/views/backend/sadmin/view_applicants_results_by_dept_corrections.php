<div class="row">
	<div class="col-md-12" style="background: #fff;">
	<form action="index.php?sadmin/process_view_applicant_results_by_dept_corrections" name="SubmitRemitaForm" class="form-groups-bordered validate" method="POST">
		<div class="col-md-6 no-p">
	
<br/><br/><br/><br/>
             <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('PUTME Department'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
             <select name="dept" class="form-control">
	<option value="0">Select Department</option>				  
			<?php
$db2= $this->load->database("db2",TRUE);			
		$depts = $db2->query("select *  from department where is_putme='1' order by dept_name");
 
?>


<?php foreach($depts->result() as $row2)

	{

		

	?>

 <option value="<?php  echo $row2->dept_id;?>"><?php  echo $row2->dept_name;?></option>

<?php 

	} 

	?>						
             
             </select>
							 </div>
                    </div>
                </div>
                
			
      
		<br/><br/>
				  
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; View</button>
			</div><br/><br/><br/>
		</div></form>
		<?php unset($_SESSION["err_msg"]); 
		 ?>
	</div>
</div>

<?php unset($_SESSION['fee_type']);?>
  