<?php 
session_start();

if($_SESSION['cafeUserCat']!=3){
?>
<script type="text/javascript">
history.go(-1);
</script>
<?php	
}
$report = $this->db->get_where("quota_users",array("report"=>1,"qid"=>$_SESSION['cafeUserQid']))->row();

$users = $this->db->where("cat",1)
	->where("report",1)
	->get("quota_users");	

$tJobs = 0 ;
$tRemitted = 0;
$tPending = 0;
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
<br><br>

	<div class="col-md-12">

		<div class="widget stacked">

			<div class="widget-content" style="padding:10px 20px;">

				<div class="col-md-12 receipt-head">

					<img src="assets/images/neklogo2.png" />

					<p><?php echo $page_sub_heading;?></p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<ul>
							  <li>Report						      </li>
					      </ul>
                        </div>

					</div>

					<div class="col-md-12 print-table">
					  <table width="100%" rules="all" bordercolor="#CCCCCC">
					    <tr>
					      <td width="5%" valign="top"><h4>&nbsp;</h4></td>
					      <td width="12%" valign="top"><h4>User</h4></td>
					      <td width="8%" valign="top"><h4><strong>Quota</strong></h4></td>
					      <td width="75%" valign="top"><h4>Details</h4></td>
				        </tr>
					    <?php $sn  = 0;
						foreach($users->result() as $user){
							$sn = $sn + 1;
							$totalJobs = 0;
							$totalRemit = 0;
							$totalPending = 0 ;
							//Quota info
							$quotaRec = $this->db->where("qid",$user->qid)
						->where("status",0)
						->get("quota_users_actv");
		$quota = $quotaRec->num_rows();
		$Aquota = $user->quotaNo - $quota."/".$user->quotaNo;
		
		//Details
		$det = $this->db->select("trans_date")->where("status",0)->where("qid",$user->qid)->group_by("trans_date")
		->get("quota_users_actv");
							?>
                        <tr>
					      <td valign="top"><?php echo $sn; ?></td>
					      <td valign="top"><?php echo $user->auth_one;?></td>
					      <td valign="top"><?php echo $Aquota;?></td>
					      <td valign="top"><table width="100%" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC" rules="all">
					        <tr>
					          <td width="7%" valign="top"><h4>&nbsp;</h4></td>
					          <td width="38%" valign="top"><h4><strong>Date</strong></h4></td>
					          <td width="13%" valign="top"><h4><strong>Jobs</strong></h4></td>
					          <td width="23%" valign="top"><h4><strong>No Remitted</strong></h4></td>
					          <td width="19%" valign="top"><h4><strong>Pending</strong></h4></td>
				            </tr>
                            <?php
							$sn2 = 0 ;
							foreach($det->result() as $det2){
								$sn2 = $sn2 + 1;
								$jobs = 0;
								$remit = 0;
								$trans =  $this->db->where("qid",$user->qid)->where("trans_date",$det2->trans_date)
		->get("quota_users_actv");
									foreach($trans->result() as $tran){
										$jobs = $jobs + 1;
										if($tran->status ==1){
											$remit = $remit + 1;
										}	
									}
								
								?>
					        <tr>
					          <td valign="top"><?php echo $sn2; ?></td>
					          <td valign="top"><?php echo $det2->trans_date;?></td>
					          <td valign="top"><?php echo number_format($jobs);?></td>
					          <td valign="top"><?php  echo number_format($remit);?></td>
					          <td valign="top"><?php  echo number_format($jobs - $remit);?></td>
				            </tr>
                            <?php
							$totalJobs = $totalJobs + $jobs;
							$totalRemit = $totalRemit + $remit;
							
							}
							?>
					        <tr>
					          <td colspan="2" valign="top"><h4>Total</h4></td>
					          <td valign="top"><h4><?php echo number_format($totalJobs);?></h4></td>
					          <td valign="top"><h4><?php  echo number_format($totalRemit);?></h4></td>
					          <td valign="top"><h4><?php  echo number_format($totalJobs - $totalRemit);?></h4></td>
				            </tr>
				          </table></td>
				        </tr>
                        
                        <?php
						$tJobs = $tJobs + $totalJobs;
						$tRemitted = $tRemitted + $totalRemit;
						}
						if($_SESSION['cafeUserCat']!=1){
						?><tr>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top"><table width="100%" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC" rules="all">
                            
                            <tr>
                              <td width="45%" valign="top"><h3>Grand Total</h3></td>
                              <td width="13%" valign="top"><h3><?php echo number_format($tJobs);?></h3></td>
                              <td width="23%" valign="top"><h3><?php echo number_format($tRemitted);?></h3></td>
                              <td width="19%" valign="top"><h3><?php echo number_format($tJobs - $tRemitted);?></h3></td>
                            </tr>
                          </table></td>
                        </tr>
                        <?php
						}
						?>
				      </table>
<br />
                    	<br />
					</div>

					<br />
                    	<br />

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center"></div>

	</div>

</div>