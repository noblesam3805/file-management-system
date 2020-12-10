<?php
	session_start();

	if(!isset($_SESSION['desig'])){
		redirect(base_url() . 'index.php?registration/logout');
	}

	//QR CODE =============

	$PNG_TEMP_DIR = base_url().'temp/';
    $PNG_WEB_DIR = 'temp/';

$staffpub = $this->db->query("select* from staff_publications where staff_no='".$staff->comp_number."'")->row();
   include "QR/qrlib.php";

//    //remember to sanitize user input in real-life solution !!!
//    $errorCorrectionLevel = 'L';
//
   if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
       $errorCorrectionLevel = $_REQUEST['level'];

   	$matrixPointSize = 4;

   if (isset($_REQUEST['size']))

       $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

		$link = "https://iportal.ebsu.edu.ng/portal/index.php?staff_registration/qr_check/" . $staff->staff_id;

       $filename = 'temp/putme'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
       QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	
?>
<style type="text/css">
	.country-line{
		float:left;
		width:100%;
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
					<img src="images/ebsulogo.png" />
					<p><b><?php echo  'EBSU ICT Database/Biometric Unit'; ?></b></p>
                    <p><?php echo  ucwords(strtolower($staff->staff_type)).' Staff Biodata Print Out'; ?></p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<table>
								<tbody>
									<tr>
										<td>
											<h3>Personal Details</h3> 
										</td>
									</tr>
								</tbody>
							</table>
							<hr />
						</div>
						<div class="col-md-10 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>Computer Number</p></td>
										<td><p><?php echo $staff->comp_number; ?></p></td>
									</tr>
									<tr>
										<td><p>Full Name</p></td>
										<td><p><?php echo ucwords(strtolower($staff->surname) . ' ' . strtolower($staff->firstname). ' ' . strtolower($staff->middlename)); ?></p></td>
									</tr>
									<tr>
										<td><p>Sex</p></td>
										<td><p><?php echo $staff->sex; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of Birth</p></td>
										<td><p><?php echo $staff->birthday; ?></p></td>
									</tr>
									<tr>
										<td><p>Phone</p></td>
										<td><p><?php echo $staff->phone; ?></p></td>
									</tr>
									<tr>
										<td><p>Place Of Origin</p></td>
										<td><p>
											<?php 
												if($staff->nationality == 'Nigeria' || $staff->nationality == 'Nigerian'){
													echo $staff->lga . ', &nbsp; ' . $staff->state . ' State'; 
												}else{
													echo $staff->nationality;
												}
											?>
										</p></td>
									</tr>
                              
                                    </tbody>
							</table>
						</div>
						<div class="col-md-2 no-p">
							<div class="col-md-12 no-p receipt-image-div">
								<img src="<?php echo 'staff/uploads/staff_image/' . $staff->photo . '.jpg'; ?>" width="150px" height="150px" />
							</div>
							
						</div>
					</div>
					<div class="col-md-12 no-p">
						<div class="col-md-12">
							<h3>Employment Details</h3>
						</div>
						<div class="col-md-12 print-table">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<tr>
										<td><p>File Number</p></td>
										<td><p><?php echo $staff->file_number; ?></p></td>
									</tr>
                                    <tr>
										<td><p>Staff Type</p></td>
										<td><p><?php echo $staff->staff_type; ?></p></td>
									</tr>
									<tr>
										<td><p>Date Of First Employment/Rank</p></td>
										<td><p><?php echo ucwords(strtolower($staff->date_first_employment) . " - " . strtolower($staff->rank_on_appointment)); ?></p></td>
									</tr>
                                      <?php if($staff->staff_type=="SENIOR")
									{?>
									<tr>
										<td><p>Present Rank/Date</p></td>
										<td><p><?php echo ucwords(strtolower($staff->present_rank_date) ); ?></p></td>
									</tr>
                                    <tr>
										<td><p>Contendiss/Conpcass</p></td>
										<td><p><?php echo ucwords(strtolower($staff->staff_category) ); ?></p></td>
									</tr>
                                    <? } else {?>
                                    <tr>
										<td><p>Present Rank/Date</p></td>
										<td><p><?php echo ucwords($staff->present_rank.' '.$staff->present_rank_date ); ?></p></td>
									</tr>
                                    <?php }?>
                                    
									<tr>
										<td><p>Salary Grade</p></td>
										<td><p><?php echo ucwords(strtolower($staff->salary_grade)); ?></p></td>
									</tr>
                                    	<tr>
										<td><p>Salary Step</p></td>
										<td><p><?php echo ucwords(strtolower($staff->salary_step)); ?></p></td>
									</tr>
                                      <?php if($staff->staff_type=="SENIOR")
									{?>
									<!--<tr>
										<td><p>Qualifications/Courses</p></td>
										<td><p><?php echo $staff->qualifications; ?></p></td>
									</tr>-->
                                    <?php }?>
                                    <tr>
										<td><p>Qualifications With Date</p></td>
										<td><p><?php echo $staff->entry_qualification; ?></p></td>
									</tr>
                                    <tr>
										<td><p>School/Department</p></td>
										<td><p><?php echo ucwords(strtolower($staff->staff_school) . " - " . strtolower($staff->staff_dept)); ?></p></td>
									</tr>
                                    <?php if($staff->staff_type=="SENIOR")
									{?>
                                    <tr>
										<td><p>Pubication With Dates</p></td>
										<td><p><?php echo $staff->publications; 
										if($staff->publications != "")
										{
											
											?>
                                            <a href="http://iportal.ebsu.edu.ng/uploads/staff_publications/<?php echo $staffpub->publication_file;?> ">Click to download Publication File</a>
                                            <?php
										}
										?></p></td>
									</tr>
                                    <?php }?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12 no-p">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<div class="col-md-12 no-p receipt-qrcode-div">
								<img src="<?php echo $filename; ?>" width="150px" height="150px" />
								
							</div>
									</td>
								</tr>
								<tr>
									<td>
										<p style="text-align:right;">
											<button class="btn btn-default" onclick="javascript:window.location.href = '<?php echo base_url() . "index.php?staff_registration/pre_registration"; ?>'">
												<i class="glyphicon glyphicon-remove"></i> &nbsp;Close
											</button>
										</p>
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
