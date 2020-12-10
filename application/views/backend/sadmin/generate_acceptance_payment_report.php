<?php session_start();

 $school = $this->db->query("select *  from schools order by schoolname");
$payment_type = $this->db->query("select *  from payment_types where payment_type_id=4");
$program_type = $this->db->query("select *  from programme_type order by programme_type_id");


?>

<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('sadmin/processAcceptanceFeesPaymentReports', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
		  <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Academic Session'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
							<select name="academic_session" class="form-control">
                                <option value="2019/2020"><?php echo get_phrase('2019/2020'); ?></option>
								<option value="2018/2019"><?php echo get_phrase('2018/2019'); ?></option>
								<option value="2017/2018"><?php echo get_phrase('2017/2018'); ?></option>
						      </select>
						 </div>
                    </div>
                </div>
				<br/>
			
				<div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Program Type'); ?></label>
                    <div class="col-sm-12">
					<div class="input-group">
                        <select  name="programmeType"  id="programme"  class="form-control" >
						<?php 
						foreach($program_type->result() as $programe)
						{
						?>	
							<option value="<?php  echo $programe->programme_type_id;?>"><?php  echo $programe->programme_type_name;?></option>
						<?php 
						}
						?>
					
						</select>
                      
					</div>						  
                    </div>
			</div><br/>
					 <!-- program type option for all admitted students-->
			
		
				<!-- program type option for admitted students based on departments-->			
			
			<div class="form-group">
                <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('School'); ?></label>
                    <div class="col-sm-12">
					<div class="input-group">
						<select class="form-control"   name="schoolID" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,programme.value); "><option value="" selected="selected" >- Select -</option>
							<?php 
							foreach($school->result() as $row)
							{
							?>
								<option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
							<?php 
							}
							?>
						</select>
                    </div>
					</div>
			</div> <br />
			
				<div class="form-group">
			<label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('Department'); ?></label>
            <div class="col-sm-12">
				<div class="input-group">
					<span id="dept">
					<select class="form-control"   name="deptID" id="depts" class="form-select required"><option value="" selected="selected">- Select -</option>
                        
						</select></span>
				</div>
			</div>
			</div>
			
			
			<br />
                 <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('payment Type'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                      <select name="ptype" class="form-control">
					  <?php 
						foreach($payment_type->result() as $payment_item)
						{
						?>	
                            <option value="<?php  echo $payment_item->payment_type_id;?>"><?php  echo $payment_item->payment_type_name;?></option>
																
							<?php
						}?>	
             
                            </select>
							 </div>
                    </div>
                </div>
       
			
			
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
  