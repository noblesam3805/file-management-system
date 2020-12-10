
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
							<th><div><?php echo get_phrase('APP_NO');?></div></th>
                         <th><div><?php echo get_phrase('FULLNAME');?></div></th>
						     <th><div><?php echo get_phrase('STATE');?></div></th>
                           
							 <th><div><?php echo get_phrase('DOB');?></div></th>
							
							<th><div><?php echo get_phrase('ND INSTITUTION');?></div></th>
							<th><div><?php echo get_phrase('ND COURSE');?></div></th>
							<th><div><?php echo get_phrase('PROGRAMME');?></div></th>
							<th><div><?php echo get_phrase('ND YEAR OF GRAG');?></div></th>
                   <th><div><?php echo get_phrase('ND GRADE');?></div></th>
							<th><div><?php echo get_phrase('OLEVEL SUPPLIED');?></div></th>
							 <th><div><?php echo get_phrase('OLEVEL ACCEPTED');?></div></th>
							<th><div><?php echo get_phrase('NO OF SITTING');?></div></th>
							<th><div><?php echo get_phrase('AGGREGATE SCORE');?></div></th>
					
						
                          
                           
							
						
							<th><div><?php echo get_phrase('OVERALL REMARK');?></div></th>
							<th><div><?php echo get_phrase('RESULT VER. STATUS');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('application/config/z2.php');//$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $j=1;?>
                        <?php 
						$details =sqlsrv_query($conn,"SELECT        sex, date_of_birth, application_no, total_score, score, olevelscreened, has_cbt_sit, no_of_siting_score, ssce_results_score, jambremark, olevelremark, cbt_score, dept_id, olevelfailedreason, dept_name, 
                         jamb_subjects, ssce_results, ssce_results_supplied, nos, program_code, mobile_no, passport_url, faculty_id, email, application_type_id,dept_name
FROM            View_Applicant_Data_Hnd
WHERE        (program_code = '$prog') AND (application_type_id = '3') AND (dept_id = '$dept') order by total_score DESC")or die ( print_r( sqlsrv_errors(), true));;
						while(list($sex, $date_of_birth, $application_no, $total_score, $score, $olevelscreened, $has_cbt_sit, $no_of_siting_score, $ssce_results_score, $jambremark, $olevelremark, $cbt_score, $dept_id, $olevelfailedreason, $dept_name, 
                         $jamb_subjects, $ssce_results, $ssce_results_supplied, $nos, $program_code, $mobile_no, $passport_url, $faculty_id, $email, $application_type_id,$dept_name)=sqlsrv_fetch_array($details))
						{
						
						
						
						$application_query= sqlsrv_query($conn,"SELECT    application_no,firstname,middlename,surname, email,mobile_no FROM applicationinvoice_gen WHERE application_no='$application_no' and application_type_id='3'")or die( print_r( sqlsrv_errors(), true));
						while(list($application_no,$fn,$midn,$sn,$email,$mn)=sqlsrv_fetch_array($application_query))
						{
						
						
						
					 $application_query1= sqlsrv_query($conn,"SELECT institution_id, year,pass_level_id,course_id  from hnd_applicants_tert_details WHERE applicant_no='$application_no'")or die( print_r( sqlsrv_errors(), true));
						while(list($instid, $year,$pass_level_id,$course_id)=sqlsrv_fetch_array($application_query1))
						{
							$instiden= sqlsrv_query($conn,"SELECT name from institution where institution_id='$instid'")or die( print_r( sqlsrv_errors(), true));
						while(list($institution_name)=sqlsrv_fetch_array($instiden))
						{
							
							$grade_nd= sqlsrv_query($conn,"SELECT pass_level from level_of_pass where pass_level_id='$pass_level_id'")or die( print_r( sqlsrv_errors(), true));
						while(list($pass_level)=sqlsrv_fetch_array($grade_nd))
						{ 
	
						?>
									<?php 
			?>
                                                     <tr>
                            <td><?php echo $j;?></td>
							<td><?php 
							echo $application_no;
							?></td>
                            <td><?php 
							 echo strtoupper($sn)." ".strtoupper($fn). " ".strtoupper($midn);//echo $row["surname"].' '.$row["firstname"].' '.$row["middlename"];?></td>
                          </td>
                     
                          	
							
							  <td><?php echo $state_id;	
								  $appl= sqlsrv_query($conn,"SELECT state_id from hnd_applicants_form where application_no='$application_no'")or die( print_r( sqlsrv_errors(), true));
						while(list($state_id)=sqlsrv_fetch_array($appl))
						{  
							  $states34= sqlsrv_query($conn,"SELECT name from states where state_id='$state_id'")or die( print_r( sqlsrv_errors(), true));
						while(list($stname)=sqlsrv_fetch_array($states34))
						{
							echo $stname;
						}
						
						}?></td>
                           
							<td><?php echo $date_of_birth;?></td>
							<td><?php echo $institution_name;?></td>
							<td><?php 	  $course= sqlsrv_query($conn,"SELECT name from discipline where course_id='$course_id'")or die( print_r( sqlsrv_errors(), true));
						while(list($csname)=sqlsrv_fetch_array($course))
						{
							echo $csname;
						}?></td>
							 <td>   <?php 
							echo $dept_name."($program_code)";
					?>    		</td>
							<td><?php echo $year;?></td>
							<td><?php echo $pass_level;?></td>
                          <td> <?php 
							echo $ssce_results_supplied;
					?> 
					</td> 
					<td> <?php 
							echo $ssce_results;
					?>    		</td>
					
					<td> <?php 
							echo $nos;
							$ns=0;
							if($nos==1)
							{
								$ns=10;
							}
							elseif($nos==2)
							{
								$ns=5;
							}
					?>    		</td>
					<td> <?php 
							echo $total_score;
					?>    		</td>
					
							
							
			<td>   <?php if($olevelremark==''){echo 'OK';}else {
				echo $olevelremark;}?>    		</td>
			<td>   <?php 
			
			$dob= explode("/",$date_of_birth);
			$yr=$dob[2];
			$mn=$dob[0];
			$age= 2019-$yr;
			//echo $mn;
			if($age<16 && $mn<11 ){
				echo "DISQUALIFIED BASED ON AGE - RESULT  ";
				
			}
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
						<?php } }}}} ?>
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
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8, 9,10,11,12,13,14,15,16]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16]
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