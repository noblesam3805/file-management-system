<?php
	//session_start();
if(!isset($_SESSION["app_no"]))
{
	//$_SESSION['error'] = 'Sorry Registration/Matric No does not Exist in Students Record! Please Contact ICT Unit!';
			redirect(base_url() . 'index.php?register/account_verification');
}

$student_exist = $this->db->get_where('student', array("portal_id" => $_SESSION["app_no"]))->row();
$dept =$this->db->get_where('department', array("deptID" => $student_exist->dept))->row();
$school =$this->db->get_where('schools', array("schoolid" => $student_exist->school))->row();
$programme=$this->db->get_where('programme_type', array("programme_type_id" => $student_exist->prog_type))->row();
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
	<div class="col-md-12">
		<div class="widget stacked">
			<div class="widget-content" style="padding:10px 20px;">
				<div class="col-md-12 receipt-head">
					<img src="images/neklogo.png" />
					<p>Portal Account Notification Slip</p>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 no-p" style="margin-bottom:20px;">
						<div class="country-line">
							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please ensure that you change your default password.</h5>
						</div>
					</div>
					<div class="col-md-12 print-table">
						<table class="table table-bordered table-striped table-hover">
							<tbody>
								<tr>
									<td><p>Portal ID</p></td>
									<td><p><?php echo $student_exist->portal_id;?></p></td>
								</tr>
								<tr>
									<td><p>Password</p></td>
									<td><p><?php echo $student_exist->password;?></p></td>
								</tr>
								<tr>
									<td><p>Full Name</p></td>
									<td><p><?php echo $student_exist->name." ".$student_exist->othername;?></p></td>
								</tr>
                                <tr>
									<td><p>Department</p></td>
									<td><p><?php echo $dept->deptName;?></p></td>
								</tr>
                                <tr>
									<td><p>School</p></td>
									<td><p><?php echo $school->schoolname;?></p></td>
								</tr>
                                <tr>
									<td><p>Programme</p></td>
									<td><p><?php echo $programme->programme_type_name;?></p></td>
								</tr>
								<tr>
									<td><p>Email</p></td>
									<td><p><?php echo $student_exist->email;?></p></td>
								</tr>
							
								
								
							</tbody>
						</table>
                       <a href="<?php echo base_url().'index.php?student/dashboard';?>">Click here to Login to your Portal Account!</a>
					</div>
					<div class="col-md-12 no-p">
						<div class="country-line">
							<h5>Thank you for Choosing  Federal Polytechnic Nekede</h5>
						</div>
						<p style="text-align:right;"><a href="javascript:print()">Print</a> | <a href="javascript:window.close()">Close</a> </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>