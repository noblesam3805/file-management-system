 <script type="text/javascript">
function approve()

{
var check = confirm("Do you declare of this Student Physically fit? Kindly Note this Proceess is Not Reversible.");
if(check==true)
{
	
}
else
{
	return false;
}
}
function disapprove()

{
var check = confirm("Do you declare this Student Physically Unfit? Kindly Note this Proceess is Not Reversible.");
if(check==true)
{
	
}
else
{
	return false;
}
}
</script><div class="row">
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
                    <?php echo get_phrase('_assigned_students_list');?>
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
							<th><div><?php echo get_phrase('Firstname');?></div></th>
							<th><div><?php echo get_phrase('Middlename');?></div></th>
                   
							
                            <th><div><?php echo get_phrase('Dept');?></div></th>
						
                            <th><div><?php echo get_phrase('Programme');?></div></th>
                          
                            <th><div><?php echo get_phrase('Facility');?></div></th>
							 <th><div><?php echo get_phrase('Result Reports');?></div></th>
                            <th><div><?php echo get_phrase('Action');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($admlist as $row):
						$adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE application_no='".$row['regno']."'")->row();?>
                      <?php 
							   $student_attachment_info  = $this->db->get_where('student_medical_attachments', array('application_number' => $row['regno']))->result_array();
if( $student_attachment_info){						
						?> 
					   <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $adm->application_no;
							?></td>
                            <td><?php echo $adm->surname;?></td>
                            <td><?php echo $adm->firstname;?></td>
                            <td><?php echo $adm->middlename
							?></td>
                     
                
                           <td><?php 
							$dept = $this->db->query("SELECT * FROM department WHERE deptID='".$adm->dept_id."'")->row()->deptName;
							echo $dept;?></td>
                            <td><?php 
							$stype = $this->db->query("SELECT * FROM student_type WHERE student_type_id=".$adm->student_type."")->row()->student_type_name;
							echo $stype;?></td>
							<td>
						<?php 	echo $row["facility"];	?>
							</td>
							   <td><?php    foreach ($student_attachment_info as $row2) {?>
								    <a href="<?php echo base_url().'uploads/student_medical_attachments/'.$row2['file_name']; ?>" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                       Download 
                    </a><br/>
							   <?php  } ?>
							   </td>
							
								<td> 
							<?php 
							if($row["status"]==1)
							{
								echo "Cleared";
							}
							elseif($row["status"]==2)
							{
								echo "Not Fit";
							}
							else {
							
								?>
				<a href="index.php?sadmin/approve_medical/<?php echo $row["id"];?>"  onclick="return confirm('Do you declare of this Student Physically fit? Kindly Note this Proceess is Not Reversible.')" class="btn btn-success btn-sm " >
                       Fit
                     </a> <br> | <a href="index.php?sadmin/disapprove_medical/<?php echo $row["id"];?>" class="btn btn-danger btn-sm "  onclick="confirm('Do you declare this Student Physically Unfit? Kindly Note this Proceess is Not Reversible.')">
                        Not Fit  </a>
							</td>
							<?php }?>
                            <?php $i++;
		
							?>
                            
                        </tr><?php }?>
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