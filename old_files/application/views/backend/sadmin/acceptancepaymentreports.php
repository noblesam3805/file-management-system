<?php

?>

<div class="row">
    <div class="col-md-12">

        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('_remita_payment_list');?>
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
                            <th><div><?php echo get_phrase('#');?></div></th>
							<th><div><?php echo get_phrase('AppNo/Matric_no');?></div></th>
							     <th><div><?php echo get_phrase('Full_name');?></div></th>
                            <th><div><?php echo get_phrase('RRR');?></div></th>
                       
                            <th><div><?php echo get_phrase('Payment Type');?></div></th>
                            <th><div><?php echo get_phrase('Amount (₦)');?></div></th>
							  <th><div><?php echo get_phrase('Payment_Description');?></div></th>
                  
                            <th><div><?php echo get_phrase('School');?></div></th>
							 <th><div><?php echo get_phrase('Department');?></div></th>
							 <th><div><?php echo get_phrase('Session');?></div></th>
							 <th><div><?php echo get_phrase('Level');?></div></th>
                            <th><div><?php echo get_phrase('Date & Time');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                        <?php $i=1;?>
                        <?php
                          $totalAmount=0;
						 
					
						foreach($payments as $row):
						
						?>
						  
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php $regNo= $row['application_no'];
							  echo $regNo;
							  
							?>
							</td>
							  <td><?php
							  echo $row[surname].','.$row[firstname].' '.$row[middlename];
					?></td>
                            <td><?php echo $row['rrr'];?></td>
                          
                            <td><?php
					  $paymentTypeName = $this->db->query("SELECT * FROM payment_types where payment_type_id='$paymentType'")->row()->payment_type_name;
							echo $paymentTypeName;
							?></td>
                           
                            <td><?php
                            if($paymentType==4){
                            echo number_format($row['amount']);
                            }else{
                                echo number_format($row['amt']);  
                            }
                            ?></td>
							 <td><?php 	echo $row['surname'].','.$row['firstname'].' '.$row['middlename'].' made payment for '.$paymentTypeName;?></td>
                            <td><?php 
							  $schoolid = $row['school_id'];
							  $schoolName = $this->db->query("SELECT * FROM  schools   WHERE schoolid='$schoolid'")->row()->schoolname;
							 echo $schoolName;
							?></td>
                            <td><?php 
							  $deptID = $row['dept_id'];
							  $departmentName = $this->db->query("SELECT * FROM  department   WHERE deptID='$deptID'")->row()->deptName;
							
							echo $departmentName;
							
							?></td>
							<td><?php echo $row['session'];?></td>
                            <td>
							<?php 
							$programme_type_id=$row['programme_type_id'];
							
							 $programmeName = $this->db->query("SELECT * FROM  programme_type   WHERE programme_type_id='$programme_type_id'")->row()->programme_type_name;
							 echo $programmeName ;
							?>
							</td>
							<td><?php
                            if($paymentType==4){
                            echo $row['datetime'];
                            }
                            else{
                                echo $row['dategenerated']; 
                            }
                            ?></td>
                            <?php 
							$totalAmount+=$row['amount'];
							$i++;
							?>
                            
                        </tr>
						
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12" style='font-weight:bold'><b><p>The total number of payments base on the selected options:  <?php echo number_format($i-1);?> <br />
				the Total Amount: <?php echo number_format($totalAmount,2); ?></p></b></div>
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
                       "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8 ,9 ,10 ,11]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8 ,9 ,10 ,11]
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