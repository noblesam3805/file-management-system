<?php session_start(); ?>
<div class="col-md-12 no-p">
	
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Register Screened Students</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/registerScreenedStudents'; ?>"  id="uploadForm">
					<div class="col-md-12 no-p">
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Enter Student Putme ID</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="putmeID" required class="form-control eduportal-input" placeholder="Enter Student Putme ID"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="submit" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Proceed</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



