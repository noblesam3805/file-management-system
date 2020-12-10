 <div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-home"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                     
                       <li><a href="<?php echo base_url().'index.php?login';?>">Return Home</a></li>
                    </ul>
                    <h4>Step 1: Generate Acceptance Fee Invoice </h4>
                </div>
            </div><!-- media -->
        </div><!-- pageheader -->
        <div class="span12">
            <div class="span8 b themiddle hasheight" style="background-color:#FFF;">
                <div class="" style="border:none;">
                <form method="post" action="index.php?register/process_account_verification_acceptance" name="form1"> 
                 <p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];} ?></p>
					<div id="jamb" class="wrapclass" >
						<label class="span8">Your Application Form No:</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<input name="serial" type="text" placeholder="Enter Application No" id="jreg" required="required" class="form-control" />
							</div>
						</div>
					</div>
					
						
						<div id="matric" class="wrapclass" >
						<label class="span8">Current Mobile No.</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<input name="phone" type="text" placeholder="Enter Mobile No" id="mreg" required="required" class="form-control" />
							</div>
						</div>
					</div>
				
					<div id="result">

					</div>
					<div class="form-group">
						<ul class="list-unstyled wizard">
							<li class="pull-right next myclass"><button style="height:40px; border-radius:2px;"  type="submit" class="btn btn-info pull-right">Verify</button></li>
						</ul>
					</div>
                </div>
            </div>
        </div>
</form>
    </div><!-- mainpanel -->
</div><?php unset($_SESSION['error']);?>