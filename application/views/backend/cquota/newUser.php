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
							  <li>Fill the necessary fields </li>
							  <li>
							    <h5> Please ensure that the information supplied is correct.</h5>
						      </li>
					      </ul>
                        </div>

					</div>

					<div class="col-md-12 print-table">
				
<?php echo form_open('cquota/pro_newUser' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<table width="48%" border="0" align="center" cellpadding="10" cellspacing="10" rules="none">
  <tbody>
    <tr>
      <td width="49%" align="right" valign="top"><label>Username</label></td>
      <td align="left" width="51%"><input name="auth_one" type="text" class="input text" id="auth_one" size="50%" maxlength="20" height="25px" required="required" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"><label>Password</label></td>
      <td align="left"><input name="auth_two" type="text" class="input password" id="auth_two" size="50%" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td align="right" valign="middle"><input name="report" type="hidden" id="report" value="2" />
        Quota</td>
      <td align="right" valign="middle"><input name="quotaNo" type="text" class="input password" id="quotaNo" size="50%" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="middle"><div class="form-item webform-component webform-component-email" id="webform-component-email">
        <input type="submit" id="edit-submit" name="op" value="Save" class="btn-primary btn form-submit" />
        </div></td>
    </tr>
  </tbody>
</table>
<br />
                    	<br />
<?php

                  echo form_close();
                    ?>
          </div>

					<br />
                    	<br />

				</div>

			</div>

		</div>

		<div class="col-md-12" style="text-align:center"></div>

	</div>

</div>