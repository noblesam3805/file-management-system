<?php
	session_start();
?>


<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="number">
				<p>1.</p>
			</div>
			<div class="page-title">
				<p>Confirm HND/ND Evening and Weekend School Fee Payment</p>
			</div>
		</div>
	</div>
	<div class="col-md-12 no-p" style="margin-top:40px;">
		<?php echo form_open('payment/processFeeConfirmation', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="col-md-8 middle no-p">
			<p style="font-size:14px; color:#820E29; margin-top:20px;">
				<?php 
					if(isset($_SESSION['payeeError'])){
						echo $_SESSION['payeeError'];
					}
				?>
				<?php 
					if(isset($_SESSION['apError'])){
						echo $_SESSION['apError'];
					}
				?>
			</p>
			<p style="font-size:16px">Enter Your payeeID and the confirmation code given to you at the bank</p>
			<div class="widget stacked">
				<div class="widget-content" style="padding:10px 20px;">
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Your Payee ID</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="payee_id" required class="form-control eduportal-input" placeholder="Enter Your Payee ID" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group eduportal-form-group p20">
								<label class="label-control" for="course name">Your Confirmation Code</label>
								<div class="input-group input-group-lg eduportal-input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
									<input type="text" name="confirm_code" required class="form-control eduportal-input" placeholder="Enter Your Confirmation Code" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group eduportal-form-group p20" style="text-align:center;">
							<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php echo form_close(); ?>
	</div>
	<div class="col-md-12" style="text-align:center">
		<img src="assets/images/etranzact_logo.png" />
	</div>
</div>
<?php
	if(isset($_SESSION['payeeError'])){
		unset($_SESSION['payeeError']);
	}
	if(isset($_SESSION['apError'])){
		unset($_SESSION['apError']);
	}
?>