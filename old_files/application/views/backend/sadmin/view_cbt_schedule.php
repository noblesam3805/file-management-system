
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
							<th><div><?php echo get_phrase('JAMB_REG_No');?></div></th>
                         <th><div><?php echo get_phrase('FIRSTNAME');?></div></th>
						     <th><div><?php echo get_phrase('MIDDLENAME');?></div></th>
							  <th><div><?php echo get_phrase('LASTNAME');?></div></th>
                            <th><div><?php echo get_phrase('EMAIL');?></div></th>
							<th><div><?php echo get_phrase('MOBILE NO');?></div></th>
							<th><div><?php echo get_phrase('PROGRAMME');?></div></th>
							
                   
							<th><div><?php echo get_phrase('IMAGE FILENAME');?></div></th>
                      
							
							<th><div><?php echo get_phrase('TIME SCHEDULE');?></div></th>
						
                          
                            <th><div><?php echo get_phrase('EXAM/SIT NO');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('application/config/z2.php');//$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $j=1;?>
                        <?php 
						$details =sqlsrv_query($conn,"SELECT * FROM cbt_final_exams_schedule where day='$exam' order by id ASC")or die ( print_r( sqlsrv_errors(), true));;
						while(list($id,$cand_no,$sitno,$day,$date,$time,$venue)=sqlsrv_fetch_array($details))
						{
						
						
						
						$application_query= sqlsrv_query($conn,"SELECT top(1)  application_no,firstname,middlename,surname, email,mobile_no FROM applicationinvoice_gen WHERE application_no='$cand_no' and application_type_id='1'")or die( print_r( sqlsrv_errors(), true));
						while(list($application_no,$fn,$midn,$sn,$email,$mn)=sqlsrv_fetch_array($application_query))
						{
						
						
						
					
	
						?>
									<?php 
			?>
                        <tr>
                            <td><?php echo $j;?></td>
							<td><?php 
							echo $application_no;
							?></td>
                            <td><?php 
							 echo $fn;//echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                          </td>
                     
                            <td> <?php

							 echo $midn;?></td>
							   <td> <?php

							 echo $sn;?></td>
							 
                            <td><?php echo $email;?></td>
							 <td><?php echo $mn;?></td>
                            <td>   <?php $dept_query= sqlsrv_query($conn,"SELECT  dept_name,cbt_time FROM   View_GetapplicantDepartment WHERE application_no='$cand_no'")or die( print_r( sqlsrv_errors(), true));
						while(list($dept,$cbt_time)=sqlsrv_fetch_array($dept_query))
						{
							echo $dept;
						}?>    		</td>
							<td>   <?php echo $application_no.' _Face.jpg';?>    		</td>
							<td>   <?php 
							
							
							echo $date.' , '.str_replace("?","-",mb_convert_encoding($time, 'UTF-8', 'UTF-8'));?>    		</td>
			<td>   <?php echo $sitno;?>    		</td>
							</td>
						<?php 
						$j++;
						
		
							?>
						
                        </tr>
                       <?php }  } ?>
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
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8, 9,10]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8,9,10]
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