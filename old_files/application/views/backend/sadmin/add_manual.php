<p style="font-size:13px; color:#9d0000;"><?php if($this->session->userdata('error')){echo $this->session->userdata('error');} ?></p>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Add_Old_fee_record');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('sadmin/add_manual/add' , array('class' => 'form-groups-bordered validate','target' => '_top', 'enctype' => 'multipart/form-data'));?>
		            <div class="row">
		            	<div class="col-md-6 form-horizontal ">
		                	
			
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Reg_no');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="serial" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="Insert student Reg/No">
								</div>
							</div>
			
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Fullname');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="Insert fullname start with Last, Name">
								</div>
							</div>

							<div class="form-group">
		                        <label class="col-sm-3 control-label"><?php echo get_phrase('Receipt_Number.');?></label>

		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" name="receipt" required="required" placeholder="Insert Etranzact Receipt Number"/>
		                        </div>
		                    </div>

							<div class="form-group">
		                        <label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>

		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" name="CONFIRMATION_NO" required="required" placeholder="Insert Etranzact Confirmation Number"/>
		                        </div>
		                    </div>

		                    <div class="form-group">
		                        <label class="col-sm-3 control-label"><?php echo get_phrase('Amount. (N)');?></label>

		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" name="amount" required="required" placeholder="0.00"/>
		                        </div>
		                    </div>

		                    <div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Transaction_date');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control datepicker" name="trans_date" placeholder="Insert Date of Transaction" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								</div> 
							</div>

							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Merchant_Code');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="merchant_code" placeholder="Insert Merchant Code" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								</div> 
							</div>
		                      
		                    <div class="form-group">
		                       <label class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>
		                        <div class="col-sm-5">
		                            <select id="session" name="session" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">

		                            <option> 2009/2010 </option>
		                            <option> 2010/2011 </option>
		                            <option> 2011/2012 </option>
		                            <option> 2012/2013 </option>
		                            <option> 2013/2014 </option>
		                           </select>
		                        </div>
		                    </div>
						</div>
						<div class="col-md-6 form-horizontal">						
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Prog_type');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="prog_type" value="" />
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Address');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="address" value="">
								</div> 
							</div>
							
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('School');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="school" value="">
								</div> 
							</div>

							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Dept');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" name="dept" value="">
								</div> 
							</div>
		                    
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Level');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="level" value="">
								</div>
							</div>

							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Transaction_Description');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="trans_descr" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
								</div>
							</div>

							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Inserted By');?></label>
		                        
								<div class="col-sm-5">
									<input type="text" class="form-control" readonly name="author" value="<?php echo $this->session->userdata('name');?>" >
								</div> 
							</div>
		                    
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Entry Date');?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" readonly name="insert_date" value="<?php echo date('Y-m-d');?>">
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
					</br>
					<div style="background: cyan;">
							<label for="field-1" class="col-sm-1 control-label"><input id="check" data-validate="required" data-message-required="<?php echo get_phrase('required');?>"type="checkbox" class="form-control" name="check" value="check"></label>
							<div class="col-sm-8 pull-left">I hereby confirm that all the data provided is correct.	And I take full resposibilty for my actions.
							</div>
					</div>
				</br></br>
		                    
		                    <div class="form-group">
								<div class="col-sm-offset-3 col-sm-8">
									<button type="submit" class="btn btn-info"><?php echo get_phrase('Process Fees');?></button>
								</div>
							</div>	
                	<?php echo form_close();?>
            		</div>
            </div>
        </div>
    </div>
</div>