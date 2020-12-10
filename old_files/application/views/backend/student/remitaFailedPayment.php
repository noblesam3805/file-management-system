<?php

	session_start();



	if(!$_SESSION['payeeID_failed']){

		$_SESSION['err_msg'] = 'Start here please!';

		redirect(base_url() . 'index.php?student/dashboard');

	}

	

	

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

		margin:20px 0 0 10px;

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

</style>



<div class="print_page">

	<div class="col-md-12">

		<div class="widget stacked">

			<div class="widget-content" style="padding:10px 20px;">

				<div class="col-md-12 receipt-head">

					<img src="images/neklogo.png" />

					<p>Fee Payment Status</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p">

					  <h3>Payment Details</h3>
						<div class="col-md-10 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>

									<tr>

										<td><p>RRR</p></td>

										<td><p><?php echo $_SESSION['payeeID_failed']; ?></p></td>

									</tr>
                                    <tr>

										<td><p>Payment Status</p></td>

										<td><p>Failed</p></td>

									</tr>

									
							  </tbody>

						  </table>

					  </div>

						
					<div class="col-md-12 no-p">

					

						<hr />

						<div class="col-md-12 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>

								

								<tr>

									<td>

										<p style="text-align:right;"><?php if( $_SESSION["ptype"]== 1){?><a href="<?php echo base_url();?>index.php?student/remitaInvoice">Return to Invoice Page</a> <?php } else {?><a href="<?php echo base_url();?>index.php?student/remita_schfee_invoice">Return to Invoice Page</a><?php }?> | <a href="<?php echo base_url();?>index.php?student/dashboard">Close</a></p>

									</td>

								</tr>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>