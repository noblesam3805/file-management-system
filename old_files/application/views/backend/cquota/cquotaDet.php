<?php 
$info = $this->db->get_where("eduportal_students_record",array("regno"=>$_SESSION["targetReg"]))->row();
$dept = $this->db->get_where("department",array("deptID"=>$info->dept_id))->row()->deptName;
$school = $this->db->get_where("faculty",array("faculty_id"=>$info->school_id))->row()->faculty_name;
$school = $this->db->get_where("faculty",array("faculty_id"=>$info->school_id))->row()->faculty_name;

$student_type_name = $this->db->get_where("student_type",array("student_type_id"=>$info->student_type_id))->row()->student_type_name;

$programme_type_name = $this->db->get_where("programme_type",array("programme_type_id"=>$info->programme_type_id))->row()->programme_type_name;


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
function getDepts(fact_id){
$("#dept_area").load('<?php echo base_url().'index.php?cquota/get_depts/'; ?>'+fact_id)
}

function progtYpe(student_type_id){
$("#progt_area").load('<?php echo base_url().'index.php?cquota/studType/'; ?>'+student_type_id)
}

function progL(val){
document.getElementById("level_area").innerHTML="<select name='level' class='country-line' id='level' required='required'><option value=''>Select</option><option value='"+val+" I'>"+val+" I</option><option value='"+val+" II'>"+val+" II</option></select>"	
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
							  <li>Fill the necessary fields </li>
							  <li>
							    <h5> Please ensure that the information supplied is correct.</h5>
						      </li>
					      </ul>
                        </div>

					</div>

					<div class="col-md-12 print-table">
					 
					   <?php echo form_open(base_url().'index.php?cquota/pro_new_record');?> <table width="100%" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC" rules="all">
    <tr>
      <td width="24%" valign="top"><h4>Reg. Number</h4></td>
      <td width="76%" valign="top"><?php echo $info->regno;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>Name</h4></td>
      <td valign="top"><?php echo $info->firstname;?>&nbsp;<?php echo $info->middlename;?>&nbsp;<?php echo $info->surnamename;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>School</h4></td>
      <td valign="top"><?php echo $school;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>Department</h4></td>
      <td valign="top"><?php echo $dept;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>Student Type</h4></td>
      <td valign="top"><label for="email"></label>
        <?php echo $student_type_name;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>Program Type</h4></td>
      <td valign="top"><?php echo $programme_type_name;?></td>
    </tr>
    <tr>
      <td valign="top"><h4>Level</h4></td>
      <td valign="top"><?php echo $info->level;?></td>
    </tr>
    <tr>
      <td colspan="2" valign="top">You can now create your account. <a href="<?php echo base_url().'index.php?register/account_verification
	  ';?>" target="_new">Click here</a></td>
    </tr>
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