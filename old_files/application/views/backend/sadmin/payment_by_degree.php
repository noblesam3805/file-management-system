<div class="row">

	<div class="col-md-12">



    	<div class="col-md-12">

            <!-- button starts -->

                <div class="btn-group pull-right">

                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">

                        Select Prog type <span class="caret"></span>

                    </button>

                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">



                        <!-- STUDENT PROFILE LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/payment_by_degree/">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('All_Degree_Students');?>

                                </a>

                                        </li>

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/payment_by_degree/regular">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('Degree_Regular');?>

                                </a>

                                        </li>



                        <!-- STUDENT EDITING LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/payment_by_degree/sandwich">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('Degree_Sandwich');?>

                                </a>

                                        </li>

                        <!--li class="divider"></li-->



                        <!-- STUDENT DELETION LINK >



                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/Union">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('Union_bank');?>

                                </a>

                                        </li>

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/etranzact/Fidelity">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('Fidelity_bank');?>

                                </a>

                                        </li-->

                    </ul>

                </br>

                </div>

                <!-- button ends-->

        </div>



        <!--CONTROL TABS START-->

		<ul class="nav nav-tabs bordered">

			<li class="active">

            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo get_phrase('_Degree_Student_payment_list');?>

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
                            <th><div><?php echo get_phrase('Reg_no');?></div></th>
                            <th><div><?php echo get_phrase('Full_name');?></div></th>
                            <th><div><?php echo get_phrase('Confirmation_code');?></div></th>
                            <th><div><?php echo get_phrase('Description');?></div></th>
                            <th><div><?php echo get_phrase('Amount(₦)');?></div></th>
                            <th><div><?php echo get_phrase('Bank_name');?></div></th>
                            <th><div><?php echo get_phrase('Branch_code');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($invoices as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['customer_id'];?></td>
                            <td><?php echo $row['fullname'];?></td>
                            <td><?php echo $row['confirm_code'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td>₦ <?php echo $row['amount'];?></td>
                            <td><?php echo $row['bankname'];?></td>
                            <td><?php echo $row['branchcode'];?></td>
                            <?php $i++;?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

                <div class="col-md-12"><b><p>The total number of payments from <?php echo $bank;?> bank: <?php echo $total; ?></p></b></div>

			</div>
			</div>
			</div>



            <!--div class="tab-pane box" id="slist">





                <table  class="table table-bordered datatable" id="table_export">

                    <thead>

                        <tr>

                            <th><div><?php echo get_phrase('Payment_#');?></div></th>

                            <th><div><?php echo get_phrase('Customer_id');?></div></th>

                            <th><div><?php echo get_phrase('Full_name');?></div></th>

                            <th><div><?php echo get_phrase('Receipt_no');?></div></th>

                            <th><div><?php echo get_phrase('Description');?></div></th>

                            <th><div><?php echo get_phrase('_Amount (?)');?></div></th>

                            <th><div><?php echo get_phrase('Bank_code');?></div></th>

                            <th><div><?php echo get_phrase('Branch_code');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($school as $row):?>

                        <tr>

                            <td><?php echo $row['id'];?></td>

                            <td><?php echo $row['customer_id'];?></td>

                            <td><?php echo $row['fullname'];?></td>

                            <td><?php echo $row['receipt_no'];?></td>

                            <td><?php echo $row['description'];?></td>

                            <td>? <?php echo $row['amount'];?></td>

                            <td><?php echo $row['bankcode'];?></td>

                            <td><?php echo $row['branchcode'];?></td>



                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

                <div class="row"><b><p>The total number of payments for <?php //echo $bank;?> School Fees: <?php echo $stotal; ?></p></b></div>

            </div>
			



            <div class="tab-pane box" id="hlist">





                <table  class="table table-bordered datatable" id="table_export">

                    <thead>

                        <tr>

                            <th><div><?php echo get_phrase('Payment_#');?></div></th>

                            <th><div><?php echo get_phrase('Customer_id');?></div></th>

                            <th><div><?php echo get_phrase('Full_name');?></div></th>

                            <th><div><?php echo get_phrase('Receipt_no');?></div></th>

                            <th><div><?php echo get_phrase('Description');?></div></th>

                            <th><div><?php echo get_phrase('_Amount (?)');?></div></th>

                            <th><div><?php echo get_phrase('Bank_code');?></div></th>

                            <th><div><?php echo get_phrase('Branch_code');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($hostel as $row):?>

                        <tr>

                            <td><?php echo $row['id'];?></td>

                            <td><?php echo $row['customer_id'];?></td>

                            <td><?php echo $row['fullname'];?></td>

                            <td><?php echo $row['receipt_no'];?></td>

                            <td><?php echo $row['description'];?></td>

                            <td>? <?php echo $row['amount'];?></td>

                            <td><?php echo $row['bankcode'];?></td>

                            <td><?php echo $row['branchcode'];?></td>



                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

                <div class="row"><b><p>The total number of payments for <?php //echo $bank;?> Hostels Fees: <?php echo $htotal; ?></p></b></div>

            </div-->

            <!----TABLE LISTING ENDS--->





			<!----CREATION FORM STARTS---->





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

                        "mColumns": [0, 1, 2, 3, 4, 5, 7]

                    },

                    {

                        "sExtends": "pdf",

                        "mColumns": [0, 1, 2, 3, 4, 5, 7]

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