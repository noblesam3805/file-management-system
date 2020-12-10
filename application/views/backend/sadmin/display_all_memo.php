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
                    foreach($reply_memo_detail as $row):
                        ?>
                        
						<form class ="form-horizontal form-groups-bordered validate" >
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo_unique_iD');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['memo_tracking_id'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sender_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo  $staff_name=$this->db->get_where('erp_staff',array('sid'=>$row['memo_initiator_sid']))->row()->FULL_NAME;
									
									?>"/>
                                </div>
                            </div>
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sender\'s_designation');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									 echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['initiator_desig_id']))->row()->designation_name;
									
									?>"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sender\'s_unit_/School');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									
									echo $unit_scho=$this->db->get_where('faculty',array('faculty_id'=>$row['initiator_unit_sch_id']))->row()->faculty_name;
									?>"/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sender\'s_department');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									echo $dept_name=$this->db->get_where('erp_depts',array('dept_id'=>$row['initiator_dept_id']))->row()->dept_name;
									?>"/>
																												 <input type="hidden" name="memo_title" class="form-control" readonly="readonly" value="<?php echo $memo_details->memo_title;?>"/>								
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

<?php
$facultyDetails = $this->db->query("select *  from faculty");
$designation=$this->db->get('erp_staff_designations');

$memo_id;

$memo_details=$this->db->get_where('erp_memo_act',array('id'=>$memo_id))->row();

?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('take action');?>
                    	</a></li>
			
			<td><a href="index.php?sadmin/memos/REPLY_MEMO_DETAILS/<?php echo $row['id'];?>/<?php echo $row['memo_tracking_id'];?>" class="btn btn-info btn-sm " style="margin-left: 7px">Reply |  </a>
                  <a href="index.php?sadmin/memos/FORWARD_MEMO_DETAILS/<?php echo $row['id'];?>/<?php echo $row['memo_tracking_id'];?>" class="btn btn-primary btn-sm " style="margin-left: 7px"> Forward |</a>
        
		</ul>
    	<!------CONTROL TABS END------->
        
	
	
<!--password-->
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-lock"></i> 
					<?php echo get_phrase('');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content padded">
					
						
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>

