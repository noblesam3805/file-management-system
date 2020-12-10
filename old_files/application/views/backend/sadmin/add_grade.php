<?php  session_start(); ?>
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
 
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php if(isset($_SESSION['report'])){
					echo "<p style='background:#043762; font-size:16px; text-align:center; padding:5px; border-radius:2px;color:#e5e5e5;'>" . $_SESSION['report'] . "</p>";} 
					
					?>
					
                        <?php echo form_open('sadmin/gradeOptions/addGrade' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_grade');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="grade" />
                                </div>
                            </div> 
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_percent');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="percent" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_points');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="points" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_count_in_GPA');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="count"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_status');?></label>
                                <div class="col-sm-5">
									<input type="text" class="form-control" name="status">
								</div>
                            </div>
							
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_grade');?></button>
                              </div>
								</div>
                </div>
			</div>

		</div>
	</div>
</div>
<?php
	if(isset($_SESSION['report'])){
		unset($_SESSION['report']);
	}
?>