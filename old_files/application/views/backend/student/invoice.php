<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo get_phrase('Fee_Payment_Report');?>

                    	</a></li>

          <li >

        <a href="#add" data-toggle="tab"><i class="entypo-credit-card"></i>

            <?php echo get_phrase('school_Fee_payment_form');?>

                </a></li>



		</ul>

    	<!------CONTROL TABS END------->
	<div class="widget stacked widget-table">
				<div class="widget-content">
					<div class="tab-content">

						<!----TABLE LISTING STARTS--->

						<div class="tab-pane box active" id="list">



							<table  class="table table-bordered datatable" id="table_export">
								<thead>
									<tr>
									<th><div><?php echo get_phrase('#');?></div></th>
									<th><div><?php echo get_phrase('Reg_no');?></div></th>
									<th><div><?php echo get_phrase('purpose_of_payment');?></div></th>
									<th><div><?php echo get_phrase('Bank_name');?></div></th>
									<th><div><?php echo get_phrase('_amount (₦)');?></div></th>
									<th><div><?php echo get_phrase('_session');?></div></th>
									<th><div><?php echo get_phrase('date');?></div></th>
									<th><div><?php echo get_phrase('');?></div></th>
									</tr>
								</thead>
								<tbody><?php $i =1; ?>
									<?php foreach($invoices as $row):?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $row['customer_id'];?></td>
										<td><?php echo $row['description'];?></td>
										<td><?php echo $row['bankname'];?></td>
										<td>₦ <?php echo $row['amount'];?></td>
										<td><?php echo $row['session'];?>
										</td>
										<!--td><?php //echo date('d M,Y', $row['payment_date']);?></td-->
										<td><?php echo $row['payment_date'];?></td>
										<td> 
										<a target ="_blank" href="<?php echo base_url();?>index.php?student/receipt/etranzact/<?php echo $row['confirm_code'];?>">
											<button type="submit" class="btn btn-info"><i class="entypo-credit"></i> View Receipt</button>
										</a>
										   </td>
									</tr><?php $i++;?>
									<?php endforeach;?>
								</tbody>
							</table>

						</div>

						<!----TABLE LISTING ENDS--->



				<div class="tab-pane box" id="add" style="padding: 5px">

					<div class="box-content">

						<?php echo form_open('student/invoice/pay' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>  <?php echo $this->session->userdata('link');?>

							

							   <!--p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p-->

	<!--p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['prn_msg'])){echo $_SESSION['prn_msg'];} ?></p-->

								<!--div class="form-group">

									<label class="col-sm-3 control-label"><?php echo get_phrase('payment_method');?></label>

									<div class="col-sm-5">

										<input type="text" class="form-control" name="title" value="E-Tranzact" readonly="readonly"/>

									</div>

								</div>

								<div class="form-group">

									<label class="col-sm-3 control-label"><?php echo get_phrase('purpose_of_payment');?></label>

									<div class="col-sm-5">

										<input name="payfor" id="payfor" class="form-control" readonly="readonly" value="SCHOOL FEES"/>



									</div>

								</div-->

								<?php //if(!isset($_SESSION['prn_msg'])){?>

								<div class="form-group">

									<label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>

									<div class="col-sm-5">

										<input type="text" class="form-control" name="CONFIRMATION_NO" required="required" placeholder="Enter Etranzact Confirmation Number"/>

									</div>

								</div>

                            <input type=hidden name = 'TERMINAL_ID' value='2140214016'>

                            <div class="form-group">

                                <label class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>

                                <div class="col-sm-5">

                                    <select id="session" name="session" class="form-control" >

                                    <option> 2012/2013 </option>

                                     <option> 2013/2014 </option>

                                    <option> 2014/2015 </option>

                                   </select>

                                </div>

                            </div>

                                <div class="form-group">

                              <div class="col-sm-offset-3 col-sm-5">

                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Proceed');?></button>

                              </div>

                                </div>

                                <?php

			//if(isset($_SESSION['err_msg'])){

			  //	unset($_SESSION['err_msg']);

			//}

		?>

                        </form>

                        <?php //} ?>

                </div>

            </div>



            





		</div>
		</div>
		</div>

	</div>

</div>



