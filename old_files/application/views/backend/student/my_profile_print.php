<?php 

  $SchoolName = "Ebonyi State University, Abakaliki" ;
  
  $portalNumber ="Portal Number";

$stu_prog=$my_data->prog_type;

 $receipts=  $this->db->query("select* from eduportal_fees_payment_log where student_id='".$this->session->userdata('student_id')."' and payment_fee_type='2'");
 foreach($my_data as $row1){
$school = $this->db->get_where('schools', array("schoolid" => $my_data->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $my_data->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $my_data->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $my_data->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $row1['level']))->row();
//$stype=$row1['programme'];
//$levels = $this->db->query("select *  from course_year_of_study where student_type_id='$stype'");
 }

?>
<div class="mainpanel mainpanelJustify">

	
	<div class="contentpanel" style="padding:0px 20px 20px 30px !important;">
                        
                        <div class="row">
							<div class="widget stacked widget-table">
								<div class="widget-content">
                            <div class="col-md-3">
								<div class="col-md-12 student-side-bar-head">
									<img src="<?php if($this->session->userdata('login_type') == 'student'){
										//get the student photo
										$stuReg = $this->db->get_where('student', array("student_id" => $this->session->userdata('student_id')))->row();
								$school = $this->db->get_where('schools', array("schoolid" => $stuReg->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $stuReg->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $stuReg->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $stuReg->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $stuReg->level))->row();
										$photo = ($stuReg->photo == NULL || empty($stuReg->photo)) ? 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg' : 'putme/uploads/student_image/' . $stuReg->photo . '.jpg';
									
										echo $photo;
									}else{echo 'assets/images/default.png';} ?>" class="img-circle img-offline img-responsive img-profile" width="100px" height="100px" />
									<?php echo ucwords(strtolower($my_data->othername));?><br />
									<span class="stdatsch">Student At Ebonyi State University, Abakaliki.</span>
									<div class="col-md-12 no-p btn-group port-Num">
                                        &nbsp;
                                        <?php echo $my_data->reg_no;?>
                                    </div>
									<div class="col-md-12 no-p btn-group port-Num">
                                        &nbsp;
                                        <?php echo $my_data->phone;?>
                                    </div>
									<div class="col-md-12 no-p btn-group">
                                        &nbsp;
                                        <?php echo $my_data->reg_no;?>
                                    </div>
									
								</div>
								<div class="col-md-12 student-side-bar-about">
									<a href="#"><i class="fa fa-twitter-square"></i> </a>
									<a href="#"><i class="fa fa-facebook-square"></i></a>
									<a href="#"><i class="fa fa-linkedin-square"></i></a>
									<a href="#"><i class="fa fa-google-plus-square"></i></a>
								</div>
								<div class="col-md-12 student-side-bar-socials">
								
								</div>
                            </div>
                            
                            <div class="col-md-12">
                              
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-line">
                                    <li class="active"><a href="#activities" data-toggle="tab"><strong>Personal Information</strong></a></li>
                                    
                                </ul>
                            
                                <!-- Tab panes -->
								<div class="widget stacked widget-table">
								<div class="widget-content">
                             <div class="tab-content nopadding noborder">
                                <div class="tab-pane active" id="activities">
                                    <div class="col-md-12 container-tables">
										<div class="lead leadMe">Basic  Information</div> 
										<table class="table table-responsive table-bordered mytable" width="100%">
											<tr>
												<td>My Name</td>
												<td><?php echo $my_data->name; ?></td>
											</tr>
											<tr>
												<td>My Phone</td>
												<td><?php echo $my_data->phone;?></td>
											</tr>
											<tr>
											  <td>Address</td>
											  <td><?php echo ucwords(strtolower($my_data->address));?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><?php echo $my_data->email; ?></td>
											
											</tr>
											<tr>
											 <td>Sex</td>
											 <td><?php echo $my_data->sex;?></td>
											</tr>
										
										</table>
										<div class="lead leadMe">Academic Profile</div> 
										<table class="table table-responsive table-bordered mytable" width="100%">
											<tr>
												<td>My Institution Name</td>
												<td><?php echo $SchoolName; ?></td>
											</tr>
											<tr>
												<td>My School</td>
												<td><?php echo $school->schoolname;?></td>
											</tr>
											<tr>
											  <td>My Department</td>
											  <td><?php echo ucwords(strtolower($dept->deptName));?></td>
											</tr>
											
											<tr>
											 <td>My Programme</td>
											 <td><?php echo $programme->student_type_name."(".$programme_type->programme_type_name.")";?></td>
											</tr>
                                            <tr>
											 <td>My Level</td>
											 <td><?php  echo $yr->year_of_study_name;?></td>
											</tr>
										
										</table>
									  <div class="lead leadMe">Parent / Guidance Information</div> 
										<table class="table table-responsive table-bordered mytable"
									    width="100%">
										  <tr>
											<td>Parent Name</td>
											<td class="rightTa"><?php echo ucwords(strtolower($my_data->parent_name));?></td>
										  </tr>
										  <tr>
											<td>Parent Address</td>
											<td><?php echo ucwords(strtolower($my_data->parent_address)); ?></td>
										  </tr>
										  <tr>
										    <td>Local Government</td>
											<td><?php echo $my_data->lga. " ,".$my_data->state. " ".$my_data->nationality;?></td>
										  </tr>
										  <tr>
											<td>Parent Phone</td>
											<td><?php echo $my_data->parent_phone; ?></td>
										  </tr>
									
										</table>
										<div class="lead leadMe">Contact Information</div>
										<table class="table table-responsive table-bordered mytable" width="100%">
										<tr>
											<td>Home Address</td>
											<td><?php echo ucwords(strtolower($my_data->parent_address)); ?></td>
											 <tr>
											<td>Phone</td>
											<td><?php echo $my_data->parent_phone; ?></td>
										  </tr>
										  </tr>
										</table>
										 <div class="tab-pane box " id="list">
Fee Payment Details


					<table  class="table table-bordered datatable" id="table_export">
						<thead>
							<tr>
							<th><div>S/N</div></th>
							<th><div>Portal ID</div></th>
							<th><div>Semester</div></th>
							<th><div>Level</div></th>
							<th><div>Amount (₦)</div></th>
							<th><div>Session</div></th>
							<th><div>Payment Code</div></th>
							<th><div>Date</div></th>
                            <th><div>Action</div></th>
							</tr>
						</thead>
						<tbody><?php $i =1; ?>
							<?php foreach($receipts->result() as $row){?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->regno;?></td>
								<td><?php echo $row->semester;?></td>
								<td><?php echo $row->payment_level;?></td>
								<td>₦ <?php echo $row->payment_amount;?></td>
								<td><?php echo $row->payment_session;?></td>
								<td><?php echo $row->payment_code;?></td>
								<td><?php echo $row->payment_date;?></td>
								<td> 
								<a target ="_blank" href="<?php echo base_url();?>index.php?student/receiptprintout/<?php echo $row->payment_code;?>">
									<button type="submit" class="btn btn-info"><i class="entypo-credit"></i> View Receipt</button>
								</a>
								</td>
							</tr><?php $i++;?>
							<?php }?>
						</tbody>
					</table>

				</div> 
									</div>
                                </div><!-- tab-pane -->
                              
                            </div><!-- tab-content -->
							</div>
							</div>
                              
                            </div><!-- col-sm-9 -->
                        </div><!-- row -->  
						</div>
						</div>
                    </div><!-- contentpanel -->
</div></diV>