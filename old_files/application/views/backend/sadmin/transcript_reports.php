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
                     
                    </ul>
                </br>
                </div>
                <!-- button ends-->
        </div>

        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('transcript_applicants_reports');?>
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
	 <div class="widget stacked widget-table" style="width:100%">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                
                <table  class="table table-bordered datatable" id="table_export" >
                    <thead>
                         <tr>
            <th><?php echo 'S/N';?></th>
  <th><?php echo 'Application No';?></th>      
<th><?php echo 'Matric No';?></th>    
		   <th><?php echo 'Fullname';?></th>
			
            <th><?php echo 'School/Department';?></th>
          <th><?php echo 'Session';?></th>
		   <th><?php echo 'Grag.Yr';?></th>
		   <th><?php echo 'Email';?></th>
		    <th><?php echo 'Mobile No';?></th>
            <th><?php echo 'Transcript Type';?></th>
			<th><?php echo 'School Destination';?></th>
            <th><?php echo 'School Destination Address';?></th>
			<th><?php echo 'Courier';?></th>
			<th><?php echo 'Statement of Result';?></th>
			<th><?php echo 'Academic Record File';?></th>
			<th><?php echo 'Date Requested';?></th>
			<th><?php echo 'Payment RRR';?></th>
			<th><?php echo 'Amount';?></th>
           <th><?php echo 'Action';?></th>
        </tr>
                    </thead>
                    <tbody>
                       <?php $i=1;  foreach($applicants as $row) { 
		$destinations= $this->db->get_where('ebsuedu1_etranscript.transcript_applicants_destinations', array("rrr" => $row["pin"]))->row();
		$applicants_tert_details= $this->db->get_where('ebsuedu1_etranscript.hnd_applicants_tert_details', array("applicant_no" => $row["application_no"]))->row();
		?>   	
								
            <tr>
                <td><?php echo $i; ?> </td>
				<td><?php echo $row["application_no"]?></td>
				<td><?php echo $applicants_tert_details->matric_no;?></td>
                <td><?php echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                 <td><?php echo $this->db->get_where('`ebsuedu1_etranscript`.`faculty`', array("faculty_id" => $row["faculty_id"]))->row()->faculty_name." / ".$this->db->get_where('`ebsuedu1_etranscript`.`department`', array("dept_id" => $row["dept_id"]))->row()->dept_name;?></td>
                <td><?php echo $this->db->get_where('`ebsuedu1_etranscript`.`session`', array("session_id" => $row["session"]))->row()->session_name;?></td>
				<td><?php echo $applicants_tert_details->year;?></td>
				<td><?php echo $row["email"];?></td>
				
                <td><?php echo $row["mobile_no"];?></td> 
  <td><?php echo $destinations->payment_name;?></td> 				
<td><?php echo $destinations->destination_name;?></td>  
<td><?php echo $destinations->address.' '.$destinations->destination_id;?></td> 
<td><?php echo $destinations->courier_name;?></td> 
<td><a href="<?php echo 'https://iportal.ebsu.edu.ng/transcript/certfiles/'.$applicants_tert_details->statement_of_result;?>">Download Result Statement</a></td> 
<td>
<?php if($applicants_tert_details->academic_record) {
	?><a href="<?php echo 'https://iportal.ebsu.edu.ng/transcript/certfiles/'.$applicants_tert_details->academic_record;?>">Download Academic Record </a><?php }?></td> 

<td><?php echo $row["date_of_submission"];?></td> 
<td><?php echo $row["pin"];?></td> 
 	<td>N<?php echo number_format($destinations->amount);?></td> 			
                <td>
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php?sadmin/posttranscript/<?php echo $row["applicant_id"];?>" method="post" enctype="multipart/form-data" name="form<?php echo $row->id;?>">
	<input type="hidden" name="amount<?php echo $row->id;?>" value="<?php echo $row->amount;?>">
	

              
         <input type="submit" name="submit<?php echo $row->id;?>"  value="Post Transcript"   class="btn btn-default btn-sm btn-icon icon-left"/>
                        
                 
                    </td>
               
            </tr></form>
        <?php $i++; }  ?>
                    </tbody>
                </table>
                <div class="col-md-12"><b><p>The total number of payments from <?php echo $bank;?> bank: <?php echo $total; ?></p></b></div>
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