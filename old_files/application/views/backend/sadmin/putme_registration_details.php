<?php  session_start(); ?>
<div class="row">
	
    <div class="col-md-12">
    <div class="widget stacked widget-table">
		<div class="widget-content">
		<?php //var_dump($regDetails); ?>
        <div class="tab-content">
            <div class="tab-pane box active" id="list">

                <table  class="table table-bordered datatable" id="table_export">

                    <thead>

                        <tr>
                            <th><div><?php echo get_phrase('# S/N');?></div></th>

                            <th><div><?php echo get_phrase('PUTMEID');?></div></th>

                            <th><div><?php echo get_phrase('FULLNAME');?></div></th>

                            <th><div><?php echo get_phrase('_SEX');?></div></th>

                            <th><div><?php echo get_phrase('JAMB');?></div></th>

                            <th><div><?php echo get_phrase('_PHONE');?></div></th>

							<th><div><?php echo get_phrase('NATIONALITY');?></div></th>
							<th><div><?php echo get_phrase('DATE REGISTERED');?></div></th>
							<th><div><?php echo get_phrase('REGISTERED BY');?></div></th>
							<th><div><?php echo get_phrase('_PHOTO');?></div></th>
							<th><div><?php echo get_phrase('ACTION');?></div></th>

                            

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>

                        <?php foreach($regDetails as $row):
							$cardd = $this->db->get_where('putme_card_details', array("putme_id" => $row['putme_id']))->row();
							//$card = $this->db->get_where('putme_scratch_cards', array("used_by" => $row['putme_id']))->row();
							$user = $this->db->get_where('putme_users', array("user_id" => $row['registered_by']))->row();
						?>

                        <tr>
                            <td><?php echo $i;?></td>

                            <td><?php echo $row['putme_id'];?></td>

                            <td><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];?></td>

                            <td><?php echo $row['sex'];?></td>

                            <td><?php echo $cardd->jamb;?></td>

                            <td><?php echo $cardd->phone;?></td>
							
							<td><?php echo $row['nationality'];?></td>
							
							<td><?php echo $cardd->date;?></td>
							
							<td><?php echo $user->name;?></td>
							
							<td><img style="width:35px; height:35px; border-radius:35px;" src="<?php echo 'putme/uploads/student_image/' . $row['photo'] . '.jpg'; ?>" /></td>

                            <td><a href=""><i class="entypo-pencil"></i> View</a></td>
                            
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