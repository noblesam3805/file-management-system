<?php session_start();
 $receipts=  $this->db->query("select* from eduportal_fees_payment_log where student_id='".$this->session->userdata('student_id')."' and payment_fee_type='3'");
 foreach($my_data as $row1){
$school = $this->db->get_where('schools', array("schoolid" => $my_data->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $my_data->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $my_data->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $my_data->prog_type))->row();
$yr = $this->db->get_where('course_year_of_study', array("year_of_study_id" => $my_data->level))->row();
//$stype=$row1['programme'];
//$levels = $this->db->query("select *  from course_year_of_study where student_type_id='$stype'");
 }
 $stu_prog=$my_data->prog_type;
?>

<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!--CONTROL TABS START-->

		<ul class="nav nav-tabs bordered">

	

          	<!--li>
        		<a href="#add" data-toggle="tab"><i class="entypo-credit-card"></i>
            	<?php echo get_phrase('tedc_Fee_payment_form');?>
             	</a>
            </li-->
            <li class="active">
		        <a href="#pid" data-toggle="tab"><i class="entypo-credit-card"></i>
	            <?php echo 'TEDC Fee Confirmation Form';?>
                </a>
            </li>
            
            		<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('TEDC_Fee_Payment_History');?>
                </a>
            </li>



		</ul>

    	<!--CONTROL TABS END-->
	<div class="widget stacked widget-table">
				<div class="widget-content">
					<div class="tab-content">

				<!--TABLE LISTING STARTS-->

				<div class="tab-pane box " id="list">



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

				<!--TABLE LISTING ENDS-->



                <div class="tab-pane box active" id="pid" style="padding: 5px">
                
                	<div style="padding: 15px; paddidng-left: 30px">
					<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['payeeError'])){echo $_SESSION['payeeError']; $_SESSION['payeeError']='';} ?></p>
					</div>
					<div class="box-content">

						<?php  echo form_open('student/processTedcPayment', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));  ?> <input type="hidden" name="portalID" value="<?php echo $my_data->portal_id;?>" />

						<!--div class="form-group">

							

							<div class="col-sm-5">

						
							</div>

						</div-->

                        
			<div class="col-sm-5">

						
						      
	
            	 <div class="form-group eduportal-form-group p20">
				<label class="label-control" for="course name">RRR / Confirmation Code</label>
				<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<input type="text"  name="confirmcode" class="form-control eduportal-input" required="required" />
				</div>
			</div>
			 <div class="form-group eduportal-form-group p20 ">
				<label class="label-control" for="course name">Payment Platform</label>
			<div class="input-group input-group-lg eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select name="pmode" required class="form-control eduportal-input">
						<option value="0">Select An Option</option>
                        <option value="1">Etranzact</option>
                        <option value="2">Remita</option>
				
					</select>
				</div>
			</div>	</div>
            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('Confirm TEDC Fee Payment');?></button>
                            </div>
                        </div>

                        </form>

           		  </div>
                </div>
                	
						<!--button type="button" class="btn btn-info"><i class="entypo-credit"></i> Reprint Bank Printout</button-->
						
					</a>
					</div>
                	

                
                	<div style="padding: 15px; paddidng-left: 30px">
                	</div>
                	

            </div>



            





		
		</div>
		</div>

	</div>

</div>



