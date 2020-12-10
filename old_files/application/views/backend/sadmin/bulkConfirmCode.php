<?php session_start(); ?>
<div class="col-md-12 no-p">
	<div class="col-md-6">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Upload Bulk Confirm Codes for 2015/2016 payments</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success3'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success1']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment2'; ?>" enctype="multipart/form-data" id="uploadForm">
					<div class="col-md-6 photo">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" data-trigger="fileinput">
								<h4>CSV File For Upload</h4>
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 100px; height: 100px" ></div>
							<div>
								<span class="btn btn-info btn-file">
									<span class="fileinput-new">Select File</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" required name="csvFile">
								</span>
								<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="uploadFile" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Upload Excel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Process Single Confirm Codes for 2015/2016 payments</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success2'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success1']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment3'; ?>" enctype="multipart/form-data" id="uploadForm">
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name">Enter Confirmation Code</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="conf" required class="form-control eduportal-input" placeholder="Enter Confirmation Code"/>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="uploadFile" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Process Payment</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12 no-p">	
	<div class="col-md-6">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Moses, this is for you. All thoses student with old payment issues.</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success1'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success1']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment4'; ?>" enctype="multipart/form-data" id="uploadForm">
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name">Enter Confirmation Code</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="conf" required class="form-control eduportal-input" placeholder="Enter Confirmation Code"/>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="uploadFile" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Process Payment</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php /*



	<div style="<?php if(isset($_SESSION['msg']) && $_SESSION['msg'] == 'Error!!!'){echo 'color:red';}else{echo 'color:green';} ?>"><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg'];} ?></div>
	<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment2'; ?>" enctype="multipart/form-data" id="uploadForm">
		<span class="h3">Upload Excel File</span>
		<input type="file" required style="margin-bottom:20px" name="csvFile"/>
		<input type="submit" value="Upload File" name="uploadFile"/>
	</form>
	
	
	<hr />
	<h3> For Single Upload </h3>
	<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment3'; ?>" id="uploadForm">
		<span class="h3">Enter Confirmation Code</span>
		<input type="text" required style="margin-bottom:20px" name="conf"/>
		<input type="submit" value="Upload File" name="uploadFile"/>
	</form>
	<hr />
	<h3> Moses, this is for you. All thoses student with old payment issues. </h3>
	<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processEtranzactPayment4'; ?>" id="uploadForm">
		<span class="h3">Enter Confirmation Code</span>
		<input type="text" required style="margin-bottom:20px" name="conf"/>
		<input type="submit" value="Upload File" name="uploadFile"/>
	</form>
	
 */ ?>