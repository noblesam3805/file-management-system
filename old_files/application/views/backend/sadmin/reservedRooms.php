
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('sadmin/hostelAllocation/doAllocation', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="widget stacked">
			<div class="widget-header">
				<h3 style="line-height:0px !important;">Assign Reserved Accommodation to students</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php
					if(isset($_SESSION['error'])){ ?>
						<p style="color:#9d0000; font-size:15px;"><?php echo $_SESSION['error']; ?></p>
					<?php }
				?>
				<?php
					if(isset($_SESSION['success'])){ ?>
						<p style="color:#328C4D; font-size:15px; text-align:center;"><?php echo $_SESSION['success']; ?></p>
					<?php }
				?>
				<div class="col-md-12">
					<div class="col-md-6 no-p">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Student Portal ID</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="id" required class="form-control eduportal-input" placeholder="Enter Portal ID [ Eg AVN15123456 ]" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Accommodation</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select name="accommodation" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
									<?php foreach($rooms as $room => $val): ?>
									<option value="<?php echo $val['hostel_name'] . '/' . $val['room']; ?>"><?php echo $val['hostel_name'] . ' ROOM ' . $val['room']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name">Space</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select name="space" required class="form-control eduportal-input">
									<option value="">Select An Option</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
									<option value="4">Four</option>
									<option value="5">Five</option>
									<option value="6">Six</option>
									<option value="7">Seven</option>
									<option value="8">Eight</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Serial</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="serial" required class="form-control eduportal-input" placeholder="Enter Card Serial" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group eduportal-form-group p20">
						<label class="label-control" for="course name">Pin</label>
						<div class="input-group input-group-lg eduportal-input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
							<input name="pin" required class="form-control eduportal-input" placeholder="Enter Card Pin" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group eduportal-form-group p20" style="text-align:center;">
						<label>&nbsp;</label>
						<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-send"></i> &nbsp; Assign Room To Student</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php
	if(isset($_SESSION['error']))
		unset($_SESSION['error']);
	
	if(isset($_SESSION['success']))
		unset($_SESSION['success']);
?>