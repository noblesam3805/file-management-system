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
					<?php echo get_phrase('send_memos');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                     
                        <?php echo form_open('sadmin/memos/PROCESS_SEND_MEMO' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="memo_title" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('MDA');?></label>
                                <div class="col-sm-5">
									<select  name="factId" id="factId" class="form-control" onchange="javascript: populateDepartments(this.value,'1'); " ><option value="" selected="selected" >- Select -</option>
					<?php foreach($facultyDetails->result() as $row)
												{
		
													?>
					<option value="<?php echo $row->faculty_id;?>"><?php  echo $row->faculty_name;?></option>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Staff');?></label>
                                <div class="col-sm-5">
									<span id="staff_area">
                      <select  name="sid" id="sid" class="form-control"><option value="" selected="selected" >- Select Staff-</option>

 </select></span>					
                                   
                                </div>
                            </div>
									
							
								 <div class="form-group">
                                 <label class="col-sm-3 control-label"><?php echo get_phrase('memo activities options');?></label>
                                <div class="col-sm-5">
                                        <select  name="memo_status" required="required" class="form-control">
																									<option value="">Please choose activity option</option>
																							<option value="SEND">SEND MEMO</option>
																								<option value="DRAFT">SAVE MEMO AS A DRAFT</option>
																						</select>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo comment');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
								
								
								<textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="memo_comment" id="memo_comment"></textarea>					
                               

							   </div>
                                </div>
                            </div>
							
							
					 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('CC');?></label>
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