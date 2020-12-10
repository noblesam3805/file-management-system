<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");


?>
<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('sadmin/process_add_institution', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
	

             
                    
			
			<div class="form-group eduportal-form-group p20">
              
				<br/>
                 <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase("Enter_institution_Name"); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                     <input type="text" name="institution" value="" class="form-group eduportal-form-group p20" />
							 </div>
                    </div>
                </div>
       
			
			
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Proceed</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div><br/>

<?php unset($_SESSION['fee_type']);?><br/><br/><br/><br/><br/><br/><br/>
  