
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('sadmin/processSpecialReservation', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="widget stacked">
			<div class="widget-header">
				<h3 style="line-height:0px !important;">Assign Special Accommodation to students</h3>
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
							<label class="label-control" for="course name">Student Reg No</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="id" required class="form-control eduportal-input" placeholder="Enter Reg No" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Hostel Name</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="hostel" required class="form-control eduportal-input" placeholder="Enter Hostel Name [Eg: HOSTEL A]" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6 no-p">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Room Number</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="room" type="number" required class="form-control eduportal-input" placeholder="Enter Room Number [Eg: 2]" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
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
					
				</div>
				<div class="col-md-12">
					<div class="col-md-6 no-p">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Serial</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="serial" required class="form-control eduportal-input" placeholder="Enter Card Serial" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group eduportal-form-group p20">
							<label class="label-control" for="course name">Pin</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input name="pin" required class="form-control eduportal-input" placeholder="Enter Card Pin" />
							</div>
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