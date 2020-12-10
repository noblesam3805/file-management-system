<?php session_start();

 $school = $this->db->query("select *  from schools order by schoolname");
$payment_type = $this->db->query("select *  from payment_types WHERE payment_type_id!=4 AND payment_type_id!=5 AND payment_type_id!=70  order by payment_type_name ASC");
$program_type = $this->db->query("select *  from programme_type order by programme_type_id");
?>

<div class="row">
	<div class="col-md-12">
		<?php  echo form_open('sadmin/processotherFeesPaymentReports', array('class' => 'form-groups-bordered validate','target'=>'_top'));  ?>
		<div class="col-md-6 no-p">
		  <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('start_date:'); ?></label>
               <div class="col-sm-12">
					    <div class="input-group">
                <input type="date" name="date1" class="form-control" />
         </div>
               </div>
                </div>
				<br/>
    <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('end_date:'); ?></label>
              <div class="col-sm-12">
					    <div class="input-group">
                <input type="date" name="date2" class="form-control" />
                 </div>
              </div>
                </div>
				<br/>
		
					 <!-- program type option for all admitted students-->
			
		
				<!-- program type option for admitted students based on departments-->			
		
                 <div class="form-group">
                    <label for="field-1" class="col-sm-5 control-label"><?php echo get_phrase('payment Type:'); ?></label>

                    <div class="col-sm-12">
					    <div class="input-group">
                      <select name="ptype" class="form-control">
					  <?php 
						foreach($payment_type->result() as $payment_item)
						{
						?>	
                            <option value="<?php  echo $payment_item->payment_type_name;?>"><?php  echo $payment_item->payment_type_name;?></option>
																
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
  