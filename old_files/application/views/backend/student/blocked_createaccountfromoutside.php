<?php session_start();
$faculty = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");


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

				<div class="col-md-12 receipt-head">

					<img src="assets/images/neklogo2.png" />

					<p>Create Your Portal Account for Payment Invoice generation</p>

				</div>

				<div class="col-md-12">

					<div class="col-md-12 no-p" style="margin-bottom:20px;">

						<div class="country-line">

							<h5><span class="fa  fa-lightbulb-o"></span> &nbsp; Please ensure that the information supplied is correct.</h5>

						</div>

					</div>

					<div class="col-md-12 print-table">
				
 <?php echo form_open('register/createportalaccountfromoutside' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>               
     
						<table class="table table-bordered table-striped table-hover">

							<tbody>

								

							   
                                	

								
                              	
                      <tr>
                         <td colspan='2'>     				
					 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Registration_No');?></label>
                                <div class="col-sm-5"><br>
                                   <input type="text" name="portal_id" required="required" class="form-control eduportal-input" style="height:30px" placeholder="Portal ID/Matric No"  /> Note: For students without matric noumbers use your application form no.
                                </div>
                            </div>
	
			               <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_Title');?></label>
                                <div class="col-sm-5"><br>
                                    <select type="text" class="form-control" name="title" required >
                                        <option selected="selected"></option>
                                        <option>Mr.</option>
                                        <option>Mrs.</option>
                                        <option>Miss</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Surname');?></label>
                                <div class="col-sm-5"><br>
                                    <input type="text" class="form-control" name="name" style="height:30px" value="" required />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Other_names');?></label>
                                <div class="col-sm-5"><br>
                                    <input type="text" class="form-control" style="height:30px" name="othername" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_email');?></label>
                                <div class="col-sm-5"><br>
                                    <input type="text" class="form-control" style="height:30px" name="email" value="" />
                                </div>
                            </div>
                        
                           
                           <div class="form-group">
						        <label for="field-2" class="col-sm-3 control-label" ><?php echo get_phrase('phone_no');?></label>
  						    <div class="col-sm-5"><br>
  							    <input type="text" class="form-control" name="phone" style="height:30px" value="<?php echo $row['phone'];?>" required >
  						    </div>
					        </div>
							

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_school');?></label>
                                <div class="col-sm-5"><br>
									<select class="form-control" id="school" name="school" required  onChange="checkInstitution(this.value)">
										
										<option value="">SELECT YOUR SCHOOL</option>
										<?php foreach($faculty->result() as $row3)
	{
		
	?>
 <option value="<?php  echo $row3->schoolid;?>"><?php  echo $row3->schoolname;?></option>
<?php 
	} 
	?> 
									</select>
                                </div>
                              
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_department');?></label>
                                <div class="col-sm-5"><br>
                                    <select class="form-control" id="dept"  name="dept" required>
                               
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('_programme');?></label>
                                <div class="col-sm-5"><br>
                                    <select class="form-control" name="programme" onChange="showProgramme(this.value)" required>
										
										<option value="" >Select Your programme</option>
																			<?php foreach($student_type->result() as $row3)
	{
		
	?>
 <option value="<?php  echo $row3->student_type_id;?>"><?php  echo $row3->student_type_name;?></option>
<?php 
	} 
	?> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('programme_type');?></label>
                                <div class="col-sm-5" id="progresult"><br>
                                    <select id="prog_type" name="prog_type" class="form-control" required>
                                       
                                    </select>
                                </div>
                            </div>
                           
                           
                            <div class="form-group">
				  <label class="col-sm-3 control-label">Payment Type</label>
				   <div class="col-sm-5" id="progresult"><br>
					<select name="paymentType" required class="form-control eduportal-input">
						<option value="1">ACCEPTANCE FEES</option>
						<option value="2">SCHOOL FEES</option>
						<option value="3">TEDC FEES</option>
						<option value="4">MICROSOFT PLATFORM FEES</option>
						<option value="5">LATE FEE PAYMENT - OTHER INCOME</option>
							<option value="6">COMPLETION OF SCHOOL FEES</option>
								<option value="7">DAMAGES FEE</option>
									<option value="8">LOCAL TRANSCRIPT</option>
									<option value="9">FOREIGN TRANSCRIPT</option>
					</select>
				</div>
			</div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Proceed');?></button>
                              </div>
								</div>
                        </form>
					
                </div>
                             
                             
                           </td>
							</tr>
                              
                          
					
                           

							</tbody>

						</table>
                        <br />
                    	<br />
</form><?php

                    //session_unset($_SESSION['imgerror']);
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