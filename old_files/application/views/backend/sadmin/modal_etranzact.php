<?php 
$edit_data		=	$this->db->get_where('student' , array('student_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<p style="font-size:13px; color:#9d0000;"><?php $this->session->userdata('post');?></p>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('sadmin/etranzact/do_update' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Reg_no');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="serial" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['reg_no'];?>">
						</div>
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="oname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['othername'];?>">
						</div>
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="CONFIRMATION_NO" required="required" placeholder="Enter Etranzact Confirmation Number"/>
                        </div>
                    </div>
                            <input type=hidden name = 'TERMINAL_ID' value='2140214016'>
                    <div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>
                        <div class="col-sm-5">
                            <select id="session" name="session" class="form-control" >
                            <option> 2012/2013 </option>
                             <option> 2013/2014 </option>
                            <option selected='selected' > 2014/2015 </option>
                           </select>
                        </div>
                    </div>
										
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Prog_type');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="prog_type" value="<?php echo $row['prog_type'];?>" >
						</div> 
					</div>
					
					<!--div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2">
						</div> 
					</div-->
					
					<!--div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div-->

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Dept');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="dept" value="<?php echo $row['dept'];?>" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('level');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="level" value="<?php echo $row['level'];?>">
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Process Fees');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
$this->session->unset_userdata('post');
endforeach;
?>