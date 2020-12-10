<?php session_start(); ?>
<div class="col-md-12 no-p">
	
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Late Payment To Bursary</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processBursaryPayment'; ?>"  id="uploadForm">
					<div class="col-md-12 no-p">
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Student Reg No</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="regno" required class="form-control eduportal-input" placeholder="Enter Reg No"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Receipt No</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="receiptno" required class="form-control eduportal-input" placeholder="Receipt No"/>
								</div>
							</div>
						</div>
					</div> 
					<div class="col-md-12 no-p">
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Cheque No</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="chequeno" required class="form-control eduportal-input" placeholder="Enter Reg No"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Payment Type</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<select name="type" required class="form-control eduportal-input">
										<option value="">Select An Option</option>
										<option value="1ST YEAR">Select An Option</option>
										<option value="1ST YEAR">1ST YEAR</option>
										<option value="2ND YEAR">2ND YEAR</option>
										<option value="3RD YEAR">3RD YEAR</option>
										<option value="4TH YEAR">4TH YEAR</option>
										<option value="5TH YEAR">5TH YEAR</option>
									</select>
								</div>
							</div>
						</div>
					</div> 
					<div class="col-md-12 no-p">
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Amount Paid</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="amount" required class="form-control eduportal-input" placeholder="Enter Amount"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Session</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="session" required class="form-control eduportal-input" placeholder="Enter Amount"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-6">
							<div class="form-group eduportal-form-group">
								<label class="label-control" for="course name">Payment Date</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="date" required class="form-control eduportal-input datepicker" data-start-view="2" placeholder="Payment Date"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="submit" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Process Payment</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



