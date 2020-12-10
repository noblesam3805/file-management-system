<div class="row">

    <div class="col-md-12 no-p">



        <div class="col-md-12">

            <!-- button starts -->

                <div class="btn-group pull-right">

                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">

                        Select Prog <span class="caret"></span>

                    </button>

                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">



                        <!-- STUDENT PROFILE LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/student_report/">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('All_Students');?>

                                </a>

                                        </li>

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/student_report/degree">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('DEGREE STUDENTS');?>

                                </a>

                                        </li>



                        <!-- STUDENT EDITING LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/student_report/nce">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('NCE STUDENTS');?>

                                </a>

                                        </li>

                        <!--li class="divider"></li-->



                        <!-- STUDENT DELETION LINK -->





                    </ul>

                </br>

                </div>

                <!-- button ends-->

        </div>



        <!--CONTROL TABS START-->

        <ul class="nav nav-tabs bordered">

            <li class="active">

                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>

                    <?php echo get_phrase('_Student_Report');?>

                        </a></li>

            <li >

                <a href="#slist" data-toggle="tab"><i class="entypo-menu"></i>

                    <?php echo get_phrase('_male_students');?>

                        </a></li>

            <li >

                <a href="#hlist" data-toggle="tab"><i class="entypo-menu"></i>

                    <?php echo get_phrase('_female_students');?>

                        </a></li>



        </ul>

        <!--CONTROL TABS END-->
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">

					<!--TABLE LISTING STARTS-->

					<div class="tab-pane box active" id="list">





						<table  class="table table-bordered datatable" id="table_export">

							<thead class="mytable">

								<tr>
									<th><div><?php echo get_phrase('#');?></div></th>

									<th><div><?php echo get_phrase('Reg_no');?></div></th>

									<th><div><?php echo get_phrase('Last_name');?></div></th>

									<th><div><?php echo get_phrase('Other_names');?></div></th>

									<th><div><?php echo get_phrase('_Sex');?></div></th>

									<th><div><?php echo get_phrase('State of Origin');?></div></th>

									<th><div><?php echo get_phrase('LGA');?></div></th>

									<th><div><?php echo get_phrase('_school');?></div></th>

									<th><div><?php echo get_phrase('Hostel Name');?></div></th>

									<th><div><?php echo get_phrase('Room Number');?></div></th>

									

								</tr>

							</thead>

							<tbody>

								<?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
								<?php $i=1;?>

								<?php foreach($invoices as $row):?>

								<tr>
									<td><?php echo $i;?></td>

									<td><?php echo $row['reg_no'];?></td>

									<td><?php echo $row['name'];?></td>

									<td><?php echo $row['othername'];?></td>

									<td><?php echo $row['sex'];?></td>

									<td><?php echo $row['state'];?></td>

									<td><?php echo $row['lga'];?></td>

									<td><?php echo $row['school'];?></td>

									<td><?php echo $row['hostel_name'];?></td>

									<td><?php echo $row['room_number'];?></td>
									
									<?php $i++;?>


								</tr>

								<?php endforeach;?>

							</tbody>

						</table>

						<div class="col-md-12"><b><p>The total number of <?php echo $bank;?> Students: <?php echo $total; ?></p></b></div>

					</div>



					<div class="tab-pane box" id="slist">





						<table  class="table table-bordered datatable" id="table_export1">

							<thead>

								<tr>
									<th><div><?php echo get_phrase('#');?></div></th>

									<th><div><?php echo get_phrase('Reg_no');?></div></th>

									<th><div><?php echo get_phrase('Last_name');?></div></th>

									<th><div><?php echo get_phrase('Other_names');?></div></th>

									<th><div><?php echo get_phrase('_Sex');?></div></th>

									<th><div><?php echo get_phrase('State of Origin');?></div></th>

									<th><div><?php echo get_phrase('LGA');?></div></th>

									<th><div><?php echo get_phrase('_school');?></div></th>

									<th><div><?php echo get_phrase('Hostel Name');?></div></th>

									<th><div><?php echo get_phrase('Room Number');?></div></th>

								</tr>

							</thead>

							<tbody>

								<?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
								<?php $i=1;?>

								<?php foreach($male as $row):?>

								<tr>
									<td><?php echo $i;?></td>

									<td><?php echo $row['reg_no'];?></td>

									<td><?php echo $row['name'];?></td>

									<td><?php echo $row['othername'];?></td>

									<td><?php echo $row['sex'];?></td>

									<td><?php echo $row['state'];?></td>

									<td><?php echo $row['lga'];?></td>

									<td><?php echo $row['school'];?></td>

									<td><?php echo $row['hostel_name'];?></td>

									<td><?php echo $row['room_number'];?></td>
									<?php $i++;?>


								</tr>

								<?php endforeach;?>

							</tbody>
						</table>

						<div class="col-md-12"><b><p>The total number of Male students <?php //echo $bank;?> : <?php echo $stotal; ?></p></b></div>

					</div>



					<div class="tab-pane box" id="hlist">





						<table  class="table table-bordered datatable" id="table_export3">

							<thead>

								<tr>
									<th><div><?php echo get_phrase('#');?></div></th>

									<th><div><?php echo get_phrase('Reg_no');?></div></th>

									<th><div><?php echo get_phrase('Last_name');?></div></th>

									<th><div><?php echo get_phrase('Other_names');?></div></th>

									<th><div><?php echo get_phrase('_Sex');?></div></th>

									<th><div><?php echo get_phrase('State of Origin');?></div></th>

									<th><div><?php echo get_phrase('LGA');?></div></th>

									<th><div><?php echo get_phrase('_school');?></div></th>

									<th><div><?php echo get_phrase('Hostel Name');?></div></th>

									<th><div><?php echo get_phrase('Room Number');?></div></th>

								</tr>

							</thead>

							<tbody>

								<?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
								<?php $i=1;?>

								<?php foreach($female as $row):?>

								<tr>
									<td><?php echo $i;?></td>

									<td><?php echo $row['reg_no'];?></td>

									<td><?php echo $row['name'];?></td>

									<td><?php echo $row['othername'];?></td>

									<td><?php echo $row['sex'];?></td>

									<td><?php echo $row['state'];?></td>

									<td><?php echo $row['lga'];?></td>

									<td><?php echo $row['school'];?></td>

									<td><?php echo $row['hostel_name'];?></td>

									<td><?php echo $row['room_number'];?></td>
									<?php $i++;?>


								</tr>

								<?php endforeach;?>

							</tbody>

						</table>

						<div class="col-md-12"><b><p>The total number of female Students <?php //echo $bank;?> : <?php echo $htotal; ?></p></b></div>

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

                        //"mColumns": [0, 1, 2, 3,]

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

<script type="text/javascript">



    jQuery(document).ready(function($)

    {





        var datatable = $("#table_export1").dataTable({

            "sPaginationType": "bootstrap",

            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",

            "oTableTools": {

                "aButtons": [



                    {

                        "sExtends": "xls",

                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]

                        //"mColumns": [0, 1, 2, 3,]

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

<script type="text/javascript">



    jQuery(document).ready(function($)

    {





        var datatable = $("#table_export3").dataTable({

            "sPaginationType": "bootstrap",

            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",

            "oTableTools": {

                "aButtons": [



                    {

                        "sExtends": "xls",

                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]

                        //"mColumns": [0, 1, 2, 3,]

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