<script type="text/javascript">

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
                    <?php echo get_phrase('_school_fees_payment_list');?>
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
							<th><div><?php echo get_phrase('Jamb_Regno');?></div></th>
                         
                            <th><div><?php echo get_phrase('Surname');?></div></th>
							<th><div><?php echo get_phrase('Firstname');?></div></th>
							<th><div><?php echo get_phrase('Middlename');?></div></th>
                   
							<th><div><?php echo get_phrase('Faculty');?></div></th>
                            <th><div><?php echo get_phrase('Dept');?></div></th>
							<th><div><?php echo get_phrase('Programme Type');?></div></th>
                            <th><div><?php echo get_phrase('Programme');?></div></th>
                          
                            <th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($admlist as $row):
						$adm = $this->db->query("SELECT * FROM eduportal_admission_list WHERE application_no='".$row['regno']."'")->row();
 $check = $this->db->query("SELECT * FROM medical_screening WHERE regno='".$adm->application_no."'")->row();
		if($check)
		{
			
		}else {   ?>                   
					  <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $adm->application_no;
							?></td>
                            <td><?php echo $adm->surname;?></td>
                            <td><?php echo $adm->firstname;?></td>
                            <td><?php echo $adm->middlename
							?></td>
                     
                            <td> <?php
$faculty = $this->db->query("SELECT * FROM schools WHERE id=".$adm->school_id."")->row()->schoolname;
							echo $faculty;?></td>
                            <td><?php 
							$dept = $this->db->query("SELECT * FROM department WHERE deptID='".$adm->dept_id."'")->row()->deptName;
							echo $dept;?></td>
							   <td><?php 
							$ptype = $this->db->query("SELECT * FROM programme_type WHERE programme_type_id=".$adm->programme_type_id."")->row()->programme_type_name;
							echo $ptype;?></td>
							
                            <td><?php 
							$stype = $this->db->query("SELECT * FROM student_type WHERE student_type_id=".$adm->student_type."")->row()->student_type_name;
							echo $stype;?></td>
							<td>
						<?php	?>
							<a href="index.php?sadmin/assign_medical_facility/<?php echo $adm->id;?>"   class="btn btn-success btn-sm " >
                       Assign Facility
                     </a> </td>
                            <?php $i++;
		
							?>
                            
                        </tr>
                        <?php } endforeach;?>
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