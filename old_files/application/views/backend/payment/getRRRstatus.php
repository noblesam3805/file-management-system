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

<div class="col-md-10 middle">

	<div class="col-md-12" style="min-height:30px !important;"></div>

		

	<div class="col-md-12 no-p">

		<div class="col-md-8 middle" style="margin-top:10px;">

			<div class="widget stacked">

				<div class="widget-content" style="padding:10px 20px;">

					<h4 style="text-align:center;">Get RRR Status</h4>

					<hr />

						<?php 

							if(isset($_SESSION['rrr'])){ ?>

								<p style="font-size:15px; color:#27764F; font-weight:bold; margin:10px 0px; text-align:center; background:#f5f5f5; padding:10px; border:1px solid #ccc;">

									<?php echo 'RRR Number: ' . $_SESSION['rrr'] . '</br>. Status: ' . $_SESSION['msg'] . ' </br>orderID: ' . $_SESSION['oid'] . ' </br>date ' . $_SESSION['date']; ?> 

								</p>

								<hr />

						<?php }else{ ?>

						

							<p style="font-size:15px; color:#27764F; font-weight:bold; margin:10px 0px; text-align:center; background:#f5f5f5; padding:10px; border:1px solid #ccc;">

								<?php echo 'RRR Number: ' . $_SESSION['rrr2'] . '. Status: RRR Doesn\'t exists'; ?> 

							</p>

							<hr />

							

						<?php } ?>

					<div class="col-md-12" id="">

						<div class="widget stacked">

							<div class="widget-content" style="padding:10px 20px;">

								<?php //putme/continueRegistration ?>

								<?php echo form_open('payment/getRRRstatus', array('class' => 'form-groups-bordered validate','target'=>'_top')); ?>

								<div class="col-md-12">

									<div class="form-group eduportal-form-group p20">

										<div class="input-group input-group-lg eduportal-input-group">

											<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>

											<input type="text" name="rrr" required class="form-control eduportal-input" placeholder="Enter RRR"/> 

										</div>

									</div>

								</div>

								<div class="col-md-12">

									<div class="form-group eduportal-form-group p20">

										<button type="submit" name="" style="width:100px;padding:10px; 35px" class="btn btn-info"> &nbsp; Get Status</button>

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

</div>

<?php 

	if(isset($_SESSION['apError'])){

		unset($_SESSION['apError']);

	}

?>

