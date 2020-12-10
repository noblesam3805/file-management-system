<?php  ?>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="col-md-1 no-p">
				<div class="number">
					<p>01</p>
				</div>
			</div>
			<div class="col-md-11 no-p">
				<div class="page-title">
					<p>Staff Registration</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12" style="min-height:30px !important;"></div>
		
	<div class="col-md-12 no-p">
		<div class="col-md-10 middle">
			<div class="widget stacked">
				<div class="widget-header">
					<h3>Start Registration </h3>
				</div>
				<div class="widget-content" style="padding:10px 20px;">
					<p style="font-size:14px; color:#820E29; margin-top:20px;">
						<?php 
							if(isset($_SESSION['serror'])){
								echo $_SESSION['serror'];
							}
						?>
					</p>
					<div class="col-md-6">
						<p style="padding:5px; background:#DEDEDE; min-height:30px; border-radius:2px; border:1px solid #c0c0c0;">
							<a style="padding:5px; font-size:18px; line-height:30px; text-decoration:none; color:#504C4C;" href="javascript:void(0)" id="startReg">
								 &nbsp; Start A New Registration <span class="glyphicon glyphicon-collapse-down" style="float:right; margin-top:7px; color:#999; margin-right:10px;"></span>
							</a>
						</p>
						<div class="col-md-12" id="startform" style="display:none;">
							<?php echo form_open('staff_registration/setStudentSession', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
							<div class="col-md-12">
								<div class="form-group eduportal-form-group">
									<label class="label-control" for="course name">Select Staff Type </label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<select name="programme" required class="form-control eduportal-input">
											<option value="JUNIOR">JUNIOR STAFF</option>
											<option value="SENIOR">SENIOR STAFF</option>
                                        
                                           
											<!--option value="Direct">DIRECT ENTRY</option--> 
										</select>
									</div>
								</div>
									<div class="form-group eduportal-form-group">
									<label class="label-control" for="course name"> File No/Staff ID.</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="regno" required class="form-control eduportal-input" placeholder=""/>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group eduportal-form-group">
									<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Start Registration</button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					
					<div class="col-md-6">
						<p style="padding:5px; background:#DEDEDE; min-height:30px; border-radius:2px; border:1px solid #c0c0c0; ">
							<a style="padding:5px; font-size:18px; line-height:30px; text-decoration:none; color:#504C4C;" href="javascript:void(0)" id="continueReg">
								 &nbsp; Reprint Slip <span class="glyphicon glyphicon-collapse-down" style="float:right; margin-top:7px; color:#999; margin-right:10px;"></span>
							</a>
						</p> 
						<div class="col-md-12 no-p" id="continueform" style="display:none;">
							<?php echo form_open('staff_registration/reprintSlip', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
							<div class="col-md-12 no-p">
								<div class="form-group eduportal-form-group">
									<label class="label-control" for="course name">Your File No.</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="file_no" required class="form-control eduportal-input" placeholder=""/>
									</div>
								</div>
							</div>
							<div class="col-md-12 no-p">
								<div class="form-group eduportal-form-group">
									<button type="submit" name="" style="width:150px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
