<?php session_start(); 

$payment_types = $this->db->get_where('eduportal_remita_payment_types')->result_array();
?>
<style type="text/css">
	.row{
		margin-left:0px !important;
		padding:10px 0px 0px 0px;
	}
	thead{
	}
	#nceLink, degreeLink{
		cursor:pointer;
	}
	.nav-tabs.bordered{
		margin:0px 15px !important;
	}
	.tab-content{
		padding:0px 15px !important;
		border:none !important;
	}
	.foreign-form{
		display:none;
	}
	.country-line{
		padding:5px;
		background:#DEDEDE;
		margin:5px 0 0 10px;
		border:1px solid #999999;
		box-shadow:1px 1px 1px #DEDEDE;
	}
	.country-line span{
		color:#CB4A18;
		font-size:19px;
		margin-left:10px;
	}
	.country-line h5{
		margin:5px 0;
	}
	.dispage ul{
		list-style-type:circle;
	}
	.dispage ul li{
		font-size:17px;
		margin-top:10px;
		line-height:27px;
		border-bottom:1px dashed #d1d1d1;
		padding-bottom:7px;
	}
</style>
<?php if(isset($_SESSION['apError'])){ ?>
	<script type="text/javascript">
	$( document ).ready(function() {
	    $(".viewForm").hide();
	});
	</script>
<?php } ?>
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="number">
				<p>1.</p>
			</div>
			<div class="page-title">
				<p><?=$page_title?> 2015/2016 Students</p>
			</div>
		</div>
	</div>
	<div class="col-md-12" style="min-height:30px !important;"></div>
		
	<div class="col-md-12 no-p">
		<div class="col-md-8 middle" style="margin-top:10px;">
			<div class="widget stacked viewForm">
				<div class="widget-content" style="padding:10px 20px;">
					<p style="hp font-size:14px; color:#820E29; margin-top:20px;">
						<?php 
							if(isset($_SESSION['apError'])){
								echo $_SESSION['apError'];
							}
						?>
					</p>
					<div class="col-md-12" id="">
						<div class="widget stacked">
							<div class="widget-content" style="padding:10px 20px;">
								<?php //putme/continueRegistration ?>
								<?php echo form_open('payment/res_new_student', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
								<div class="col-md-6">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Your Portal ID/ APPLICATION NO</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<input type="text" name="putmeID" required class="form-control eduportal-input" placeholder="Enter Portal ID/APPLICATION NO"/>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Remita RRR</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<input type="text" name="rrr" required class="form-control eduportal-input" placeholder="e.g A130000..."/>
										</div>
									</div>
								</div>
								<!--div class="col-md-12">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Payment Type</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<select name="paytype" class="form-control eduportal-input">
												<option value="">Select An Option</option>
												<?php foreach($payment_types as $type => $val): ?>
												<option value="<?php echo $val['payment_type']; ?>"><?php echo $val['payment_type']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div-->
								<div class="col-md-12">
									<div class="form-group text-center">
										<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-success">Submit</button>
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
	<div class="col-md-12" style="text-align:center">
		<img src="assets/images/remitalogo.png" />
	</div>
</div>
<?php 
	if(isset($_SESSION['apError'])){
		unset($_SESSION['apError']);
	}
?>
