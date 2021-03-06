<?php session_start(); 

//$payment_types = $this->db->get_where('eduportal_remita_payment_types')->result_array();
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
<div class="col-md-10 middle">
	<div class="col-md-12 no-p">
		<div class="step-bar">
			<div class="number">
				<p>1.</p>
			</div>
			<div class="page-title">
				<p>Fees Receipt Confirmation</p>
			</div>
		</div>
	</div>
	<div class="col-md-12" style="min-height:30px !important;"></div>
		
	<div class="col-md-12 no-p">
		<div class="col-md-8 middle" style="margin-top:10px;">
			<div class="widget stacked">
				<div class="widget-content" style="padding:10px 20px;">
					<p style="hp font-size:14px; color:#820E29; margin-top:20px;">
						<?php 
							if(isset($_SESSION['err_msg'])){
								echo $_SESSION['err_msg'];
							}
						?>
					</p>
					<div class="col-md-12" id="">
						<div class="widget stacked">
							<div class="widget-content" style="padding:10px 20px;">
								<?php //putme/continueRegistration ?>								<a href="http://erp.yabatech.edu.ng/portal/index.php?register/pay_acp_fees">Click Here for 2019/2020 Acceptance Fee Receipt</a>
								<?php echo form_open('register/processRemitaReceipt', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>
								<div class="col-md-12">
									<div class="form-group eduportal-form-group p20">
										<label class="label-control" for="course name">Your Invoice No (RRR)</label>
										<div class="input-group input-group-lg eduportal-input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
											<input type="text" name="rrr" required class="form-control eduportal-input" placeholder="Enter Invoice No (RRR)"/> 
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group eduportal-form-group p20 text-center">
										<button type="submit" name="" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Continue</button>
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
