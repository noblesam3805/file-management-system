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
							  <li><?php echo $page_sub_heading;?> 
						      </li>
					      </ul>
                        </div>

					</div>

					<div class="col-md-12 print-table">
					 <?php echo form_open(base_url().'index.php?student_acct/pro_sync_fee_fpno');?>
					    <table width="90%" border="0" align="center" cellpadding="10" cellspacing="10" rules="none">
					      <tbody>
					        <tr>
					          <td width="17%" align="left" valign="top"><label>
					            <input name="student_id" type="hidden" id="student_id" value="<?php echo $student_id;?>" />
				              Enter Payment Code</label></td>
					          <td align="left" width="70%"><input name="payCode" type="text" class="input text" id="payCode" size="80%" height="25px"  required="required"/></td>
					          <td align="left" width="13%" id="butt_area"><div class="form-item webform-component webform-component-email" id="webform-component-email">
					            <input name="op" type="submit" class="btn-primary btn form-submit" id="edit-submit" value="Search" />
					            </div></td>
				            </tr>
				          </tbody>
				        </table>
				     <?php echo form_close();?>
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