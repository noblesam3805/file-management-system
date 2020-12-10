<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Update_Student_reg_number');?>
            	</div>
            </div>
			<div class="panel-body">
				
                 <?php echo form_open('sadmin/update_record/update' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>


              

                            <div class="form-group">

                                <label class="col-sm-3 control-label"><?php echo get_phrase('Previou_reg_number');?></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="old_reg" required="required" placeholder="Enter Previous Reg Number"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label"><?php echo get_phrase('Update_to:');?></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="new_reg" required="required" placeholder="Enter New Reg Number"/>

                                </div>

                            </div>

                                <div class="form-group">

                              <div class="col-sm-offset-3 col-sm-5">

                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Proceed');?></button>

                              </div>

                                </div>

                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>