<div class="mycontainer themiddle myclass" style="padding:0;">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body kk">
                                <ul class="breadcrumb">
                                    <li>Fees |</li>
                                    <li>Upload</li>
                                </ul>
                                <h4>Step 4: Upload Photo And Signature</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="span12">
                        <?php echo form_open('register/register3/picture' , array('class' => 'panel-wizard', 'enctype' => 'multipart/form-data'));?>
                                 <div style="width:80%; height:30px; color:#9d0000; text-align:center;"><?php if(isset($_SESSION['imgerror'])){echo $_SESSION['imgerror'];}; ?></div>

                       	<div class="form-group half" style="height:300px;">
							<label><?php echo get_phrase('_passport');?></label>
							<div class="col-sm-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
										<img src="<?php echo base_url() . 'images/default.jpg'; ?>" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 200px; height: 200px"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileinput-new">Select image</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" required name="userfile" accept="image/*">
										</span>
										<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>
								</div>
							</div>
						</div>


                    <div class="form-group half" style="height:300px;">
						<label><?php echo get_phrase('_signature');?></label>
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height:200px;" data-trigger="fileinput">
									<img src="<?php echo base_url() . 'images/sign.jpg'; ?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="max-width: 200px; max-height: 200px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" required name="usersign" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group lastsubmit">
				      	<div class="">
							<input type="submit" name="proceed" style="height:40px; border-radius:2px;" class="btn btn-info pull-right" value="Upload"/>
						</div>
		            </div>
				</div>
  			</div>
					