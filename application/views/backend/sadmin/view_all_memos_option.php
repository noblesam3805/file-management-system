<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('view_all_memo_options');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                     
                        <?php echo form_open('sadmin/memos/PROCESS_VIEW_ALL_MEMO' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('memo options');?></label>
                                <div class="col-sm-5">
									<select  name="memo_option" id="memo_opion" class="form-control" >
				
																			<option value="ALL_SENT_MEMO">All Sent Memo</option>
                    <option value="ALL_REVEIVED_MEMO">All Received Memo</option>
																				<option value="ALL_REPLY_MEMO">All Replied Memos</option>
																				<option value="ALL_FORWARD_MEMO">All Forward Memo</option>
                    <option value="ALL_DRAFT_MEMO">All Draft Memo</option>
                      <option value="ALL_MEMO">All Memo</option>

 </select>
									
                                   
                                </div>
                            </div>
					
								
									
							    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('begin date');?></label>
                                <div class="col-sm-5">
                                    <input type="date" required="required" class="form-control" name="begin_date" value=""/>
                                </div>
                            </div>
							  
							 
							    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('end date');?></label>
                                <div class="col-sm-5">
                                    <input type="date" required="required" class="form-control" name="end_date" value=""/>
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