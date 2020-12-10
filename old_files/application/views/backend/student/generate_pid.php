<?php session_start();?>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!--CONTROL TABS START-->

		<ul class="nav nav-tabs bordered">

			<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('Fee_Payment_History');?>
                </a>
            </li>

          	<!--li>
        		<a href="#add" data-toggle="tab"><i class="entypo-credit-card"></i>
            	<?php echo get_phrase('school_Fee_payment_form');?>
             	</a>
            </li-->
            <li class="active">
		        <a href="#pid" data-toggle="tab"><i class="entypo-credit-card"></i>
	            <?php echo 'Fee Payment with Payee ID';?>
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
							<th><div><?php echo get_phrase('#');?></div></th>
							<th><div><?php echo get_phrase('portal ID');?></div></th>
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
								<td><?php echo $row['portal_id'];?></td>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['bankname'];?></td>
								<td>₦ <?php echo $row['amount'];?></td>
								<td><?php echo $row['session'];?></td>
								<!--td><?php //echo date('d M,Y', $row['payment_date']);?></td-->
								<td><?php echo $row['payment_confirmation_date'];?></td>
								<td> 
								<a target ="_blank" href="<?php echo base_url();?>index.php?student/receiptprintout/<?php echo $row['payee_id'];?>">
									<button type="submit" class="btn btn-info"><i class="entypo-credit"></i> View Receipt</button>
								</a>
								</td>
							</tr><?php $i++;?>
							<?php endforeach;?>
						</tbody>
					</table>

				</div>

				<!--TABLE LISTING ENDS-->


				<div class="tab-pane box" id="add" style="padding: 5px">

					<div class="box-content">
					<?php echo form_open('student/invoice/pay' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
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
                    </form>
                	</div>
                </div>

                <div class="tab-pane box active" id="pid" style="padding: 5px">
                	<?php if(count($payee) <= 0){?> 
                	<div style="padding: 15px; paddidng-left: 30px">
					<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['payeeError'])){echo $_SESSION['payeeError']; $_SESSION['payeeError']='';} ?></p>
					</div>
					<div class="box-content">

						<?php echo form_open('student/pay_fees/start' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

						<!--div class="form-group">

							<label class="col-sm-3 control-label"><?php echo 'Payee ID';?></label>

							<div class="col-sm-5">

								<input type="text" class="form-control" name="pid" readonly required="required" placeholder="" value="<?=$payee_id?>"/>

							</div>

						</div-->

                        <input type=hidden name = 'TERMINAL_ID' value='2140214016'>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>

                            <div class="col-sm-5">
                                <select id="session" name="session" class="form-control" 
                                data-toggle="tooltip" data-placement="right" title="Enter the Academic session you wish to pay fees for">
                                <option>2015/2016</option>
                                <option>2016/2017</option>
                                <option>2017/2018</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('Generate Payee ID');?></button>
                            </div>
                        </div>

                        </form>

               		 </div>
                </div>
                	<?php } if (count($payee) > 0 && $this->session->userdata('pid') != '') { ?>
                	<div style="padding: 15px; paddidng-left: 30px">
                	<a target ="_blank" href="<?php echo base_url();?>index.php?student/payeeprintout">
						<p style="font-size:15px; color:#00009d;">** Click here to view the bank printout</p>
					</a>
					</div>
                	<?php } elseif(count($payee) > 0 && $this->session->userdata('pid') == '') {?>
                	<div class="" style="padding: 15px; align:center">
                	<a target ="_blank" href="<?php echo base_url();?>index.php?student/payeeprintout/<?php echo $payee[0]['payee_id'];?>">
						<!--button type="button" class="btn btn-info"><i class="entypo-credit"></i> Reprint Bank Printout</button-->
						<p style="font-size:15px; color:#00009d;">** Click here to reprint the bank printout if you need it.</p>
					</a>
					</div>
                	<?php } ?>

                	<?php if (count($payee) > 0 ) { ?>
                	

					<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['payeeError'])){echo $_SESSION['payeeError']; $_SESSION['payeeError']='';} ?></p>

					<div class="box-content">
					<?php echo form_open('student/performPay' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('Payee ID.');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" readonly name="pid" required="required" value="<?=$payee[0]['payee_id']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="CONFIRMATION_NO" required="required" placeholder="Enter Etranzact Confirmation Number" 
							data-toggle="tooltip" data-placement="top" title="You would receive this after you make payment at the bank"/>
						</div>
					</div>
                    <input type=hidden name = 'TERMINAL_ID' value='2140214016'>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Confirm Payment');?></button>
                        </div>
                    </div>
                    </form>
                	</div>
                	<?php } ?>
                	<div style="padding: 15px; paddidng-left: 30px">
                	</div>
                	

            </div>



            





		
		</div>
		</div>

	</div>

</div>

<?php unset($_SESSION['fee_type']);?>
  

