<?php
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$this->session->userdata('sadmin_id');
?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('Document Management');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php 
                    foreach($file_details as $row):
                        ?>
                        
						<form class ="form-horizontal form-groups-bordered validate" >
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('file_no');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['file_no'];?>"/>
                                </div>
                            </div>
								<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['document_name'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['document_type'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('size');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo number_format($row['size']/1000000,2)."Mb";?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date Uploaded');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['date_uploaded'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Uploaded by');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo  $this->db->get_where('sadmin',array('sadmin_id'=>$row['uploaded_by']))->row()->name;
									
									?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('File Address to');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									 echo $row['address_to_details'];// $this->db->get_where('sadmin',array('sadmin_id'=>$row['addressed_to_id']))->row()->name;
									
									?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Waiting for Approval/Minuting of');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" readonly="readonly" value="<?php
									  $waiting_approval_by= $this->db->get_where('sadmin',array('sadmin_id'=>$row['waiting_approval_by']))->row();
									echo $waiting_approval_by->name;
									?> (<?php
									 echo $this->db->get_where('erp_staff_designations',array('designation_id'=>$waiting_approval_by->desig_id))->row()->designation_name;
									
									?>)"/>
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('MDA');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									
									echo $unit_scho=$this->db->get_where('faculty',array('faculty_id'=>$row['ministry_id']))->row()->faculty_name;
									?>"/>
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Department');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php
									echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['unit_dept_id']))->row()->deptName;
									?>"/>
																																			
                                </div>
                            </div>
							
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Status');?></label>
                                   <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly="readonly" value="<?php echo $row['status'];?>"/>
                                </div>
                            </div>
							
							
								  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('file_attacthed_document');?></label>
                                <div class="col-sm-5">
                                    
									 <a href="#" class="btn btn-blue btn-icon icon-left" onclick="window.open('<?php echo base_url().$row['upload_doc_path']; ?>','File Attachment','width=900,height=750')">
                        <i class="entypo-download"></i>
                        View/Download Attached File
                    </a>
                                </div>
                            </div>
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
								<?php  if($sid==$row['uploaded_by']) {?>
                                 <a  href="<?php echo base_url().'index.php?sadmin/update_file/'.$row['id']; ?>"
								  <button  class="btn btn-info">Edit File</button>
                                    </a>
							 <?php }?>
							   <a  href="<?php echo base_url().'index.php?sadmin/view_track_files'; ?>"
								  <button  class="btn btn-info">Close</button>
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


