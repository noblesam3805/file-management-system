<?php session_start(); ?>

	
	<div class="col-md-6">
		<div class="widget stacked">
			<div class="widget-header">
				<h3>Process Firstbank 2015/2016 payments</h3>
			</div>
			<div class="widget-content" style="padding:10px 20px;">
				<?php if(isset($_SESSION['success1'])){ ?>
					<p style="color:#394263; padding:5px; background:#a1e0b7;font-size:14px;border-radius:3px;"><?php echo $_SESSION['success1']; ?></p>
				<?php } ?>
				
						<?php if(isset($_SESSION['error'])){ ?>
					<p style="color:#FFFFFF; padding:5px; background:#FF0000;font-size:14px;border-radius:3px;"><?php echo $_SESSION['error']; ?></p>
				<?php } ?>
				<form class="smsDiv" method="post" action="<?php echo base_url() . 'index.php?sadmin/processetransactFBPayment'; ?>" enctype="multipart/form-data" id="uploadForm">
					
			    	
					
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name">Enter Confirmation Code:</label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="conf" required class="form-control eduportal-input" placeholder="Enter Confirmation Code"/>
							</div>
						</div>
					</div>
					
                
					
				
					
					<div class="col-md-12">
						<div class="form-group eduportal-form-group">
							<button type="submit" name="uploadFile" style="width:200px;padding:10px; 35px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i> &nbsp; Process Payment</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
				<?php if(isset($_SESSION['success1'])){ unset($_SESSION['success1']);}?>
				<?php if(isset($_SESSION['error'])){ unset($_SESSION['error']);}?>


