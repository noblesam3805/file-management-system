<?php
 
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$login_details->sadmin_id;
$dept_id=$login_details->dept_id;
$desig_id=$login_details->desig_id;


$meetingdata=$this->db->query("select* from erp_meetings where (created_by='$sid' or requested_by='$sid') and (status='Not Commenced' or status='Commenced')")->result_array();

$meetingdata_invites=$this->db->query("select* from erp_meetings a, erp_meeting_invitees b where (a.meeting_uid=b.meeting_id) and (b.invitee_id='$sid') and (a.status='Not Commenced' or a.status='Commenced')")->result_array();

?>
<script type="text/javascript">
function checkdel()

{
var check = confirm("Do you want to delete name from admissions list?");
if(check==true)
{
	
}
else
{
	return false;
}
}
</script>
<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <!-- button starts -->
                <div class="btn-group pull-right">
                    
                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">

                      
                                </a>
                                        </li>-->
                    </ul>
                </br>
                </div>
                <!-- button ends-->
        </div>

        <!--CONTROL TABS START-->
  
		
		<?php

if($this->session->flashdata('message')) {
$message = $this->session->flashdata('message');
?>
<div class="<?php echo $message ?>"><?php echo $message; ?></div>
<?php
}

?>
		
        <!--CONTROL TABS END-->
	 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                 <p style="font-size: 20px; color:red"> CREATED OR INICIATED MEETINGS</p>
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                       <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							<th><div><?php echo get_phrase('meeting_title');?></div></th>
							<th><div><?php echo get_phrase('meeting_agenda');?></div></th>
							<th><div><?php echo get_phrase('initiated_by');?></div></th>
							<th><div><?php echo get_phrase('time_from');?></div></th>
							<th><div><?php echo get_phrase('time_to');?></div></th>
							<th><div><?php echo get_phrase('attendees');?></div></th>
							<th><div><?php echo get_phrase('venue');?></div></th>
                            <th><div><?php echo get_phrase('enable_zoom');?></div></th>
							
												
							<th><div><?php echo get_phrase('status');?></div></th>
						
								<th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($meetingdata as $row):?>
                      <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['meeting_title'];
							?></td>
							<td><?php 
							
							echo $row['meeting_agenda'];
							?></td>
							<td><?php
							  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['requested_by']))->row();
							echo $staff_name->name;
							?>(<?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_name->desig_id))->row()->designation_name;
						
							?>)</td>
							<td><?php
							echo $row['time_from'];
							
							?></td>
							<td><?php
							echo $row['time_to'];
							
							?></td>
							<td><?php
							echo $row['attendees'];
							
							?></td>
							<td><?php
							echo $row['venue'];
							
							?></td>
							<td><?php
							echo $row['enable_zoom'];
							
							?></td>
							<td><?php
							echo $row['status'];
							
							?></td>
                           
							<td>
							
										<?php if($meetingdata)

{?>
								<a href="<?php echo base_url().'index.php?sadmin/start_meeting/'.$row['meeting_uid'];?>" class="btn btn-success">
											Start Meeting										
									</a>
<?php } else {?>
<a href="<?php echo base_url()."index.php?sadmin/startvirtualmeetings/".$row['meeting_uid'];?>" class="btn btn-success">
											Join Meeting										
									</a>
									
<?php }?>     </td>
                            <?php $i++;?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p></p></b></div>
            </div>


            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->


        </div>
       </div>
	  </div>


 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
               <p style="font-size: 20px; color:red"> INVITED MEETINGS</p>
                
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                       <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							<th><div><?php echo get_phrase('meeting_title');?></div></th>
							<th><div><?php echo get_phrase('meeting_agenda');?></div></th>
							<th><div><?php echo get_phrase('initiated_by');?></div></th>
							<th><div><?php echo get_phrase('time_from');?></div></th>
							<th><div><?php echo get_phrase('time_to');?></div></th>
							<th><div><?php echo get_phrase('attendees');?></div></th>
							<th><div><?php echo get_phrase('venue');?></div></th>
                            <th><div><?php echo get_phrase('enable_zoom');?></div></th>
							
												
							<th><div><?php echo get_phrase('status');?></div></th>
						
								<th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($meetingdata_invites as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['meeting_title'];
							?></td>
							<td><?php 
							
							echo $row['meeting_agenda'];
							?></td>
							<td><?php
							  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['requested_by']))->row();
							echo $staff_name->name;
							?>(<?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$staff_name->desig_id))->row()->designation_name;
						
							?>)</td>
							<td><?php
							echo $row['time_from'];
							
							?></td>
							<td><?php
							echo $row['time_to'];
							
							?></td>
							<td><?php
							echo $row['attendees'];
							
							?></td>
							<td><?php
							echo $row['venue'];
							
							?></td>
							<td><?php
							echo $row['enable_zoom'];
							
							?></td>
							<td><?php
							echo $row['status'];
							
							?></td>
							
                         
							
                           
							<td>			<?php if($meetingdata)

{?>
								<a href="<?php echo base_url().'index.php?sadmin/start_meeting/'.$row['meeting_uid'];?>" class="btn btn-success">
											Start Meeting										
									</a>
<?php } else {?>
<a href="<?php echo base_url()."index.php?sadmin/startvirtualmeetings/".$row['meeting_uid'];?>" class="btn btn-success">
											Join Meeting										
									</a>
									
<?php }?>
				</td>
                            <?php $i++;?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p></p></b></div>
            </div>


            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->


        </div>
       </div>
	  </div>	  
	</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

    jQuery(document).ready(function($)
    {


        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [

                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, true);
                            datatable.fnSetColumnVis(5, true);

                            this.fnPrint( true, oConfig );

                            window.print();

                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(1, true);
                                      datatable.fnSetColumnVis(5, true);
                                  }
                            });
                        },

                    },
                ]
            },

        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>