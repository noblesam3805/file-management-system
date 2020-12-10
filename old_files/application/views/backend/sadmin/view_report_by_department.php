<?php //$account= $this->db->get_where('vs_register', array("id" => $this->session->userdata('user_id')))->row();?>
	<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
			
				<!-- /page header -->


				<!-- Content area -->
			<div class="content">

					<!-- Form horizontal -->
					<div class="panel panel-flat">
					

						<div class="panel-body">
						<?php if($_SESSION["success"])
						{
					?>
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
										<span class="text-semibold"><?php echo $_SESSION["success"];?></span> 
								    </div>
						<?php }?>
							
<form class="form-horizontal" action="<?php echo base_url().'index.php?admin/processview_applicants_department';?>" method='post'>
								<fieldset class="content-group">
									<legend class="text-bold">Please Select Details </legend>
									<div class="form-group">
										<label class="control-label col-lg-2">Application Type</label>
										<div class="col-lg-4">
											<select name="prog" class="form-control" required>
				                                <option value="">Select Application Type</option>
												
				                               
	
 <option value="DEG">JAMB</option>
  <option value="DENT">DIRECT ENTRY</option>

	
										</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-lg-2">Department</label>
										<div class="col-lg-4">
											<select name="dept" class="form-control" required>
				                                <option value="">Select Department</option>
												
				                                <?php 
			
								$package = $this->db->query("select*  from  department");
				
										
									 foreach($package->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->deptID;?>"><?php  echo $row->deptName;?></option>
<?php 
	} 
	?>
										</select>
										</div>
									</div>
									
									
									
									
									

									
								<div class="text-left">
									<button type="submit" class="btn btn-primary">Proceed <i class="icon-arrow-right14 position-right"></i></button>
								</div>
								</form>

									
<br><br>

<br>	<a href="<?php echo base_url().'index.php?admin/dashboard';?>">Close!</a><br>
<?php 
								
								
								?>
								</div>
								
								</div>
							 
						</div>
					</div>
					<!-- /form horizontal -->

					
					<!-- Footer -->
					
					<!-- /footer -->

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
  <?php unset($_SESSION["success"]);
  unset($_SESSION["amnt"]);
  ?>

  
