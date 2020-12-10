<script>

function newDoc() {

    window.location.assign("<?php echo base_url();?>index.php?login/logout")

}

</script>



<?php

	session_start();



	if($this->session->userdata('regno') == ''){

		$_SESSION['serror'] = 'Start here please!';

		redirect(base_url());

	}



	$regno = $this->session->userdata('regno');

	$session = $this->session->userdata('session');



	$student = $this->db->query("SELECT * FROM prehnd_students where putme_id = "."'$regno'"."")->row();

	

	//$amount = $this->db->get_where('eduportal_remita_details', array("type" => 'acceptance_fee_amount'))->row();

	

	$details = $this->db->get_where('eduportal_remita_temp_data', array("reg_no" => $regno,"session"=> $session))->row();

	

	

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

	strong {

        color: #000000;

        font-size: 16px;

        font-weight: bold;

    }

</style>



<div class="print_page">

	<div class="col-md-12">

		<div class="widget stacked">

			<div class="widget-content" style="padding:10px 20px;">

				<div class="col-md-12 receipt-head">

					<img src="images/neklogo.png" />

					<p><?=$session?> School Fees Printout For Bank Payment</p>

					<strong><p align="center">Order ID: <?=$details->order_id?></p></strong>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please Note that this print out is only an invoice for bank payment.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">

						<table class="table table-bordered table-striped table-hover">

							<tbody>

								<tr>

									<td><p>Remita Retrieval Reference</p></td>

									<td><p><?php echo $details->rrr; ?></p></td>

								</tr>

								<tr>

									<td><p>Portal ID</p></td>

									<td><p><?=$details->reg_no?></p></td>

								</tr>





				

								<tr>

									<td><p>Full Name</p></td>

									<?php if(substr($regno, 0, 4) == 'PHND'){?>

									<td><p><?php echo $student->title . ' ' . ucwords(strtolower($student->firstname) . ' ' . strtolower($student->middlename) . ' ' . strtolower($student->lastname)); ?></p></td>

									<?php }elseif(substr($regno, 0, 3) == 'FPN'){ ?>

									<td><p><?php echo $details->fullname; ?></p></td>

									<?php } ?>

								</tr>

							

						

								<tr>

									<td><p>School</p></td>

									<td><p><?=$details->school?></p></td>

								</tr>

								<tr>

									<td><p>Department</p></td>

									<td><p><?=$details->department?></p></td>

								</tr>

			

					

			

								<tr>

									<td><p>Level</p></td>

									<td><p><?=$details->level?></p></td>

								</tr>

								<tr>

									<td><p>Phone Number</p></td>

									<td><p><?=$details->phone; ?></p></td>

								</tr>

								<tr>

									<td><p>Amount</p></td>

									<td><p><?php echo 'N '.number_format(floatval($details->amount),2); ?></p></td>

								</tr>

							</tbody>

						</table>

					</div>

					<div class="col-md-12 no-p">

						<div class="country-line">

							<h5>Thank you for choosing Federal Polytechnic Nekede</h5>

						</div>

						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a onclick="newDoc()">Exit</a></p>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center">

			<img src="assets/images/remitalogo.png" />

		</div>

	</div>

</div>
