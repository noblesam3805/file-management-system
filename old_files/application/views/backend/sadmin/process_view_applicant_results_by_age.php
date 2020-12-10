
<div class="row">
    <div class="col-md-16">

        <div class="col-md-16">
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
							<th><div><?php echo get_phrase('JAMB_REG_No');?></div></th>
                         <th><div><?php echo get_phrase('FULLNAME');?></div></th>
						     
                            <th><div><?php echo get_phrase('SEX');?></div></th>
							 <th><div><?php echo get_phrase('DOB');?></div></th>
							<th><div><?php echo get_phrase('STATE');?></div></th>
							<th><div><?php echo get_phrase('PROGRAMME');?></div></th>
							<th><div><?php echo get_phrase('OLEVEL ACCEPTED');?></div></th>
                   
							<th><div><?php echo get_phrase('OLEVEL SUPPLIED');?></div></th>
							<th><div><?php echo get_phrase('NO OF SITTING');?></div></th>
							<th><div><?php echo get_phrase('UTME SCORE');?></div></th>
                      <th><div><?php echo get_phrase('UTME AVE');?></div></th>
							
							<th><div><?php echo get_phrase('CBT SCORE');?></div></th>
						
                          
                            <th><div><?php echo get_phrase('OLEVEL RESULT GRADING');?></div></th>
							<th><div><?php echo get_phrase('AGGREGATE SCORE');?></div></th>
						
							<th><div><?php echo get_phrase('OVERALL REMARK');?></div></th>
							<th><div><?php echo get_phrase('RESULT VER. STATUS');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('application/config/z2.php');//$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $j=1;?>
                        <?php 
						$details =sqlsrv_query($conn,"SELECT * FROM View_Applicant_Data where dept_id='$dept' and  (has_cbt_sit = '1') AND (total_score IS NOT NULL) and cbt_score<12 order by total_score DESC")or die ( print_r( sqlsrv_errors(), true));;
						while(list($candidate_name, $state, $totalscore, $sex, $date_of_birth, $application_no, $total_score, $score, $olevelscreened, $has_cbt_sit, $no_of_siting_score, $ssce_results_score, $jambremark, $olevelremark, $cbt_score, 
                         $jamb_regno, $dept_id,$course_of_choice,$olevelfailedreason,$dept1,$jamb_subjects,$ssce_results,$ssce_results_supplied,$nos)=sqlsrv_fetch_array($details))
						{
						
						
						
						$application_query= sqlsrv_query($conn,"SELECT top(1)  application_no,firstname,middlename,surname, email,mobile_no FROM applicationinvoice_gen WHERE application_no='$application_no' and application_type_id='1'")or die( print_r( sqlsrv_errors(), true));
						while(list($application_no,$fn,$midn,$sn,$email,$mn)=sqlsrv_fetch_array($application_query))
						{
						
						
						
					
	
						?>
									<?php $dob= explode("/",$date_of_birth);
			$yr=$dob[2];
			$mn=$dob[0];
			$age= 2019-$yr;
			//echo $mn;
			if($age<16 && $mn<11 ){
			?>
                         <tr>
                            <td><?php echo $j;?></td>
							<td><?php 
							echo $application_no;
							?></td>
                            <td><?php 
							 echo strtoupper($sn)." ".strtoupper($fn). " ".strtoupper($midn);//echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                          </td>
                     
                          
							 
                            <td><?php echo strtoupper($sex);?></td>
							<td><?php echo $date_of_birth;?></td>
							 <td><?php echo $state;?></td>
                            <td>   <?php 
							echo $dept1;
					?>    		</td>
					<td> <?php 
							echo $ssce_results;
					?>    		</td>
					<td> <?php 
							echo $ssce_results_supplied;
					?>    		</td>
					<td> <?php 
							echo $nos;
							$ns=0;
							if($nos==1)
							{
								$ns=5;
							}
							elseif($nos==2)
							{
								$ns=3;
							}
					?>    		</td>
					<td> <?php 
							echo $totalscore;
					?>    		</td>
					
							<td>   <?php echo number_format($score,2);?>    		</td>
							<td>   <?php echo $cbt_score;?>    		</td>
							<td>   <?php echo number_format($ssce_results_score,2);?>    		</td>
							<td>   <?php echo number_format($total_score,2);?>    		</td>
							
			<td>   <?php if($olevelremark==''){echo 'OK';}else {
				echo $olevelremark;}?>    		</td>
			<td>   <?php 
			
			
				//echo "DISQUALIFIED BASED ON AGE - RESULT  ";
				
			
			if($olevelremark=='INCOMPLETE OLEVEL RESULT')
				{echo "INVALID - DISQUALIFIED BASED ON INCOMPLETE OLEVEL RESULT";}else{
					if($olevelfailedreason=='')
					{echo 'VERIFIED';}
				else {echo 'INVALID - DISQUALIFIED BASED ON WRONG OLEVEL RESULT';}
				}
						?>    	
							</td>
						<?php 
						$j++;
						
		
							?>
						
                        </tr>
						<?php } else{} }  } ?>
                    </tbody>
                </table>
				
                <div class="col-md-12"><b><p><h4></h4><br /></p></b></div>
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
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8, 9,10,11,12,13,14,15,16,17]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16,17]
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