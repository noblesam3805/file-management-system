<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Retrieve_password');?>
            	</div>
            </div>
			<div class="panel-body">
				<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
                <?php echo form_open('register/password/forgot/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('_reg_no/Matric No');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
										
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('pnone_number');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info pull-right"><?php echo get_phrase('Retrieve password');?></button>
						</div>
					</div>
                    
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>