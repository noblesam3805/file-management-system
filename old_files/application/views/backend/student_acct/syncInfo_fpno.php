<?php
$info = $this->db->get_where("student",array("student_id"=>$student_id))->row();
$dept = $this->db->get_where("department",array("deptID"=>$info->dept))->row();
$sch = $this->db->get_where("faculty",array("faculty_id"=>$info->school))->row();
$prog = $this->db->get_where("programme_type",array("programme_type_id"=>$info->prog_type))->row();

				
//YEAR
$begin = "2002";
 $end = date('Y');

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
							  <li><?php echo $page_sub_heading;?></li>
							  <li>=======================</li>
							  <li><?php echo $info->name.", ".$info->othername;?> - <?php echo $info->phone;?></li>
							  <li><?php echo $info->reg_no;?></li>
							  <li><?php echo $dept->deptName;?>[<?php echo $sch->faculty_code;?>]</li>
							  <li><?php echo $prog->programme_type_name;?>  </li>
		                  </ul></td>
							        <td width="35%" align="center" valign="top"><img src="<?php echo 'uploads/student_image/' . $info->student_id. '.jpg'; ?>" width="100" height="100" /></td>
						          </tr>
						        </table>
							
                </div>

				</div>

					<div class="col-md-12 print-table">
					 <?php echo form_open(base_url().'index.php?student_acct/pro_syncInfo_fpno');?>
<table width="98%" border="0" align="left" cellpadding="10" cellspacing="10" rules="all" bordercolor="#CCCCCC">
  <tbody>
    <tr>
      <td colspan="2" align="left" valign="top"><h2><strong>Compare Sync result details with that of the Current student</strong></h2></td>
      </tr>
    <tr>
      <td align="left" valign="top"><h4>Name
        <input name="student_id" type="hidden" id="student_id" value="<?php echo $student_id; ?>" />
      </h4></td>
      <td align="left" valign="top"><?php echo $student_name; ?>[<?php echo $OldRegNo; ?>]</td>
    </tr>
    <tr>
      <td width="14%" align="left" valign="top"><h4><strong>Payment Code</strong></h4></td>
      <td width="86%" align="left" valign="top"><?php echo $payment_code;?>
        <input name="payment_code" type="hidden" id="payment_code" value="<?php echo $payment_code;?>" />
        <input name="payment_status" type="hidden" id="payment_status" value="<?php echo $payment_status; ?>" /></td>
      </tr>
    
    <tr>
      <td align="left" valign="top"><h4>Amount =N=</h4></td>
      <td align="left" valign="top"><?php echo number_format($payment_amount,2); ?>
        <input name="payment_amount" type="hidden" id="payment_amount" value="<?php echo $payment_amount; ?>" /></td>
      </tr>

    <tr>
      <td align="left" valign="top"><h4>Session</h4></td>
      <td align="left" valign="top"><label for="session"></label>
        <select name="payment_session" id="payment_session">
        <?php
			 for($y = $end;$y>=$begin;$y--){
				 $year0 = ($y - 1)."/".$y;
				 
				 if($payment_session == $year0){
					$ysel = "selected"; 
					}
				 ?>
		       <option value="<?php echo $year0; ?>"<?php if(isset($ysel)){ echo $ysel; }?>><?php echo $year0; ?></option>
		       
		       <?php
			   unset($ysel);
			    } ?>
        </select></td>
      </tr>
    <tr>
      <td align="left" valign="top"><h4>Level</h4></td>
      <td align="left" valign="top">
        <label for="level2"><?php $formL =str_replace("I","",$payment_level); 
		$levN = str_replace("ND","",$payment_level);
		$levN = str_replace("H","",$payment_level);
		
		$lev = array("I","II"); 
		echo $formL;?></label>
        <select name="level2" id="level2">
        <?php for($l=0;$l<=1;$l++){
			if($levN==$lev[$l]){
			$lsel = "selected";	
			}
			?>
          <option value="<?php echo $lev[$l];?>"<?php if(isset($lsel)){echo $lsel;}?>><?php echo $lev[$l];?></option>
          <?php
		  unset($lsel);
		}
		?>
          <option value="II">II</option>
        </select>
<input name="level1" type="hidden" id="level1" value="<?php echo $formL;?>" /></td>
    </tr>
    <tr>
      <td align="left" valign="top"><h4>Semester<?php $sem = array("First","Second");?></h4></td>
      <td align="left" valign="top"><label for="semester"></label>
        <label for="semester"></label>
        <select name="semester" id="semester">
        <?php
		for($s=0;$s<=1;$s++){
			if($semester==$sem[$s]){
			$ssel = "selected";	
			}
			?>
            <option value="<?php echo $sem[$s];?>"<?php if(isset($ssel)){ echo $ssel; } ?>><?php echo $sem[$s];?></option>
            <?php
			unset($ssel);
		}
		?>
        </select></td>
    </tr>
    <tr>
      <td align="left" valign="top"><h4>Fee
        <?php $fee = $this->db->order_by("payment_fee_type")
	  ->get("payment_fee_type");?>
      </h4></td>
      <td align="left" valign="top"><select name="payment_fee_type" id="payment_fee_type">
        <?php
		foreach($fee->result() as $fees){
			if($payment_fee_type == $fees->payment_fee_type){
				$fsel = "selected";
			}
			?>
        <option value="<?php echo $fees->payment_fee_type;?>" <?php if(isset($fsel)){ echo $fsel; } ?>><?php echo $fees->Name;?></option>
        <?php
		unset($fsel);
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="left" valign="top"><h4>Date</h4></td>
      <td align="left" valign="top"><label for="payment_fee_type">
        <input name="payment_date" type="hidden" id="payment_date" value="<?php echo $payment_date ; ?>" />
      <?php echo $payment_date ; ?></label></td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="top"><div class="form-item webform-component webform-component-email" id="webform-component-email">
        <h2><strong>Save this data only when it has been duly verified </strong>
          <input name="op" type="submit" class="btn-primary btn form-submit" id="edit-submit" value="Save" />
        </h2>
      </div></td>
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