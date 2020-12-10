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
									 echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['send_to_sid']))->row()->name;
									
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
									
									echo $unit_scho=$this->db->get_where('faculty',array('faculty_id'=>$row['send_to_sch_unit_id']))->row()->faculty_name;
									?>"/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sender\'s_department');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['send_to_dept_id']))->row()->deptName;
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
						
                           
                        </form>
						<hr style="border: 10px solid green;border-radius: 5px;">
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

$memo_details=$this->db->query("select top(1)* from erp_memo_act where memo_tracking_id='$row[memo_tracking_id]'")->row();

?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('reply_memo');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                     
                        <?php echo form_open('sadmin/memos/PROCESS_REPLY_MEMO' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                 
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reply to MDA');?></label>
                                <div class="col-sm-5">
								
									<input type="text"  class="form-control" readonly="readonly" value="<?php
									
									echo $unit_scho=$this->db->get_where('faculty',array('faculty_id'=>$row['initiator_unit_sch_id']))->row()->faculty_name;
									?>"/>
                   <input name="factId" type="hidden" value="<?php echo $row['initiator_unit_sch_id'];?>" />
                                   
                                </div>
                            </div>
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Unit/Department');?></label>
                                <div class="col-sm-5">
																			
																			 <input type="text"  class="form-control" readonly="readonly" value="<?php
									echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['initiator_dept_id']))->row()->deptName;
									?>"/>
									<input name="dept_code" type="hidden" value="<?php echo $row['initiator_dept_id'];?>" />
                                </div>
                            </div>
							
																												 <input type="hidden" name="memo_title" class="form-control" readonly="readonly" value="<?php echo $memo_details->memo_title;?>"/>		
							  
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Reply To Staff');?></label>
                                <div class="col-sm-5">
										  <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['memo_initiator_sid']))->row()->name;
									
									?>"/> <input name="sid" type="hidden" value="<?php echo $row['memo_initiator_sid'];?>" />
                                   
                                </div>
                            </div>
									<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send to designation');?></label>
                                <div class="col-sm-5">
							
                     			              <input type="text" class="form-control" readonly="readonly" value="<?php
									 echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['initiator_desig_id']))->row()->designation_name;
									
									?>"/>
																<input name="desig_id" type="hidden" value="<?php echo $row['initiator_desig_id'];?>" />
                                   
                                </div>
                            </div>
							    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo date');?></label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="send_date" value=""/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('upload file');?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="file_name" value=""/>
                                </div>
                            </div>
							  
							  	  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo comment/minute');?></label>
                                <div class="col-sm-5">
													     <input type="hidden" name="memo_track_id" class="form-control" readonly="readonly" value="<?php echo $row['memo_tracking_id'];?>"/>
 <input type="hidden" name="memo_minutes" class="form-control" readonly="readonly" value="<?php echo $row['memo_minutes'];?>"/>
														                                   
								  <textarea class="form-control html5editor" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" name="memo_comment" ></textarea>
                                </div>
                            </div>
					       <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('reply memo');?></button>
                              </div>
								</div>
								
						<?php  echo form_close(); ?>					
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>


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

