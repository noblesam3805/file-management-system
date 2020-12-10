<div class="row">

    <div class="col-md-12">



        <div class="col-md-12">

            <!-- button starts -->

                <div class="btn-group pull-right">

                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">

                        Select Prog <span class="caret"></span>

                    </button>

                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">



                        <!-- STUDENT PROFILE LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/degree_students/">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('All_DEGREE_Students');?>

                                </a>

                                        </li>

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/degree_students/degree_r">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('DEGREE REGULAR');?>

                                </a>

                                        </li>



                        <!-- STUDENT EDITING LINK -->

                        <li>

                            <a href="<?php echo base_url();?>index.php?sadmin/degree_students/degree_s">

                                <i class="entypo-credit-card"></i>

                                    <?php echo get_phrase('DEGREE SANDWICH');?>

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

                    <thead>

                        <tr>

                            <th><div><?php echo get_phrase('Reg_no#');?></div></th>

                            <th><div><?php echo get_phrase('Last_name');?></div></th>

                            <th><div><?php echo get_phrase('Other_names');?></div></th>

                            <th><div><?php echo get_phrase('_Sex');?></div></th>

                            <th><div><?php echo get_phrase('_Address');?></div></th>

                            <th><div><?php echo get_phrase('_Phone');?></div></th>

                            <th><div><?php echo get_phrase('_school');?></div></th>

                            <th><div><?php echo get_phrase('_department');?></div></th>

                            <th><div><?php echo get_phrase('_programme');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($invoices as $row):?>

                        <tr>

                            <td><?php echo $row['reg_no'];?></td>

                            <td><?php echo $row['name'];?></td>

                            <td><?php echo $row['othername'];?></td>

                            <td><?php echo $row['sex'];?></td>

                            <td><?php echo $row['address'];?></td>

                            <td><?php echo $row['phone'];?></td>

                            <td><?php echo $row['school'];?></td>

                            <td><?php echo $row['dept'];?></td>

                            <td><?php echo $row['programme'];?></td>



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

                            <th><div><?php echo get_phrase('Reg_no#');?></div></th>

                            <th><div><?php echo get_phrase('Last_name');?></div></th>

                            <th><div><?php echo get_phrase('Other_names');?></div></th>

                            <th><div><?php echo get_phrase('_Sex');?></div></th>

                            <th><div><?php echo get_phrase('_Address');?></div></th>

                            <th><div><?php echo get_phrase('_Phone');?></div></th>

                            <th><div><?php echo get_phrase('_school');?></div></th>

                            <th><div><?php echo get_phrase('_department');?></div></th>

                            <th><div><?php echo get_phrase('_programme');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($male as $row):?>

                        <tr>

                            <td><?php echo $row['reg_no'];?></td>

                            <td><?php echo $row['name'];?></td>

                            <td><?php echo $row['othername'];?></td>

                            <td><?php echo $row['sex'];?></td>

                            <td><?php echo $row['address'];?></td>

                            <td><?php echo $row['phone'];?></td>

                            <td><?php echo $row['school'];?></td>

                            <td><?php echo $row['dept'];?></td>

                            <td><?php echo $row['programme'];?></td>



                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

                <div class="col-md-12"><b><p>The total number of Male students <?php //echo $bank;?> : <?php echo $stotal; ?></p></b></div>

            </div>



            <div class="tab-pane box" id="hlist">





                <table  class="table table-bordered datatable" id="table_export2">

                    <thead>

                        <tr>

                            <th><div><?php echo get_phrase('Reg_no#');?></div></th>

                            <th><div><?php echo get_phrase('Last_name');?></div></th>

                            <th><div><?php echo get_phrase('Other_names');?></div></th>

                            <th><div><?php echo get_phrase('_Sex');?></div></th>

                            <th><div><?php echo get_phrase('_Address');?></div></th>

                            <th><div><?php echo get_phrase('_Phone');?></div></th>

                            <th><div><?php echo get_phrase('_school');?></div></th>

                            <th><div><?php echo get_phrase('_department');?></div></th>

                            <th><div><?php echo get_phrase('_programme');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>

                        <?php foreach($female as $row):?>

                        <tr>

                            <td><?php echo $row['reg_no'];?></td>

                            <td><?php echo $row['name'];?></td>

                            <td><?php echo $row['othername'];?></td>

                            <td><?php echo $row['sex'];?></td>

                            <td><?php echo $row['address'];?></td>

                            <td><?php echo $row['phone'];?></td>

                            <td><?php echo $row['school'];?></td>

                            <td><?php echo $row['dept'];?></td>

                            <td><?php echo $row['programme'];?></td>



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

                        //"mColumns": [0, 1, 2, 3, 4, 5, 7]

                        "mColumns": [0, 1, 2, 3,]

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

<script type="text/javascript">



    jQuery(document).ready(function($)

    {





        var datatable = $("#table_export2").dataTable({

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

