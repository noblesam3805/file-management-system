<?php
 
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$login_details->sadmin_id;
$dept_id=$login_details->dept_id;
$desig_id=$login_details->desig_id;
echo $dept_id;
echo $desig_id;
$memodata=$this->db->query("select* from erp_memo_act_user_copied a, erp_memo_act b where a.memo_tracking_id=b.memo_tracking_id and a.staff_copied_id='$sid'")->result_array();
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
<div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

</div>
<?php
}

?>
		
        <!--CONTROL TABS END-->
	 <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                       <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							
							<th><div><?php echo get_phrase('title');?></div></th>
							<th><div><?php echo get_phrase('sender');?></div></th>
							<th><div><?php echo get_phrase('sender_department');?></div></th>
							<th><div><?php echo get_phrase('sender_designation');?></div></th>
							=<th><div><?php echo get_phrase('addressed_to');?></div></th>
							<th><div><?php echo get_phrase('memo_sent_date');?></div></th>
                            <th><div><?php echo get_phrase('comment');?></div></th>
							
												
							<th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($memodata as $row):?>
                        <tr>
                               <td><?php echo $i;?></td>
							   <td><?php echo $row['memo_title']?></td>
							<td><?php
							echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['memo_initiator_sid']))->row()->name;
							
							?></td>
                            <td><?php
							 echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['initiator_dept_id']))->row()->deptName;
							?></td>
                            
                            <td><?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['initiator_desig_id']))->row()->designation_name;
						
							?></td>
							<td><?php
							echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['send_to_sid']))->row()->name;
							
							?>(<?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['send_to_desig_id']))->row()->designation_name;
						
							?>)</td>
							<td><?php echo $row['memo_date']?></td>
                            <td><?php echo $row['memo_corresponding_comment']?></td>
							
							<td>
						
							
                           
					   <a href="index.php?sadmin/memos/VIEW_MEMO_DETAILS/<?php echo $row['id'];?>/<?php echo $row['memo_tracking_id'];?>" class="btn btn-success btn-sm " style="margin-left: 7px">
                       View
                     </a></td>
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