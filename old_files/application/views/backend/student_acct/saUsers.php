<?php 
session_start();
	$users = $this->db->get("student_acct_users");	
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
			  <div class="col-md-12">

			  <div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<ul>
							  <li><?php echo $page_sub_heading;?></li>
					      </ul>
                        </div>

					</div>

					<div class="col-md-12 print-table">
					  <table width="60%" align="center" bordercolor="#CCCCCC" rules="all">
					    <tr>
					      <td colspan="4" align="right" valign="top"><a href="<?php echo base_url().'index.php?student_acct/newUser';?>">Add New</a></td>
				        </tr>
					    <tr>
					      <td width="7%" valign="top"><h4>&nbsp;</h4></td>
					      <td width="49%" valign="top"><h4>Users</h4></td>
					      <td width="14%" valign="top"><h4>Status</h4></td>
					      <td width="30%" valign="top"><h4>Action</h4></td>
				        </tr>
					    <?php $sn  = 0;
						foreach($users->result() as $user){
							$sn = $sn + 1;
													
		
		
							?>
                        <tr>
					      <td valign="top"><?php echo $sn; ?></td>
					      <td valign="top"><?php echo $user->auth_one;?></td>
					      <td valign="top"><?php echo $user->status;?></td>
					      <td valign="top"><?php
						 if($_SESSION['SA_userSaid']!=$user->said){
						   if($user->status==1){?><a href="<?php echo base_url().'index.php?student_acct/accountStatus/0/'.$user->said;?>">Block</a> <?php }
						    else{?> <a href="<?php echo base_url().'index.php?student_acct/accountStatus/1/'.$user->said;?>">Unblock</a><?php 
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