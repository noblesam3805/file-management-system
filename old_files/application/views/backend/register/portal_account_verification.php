<script type="text/javascript">
	function regNum(a){
		if(a == '1'){
			document.getElementById('jamb').style.display = "block";
			document.getElementById('matric').style.display = "none";
		}else if(a == '2'){
			document.getElementById('jamb').style.display = "none";
			document.getElementById('matric').style.display = "block";
		}else if(a == ''){
			document.getElementById('jamb').style.display = "none";
			document.getElementById('matric').style.display = "none";
		}
	}
</script>
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
                    <h4>Step 1: Portal Account Verification</h4>
                </div>
            </div><!-- media -->
        </div><!-- pageheader -->
                        <?php echo form_open('register/process_account_verification' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?> 
        <div class="span12">
            <div class="span8 b themiddle hasheight" style="background-color:#FFF;">
                <div class="" style="border:none;">
 <p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];} ?></p>
                	<div class="wrapclass">
						<label class="span8">Choose Student Type</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<select required onChange="regNum(this.value)" id="jm" name="st_type">
									<option value="">Select An Option</option>
									<option value="1">NEW STUDENT (CURRENT HND I OR ND I)</option>
									<option value="2">RETURNING STUDENT (CURRENT HND II OR ND II)</option>
								</select>
							</div><br /><br />
						</div>
					</div>
					<div id="jamb" class="wrapclass" style="display:none;">
						<label class="span8">Your Application Form No:</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<input name="serial1" type="text" placeholder="Enter Application No" id="jreg" required="required" class="form-control" />
							</div>
						</div>
					</div>
					<div id="matric" class="wrapclass" style="display:none;">
						<label class="span8">Your Matriculation Number/Portal ID</label>
						<div class="form-div">
							<div class="form-icon">
								<i class="fa fa-globe"></i>
							</div>
							<div class="col-sm-8">
								<input name="serial2" type="text" placeholder="Enter Reg No/Portal ID" id="mreg" required="required" class="form-control" />
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

    </div><!-- mainpanel -->
</div><?php 
echo form_close();
unset($_SESSION['error']);
?>