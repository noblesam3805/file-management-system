<?php
session_start();
unset($_SESSION["paytype"]);
						?>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-bookmark"></i>
					<h3>Quick Links</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="shortcuts">
						<a href="<?php echo base_url() . 'index.php?student/manage_profile' ?>" class="std-shortcut">
							<i class="shortcut-icon entypo-users"></i>
							<span class="shortcut-label">Profile</span>
						</a>
						
						<a href="#" class="std-shortcut">
							<i class="shortcut-icon entypo-docs"></i>
							<span class="shortcut-label">Courses</span>								
						</a>
						
						<a href="<?php echo base_url() . 'index.php?student/pay_fees' ?>" class="std-shortcut">
							<i class="shortcut-icon icon-mastercard"></i>
							<span class="shortcut-label">Payment</span>	
						</a>
						
						<a href="<?php echo base_url() . 'index.php?student/hostel' ?>" class="std-shortcut">
							<i class="shortcut-icon icon-store"></i>
							<span class="shortcut-label">Accomodation</span>								
						</a>
						
						<a href="#" class="std-shortcut">
							<i class="shortcut-icon entypo-graduation-cap"></i>
							<span class="shortcut-label">Exams</span>
						</a>
						
						<a href="#" class="std-shortcut">
							<i class="shortcut-icon entypo-book"></i>
							<span class="shortcut-label">Library</span>	
						</a>
										
					</div> <!-- /shortcuts -->	
				
				</div> <!-- /widget-content -->
				
				<div class="widget stacked widget-table">
					
					<div class="widget-header">
						<i class="icon-info-sign"></i>
						<h3>Fee Report</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						<table class="table table-bordered mytable">
							<thead>
								<tr>
									<th>Payment Type</th>
									<th>Session</th>
									<th class="td-actions">Confirmation Code</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($etz as $row):?>
							<tr>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['session'];?></td>
								<td class="td-actions">
									<a href="javascript:;">
										<?php echo $row['confirm_code'];?> &nbsp; <i class="icon-chevron-right"></i>										
									</a>
								</td>
							</tr>
							<?php endforeach;?>
							</tbody>
						</table>
						
					</div> <!-- /widget-content -->
				
				</div> 
				<div class="widget stacked widget-table">
					
					<div class="widget-header">
						<i class="icon-info-sign"></i>
						<h3>Accommodation Report</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						<table class="table table-bordered mytable">
							<thead>
								<tr>
									<th>Hostel</th>
									<th>Room</th>
									<th class="td-actions">Serial</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($hostel as $row):?>
								<tr>
									<td><?php echo $row['hostel_name'];?></td>
									<td><?php echo $row['room_no'];?></td>
									<td class="td-actions">
										<a href="javascript:;">
											<?php echo $row['serial'];?> &nbsp; <i class="icon-chevron-right"></i>										
										</a>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
						
					</div> <!-- /widget-content -->
				
				</div>
				<div class="widget stacked widget-table">
					
					<div class="widget-header">
						<i class="icon-info-sign"></i>
						<h3>Examination Best Score</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						<table class="table table-bordered mytable">
							<thead>
								<tr>
									<th>Course Code</th>
									<th>Session</th>
									<th class="td-actions">Score</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td class="td-actions">
										<a href="javascript:;">
											View Score &nbsp; <i class="icon-chevron-right"></i>										
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						
					</div> <!-- /widget-content -->
				
				</div>
				<div class="widget stacked widget-table">
					
					<div class="widget-header">
						<i class="icon-info-sign"></i>
						<h3>Examination Worse Score</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						<table class="table table-bordered mytable">
							<thead>
								<tr>
									<th>Course</th>
									<th>Session</th>
									<th class="td-actions">Score</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td class="td-actions">
										<a href="javascript:;">
											View Score &nbsp; <i class="icon-chevron-right"></i>										
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						
					</div> <!-- /widget-content -->
				
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-check"></i>
					<h3>Event Schedule</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					<div class="calendar-env">
						<div class="calendar-body">
							<div id="notice_calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



    <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: true,
					firstDay: 1,
					height: 530,
					droppable: true,
					
					events: [
						<?php 
						$notices	=	[];//$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>

  
