<script type="text/javascript">
function approve()

{
var check = confirm("Do you want to Approve Application of this Applicant? Kindly Note this Proceess is Not Reversible.");
if(check==true)
{
	
}
else
{
	return false;
}
}
function disapprove()

{
var check = confirm("Do you want to Disapprove Application of this Student? Kindly Note this Proceess is Not Reversible.");
if(check==true)
{
	
}
else
{
	return false;
}

}
</script>
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
                    <?php echo get_phrase('_applicants_list');?>
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
							<th><div><?php echo get_phrase('Jamb_Regno');?></div></th>
                         
                            <th><div><?php echo get_phrase('Fullname');?></div></th>
							<th><div><?php echo get_phrase('Sex');?></div></th>
							
                   
                      
							
							<th><div><?php echo get_phrase('view_registration_details');?></div></th>
						
                          
                            <th><div><?php echo get_phrase('Action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php foreach($applicants as $row):
						
						?>
									<?php 
									//$paycheck = $db2->query("SELECT * FROM applicationinvoice_gen WHERE application_no='".$row["application_no"]."' and application_type_id='6' and status='Approved'")->row();
			//if($paycheck){?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
							echo $row["application_no"];
							?></td>
                            <td><?php echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                          </td>
                     
                            <td> <?php

							 echo $row["sex"];?></td>
                          
							
                            <td> 
                       <a href="http://45.34.15.68/application/admissions/qr_check2/<?php echo $row["pin"];?>" class="btn btn-success btn-sm" target="_blank"> View Full Details</a>   </td>
							<td>
			
							<a href="index.php?sadmin/approve_applicant/<?php echo $row["applicant_id"];?>"  onclick="return confirm('Do you want to Approve Application of this Applicant? Kindly Note this Proceess is Not Reversible.')" class="btn btn-success btn-sm " >
                       Approve
                     </a> <br> | <a href="http://45.34.15.68/application/admissions/application_SSCE_Verification/<?php echo $row["application_no"];?>" class="btn btn-danger btn-sm "  onclick="return confirm('Do you want to Disapprove Application of this Applicant? Kindly Note this Proceess is Not Reversible.')">
                        Disapprove  </a></td>
                            <?php $i++;
		//	}
							?>
                            
                        </tr>
                        <?php  endforeach;?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p><h4><?php echo $this->pagination->create_links(); ?></h4><br /></p></b></div>
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