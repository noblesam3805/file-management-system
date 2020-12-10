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
							<th><div><?php echo get_phrase('AppNo/Matric_no');?></div></th>
							     <th><div><?php echo get_phrase('Full_name');?></div></th>
                            <th><div><?php echo get_phrase('RRR');?></div></th>
                       
                            <th><div><?php echo get_phrase('Payment Type');?></div></th>
                            <th><div><?php echo get_phrase('Amount (₦)');?></div></th>
							  <th><div><?php echo get_phrase('Payment_Description');?></div></th>
                  
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
                        <?php
                          $totalAmount=0;
						 
					
						foreach($payments as $row):
						
						?>
						  <?php if($checkSession<2019){ ?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php $regNo= $row['payerID'];
							  echo $regNo;
							  
							?>
							</td>
							  <td><?php echo $row[payername];?></td>
                            <td><?php echo $row['rrr'];?></td>
                          
                            <td><?php echo $row['paymentName']?></td>
                           
                            <td><?php echo number_format($row['amt']);?></td>
							 <td><?php 	echo $row['paymentdescription'];?></td>
                            <td><?php 
							
							
							?></td>
                            <td><?php $programName=$row['programName'];
							echo $programName;?></td>
							<td><?php echo $row['acadsession'];?></td>
                            <td><?php if($programme_level==1){
								echo 'ND I';
							}
							if($programme_level==2){
								echo 'HND I';
							}
							if($programme_level==3){
								echo 'ND II';
							}
							if($programme_level==4){
								echo 'HND II';
							}
							if($programme_level==5){
								echo 'ND III';
							}
							if($programme_level==6){
								echo 'HND III';
							}
							if($programme_level==9){
								$regNoCheck1=substr("$regNo",0,1);
								$regNoCheck2=substr("$regNo",0,3);
							
								$regNoCheck3=substr("$regNo",0,7);
								$programDetailsCheck=substr("$programName",0,3);
								if($regNoCheck1==8 || $regNoCheck1==9){
									echo 'ND I';
								}
								if($regNoCheck2=='YCT' && $programDetailsCheck=='ND '){
								  echo 'ND I';
								} if($regNoCheck2=='YCT'&& $programDetailsCheck=='HND'){
								  echo 'HND I';
								}
								
									if($regNoCheck3=='F/ND/18'){
									echo 'ND I';
								}
								if($regNoCheck3=='F/ND/17'){
									echo 'ND II';
								}
									if($regNoCheck3=='P/ND/18'){
									echo 'ND I';
								}
								if($regNoCheck3=='P/ND/17'){
									echo 'ND II';
								}
								if($regNoCheck3=='F/HD/18'){
									echo 'HND I';
								}
								if($regNoCheck3=='F/HD/17'){
									echo 'HND II';
								}
									if($regNoCheck3=='P/HD/18'){
									echo 'HND I';
								}
								if($regNoCheck3=='P/HD/17'){
									echo 'HND II';
								}
									if($regNoCheck3=='P/HD/16' || $regNoCheck3=='P/HD/15'){
									echo 'HND III';
								}
								if($regNoCheck3=='P/ND/15' || $regNoCheck3=='P/ND/16'){
									echo 'ND III';
								}
							}
						    
							 
							?></td>
							<td><?php echo $row['dategenerated'];?></td>
                            <?php 
							$totalAmount+=$row['amt'];
							$i++;?>
                            
                        </tr>
						  <?php }else{?>
						  
						  <?php
						  
						  }?>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12" style='font-weight:bold'><b><p>The total number of payments base on the selected options:  <?php echo number_format($i);?> <br />
				the Total Amount: <?php echo number_format($totalAmount,2); ?></p></b></div>
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