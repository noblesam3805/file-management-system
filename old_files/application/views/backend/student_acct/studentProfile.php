<?php
$info = $this->db->get_where("student",array("student_id"=>$student_id))->row();
$dept = $this->db->get_where("department",array("deptID"=>$info->dept))->row();
$sch = $this->db->get_where("faculty",array("faculty_id"=>$info->school))->row();
$prog = $this->db->get_where("programme_type",array("programme_type_id"=>$info->prog_type))->row();

$fee = $this->db->where("regno",$info->reg_no)
->where("payment_amount !=''")
->where("payment_amount >0")
->order_by("payment_fee_type")
				->get("eduportal_fees_payment_log");
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

							
							    <table width="100%" rules="none">
							      <tr>
							        <td width="65%" valign="top"><ul>
							  <li><?php echo $page_sub_heading;?> 
						      </li>
							  <li>=======================</li>
							  <li><?php echo $info->name.", ".$info->othername;?> - <?php echo $info->phone;?></li>
							  <li><?php echo $info->reg_no;?></li>
							  <li><?php echo $dept->deptName;?>[<?php echo $sch->faculty_code;?>]</li>
							  <li><?php echo $prog->programme_type_name;?>  </li>
		                  </ul></td>
							        <td width="35%" align="center" valign="top"><img src="<?php echo 'uploads/student_image/' . $info->student_id. '.jpg'; ?>" width="100" height="100" /></td>
						          </tr>
							      <tr>
							        <td valign="top"><a href="<?php echo base_url().'index.php?student_acct/mergerAcct/'.$student_id;?>">Merge Accounts (Application No. and Reg No.)</a> | <a href="<?php echo base_url().'index.php?student_acct/sync_fee/'.$student_id;?>">Sync Payment from other accounts</a></td>
							        <td align="center" valign="top">&nbsp;</td>
						          </tr>
						        </table>
							
                </div>

				</div>

					<div class="col-md-12 print-table">
				
<table width="98%" border="0" align="left" cellpadding="10" cellspacing="10" rules="all" bordercolor="#CCCCCC">
  <tbody>
    <tr>
      <td width="5%" align="left" valign="top"><h4>&nbsp;</h4></td>
      <td width="22%" align="left" valign="top"><h4><strong>Payment Code</strong></h4></td>
      <td width="14%" align="left" valign="top"><h4><strong>Amount =N=</strong></h4></td>
      <td width="22%" align="left" valign="top"><h4><strong>Fee</strong></h4></td>
      <td width="10%" align="left" valign="top"><h4><strong>Session</strong></h4></td>
      <td width="10%" align="left" valign="top"><h4><strong>Level</strong></h4></td>
      <td width="17%" align="left" valign="top"><h4><strong>Date of Payment</strong></h4></td>
    </tr>
    <?php
	$sn = 0;
	$feeTotal = 0;
	foreach($fee->result() as $feeData){
	 $sn = $sn + 1;
	 
	 $x1++; 
			$class1 = ($x1%2 == 0)? 'odd': 'even'; 
			
		$feeType = $this->db->get_where("payment_fee_type",array("payment_fee_type"=>$feeData->payment_fee_type))->row();
			?>
    <tr>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $sn;?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $feeData->payment_code;?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo number_format($feeData->payment_amount,2);?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $feeType->Name;?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $feeData->payment_session;?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $feeData->payment_level;?></td>
      <td align="left" valign="top" class="<?php echo $class1;?>"><?php echo $feeData->payment_date;?></td>
      </tr>
    <?php
	$feeTotal  = $feeTotal + $feeData->payment_amount;
	}
	?>
    <tr>
      <td colspan="2" align="right" valign="top"><h4>Total</h4></td>
      <td colspan="5" align="left" valign="top"><h4><span class="<?php echo $class1;?>"><?php echo number_format($feeTotal,2);?></span></h4></td>
      </tr>
  </tbody>
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