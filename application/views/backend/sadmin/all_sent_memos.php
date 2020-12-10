<?php
$memodata=$this->db->query("select* from erp_memo_act where memo_initiator_sid='".$this->session->userdata('sid')."' order by id DESC")->result_array();
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
							<th><div><?php echo get_phrase('Title');?></div></th>
							<th><div><?php echo get_phrase('send to Name');?></div></th>
							<th><div><?php echo get_phrase('send_to_dept');?></div></th>
                            <th><div><?php echo get_phrase('send_to_designation');?></div></th>
							
							<th><div><?php echo get_phrase('sent_to_comment');?></div></th>
                           
							<th><div><?php echo get_phrase('memo_sent_date');?></div></th>
							<th><div><?php echo get_phrase('minutes');?></div></th>
<th><div><?php echo get_phrase('Status');?></div></th>
						
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
							echo  $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$row['send_to_sid']))->row()->name;
							
							?></td>
                            <td><?php
							 echo $dept_name=$this->db->get_where('department',array('deptID'=>$row['send_to_dept_id']))->row()->deptName;
							?></td>
                            
                            <td><?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['send_to_desig_id']))->row()->designation_name;
						
							?></td>
                            <td><?php echo $row['memo_corresponding_comment']?></td>
							<td><?php echo $row['memo_date']?></td>
							<td><?php echo $row['memo_minutes']?></td>
							<td ><b><?php echo $row['memo_status']; if($row['memo_status']=="PENDING"){ echo '<span style="color: orange">'." AWAITING RESPONSE FROM ". $row['awaiting_staff_minute_name'].'</span>';}
if($row['memo_status']=="READ"){ echo '<span style="color: green">'." AWAITING REPLY FROM ". $row['awaiting_staff_minute_name'].'</span>';}							?></b></td>
						
                           
							<td><a href="index.php?sadmin/memos/VIEW_MEMO_DETAILS/<?php echo $row['id'];?>" class="btn btn-info btn-sm " >
                       View
                     </a>| <a href="index.php?sadmin/memos/EDIT_MEMO_SENT/<?php echo $row['id'];?>" class="btn btn-primary btn-sm ">
                        Edit  </a></td>
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