<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('memo_details');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php 
                    foreach($memo_detail as $row):
                        ?>
                        
						<form class ="form-horizontal form-groups-bordered validate" >
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_unique_iD');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['memo_tracking_id'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send_to_staff_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['send_to_sid']))->row()->name;
									
									?>"/>
                                </div>
                            </div>
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send_to_staff_designation');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									 echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['send_to_desig_id']))->row()->designation_name;
									
									?>"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send_to_staff_unit_/School');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									
									echo $unit_scho=$this->db->get_where('faculty',array('faculty_id'=>$row['send_to_sch_unit_id']))->row()->faculty_name;
									?>"/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send_to_staff_department');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['send_to_dept_id']))->row()->deptName;
									?>"/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send_from');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['memo_initiator_sid']))->row()->name;
									
									?>"/>
                                </div>
                            </div>
							   <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_comment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['memo_corresponding_comment'];?>"/>
                                </div>
                            </div>
							    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_sent_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['memo_timestamp'];?>"/>
                                </div>
                            </div>
								 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_status');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['memo_status'];?>"/>
                                </div>
                            </div>
								  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_attacthed_document');?></label>
                                <div class="col-sm-5">
                                    
									 <a href="<?php echo base_url().$row['upload_doc_path']; ?>" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                        View Attached Document
                    </a>
                                </div>
                            </div>
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
								<?php  if($row['memo_status']=='PENDING') {?>
                                 <a  href="<?php echo base_url().'index.php?sadmin/memos/EDIT_MEMO_SENT/'.$row['id']; ?>"
								  <button  class="btn btn-info">EDIT SENT PENDING MEMO</button>
                                    </a
							 <?php }?>
							  </div>
								</div>
                           
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>


