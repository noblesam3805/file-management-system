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





                
    <style type="text/css">
    .modal .modal-body {
    max-height: 420px;
    overflow-y: auto;
    }
    </style>


<div ng-controller="studentCrtl">
<div class="container">

    <div class="row">
        <div class="col-md-2">PageSize:
            <select ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total Etranzact Payments</h5>
        </div>
    </div>
    <br/>
    
    <div class="row">
        <div style="width:100%;  text-align:center;">
        <img id="spinner" ng-src="assets/images/preloader.gif" style="margin:auto;display:none;">
    </div>
        <div class="col-md-10" ng-show="filteredItems > 0">
            <table class="table table-bordered datatable">
            <thead>
            <th>#</th>   
            <th>Reg Number&nbsp;<a ng-click="sort_by('reg_no');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Last Name&nbsp;<a ng-click="sort_by('name');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Other Names&nbsp;<a ng-click="sort_by('othername');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Sex&nbsp;<a ng-click="sort_by('sex');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Programme&nbsp;<a ng-click="sort_by('programme');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Prog Type&nbsp;<a ng-click="sort_by('prog_type');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Level&nbsp;<a ng-click="sort_by('level');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>School&nbsp;<a ng-click="sort_by('school');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th></th>
            
            </thead>
            <?php //$i=1;?>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.student_id}}</td>
                    <td>{{data.reg_no}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.othername}}</td>
                    <td>{{data.sex}}</td>
                    <td>{{data.programme}}</td>
                    <td>{{data.prog_type}}</td>
                    <td>{{data.level}}</td>
                    <td>{{data.school}}</td>
                    <!-- onlick="showAjaxModal('echo base_url();?>index.php?modal/popup/modal_etranzact/{{data.student_id}}');"-->
                    <td ><a >
                        <button type="submit" ng-click="open(data.student_id)" class="btn btn-info xs-3"><i class="entypo-pencil"></i>pay</button>
                    </a>
                    </td>
                    
                    
                </tr>
                <?php //$i++;?>
            </tbody>
            </table>
        </div>
        <div class="col-md-10" ng-show="filteredItems == 0">
            <div class="col-md-12 pull-left">
                <h4>No Student Payments found</h4>
            </div>
        </div>
        <div class="col-md-8" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" max-size="maxSize" rotate="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>

            
        </div>
    </div>
</div>
</div>

<div ng-controller="ModalDemoCtrl">
    <script type="text/ng-template" id="myModalContent.html">
<?php 
$edit_data      =   $this->db->get_where('student' , array('student_id' => ' ') )->result_array();
//foreach ( $edit_data as $row):
?>      
        <div class="modal-header">
            <button type="button" class="close" ng-click="cancel()" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title"><?php echo get_phrase('Pay_student_fees');?></h3>
        </div>
        <div class="modal-body" ng-repeat="item in etti">

<!--ul ng-repeat="item in etti"->
<div ng-repeat="item in etti">
    <li >{{ item.student_id }}</li>
    <li >{{ item.reg_no }}</li>
    <li >{{ item.name }}</li>
    <li >{{ item.othername }}</li>
    <li >{{ item.sex }}</li>
</div>
<!--/ul->

            Output: <b>{{ etti.item }}</b></br>

            Selected: <b></b>-->

        <?php echo form_open('admin/etranzact/do_update' , array('class' => 'form-horizontal form-groups-bordered validate','target' => '_top', 'enctype' => 'multipart/form-data'));?>
                
                    
    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url();?>uploads/student_image/{{ item.student_id }}.jpg<?php //echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Reg_no');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="serial" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['reg_no'];?>{{ item.reg_no }}">
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last_name');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>{{ item.name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Other_name');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="oname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['othername'];?>{{ item.othername }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>

                        <div class="col-sm-5">
                            <input type="text" ng-model="dart.conf" required min="20" class="form-control" name="CONFIRMATION_NO" placeholder="Enter Etranzact Confirmation Number"/>
                        </div>
                    </div>
                            <input type=hidden name = 'TERMINAL_ID' value='2140214016'>
                    <div class="form-group">
                       <label class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>
                        <div class="col-sm-5">
                            <select id="session" name="session" class="form-control" >
                            <option> 2012/2013 </option>
                             <option> 2013/2014 </option>
                            <option selected='selected' > 2014/2015 </option>
                           </select>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Prog_type');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="prog_type" value="<?php echo $row['prog_type'];?>{{ item.prog_type }}" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>{{ item.address }}" >
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>{{ item.phone }}" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Dept');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="dept" value="<?php echo $row['dept'];?>{{ item.dept }}" >
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('level');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="level" value="<?php echo $row['level'];?>{{ item.level }}">
                        </div>
                    </div>
                    
                    <!--div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Process Fees');?></button>
                        </div>
                    </div-->
                <?php echo form_close();?>
            
        </div>
        
<?php
$this->session->unset_userdata('post');
//endforeach;
?>
        <div class="modal-footer">
            <button class="btn btn-primary" data-ng-click="proceed()">SUBMIT</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

    <!--button class="btn btn-default" ng-click="open()">Open me!</button>
    <button class="btn btn-default" ng-click="open('lg')">Large modal</button>
    <button class="btn btn-default" ng-click="open('sm')">Small modal</button>
    <div ng-show="selected">Selection from a modal: {{ selected }}</div-->
</div>
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