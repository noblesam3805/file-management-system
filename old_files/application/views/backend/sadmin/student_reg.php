<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('Course List');?>
                    	</a></li>
			<!--li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_invoice/payment');?>
                    	</a></li-->
		</ul>
    	<!--CONTROL TABS END-->
		<div class="tab-content">
            <?php echo form_open('sadmin/student_reg/search/', array('class' => 'form-inline','target'=>'_top'));?>
            <!--form class="form-inline"-->
              <div class="form-group">
                <label class="sr-only" for="s_reg">Reg No</label>
                <input type="text" class="form-control" id="s_reg" name="s_reg" placeholder="Reg Number">
              </div>
              <div class="form-group">
                <label class="sr-only" for="session">Session</label>
                <select name="session" id="session" class="form-control">
                    <option value="2014/2015" <?php //if($row['status']=='paid')echo 'selected';?>><?php echo"2014/2015";//echo get_phrase('paid');?></option>
                    <option value="2015/2016" <?php //if($row['status']=='unpaid')echo 'selected';?>><?php echo"2015/2016";//echo get_phrase('unpaid');?></option>
                </select>
              </div>
              <div class="form-group">
                <label class="sr-only" for="sems">Semester</label>
                <select name="semester" id ="sems" class="form-control">
                    <option value="1" <?php //if($row['status']=='paid')echo 'selected';?>><?php echo"1";//echo get_phrase('paid');?></option>
                    <option value="2" <?php //if($row['status']=='unpaid')echo 'selected';?>><?php echo"2";//echo get_phrase('unpaid');?></option>
                </select>
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <!--table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('Payment_platform');?></div></th>
                    		<th><div><?php echo get_phrase('purpose_of_payment');?></div></th>
                    		<th><div><?php echo get_phrase('_amount');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['amount'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- VIEWING LINK ->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-credit-card"></i>
                                                <?php echo get_phrase('view_invoice');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- EDITING LINK ->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK ->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table-->
            </br></br>

            <!--student info display-->
            <div class="row">
              <div class="col-sm-9">
                Student Info <?php if(count($year) > 0){ ?> for <?=$year?> academic session <?php } ?>
                <!-- Columns are always 50% wide, on mobile and desktop -->
                <div class="row">
                  <div class="col-xs-6"><? echo '<strong>'.$student->name.', '.$student->othername.'</strong>'?></div>
                  <div class="col-xs-6">Reg Number: <?=$student->reg_no?></div>
                </div>
                <div class="row">
                  <div class="col-xs-6">Dept: <strong><?=$student->dept?></strong></div>
                  <div class="col-xs-6">Max Credit Load: <strong><?=$max_credit?></strong>/ Min Credit Load: <strong><?=$min_credit?></strong></div>
                </div>
                <div class="row">
                  <div class="col-xs-6">Level: <strong><?=$current_level?></strong></div>
                  <?php
                    foreach ($courses as $row) {
                        $current_load += $row['credit_load'];
                    }
                    ?>
                  <div class="col-xs-6">Registered: <?=$current_load?></div>
                </div>
              </div>
            </div>

            
            <div class="row">
                  <div class="col-xs-6">...</div>
                  <div class="col-xs-6">...</div>
                </div>

                <table  class="table table-bordered datatable">
                    <thead>
                        <tr>
                        <th><div><?php echo get_phrase('#');?></div></th>
                        <th><div><?php echo get_phrase('course_code');?></div></th>
                        <th><div><?php echo get_phrase('course_title');?></div></th>
                        <th><div><?php echo get_phrase('Session');?></div></th>
                        <th><div><?php echo get_phrase('Semester');?></div></th>
                        <th><div><?php echo get_phrase('Credit Load');?></div></th>
                        <th><div><?php echo get_phrase('Action');?></div></th>
                        </tr>
                    </thead>
                    <tbody><?php $i =1; ?>
                        <?php foreach($courses as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['course_code'];?></td>
                            <td><?php echo $row['course_name'];?></td>
                            <td><?php echo $row['session'];?>
                            <td><?php echo $row['selected_semester'];?></td>
                            <!--td><?php //echo ($row['lecturer'] != '') ? $row['lecturer'] : 'Not Available';?></td-->
                            <td><?php echo ($row['credit_load'] != '') ? $row['credit_load'] : 'Not Available';?></td>
                            </td>
                            <!--td><?php //echo date('d M,Y', $row['payment_date']);?></td <?php echo base_url();?>index.php?student/receipt/etranzact/<?php echo $row['confirm_code'];?>-->
                            <td> 
                            <!--a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?student/course_management/delete/<?=$row['id']?>')"-->
                            <!--a href="<?php echo base_url();?>index.php?student/course_management/<?=$active_semester?>/delete/<?=$row['id']?>"-->
                                <button type="submit" class="btn btn-danger"><i class="entypo-credit"></i> delete</button>
                            <!--/a-->
                               </td>
                        </tr><?php $i++;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </br>

            <?php echo form_open('sadmin/receipt/print' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_blank'));?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="sr-only" for="c_a">Course Adviser's Name</label>
                <input type="text" class="form-control" id="c_a" name="adviser" placeholder="Course Adviser's Name" required='required'>
              </div></div>
              <div class="col-md-4 col-md-offset-4"></div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="form-group checkbox">
                  <label>
                    <input type="checkbox" value=""  required="required">
                    I hereby confirm that the following course registration has been approved.
                  </label>
                </div>
                <input type="hidden" name="s_reg" value="<?=$reg?>">
                <input type="hidden" name="session" value="<?=$session?>">
                <input type="hidden" name="semester" value="<?=$semester?>">
                </div>
              <div class="col-xs-6 col-md-4"><button type="submit" class="btn btn-success"><i class="entypo-credit"></i> Confirm & Print</button></div>
            </div>
            </form>
			</div>
            <!--TABLE LISTING ENDS-->
            
		</div>
	</div>
</div>

