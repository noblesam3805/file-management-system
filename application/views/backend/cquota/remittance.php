<?php 
session_start();
	$users = $this->db->where("qid",$qid)->get("quota_users");	
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
<script language="javascript" type="text/javascript">
function remit(qid){
	
	var
	trans_dateID = document.getElementById("pending_"+qid).value;
	number = document.getElementById("number_"+qid).value;
	
$("#feedBack").load('<?php echo base_url().'index.php?cquota/pro_remit/'; ?>'+qid+"/"+trans_dateID+"/"+number)
}

</script>

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
					  <table width="60%" align="center" bordercolor="#CCCCCC" rules="all">
					    <tr>
					      <td colspan="6" valign="top"><div id="feedBack"></div></td>
				        </tr>
					    <tr>
					      <td width="5%" valign="top"><h4>&nbsp;</h4></td>
					      <td width="21%" valign="top"><h4>Users</h4></td>
					      <td width="42%" valign="top"><h4><strong>Quota</strong></h4></td>
					      <td colspan="3" valign="top"><h4>Pending</h4></td>
				        </tr>
					    <?php $sn  = 0;
						foreach($users->result() as $user){
							$sn = $sn + 1;
													//Quota info
							$quotaRec = $this->db->where("qid",$user->qid)
						->where("status",0)
						->get("quota_users_actv");
		$quota = $quotaRec->num_rows();
		$Aquota = $user->quotaNo - $quota."/".$user->quotaNo;
		
		
		$quotaRec2 = $this->db->where("qid",$user->qid)
						->where("status",0)
						->group_by("trans_date")
						->get("quota_users_actv");
							?>
                        <tr>
					      <td valign="top"><?php echo $sn; ?></td>
					      <td valign="top"><?php echo $user->auth_one;?></td>
					      <td valign="top"><?php echo $Aquota;?></td>
					      <td width="8%" valign="top"><label for="pending"></label>
					        <select name="pending" id="pending_<?php echo $user->qid;?>">
                            <?php
							foreach($quotaRec2->result() as $pending){
								$number = $this->db->where("qid",$user->qid)
						->where("status",0)
						->where("trans_date",$pending->trans_date)
						->get("quota_users_actv");
								?>
                            <option value="<?php echo $pending->aid;?>"><?php echo $pending->trans_date;?> - <?php echo number_format($number->num_rows());?></option>
                            <?php
							}
							?>
			              </select>
					        <label for="number"></label></td>
					      <td width="10%" valign="top"><select name="number" id="number_<?php echo $user->qid;?>">
					        <option value="1">1</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					        <option value="5">5</option>
					        <option value="6">6</option>
					        <option value="7">7</option>
					        <option value="8">8</option>
					        <option value="9">9</option>
					        <option value="10">10</option>
					        <option value="11">11</option>
					        <option value="12">12</option>
					        <option value="13">13</option>
					        <option value="14">14</option>
					        <option value="15">15</option>
					        <option value="16">16</option>
					        <option value="17">17</option>
					        <option value="18">18</option>
					        <option value="19">19</option>
					        <option value="20">20</option>
				          </select></td>
					      <td width="14%" valign="top"><span class="pointers" id="<?php echo $user->qid;?>" onclick="remit(this.id);">Remit</span></a></td>
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