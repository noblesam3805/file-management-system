<div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <!-- button starts -->
                <div class="btn-group pull-right">
                   
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
                    <?php echo get_phrase('_remita_school_fees_payment_breakdown');?>
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
                
                
                <table  class="table table-bordered datatable" id="">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('S/N');?></div></th>
							<th><div><?php echo get_phrase('ITEMS');?></div></th>
                            <th><div><?php echo get_phrase('AMOUNT');?></div></th>
                            <th><div><?php echo get_phrase('NO PAID');?></div></th>
                            <th><div><?php echo get_phrase('TOTAL AMOUNT');?></div></th>
                        
                            
                        </tr>
                    </thead>
                    <tbody>
                     
						    <tr>
						      <td ><p>1</p></td>
						      <td ><p>Tuition fee</p></td>
						      <td ><p>Free</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?> </td>
						      <td ><?php echo number_format($no *0,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>2</p></td>
						      <td ><p>Caution fee</p></td>
						      <td ><p>5,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *5000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>3</p></td>
						      <td ><p>Consumables for Academic work</p></td>
						      <td ><p>5,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *5000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>4</p></td>
						      <td ><p>Examination fee</p></td>
						      <td ><p>5,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *5000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>5</p></td>
						      <td ><p>Library fee</p></td>
						      <td ><p>3,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *3000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>6</p></td>
						      <td ><p>Sports fee</p></td>
						      <td ><p>2,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *2000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>7</p></td>
						      <td ><p>Students I.D Card</p></td>
						      <td ><p>1,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *1000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>8</p></td>
						      <td ><p>Student Hand Book</p></td>
						      <td ><p>2,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *2000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>9</p></td>
						      <td ><p>Course Registration fee</p></td>
						      <td ><p>5,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *5000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>10 </p></td>
						      <td ><p>Log Book (SIWES)</p></td>
						      <td ><p>3,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *3000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>11</p></td>
						      <td ><p>Registration fee : (i) School<br />
						        (ii) Department</p></td>
						      <td ><p>1,500.00<br />
						        1,500.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *1500 *2,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>12</p></td>
						      <td ><p>Verification of Credentials</p></td>
						      <td ><p>3,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *3000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>13</p></td>
						      <td ><p>Matriculation fee</p></td>
						      <td ><p>2,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *2000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>14</p></td>
						      <td ><p>ICT Portal Maintenance fee</p></td>
						      <td ><p>4,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *4000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>15</p></td>
						      <td ><p>Medical Examination</p></td>
						      <td ><p>5,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *5000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>16</p></td>
						      <td ><p>Utilities/Services</p></td>
						      <td ><p>2,500.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *2500,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>17</p></td>
						      <td ><p>Handling Charge</p></td>
						      <td ><p>500.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *500,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>18</p></td>
						      <td ><p>Development Levy</p></td>
						      <td ><p>10,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *10000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p>19</p></td>
						      <td ><p>Workshop Laboratory fee</p></td>
						      <td ><p>1,000.00</p></td>
						      <td ><?php  $this->db->where('service_type', '2897987572'); $no=$this->db->from('eduportal_remita_payment')->count_all_results();
echo $no;							  // ;?></td>
						      <td ><?php echo number_format($no *1000,2);?></td>
					        </tr>
						    <tr>
						      <td ><p></p></td>
						      <td ><p><strong>TOTAL    FEE PAYMENTS ==</strong></p></td>
						      <td ><p><strong>#62,000.00</strong></p></td>
						      <td >&nbsp;</td>
						      <td >#<?php echo number_format($no *62000,2);?></td>
					        </tr>
                        
                    </tbody>
                </table>
                <div class="col-md-12"><b><p> <?php echo $total; ?></p></b></div>
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