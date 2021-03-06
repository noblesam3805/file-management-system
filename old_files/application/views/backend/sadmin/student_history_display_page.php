
        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('student_payment-history_list');?>
                        </a></li>
         
            
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
                            <th><div><?php echo get_phrase('Amount');?></div></th>
							
							 <th><div><?php echo get_phrase('Session');?></div></th>
                              <th><div><?php echo get_phrase('Department');?></div></th>
							 <th><div><?php echo get_phrase('Level');?></div></th>
                            <th><div><?php echo get_phrase('Date & Time');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;
                            $totalAmount=0;
                        ?>
                        <?php foreach($payments as $row):
                          $student_id=$this->db->get_where('eduportal_fees_payment_log',array('payment_code'=>$row['rrr']))->row();
                            $student_info=$student_id->student_id;
                            $dept_name=$this->db->query("SELECT * FROM  student b, department c, schools d WHERE '$student_info'=b.student_id and b.dept=c.deptID and d.schoolid=b.school ")->row();
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php echo $row['payerID'];?>
							</td>
							  <td><?php echo $row['payername']?></td>
                            <td><?php echo $row['rrr'];?></td>
                          
                            <td><?php echo $row['paymentName'];
												
							?></td>
                           
                            <td>₦ <?php echo $row['amt'];?></td>
							 <td><?php 	echo $row['acadsession'];?></td>
					
                          
                            <td><?php
                          
                            echo $dept_name->deptName;
                            ?></td>
							
                            <td><?php echo $student_id->payment_level;?></td>
							<td><?php echo $row['dategenerated'];?></td>
                            <?php $i++;
                            $totalAmount+=$row['amt'];
                            ?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p>The Total Amount: <?php echo $totalAmount;?> </p></b></div>
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