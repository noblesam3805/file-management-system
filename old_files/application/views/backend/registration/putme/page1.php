<?php session_start(); ?>
<style type="text/css">
	.foreign-form{
		display:none;
	}
	.country-line{
		float:left;
		width:100%;
		padding:10px;
		background:#DEDEDE;
		margin:20px 0 0 0;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line input[type=radio]{
		background-image :    -moz-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :     -ms-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :      -o-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image : -webkit-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  		background-image :         linear-gradient(rgb(224,224,224),rgb(240,240,240));
		width:20px;
		height:20px;
		font-size:22px;
	}
	
</style>
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
					<p>Payment Confirmation</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" style="margin-bottom:20px;">
			<div class="col-md-12 country-line" style="margin-top:20px !important;">
				<span style="color:#820E29;">NOTE:</span> Use your phone number, using repeated phone numbers is not allowed. Your phone number has to follow the specified format. <span style="color:#820E29;">Eg: 08187023893</span>
			</div>
		</div>
		<p style="font-size:14px; color:#820E29; text-align:center;margin-top:20px;">
			<?php 
				if(isset($_SESSION['error'])){
					echo $_SESSION['error'];
				}
			?>
		</p>
		<?php echo form_open('putme/confirm_payment', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
		<div class="col-md-6 no-p">
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Serial Number</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" name="serial" required class="form-control eduportal-input" placeholder="Enter Serial Number"/>
				</div>
			</div>
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Enter Pin</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" name="pin" required class="form-control eduportal-input" placeholder="Enter Pin"/>
				</div>
			</div>
		</div>
		<div class="col-md-6 no-p">
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Jamb Reg No / Matric No</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" name="jamb" required class="form-control eduportal-input" placeholder="Enter Jamb Reg No / Matric No"/>
				</div>
			</div>
			<div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">Phone Number</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" name="phone" maxlength="11" required class="form-control eduportal-input" placeholder="Phone Number [ 08187023893 ]"/>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group eduportal-form-group p20" style="text-align:center;">
				<label>&nbsp;</label>
				<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php
	if(isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
?>