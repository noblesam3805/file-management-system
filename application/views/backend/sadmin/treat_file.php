<?php
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$this->session->userdata('sadmin_id');
$facultyDetails = $this->db->query("select *  from faculty");
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('file_attacthed_document');?></label>
                                <div class="col-sm-5">
                                    
									 <a href="#" class="btn btn-blue btn-icon icon-left" onclick="window.open('<?php echo base_url().$row['upload_doc_path']; ?>','File Attachment','width=900,height=750')">
                        <i class="entypo-download"></i>
                        View/Download Attached File
                    </a>
                                </div>
                            </div>
							<div class="form-group">
							<span style="margin-left: 250px; font-size: 14px; color: green;"><b>
                      APPROVE/MINUTE FILE TO NEXT OFFICIAL</b></span>
                                </div><br/>
					  </form> 
					  <?php echo form_open('sadmin/filedms/PROCESS_MINUTE_FILE' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                 
               					
	
								
				<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Next_Official\'s_MDA');?></label>
							 <div class="col-sm-5">
									<select  name="factId" id="factId" class="form-control" onchange="javascript: populateDepartments(this.value,'1'); " ><option value="" selected="selected" >- Select -</option>
					<?php foreach($facultyDetails->result() as $row1)
												{
		
													?>
					<option value="<?php echo $row1->faculty_id;?>"><?php  echo $row1->faculty_name;?></option>
<?php 
	}
	?>
 </select>
       </div>
                                </div>
								
								<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Next_Official\'s Department/Unit');?></label>
                                <div class="col-sm-5">
																			  <span id="dept">
                      <select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 300px">
					  
					  <option value=""  onChange="">- Select -</option>

 </select></span>
                                </div>
                            </div>
							  
						 
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Next_Official\'s Name');?></label>
                                <div class="col-sm-5">
									<span id="staff_area">
                      <select  name="sid" id="sid" class="form-control"><option value="" selected="selected" >- Select Staff-</option>

 </select></span>					
                                   
                                </div>
                            </div>
							
								  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('minute/comment');?></label>
                                <div class="col-sm-5">
													     <input type="hidden" name="file_id" class="form-control" readonly="readonly" value="<?php echo $row['id'];?>"/>
														
                                   <textarea class="form-control html5editor" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" name="minute" ></textarea>
                                </div>
                            </div>
							
							
							
							
								
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Action');?></label>
                                <div class="col-sm-5">
									<select  name="status" id="status" class="form-control"  ><option value="" selected="selected" >- Select -</option>
					
					<option value="MINUTED">MINUTE</option>
					<option value="KIV">KEEP IN VIEW</option>
					<option value="AWAITING MINUTING/APPROVAL">APPROVAL REQUEST</option>
<option value="APPROVAL GRANTED">APPROVAL GRANTED</option>
 </select>
									
                                   
                                </div>
                            </div>	
							
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
								<button type="submit" class="btn btn-info"><?php echo get_phrase('Treat File');?></button>
								
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
                           
                      <?php  echo form_close(); ?>	
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>


