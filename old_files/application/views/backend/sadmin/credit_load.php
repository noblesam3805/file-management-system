<?php  session_start(); ?>
<div class="row">
	
    <div class="col-md-12">



        


        <!--CONTROL TABS START-->

       

        <!--CONTROL TABS END-->
      <div class="widget stacked widget-table">
	   <div class="widget-content">

        <div class="tab-content">

            <!--TABLE LISTING STARTS-->

            <div class="tab-pane box active" id="list">



				<?php if(isset($_SESSION['report'])){
					echo "<p style='background:#043762; font-size:16px; text-align:center; padding:5px; border-radius:2px;color:#e5e5e5;'>" . $_SESSION['report'] . "</p>";} 
					
					?>

                <table  class="table table-bordered datatable" id="table_export">

                    <thead>

                        <tr>
                            <th><div><?php echo get_phrase('# S/N');?></div></th>

                            <th><div><?php echo get_phrase('_SEMSTER');?></div></th>

                            <th><div><?php echo get_phrase('LEVEL');?></div></th>

                            <th><div><?php echo get_phrase('PROGRAMME');?></div></th>

                            <th><div><?php echo get_phrase('MAX LOAD');?></div></th>

                            <th><div><?php echo get_phrase('MIN LOAD');?></div></th>

							<th><div><?php echo get_phrase('_OPTION');?></div></th>
							<th><div><?php echo get_phrase('_OPTION2');?></div></th>

                            

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>

                        <?php foreach($creditLoad as $row):?>

                        <tr>
                            <td><?php echo $i;?></td>

                            <td><?php echo $row['semester'];?></td>

                            <td><?php echo $row['level'];?></td>

                            <td><?php echo $row['programme'];?></td>

                            <td><?php echo $row['sem_max_load'];?></td>

                            <td><?php echo $row['sem_min_load'];?></td>

                            <td><a class="btn btn-info btn-sm " href="">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm " href="">Remove</a></td>
                            
                            <?php $i++;?>


                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

                <div class="col-md-12"><b><p>The total number of Records <?php echo $total; ?></p></b></div>

            </div>

        </div>
       </div>
	  </div>
    </div>

</div>
<?php
	if(isset($_SESSION['report'])){
		unset($_SESSION['report']);
	}
?>



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





        var datatable = $("#table_export3").dataTable({

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