<script type="text/javascript">
function checkdel()

{
var check = confirm("Do you want to delete this lecturer record?");
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
                    <?php echo get_phrase('_student_record');?>
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
							
                         
                            <th><div><?php echo get_phrase('Fullname');?></div></th>
							<th><div><?php echo get_phrase('Email');?></div></th>
							<th><div><?php echo get_phrase('Phone');?></div></th>
                           
							
                            <th><div><?php echo get_phrase('Dept');?></div></th>
							<th><div><?php echo get_phrase('Faculty');?></div></th>
                          <th><div><?php echo get_phrase('User Role');?></div></th>
                            <th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($admlist as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['name']
							?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            
							      <td><?php 
							$dept = $this->db->query("SELECT * FROM department WHERE deptID=".$row['dept_id']."")->row();
							echo $dept->deptName;?></td>
                           
                            <td> <?php
$faculty = $this->db->query("SELECT * FROM schools WHERE id=".$dept->schoolid."")->row()->schoolname;
							echo $faculty;?></td>
                      
							    <td><?php 
							if($row['level']==1)
							{
							echo "Bursary";
							}
							if($row['level']==6)
							{
							echo "Lecturer";
							}
							if($row['level']==7)
							{
							echo "Class Adviser";
							}
							if($row['level']==8)
							{
							echo "Super Admin";
							}
							if($row['level']==9)
							{
							echo "HOD";
							}
							if($row['level']==10)
							{
							echo "Database Staff";
							}
							if($row['level']==11)
							{
							echo "Dean";
							}?></td>
							<td><a href="index.php?sadmin/edituseraccount/<?php echo $row['sadmin_id'];?>" class="btn btn-danger btn-sm " >
                       Edit
                     </a>| <a href="index.php?sadmin/delete_lecturerlist/<?php echo $row['sadmin_id'];?>" class="btn btn-success btn-sm "  onclick="checkdel()">
                        Delete  </a></td>
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