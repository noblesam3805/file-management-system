<?php 
session_start();
	$users = $this->db->where("shw",1)->get("quota_users");	
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
function incrQuota(qid){
	var
	quotaNo = document.getElementById("quotaNo"+qid).value;
$("#QuotaArea"+qid).load('<?php echo base_url().'index.php?cquota/increaseQuota/'; ?>'+qid+"/"+quotaNo)
}

//Decrease quota
function decrQuota(qid){
	var
	quotaNo = document.getElementById("quotaNo"+qid).value;
$("#QuotaArea"+qid).load('<?php echo base_url().'index.php?cquota/decreaseQuota/'; ?>'+qid+"/"+quotaNo)
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
					      <td colspan="5" align="right" valign="top"><a href="<?php echo base_url().'index.php?cquota/newUser';?>">Add New</a></td>
				        </tr>
					    <tr>
					      <td width="5%" valign="top"><h4>&nbsp;</h4></td>
					      <td width="26%" valign="top"><h4>Users</h4></td>
					      <td width="31%" valign="top"><h4><strong>Quota</strong></h4></td>
					      <td width="8%" valign="top"><h4>Status</h4></td>
					      <td width="30%" valign="top"><h4>Action</h4></td>
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
		
		
							?>
                        <tr>
					      <td valign="top"><?php echo $sn; ?></td>
					      <td valign="top"><?php echo $user->auth_one;?></td>
					      <td valign="top"><div id="QuotaArea<?php echo $user->qid;?>">

				          
					      <table width="100%">
					        <tr>
					          <td width="49%" valign="top"><?php echo $Aquota;?></td>
					          <td width="51%" align="right" valign="top"><input type="submit" name="add" id="<?php echo $user->qid;?>" value="+" onclick="incrQuota(this.id);" />
					            <input type="submit" name="decr" id="<?php echo $user->qid;?>" value="-" onclick="decrQuota(this.id);"/>
<input name="hiddenField" type="hidden" id="quotaNo<?php echo $user->qid;?>" value="<?php echo $user->quotaNo;?>" /></td>
				            </tr>
					        </table>
					      </div></td>
					      <td valign="top"><?php echo $user->status;?></td>
					      <td valign="top"><?php
						 if($_SESSION['cafeUserQid']!=$user->qid){
						   if($user->status==1){?><a href="<?php echo base_url().'index.php?cquota/accountStatus/0/'.$user->qid;?>">Block</a> <?php }
						    else{?> <a href="<?php echo base_url().'index.php?cquota/accountStatus/1/'.$user->qid;?>">Unblock</a><?php 
						   }
						   
						 }?></td>
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