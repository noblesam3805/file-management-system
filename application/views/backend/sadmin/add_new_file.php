<?php
$facultyDetails = $this->db->query("select *  from faculty");
$DepartmentDetails = $this->db->query("select *  from department");
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$login_details->unit_sch_id;
$designation=$this->db->query("select distinct desig_id, designation_name,sadmin_id, deptName from sadmin a, erp_staff_designations b, department c where a.desig_id=b.designation_id and c.deptID=a.dept_id and a.unit_sch_id='$sid'");

?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('add_new_file');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                     
                        <?php echo form_open('sadmin/filedms/PROCESS_ADD_NEW_FILE' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Document title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="document_name" value=""/>
                                </div>
                            </div>
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('File_No(Existing File)');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="file_no" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('MDA');?></label>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Unit/Department-');?></label>
                                <div class="col-sm-5">
																			  <span id="dept">
                      <select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 300px">
					  
					  <option value=""  onChange="">- Select -</option>

 </select></span>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Addressed To');?></label>
                                <div class="col-sm-5">
									<span id="staff_area">
                      <select  name="sid" id="sid" class="form-control"><option value="" selected="selected" >- Select Staff-</option>

 </select></span>					
                                   
                                </div>
                            </div>
							  
 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Document Type');?></label>
                                <div class="col-sm-5">
							 <span id="dept_area">
									<select  name="document_type" id="document_type" class="form-control" >
								
					<option value="">- Select -</option>

												
					<option value="Letter">Letter</option>
<option value="Proposal">Proposal</option>
										
									</select>

                                    </span>
                                </div>
                            </div>	
	
							  
							  
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('upload file');?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="file_name" value=""/>
                                </div>
                            </div>
							  
							  	  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('short_description');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
								
								
								<textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="short_description" id="short_description"></textarea>					
                               

							   </div>
                                </div>
                            </div>
							
							
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('CC/Accessible To:');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
								<?php foreach($designation->result() as $row3)
												{
		
													?>
				<input type="checkbox" value="<?php echo $row3->sadmin_id;?>" name="cc[]" />: <?php echo $row3->designation_name.'('.$row3->deptName.')';?>	</br>
<?php 
	}
	?>
								
												
                               

							   </div>
                                </div>
                            </div>v>
                            </div>
					       <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('send memo');?></button>
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