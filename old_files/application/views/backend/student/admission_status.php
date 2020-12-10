<?php session_start();
$student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
?>
<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('student/verify_appno', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
	

             
            
		
           <?php echo $_SESSION["error"];?>
			
			<br/>
                
                <div class="form-group eduportal-form-group p20">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Jamb Regno'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-user"></i></span>
                            <input type="text" class="form-control input" name="jamb" value="<?php echo $student->reg_no;?>" readonly="readonly" required>
							 <input type="hidden" class="form-control input" name="jambreg" value="<?php echo $student->reg_no;?>">	   
                        </div>
                    </div>
                </div>
				<br/>
                 <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('session'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                      <select name="ptype" class="form-control">
                                <option value="2018/2019"><?php echo get_phrase('2018/2019'); ?></option>
								
             
                            </select>
							 </div>
                    </div>
                </div>
       
			
			
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:190px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; View Letter</button>
			</div>
		</div>
		<?php unset($_SESSION["err_msg"]); 
		echo form_close(); ?>
	</div>
</div>

<?php unset($_SESSION["error"]);?>
  