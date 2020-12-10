<?php

	session_start();






	//QR CODE =============



	$PNG_TEMP_DIR = base_url().'temp/';

    $PNG_WEB_DIR = 'temp/';



    include "QR/qrlib.php";



    //remember to sanitize user input in real-life solution !!!

    $errorCorrectionLevel = 'L';



    if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))

        $errorCorrectionLevel = $_REQUEST['level'];



    	$matrixPointSize = 4;



    if (isset($_REQUEST['size']))



        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);



		$link = "http://162.144.134.70/nekede/index.php?payment/qr_check/". $_SESSION['payeeID'];



        $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);







	$student = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();


	

	//$studPayeeID = $student->payee_id;

	//$payDetails = $this->db->get_where('eduportal_remita_payment', array("rrr" => $_SESSION['payeeID']))->row();
	$status="Not Paid";
	$payDetails2 = $this->db->get_where('invoice_gen', array("portal_id" => $student->portal_id,"session_id"=>$session))->row();
if($payDetails2->status=="Approved")
{
	$status="Paid";
}
else{
	$status="Not Paid";
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

					<img src="assets/images/logo1.jpg" />

					<p><b>FPN Student Photo Album </b></p>

				</div>
<div class="col-md-12 no-p receipt-image-div">

								
				<div class="col-md-12">

					<div class="col-md-12 no-p" ><img src="<?php echo 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg'; ?>" width="150px" height="150px" align="center" /><img src="<?php echo $filename; ?>" width="150px" height="180px" style="float: right;" />

							</div>
								

						<h3>Personal Details</h3>

						<hr />

						<div class="col-md-12 print-table">

							<table class="table table-bordered table-striped table-hover">

								<tbody>

									<tr>

										<td><p>Portal ID</p></td>

										<td><p><?php echo $student->portal_id; ?></p></td>

									</tr>

									
									<tr>

										<td><p>Full Name</p></td>

										<td><p><?php echo ucwords(strtolower($student->name) . ' ' . strtolower($student->othername) ); ?></p></td>

									</tr>

									<tr>

										<td><p>Sex</p></td>

										<td><p><?php echo $student->sex; ?></p></td>

									</tr>

									<tr>

										<td><p>Date Of Birth</p></td>

										<td><p><?php echo $student->birthday; ?></p></td>

									</tr>

									<tr>

										<td><p>Place Of Origin</p></td>

										<td><p>

											<?php 

												if($student->nationality == 'Nigeria'){

													echo $origin->lga . ', &nbsp; ' . $origin->state . ' State'; 

												}else{

													echo $student->nationality;

												}

											?>

										</p>
										</tr>
										<tr>

										<td><p>Semester</p></td>

										<td><p><?php echo $semester; ?></p></td>

									</tr>
									<tr>

										<td><p>Session</p></td>

										<td><p><?php echo $session; ?></p></td>

									</tr>
									<tr>

										<td><p>Department</p></td>

										<td><p><?php echo $student_data->deptName; ?></p></td>

									</tr>
									<tr>

										<td><p>School</p></td>

										<td><p><?php echo $student_data->schoolname; ?></p></td>

									</tr>
									<tr>

										<td><p>Programme</p></td>

										<td><p><?php echo $student_data->student_type_name."(".$student_data->programme_type_name.")"; ?></p></td>

									</tr>

								</tbody>

							</table>

						</div>

						<div class="col-md-2 no-p">

							

						

						</div>

					</div>

					<div class="col-md-12 no-p">

						<table>

							<tbody>

								<tr>

									<td>

										<h3>Payment Details</h3>

									</td>

								</tr>

							</tbody>

						</table>

						<hr />

						<div class="col-md-12 print-table">
						  <table class="table table-bordered table-striped table-hover">
						    <tbody>
						     
						      <tr>
						        <td><p>Payment Status</p></td>
						        <td><p><?php echo $status; ?></p></td>
					          </tr>
					        </tbody>
					      </table>
						</div>

					</div>

					<div class="col-md-12 no-p">

						<table class="table">

							<tbody>

								<tr>

									<td>

										<div class="country-line">

											<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Thank you for choosing Federal Polytechnic Nekede</h5>

										</div>

									</td>

								</tr>

								<tr>

									<td>

										<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="http://localhost:8000/FPN_ExamPhotoCard/index.php">Close</a></p>

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