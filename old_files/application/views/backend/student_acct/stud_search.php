<?php
if(isset($_POST["param"])){
$param = $this->input->post('param');
		$data1 = $this->db->query("select name, othername,reg_no, phone,student_id from student where name like'%$param%' || othername like'%$param%'|| reg_no like'%$param%' || phone like'%$param%'") or die ("Error data1 ".mysql_error());
}
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
function search_stud(data){
	document.getElementById("butt_area").style.display="block";
var	data = data.replace("/","__");
$("#stud_search_area").load('<?php echo base_url().'index.php?utility/search_stud/'; ?>'+data)
}
</script>
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
					  <form id="form1" name="form1" method="post" action="">
					    <table width="90%" border="0" align="center" cellpadding="10" cellspacing="10" rules="none">
					      <tbody>
					        <tr>
					          <td width="39%" align="left" valign="top"><label>Enter Firstname | Middlename | Lastname | Reg.No./Application | Phone No.</label></td>
					          <td align="left" width="48%"><input name="param" type="text" class="input text" id="param" size="50%" height="25px"  onchange="search_stud(this.value);" onblur="search_stud(this.value);" onkeydown="search_stud(this.value);" onkeypress="search_stud(this.value);" onkeyup="search_stud(this.value);" required="required"/></td>
					          <td align="left" width="13%" id="butt_area" style="display:none"><div class="form-item webform-component webform-component-email" id="webform-component-email">
					            <input name="op" type="submit" class="btn-primary btn form-submit" id="edit-submit" value="Post" />
					            </div></td>
				            </tr>
					        <tr>
					          <td colspan="3" align="right" valign="top"><div id="stud_search_area">
					            <?php if($data1->num_rows()>0){
		  foreach($data1->result() as $data){
			?>
					            <div><a href="<?php echo base_url().'index.php?student_acct/studentProfile/'.$data->student_id;?>"><?php echo $data->name." ".$data->othername." - ".$data->reg_no." - ".$data->phone;?></a></div>
					            <?php
			}
		}
		else{
		echo "<div align='center'>No record</div>";
		}
		  
	
	  ?>
					            </div></td>
				            </tr>
				          </tbody>
				        </table>
				      </form>
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