<div class="row">
	<div class="col-md-12" style="background: #fff;">
	<form action="index.php?sadmin/process_view_cbt_schedule" name="SubmitRemitaForm" class="form-groups-bordered validate" method="POST">
		<div class="col-md-6 no-p">
	
<br/><br/><br/><br/>
             <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Examination Day'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
             <select name="exam" class="form-control">
	<option value="0">Select Examination Day</option>				  
	<option value="DAY 1">DAY 1</option>
  <option value="DAY 2">DAY 2</option>
    <option value="DAY 3">DAY 3</option>
	<option value="DAY 4">DAY 4</option>
	<option value="DAY 5">DAY 5</option>
  	<option value="DAY 6">DAY 6</option>						
								
             
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
  