<?php
//QR CODE =============



	$PNG_TEMP_DIR = base_url().'staff/';

    $PNG_WEB_DIR = 'staff/';



    include "QR/qrlib.php";



    //remember to sanitize user input in real-life solution !!!

    $errorCorrectionLevel = 'L';







    	$matrixPointSize = 4;
		?>
<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <!-- button starts -->
                <div class="btn-group pull-right">
                    
                    <ul class="dropdown-menu dropdown-default pull-right dropdown-menu-right" role="menu">

                      
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
                    <?php echo get_phrase('_student_record');?>
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
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							<th><div><?php echo get_phrase('staff_id');?></div></th>
                         
                            <th><div><?php echo get_phrase('Surname');?></div></th>
							<th><div><?php echo get_phrase('Firstname');?></div></th>
							<th><div><?php echo get_phrase('Middlename');?></div></th>
                           
							<th><div><?php echo get_phrase('Faculty/Unit');?></div></th>
                            <th><div><?php echo get_phrase('Dept');?></div></th>
							
                          
                          <th><div><?php echo get_phrase('Passport');?></div></th>
							<th><div><?php echo get_phrase('Signature');?></div></th>
							<th><div><?php echo get_phrase('QR Code');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($staffdata as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row['file_number']
							?></td>
                            <td><?php echo $row['surname'];?></td>
                            <td><?php echo $row['firstname'];?></td>
                            <td><?php echo $row['middlename']
							?></td>
                           
                            <td> <?php

							echo $row['staff_school'];?></td>
                            <td><?php 
							
							echo $row['staff_dept'];?></td>
							   
							<td><img src="<?php 
										$photo = 'staff/uploads/staff_image/' . $row['photo'] . '.jpg';
									
										echo $photo;?>"	width="100px" height="100px" /></td>
								<td><img src="<?php 
										$photo = 'staff/uploads/staff_signature/' . $row['signature'] . '.jpg';
									
										echo $photo;?>"	width="100px" height="100px" /></td>
								<td><img src="<?php
								$link = "http://iportal.ebsu.edu.ng/portal/index.php?staff_registration/registration_printout/$row[portal_id]" ;

//mysql_query("update qrcode_pins set is_printed ='1' where id = '$row[id]'") or die (mysql_error());

        $filename = "staff/$row[staff_id]".'.png';

       QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
							echo base_url().$filename;	
						
							?>" width="100px" height="100px" /></td>
						
                      
                            
                        </tr>
                            <?php $i++;?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p></p></b></div>
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
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7]
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