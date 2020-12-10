<div class="row">

    <div class="col-md-12">



        <div class="col-md-12">

        </div>



        <!--CONTROL TABS START-->

        <ul class="nav nav-tabs bordered">

            <li class="active">

                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>

                    <?php echo get_phrase('_Student_Report');?>

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

                            <th><div><?php echo get_phrase('Last_name');?></div></th>

                            <th><div><?php echo get_phrase('Other_names');?></div></th>

                            <th><div><?php echo get_phrase('_Sex');?></div></th>

                            <th><div><?php echo get_phrase('reg_no');?></div></th>

                            <th><div><?php echo get_phrase('password');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>

                        <?php foreach($invoices as $row):?>

                        <tr>
                            <td><?php echo $i;?></td>

                            <td><?php echo $row['name'];?></td>

                            <td><?php echo $row['othername'];?></td>

                            <td><?php echo $row['sex'];?></td>

                            <td><?php echo $row['reg_no'];?></td>

                            <td><?php echo $row['password'];?></td>

                            <?php $i++;?>


                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

                <div class="col-md-12"><b><p>The total number of <?php echo $bank;?> Students: <?php echo $total; ?></p></b></div>

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