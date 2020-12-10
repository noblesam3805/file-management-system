<?php $stT = $this->db->query("select * from student_type") or die ("Error st ".mysql_error());

$fact = $this->db->query("select * from faculty order by faculty_name") or die ("Error fact ".mysql_error());
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
$("#dept_area").load('<?php echo base_url().'index.php?utility/get_depts/'; ?>'+fact_id)
}

function progtYpe(student_type_id){
$("#progt_area").load('<?php echo base_url().'index.php?utility/studType/'; ?>'+student_type_id)
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
      <td width="76%" valign="top"><input name="regno" type="text" id="regno" required="required" />
        *</td>
    </tr>
    <tr>
      <td valign="top"><h4>Name</h4></td>
      <td valign="top"><label for="fullname"></label>
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname"   required="required"  />
        <label for="middlename">Middle Name</label>
        <input type="text" name="middlename" id="middlename"  required="required" />
        <label for="surname">Last Name</label>
        <input type="text" name="surname" id="surname"   required="required" />
        *</td>
    </tr>
    <tr>
      <td valign="top"><h4>School</h4></td>
      <td valign="top"><select name="school_id" id="school_id" class="country-line" required="required"><option value="">Select</option>
<?php foreach($fact->result() as $fact2){
	?>
<option value="<?php echo $fact2->faculty_id; ?>" id="<?php echo $fact2->faculty_id; ?>" onChange="getDepts(this.id);" onclick="getDepts(this.id);"><?php echo $fact2->faculty_name; ?></option>
<?php
}
?>
</select>

        *</td>
    </tr>
    <tr>
      <td valign="top"><h4>Department</h4></td>
      <td valign="top"><div id="dept_area">
        <select name="dept_id" class="country-line" id="dept_id"  required="required">
          <option value="">Select School First</option>
        </select>
      </div></td>
    </tr>
    <tr>
      <td valign="top"><h4>Student Type</h4></td>
      <td valign="top"><label for="email"></label>
        <label for="student_type_id">
        </label>
        <select name="student_type_id" class="country-line" id="student_type_id" required="required" onchange="progtYpe(this.value);" onclick="progtYpe(this.value);">
          <option value="">Select</option>
          <?php
          foreach($stT->result() as $st){?>
          <option value="<?php echo $st->student_type_id; ?>" title="<?php echo $st->student_type_name; ?>" onclick="progL(this.title);"><?php echo $st->student_type_name; ?>
            <?php
									  }
									  ?>
            </option>
        </select></td>
    </tr>
    <tr>
      <td valign="top"><h4>Program Type</h4></td>
      <td valign="top"><label for="programme_type_id"> </label>
        <div id="progt_area">
          <select name="programme_type_id" class="country-line" id="programme_type_id" required="required">
            <option value="">Choose Student type first</option>
          </select>
        </div></td>
    </tr>
    <tr>
      <td valign="top"><h4>Level</h4></td>
      <td valign="top"><label for="level"></label>
        <label for="level"></label>
        <div id="level_area">
          <select name="level" class="country-line" id="level" required="required">
            <option value="">Choose Student type first</option>
          </select>
        </div></td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><input name="button" type="submit" class="country-line" id="button" value="Save" /></td>
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