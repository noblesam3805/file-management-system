<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");
$year = $this->db->query("select *  from year order by year");
?>
<div class="row">
	<div class="col-md-12">
	<form action="index.php?sadmin/process_verify_olevel_result" name="SubmitRemitaForm" class="form-groups-bordered validate" method="POST">
		<div class="col-md-6 no-p">
	

             <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Certificate Examination'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
             <select name="exam" class="form-control">
					  
	<option value="1">WAEC</option>
  <option value="2">NECO</option>
    <option value="3">NABTEB</option>
  								
								
             
             </select>
							 </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Exam Type'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
              <select name="ExamType" class="form-control">
 <option value="0">Select Exam Type</option>					  
 <option value="1">May/June</option>
 <option value="2">Nov/Dec</option>
  								
								
             
                            </select>
							 </div>
                    </div>
                </div>
				<div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Exam Year'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                      <select name="eExamYear" class="form-control">
 <option value="0">Select Exam Year</option>					  
					<?php foreach($year->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->year;?>"><?php  echo $row->year;?></option>
<?php 
	} 
	?>
  								
								
             
                            </select>
							 </div>
                    </div>
                </div>
       <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Exam No'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                    <input type="text" id="eCandidateNo" name="eCandidateNo"    maxlength="70" class="form-text required" />
	
							 </div>
                    </div>
                </div>
		
				  
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Verify</button>
			</div>
		</div></form>
		<?php unset($_SESSION["err_msg"]); 
		 ?>
	</div>
</div>

<?php unset($_SESSION['fee_type']);?>
  