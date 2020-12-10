<?php session_start();
//$faculty = $this->db->query("select *  from schools order by schoolname");
//$student_type = $this->db->query("select *  from student_type order by student_type_name");


?>
<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('sadmin/processtranscript_report', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
	

             
            
		
           
			
			<div class="form-group eduportal-form-group p20">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('from'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="report_begin_date"  
                                   value="<?php echo date("Y-m-d"); ?>" id="datepicker" data-format="yyyy-mm-dd" >
								  
                        </div>
                    </div>
                </div><br/>
                
                <div class="form-group eduportal-form-group p20">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('to'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="report_end_date"  
                                   value="<?php echo date("Y-m-d"); ?>" id="datepicker2" data-format="yyyy-mm-dd" >
								   
                        </div>
                    </div>
                </div>
				<br/>
                 
			
			
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Generate Report</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div>

<?php unset($_SESSION['fee_type']);?>
  