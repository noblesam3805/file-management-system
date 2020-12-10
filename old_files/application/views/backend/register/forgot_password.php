	<div class="mycontainer themiddle myclass" style="padding:0;">
        <div class="pageheader">
            <div class="media">
                <div class="pageicon pull-left">
                    <i class="fa fa-lock fa-4x" style="margin-left:2px;"></i>
                </div>
                <div class="media-body kk">
                    <ul class="breadcrumb">
                        <li>Password</li>
                    </ul>
                    <h4>Password Recovery</h4>
                </div>
            </div><!-- media -->
        </div>
        <div class="span12"> 
			<p style="font-size:13px; width:80%; margin:15px auto; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
			<div class="span8 b themiddle hasheight" style="background-color:#FFF;">
				<?php echo form_open('register/password/forgot' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>  

				
				
				<div class="wrapclass">
					<label class="span8"><?php echo get_phrase('_reg_no/Matric No');?></label>
					<div class="form-div">
						<div class="form-icon">
							<i class="fa fa-globe"></i>
						</div>
						<div class="col-sm-8">
							<input type="text" placeholder="Reg No / Matric No" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus>
						</div>
					</div>
				</div>
				
				<div class="wrapclass">
					<label class="span8"><?php echo get_phrase('phone_number');?></label>
					<div class="form-div">
						<div class="form-icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="col-sm-8">
							<input type="number" placeholder="Phone Number" class="form-control" name="phone" data-validate="required" data-message-required="<?php echo get_phrase('number_required');?>" value="" >
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<ul class="list-unstyled wizard">
						<li class="pull-right next myclass"><button type="submit" style="height:40px; border-radius:2px; margin-right:20px;" class="btn btn-info pull-right"><?php echo get_phrase('Retrieve password');?></button></li>
					</ul>
				</div>

				<?php echo form_close();?>
			</div> 
        </div>
    </div>
