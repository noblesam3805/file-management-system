<?php
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$this->session->userdata('sadmin_id');
$meetingdata=$this->db->query("select* from erp_meetings where meeting_uid='$meeting_id'")->result_array();

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
        <?php 
                    foreach($meetingdata as $row):
                        ?>
		<p style="font-size: 14px; color:green; font-family: Calibiri">Agenda: <?php echo $row['meeting_agenda'];?> Time: <?php echo $row['time_from'].' -'.$row['time_to'];?> Initiator: <?php 
									  $requested_by= $this->db->get_where('sadmin',array('sadmin_id'=>$row['requested_by']))->row();
									echo $requested_by->name;
									?> (<?php
									 echo $this->db->get_where('erp_staff_designations',array('designation_id'=>$requested_by->desig_id))->row()->designation_name;
									
									?>)
		<?php
                    endforeach;
                    ?></p>
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 1px">
                <div class="box-content">
					
                        
						<form class ="form-horizontal form-groups-bordered validate" >
							
						
							<iframe src="<?php echo base_url(); ?>/capture/customer/register.php?id=<?php echo $row['id'] ?>" style="width: 100%; height: 400px"></iframe>
							
							<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
								<?php  if($sid==$row['requested_by']) {?>
                                 <a  href="<?php echo base_url().'index.php?sadmin/end_meeting/'.$row['meeting_uid']; ?>"
								  <button  class="btn btn-info">End Meeting</button>
                                    </a>
							 <?php }?>
							   <a  href="<?php echo base_url().'index.php?sadmin/view_meetings'; ?>"
								  <button  class="btn btn-info">Close</button>
                                    </a>
							  </div>
								</div>
                           
                        </form>
					
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>


