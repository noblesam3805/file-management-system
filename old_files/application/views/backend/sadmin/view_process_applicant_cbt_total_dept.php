
<div class="row">
    <div class="col-md-16">

        <div class="col-md-16">
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
                    <?php echo get_phrase('_applicants_list');?>
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
							<th><div><?php echo get_phrase('DEPARTMENT');?></div></th>
                         <th><div><?php echo get_phrase('TOTAL');?></div></th>
						     
							
                   
						
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('application/config/z2.php');//$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $j=1;?>
                        <?php 
						$db2= $this->load->database("db2",TRUE);			
		$depts = $db2->query("select *  from department where is_putme='1' order by dept_name");
		foreach($depts->result() as $row2)

	{

						
						
						
					
	
						?>
									<?php 
			?>
                        <tr>
                            <td><?php echo $j;?></td>
							<td><?php 
							echo $row2->dept_name;
							?></td>
                            <td><?php 
							  $c=$db2->query("select count(*) as expx FROM View_Applicant_Data where dept_id='$row2->dept_id' and  (has_cbt_sit = '1') AND (total_score IS NOT NULL)");
							  	foreach($c->result() as $row3)
								{
									echo $row3->expx;
									
								}
	//echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                         
						 </td>
                     
                            
						<?php 
						$j++;
						
		
							?>
						
                        </tr>
                       <?php }   ?>
                    </tbody>
                </table>
				
                <div class="col-md-12"><b><p><h4></h4><br /></p></b></div>
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
                        "mColumns": [0, 1, 2, 3]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3]
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