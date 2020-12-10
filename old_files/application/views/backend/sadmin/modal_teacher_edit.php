<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_staff');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open('admin/staff/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>" alt="...">
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
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Staff ID');?></label>
                                
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['staff_id'];?>" autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date of Birth');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker fill-up form-control" name="birthday" value="<?php echo $row['birthday'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Status');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="status" class="form-control" >
                                      <option value="academic" <?php if($row['status'] == 'academic')echo 'selected';?>><?php echo get_phrase('Academic Staff');?></option>
                                      <option value="non-academic" <?php if($row['status'] == 'non-academic')echo 'selected';?>><?php echo get_phrase('Non-Academic Staff');?></option>
                                  </select>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('School');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="school" class="form-control">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Department');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="dept" class="form-control">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Position');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="position" class="form-control">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
                                <div class="col-sm-5">
                                    <select name="sex" class="form-control" style="width:100%;">
                                        <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                        <option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="password" value="<?php echo $row['password'];?>"/>
                                </div>
                            </div>                            
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_staff');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
