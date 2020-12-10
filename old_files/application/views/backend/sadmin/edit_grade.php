
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">

			<?php if(isset($_SESSION['imgerror'])) {
                echo '<li>';
            }else{
                echo '<li class="active">';
            }
            ?>
            	<a href="#list" data-toggle="tab"><i class="entypo-credit-card"></i>
					<?php echo get_phrase('_edit_grade');?>
                    	</a></li>


		</ul>
    	<!------CONTROL TABS END------->

		<?php  
			$gradeRecord = $this->db->get_where('grade_scale', array("ID" => $id))->row();
			
		?>
       <div class="widget stacked widget-table">
	   <div class="widget-content">

		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                        <?php echo form_open('sadmin/gradeOptions/editGrade' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_grade');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="grade" value="<?php echo $gradeRecord->grade;?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_percent');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="percent" value="<?php echo $gradeRecord->percent;?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_points');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="points" value="<?php echo $gradeRecord->points;?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_count_in_GPA');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="count" value="<?php echo $gradeRecord->count_in_gpa;?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_status');?></label>
                                <div class="col-sm-5">
									<input type="text" class="form-control" name="status" value="<?php echo $gradeRecord->status;?>">
								</div>
                            </div>
							
							<div class="form-group">
                                <div class="col-sm-5">
									<input type="hidden" class="form-control" name="id" value="<?php echo $gradeRecord->ID;?>">
								</div>
                            </div>
							
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_grade');?></button>
                              </div>
								</div>
                </div>
			</div>

		</div>
	   </div>
	   </div>
	</div>
</div>