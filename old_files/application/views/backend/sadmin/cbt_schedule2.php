
                        <?php include('application/config/z2.php');//$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $j=1;?>
                        <?php 
						$details =sqlsrv_query($conn,"SELECT * FROM cbt_final_exams_schedule where cand_no='' order by id")or die( print_r( sqlsrv_errors(), true));;
						while(list($id,$cand_no,$sitno,$day,$date,$time,$venue)=sqlsrv_fetch_array($details))
						{
						
						$app_query= sqlsrv_query($conn,"SELECT min(applicant_id) as expx FROM hnd_applicants_form WHERE has_cbt_sit='0' and progress_step='3' and program_code='DEG'") or die("2");
						while(list($applicant_id)=sqlsrv_fetch_array($app_query))
						{
						
						$application_query= sqlsrv_query($conn,"SELECT application_no FROM hnd_applicants_form WHERE applicant_id='$applicant_id'")or die("3");
						while(list($application_no)=sqlsrv_fetch_array($application_query))
						{
						sqlsrv_query($conn,"update hnd_applicants_form set has_cbt_sit='1',cbt_day='$day',cbt_date='$date',cbt_time='$time',cbt_venue='$venue',cbt_exam_no='$sitno' WHERE application_no='$application_no'");
						sqlsrv_query($conn,"update cbt_final_exams_schedule set cand_no='$application_no' WHERE id='$id'");
						}
						}
						?>
						
						<?php 
						$j++;
						
		
							?>
						<?php  }?>
                       
                  
