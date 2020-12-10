<script type="text/javascript">
function checkdel(str)

{
var check = confirm("Do you want to delete this invoice? Note that this process is not reversible.");
if(check==true)
{
	window.location ="index.php?sadmin/delete_sch_fee_invoice/" + str;
}
else
{

return false;
}
return false;
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
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('_admissions_list');?>
                        </a></li>
            <!--li >
                <a href="#slist" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('_school_fees_list');?>
                        </a></li>
            <li >
                <a href="#hlist" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('_hostel_fees_list');?>
                        </a></li-->
            
        </ul>
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
							<th><div><?php echo get_phrase('Regno');?></div></th>
                         
                            <th><div><?php echo get_phrase('Surname');?></div></th>
							<th><div><?php echo get_phrase('Othernames');?></div></th>
						
                            <th><div><?php echo get_phrase('Order_ID');?></div></th>
							<th><div><?php echo get_phrase('RRR');?></div></th>
							<th><div><?php echo get_phrase('Amount');?></div></th>
							<th><div><?php echo get_phrase('Session');?></div></th>
                            <th><div><?php echo get_phrase('Dept');?></div></th>
							<th><div><?php echo get_phrase('Level');?></div></th>
                            <th><div><?php echo get_phrase('Status');?></div></th>
                          
                            <th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($feeinvoice as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['portal_id']
							?></td>
                            <td><?php echo $row['surname'];?></td>
                            <td><?php echo $row['firstname'];?></td>
                     
                            <td><?php echo $row['order_id']; ?></td>
                            <td> <?php echo $row['rrr'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['session_id'];?></td>
							   <td><?php 
							$dept = $this->db->query("SELECT * FROM department WHERE deptID=".$row['dept_id']."")->row()->deptName;
							echo $dept;?></td>
                            <td><?php echo $row['level'];?></td>
							 <td><?php echo $row['status'];?></td>
							<td> 
							<?php if($row['status']=="Approved"){} else {?>
							<a href="#" class="btn btn-success btn-sm "  onclick="checkdel(<?php echo $row['application_invoice_id'];?>);">
							Delete  </a><?php }?></td>
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