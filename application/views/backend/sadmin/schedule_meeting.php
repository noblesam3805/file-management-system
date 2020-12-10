<?php
$facultyDetails = $this->db->query("select *  from faculty");
$DepartmentDetails = $this->db->query("select *  from department");
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$dept_id=$login_details->dept_id;
$unit_sch_id= $login_details->unit_sch_id;
$designation=$this->db->query("select distinct desig_id, designation_name,sadmin_id, deptName from sadmin a, erp_staff_designations b, department c where a.desig_id=b.designation_id and c.deptID=a.dept_id and a.unit_sch_id='$unit_sch_id'");



?>
<script type="text/javascript">
function CheckMeetingAttendees(str)
{
	if(str=="All")
	{
		document.getElementById("att").style.display="none";
	}
	else
	{
		document.getElementById("att").style.display="";
	}
}

function CheckMeetingLocation(str)
{
	if(str=="Physical")
	{
		document.getElementById("loc").style.display="";
		document.getElementById("enable_zoom").style.display="none";
	}
	else
	{
		document.getElementById("loc").style.display="none";
		document.getElementById("enable_zoom").style.display="";
	}
}

</script>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('schedule_meeting');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                     
                        <?php echo form_open('sadmin/meeting/PROCESS_SCHEDULE_MEETING' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                           
 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('meeting_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="meeting_title" value=""/>
                                </div>
                            </div>
						   <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('meeting_agenda');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="meeting_agenda" value=""/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Initiator\'s_MDA');?></label>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Initiator\'s Department/Unit');?></label>
                                <div class="col-sm-5">
																			  <span id="dept">
                      <select  name="depts" id="depts" class="form-control eduportal-input required" style="width: 300px">
					  
					  <option value=""  onChange="">- Select -</option>

 </select></span>
                                </div>
                            </div>
							  
						 
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Initiator\'s Name');?></label>
                                <div class="col-sm-5">
									<span id="staff_area">
                      <select  name="sid" id="sid" class="form-control"><option value="" selected="selected" >- Select Staff-</option>

 </select></span>					
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date From:');?></label>
                               <div class="col-sm-3">
							   <div class="date-and-time"> 
							   <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" name="date_from" value="<?php echo date("Y-m-d");?>"> 
							   <input type="text" class="form-control timepicker" data-template="dropdown" name="time_from" data-show-seconds="true" data-default-time="08:00:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"> 
							   </div> </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date To:');?></label>
                               <div class="col-sm-3">
							   <div class="date-and-time"> 
							   <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" name="date_to" value="<?php echo date("Y-m-d");?>"> 
							   <input type="text" class="form-control timepicker" data-template="dropdown" name="time_to" data-show-seconds="true" data-default-time="08:00:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"> 
							   </div> </div>
                            </div>
							
							
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Attendees');?></label>
                                <div class="col-sm-5">
							 <span id="dept_area">
									<select  name="attendees" id="attendees" class="form-control" onChange="CheckMeetingAttendees(this.value);">
								
					<option value="">- Select -</option>

												
					<option value="All">All Staff</option>
<option value="Restricted">Restricted</option>
										
									</select>

                                    </span>
                                </div>
                            </div>
							  
							 
									
                               
							
							
					 <div class="form-group" id="att" style="display: none">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Restricted To:');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
			<?php foreach($designation->result() as $row3)
												{
		
													?>
				<input type="checkbox" value="<?php echo $row3->sadmin_id;?>" name="invitee[]" />: <?php echo $row3->designation_name.'('.$row3->deptName.')';?>	</br>
<?php 
	}
	?>				
												
                               

							   </div>
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Meeting Type');?></label>
                                <div class="col-sm-5">
							 <span id="dept_area">
									<select  name="location" id="location" class="form-control" onChange="CheckMeetingLocation(this.value);">
								
					<option value="">- Select -</option>

												
<option value="Physical">Physical</option>
<option value="Virtual">Virtual</option>
										
									</select>

                                    </span>
                                </div>
                            </div>
							
							
							 <div class="form-group" id="enable_zoom" style="display: none">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Enable Zoom Video:');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
							
					<input type="checkbox" value="1" name="enable_zoom" />

								
												
                               

							   </div>
                                </div>
                            </div>
							
							 <div class="form-group" id="loc" style="display: none">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Office Location:');?></label>
                                <div class="col-sm-5"><div class="compose-message-editor">
								
								
							
					<textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="officelocation" id="officelocation"></textarea>					
                           

								
												
                               

							   </div>
                                </div>
                            </div>
					       <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('create meeting');?></button>
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