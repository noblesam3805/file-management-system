<?php
$data = $this->db->get_where("medical_form",array("app_no"=>$app_no))->row();
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
function valid_cat(cat_val){
	 document.getElementById("details").innerHTML="<div class='form-group'><div class='col-sm-offset-3 col-sm-5'><input type='button' name='button' id='button' value='Next'  class='btn btn-info' onclick='populate_details(this)' /></div></div>";	
document.getElementById("level").value=cat_val;

	if(cat_val=="Staff"){
		document.getElementById("cat_type").value="staff_no";
		document.getElementById("app_prop").innerHTML="<label class='col-sm-3 control-label'>Staff No.</label><div class='col-sm-5'><br> <input type='text'  style='height:30px' name='staff_no' id='staff_no' required='required' onclick='showButt(this);' /></div>";
	}
	else if(cat_val=="OND I" || cat_val=="HND I"){
		document.getElementById("cat_type").value="pin_no";
		document.getElementById("app_prop").innerHTML="<label class='col-sm-3 control-label'>School Fees PIN</label><div class='col-sm-5'><br><input name='pin_no' style='height:30px' type='text' id='pin_no' required='required' onclick='showButt(this);'  /></div>";
	}
	else if(cat_val=="OND II" || cat_val=="HND II"){
		document.getElementById("cat_type").value="reg_no";
		document.getElementById("app_prop").innerHTML="<label class='col-sm-3 control-label'>Registration No.</label><div class='col-sm-5'><br><input type='text' style='height:30px' name='reg_no' id='reg_no' required='required' onclick='showButt(this);'  /></div>";
	}	
	
}

function showButt(){
 document.getElementById("details").innerHTML="<div class='form-group'><div class='col-sm-offset-3 col-sm-5'><input type='button' name='button' id='button' value='Next'  class='btn btn-info' onclick='populate_details(this)' /></div></div>";	
}

function populate_details(){
	catType = document.getElementById("cat_type").value;//Staff || New Student || Returning Student
	level = document.getElementById("level").value;//Staff || Student
	level = level.replace(" ","__");
	appNo = document.getElementById(catType).value;//Staff no || Reg. No. || Fee PIN
	appNo = appNo.replace("/","__");
 $("#details").load('<?php echo base_url().'index.php?medicals/populate_details/';?>'+catType+"/"+appNo+"/"+level);
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

					<div class="col-md-12 no-p" style="margin-bottom:20px;"></div>

					<div class="col-md-12 print-table">
				
     
						<table width="98%" align="center" class="table table-bordered table-striped table-hover">

							<tbody>

								

							   
                                	

								
                              	
                      <tr>
                         <td colspan='2' align="right" valign="top">     				
					 <table width="98%" align="center" bgcolor="#FFFFFF"><caption><h3><?php echo $data->app_no;?></h3></caption>
    <tr>
      <td width="79%" valign="top"><table width="100%" cellspacing="5" bordercolor="#CCCCCC" rules="all">
        <tr>
          <td width="10%" valign="top">Surname</td>
          <td width="35%" valign="top"><?php echo $data->surname;?></td>
          <td width="12%" valign="top">Age</td>
          <td width="43%" valign="top"><?php echo $data->age;?></td>
          </tr>
        <tr>
          <td valign="top">Othername</td>
          <td valign="top"><?php echo $data->othername;?></td>
          <td valign="top">Sex</td>
          <td valign="top"><?php echo $data->sex;?></td>
          </tr>
        <tr>
          <td valign="top">Address</td>
          <td valign="top"><?php echo $data->address;?></td>
          <td valign="top">Date</td>
          <td valign="top"><?php echo $data->form_date;?></td>
          </tr>
      </table></td>
      <td width="21%" valign="top"><p>X - RAY NUMBER</p>
        <p><?php echo $data->xray_no;?></p></td>
      </tr>
  </table>
					 <div class="form-group">
					   <div class="col-sm-5"><br><div id="app_prop"></div>
<!--  <div id="sch_fee_pin1"><label class="col-sm-3 control-label">School Fees PIN</label>
  <div class="col-sm-5"><br><input name="pin_no" style="height:30px" type="text" id="pin_no" /></div></div>
  
  <div id="reg_no1">
    <label class="col-sm-3 control-label">Registration No.</label>
    <div class="col-sm-5"><br><input type="text" style="height:30px" name="reg_no" id="reg_no" /></div>
  </div>
  
  <div id="staff_no1">
    <label class="col-sm-3 control-label">Staff No.</label>
   <div class="col-sm-5"><br> <input type="text"  style="height:30px" name="staff_no" id="staff_no" /></div>
  </div>
-->  
</div>
                      </div>
                            <div id="details"><div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5"><a onclick="window.print();">Print</a> | <a href="<?php echo base_url().'index.php?medicals/begin';?>">Close</a></div></div>
                           </div>
                        
                           
 
                           <!--End details-->
           
                           
                            
								
                        </form>
					
                
                             
                             
            </td>
							</tr>
                              
                          
					
                           

							</tbody>

						</table>
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