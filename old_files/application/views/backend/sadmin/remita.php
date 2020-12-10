<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <!-- button starts -->
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                        Select Bank <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">

                        <!-- STUDENT PROFILE LINK -->
                        <li>
                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/">
                                <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('All_banks');?>
                                </a>
                                        </li>
                       <!-- <li>
                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/Zenith">
                                <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('Zenith_bank');?>
                                </a>
                                        </li>
                      
                        <li>
                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/First">
                                <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('First_bank');?>
                                </a>
                                        </li>
                        <!--li class="divider"></li-->
                        
                        <!-- STUDENT DELETION LINK 

                        <li>
                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/FCMB">
                                <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('FCMB');?>
                                </a>
                                        </li>
                        <li>
                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/Alvana">
                                <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('Alvana_MF_bank');?>
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
							<th><div><?php echo get_phrase('Jamb_Regno');?></div></th>
                            <th><div><?php echo get_phrase('RRR');?></div></th>
                            <th><div><?php echo get_phrase('Full_name');?></div></th>
                            <th><div><?php echo get_phrase('Payment Type');?></div></th>
                            <th><div><?php echo get_phrase('Service Type');?></div></th>
                            <th><div><?php echo get_phrase('Amount');?></div></th>
                            <th><div><?php echo get_phrase('School');?></div></th>
							 <th><div><?php echo get_phrase('Department');?></div></th>
							 <th><div><?php echo get_phrase('Session');?></div></th>
							 <th><div><?php echo get_phrase('Level');?></div></th>
                            <th><div><?php echo get_phrase('Date & Time');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($invoices as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							if($row['service_type']=="2223831078")
							{
							$invoice_details=$this->db->get_where('eduportal_remita_accp_temp_data', array('rrr'=>$row['rrr']))->row();
							echo $invoice_details->putme_id;
							$my_data  = $this->db->get_where('student', array('portal_id' => $invoice_details->putme_id))->row();
							$yr = 'YEAR I';
							
							$session =$invoice_details->session;
							}
							else
							{
								$invoice_details=$this->db->get_where('invoice_gen', array('rrr'=>$row['rrr']))->row();
							echo $invoice_details->portal_id;
							$my_data  = $this->db->get_where('student', array('portal_id' => $invoice_details->portal_id))->row();
							$yr = $invoice_details->level;
							$session =$invoice_details->session_id;
							}
							$school = $this->db->get_where('schools', array("schoolid" => $my_data->school))->row();
$dept = $this->db->get_where('department', array("deptID" => $my_data->dept))->row();
$programme = $this->db->get_where('student_type', array("student_type_id" => $my_data->programme))->row();
$programme_type = $this->db->get_where('programme_type', array("programme_type_id" => $my_data->prog_type))->row();

							?></td>
                            <td><?php echo $row['rrr'];?></td>
                            <td><?php echo $row['payer_name'];?></td>
                            <td><?php if($row['service_type']=="2223831078")
							{
								echo "Acceptance Fee";
							}
							if($row['service_type']=="3276893356")
							{
								echo "School Fee";
							}
							if($row['service_type']=="538814560")
							{
								echo "Hostel Fee";
							}
							
							?></td>
                            <td><?php echo $row['service_type'];?></td>
                            <td>₦ <?php echo $row['amount'];?></td>
                            <td><?php echo $school->schoolname;?></td>
                            <td><?php echo $dept->deptName;?></td>
							<td><?php echo $session;?></td>
                            <td><?php echo $yr;?></td>
							<td><?php echo $row['trans_date'];?></td>
                            <?php $i++;?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p>The total number of payments from <?php echo $bank;?> bank: <?php echo $total; ?></p></b></div>
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