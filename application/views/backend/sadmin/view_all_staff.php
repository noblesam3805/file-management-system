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
							<th><div><?php echo get_phrase('staff_id');?></div></th>
                            <th><div><?php echo get_phrase('Payslip No');?></div></th>
							<th><div><?php echo get_phrase('Staff Name');?></div></th>
							<th><div><?php echo get_phrase('Designation');?></div></th>
                           
							<th><div><?php echo get_phrase('Grade Level');?></div></th>

							 <th><div><?php echo get_phrase('Phone No.');?></div></th>
							<th><div><?php echo get_phrase('Date of Appointment');?></div></th>
							<th><div><?php echo get_phrase('Date of Confirmation');?></div></th>
                          <th><div><?php echo get_phrase('Date of Birth');?></div></th>
                          <th><div><?php echo get_phrase('Passport');?></div></th>
							<th><div><?php echo get_phrase('Department');?></div></th>
						
							<th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($staffdata as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['staff_id']
							?></td>
                            <td><?php echo $row['payroll_no'];?></td>
                            <td><?php echo $row['FULL_NAME'];?></td>
                            <td><?php
							echo $designation=$this->db->get_where('erp_staff_designations',array('designation_id'=>$row['desig_id']))->row()->designation_name;
						
							?></td>
                            <td><?php echo $row['grade'].'/'. $row['steps']?></td>
							<td><?php echo $row['mobile']?></td>
							<td><?php echo $row['date_emp']?></td>
							<td><?php echo $row['date_confirmed']?></td>
							<td><?php echo $row['date_of_birth']?></td>
                            <td> <img src="<?php 
										$photo = 'staff/uploads/staff_image/' . $row['photo'] . '.jpg';
									
										echo $photo;?>"	width="25px" height="25px" /></td>
                            <td><?php echo $dept=$this->db->get_where('erp_depts',array('dept_code'=>$row['dept_code']))->row()->dept_name?></td>
							  
                           
							<td><a href="index.php?sadmin/staff/VIEW_STAFF_DETAILS/<?php echo $row['sid'];?>" class="btn btn-danger btn-sm " >
                       View
                     </a>| <a href="index.php?sadmin/staff/<?php echo $row['sid'];?>" class="btn btn-success btn-sm "  onclick="checkdel()">
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