<?php
$facultyDetails = $this->db->query("select *  from faculty");
$deptDetails = $this->db->query("select *  from erp_depts");
$designation=$this->db->get('erp_staff_designations');

?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('edit_pending_sent_memo');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php 
                    foreach($edit_memo_detail as $row_memo):
																				$deptName=$this->db->get_where('erp_depts',array('dept_id'=>$row_memo['send_to_dept_id']))->row();
																					$schName=$this->db->get_where('faculty',array('faculty_id'=>$row_memo['send_to_sch_unit_id']))->row();
																						$staffName=$this->db->get_where('erp_staff',array('sid'=>$row_memo['send_to_sid']))->row();
                       
																							 ?>
                     
                        <?php echo form_open('sadmin/memos/PROCESS_EDIT_SENT_MEMO' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="memo_title" value="<?php echo $row_memo['memo_title']?>"/>
                               <input type="hidden" class="form-control" name="id" value="<?php echo $row_memo['id']?>"/>
																															 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Unit');?></label>
                                <div class="col-sm-5">
									<select  name="factId" id="factId" class="form-control" >
										<option value="<?php echo $schName->faculty_id?>" selected="selected" ><?php echo 	$schName->faculty_name ?></option>
					<option value="<?php echo $row->faculty_id;?>"><?php  echo $row->faculty_name;?></option>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Department');?></label>
                                <div class="col-sm-5">
																		
									<select  name="dept_code" id="dept" class="form-control" >
										
					<option value="<?php echo $deptName->dept_id;  ?>"><?php echo $deptName->dept_name;  ?></option>

															<?php foreach($deptDetails->result() as $row_dept)
												{
		
													?>
					<option value="<?php echo $row_dept->dept_id;?>"><?php  echo $row_dept->dept_name;?></option>
<?php 
	}
	?>
									</select>

                               
                                </div>
                            </div>
							  
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Staff');?></label>
                                <div class="col-sm-5">
									<span id="staff_area">
                      <select  name="sid" id="sid" class="form-control">
																							<option value="<?php echo $staffName->sid?>" selected="selected" ><?php  echo $staffName->FULL_NAME  ?></option>

 </select></span>					
                                   
                                </div>
                            </div>
									<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('send to designation');?></label>
                                <div class="col-sm-5">
							
                      <select  name="desig_id" id="desig_id" class="form-control">
																							
<?php foreach($designation->result() as $row2)
												{
		
													?>
					<option value="<?php echo $row2->designation_id;?>"><?php  echo $row2->designation_name;?></option>
<?php 
	}
	?>
																				</select>				
                                   
                                </div>
                            </div>
							    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="send_date" value="<?php echo $row_memo['memo_date'] ?>"/>
                                </div>
                            </div>
							 
							  
							  	  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo comment');?></label>
                                <div class="col-sm-5">
													
                                   <textarea class="form-control html5editor" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css" name="memo_comment" ><?php echo $row_memo['memo_corresponding_comment']?></textarea>
                                </div>
                            </div>
					       <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update pending memo');?></button>
                              </di
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